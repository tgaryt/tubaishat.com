<?php
declare(strict_types=1);

namespace Tubaishat\Support;

final class RateLimiter
{
	private const MAX_REQUESTS_PER_WINDOW = 5;
	private const WINDOW_SECONDS = 3600;

	private string $storagePath;

	public function __construct()
	{
		$this->storagePath = dirname(__DIR__, 2) . '/storage/ratelimit';
	}

	/**
	 * Record an attempt for the given client IP and return whether it is within the per-window quota.
	 * Fails closed: if the storage layer is unavailable, the caller is blocked rather than allowed.
	 */
	public function allow(string $ip): bool
	{
		$file = $this->storagePath . '/' . hash('sha256', $this->bucketKey($ip)) . '.json';

		$handle = fopen($file, 'c+');
		if ($handle === false) {
			error_log('[rate-limiter] Unable to open rate-limit file: ' . $file);
			return false;
		}

		if (!flock($handle, LOCK_EX)) {
			fclose($handle);
			error_log('[rate-limiter] Unable to acquire lock on: ' . $file);
			return false;
		}

		try {
			$contents = stream_get_contents($handle);

			$now = time();
			$state = ($contents !== '' && $contents !== false) ? json_decode($contents, true) : null;

			if (!is_array($state) || $now - ($state['window_start'] ?? 0) >= self::WINDOW_SECONDS) {
				$state = ['count' => 0, 'window_start' => $now];
			}

			if ($state['count'] >= self::MAX_REQUESTS_PER_WINDOW) {
				return false;
			}

			$state['count']++;

			ftruncate($handle, 0);
			rewind($handle);
			fwrite($handle, json_encode($state, JSON_THROW_ON_ERROR));
			fflush($handle);

			return true;
		} finally {
			flock($handle, LOCK_UN);
			fclose($handle);
		}
	}

	/**
	 * Normalize the client IP to its rate-limit bucket. IPv4 uses the full address; IPv6 collapses
	 * to the /64 prefix so an attacker with a routed block cannot rotate through billions of /128 addresses.
	 */
	private function bucketKey(string $ip): string
	{
		if (!str_contains($ip, ':')) {
			return $ip;
		}

		$binary = inet_pton($ip);
		if ($binary === false || strlen($binary) !== 16) {
			return $ip;
		}

		return inet_ntop(substr($binary, 0, 8) . str_repeat("\x00", 8));
	}
}
