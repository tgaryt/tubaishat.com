<section id="skills" class="py-16 sm:py-20 relative">
	<div class="absolute top-32 sm:top-40 right-12 sm:right-20 w-64 sm:w-80 h-64 sm:h-80 bg-secondary opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-3 sm:mb-4 inline-block">
				<?= $skills_section['title'] ?>
			</h2>
			<div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
		</header>
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
			<article class="bg-dark/40 backdrop-blur-sm border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl hover:border-secondary/30 transition-all duration-300">
				<header class="flex items-center mb-6 sm:mb-8">
					<i class="<?= $skills_section['categories'][0]['icon'] ?> mr-2 sm:mr-3 text-secondary" aria-hidden="true"></i>
					<h3 class="text-lg sm:text-xl font-bold text-secondary"><?= $skills_section['categories'][0]['title'] ?></h3>
				</header>
				<div class="space-y-6 sm:space-y-8">
					<?php foreach ($skills_section['categories'][0]['skills'] as $skill): ?>
						<div>
							<div class="flex justify-between items-center mb-2">
								<span class="text-sm sm:text-base font-medium"><?= htmlspecialchars($skill['name']) ?></span>
								<span class="text-sm sm:text-base text-secondary"><?= $skill['level'] ?>%</span>
							</div>
							<div class="h-2 bg-secondary/20 rounded-full overflow-hidden">
								<div class="h-full bg-gradient-to-r from-secondary to-accent rounded-full transition-all duration-1000 ease-out" 
									 style="width: <?= $skill['level'] ?>%"
									 role="progressbar"
									 aria-valuenow="<?= $skill['level'] ?>"
									 aria-valuemin="0"
									 aria-valuemax="100"
									 aria-label="<?= htmlspecialchars($skill['name']) ?> skill level: <?= $skill['level'] ?>%">
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</article>
			<article class="bg-dark/40 backdrop-blur-sm border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl hover:border-secondary/30 transition-all duration-300">
				<header class="flex items-center mb-6 sm:mb-8">
					<i class="<?= $skills_section['categories'][1]['icon'] ?> mr-2 sm:mr-3 text-secondary" aria-hidden="true"></i>
					<h3 class="text-lg sm:text-xl font-bold text-secondary"><?= $skills_section['categories'][1]['title'] ?></h3>
				</header>
				<div class="space-y-6 sm:space-y-8">
					<?php foreach ($skills_section['categories'][1]['skills'] as $skill): ?>
						<div>
							<div class="flex justify-between items-center mb-2">
								<span class="text-sm sm:text-base font-medium"><?= htmlspecialchars($skill['name']) ?></span>
								<span class="text-sm sm:text-base text-secondary"><?= $skill['level'] ?>%</span>
							</div>
							<div class="h-2 bg-secondary/20 rounded-full overflow-hidden">
								<div class="h-full bg-gradient-to-r from-secondary to-accent rounded-full transition-all duration-1000 ease-out" 
									 style="width: <?= $skill['level'] ?>%"
									 role="progressbar"
									 aria-valuenow="<?= $skill['level'] ?>"
									 aria-valuemin="0"
									 aria-valuemax="100"
									 aria-label="<?= htmlspecialchars($skill['name']) ?> skill level: <?= $skill['level'] ?>%"></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</article>
		</div>
		<div class="mt-8 sm:mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
			<article class="md:col-span-2 bg-dark/40 backdrop-blur-sm border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl hover:border-secondary/30 transition-all duration-300">
				<header class="flex items-center mb-6 sm:mb-8">
					<i class="<?= $skills_section['categories'][2]['icon'] ?> mr-2 sm:mr-3 text-secondary" aria-hidden="true"></i>
					<h3 class="text-lg sm:text-xl font-bold text-secondary"><?= $skills_section['categories'][2]['title'] ?></h3>
				</header>
				<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
					<?php foreach ($skills_section['categories'][2]['tools'] as $tool): ?>
						<div class="bg-dark/50 backdrop-blur-sm rounded-lg p-3 sm:p-4 text-center border border-secondary/10 hover:border-secondary/30 transition-all duration-300 transform hover:scale-105"
							 tabindex="0"
							 aria-label="<?= htmlspecialchars($tool['name']) ?> technology">
							<i class="<?= htmlspecialchars($tool['icon']) ?> text-xl sm:text-2xl text-secondary mb-1 sm:mb-2" aria-hidden="true"></i>
							<p class="text-xs sm:text-sm text-gray-300"><?= htmlspecialchars($tool['name']) ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</article>
			<article class="bg-dark/40 backdrop-blur-sm border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl hover:border-secondary/30 transition-all duration-300">
				<header class="flex items-center mb-6 sm:mb-8">
					<i class="<?= $skills_section['categories'][3]['icon'] ?> mr-2 sm:mr-3 text-secondary" aria-hidden="true"></i>
					<h3 class="text-lg sm:text-xl font-bold text-secondary"><?= $skills_section['categories'][3]['title'] ?></h3>
				</header>
				<div class="space-y-6 sm:space-y-8">
					<?php foreach ($skills_section['categories'][3]['skills'] as $lang): ?>
						<div>
							<div class="flex justify-between items-center mb-2">
								<span class="text-sm sm:text-base font-medium"><?= htmlspecialchars($lang['name']) ?></span>
								<span class="text-sm sm:text-base text-secondary"><?= $lang['level'] ?>%</span>
							</div>
							<div class="h-2 bg-secondary/20 rounded-full overflow-hidden">
								<div class="h-full bg-gradient-to-r from-secondary to-accent rounded-full transition-all duration-1000 ease-out" 
									 style="width: <?= $lang['level'] ?>%"
									 role="progressbar"
									 aria-valuenow="<?= $lang['level'] ?>"
									 aria-valuemin="0"
									 aria-valuemax="100"
									 aria-label="<?= htmlspecialchars($lang['name']) ?> proficiency: <?= $lang['level'] ?>%"></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</article>
		</div>
		<footer class="mt-12 text-center">
			<p class="text-gray-400 text-sm sm:text-base">
				<?= $skills_section['footer_text'] ?>
			</p>
		</footer>
	</div>
</section>
