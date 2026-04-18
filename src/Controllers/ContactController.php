<?php
declare(strict_types=1);

namespace Tubaishat\Controllers;

use Tubaishat\Services\MailgunService;
use Tubaishat\Support\Csrf;
use Tubaishat\Support\RateLimiter;
use Tubaishat\Support\Validator;

final class ContactController
{
	/**
	 * Handle contact form POST: honeypot, CSRF check, rate-limit, validate, send via Mailgun.
	 */
	public function submit(): void
	{
		header('Content-Type: application/json; charset=utf-8');
		header('X-Content-Type-Options: nosniff');

		if (!empty($_POST['website'])) {
			echo json_encode(['ok' => true]);
			return;
		}

		$token = (string) ($_POST['_csrf'] ?? '');
		if (!Csrf::validate($token)) {
			http_response_code(419);
			echo json_encode([
				'ok' => false,
				'error' => 'Your session has expired. Please refresh the page and send the message again.',
			]);
			return;
		}

		$ip = $this->clientIp();
		if (!(new RateLimiter())->allow($ip)) {
			http_response_code(429);
			echo json_encode([
				'ok' => false,
				'error' => 'You have reached the submission limit for this hour. Please try again later.',
			]);
			return;
		}

		$validator = new Validator($_POST);
		$errors = $validator->validateContactForm();
		if (!empty($errors)) {
			http_response_code(422);
			echo json_encode(['ok' => false, 'errors' => $errors]);
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
			]);
			return;
		}

		Csrf::rotate();

		echo json_encode([
			'ok' => true,
			'csrf_token' => Csrf::token(),
		]);
	}

	/**
	 * Resolve the client IP, preferring Cloudflare's forwarded header when behind Cloudflare.
	 */
	private function clientIp(): string
	{
		$candidates = [
			$_SERVER['HTTP_CF_CONNECTING_IP'] ?? null,
			$_SERVER['REMOTE_ADDR'] ?? null,
		];

		foreach ($candidates as $candidate) {
			if ($candidate === null) {
				continue;
			}
			if (filter_var($candidate, FILTER_VALIDATE_IP)) {
				return $candidate;
			}
		}

		return 'unknown';
	}
}
