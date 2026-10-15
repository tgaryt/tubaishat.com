// Astro configuration: prerendered pages served by the Node.js standalone server, with a Content Security Policy on every page.
import { defineConfig } from 'astro/config';
import node from '@astrojs/node';

export default defineConfig({
	site: 'https://tubaishat.com',
	adapter: node({
		mode: 'standalone'
	}),
	session: false,
	markdown: {
		syntaxHighlight: false
	},
	server: {
		host: '127.0.0.1'
	},
	security: {
		csp: {
			directives: [
				"default-src 'self'",
				"base-uri 'none'",
				"object-src 'none'",
				"form-action 'self'"
			]
		}
	}
});
