"use strict";

const fs = require("node:fs");
const path = require("node:path");

const manifestPath = path.join(__dirname, "icons.json");
const sourceRoot = path.join(__dirname, "..", "node_modules");
const destRoot = path.join(__dirname, "..", "assets", "icons");

const manifest = JSON.parse(fs.readFileSync(manifestPath, "utf8"));

fs.mkdirSync(destRoot, { recursive: true });

const existing = new Set(fs.readdirSync(destRoot));
const expected = new Set(Object.keys(manifest).map(function (name) {
	return name + ".svg";
}));

for (const file of existing) {
	if (!expected.has(file)) {
		fs.unlinkSync(path.join(destRoot, file));
	}
}

let written = 0;
const missing = [];

for (const [name, sourcePath] of Object.entries(manifest)) {
	const src = path.join(sourceRoot, sourcePath);
	const dst = path.join(destRoot, name + ".svg");

	if (!fs.existsSync(src)) {
		missing.push(name + " -> " + sourcePath);
		continue;
	}

	fs.copyFileSync(src, dst);
	written += 1;
}

console.log("Wrote " + written + " icons to assets/icons/");

if (missing.length > 0) {
	console.error("MISSING " + missing.length + " icons:");
	for (const line of missing) {
		console.error("  " + line);
	}
	process.exit(1);
}
