// PM2 process file: one fork-mode instance of the Astro server, started with the variables in .env.
module.exports = {
	apps: [
		{
			name: 'tubaishat.com',
			cwd: __dirname,
			script: './dist/server/entry.mjs',
			node_args: '--env-file=.env',
			exec_mode: 'fork',
			instances: 1,
			kill_timeout: 25000,
			time: true
		}
	]
};
