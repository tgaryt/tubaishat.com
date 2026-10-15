// Rules of the contact form fields, shared by the form, its script, and the contact action so that the browser and the server check the same limits and show the same messages: each field's maximum length in characters and its error messages, and the C0 control characters and DEL that a name must not contain.
export const contactFields = {
	name: {
		maxLength: 100,
		missing: 'Enter your name.',
		tooLong: 'Name must be 100 characters or fewer.',
		invalid: 'Enter a valid name.'
	},
	email: {
		maxLength: 254,
		missing: 'Enter your email address.',
		tooLong: 'Email address must be 254 characters or fewer.',
		invalid: 'Enter an email address in the format name@example.com.'
	},
	message: {
		maxLength: 5000,
		missing: 'Enter a message.',
		tooLong: 'Message must be 5000 characters or fewer.'
	}
} as const;

export const controlCharacter = /[\x00-\x1F\x7F]/;
