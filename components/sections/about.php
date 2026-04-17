<section id="about" aria-labelledby="about-heading" class="py-16 sm:py-20 bg-linear-to-b from-primary/50 to-dark/50 relative">
	<div class="pointer-events-none absolute top-16 sm:top-20 right-20 sm:right-40 w-48 sm:w-72 h-48 sm:h-72 bg-secondary opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 id="about-heading" class="text-3xl sm:text-4xl md:text-5xl font-bold inline-block">
				<?= $about_section['title'] ?>
			</h2>
			<div class="w-16 sm:w-20 h-1 bg-linear-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
		</header>

		<article class="relative overflow-hidden bg-dark/40 backdrop-blur-xs border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl">
			<div class="relative z-10 grid grid-cols-1 md:grid-cols-[1fr_1.2fr] gap-10 sm:gap-12 items-start">
				<div class="space-y-4">
					<h3 class="text-xl sm:text-2xl font-bold text-secondary">
						<?= htmlspecialchars($about_section['subtitle']) ?>
					</h3>

					<dl class="grid grid-cols-1 gap-3 text-sm sm:text-base">
						<div class="rounded-lg border border-secondary/10 bg-dark/50 p-4">
							<dt class="flex items-center gap-2 text-xs text-gray-400">
								<i class="fas fa-map-marker-alt text-base text-secondary" aria-hidden="true"></i>
								<span>Location</span>
							</dt>
							<dd class="text-light mt-1"><?= htmlspecialchars($about_section['developer_info']['location']) ?></dd>
						</div>
						<div class="rounded-lg border border-secondary/10 bg-dark/50 p-4">
							<dt class="flex items-center gap-2 text-xs text-gray-400">
								<i class="fas fa-graduation-cap text-base text-secondary" aria-hidden="true"></i>
								<span>Education</span>
							</dt>
							<dd class="text-light mt-1"><?= htmlspecialchars($about_section['developer_info']['education']) ?></dd>
						</div>
					</dl>

					<div class="grid grid-cols-2 gap-4 pt-2">
						<?php foreach ($about_section['stats'] as $stat): ?>
							<div class="rounded-lg border border-secondary/10 bg-dark/50 p-4 text-center">
								<div class="text-2xl font-bold text-secondary"><?= htmlspecialchars($stat['value']) ?></div>
								<div class="text-xs sm:text-sm text-gray-400"><?= htmlspecialchars($stat['label']) ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="space-y-4 sm:space-y-5 text-gray-200">
					<?php foreach ($about_section['paragraphs'] as $paragraph): ?>
						<p class="text-base sm:text-lg leading-relaxed">
							<?= htmlspecialchars($paragraph) ?>
						</p>
					<?php endforeach; ?>
				</div>
			</div>
		</article>
	</div>
</section>
