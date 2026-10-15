// PM2 process file for production: one fork-mode instance of the standalone Astro server, started from this directory, with timestamped logs.
module.exports = {
	apps: [
		{
			name: 'tubaishat.com',
			cwd: __dirname,
			script: './dist/server/entry.mjs',
			exec_mode: 'fork',
			instances: 1,
			time: true
		}
	]
};
