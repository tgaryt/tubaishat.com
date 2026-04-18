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
	 */
	public function allow(string $ip): bool
	{
		$file = $this->storagePath . '/' . hash('sha256', $ip) . '.json';

		$handle = @fopen($file, 'c+');
		if ($handle === false) {
			error_log('[rate-limiter] Unable to open ' . $file);
			return true;
		}

		if (!flock($handle, LOCK_EX)) {
			fclose($handle);
			return true;
		}

		$contents = stream_get_contents($handle);
		$now = time();
		$state = ($contents !== '' && $contents !== false) ? json_decode($contents, true) : null;

		if (!is_array($state) || $now - ($state['window_start'] ?? 0) >= self::WINDOW_SECONDS) {
			$state = ['count' => 0, 'window_start' => $now];
		}

		if ($state['count'] >= self::MAX_REQUESTS_PER_WINDOW) {
			flock($handle, LOCK_UN);
			fclose($handle);
			return false;
		}

		$state['count']++;

		ftruncate($handle, 0);
		rewind($handle);
		fwrite($handle, json_encode($state));
		fflush($handle);
		flock($handle, LOCK_UN);
		fclose($handle);

		return true;
	}
}
