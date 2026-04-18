"use strict";

const fs = require("node:fs");
const path = require("node:path");
const sharp = require("sharp");

const publicRoot = path.join(__dirname, "..", "public");
const sourceSvg = path.join(publicRoot, "favicon.svg");

if (!fs.existsSync(sourceSvg)) {
	console.error("MISSING source favicon at " + sourceSvg);
	process.exit(1);
}

const svgBuffer = fs.readFileSync(sourceSvg);

const DARK_BACKGROUND = { r: 2, g: 6, b: 23, alpha: 1 };
const TRANSPARENT = { r: 0, g: 0, b: 0, alpha: 0 };
const MASKABLE_SAFE_ZONE_RATIO = 0.2;
const SVG_DENSITY = 1024;

const standardTargets = [
	{ size: 32, file: "favicon-32.png", background: DARK_BACKGROUND, flatten: true },
	{ size: 180, file: "apple-touch-icon.png", background: DARK_BACKGROUND, flatten: true },
	{ size: 192, file: "icon-192.png", background: TRANSPARENT, flatten: false },
	{ size: 512, file: "icon-512.png", background: TRANSPARENT, flatten: false },
];

async function buildStandard(target) {
	let pipeline = sharp(svgBuffer, { density: SVG_DENSITY })
		.resize(target.size, target.size, {
			fit: "contain",
			background: target.background,
		});

	if (target.flatten) {
		pipeline = pipeline.flatten({ background: target.background });
	}

	await pipeline.png({ compressionLevel: 9 }).toFile(path.join(publicRoot, target.file));
}

async function buildMaskable() {
	const size = 512;
	const padding = Math.round(size * MASKABLE_SAFE_ZONE_RATIO);
	const inner = size - padding * 2;

	const innerIcon = await sharp(svgBuffer, { density: SVG_DENSITY })
		.resize(inner, inner, {
			fit: "contain",
			background: TRANSPARENT,
		})
		.png()
		.toBuffer();

	await sharp({
		create: {
			width: size,
			height: size,
			channels: 4,
			background: DARK_BACKGROUND,
		},
	})
		.composite([{ input: innerIcon, top: padding, left: padding }])
		.png({ compressionLevel: 9 })
		.toFile(path.join(publicRoot, "icon-512-maskable.png"));
}

(async () => {
	for (const target of standardTargets) {
		await buildStandard(target);
	}
	await buildMaskable();
	console.log("Wrote " + (standardTargets.length + 1) + " favicon PNGs to public/");
})();
