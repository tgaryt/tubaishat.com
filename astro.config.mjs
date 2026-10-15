// Astro configuration: prerendered pages served by the Node.js standalone server, with a sitemap, self-hosted fonts, and a Content Security Policy on every page.
import { defineConfig, fontProviders } from 'astro/config';
import node from '@astrojs/node';
import sitemap from '@astrojs/sitemap';

export default defineConfig({
	site: 'https://tubaishat.com',
	adapter: node({
		mode: 'standalone'
	}),
	integrations: [sitemap()],
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
	},
	fonts: [
		{
			provider: fontProviders.local(),
			name: 'Instrument Sans Variable',
			cssVariable: '--font-sans',
			options: {
				variants: [
					{
						src: ['@fontsource-variable/instrument-sans/files/instrument-sans-latin-wght-normal.woff2'],
						weight: '400 700',
						style: 'normal'
					}
				]
			}
		},
		{
			provider: fontProviders.local(),
			name: 'Instrument Serif',
			cssVariable: '--font-serif',
			fallbacks: ['serif'],
			options: {
				variants: [
					{
						src: ['@fontsource/instrument-serif/files/instrument-serif-latin-400-normal.woff2'],
						weight: 400,
						style: 'normal'
					}
				]
			}
		}
	]
});
