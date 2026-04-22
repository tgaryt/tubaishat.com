<?php
declare(strict_types=1);

/**
 * Site content source of truth.
 *
 * This file returns a single array with every piece of copy rendered on the portfolio.
 * Every section is labeled below with a banner comment. Edit values here to update the live site.
 *
 * DO NOT put markup (<span> etc.) inside these strings. Styling is applied in the templates.
 */

return [
	/*
	 * =============================================================================
	 *  SITE META
	 * =============================================================================
	 *  Global values used by <head>, JSON-LD, OpenGraph, and the PWA manifest.
	 *  - url: protocol included, no trailing slash
	 *  - lang: BCP 47 language tag (e.g. en, en-US)
	 *  - locale: Open Graph locale (language_TERRITORY with underscore)
	 *  - date_created: ISO 8601 date the profile first went public
	 */
	'meta' => [
		'name' => 'Rayyan Tubaishat | Full Stack Developer',
		'url' => 'https://tubaishat.com',
		'description' => 'Full Stack Developer with 3+ years of experience building modern web applications using PHP, Node.js, JavaScript, TypeScript, and MySQL.',
		'lang' => 'en-US',
		'locale' => 'en_US',
		'theme_color' => '#0ea5e9',
		'date_created' => '2023-01-01',
		'cv_path' => '/assets/files/ryt-tubaishat.pdf',
		'og_image' => '/assets/images/og-image.png',
	],

	/*
	 * =============================================================================
	 *  CONTACT INFO
	 * =============================================================================
	 *  - phone: E.164 format (leading +, country code, subscriber, no spaces/dashes)
	 *  - phone_display: human-readable grouping per Jordan numbering plan
	 *  - country: ISO 3166-1 alpha-2
	 *  - github_username: used for OG profile:username
	 */
	'contact_info' => [
		'email' => 'ba8lawa2023@gmail.com',
		'phone' => '+962795945090',
		'phone_display' => '+962 79 594 5090',
		'location' => 'Jordan',
		'country' => 'JO',
		'github' => 'https://github.com/tgaryt',
		'github_username' => 'tgaryt',
		'github_display' => 'github.com/tgaryt',
		'linkedin' => 'https://linkedin.com/in/ry-tubaishat',
		'linkedin_display' => 'linkedin.com/in/ry-tubaishat',
		'instagram' => 'https://www.instagram.com/ryt.tbaishat',
		'instagram_display' => 'instagram.com/ryt.tbaishat',
		'whatsapp' => 'https://wa.me/962795945090',
		'whatsapp_display' => 'wa.me/962795945090',
	],

	/*
	 * =============================================================================
	 *  PRIMARY NAVIGATION
	 * =============================================================================
	 *  Renders in the sticky header. Array keys map to section id anchors.
	 *  The 'contact' key is rendered with the gradient CTA styling.
	 */
	'navigation_links' => [
		'about' => 'About',
		'experience' => 'Experience',
		'skills' => 'Skills',
		'contact' => "Let's Talk",
	],

	/*
	 * =============================================================================
	 *  HERO SECTION (#home)
	 * =============================================================================
	 *  First visible section. Shows name (H1), typed job title, short bio, and two CTAs.
	 *  The "Currently Employed" pill is driven by the is_current flag on the experience list below.
	 */
	'hero' => [
		'currently_employed_label' => 'Currently Employed',
		'contact_cta' => 'Contact Me',
		'download_cv_cta' => 'Download CV',
	],

	/*
	 * =============================================================================
	 *  ABOUT SECTION (#about)
	 * =============================================================================
	 *  Two-column card: left = location + education + stats, right = bio paragraphs.
	 *  Add or edit paragraphs in about.paragraphs.
	 */
	'about' => [
		'title_plain' => 'About Me',
		'title_highlight' => 'Me',
		'subtitle' => 'Who I Am',
		'developer_info' => [
			'name' => 'Rayyan Tubaishat',
			'first_name' => 'Rayyan',
			'last_name' => 'Tubaishat',
			'title' => 'Full Stack Developer',
			'location' => 'Jordan',
			'education' => 'Bachelor of Computer Information Systems (Expected 2026)',
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
	],

	/*
	 * =============================================================================
	 *  EXPERIENCE SECTION (#experience)
	 * =============================================================================
	 *  Reverse-chronological job list. Each job has:
	 *  - is_current: boolean. Drives the green "Current" pill and JSON-LD worksFor
	 *  - period_start / period_end: human-readable (null end = "Present")
	 *  - datetime_start / datetime_end: ISO 8601 YYYY-MM for <time datetime="..."> attrs
	 *  - responsibilities: bullet list rendered in the job card
	 *  - technologies: pill list in the job card footer
	 */
	'experience' => [
		'title_plain' => 'Work Experience',
		'title_highlight' => 'Experience',
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
	],

	/*
	 * =============================================================================
	 *  SKILLS SECTION (#skills)
	 * =============================================================================
	 *  Four category cards. Each skill is a pill (icon + name).
	 *  - icon: must exist in scripts/icons.json and be built via npm run build:icons
	 *  - icon_class (optional): extra Tailwind classes for a specific pill icon (e.g. tinting)
	 */
	'skills' => [
		'title_plain' => 'Technical Skills',
		'title_highlight' => 'Skills',
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
	],

	/*
	 * =============================================================================
	 *  CONTACT SECTION (#contact)
	 * =============================================================================
	 *  Two things live here:
	 *  1) The contact channels list (email/phone/location/github/linkedin/instagram)
	 *  2) The contact form with inquiry_type + message. Form posts to POST /contact
	 *
	 *  contact_items[].key maps to a field in contact_info above.
	 *  contact_items[].display_key (optional) overrides which contact_info key is rendered
	 *  as the visible label (e.g., phone stores E.164 but shows phone_display).
	 *
	 *  form.inquiry_type.options MUST match the allow-list in src/Support/Validator.php.
	 *  If you edit one, edit the other.
	 */
	'contact' => [
		'title_plain' => "Let's Talk",
		'title_highlight' => 'Talk',
		'intro' => 'Open to new opportunities and collaborations. Pick any channel below or send a message using the form.',
		'channels_heading' => 'Ways to reach me',
		'form_heading' => 'Send a message',
		'form_subtitle' => 'Whether you are hiring for a full-time role or looking for a freelancer, provide the details below and I will get back to you.',
		'contact_items' => [
			['type' => 'Email', 'icon' => 'envelope', 'key' => 'email'],
			['type' => 'Phone', 'icon' => 'phone', 'key' => 'phone', 'display_key' => 'phone_display'],
			['type' => 'WhatsApp', 'icon' => 'whatsapp', 'key' => 'whatsapp', 'display_key' => 'whatsapp_display'],
			['type' => 'GitHub', 'icon' => 'github', 'key' => 'github', 'display_key' => 'github_display'],
			['type' => 'LinkedIn', 'icon' => 'linkedin', 'key' => 'linkedin', 'display_key' => 'linkedin_display'],
			['type' => 'Instagram', 'icon' => 'instagram', 'key' => 'instagram', 'display_key' => 'instagram_display'],
		],
		'form' => [
			'submit_label' => 'Send message',
			'inquiry_type' => [
				'label' => 'Inquiry type',
				'placeholder' => 'Select an inquiry type',
				'options' => [
					'full_time' => 'Full-time opportunity',
					'freelance' => 'Freelance project',
					'other' => 'Other',
				],
			],
			'fields' => [
				'name' => ['label' => 'Name', 'placeholder' => 'Jane Doe', 'required' => true, 'maxlength' => 100],
				'company' => ['label' => 'Company (optional)', 'placeholder' => 'Acme Inc.', 'required' => false, 'maxlength' => 120],
				'email' => ['label' => 'Email', 'placeholder' => 'you@example.com', 'required' => true, 'maxlength' => 254],
				'subject' => ['label' => 'Subject', 'placeholder' => 'Short summary', 'required' => true, 'minlength' => 3, 'maxlength' => 150],
				'message' => ['label' => 'Message', 'placeholder' => 'Tell me a bit about the role or project.', 'required' => true, 'minlength' => 10, 'maxlength' => 5000],
			],
		],
	],

	/*
	 * =============================================================================
	 *  FOOTER
	 * =============================================================================
	 *  Year is substituted at render time in the template, so no static year lives here.
	 */
	'footer' => [
		'copyright_suffix' => 'tubaishat.com. All rights reserved.',
	],
];
