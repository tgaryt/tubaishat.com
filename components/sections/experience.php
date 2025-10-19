<section id="experience" class="py-16 sm:py-20 relative">
	<div class="absolute bottom-16 sm:bottom-20 left-20 sm:left-40 w-60 sm:w-80 h-60 sm:h-80 bg-accent opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-3 sm:mb-4 inline-block"><?= $experience_section['title'] ?></h2>
			<div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
		</header>
		<div class="relative max-w-6xl mx-auto">
			<div class="absolute left-8 md:left-12 top-0 h-full w-1 bg-gradient-to-b from-secondary/70 to-secondary/20 rounded-full" aria-hidden="true"></div>
			<div class="space-y-8 md:space-y-12">
				<?php foreach($experience_section['jobs'] as $index => $job): ?>
				<article class="relative group">
					<div class="absolute left-8 md:left-12 -mt-2 w-4 h-4 rounded-full bg-secondary transform -translate-x-1/2 shadow-lg shadow-secondary/20 z-10 transition-all duration-300 group-hover:scale-125 group-hover:shadow-secondary/40" aria-hidden="true"></div>
					<div class="ml-16 md:ml-24">
						<div class="bg-dark/60 backdrop-blur-sm border border-secondary/30 rounded-xl p-6 lg:p-8 shadow-xl hover:shadow-secondary/20 hover:border-secondary/50 transition-all duration-300 hover:transform hover:scale-[1.02]">
							<header class="flex flex-col xl:flex-row xl:items-start xl:justify-between mb-4">
								<div class="flex-1">
									<div class="flex flex-col lg:flex-row lg:items-center lg:gap-3 mb-2">
										<h3 class="text-xl lg:text-2xl font-bold text-secondary"><?= htmlspecialchars($job['company']) ?></h3>
										<span class="inline-block lg:block bg-secondary/20 text-secondary px-3 py-1 rounded-full text-xs font-medium mt-2 lg:mt-0 w-fit"><?= htmlspecialchars($job['location']) ?></span>
									</div>
									<h4 class="text-lg lg:text-xl font-semibold text-light mb-2"><?= htmlspecialchars($job['title']) ?></h4>
								</div>
								<div class="flex-shrink-0 xl:ml-6">
									<time datetime="<?= $job['datetime'] ?>" class="text-gray-400 text-sm xl:text-base bg-dark/50 px-3 py-1 rounded-lg border border-secondary/20"><?= htmlspecialchars($job['period']) ?></time>
								</div>
							</header>
							<div class="space-y-4">
								<ul class="space-y-3 text-gray-300" role="list">
									<?php foreach($job['responsibilities'] as $responsibility): ?>
									<li class="flex items-start" role="listitem">
										<div class="mr-3 mt-1 text-secondary flex-shrink-0" aria-hidden="true">
											<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
												<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
											</svg>
										</div>
										<span class="text-sm lg:text-base"><?= htmlspecialchars($responsibility) ?></span>
									</li>
									<?php endforeach; ?>
								</ul>
								<div class="mt-6 pt-6 border-t border-secondary/10">
									<h5 class="text-sm font-medium text-gray-400 mb-3">Key Technologies:</h5>
									<div class="flex flex-wrap gap-2">
										<?php foreach($job['technologies'] as $tech): ?>
										<span class="px-3 py-1 bg-secondary/10 text-secondary rounded-full text-xs hover:bg-secondary/20 transition-colors duration-200"><?= htmlspecialchars($tech) ?></span>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
