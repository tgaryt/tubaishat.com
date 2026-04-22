<?php
declare(strict_types=1);

namespace Tubaishat\Support;

final class Validator
{
	private const INQUIRY_TYPES = ['full_time', 'freelance', 'other'];

	private array $input;
	private array $cleaned = [];

	public function __construct(array $input)
	{
		$this->input = $input;
	}

	/**
	 * Validate the contact form payload. Return an associative array of field => error message for each failure.
	 */
	public function validateContactForm(): array
	{
		$errors = [];

		$name = $this->stringOf('name');
		if ($name === '' || mb_strlen($name) > 100) {
			$errors['name'] = 'Name is required and must not exceed 100 characters.';
		} elseif ($this->hasControlChars($name)) {
			$errors['name'] = 'Name contains invalid characters.';
		}

		$company = $this->stringOf('company');
		if (mb_strlen($company) > 120 || $this->hasControlChars($company)) {
			$errors['company'] = 'Company name is invalid or exceeds 120 characters.';
		}

		$email = $this->stringOf('email');
		if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 254) {
			$errors['email'] = 'A valid email address is required.';
		} elseif ($this->hasControlChars($email)) {
			$errors['email'] = 'Email address contains invalid characters.';
		}

		$inquiryType = $this->stringOf('inquiry_type');
		if (!in_array($inquiryType, self::INQUIRY_TYPES, true)) {
			$errors['inquiry_type'] = 'Please select an inquiry type.';
		}

		$subject = $this->stringOf('subject');
		$subjectLen = mb_strlen($subject);
		if ($subjectLen < 3 || $subjectLen > 150) {
			$errors['subject'] = 'Subject must be between 3 and 150 characters.';
		} elseif ($this->hasControlChars($subject)) {
			$errors['subject'] = 'Subject contains invalid characters.';
		}

		$message = $this->stringOf('message');
		$messageLen = mb_strlen($message);
		if ($messageLen < 10 || $messageLen > 5000) {
			$errors['message'] = 'Message must be between 10 and 5,000 characters.';
		}

		if (empty($errors)) {
			$this->cleaned = [
				'name' => $name,
				'company' => $company,
				'email' => $email,
				'inquiryType' => $inquiryType,
				'subject' => $subject,
				'message' => $message,
			];
		}

		return $errors;
	}

	/**
	 * Return the validated, trimmed fields once validateContactForm has succeeded.
	 */
	public function validated(): array
	{
		return $this->cleaned;
	}

	/**
	 * Coerce a named input to a trimmed string.
	 */
	private function stringOf(string $key): string
	{
		return trim((string) ($this->input[$key] ?? ''));
	}

	/**
	 * Reject CR/LF which would enable header injection when passed to email APIs.
	 */
	private function hasControlChars(string $value): bool
	{
		return preg_match('/[\r\n]/', $value) === 1;
	}
}
