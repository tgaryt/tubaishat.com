<section id="home" aria-labelledby="hero-heading" class="min-h-dvh relative overflow-hidden flex items-center pt-20 sm:pt-24 md:pt-32">
	<div class="pointer-events-none absolute top-16 sm:top-20 right-1/6 sm:right-1/4 w-60 sm:w-80 lg:w-96 h-60 sm:h-80 lg:h-96 bg-secondary opacity-10 rounded-full blur-3xl -z-10 animate-pulse-slow" aria-hidden="true"></div>
	<div class="pointer-events-none absolute bottom-16 sm:bottom-20 left-1/6 sm:left-1/4 w-48 sm:w-72 lg:w-80 h-48 sm:h-72 lg:h-80 bg-accent opacity-5 rounded-full blur-3xl -z-10 animate-pulse-slow" style="animation-delay: 500ms;" aria-hidden="true"></div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
		<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
			<div class="text-center lg:text-left">
				<div class="inline-flex items-center gap-2 mb-6 bg-linear-to-r from-green-500/20 to-green-400/20 text-green-400 border border-green-400/30 rounded-full py-1.5 sm:py-2 px-4 sm:px-6 text-xs sm:text-sm font-medium animate-pulse-slow backdrop-blur-xs">
					<i class="fas fa-briefcase text-xs" aria-hidden="true"></i>
					<span>Currently Employed</span>
				</div>

				<h1 id="hero-heading" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6 sm:mb-8 bg-linear-to-r from-white via-light to-gray-300 bg-clip-text text-transparent leading-tight pb-2">
					<?= htmlspecialchars($about_section['developer_info']['name']) ?>
				</h1>

				<p class="text-lg sm:text-xl md:text-2xl text-gray-300 mb-6 sm:mb-8">
					<span x-data="{}"
						x-init="(() => {
							const text = <?= htmlspecialchars(json_encode($about_section['developer_info']['title']), ENT_QUOTES, 'UTF-8') ?>;
							if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
							$el.textContent = '';
							let i = 0;
							const tick = () => {
								if (i < text.length) {
									$el.textContent += text[i];
									i++;
									setTimeout(tick, 45);
								}
							};
							tick();
						})()"
						class="inline-block"><?= htmlspecialchars($about_section['developer_info']['title']) ?></span>
				</p>

				<p class="max-w-xl mx-auto lg:mx-0 text-base sm:text-lg text-gray-400 mb-8 sm:mb-10">
					<?= htmlspecialchars(SITE_DESCRIPTION) ?>
				</p>

				<div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center lg:justify-start">
					<a href="#contact"
					   class="group inline-flex items-center justify-center gap-2 bg-linear-to-r from-secondary to-accent hover:from-accent hover:to-secondary text-primary font-semibold py-3 sm:py-4 px-6 sm:px-8 rounded-lg transition-all duration-300 shadow-lg shadow-secondary/20 hover:scale-105 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50"
					   aria-label="Contact me via email">
						<i class="fas fa-envelope group-hover:animate-bounce" aria-hidden="true"></i>
						<span>Contact Me</span>
					</a>
					<a href="<?= htmlspecialchars(CV_PATH) ?>"
					   download
					   class="inline-flex items-center justify-center gap-2 bg-transparent hover:bg-linear-to-r from-secondary/10 to-accent/10 text-secondary border border-secondary/40 hover:border-secondary font-semibold py-3 sm:py-4 px-6 sm:px-8 rounded-lg transition-all duration-300 backdrop-blur-xs hover:scale-105 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50"
					   aria-label="Download my CV">
						<i class="fas fa-download" aria-hidden="true"></i>
						<span>Download CV</span>
					</a>
				</div>
			</div>

			<div class="hidden lg:flex items-center justify-center">
				<div class="relative aspect-square w-80">
					<div class="absolute inset-0 animate-pulse-slow rounded-full bg-linear-to-br from-secondary/20 to-accent/20 blur-3xl" aria-hidden="true"></div>
					<div class="absolute inset-4 overflow-hidden rounded-full border-2 border-secondary/30 shadow-2xl shadow-secondary/20">
						<img src="<?= htmlspecialchars(PROFILE_IMAGE) ?>"
						     alt="Portrait of <?= htmlspecialchars($about_section['developer_info']['name']) ?>, <?= htmlspecialchars($about_section['developer_info']['title']) ?>"
						     width="512"
						     height="512"
						     fetchpriority="high"
						     decoding="sync"
						     class="h-full w-full object-cover">
					</div>
				</div>
			</div>
		</div>

		<a href="#about"
		   aria-label="Scroll to about section"
		   class="absolute bottom-6 sm:bottom-8 left-1/2 -translate-x-1/2 text-secondary inline-flex items-center justify-center animate-bounce-slow hover:text-accent transition-colors duration-300 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded p-2">
			<i class="fas fa-chevron-down text-lg sm:text-2xl" aria-hidden="true"></i>
		</a>
	</div>
</section>
