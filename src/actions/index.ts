// The contact action: validates the form fields, applies the rate limits, verifies the Turnstile token, and sends the message through Mailgun.
import { ActionError, defineAction } from 'astro:actions';
import { z } from 'astro/zod';
import { contactFields, controlCharacter } from '../lib/contact-fields';
import { sendContactMessage } from '../lib/mailgun';
import { admitUnderRateLimits, isDraining, trackInFlight, visitorAddress } from '../lib/submission-guard';
import { verifyTurnstile } from '../lib/turnstile';

export const server = {
	contact: defineAction({
		accept: 'form',
		input: z.object({
			name: z
				.string({ error: contactFields.name.missing })
				.trim()
				.min(1, { error: contactFields.name.missing })
				.max(contactFields.name.maxLength, { error: contactFields.name.tooLong })
				// Rejects a name that contains a C0 control character or DEL.
				.refine((name) => !controlCharacter.test(name), { error: contactFields.name.invalid }),
			email: z
				.string({ error: contactFields.email.missing })
				.trim()
				.min(1, { error: contactFields.email.missing })
				.max(contactFields.email.maxLength, { error: contactFields.email.tooLong })
				.pipe(z.email({ pattern: z.regexes.html5Email, error: contactFields.email.invalid })),
			message: z
				.string({ error: contactFields.message.missing })
				// Converts CRLF and CR line breaks to LF, so each line break counts as one character.
				.overwrite((message) => message.replace(/\r\n?/g, '\n'))
				.trim()
				.min(1, { error: contactFields.message.missing })
				.max(contactFields.message.maxLength, { error: contactFields.message.tooLong }),
			'cf-turnstile-response': z.string().min(1).max(2048)
		}),
		// Handles a validated submission; returning no data makes Astro respond with HTTP 204.
		handler: async (input, context) => {
			if (isDraining()) {
				throw new ActionError({ code: 'SERVICE_UNAVAILABLE' });
			}
			const address = visitorAddress(context);
			if (!admitUnderRateLimits(address)) {
				context.logger.warn('Contact submission rate limited');
				throw new ActionError({ code: 'TOO_MANY_REQUESTS' });
			}
			// Verifies the token and sends the message while the submission counts as in flight.
			await trackInFlight(async () => {
				const turnstile = await verifyTurnstile(input['cf-turnstile-response'], address);
				if (turnstile.outcome === 'rejected') {
					context.logger.warn(`Turnstile rejected the token: ${turnstile.reason}`);
					throw new ActionError({ code: 'FORBIDDEN' });
				}
				if (turnstile.outcome === 'unavailable') {
					context.logger.error(`Turnstile Siteverify unavailable: ${turnstile.reason}`);
					throw new ActionError({ code: 'SERVICE_UNAVAILABLE' });
				}
				const failure = await sendContactMessage(input);
				if (failure) {
					context.logger.error(`Mailgun send failed: ${failure}`);
					throw new ActionError({ code: 'SERVICE_UNAVAILABLE' });
				}
				context.logger.info('Contact message sent');
			});
		}
	})
};
