<section id="skills" aria-labelledby="skills-heading" class="py-16 sm:py-20 relative">
	<div class="pointer-events-none absolute top-32 sm:top-40 right-12 sm:right-20 w-64 sm:w-80 h-64 sm:h-80 bg-secondary opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 id="skills-heading" class="text-3xl sm:text-4xl md:text-5xl font-bold inline-block">
				<?= $skills_section['title'] ?>
			</h2>
			<div class="w-16 sm:w-20 h-1 bg-linear-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
		</header>

		<ul class="grid gap-6 sm:grid-cols-2 sm:gap-8">
			<?php foreach ($skills_section['categories'] as $index => $category): ?>
				<?php $cat_id = 'skill-cat-' . $index; ?>
				<li>
					<article aria-labelledby="<?= htmlspecialchars($cat_id) ?>" class="h-full bg-dark/40 backdrop-blur-xs border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl hover:border-secondary/30 transition-all duration-300">
						<header class="flex items-center gap-3 mb-6">
							<div class="inline-flex items-center justify-center rounded-lg border border-secondary/20 bg-secondary/10 p-2.5 text-secondary">
								<?= icon($category['icon']) ?>
							</div>
							<h3 id="<?= htmlspecialchars($cat_id) ?>" class="text-lg sm:text-xl font-bold text-secondary">
								<?= htmlspecialchars($category['title']) ?>
							</h3>
						</header>

						<ul class="flex flex-wrap gap-3">
							<?php foreach ($category['skills'] as $skill): ?>
								<li class="inline-flex items-center gap-2 bg-secondary/10 hover:bg-secondary/20 border border-secondary/20 rounded-full pl-2 pr-3.5 py-1.5 text-sm font-medium text-light transition-colors duration-200">
									<?= icon($skill['icon'], 'text-lg ' . ($skill['icon_class'] ?? '')) ?>
									<span><?= htmlspecialchars($skill['name']) ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					</article>
				</li>
			<?php endforeach; ?>
		</ul>

		<footer class="mt-12 text-center">
			<p class="text-sm sm:text-base text-gray-400">
				<?= htmlspecialchars($skills_section['footer_text']) ?>
			</p>
		</footer>
	</div>
</section>
