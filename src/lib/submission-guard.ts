// Admission of contact submissions in this single server process: the visitor's IP address, the per-visitor and global rate limits over fixed 60-minute windows, the count of submissions in flight, and, in production builds, a graceful shutdown on SIGINT and SIGTERM that stops admitting submissions and ends the process after the submissions in flight have settled.
import process from 'node:process';
import type { ActionAPIContext } from 'astro:actions';

interface RateWindow {
	start: number;
	count: number;
}

const windowLength = 60 * 60 * 1000;
const visitorLimit = 5;
const globalLimit = 30;
const shutdownGrace = 1000;

const visitorWindows = new Map<string, RateWindow>();
let globalWindow: RateWindow | undefined;
let inFlight = 0;
let draining = false;

// Returns the visitor's IP address: the CF-Connecting-IP header that Cloudflare adds, else the address Astro resolved for the request.
export function visitorAddress(context: ActionAPIContext): string {
	return context.request.headers.get('cf-connecting-ip') || context.clientAddress;
}

// Reports whether a shutdown has started, after which no submission is admitted.
export function isDraining(): boolean {
	return draining;
}

// Prunes the windows that started 60 or more minutes ago, then counts a submission from the given address against the per-visitor and global limits; returns false, counting nothing, when either limit is already reached.
export function admitUnderRateLimits(address: string): boolean {
	const now = Date.now();
	for (const [key, rateWindow] of visitorWindows) {
		if (now - rateWindow.start >= windowLength) {
			visitorWindows.delete(key);
		}
	}
	if (globalWindow && now - globalWindow.start >= windowLength) {
		globalWindow = undefined;
	}
	const visitorWindow = visitorWindows.get(address);
	if ((visitorWindow?.count ?? 0) >= visitorLimit || (globalWindow?.count ?? 0) >= globalLimit) {
		return false;
	}
	if (visitorWindow) {
		visitorWindow.count += 1;
	} else {
		visitorWindows.set(address, { start: now, count: 1 });
	}
	if (globalWindow) {
		globalWindow.count += 1;
	} else {
		globalWindow = { start: now, count: 1 };
	}
	return true;
}

// Runs an admitted submission and counts it as in flight until it settles; during a shutdown, the process exits 1000 ms after the last submission in flight settles, which leaves time to write its response.
export async function trackInFlight(submission: () => Promise<void>): Promise<void> {
	inFlight += 1;
	try {
		await submission();
	} finally {
		inFlight -= 1;
		if (draining && inFlight === 0) {
			setTimeout(exit, shutdownGrace);
		}
	}
}

// Ends the process with exit code 0.
function exit(): void {
	process.exit(0);
}

// Starts the shutdown once: stops admitting submissions and writes the number in flight to standard output; with none in flight, the process exits as soon as that line has been written, because an exit can discard output that is still being written.
function drain(): void {
	if (draining) {
		return;
	}
	draining = true;
	process.stdout.write(`Shutdown requested; contact submissions in flight: ${inFlight}\n`, inFlight === 0 ? exit : undefined);
}

if (import.meta.env.PROD) {
	process.once('SIGINT', drain);
	process.once('SIGTERM', drain);
}
