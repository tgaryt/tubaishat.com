// Astro configuration: the Node.js standalone server, sitemap, fonts, security settings, and environment variable schema.
import { defineConfig, envField, fontProviders, passthroughImageService } from 'astro/config';
import node from '@astrojs/node';
import sitemap from '@astrojs/sitemap';

export default defineConfig({
	site: 'https://tubaishat.com',
	adapter: node({
		mode: 'standalone'
	}),
	integrations: [sitemap()],
	session: false,
	image: {
		service: passthroughImageService()
	},
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
				"form-action 'self'",
				'frame-src https://challenges.cloudflare.com'
			],
			scriptDirective: {
				resources: ["'self'", 'https://challenges.cloudflare.com']
			}
		},
		allowedDomains: [
			{
				hostname: 'tubaishat.com',
				protocol: 'https'
			}
		],
		actionBodySizeLimit: 65536
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
	],
	env: {
		schema: {
			TURNSTILE_SITE_KEY: envField.string({ context: 'client', access: 'public' }),
			TURNSTILE_SECRET_KEY: envField.string({ context: 'server', access: 'secret' }),
			TURNSTILE_EXPECTED_HOSTNAME: envField.string({ context: 'server', access: 'public', default: 'tubaishat.com' }),
			MAILGUN_API_KEY: envField.string({ context: 'server', access: 'secret' }),
			MAILGUN_DOMAIN: envField.string({ context: 'server', access: 'public' }),
			MAILGUN_REGION: envField.enum({ context: 'server', access: 'public', values: ['us', 'eu'] }),
			CONTACT_FROM_EMAIL: envField.string({ context: 'server', access: 'secret' }),
			CONTACT_TO_EMAIL: envField.string({ context: 'server', access: 'secret' })
		},
		validateSecrets: true
	}
});
