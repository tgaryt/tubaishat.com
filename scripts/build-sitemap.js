"use strict";

const fs = require("node:fs");
const path = require("node:path");

const configPath = path.join(__dirname, "..", "config", "site.php");
const lastmod = fs.statSync(configPath).mtime.toISOString().slice(0, 10);

const xml = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
\t<url>
\t\t<loc>https://tubaishat.com/</loc>
\t\t<lastmod>${lastmod}</lastmod>
\t</url>
</urlset>
`;

const outputPath = path.join(__dirname, "..", "public", "sitemap.xml");
fs.writeFileSync(outputPath, xml);
console.log("Wrote sitemap.xml with lastmod " + lastmod);
