<!-- Repository guide for the tubaishat.com portfolio: the stack, the repository layout and build output, requirements, commands, environment variables, local testing, production (setup, updates, PM2, the Nginx server block in tubaishat.com.conf, the Cloudflare and Mailgun settings, the runtime contract, shutdown, and logs), and how the contact form handles a message. -->

# tubaishat.com

Source code for https://tubaishat.com, the portfolio of Rayyan Tubaishat. The site has two pages: the home page, with an introduction and the About, Experience, Skills, and Let's Talk sections, where Let's Talk holds a contact form and the direct contact details; and a 404 page.

The site is built with Astro. Both pages are prerendered at build time and served by the standalone Node.js server of the Astro Node.js adapter, which also runs the server action of the contact form. The form is protected by Cloudflare Turnstile and sends each message by email through Mailgun. The site stores no messages and has no database, analytics, or tracking. Apart from its own files, the page loads only the Turnstile widget from `challenges.cloudflare.com`, and only after a visitor first interacts with the form.

## Repository layout

| Path | Contents |
| --- | --- |
| `src/pages/index.astro` | The home page: its title, description, canonical URL, Open Graph metadata, WebSite structured data, and the five sections in page order |
| `src/pages/404.astro` | The error page, which the server sends with status 404 for every unknown URL |
| `src/layouts/BaseLayout.astro` | The document shell of both pages: head elements, icons, preloaded fonts, skip link, site header, main content, and site footer |
| `src/components/` | `SiteHeader.astro` and `SiteFooter.astro`; the sections `Hero.astro`, `About.astro`, `Experience.astro`, `Skills.astro`, and `LetsTalk.astro`; and `ContactForm.astro`, with the script that checks and sends the form |
| `src/data/profile.ts` | The portfolio content: name, professional title, location, hero text, About text and facts, experience, skills, and contact channels |
| `src/actions/index.ts` | The contact action: field validation, rate limits, Turnstile verification, and the Mailgun send |
| `src/lib/contact-fields.ts` | Field limits and error messages, shared by the form, its script, and the contact action |
| `src/lib/submission-guard.ts` | The visitor's IP address, the rate limits, the count of submissions in flight, and the graceful shutdown |
| `src/lib/turnstile.ts` | Token verification with the Turnstile Siteverify API |
| `src/lib/mailgun.ts` | The send through the Mailgun Messages API |
| `src/styles/global.css` | Design tokens and the styles shared by every page |
| `public/` | `robots.txt`, `favicon.ico`, `favicon.svg`, `apple-touch-icon.png`, and `og-image.png`, copied unchanged into the build |
| `astro.config.mjs` | Astro configuration: site address, Node.js adapter and listen address, sitemap, fonts, Content Security Policy, request checks of the contact action, and the schema of the environment variables |
| `ecosystem.config.cjs` | PM2 process file for production |
| `tubaishat.com.conf` | Nginx server block for production |
| `.env.example` | The environment variables with their purposes, without values |
| `package.json`, `package-lock.json` | Scripts, the required Node.js and npm versions, and the exact dependency tree |
| `tsconfig.json` | TypeScript settings for Astro, `astro check`, and editors |
| `.npmrc` | npm setting that saves every added dependency with its exact version |
| `.gitignore` | The paths Git ignores: `dist/`, `.astro/`, `node_modules/`, and `.env` |

`npm run build` writes the site to `dist/`. `dist/client/` holds the prerendered `index.html` and `404.html`, the sitemap (`sitemap-index.xml` and `sitemap-0.xml`), the files from `public/`, and the hashed scripts, styles, and fonts in `_astro/`; `dist/server/entry.mjs` starts the server.

## Requirements

- Node.js 24 LTS, version 24.11.0 or later
- npm 11 or later

`package.json` sets these minimums in `devEngines`; npm checks them before `install`, `ci`, and `run` and stops with an error when a version is lower.

## Commands

Run every command from the repository root.

| Command | Action |
| --- | --- |
| `npm ci` | Removes `node_modules` and installs the exact dependency tree recorded in `package-lock.json`; stops with an error when `package.json` and `package-lock.json` do not match |
| `npm run dev` | Starts the Astro development server at `http://127.0.0.1:4321`, or on the next free port when 4321 is in use |
| `npm run build` | Checks the project with `astro check` and, when the check passes, builds the site into `dist/` with the values in `.env` |
| `npm run start` | Starts the built server from `dist/server/entry.mjs` with the values in `.env` |

`npm run build` needs the development dependencies, so run `npm ci` without `NODE_ENV=production`: with that setting, npm leaves them out.

## Environment variables

`.env.example` lists the eight variables of the contact form with their purposes. Copy it to `.env` in the repository root, which Git ignores, and fill in the values.

| Variable | Read | Purpose |
| --- | --- | --- |
| `TURNSTILE_SITE_KEY` | At build | Sitekey of the form's Turnstile widget, built into the page script; the only value that reaches browsers |
| `TURNSTILE_SECRET_KEY` | At run time | Secret key with which the server validates widget tokens |
| `TURNSTILE_EXPECTED_HOSTNAME` | At build | Hostname that Turnstile must report for a valid token; `tubaishat.com` when empty |
| `MAILGUN_API_KEY` | At run time | Domain Sending Key of the Mailgun sending domain |
| `MAILGUN_DOMAIN` | At build | Mailgun sending domain |
| `MAILGUN_REGION` | At build | Region of the sending domain: `us` or `eu` |
| `CONTACT_FROM_EMAIL` | At run time | Sender address of the messages, on the sending domain |
| `CONTACT_TO_EMAIL` | At run time | Inbox that receives the messages |

- An empty value counts as unset. Every variable except `TURNSTILE_EXPECTED_HOSTNAME` is required, and `npm run build` stops with an error when one is missing or invalid.
- `npm run build` reads `.env` and builds the build-time values into `dist/`.
- The server reads the run-time values from its environment. `npm run start` and `ecosystem.config.cjs` start Node.js with `--env-file=.env`, which loads `.env` from the repository directory; the server does not start without that file.
- A variable that is already set in the environment takes precedence over `.env`, for the build and for the server.
- After changing `.env`, run `npm run build` and restart the server.

## Local testing

The site's Turnstile widget works only on its listed hostnames, so local testing uses Cloudflare's test keys: the test sitekey and secret key that always pass, and `example.com`, the hostname that Turnstile reports for tokens validated with a test secret key. With these lines in the local `.env`, the form works on `http://127.0.0.1:4321`:

```
TURNSTILE_SITE_KEY=1x00000000000000000000AA
TURNSTILE_SECRET_KEY=1x0000000000000000000000000000000AA
TURNSTILE_EXPECTED_HOSTNAME=example.com
```

The Mailgun and contact variables hold real values, so a test submission sends a real email.

## Production

Requests reach the site through Cloudflare, Nginx, and the Astro server:

- Cloudflare proxies `tubaishat.com`, redirects `http://` and `www.tubaishat.com` requests to `https://tubaishat.com/`, and connects to the server with HTTPS on port 443.
- Nginx, configured by `tubaishat.com.conf`, accepts these connections with a Cloudflare Origin CA certificate and passes every request to the Astro server.
- PM2, configured by `ecosystem.config.cjs`, runs the Astro server on `127.0.0.1:4321`.

### Setup

On the server, with Node.js 24 LTS, npm, and PM2 installed, create `.env` in the repository directory from `.env.example` with the production values: the sitekey and secret key of the site's Turnstile widget, an empty `TURNSTILE_EXPECTED_HOSTNAME`, and the real Mailgun and contact values. Then install, build, and start the site:

```sh
npm ci
npm run build
pm2 start ecosystem.config.cjs
```

To make PM2 start the site again after a reboot, run `pm2 startup` and then the command it prints, and save the running process list with `pm2 save`. After an upgrade of Node.js, run `pm2 unstartup` and `pm2 startup` again, each followed by the command it prints.

The Nginx server block and the Cloudflare settings that the site needs are described below.

### Updates

After pulling changes or editing `.env`:

```sh
npm ci
npm run build
pm2 restart ecosystem.config.cjs
```

The build empties `dist/` before it writes the new files, so the running site cannot serve its pages until the build has finished. Restart right after the build: a build can give the server's files new names, and the running server loads some of them only when they are first needed.

### PM2

`ecosystem.config.cjs` defines one process named `tubaishat.com`, which runs `dist/server/entry.mjs`:

- `exec_mode: 'fork'` and `instances: 1` run exactly one process, because the rate limits and the count of submissions in flight are kept in memory.
- `cwd: __dirname` starts it from the repository directory, where `node_args: '--env-file=.env'` finds `.env`.
- `time: true` prefixes each log line with its date and time.
- `kill_timeout: 25000`: to stop or restart the process, PM2 sends SIGINT, and SIGKILL if the process is still running 25 seconds later.

### Nginx

`tubaishat.com.conf` is the Nginx server block of the site:

- It listens on port 443 with TLS, on IPv4 and IPv6, for the host name `tubaishat.com`.
- It uses the Cloudflare Origin CA certificate `/etc/ssl/tubaishat.com/origin.pem` and its private key `/etc/ssl/tubaishat.com/origin.key`.
- It passes every request, with its URI unchanged, to `http://127.0.0.1:4321`. `proxy_set_header Host $host` keeps the original `Host` header, which Nginx would otherwise replace with `127.0.0.1:4321`; the other request headers, including `CF-Connecting-IP` and `X-Forwarded-Proto`, pass unchanged.
- It keeps two Nginx defaults that suit the site: `client_max_body_size` 1 MB, above the 64 KiB limit of the contact action, and `proxy_read_timeout` 60 seconds, above the longest run of the contact action, about 20 seconds (two Turnstile attempts of up to 5 seconds and one Mailgun attempt of up to 10 seconds).

To install it on the server:

1. In the Cloudflare dashboard, on the Origin Server page of SSL/TLS, create an Origin CA certificate with the key format PEM. Save the certificate as `/etc/ssl/tubaishat.com/origin.pem` and the private key as `/etc/ssl/tubaishat.com/origin.key`; Cloudflare shows the private key only on that screen and sends no notice before the certificate expires.
2. Make the private key readable only by its owner, root: `sudo chmod 600 /etc/ssl/tubaishat.com/origin.key`.
3. Copy `tubaishat.com.conf` into a directory that the server's `nginx.conf` includes, such as `/etc/nginx/conf.d/`.
4. Check the configuration with `sudo nginx -t`, which checks the syntax and opens the files that the configuration refers to, then load it with `sudo nginx -s reload`. When a reloaded configuration fails, Nginx keeps working with the old one.
5. In the server's firewall, allow Cloudflare's IP ranges (https://www.cloudflare.com/ips/) to port 443 and block other sources, as Cloudflare recommends.

On the server, this command prints `200` when Nginx and the Astro server work; `-k` is needed because only Cloudflare trusts the Origin CA certificate:

```sh
curl -sk --resolve tubaishat.com:443:127.0.0.1 -o /dev/null -w "%{http_code}\n" https://tubaishat.com/
```

### Cloudflare

The site relies on these settings of the `tubaishat.com` zone:

- SSL/TLS encryption mode Full (strict), which requires a valid certificate on the server: here the unexpired Origin CA certificate for `tubaishat.com`.
- Always Use HTTPS, which redirects every `http://` request to `https://`, and the redirect of `www.tubaishat.com` to `https://tubaishat.com/`.
- Email Address Obfuscation off. When it is on, Cloudflare replaces the email address on the page and its `mailto:` link with an encoded link and adds a script that decodes it.
- Web Analytics disabled for `tubaishat.com` (Manage site, Disable). Its automatic setup injects a beacon script into the pages, which the site's Content Security Policy blocks.
- Network Error Logging off (Network, Network Error Logging Monitoring). When it is on, response headers make browsers report network errors to Cloudflare.
- Turnstile: the hostname list of the site's widget includes `tubaishat.com`, and the widget's sitekey and secret key are in the production `.env`.

Mailgun sends from the domain in `MAILGUN_DOMAIN`, in the region in `MAILGUN_REGION`. `MAILGUN_API_KEY` is a Domain Sending Key of that domain, which can only send messages.

### Runtime contract

- The server listens on `127.0.0.1`, port `4321`. The `HOST` and `PORT` environment variables override the address and the port when the server starts; an empty `HOST` makes it listen on all network interfaces.
- The reverse proxy in front of the server passes the original `Host` header (`tubaishat.com`) and the `X-Forwarded-Proto` and `CF-Connecting-IP` headers that Cloudflare adds. Astro trusts `Host` and `X-Forwarded-Proto` only when they describe `https://tubaishat.com`, which keeps its check that form submissions come from the site itself correct behind the proxy, and the per-visitor rate limit counts submissions per `CF-Connecting-IP` address.
- The rate limits and the count of submissions in flight are kept in memory, so the site runs as exactly one process.

### Shutdown

On SIGINT, which PM2 sends to stop or restart the process, or on SIGTERM, the server stops accepting contact submissions and logs how many are in flight. It exits with code 0 at once when none is in flight, otherwise about one second after the last one has finished. The server installs this shutdown when the first request to the contact action loads the action's code; before that, the signal ends the server at once.

### Logs

PM2 writes the server output to `$HOME/.pm2/logs`; `pm2 logs tubaishat.com` shows it. The contact action logs these outcomes, without names, email addresses, message text, tokens, IP addresses, or keys: a sent message; a rate-limited submission; a rejected Turnstile token, with Siteverify's error codes or "hostname mismatch"; Siteverify unavailable, with the HTTP status, "internal-error", "timeout", or "network"; and a failed Mailgun send, with the HTTP status, "timeout", or "network".

## Contact form

1. The browser checks the fields with the limits and messages that the server uses: a name of up to 100 characters with no C0 control character or DEL, an email address of up to 254 characters in the HTML email syntax, and a message of up to 5000 characters, all required.
2. The first interaction with the form loads the Turnstile widget in its dark theme; a submission waits for its token.
3. The script sends the fields and the token to the contact action at `/_actions/contact`. Before the action runs, Astro rejects cross-site form submissions (403), bodies over 64 KiB (413), and bodies that are not form data (415); invalid fields return 400 with a message for each invalid field.
4. The action refuses submissions during a shutdown (503) and above the rate limits (429): 5 per visitor IP address and 30 in total, each per fixed 60-minute window. Rate limits count every submission with valid fields, before Turnstile.
5. It verifies the token with Siteverify, with a 5-second timeout, and once more with the same idempotency key after a timeout, a network failure, an HTTP 5xx status, or an internal-error result. A rejected token or a hostname other than the expected one returns 403, and Siteverify unavailable returns 503.
6. It sends the message through Mailgun as plain text from "tubaishat.com contact form" at `CONTACT_FROM_EMAIL` to `CONTACT_TO_EMAIL`, with the subject "Portfolio message from" and the name, the visitor's address as Reply-To, and click and open tracking off. The send has a 10-second timeout and no retry, because Mailgun's send API has no idempotency parameter and a retry could deliver the message twice. Mailgun's acceptance returns 204, and any failure 503.
7. The form shows the result, clears the fields only after success, and resets the widget after every attempt, because each token can be validated only once.
