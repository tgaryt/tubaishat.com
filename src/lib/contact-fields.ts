// Contact form field limits, error messages, and the characters a name must not contain, shared by the form, its script, and the contact action.
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
