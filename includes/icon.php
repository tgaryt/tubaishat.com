<?php
declare(strict_types=1);

/**
 * Render an inline SVG icon from assets/icons/.
 *
 * The SVG is sized with height="1em" so Tailwind's text-* utilities
 * (font-size) control the icon size, matching Font Awesome's
 * documented bare-SVG sizing pattern.
 *
 * Decorative icons (no $title): aria-hidden="true" is added.
 * Meaningful icons ($title set): role="img" + <title> is added for screen readers.
 * Each icon file is read once per request and cached in a static array.
 */
function icon(string $name, string $class = '', ?string $title = null): string {
	static $cache = [];

	if (!array_key_exists($name, $cache)) {
		$path = __DIR__ . '/../assets/icons/' . $name . '.svg';
		$cache[$name] = is_file($path) ? file_get_contents($path) : '';
	}

	$svg = $cache[$name];
	if ($svg === '') {
		return '';
	}

	$fullClass = 'inline-block align-[-0.125em]';
	if ($class !== '') {
		$fullClass .= ' ' . $class;
	}

	$attrs = ' height="1em"';
	$attrs .= ' class="' . htmlspecialchars($fullClass, ENT_QUOTES, 'UTF-8') . '"';
	$attrs .= ' focusable="false"';
	if ($title !== null) {
		$attrs .= ' role="img"';
	} else {
		$attrs .= ' aria-hidden="true"';
	}

	$svg = preg_replace('/<svg\b/', '<svg' . $attrs, $svg, 1);

	if ($title !== null) {
		$titleTag = '<title>' . htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . '</title>';
		$svg = preg_replace('/<svg[^>]*>/', '$0' . $titleTag, $svg, 1);
	}

	return $svg;
}
