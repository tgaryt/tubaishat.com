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
	{ size: 48, file: "favicon-48.png", background: DARK_BACKGROUND, flatten: true },
	{ size: 180, file: "apple-touch-icon.png", background: DARK_BACKGROUND, flatten: true },
	{ size: 192, file: "icon-192.png", background: TRANSPARENT, flatten: false },
	{ size: 512, file: "icon-512.png", background: TRANSPARENT, flatten: false },
];

const maskableTargets = [
	{ size: 192, file: "icon-192-maskable.png" },
	{ size: 512, file: "icon-512-maskable.png" },
];

/**
 * Rasterize the source SVG to a PNG of the given target size, flattening transparent corners onto a dark background when requested.
 */
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

/**
 * Build a maskable icon of the given size by centering the SVG content inside a safe zone on a full-bleed dark square, per web.dev's Android adaptive-icon spec.
 */
async function buildMaskable(target) {
	const padding = Math.round(target.size * MASKABLE_SAFE_ZONE_RATIO);
	const inner = target.size - padding * 2;

	const innerIcon = await sharp(svgBuffer, { density: SVG_DENSITY })
		.resize(inner, inner, {
			fit: "contain",
			background: TRANSPARENT,
		})
		.png()
		.toBuffer();

	await sharp({
		create: {
			width: target.size,
			height: target.size,
			channels: 4,
			background: DARK_BACKGROUND,
		},
	})
		.composite([{ input: innerIcon, top: padding, left: padding }])
		.png({ compressionLevel: 9 })
		.toFile(path.join(publicRoot, target.file));
}

(async () => {
	for (const target of standardTargets) {
		await buildStandard(target);
	}
	for (const target of maskableTargets) {
		await buildMaskable(target);
	}
	console.log("Wrote " + (standardTargets.length + maskableTargets.length) + " favicon PNGs to public/");
})();
