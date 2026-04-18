<?php
declare(strict_types=1);

namespace Tubaishat\Support;

final class Csp
{
	private const NONCE_BYTES = 16;

	private static string $nonce = '';

	/**
	 * Generate a per-request nonce and emit the Content-Security-Policy header. Called once from bootstrap.
	 */
	public static function init(): void
	{
		self::$nonce = bin2hex(random_bytes(self::NONCE_BYTES));

		$policy = implode('; ', [
			"default-src 'none'",
			"script-src 'self' 'nonce-" . self::$nonce . "' https://static.cloudflareinsights.com",
			"style-src 'self' https://fonts.googleapis.com",
			"font-src 'self' https://fonts.gstatic.com",
			"img-src 'self' data:",
			"connect-src 'self' https://cloudflareinsights.com",
			"form-action 'self'",
			"frame-ancestors 'none'",
			"base-uri 'none'",
			"object-src 'none'",
			"manifest-src 'self'",
			"upgrade-insecure-requests",
		]);

		if (!headers_sent()) {
			header('Content-Security-Policy: ' . $policy);
		}
	}

	/**
	 * Return the per-request nonce to attach to `<script nonce="...">` tags for inline scripts (e.g., JSON-LD).
	 */
	public static function nonce(): string
	{
		return self::$nonce;
	}
}
