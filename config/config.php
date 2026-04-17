<?php
declare(strict_types=1);

define('SITE_NAME', 'Rayyan Tubaishat | Full Stack Developer');
define('SITE_URL', 'https://tubaishat.com');
define('SITE_DESCRIPTION', 'Full Stack Developer with 3+ years of experience building modern web applications using PHP, Node.js, JavaScript, TypeScript, and MySQL.');
define('SITE_LOCALE', 'en_US');
define('SITE_LANG', 'en');
define('THEME_COLOR', '#0ea5e9');
define('ASSETS_URL', 'assets/');
define('CV_PATH', 'assets/files/ryt-tubaishat.pdf');
define('OG_IMAGE', 'assets/images/og-image.png');

$contact_info = [
	'email' => 'ba8lawa2023@gmail.com',
	'phone' => '+962795945090',
	'phone_display' => '+962 7 9594 5090',
	'location' => 'Jordan',
	'country' => 'JO',
	'github' => 'https://github.com/tgaryt',
	'github_display' => 'github.com/tgaryt',
	'linkedin' => 'https://linkedin.com/in/ry-tubaishat',
	'linkedin_display' => 'linkedin.com/in/ry-tubaishat',
	'instagram' => 'https://www.instagram.com/ryt.tbaishat',
	'instagram_display' => 'instagram.com/ryt.tbaishat',
];

$navigation_links = [
	'about' => 'About',
	'experience' => 'Experience',
	'skills' => 'Skills',
	'contact' => "Let's Talk",
];

$about_section = [
	'title' => 'About <span class="text-secondary">Me</span>',
	'subtitle' => 'Who I Am',
	'developer_info' => [
		'name' => 'Rayyan Tubaishat',
		'first_name' => 'Rayyan',
		'last_name' => 'Tubaishat',
		'title' => 'Full Stack Developer',
		'location' => 'Jordan',
		'education' => 'Bachelor of Computer Information Systems (Expected 2026)',
		'experience' => '3+ years',
	],
	'paragraphs' => [
		'Full Stack Developer with over 3 years of experience building and maintaining web applications end-to-end. I work across the entire stack, writing PHP and Node.js on the backend, JavaScript and TypeScript on the frontend, and designing database schemas with MySQL.',
		'I take applications from initial design through production deployment, with a focus on clean code, maintainability, and measurable performance. My experience spans modernizing legacy codebases and delivering greenfield projects from the ground up.',
		"Beyond the code, I enjoy the operational side: managing Linux servers, handling SSL and DNS, and keeping deployments running smoothly. I'm currently at EZ-AD TV, Inc. and continuously learning new tools and techniques to build better software.",
	],
	'stats' => [
		['value' => '3+', 'label' => 'Years Experience'],
		['value' => '29+', 'label' => 'Projects Completed'],
	],
];

$experience_section = [
	'title' => 'Work <span class="text-secondary">Experience</span>',
	'technologies_label' => 'Key Technologies',
	'jobs' => [
		[
			'company' => 'EZ-AD TV, Inc.',
			'location' => 'Remote',
			'title' => 'Full Stack Developer',
			'employment_type' => 'Full-time',
			'period_start' => 'May 2025',
			'period_end' => null,
			'datetime_start' => '2025-05',
			'datetime_end' => null,
			'is_current' => true,
			'responsibilities' => [
				'Design and build full systems from the ground up, including subscription billing, payment processing (Stripe), admin dashboards, and client-facing portals',
				'Own and maintain internal company platforms used daily by employees, handling feature requests, bug fixes, and improvements',
				'Integrate AI services into production workflows for automated content generation, document processing, and intelligent automation',
				'Build multilingual automated publishing pipelines and data-driven reporting tools',
				'Develop financial reconciliation systems with third-party accounting API integrations',
				'Create data pipelines connecting external APIs (Google Search Console, Slack, Google Cloud Storage) to internal platforms',
				'Manage full deployment lifecycle including server configuration, database migrations, and production monitoring',
			],
			'technologies' => ['PHP', 'JavaScript', 'TypeScript', 'Node.js', 'MySQL', 'HTML', 'CSS', 'Git'],
		],
		[
			'company' => 'UGC-Gaming.NET',
			'location' => 'Remote',
			'title' => 'Full Stack Developer',
			'employment_type' => 'Full-time',
			'period_start' => 'January 2023',
			'period_end' => 'May 2025',
			'datetime_start' => '2023-01',
			'datetime_end' => '2025-05',
			'is_current' => false,
			'responsibilities' => [
				'Developed and maintained internal tools and systems, enhancing efficiency across all departments',
				'Built a complete staff area system from scratch, improving task management and operational workflow',
				'Managed server infrastructure including server configuration, SSL certificates, and DNS handling with automated deployments',
				'Modernized company websites with clean code following MVC patterns, resulting in 40% improved performance',
				'Led technical team implementing agile methodologies for smooth project delivery',
			],
			'technologies' => ['PHP', 'JavaScript', 'SQL', 'Git'],
		],
	],
];

$skills_section = [
	'title' => 'Technical <span class="text-secondary">Skills</span>',
	'categories' => [
		[
			'title' => 'Languages',
			'icon' => 'code',
			'skills' => [
				['name' => 'PHP', 'icon' => 'php'],
				['name' => 'JavaScript', 'icon' => 'javascript'],
				['name' => 'TypeScript', 'icon' => 'typescript'],
				['name' => 'SQL', 'icon' => 'database', 'icon_class' => 'text-secondary'],
			],
		],
		[
			'title' => 'Frontend',
			'icon' => 'window-maximize',
			'skills' => [
				['name' => 'HTML', 'icon' => 'html5'],
				['name' => 'CSS', 'icon' => 'css3'],
				['name' => 'Tailwind CSS', 'icon' => 'tailwindcss'],
				['name' => 'React', 'icon' => 'react'],
			],
		],
		[
			'title' => 'Backend',
			'icon' => 'server',
			'skills' => [
				['name' => 'Node.js', 'icon' => 'nodejs'],
				['name' => 'MySQL', 'icon' => 'mysql'],
				['name' => 'REST APIs', 'icon' => 'cloud', 'icon_class' => 'text-secondary'],
			],
		],
		[
			'title' => 'Tools',
			'icon' => 'wrench',
			'skills' => [
				['name' => 'Git', 'icon' => 'git'],
				['name' => 'Composer', 'icon' => 'composer'],
				['name' => 'Linux', 'icon' => 'linux'],
			],
		],
	],
	'footer_text' => 'Continuously learning and staying up to date with modern web development and system administration.',
];

$contact_section = [
	'title' => "Let's <span class=\"text-secondary\">Talk</span>",
	'subtitle' => 'Get In Touch',
	'intro' => 'Open to new opportunities and collaborations. Pick any channel below.',
	'contact_items' => [
		[
			'type' => 'Email',
			'icon' => 'envelope',
			'key' => 'email',
		],
		[
			'type' => 'Phone',
			'icon' => 'phone',
			'key' => 'phone',
			'display_key' => 'phone_display',
		],
		[
			'type' => 'Location',
			'icon' => 'location-dot',
			'key' => 'location',
		],
		[
			'type' => 'GitHub',
			'icon' => 'github',
			'key' => 'github',
			'display_key' => 'github_display',
		],
		[
			'type' => 'LinkedIn',
			'icon' => 'linkedin',
			'key' => 'linkedin',
			'display_key' => 'linkedin_display',
		],
		[
			'type' => 'Instagram',
			'icon' => 'instagram',
			'key' => 'instagram',
			'display_key' => 'instagram_display',
		],
	],
	'cta_text' => 'Start a conversation',
];

$footer_section = [
	'copyright' => '&copy; ' . date('Y') . ' tubaishat.com. All rights reserved.',
];
