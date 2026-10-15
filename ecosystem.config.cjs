// PM2 process file for production: one fork-mode instance of the standalone Astro server, started from this directory with the environment variables in .env, with timestamped logs and 25 seconds to finish a graceful shutdown before PM2 forces the process to stop.
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
