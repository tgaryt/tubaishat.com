<?php
declare(strict_types=1);

use Tubaishat\Support\Csp;

require __DIR__ . '/../vendor/autoload.php';

$projectRoot = dirname(__DIR__);

$dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
$dotenv->safeLoad();
$dotenv->required([
	'APP_ENV',
	'MAILGUN_API_KEY',
	'MAILGUN_DOMAIN',
	'MAILGUN_REGION',
	'MAIL_FROM_ADDRESS',
	'MAIL_FROM_NAME',
	'MAIL_TO_ADDRESS',
])->notEmpty();
$dotenv->required('MAILGUN_REGION')->allowedValues(['us', 'eu']);

$isProduction = ($_ENV['APP_ENV'] ?? 'production') === 'production';

error_reporting(E_ALL);
ini_set('display_errors', $isProduction ? '0' : '1');
ini_set('log_errors', '1');

ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');

$sessionPath = $projectRoot . '/storage/sessions';
if (!is_dir($sessionPath) || !is_writable($sessionPath)) {
	throw new RuntimeException('Session storage directory is missing or not writable: ' . $sessionPath);
}
session_save_path($sessionPath);

session_name($_ENV['SESSION_COOKIE_NAME'] ?? '__Host-tsid');
session_set_cookie_params([
	'lifetime' => 0,
	'path' => '/',
	'domain' => '',
	'secure' => true,
	'httponly' => true,
	'samesite' => 'Strict',
]);

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

date_default_timezone_set('UTC');

Csp::init();
