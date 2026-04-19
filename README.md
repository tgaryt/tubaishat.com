# Rayyan Tubaishat

Personal portfolio for Rayyan Tubaishat - Full Stack Developer.

Live: [tubaishat.com](https://tubaishat.com)

## Stack

- PHP 8.4+ with Composer (PSR-4 autoload under `Tubaishat\` namespace)
- Front-controller + simple router pattern (no framework)
- Mailgun PHP SDK 4.4.0 for the contact form
- Tailwind CSS v4.2.2 (npm, built via `@tailwindcss/cli`)
- Vanilla JavaScript (no runtime framework)
- Font Awesome v7.2.0 + Devicon v2.17.0 inline SVG from npm
- sharp v0.34.5 for PWA icon generation
- Google Fonts Inter + JetBrains Mono on CDN (Google's current official snippet)

## Setup

Local development (any OS):

```bash
composer install
npm install
npm run build
cp .env.example .env      # then edit .env with real Mailgun credentials
```

Production server (Linux, once per fresh clone):

```bash
# Make storage/ writable by PHP-FPM (sessions + rate-limit state).
# OWASP recommends 0700 for session directories.
sudo chown -R www-data:www-data storage/
sudo chmod -R 700 storage/
```

## Content updates

All copy lives in `config/site.php`. Edit the arrays there and refresh. Every section is labeled with a banner comment showing what it drives.

## Contact

- GitHub: [@tgaryt](https://github.com/tgaryt)
- LinkedIn: [ry-tubaishat](https://linkedin.com/in/ry-tubaishat)
- Instagram: [@ryt.tbaishat](https://instagram.com/ryt.tbaishat)
- Email: ba8lawa2023@gmail.com

## License

MIT
