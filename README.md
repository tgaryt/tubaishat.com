<!-- Repository guide for the tubaishat.com portfolio: requirements, commands, environment variables, local testing, and how the production server runs, shuts down, and logs. -->

# tubaishat.com

Source code for https://tubaishat.com, the portfolio of Rayyan Tubaishat. The site is built with Astro: its pages are prerendered and served by the standalone Node.js server of the Astro Node.js adapter, which also runs the server action of the contact form. The form is protected by Cloudflare Turnstile and sends messages through Mailgun.

## Requirements

- Node.js 24 LTS, version 24.11.0 or later
- npm 11 or later

`package.json` sets these minimums in `devEngines` (`node` `>=24.11.0`, `npm` `>=11.0.0`); npm 11 and later check them before `install`, `ci`, and `run` commands and stop when a version is lower.

## Commands

Run every command from the repository root.

| Command | Action |
| --- | --- |
| `npm ci` | Installs the exact dependency tree recorded in `package-lock.json` |
| `npm run dev` | Starts the Astro development server at `http://127.0.0.1:4321` (the next free port if 4321 is in use) |
| `npm run build` | Checks the project with `astro check` and, if the check passes, builds the site into `dist/` with the environment variables in `.env` |
| `npm run start` | Starts the production server from `dist/server/entry.mjs` with the environment variables in `.env` |

`npm run build` needs the development dependencies, so run `npm ci` without `NODE_ENV=production`: with that setting, npm leaves the development dependencies out.

## Environment variables

`.env.example` lists the eight environment variables of the contact form with their purposes. Copy it to `.env` in the repository root, which Git ignores, and fill in the values. An empty value counts as unset: `TURNSTILE_EXPECTED_HOSTNAME` is then `tubaishat.com`, and every other variable is required.

- `npm run build` reads `.env` and stops with an error when a variable is missing or invalid. It builds `TURNSTILE_SITE_KEY` into the page script, the only value sent to browsers, and `TURNSTILE_EXPECTED_HOSTNAME`, `MAILGUN_DOMAIN`, and `MAILGUN_REGION` into the server.
- The server reads `TURNSTILE_SECRET_KEY`, `MAILGUN_API_KEY`, `CONTACT_FROM_EMAIL`, and `CONTACT_TO_EMAIL` when it runs. `npm run start` and `ecosystem.config.cjs` load `.env` from the repository directory with the Node.js option `--env-file=.env`; the server does not start without that file, and variables that are already set in the environment take precedence over it.
- After changing `.env`, run `npm run build` and restart the server.

## Local testing

Cloudflare's test keys let the form work on `http://127.0.0.1:4321` without real challenges. The local `.env` uses the test sitekey and the test secret key that always pass, and `example.com`, the hostname that Turnstile reports when a test secret key validates a token:

```
TURNSTILE_SITE_KEY=1x00000000000000000000AA
TURNSTILE_SECRET_KEY=1x0000000000000000000000000000000AA
TURNSTILE_EXPECTED_HOSTNAME=example.com
```

The other variables hold real values, so a test submission sends a real email. The production `.env` holds the sitekey and secret key of the site's Turnstile widget, whose hostnames include `tubaishat.com`, and leaves `TURNSTILE_EXPECTED_HOSTNAME` empty.

## Production

Production runs the built server under PM2 with `ecosystem.config.cjs`, which starts one process named `tubaishat.com` in fork mode from the repository directory with the variables in `.env`.

First start:

```sh
npm ci
npm run build
pm2 start ecosystem.config.cjs
```

After pulling changes or editing `.env`:

```sh
npm ci
npm run build
pm2 restart ecosystem.config.cjs
```

### Runtime contract

- The server listens on `127.0.0.1`, port `4321`. The `HOST` and `PORT` environment variables override the address and the port when the server starts.
- The reverse proxy in front of the server passes the original `Host` header (`tubaishat.com`) and the `X-Forwarded-Proto` and `CF-Connecting-IP` headers that Cloudflare adds. Astro trusts `Host` and `X-Forwarded-Proto` only when they describe `https://tubaishat.com`, which keeps its check that form submissions come from the site itself correct behind the proxy, and the rate limits count submissions per `CF-Connecting-IP` address.
- The rate limits and the count of submissions in flight are kept in memory, so the site runs as exactly one process.

### Shutdown

On SIGINT, which PM2 sends to stop or restart the process, or on SIGTERM, the server stops accepting contact submissions and logs how many are in flight. It exits with code 0 at once when none is in flight, otherwise about one second after the last one has finished. `ecosystem.config.cjs` gives the process 25 seconds before PM2 forces it to stop. The server installs this shutdown when the first request to the contact action loads the action's code; before that, the signal ends the server at once.

### Logs

PM2 writes the server output to `$HOME/.pm2/logs` and prefixes each line with its date and time. `pm2 logs tubaishat.com` shows it. The contact action logs each outcome without names, email addresses, message text, tokens, IP addresses, or keys: a sent message; a rate-limited submission; a Turnstile token that Siteverify rejected, with its error codes or "hostname mismatch"; Siteverify unavailable, with the HTTP status, "internal-error", "timeout", or "network"; and a failed Mailgun send, with the HTTP status, "timeout", or "network".
