// Sends contact messages through the Mailgun Messages API.
import { Buffer } from 'node:buffer';
import { CONTACT_FROM_EMAIL, CONTACT_TO_EMAIL, MAILGUN_API_KEY, MAILGUN_DOMAIN, MAILGUN_REGION } from 'astro:env/server';

interface ContactMessage {
	name: string;
	email: string;
	message: string;
}

const apiBase = { us: 'https://api.mailgun.net', eu: 'https://api.eu.mailgun.net' };

// Sends one message with a 10-second timeout and no retry; returns undefined on HTTP 200, otherwise the failure reason.
export async function sendContactMessage({ name, email, message }: ContactMessage): Promise<string | undefined> {
	const body = new FormData();
	body.set('from', `"tubaishat.com contact form" <${CONTACT_FROM_EMAIL}>`);
	body.set('to', CONTACT_TO_EMAIL);
	body.set('subject', `Portfolio message from ${name}`);
	body.set('text', `Name: ${name}\nEmail: ${email}\n\n${message}\n\nSent from the contact form at https://tubaishat.com`);
	body.set('h:Reply-To', email);
	body.set('o:tracking-clicks', 'no');
	body.set('o:tracking-opens', 'no');
	try {
		const response = await fetch(`${apiBase[MAILGUN_REGION]}/v3/${MAILGUN_DOMAIN}/messages`, {
			method: 'POST',
			headers: { Authorization: `Basic ${Buffer.from(`api:${MAILGUN_API_KEY}`).toString('base64')}` },
			body,
			signal: AbortSignal.timeout(10000)
		});
		await response.body?.cancel();
		return response.status === 200 ? undefined : `HTTP ${response.status}`;
	} catch (error) {
		return error instanceof DOMException && error.name === 'TimeoutError' ? 'timeout' : 'network';
	}
}
