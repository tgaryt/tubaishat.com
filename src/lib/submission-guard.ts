// Visitor IP address, rate limits, in-flight count, and graceful shutdown for contact submissions in this server process.
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

// Returns the visitor's IP address: Cloudflare's CF-Connecting-IP header, else the client address that Astro resolved.
export function visitorAddress(context: ActionAPIContext): string {
	return context.request.headers.get('cf-connecting-ip') || context.clientAddress;
}

// Reports whether a shutdown has started.
export function isDraining(): boolean {
	return draining;
}

// Counts a submission against the per-visitor and global limits; returns false, counting nothing, when either limit is already reached.
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

// Runs a submission while counting it as in flight; during a shutdown, the process exits 1 second after the last one settles.
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

// Starts the shutdown once: stops admitting submissions, logs how many are in flight, and ends the process once that line is written if none are.
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
