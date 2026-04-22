(() => {
	const form = document.getElementById('contactForm');
	if (!form) {
		return;
	}

	const statusRegion = document.getElementById('contactStatus');
	const submitButton = form.querySelector('button[type="submit"]');

	const setStatus = (message, kind) => {
		if (!statusRegion) {
			return;
		}
		statusRegion.textContent = message;
		statusRegion.dataset.status = kind;
	};

	const setSubmitting = (submitting) => {
		if (submitButton) {
			submitButton.disabled = submitting;
		}
	};

	const clearFieldErrors = () => {
		form.querySelectorAll('[data-error]').forEach((el) => {
			el.textContent = '';
		});
		form.querySelectorAll('[aria-invalid="true"]').forEach((input) => {
			input.setAttribute('aria-invalid', 'false');
		});
	};

	const showFieldErrors = (errors) => {
		for (const [field, message] of Object.entries(errors)) {
			const escaped = CSS.escape(field);
			const errorEl = form.querySelector(`[data-error="${escaped}"]`);
			const input = form.querySelector(`[name="${escaped}"]`);
			if (errorEl) {
				errorEl.textContent = message;
			}
			if (input) {
				input.setAttribute('aria-invalid', 'true');
			}
		}
	};

	form.addEventListener('submit', async (event) => {
		event.preventDefault();
		clearFieldErrors();
		setStatus('Sending your message...', 'pending');
		setSubmitting(true);

		const formData = new FormData(form);

		try {
			const response = await fetch(form.action, {
				method: 'POST',
				body: formData,
				headers: { Accept: 'application/json' },
			});
			const contentType = response.headers.get('Content-Type') ?? '';
			if (!contentType.includes('application/json')) {
				setStatus('An unexpected error occurred. Please try again later.', 'error');
				return;
			}
			const data = await response.json();

			if (response.ok && data.ok) {
				setStatus('Your message has been sent. I will get back to you as soon as possible.', 'success');
				form.reset();
				if (data.csrf_token) {
					const csrfInput = form.querySelector('input[name="_csrf"]');
					if (csrfInput) {
						csrfInput.value = data.csrf_token;
					}
				}
			} else if (response.status === 422 && data.errors) {
				showFieldErrors(data.errors);
				setStatus('Please correct the highlighted fields and try again.', 'error');
			} else if (response.status === 429) {
				setStatus(data.error ?? 'The hourly submission limit has been reached. Please try again later.', 'error');
			} else if (response.status === 419) {
				setStatus(data.error ?? 'Your session has expired. Please refresh the page and try again.', 'error');
			} else {
				setStatus(data.error ?? 'An unexpected error occurred. Please try again later.', 'error');
			}
		} catch (_error) {
			setStatus('Unable to reach the server. Please check your connection and try again.', 'error');
		} finally {
			setSubmitting(false);
		}
	});
})();
