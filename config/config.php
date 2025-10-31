<?php
/**
 * Main Configuration File
 * ======================
 * 
 * This file contains all website text content and configurations in one centralized location.
 * Almost all website text content is stored here, making it easy to update without touching template files.
 * 
 * IMPORTANT NOTES:
 * ----------------
 * 1. The Hero section content is NOT in this file - it remains in components/sections/hero.php
 * 2. All other sections pull their main text content from the arrays defined in this file
 * 3. Code snippets shown in the About section and Contact section are NOT in this file - they remain in 
 *    their respective section files (about.php and contact.php)
 * 4. Visual styling, layout, and design elements remain in their section files
 * 
 * HOW TO USE:
 * -----------
 * To update website content:
 * - Find the relevant section array (e.g., $about_section for the About section)
 * - Edit the text values as needed
 * - Save this file and refresh your website to see the changes
 * - For code snippets or visual elements, you'll need to edit the respective section files
 * 
 * SECTIONS DEFINED (in order of appearance on website):
 * ----------------
 * $navigation_links		- Navigation menu items (header)
 * $about_section		- About Me section content (text only, code snippet remains in about.php)
 * $experience_section		- Work Experience section content
 * $skills_section		- Skills section with all categories
 * $contact_section		- Contact section text and items (text only, code snippet remains in contact.php)
 * $footer_section		- Footer content
 * $contact_info		- Contact information used throughout the site
 */

declare(strict_types=1);

define('SITE_NAME', 'Rayyan Tubaishat | Technical Project Manager');
define('SITE_URL', 'https://tubaishat.com');
define('ASSETS_URL', 'assets/');
define('CV_PATH', 'assets/files/ryt.tubaishat.pdf');

$contact_info = [
	'email' => 'ba8lawa2023@gmail.com',
	'phone' => '+962795945090',
	'phone_display' => '+962 79 594 5090',
	'location' => 'Jordan',
	'github' => 'https://github.com/tgaryt',
	'linkedin' => 'https://linkedin.com/in/ry-tubaishat',
	'instagram' => 'https://www.instagram.com/ry.tubaishat'
];

$navigation_links = [
	'about' => 'About',
	'experience' => 'Experience',
	'skills' => 'Skills',
	'contact' => 'Let\'s Talk'
];

$about_section = [
	'title' => 'About <span class="text-secondary">Me</span>',
	'subtitle' => 'Who I Am',
	'developer_info' => [
		'name' => 'Rayyan Tubaishat',
		'title' => 'Technical Project Manager',
		'location' => 'Jordan',
		'education' => 'Bachelor of Computer Information Systems (Expected 2026)',
		'experience' => '5+ years'
	],
	'paragraphs' => [
		'Technical Project Manager with over 5 years of hands-on development experience, now leading technical teams and overseeing project lifecycles. I specialize in managing development workflows, reviewing code quality, and ensuring best practices across all deployments.',
		'My background as a full-stack developer gives me a unique perspective when coordinating with teams. I understand the technical challenges developers face because I\'ve been there myself, building applications from the ground up using PHP, JavaScript, and modern databases.',
		'These days, I focus on the bigger picture: architecting solutions, managing technical debt, and making sure every line of code that goes to production meets our quality standards. I still get my hands dirty with code reviews and critical technical decisions, but my main goal is empowering teams to build great software.'
	],
	'stats' => [
		['value' => '5+', 'label' => 'Years Experience'],
		['value' => '60+', 'label' => 'Projects Completed']
	]
];

$experience_section = [
	'title' => 'Work <span class="text-secondary">Experience</span>',
	'employment_type_label' => 'Full-time',
	'technologies_label' => 'Key Technologies:',
	'jobs' => [
		[
			'company' => 'EZ-AD',
			'location' => 'Remote',
			'total_period' => 'May 2025 - Present',
			'total_datetime' => '2025-05',
			'employment_type' => 'Full-time',
			'has_promotion' => true,
			'roles' => [
				[
					'title' => 'Technical Project Manager',
					'period' => 'November 2025 - Present',
					'datetime' => '2025-11',
					'is_current' => true,
					'responsibilities' => [
						'Managing technical architecture and development workflows',
						'Reviewing and approving all code changes before production deployment',
						'Coordinating with development teams to ensure quality standards',
						'Providing technical support and resolving critical issues',
						'Ensuring best practices and code quality'
					]
				],
				[
					'title' => 'Full Stack Developer',
					'period' => 'May 2025 - November 2025',
					'datetime' => '2025-05/2025-11',
					'is_current' => false,
					'responsibilities' => [
						'Built projects from ground up through full development lifecycle',
						'Implemented and tested features to ensure production readiness',
						'Developed both front-end and back-end components',
						'Conducted thorough testing and quality assurance before deployment',
						'Collaborated with team members to deliver high-quality solutions',
						'Maintained and optimized existing applications for performance and scalability'
					],
					'technologies' => ['PHP', 'JavaScript', 'HTML', 'CSS', 'SQL', 'Docker', 'Git']
				]
			]
		],
		[
			'company' => 'UGC-Gaming.NET',
			'location' => 'Remote',
			'title' => 'Full Stack Developer',
			'period' => 'February 2020 - March 2025',
			'datetime' => '2020-02/2025-03',
			'responsibilities' => [
				'Developed and maintained internal tools and systems, enhancing efficiency across all departments',
				'Built a complete staff area system from scratch, improving task management and operational workflow',
				'Managed server infrastructure including server configuration, SSL certificates, and DNS handling with automated deployments',
				'Modernized company websites with clean code following MVC patterns, resulting in 40% improved performance',
				'Led technical team implementing agile methodologies for smooth project delivery'
			],
			'technologies' => ['PHP', 'JavaScript', 'SQL', 'Docker', 'Git', 'Nginx']
		]
	]
];

$skills_section = [
	'title' => 'Technical <span class="text-secondary">Skills</span>',
	'categories' => [
		[
			'icon' => 'fas fa-code',
			'title' => 'Programming Languages',
			'skills' => [
				['name' => 'PHP', 'level' => 90],
				['name' => 'JavaScript', 'level' => 75],
				['name' => 'SQL', 'level' => 85]
			]
		],
		[
			'icon' => 'fas fa-laptop-code',
			'title' => 'Web Technologies',
			'skills' => [
				['name' => 'HTML & CSS', 'level' => 90],
				['name' => 'Server Management', 'level' => 85],
				['name' => 'System Administration', 'level' => 80]
			]
		],
		[
			'icon' => 'fas fa-tools',
			'title' => 'Technologies & Tools',
			'tools' => [
				['name' => 'PHP', 'icon' => 'fab fa-php'],
				['name' => 'JavaScript', 'icon' => 'fab fa-js'],
				['name' => 'HTML5', 'icon' => 'fab fa-html5'],
				['name' => 'CSS3', 'icon' => 'fab fa-css3-alt'],
				['name' => 'Git', 'icon' => 'fab fa-git-alt'],
				['name' => 'MySQL', 'icon' => 'fas fa-database']
			]
		],
		[
			'icon' => 'fas fa-language',
			'title' => 'Languages',
			'skills' => [
				['name' => 'Arabic (Native)', 'level' => 100],
				['name' => 'English (Professional)', 'level' => 85]
			]
		]
	],
	'footer_text' => 'Always learning and staying up-to-date with the latest technologies in web development and system administration.'
];

$contact_section = [
	'title' => 'Let\'s <span class="text-secondary">Talk</span>',
	'subtitle' => 'Get In Touch',
	'intro' => 'Feel free to reach out to me using any of the following contact methods. I am always open to discussing new opportunities and would love to hear from you!',
	'contact_items' => [
		[
			'type' => 'Email',
			'icon' => 'fas fa-envelope',
			'key' => 'email'
		],
		[
			'type' => 'Phone',
			'icon' => 'fas fa-phone',
			'key' => 'phone',
			'display_key' => 'phone_display'
		],
		[
			'type' => 'Location',
			'icon' => 'fas fa-map-marker-alt',
			'key' => 'location'
		],
		[
			'type' => 'GitHub',
			'icon' => 'fab fa-github',
			'key' => 'github',
			'display' => 'github.com/tgaryt'
		],
		[
			'type' => 'LinkedIn',
			'icon' => 'fab fa-linkedin',
			'key' => 'linkedin',
			'display' => 'linkedin.com/in/ry-tubaishat'
		],
		[
			'type' => 'Instagram',
			'icon' => 'fab fa-instagram',
			'key' => 'instagram',
			'display' => 'instagram.com/ry.tubaishat'
		]
	],
	'cta_text' => 'Start a conversation'
];

$footer_section = [
	'copyright' => '&copy; ' . date('Y') . ' tubaishat.com. All rights reserved.'
];
