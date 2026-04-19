<?php
declare(strict_types=1);

namespace Tubaishat\Controllers;

use Tubaishat\Services\MailgunService;
use Tubaishat\Support\Csrf;
use Tubaishat\Support\RateLimiter;
use Tubaishat\Support\Validator;

final class ContactController
{
	private const JSON_FLAGS = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR;

	/**
	 * Handle contact form POST: honeypot, CSRF check, rate-limit, validate, send via Mailgun.
	 */
	public function submit(): void
	{
		header('Content-Type: application/json; charset=utf-8');
		header('X-Content-Type-Options: nosniff');

		if (!empty($_POST['website'])) {
			echo json_encode(['ok' => true], self::JSON_FLAGS);
			return;
		}

		$token = (string) ($_POST['_csrf'] ?? '');
		if (!Csrf::validate($token)) {
			http_response_code(419);
			echo json_encode([
				'ok' => false,
				'error' => 'Your session has expired. Please refresh the page and send the message again.',
			], self::JSON_FLAGS);
			return;
		}

		$ip = $this->clientIp();
		if (!(new RateLimiter())->allow($ip)) {
			http_response_code(429);
			echo json_encode([
				'ok' => false,
				'error' => 'You have reached the submission limit for this hour. Please try again later.',
			], self::JSON_FLAGS);
			return;
		}

		$validator = new Validator($_POST);
		$errors = $validator->validateContactForm();
		if (!empty($errors)) {
			http_response_code(422);
			echo json_encode(['ok' => false, 'errors' => $errors], self::JSON_FLAGS);
			return;
		}

		try {
			(new MailgunService())->sendContactForm($validator->validated());
		} catch (\Throwable $e) {
			error_log('[contact-form] Mailgun send failed: ' . $e->getMessage());
			http_response_code(500);
			echo json_encode([
				'ok' => false,
				'error' => 'The message could not be sent at this time. Please email ba8lawa2023@gmail.com directly.',
			], self::JSON_FLAGS);
			return;
		}

		Csrf::rotate();

		echo json_encode([
			'ok' => true,
			'csrf_token' => Csrf::token(),
		], self::JSON_FLAGS);
	}

	/**
	 * Resolve the client IP. Trust only the value nginx placed into REMOTE_ADDR; the nginx realip
	 * module already replaces it with the CF-Connecting-IP value for requests from Cloudflare ranges
	 * and leaves it as the true peer address otherwise, which prevents direct-hit header spoofing.
	 */
	private function clientIp(): string
	{
		$ip = $_SERVER['REMOTE_ADDR'] ?? '';
		if ($ip !== '' && filter_var($ip, FILTER_VALIDATE_IP)) {
			return $ip;
		}

		return 'unknown';
	}
}
