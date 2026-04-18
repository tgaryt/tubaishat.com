<?php
declare(strict_types=1);

namespace Tubaishat\Controllers;

use Tubaishat\Support\Csrf;
use Tubaishat\Support\View;

final class HomeController
{
	/**
	 * Render the single-page portfolio with a fresh CSRF token for the contact form.
	 */
	public function index(): void
	{
		$site = require dirname(__DIR__, 2) . '/config/site.php';
		$csrf_token = Csrf::token();

		View::render('layouts/main', [
			'site' => $site,
			'csrf_token' => $csrf_token,
		]);
	}
}
