<?php
declare(strict_types=1);

use Tubaishat\Controllers\ContactController;
use Tubaishat\Controllers\HomeController;

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($method === 'GET' && $path === '/') {
	(new HomeController())->index();
	return;
}

if ($method === 'POST' && $path === '/contact') {
	(new ContactController())->submit();
	return;
}

http_response_code(404);
header('Content-Type: text/plain; charset=utf-8');
echo '404 Not Found';
