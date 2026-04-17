# Rayyan Tubaishat

Personal portfolio for Rayyan Tubaishat - Full Stack Developer.

Live: [tubaishat.com](https://tubaishat.com)

## Stack

- PHP 8 (vanilla, server-rendered, no framework)
- Tailwind CSS v4 (built via `@tailwindcss/cli`)
- Alpine.js v3 (CDN, for nav menu and typed-text effect)
- Devicon v2.17.0 (CDN, official tech logos)
- Font Awesome v6.7.2 (CDN, generic icons)
- Google Fonts: Inter + JetBrains Mono (preconnect + display=swap)

## Project structure

```
.
├── assets/
│   ├── css/
│   │   ├── input.css            Tailwind entry, theme tokens, base layer
│   │   └── tailwind.min.css     Build output (gitignored, generated)
│   ├── files/                   CV PDF
│   ├── images/                  OG image
│   └── js/
│       └── main.js              Scroll-to-top handler
├── components/
│   ├── header.php               Sticky nav with Alpine mobile menu
│   ├── footer.php               Copyright + social links
│   ├── scroll-top.php           Scroll-to-top button + main.js include
│   └── sections/
│       ├── hero.php             Name, typed role, bio, CTAs
│       ├── about.php            Bio paragraphs, location/education cards, stats
│       ├── experience.php       Timeline cards (EZ-AD TV, UGC-Gaming.NET)
│       ├── skills.php           Four categories with official tech logos
│       └── contact.php          Contact cards grid + mailto CTA
├── config/
│   └── config.php               All site content + constants
├── includes/
│   └── head.php                 Meta, OG, Twitter, JSON-LD, fonts, CDN links
├── favicon.svg                  RT monogram
├── manifest.webmanifest         Web App Manifest
├── robots.txt                   Allow all + sitemap reference
├── sitemap.xml                  Single-page sitemap
├── index.php                    Page entry
└── package.json                 Tailwind CLI build deps
```

## Setup

```bash
# Install build dependencies
npm install

# Build CSS for production (minified)
npm run build:css

# Watch CSS during development
npm run watch:css
```

## Deploy

```bash
# Build CSS
npm run build:css

# Upload via FTP to web root (PHP-FPM serves index.php)
```

## SEO

- Canonical URL on every page
- Open Graph + Twitter Cards complete per each platform's spec
- ProfilePage + Person + WebSite JSON-LD graph (verified against Google's Rich Results Test before deploy)
- XML sitemap at `/sitemap.xml`, referenced from `/robots.txt`

## Content updates

All copy and structure live in `config/config.php`. Edit the arrays there, then refresh.

## Contact

- GitHub: [@tgaryt](https://github.com/tgaryt)
- LinkedIn: [ry-tubaishat](https://linkedin.com/in/ry-tubaishat)
- Instagram: [@ryt.tbaishat](https://instagram.com/ryt.tbaishat)
- Email: ba8lawa2023@gmail.com

## License

MIT
