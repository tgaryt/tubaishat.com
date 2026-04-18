<?php
declare(strict_types=1);

namespace Tubaishat\Support;

final class Csrf
{
	private const SESSION_KEY = 'csrf_token';
	private const TOKEN_BYTES = 32;

	/**
	 * Return the current CSRF token, creating one if the session does not have one yet.
	 */
	public static function token(): string
	{
		if (empty($_SESSION[self::SESSION_KEY])) {
			$_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(self::TOKEN_BYTES));
		}

		return $_SESSION[self::SESSION_KEY];
	}

	/**
	 * Constant-time compare the submitted token against the session-stored token.
	 */
	public static function validate(string $token): bool
	{
		if ($token === '' || empty($_SESSION[self::SESSION_KEY])) {
			return false;
		}

		return hash_equals($_SESSION[self::SESSION_KEY], $token);
	}

	/**
	 * Generate a fresh token after a successful submission to prevent replay.
	 */
	public static function rotate(): void
	{
		$_SESSION[self::SESSION_KEY] = bin2hex(random_bytes(self::TOKEN_BYTES));
	}
}
