<?php
declare(strict_types=1);

namespace Tubaishat\Support;

final class Icon
{
	private const ESCAPE_FLAGS = ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE;

	/**
	 * Per-request cache so each icon file is only read from disk once, even when rendered many times.
	 */
	private static array $cache = [];

	/**
	 * Render an inline SVG icon from public/assets/icons/. Sets width="1em" height="1em" so Tailwind text-* utilities control size.
	 * Decorative icons (no $title) get aria-hidden; meaningful icons ($title set) get role="img" + aria-label per FA docs.
	 */
	public static function render(string $name, string $class = '', ?string $title = null): string
	{
		if (!array_key_exists($name, self::$cache)) {
			$path = dirname(__DIR__, 2) . '/public/assets/icons/' . $name . '.svg';
			self::$cache[$name] = is_file($path) ? (string) file_get_contents($path) : '';
		}

		$svg = self::$cache[$name];
		if ($svg === '') {
			return '';
		}

		$fullClass = 'inline-block align-[-0.125em]';
		if ($class !== '') {
			$fullClass .= ' ' . $class;
		}

		$attrs = ' width="1em" height="1em"';
		$attrs .= ' class="' . htmlspecialchars($fullClass, self::ESCAPE_FLAGS, 'UTF-8') . '"';
		$attrs .= ' focusable="false"';
		if ($title !== null) {
			$attrs .= ' role="img"';
			$attrs .= ' aria-label="' . htmlspecialchars($title, self::ESCAPE_FLAGS, 'UTF-8') . '"';
		} else {
			$attrs .= ' aria-hidden="true"';
		}

		$result = preg_replace('/<svg\b/', '<svg' . $attrs, $svg, 1);

		return $result ?? '';
	}
}
