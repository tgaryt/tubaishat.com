// Portfolio content reproduced exactly from feed.txt, plus the machine-readable month of each role date, used by the site header and footer, the five page sections, and the title, Open Graph metadata, and structured data of the home page.
export const profile = {
	name: 'Rayyan Tubaishat',
	professionalTitle: 'Full Stack Developer',
	location: 'Jordan',
	hero: {
		lead: 'Full Stack Developer with over 3 years of experience building and maintaining web applications end-to-end.',
		availability: 'Open to full-time opportunities, freelance projects, and collaborations.'
	},
	about: {
		lead: 'I take applications from initial design through production deployment, with a focus on clean code, maintainability, and measurable performance.',
		body: [
			'I work across the entire stack, writing PHP and Node.js on the backend, JavaScript and TypeScript on the frontend, and designing database schemas with MySQL.',
			'My experience spans modernizing legacy codebases and delivering greenfield projects from the ground up.',
			'Beyond the code, I enjoy the operational side: managing Linux servers, handling SSL and DNS, and keeping deployments running smoothly.',
			'Continuously learning and staying up to date with modern web development and system administration.'
		],
		facts: [
			{ label: 'Projects completed', value: '29+' },
			{ label: 'Education', value: 'Bachelor of Computer Information Systems (Expected 2027)' }
		]
	},
	experience: [
		{
			company: 'EZ-AD TV, Inc.',
			title: 'Full Stack Developer',
			employmentType: 'Full-time',
			location: 'Remote',
			start: { text: 'May 2025', datetime: '2025-05' },
			end: { text: 'Present' },
			responsibilities: [
				'Design and build full systems from the ground up, including subscription billing, payment processing (Stripe), admin dashboards, and client-facing portals',
				'Own and maintain internal company platforms used daily by employees, handling feature requests, bug fixes, and improvements',
				'Integrate AI services into production workflows for automated content generation, document processing, and intelligent automation',
				'Build multilingual automated publishing pipelines and data-driven reporting tools',
				'Develop financial reconciliation systems with third-party accounting API integrations',
				'Create data pipelines connecting external APIs (Google Search Console, Slack, Google Cloud Storage) to internal platforms',
				'Manage full deployment lifecycle including server configuration, database migrations, and production monitoring'
			],
			technologies: ['PHP', 'JavaScript', 'TypeScript', 'Vue', 'Node.js', 'MySQL', 'HTML', 'CSS', 'Git']
		},
		{
			company: 'UGC-Gaming.NET',
			title: 'Full Stack Developer',
			employmentType: 'Full-time',
			location: 'Remote',
			start: { text: 'January 2023', datetime: '2023-01' },
			end: { text: 'May 2025', datetime: '2025-05' },
			responsibilities: [
				'Developed and maintained internal tools and systems, enhancing efficiency across all departments',
				'Built a complete staff area system from scratch, improving task management and operational workflow',
				'Managed server infrastructure including server configuration, SSL certificates, and DNS handling with automated deployments',
				'Modernized company websites with clean code following MVC patterns, resulting in 40% improved performance',
				'Led technical team implementing agile methodologies for smooth project delivery'
			],
			technologies: ['PHP', 'JavaScript', 'SQL', 'Git']
		}
	],
	skills: [
		{ name: 'Languages', items: ['PHP', 'JavaScript', 'TypeScript', 'Python', 'SQL'] },
		{ name: 'Frontend', items: ['HTML', 'CSS', 'Tailwind CSS', 'React'] },
		{ name: 'Backend', items: ['Node.js', 'MySQL', 'REST APIs'] },
		{ name: 'Tools and systems', items: ['Git', 'Composer', 'Linux'] }
	],
	contact: {
		email: 'ba8lawa2023@gmail.com',
		phone: '+962795945090',
		phoneDisplay: '+962 7 9594 5090',
		whatsapp: 'https://wa.me/962795945090',
		github: 'https://github.com/tgaryt',
		linkedin: 'https://linkedin.com/in/ry-tubaishat',
		instagram: 'https://www.instagram.com/ryt.tbaishat'
	}
} as const;
