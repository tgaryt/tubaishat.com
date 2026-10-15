// Portfolio content reproduced exactly from feed.txt, the single source of that content for the site header, the Hero and About sections, and the home page title.
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
	}
} as const;
