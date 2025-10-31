<section id="about" class="py-16 sm:py-20 bg-gradient-to-b from-primary/50 to-dark/50 relative">
	<div class="absolute top-16 sm:top-20 right-20 sm:right-40 w-48 sm:w-72 h-48 sm:h-72 bg-secondary opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-3 sm:mb-4 inline-block"><?= $about_section['title'] ?></h2>
			<div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
		</header>
		<div class="bg-dark/40 backdrop-blur-sm border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl relative overflow-hidden">
			<div class="absolute -top-8 sm:-top-10 -right-8 sm:-right-10 w-32 sm:w-40 h-32 sm:h-40 bg-secondary opacity-10 rotate-45" aria-hidden="true"></div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-12 items-center relative z-10">
				<article class="space-y-3 sm:space-y-4 font-mono text-xs sm:text-sm md:text-base order-2 md:order-1">
					<div class="flex items-center mb-4 sm:mb-6">
						<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500 mr-1.5 sm:mr-2" aria-hidden="true"></div>
						<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500 mr-1.5 sm:mr-2" aria-hidden="true"></div>
						<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500" aria-hidden="true"></div>
						<span class="ml-3 sm:ml-4 text-secondary opacity-70 font-mono">about.js</span>
					</div>
					<div class="bg-dark/70 backdrop-blur-md rounded-lg p-4 sm:p-6 border border-secondary/20 shadow-lg overflow-x-auto">
<pre class="text-gray-300 whitespace-pre">
<span class="text-secondary">const</span> <span class="text-green-400">developer</span> = {
	<span class="text-purple-400">name</span>: <span class="text-yellow-300">'<?= $about_section['developer_info']['name'] ?>'</span>,
	<span class="text-purple-400">title</span>: <span class="text-yellow-300">'<?= $about_section['developer_info']['title'] ?>'</span>,
	<span class="text-purple-400">location</span>: <span class="text-yellow-300">'<?= $about_section['developer_info']['location'] ?>'</span>,
	<span class="text-purple-400">education</span>: <span class="text-yellow-300">'<?= $about_section['developer_info']['education'] ?>'</span>,
	<span class="text-purple-400">experience</span>: <span class="text-yellow-300">'<?= $about_section['developer_info']['experience'] ?>'</span>
};
</pre>
					</div>
				</article>
				<article class="order-1 md:order-2">
					<h3 class="text-xl sm:text-2xl font-bold text-secondary mb-4 sm:mb-6"><?= $about_section['subtitle'] ?></h3>
					<div class="space-y-4 sm:space-y-6 text-gray-200">
						<?php foreach($about_section['paragraphs'] as $paragraph): ?>
							<p class="text-base sm:text-lg">
								<?= $paragraph ?>
							</p>
						<?php endforeach; ?>
					</div>
					<div class="mt-6 sm:mt-8 grid grid-cols-2 gap-4 sm:gap-6">
						<?php foreach($about_section['stats'] as $stat): ?>
							<div class="bg-dark/50 rounded-lg p-4 border border-secondary/10">
								<div class="text-secondary text-2xl font-bold"><?= $stat['value'] ?></div>
								<div class="text-sm text-gray-400"><?= $stat['label'] ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>
