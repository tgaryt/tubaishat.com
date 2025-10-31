<section id="experience" class="py-16 sm:py-20 relative">
	<div class="absolute bottom-16 sm:bottom-20 left-20 sm:left-40 w-60 sm:w-80 h-60 sm:h-80 bg-accent opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-3 sm:mb-4 inline-block"><?= $experience_section['title'] ?></h2>
			<div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
		</header>
		<div class="relative max-w-6xl mx-auto">
			<div class="space-y-8 md:space-y-12">
				<?php foreach($experience_section['jobs'] as $index => $job): ?>
				<article class="relative group">
					<?php if (isset($job['has_promotion']) && $job['has_promotion']): ?>
						<div class="bg-dark/60 backdrop-blur-sm border border-secondary/30 rounded-xl p-6 lg:p-8 shadow-xl hover:shadow-secondary/20 hover:border-secondary/50 transition-all duration-300">
							<header class="mb-6 pb-4 border-b border-secondary/20">
								<div class="flex flex-col xl:flex-row xl:items-start xl:justify-between">
									<div class="flex-1">
										<div class="flex flex-col lg:flex-row lg:items-center lg:gap-3 mb-2">
											<h3 class="text-xl lg:text-2xl font-bold text-secondary"><?= htmlspecialchars($job['company']) ?></h3>
											<span class="inline-block lg:block bg-secondary/20 text-secondary px-3 py-1 rounded-full text-xs font-medium mt-2 lg:mt-0 w-fit"><?= htmlspecialchars($job['location']) ?></span>
										</div>
										<p class="text-gray-400 text-sm"><?= htmlspecialchars($job['employment_type']) ?></p>
									</div>
									<div class="flex-shrink-0 xl:ml-6 mt-3 xl:mt-0">
										<time datetime="<?= $job['total_datetime'] ?>" class="text-gray-400 text-sm xl:text-base bg-dark/50 px-3 py-1 rounded-lg border border-secondary/20"><?= htmlspecialchars($job['total_period']) ?></time>
									</div>
								</div>
							</header>
							<div class="space-y-8">
								<?php foreach($job['roles'] as $roleIndex => $role): ?>
								<div class="relative pl-8">
									<div class="absolute left-0 top-2 w-4 h-4 rounded-full <?= $role['is_current'] ? 'bg-secondary' : 'bg-secondary/50' ?> shadow-lg <?= $role['is_current'] ? 'shadow-secondary/20' : 'shadow-secondary/10' ?>" aria-hidden="true"></div>
									<?php if ($roleIndex < count($job['roles']) - 1): ?>
									<div class="absolute left-2 top-6 w-px h-[calc(100%+2rem)] bg-gradient-to-b from-secondary/50 to-secondary/20" aria-hidden="true"></div>
									<?php endif; ?>
									<div class="space-y-4">
										<header class="flex flex-col xl:flex-row xl:items-start xl:justify-between">
											<div class="flex-1">
												<h4 class="text-lg lg:text-xl font-semibold text-light mb-1"><?= htmlspecialchars($role['title']) ?></h4>
												<time datetime="<?= $role['datetime'] ?>" class="text-gray-400 text-sm"><?= htmlspecialchars($role['period']) ?></time>
											</div>
										</header>
										<ul class="space-y-3 text-gray-300" role="list">
											<?php foreach($role['responsibilities'] as $responsibility): ?>
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
										<?php if (!$role['is_current']): ?>
										<div class="pt-4">
											<h5 class="text-sm font-medium text-gray-400 mb-3"><?= $experience_section['technologies_label'] ?></h5>
											<div class="flex flex-wrap gap-2">
												<?php foreach($role['technologies'] as $tech): ?>
												<span class="px-3 py-1 bg-secondary/10 text-secondary rounded-full text-xs hover:bg-secondary/20 transition-colors duration-200"><?= htmlspecialchars($tech) ?></span>
												<?php endforeach; ?>
											</div>
										</div>
										<?php endif; ?>
									</div>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					<?php else: ?>
						<div class="bg-dark/60 backdrop-blur-sm border border-secondary/30 rounded-xl p-6 lg:p-8 shadow-xl hover:shadow-secondary/20 hover:border-secondary/50 transition-all duration-300">
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
									<h5 class="text-sm font-medium text-gray-400 mb-3"><?= $experience_section['technologies_label'] ?></h5>
									<div class="flex flex-wrap gap-2">
										<?php foreach($job['technologies'] as $tech): ?>
										<span class="px-3 py-1 bg-secondary/10 text-secondary rounded-full text-xs hover:bg-secondary/20 transition-colors duration-200"><?= htmlspecialchars($tech) ?></span>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
