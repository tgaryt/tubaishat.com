<section id="contact" class="py-16 sm:py-20 bg-gradient-to-b from-primary/50 to-dark/50 relative">
	<div class="absolute bottom-16 sm:bottom-20 right-20 sm:right-40 w-72 sm:w-96 h-72 sm:h-96 bg-secondary opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 class="text-2xl sm:text-3xl md:text-5xl font-bold mb-3 sm:mb-4 inline-block"><?= $contact_section['title'] ?></h2>
			<div class="w-16 sm:w-20 h-1 bg-gradient-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
		</header>
		<div class="bg-dark/40 backdrop-blur-sm border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl relative overflow-hidden">
			<div class="absolute -bottom-16 sm:-bottom-20 -left-16 sm:-left-20 w-48 sm:w-60 h-48 sm:h-60 bg-secondary opacity-5 -rotate-45" aria-hidden="true"></div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-12 relative z-10">
				<article>
					<div class="space-y-6 sm:space-y-8">
						<header>
							<h3 class="text-xl sm:text-2xl font-bold text-secondary mb-4 sm:mb-6"><?= $contact_section['subtitle'] ?></h3>
							<p class="text-base sm:text-lg mb-6 sm:mb-8 text-gray-200">
								<?= $contact_section['intro'] ?>
							</p>
						</header>
						<address class="space-y-4 sm:space-y-6 not-italic">
							<?php foreach($contact_section['contact_items'] as $item): ?>
								<div class="flex items-center group" <?php if(isset($item['type']) && in_array($item['type'], ['Email', 'Telephone', 'Place'])): ?>itemscope itemtype="https://schema.org/<?= $item['type'] ?>"<?php endif; ?>>
									<div class="bg-dark p-3 sm:p-4 rounded-xl text-secondary mr-4 sm:mr-6 border border-secondary/30 group-hover:bg-secondary/20 transition-all duration-300 transform group-hover:scale-110" aria-label="<?= $item['type'] ?>">
										<i class="<?= $item['icon'] ?> text-lg sm:text-xl" aria-hidden="true"></i>
									</div>
									<div>
										<h4 class="text-xs sm:text-sm text-gray-400 mb-1"><?= $item['type'] ?></h4>
										<?php if(isset($item['key']) && $item['key'] === 'email'): ?>
											<a href="mailto:<?= $contact_info[$item['key']] ?>" class="text-light hover:text-secondary transition-colors duration-300 text-base sm:text-lg" itemprop="email"><?= $contact_info[$item['key']] ?></a>
										<?php elseif(isset($item['key']) && $item['key'] === 'phone'): ?>
											<a href="tel:<?= $contact_info[$item['key']] ?>" class="text-light hover:text-secondary transition-colors duration-300 text-base sm:text-lg" itemprop="telephone"><?= $contact_info[$item['display_key']] ?></a>
										<?php elseif(isset($item['key']) && ($item['key'] === 'github' || $item['key'] === 'linkedin' || $item['key'] === 'instagram')): ?>
											<a href="<?= $contact_info[$item['key']] ?>" target="_blank" rel="noopener noreferrer" class="text-light hover:text-secondary transition-colors duration-300 text-base sm:text-lg"><?= $item['display'] ?></a>
										<?php else: ?>
											<p class="text-base sm:text-lg" <?php if($item['type'] === 'Location'): ?>itemprop="name"<?php endif; ?>><?= $contact_info[$item['key']] ?></p>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</address>
					</div>
				</article>
				<article>
					<div class="bg-dark/60 backdrop-blur-md rounded-xl border border-secondary/20 p-6 sm:p-8 shadow-xl">
						<header class="flex items-center mb-4 sm:mb-6">
							<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500 mr-1.5 sm:mr-2" aria-hidden="true"></div>
							<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500 mr-1.5 sm:mr-2" aria-hidden="true"></div>
							<div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500" aria-hidden="true"></div>
							<span class="ml-3 sm:ml-4 text-secondary opacity-70 font-mono text-xs sm:text-sm">contact.js</span>
						</header>
<pre class="font-mono text-xs sm:text-sm md:text-base overflow-x-auto">
<span class="text-gray-300"><span class="text-secondary">const</span> <span class="text-green-400">sendMessage</span> = <span class="text-purple-400">async</span> () => {
	<span class="text-purple-400">const</span> response = <span class="text-purple-400">await</span> fetch(<span class="text-yellow-300">'mailto:<?= $contact_info['email'] ?>'</span>, {
		method: <span class="text-yellow-300">'POST'</span>,
		headers: {
			<span class="text-yellow-300">'Content-Type'</span>: <span class="text-yellow-300">'application/json'</span>
		},
		body: JSON.stringify({
			name: <span class="text-yellow-300">'Your Name'</span>,
			email: <span class="text-yellow-300">'your.email@example.com'</span>,
			message: <span class="text-yellow-300">'I would like to discuss a job opportunity...'</span>
		})
	});
								
	<span class="text-purple-400">if</span> (response.ok) {
		console.log(<span class="text-yellow-300">'Message sent successfully!'</span>);
	}
};
sendMessage();</span>
</pre>
						<div class="mt-6 pt-6 border-t border-secondary/10">
							<a href="mailto:<?= $contact_info['email'] ?>" class="inline-flex items-center text-secondary hover:text-accent transition-colors duration-300">
								<span class="mr-2"><?= $contact_section['cta_text'] ?></span>
								<i class="fas fa-arrow-right" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
</section>
