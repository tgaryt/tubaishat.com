// Sends contact messages through the Mailgun Messages API as plain text, with the visitor's address as Reply-To and click and open tracking off; each message gets one attempt with a 10-second timeout and no retry, because the API has no idempotency parameter for sends and a retry could deliver the message twice.
import { Buffer } from 'node:buffer';
import { CONTACT_FROM_EMAIL, CONTACT_TO_EMAIL, MAILGUN_API_KEY, MAILGUN_DOMAIN, MAILGUN_REGION } from 'astro:env/server';

export interface ContactMessage {
	name: string;
	email: string;
	message: string;
}

const apiBase = { us: 'https://api.mailgun.net', eu: 'https://api.eu.mailgun.net' };

// Sends one contact message and returns undefined when Mailgun accepts it with HTTP 200, otherwise the failure: the HTTP status, "timeout", or "network" for any other failure of the request.
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
