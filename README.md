<!-- Repository guide for the tubaishat.com portfolio: requirements, commands, and how the production server runs. -->

# tubaishat.com

Source code for https://tubaishat.com, the portfolio of Rayyan Tubaishat. The site is built with Astro: its pages are prerendered and served by the standalone Node.js server of the Astro Node.js adapter.

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
| `npm run build` | Checks the project with `astro check` and, if the check passes, builds the site into `dist/` |
| `npm run start` | Starts the production server from `dist/server/entry.mjs` |

`npm run build` needs the development dependencies, so run `npm ci` without `NODE_ENV=production`: with that setting, npm leaves the development dependencies out.

## Production

Production runs the built server under PM2 with `ecosystem.config.cjs`, which starts one process named `tubaishat.com` in fork mode from the repository directory.

First start:

```sh
npm ci
npm run build
pm2 start ecosystem.config.cjs
```

After pulling changes:

```sh
npm ci
npm run build
pm2 restart ecosystem.config.cjs
```

### Listen address

The server listens on `127.0.0.1`, port `4321`. The `HOST` and `PORT` environment variables override the address and the port when the server starts.

### Logs

PM2 writes the server output to `$HOME/.pm2/logs` and prefixes each line with its date and time. `pm2 logs tubaishat.com` shows it.
