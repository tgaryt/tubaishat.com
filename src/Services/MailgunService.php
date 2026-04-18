<?php
declare(strict_types=1);

namespace Tubaishat\Services;

use Mailgun\Mailgun;

final class MailgunService
{
	private const INQUIRY_LABELS = [
		'full_time' => 'Full-time opportunity',
		'freelance' => 'Freelance project',
		'other' => 'Other',
	];

	private const US_ENDPOINT = 'https://api.mailgun.net';
	private const EU_ENDPOINT = 'https://api.eu.mailgun.net';

	private Mailgun $mg;

	public function __construct()
	{
		$endpoint = $_ENV['MAILGUN_REGION'] === 'eu' ? self::EU_ENDPOINT : self::US_ENDPOINT;
		$this->mg = Mailgun::create($_ENV['MAILGUN_API_KEY'], $endpoint);
	}

	/**
	 * Send the validated contact form payload to the site owner via Mailgun's messages API.
	 */
	public function sendContactForm(array $data): void
	{
		$inquiry = self::INQUIRY_LABELS[$data['inquiryType']] ?? 'Other';
		$company = $data['company'] !== '' ? $data['company'] : 'Not provided';

		$fields = [
			'name' => $data['name'],
			'email' => $data['email'],
			'company' => $company,
			'inquiry' => $inquiry,
			'subject' => $data['subject'],
			'message' => $data['message'],
		];

		$this->mg->messages()->send($_ENV['MAILGUN_DOMAIN'], [
			'from' => sprintf('%s <%s>', $_ENV['MAIL_FROM_NAME'], $_ENV['MAIL_FROM_ADDRESS']),
			'to' => $_ENV['MAIL_TO_ADDRESS'],
			'subject' => '[Contact] ' . $data['subject'],
			'text' => $this->renderText($fields),
			'html' => $this->renderHtml($fields),
			'h:Reply-To' => $data['email'],
		]);
	}

	/**
	 * Build the plain-text email body with user fields interpolated as-is.
	 */
	private function renderText(array $fields): string
	{
		return <<<TEXT
New inquiry from tubaishat.com contact form

Name:    {$fields['name']}
Email:   {$fields['email']}
Company: {$fields['company']}
Type:    {$fields['inquiry']}

Subject: {$fields['subject']}

Message:
{$fields['message']}
TEXT;
	}

	/**
	 * Build the HTML email body with every user-supplied field escaped for safe rendering.
	 */
	private function renderHtml(array $fields): string
	{
		$escaped = [];
		foreach ($fields as $key => $value) {
			$escaped[$key] = htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8');
		}
		$message = nl2br($escaped['message']);

		return <<<HTML
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>New inquiry from tubaishat.com</title>
</head>
<body style="font-family:Arial,sans-serif;line-height:1.5;color:#111;">
<h2 style="margin:0 0 16px;">New inquiry from tubaishat.com</h2>
<table cellpadding="6" cellspacing="0" style="border-collapse:collapse;">
<tr><td><strong>Name</strong></td><td>{$escaped['name']}</td></tr>
<tr><td><strong>Email</strong></td><td><a href="mailto:{$escaped['email']}">{$escaped['email']}</a></td></tr>
<tr><td><strong>Company</strong></td><td>{$escaped['company']}</td></tr>
<tr><td><strong>Type</strong></td><td>{$escaped['inquiry']}</td></tr>
<tr><td><strong>Subject</strong></td><td>{$escaped['subject']}</td></tr>
</table>
<hr>
<p>{$message}</p>
</body>
</html>
HTML;
	}
}
