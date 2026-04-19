<?php
declare(strict_types=1);

use Tubaishat\Support\Icon;

$has_current_job = false;
foreach ($experience['jobs'] as $job) {
	if (!empty($job['is_current'])) {
		$has_current_job = true;
		break;
	}
}
?>
<section id="home" aria-labelledby="hero-heading" class="min-h-dvh relative overflow-hidden flex items-center pt-20 sm:pt-24 md:pt-32">
	<div class="pointer-events-none absolute top-16 sm:top-20 right-1/6 sm:right-1/4 w-60 sm:w-80 lg:w-96 h-60 sm:h-80 lg:h-96 bg-secondary opacity-10 rounded-full blur-3xl -z-10 animate-pulse-slow" aria-hidden="true"></div>
	<div class="pointer-events-none absolute bottom-16 sm:bottom-20 left-1/6 sm:left-1/4 w-48 sm:w-72 lg:w-80 h-48 sm:h-72 lg:h-80 bg-accent opacity-5 rounded-full blur-3xl -z-10 animate-pulse-slow [animation-delay:500ms]" aria-hidden="true"></div>

	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-center">
		<?php if ($has_current_job): ?>
			<div class="inline-flex items-center gap-2 mb-6 bg-linear-to-r from-green-500/20 to-green-400/20 text-green-400 border border-green-400/30 rounded-full py-1.5 sm:py-2 px-4 sm:px-6 text-xs sm:text-sm font-medium animate-pulse-slow backdrop-blur-xs">
				<?= Icon::render('briefcase', 'text-xs') ?>
				<span><?= htmlspecialchars($hero['currently_employed_label'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span>
			</div>
		<?php endif; ?>

		<h1 id="hero-heading" class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-6 sm:mb-8 bg-linear-to-r from-white via-light to-gray-300 bg-clip-text text-transparent leading-tight pb-2">
			<?= htmlspecialchars($about['developer_info']['name'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>
		</h1>

		<p class="text-lg sm:text-xl md:text-2xl text-gray-300 mb-6 sm:mb-8">
			<span id="heroTypewriter"
			      data-text="<?= htmlspecialchars($about['developer_info']['title'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
			      data-delay="45"
			      class="inline-block"><?= htmlspecialchars($about['developer_info']['title'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span>
		</p>

		<p class="max-w-xl mx-auto text-base sm:text-lg text-gray-400 mb-8 sm:mb-10">
			<?= htmlspecialchars($meta['description'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>
		</p>

		<div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
			<a href="#contact"
			   class="group inline-flex items-center justify-center gap-2 bg-linear-to-r from-secondary to-accent hover:from-accent hover:to-secondary text-primary font-semibold py-3 sm:py-4 px-6 sm:px-8 rounded-lg transition-all duration-300 shadow-lg shadow-secondary/20 hover:scale-105 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50"
			   aria-label="Jump to the contact section">
				<?= Icon::render('envelope', 'group-hover:animate-bounce') ?>
				<span><?= htmlspecialchars($hero['contact_cta'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span>
			</a>
			<a href="<?= htmlspecialchars($meta['cv_path'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
			   download
			   class="inline-flex items-center justify-center gap-2 bg-transparent hover:bg-linear-to-r from-secondary/10 to-accent/10 text-secondary border border-secondary/40 hover:border-secondary font-semibold py-3 sm:py-4 px-6 sm:px-8 rounded-lg transition-all duration-300 backdrop-blur-xs hover:scale-105 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50"
			   aria-label="Download my CV">
				<?= Icon::render('download') ?>
				<span><?= htmlspecialchars($hero['download_cv_cta'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span>
			</a>
		</div>

		<a href="#about"
		   aria-label="Scroll to about section"
		   class="absolute bottom-6 sm:bottom-8 left-1/2 -translate-x-1/2 text-secondary inline-flex items-center justify-center animate-bounce-slow hover:text-accent transition-colors duration-300 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded p-2">
			<?= Icon::render('chevron-down', 'text-lg sm:text-2xl') ?>
		</a>
	</div>
</section>
