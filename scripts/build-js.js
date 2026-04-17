"use strict";

const fs = require("node:fs");
const path = require("node:path");

const sourceRoot = path.join(__dirname, "..", "node_modules");
const destRoot = path.join(__dirname, "..", "assets", "js");

const targets = [
	{
		src: path.join(sourceRoot, "alpinejs", "dist", "cdn.min.js"),
		dst: path.join(destRoot, "alpine.min.js"),
		label: "alpinejs",
	},
];

fs.mkdirSync(destRoot, { recursive: true });

let written = 0;
const missing = [];

for (const target of targets) {
	if (!fs.existsSync(target.src)) {
		missing.push(target.label + " -> " + target.src);
		continue;
	}

	fs.copyFileSync(target.src, target.dst);
	written += 1;
}

console.log("Wrote " + written + " JS files to assets/js/");

if (missing.length > 0) {
	console.error("MISSING " + missing.length + " files:");
	for (const line of missing) {
		console.error("  " + line);
	}
	process.exit(1);
}
