<?php
declare(strict_types=1);

namespace Tubaishat\Support;

use RuntimeException;

final class View
{
	/**
	 * Render a template by path (relative to templates/, no .php extension) with the given data extracted as local variables.
	 */
	public static function render(string $template, array $data = []): void
	{
		$templatePath = dirname(__DIR__, 2) . '/templates/' . $template . '.php';
		if (!is_file($templatePath)) {
			throw new RuntimeException('Template not found: ' . $template);
		}

		extract($data, EXTR_SKIP);
		require $templatePath;
	}
}
