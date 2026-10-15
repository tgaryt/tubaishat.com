// Verifies Cloudflare Turnstile tokens with the Siteverify API: a token is valid only when Siteverify reports success for the expected hostname, and one retry with the same idempotency key follows a timeout, any other failure of the request or its response, an HTTP 5xx status, or an internal-error result.
import { TURNSTILE_EXPECTED_HOSTNAME, TURNSTILE_SECRET_KEY } from 'astro:env/server';

interface SiteverifyResult {
	success: boolean;
	hostname?: string;
	'error-codes'?: string[];
}

export type TurnstileVerdict = { outcome: 'valid' } | { outcome: 'rejected' | 'unavailable'; reason: string };

const siteverifyUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

// Sends one Siteverify request with a 5-second timeout and returns its verdict, marked transient when a retry could succeed; the reason of an unavailable verdict is the HTTP status, "internal-error", "timeout", or "network" for any other failure of the request or its response.
async function requestVerdict(body: URLSearchParams): Promise<{ verdict: TurnstileVerdict; transient: boolean }> {
	try {
		const response = await fetch(siteverifyUrl, { method: 'POST', body, signal: AbortSignal.timeout(5000) });
		if (!response.ok) {
			await response.body?.cancel();
			return { verdict: { outcome: 'unavailable', reason: `HTTP ${response.status}` }, transient: response.status >= 500 };
		}
		const result = (await response.json()) as SiteverifyResult;
		const errorCodes = result['error-codes'] ?? [];
		if (errorCodes.includes('internal-error')) {
			return { verdict: { outcome: 'unavailable', reason: 'internal-error' }, transient: true };
		}
		if (!result.success) {
			return { verdict: { outcome: 'rejected', reason: errorCodes.join(', ') }, transient: false };
		}
		if (result.hostname !== TURNSTILE_EXPECTED_HOSTNAME) {
			return { verdict: { outcome: 'rejected', reason: 'hostname mismatch' }, transient: false };
		}
		return { verdict: { outcome: 'valid' }, transient: false };
	} catch (error) {
		return { verdict: { outcome: 'unavailable', reason: error instanceof DOMException && error.name === 'TimeoutError' ? 'timeout' : 'network' }, transient: true };
	}
}

// Verifies a widget token together with the visitor's IP address, retrying once with the same idempotency key when the first verdict is transient.
export async function verifyTurnstile(token: string, remoteIp: string): Promise<TurnstileVerdict> {
	const body = new URLSearchParams({ secret: TURNSTILE_SECRET_KEY, response: token, remoteip: remoteIp, idempotency_key: crypto.randomUUID() });
	const first = await requestVerdict(body);
	return first.transient ? (await requestVerdict(body)).verdict : first.verdict;
}
