<?php
declare(strict_types=1);

use Tubaishat\Support\Icon;

$title_parts = explode($experience['title_highlight'], $experience['title_plain'], 2);
?>
<section id="experience" aria-labelledby="experience-heading" class="py-16 sm:py-20 relative">
	<div class="pointer-events-none absolute bottom-16 sm:bottom-20 left-20 sm:left-40 w-60 sm:w-80 h-60 sm:h-80 bg-accent opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 id="experience-heading" class="text-3xl sm:text-4xl md:text-5xl font-bold inline-block"><?= htmlspecialchars($title_parts[0] ?? '', ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?><span class="text-secondary"><?= htmlspecialchars($experience['title_highlight'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span><?= htmlspecialchars($title_parts[1] ?? '', ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></h2>
			<div class="w-16 sm:w-20 h-1 bg-linear-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
		</header>

		<ol class="relative max-w-5xl mx-auto space-y-8 md:space-y-12">
			<?php foreach ($experience['jobs'] as $job): ?>
				<li>
					<article class="bg-dark/60 backdrop-blur-xs border border-secondary/30 rounded-xl p-6 lg:p-8 shadow-xl hover:shadow-secondary/20 hover:border-secondary/50 transition-all duration-300">
						<header class="mb-4 pb-4 border-b border-secondary/20">
							<div class="flex flex-col xl:flex-row xl:items-start xl:justify-between gap-3">
								<div class="flex-1">
									<div class="flex flex-col flex-wrap gap-2 lg:flex-row lg:items-center lg:gap-3 mb-2">
										<h3 class="flex items-center gap-2 text-xl lg:text-2xl font-bold text-secondary">
											<?= Icon::render('briefcase', 'text-lg') ?>
											<?= htmlspecialchars($job['company'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>
										</h3>
										<span class="inline-flex items-center gap-1 w-fit bg-secondary/20 text-secondary px-3 py-1 rounded-full text-xs font-medium">
											<?= Icon::render('location-dot', 'text-[10px]') ?>
											<?= htmlspecialchars($job['location'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>
										</span>
										<?php if ($job['is_current']): ?>
											<span class="inline-flex items-center gap-1.5 w-fit bg-green-500/20 text-green-400 border border-green-400/30 px-3 py-1 rounded-full text-xs font-medium">
												<span class="inline-block w-1.5 h-1.5 rounded-full bg-green-400" aria-hidden="true"></span>
												Current
											</span>
										<?php endif; ?>
									</div>
									<p class="text-lg lg:text-xl font-semibold text-light"><?= htmlspecialchars($job['title'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></p>
									<p class="mt-1 text-sm text-gray-400"><?= htmlspecialchars($job['employment_type'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></p>
								</div>
								<div class="flex items-center gap-2 self-start bg-dark/50 border border-secondary/20 px-3 py-1.5 rounded-lg text-sm text-gray-400">
									<?= Icon::render('calendar', 'text-xs') ?>
									<span>
										<time datetime="<?= htmlspecialchars($job['datetime_start'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"><?= htmlspecialchars($job['period_start'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></time>
										-
										<?php if ($job['datetime_end']): ?>
											<time datetime="<?= htmlspecialchars($job['datetime_end'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"><?= htmlspecialchars($job['period_end'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></time>
										<?php else: ?>
											Present
										<?php endif; ?>
									</span>
								</div>
							</div>
						</header>

						<ul class="space-y-3 text-gray-300">
							<?php foreach ($job['responsibilities'] as $responsibility): ?>
								<li class="flex items-start gap-3">
									<?= Icon::render('circle-check', 'text-secondary mt-0.5 shrink-0') ?>
									<span class="text-sm lg:text-base"><?= htmlspecialchars($responsibility, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span>
								</li>
							<?php endforeach; ?>
						</ul>

						<footer class="mt-6 pt-6 border-t border-secondary/10">
							<h4 class="mb-3 text-sm font-medium text-gray-400"><?= htmlspecialchars($experience['technologies_label'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></h4>
							<ul class="flex flex-wrap gap-2">
								<?php foreach ($job['technologies'] as $tech): ?>
									<li class="bg-secondary/10 text-secondary px-3 py-1 rounded-full text-xs hover:bg-secondary/20 transition-colors duration-200">
										<?= htmlspecialchars($tech, ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</footer>
					</article>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
