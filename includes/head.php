<?php
$canonical_url = SITE_URL;
$absolute_profile_image = SITE_URL . '/' . PROFILE_IMAGE;
$absolute_og_image = SITE_URL . '/' . OG_IMAGE;
$person_id = SITE_URL . '/#person';
$profile_page_id = SITE_URL . '/#profilepage';
$website_id = SITE_URL . '/#website';
$config_path = __DIR__ . '/../config/config.php';
$last_modified = gmdate('c', filemtime($config_path));

$knows_about = [];
foreach ($skills_section['categories'] as $category) {
	foreach ($category['skills'] as $skill) {
		$knows_about[] = $skill['name'];
	}
}

$person = [
	'@type' => 'Person',
	'@id' => $person_id,
	'name' => $about_section['developer_info']['name'],
	'givenName' => $about_section['developer_info']['first_name'],
	'familyName' => $about_section['developer_info']['last_name'],
	'jobTitle' => $about_section['developer_info']['title'],
	'description' => SITE_DESCRIPTION,
	'url' => SITE_URL,
	'image' => [
		'@type' => 'ImageObject',
		'url' => $absolute_profile_image,
		'width' => 512,
		'height' => 512,
	],
	'email' => $contact_info['email'],
	'telephone' => $contact_info['phone'],
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

foreach ($experience_section['jobs'] as $job) {
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
			'url' => SITE_URL,
			'name' => SITE_NAME,
			'description' => SITE_DESCRIPTION,
			'dateModified' => $last_modified,
			'inLanguage' => SITE_LANG,
			'mainEntity' => ['@id' => $person_id],
		],
		[
			'@type' => 'WebSite',
			'@id' => $website_id,
			'url' => SITE_URL,
			'name' => SITE_NAME,
			'description' => SITE_DESCRIPTION,
			'inLanguage' => SITE_LANG,
			'publisher' => ['@id' => $person_id],
		],
	],
];
$json_ld_encoded = json_encode($json_ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="dark">
	<meta name="theme-color" content="<?= htmlspecialchars(THEME_COLOR) ?>">
	<meta name="format-detection" content="telephone=no">

	<title><?= htmlspecialchars(SITE_NAME) ?></title>
	<meta name="description" content="<?= htmlspecialchars(SITE_DESCRIPTION) ?>">
	<meta name="author" content="<?= htmlspecialchars($about_section['developer_info']['name']) ?>">

	<link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">
	<link rel="icon" type="image/svg+xml" href="favicon.svg">
	<link rel="manifest" href="manifest.webmanifest">

	<meta property="og:type" content="profile">
	<meta property="og:site_name" content="<?= htmlspecialchars(SITE_NAME) ?>">
	<meta property="og:locale" content="<?= htmlspecialchars(SITE_LOCALE) ?>">
	<meta property="og:title" content="<?= htmlspecialchars(SITE_NAME) ?>">
	<meta property="og:description" content="<?= htmlspecialchars(SITE_DESCRIPTION) ?>">
	<meta property="og:url" content="<?= htmlspecialchars($canonical_url) ?>">
	<meta property="og:image" content="<?= htmlspecialchars($absolute_og_image) ?>">
	<meta property="og:image:alt" content="<?= htmlspecialchars($about_section['developer_info']['name']) ?>, <?= htmlspecialchars($about_section['developer_info']['title']) ?>">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="profile:first_name" content="<?= htmlspecialchars($about_section['developer_info']['first_name']) ?>">
	<meta property="profile:last_name" content="<?= htmlspecialchars($about_section['developer_info']['last_name']) ?>">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?= htmlspecialchars(SITE_NAME) ?>">
	<meta name="twitter:description" content="<?= htmlspecialchars(SITE_DESCRIPTION) ?>">
	<meta name="twitter:image" content="<?= htmlspecialchars($absolute_og_image) ?>">
	<meta name="twitter:image:alt" content="<?= htmlspecialchars($about_section['developer_info']['name']) ?>, <?= htmlspecialchars($about_section['developer_info']['title']) ?>">

	<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
	<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link rel="stylesheet" href="<?= htmlspecialchars(ASSETS_URL) ?>css/tailwind.min.css">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@v2.17.0/devicon.min.css" integrity="sha384-6iv3tXABd3c9DYulXujJl8n22ahn/12f45MomxoPv6jBX4LBE4gNJjfkx5mAKIqR" crossorigin="anonymous" referrerpolicy="no-referrer">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">

	<link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" as="style">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" media="print" onload="this.media='all'">
	<noscript>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap">
	</noscript>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.15.0/cdn.min.js" integrity="sha512-4M615JhFufNLsrK5+qpW7oZJ8ooDJlzcUqd/+LVic8e9+0JuoO0KLnIf0NGg3e3tvFxRRdngx1VLtiOwPtYM4A==" defer crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script type="application/ld+json"><?= $json_ld_encoded ?></script>
</head>
