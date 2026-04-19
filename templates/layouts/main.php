<?php
declare(strict_types=1);

use Tubaishat\Support\Csp;

$contact_info = $site['contact_info'];
$meta = $site['meta'];
$about = $site['about'];
$experience = $site['experience'];
$skills = $site['skills'];
$contact = $site['contact'];
$footer = $site['footer'];
$navigation_links = $site['navigation_links'];
$hero = $site['hero'];

$canonical_url = $meta['url'] . '/';
$absolute_og_image = $meta['url'] . $meta['og_image'];
$person_id = $meta['url'] . '/#person';
$profile_page_id = $meta['url'] . '/#profilepage';
$website_id = $meta['url'] . '/#website';

$config_path = dirname(__DIR__, 2) . '/config/site.php';
$last_modified = gmdate('c', (int) filemtime($config_path));

$knows_about = [];
foreach ($skills['categories'] as $category) {
	foreach ($category['skills'] as $skill) {
		$knows_about[] = $skill['name'];
	}
}

$person = [
	'@type' => 'Person',
	'@id' => $person_id,
	'name' => $about['developer_info']['name'],
	'givenName' => $about['developer_info']['first_name'],
	'familyName' => $about['developer_info']['last_name'],
	'jobTitle' => $about['developer_info']['title'],
	'description' => $meta['description'],
	'url' => $meta['url'],
	'email' => $contact_info['email'],
	'telephone' => $contact_info['phone'],
	'image' => $absolute_og_image,
	'address' => [
		'@type' => 'PostalAddress',
		'addressCountry' => $contact_info['country'],
		'addressLocality' => $contact_info['location'],
	],
	'knowsAbout' => $knows_about,
	'sameAs' => [
		$contact_info['github'],
		$contact_info['linkedin'],
		$contact_info['instagram'],
	],
];

foreach ($experience['jobs'] as $job) {
	if (!empty($job['is_current'])) {
		$person['worksFor'] = [
			'@type' => 'Organization',
			'name' => $job['company'],
		];
		break;
	}
}

$json_ld = [
	'@context' => 'https://schema.org',
	'@graph' => [
		$person,
		[
			'@type' => 'ProfilePage',
			'@id' => $profile_page_id,
			'url' => $meta['url'],
			'name' => $meta['name'],
			'description' => $meta['description'],
			'dateCreated' => $meta['date_created'],
			'dateModified' => $last_modified,
			'inLanguage' => $meta['lang'],
			'mainEntity' => ['@id' => $person_id],
		],
		[
			'@type' => 'WebSite',
			'@id' => $website_id,
			'url' => $meta['url'],
			'name' => $meta['name'],
			'description' => $meta['description'],
			'inLanguage' => $meta['lang'],
			'publisher' => ['@id' => $person_id],
		],
	],
];

$json_ld_encoded = json_encode($json_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
$json_ld_encoded = str_replace('</', '<\/', $json_ld_encoded);
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($meta['lang'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="dark">
	<meta name="theme-color" content="<?= htmlspecialchars($meta['theme_color'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta name="format-detection" content="telephone=no">

	<title><?= htmlspecialchars($meta['name'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></title>
	<meta name="description" content="<?= htmlspecialchars($meta['description'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">

	<link rel="canonical" href="<?= htmlspecialchars($canonical_url, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<link rel="icon" type="image/svg+xml" href="/favicon.svg">
	<link rel="icon" type="image/png" sizes="48x48" href="/favicon-48.png">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="manifest" href="/manifest.webmanifest">

	<meta property="og:type" content="profile">
	<meta property="og:site_name" content="<?= htmlspecialchars($meta['name'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="og:locale" content="<?= htmlspecialchars($meta['locale'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="og:title" content="<?= htmlspecialchars($meta['name'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="og:description" content="<?= htmlspecialchars($meta['description'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="og:url" content="<?= htmlspecialchars($canonical_url, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="og:image" content="<?= htmlspecialchars($absolute_og_image, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="og:image:secure_url" content="<?= htmlspecialchars($absolute_og_image, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="og:image:alt" content="<?= htmlspecialchars($about['developer_info']['name'] . ', ' . $about['developer_info']['title'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="profile:first_name" content="<?= htmlspecialchars($about['developer_info']['first_name'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="profile:last_name" content="<?= htmlspecialchars($about['developer_info']['last_name'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta property="profile:username" content="<?= htmlspecialchars($contact_info['github_username'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?= htmlspecialchars($meta['name'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta name="twitter:description" content="<?= htmlspecialchars($meta['description'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta name="twitter:image" content="<?= htmlspecialchars($absolute_og_image, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">
	<meta name="twitter:image:alt" content="<?= htmlspecialchars($about['developer_info']['name'] . ', ' . $about['developer_info']['title'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap">

	<link rel="stylesheet" href="/assets/css/tailwind.min.css">

	<script src="/assets/js/main.js" defer></script>

	<script type="application/ld+json" nonce="<?= htmlspecialchars(Csp::nonce(), ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"><?= $json_ld_encoded ?></script>
</head>
<body>
	<a href="#main" class="skip-link">Skip to main content</a>

	<div class="pointer-events-none fixed inset-0 overflow-hidden -z-20" aria-hidden="true">
		<div class="absolute inset-0 bg-linear-to-br from-dark via-primary to-dark"></div>
		<div class="absolute inset-0 opacity-10 gradient-bg"></div>
	</div>

	<?php require __DIR__ . '/../partials/header.php'; ?>

	<main id="main">
		<?php require __DIR__ . '/../sections/hero.php'; ?>
		<?php require __DIR__ . '/../sections/about.php'; ?>
		<?php require __DIR__ . '/../sections/experience.php'; ?>
		<?php require __DIR__ . '/../sections/skills.php'; ?>
		<?php require __DIR__ . '/../sections/contact.php'; ?>
	</main>

	<?php require __DIR__ . '/../partials/footer.php'; ?>
	<?php require __DIR__ . '/../partials/scroll-top.php'; ?>

	<script src="/assets/js/contact-form.js" defer></script>
</body>
</html>
