<section id="contact" aria-labelledby="contact-heading" class="py-16 sm:py-20 bg-linear-to-b from-primary/50 to-dark/50 relative">
	<div class="pointer-events-none absolute bottom-16 sm:bottom-20 right-20 sm:right-40 w-72 sm:w-96 h-72 sm:h-96 bg-secondary opacity-5 rounded-full blur-3xl -z-10" aria-hidden="true"></div>

	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<header class="text-center mb-12 sm:mb-16">
			<h2 id="contact-heading" class="text-3xl sm:text-4xl md:text-5xl font-bold inline-block">
				<?= $contact_section['title'] ?>
			</h2>
			<div class="w-16 sm:w-20 h-1 bg-linear-to-r from-secondary to-accent mx-auto mt-3 sm:mt-4" aria-hidden="true"></div>
			<p class="mx-auto mt-6 max-w-2xl text-base sm:text-lg text-gray-300">
				<?= htmlspecialchars($contact_section['intro']) ?>
			</p>
		</header>

		<div class="bg-dark/40 backdrop-blur-xs border border-secondary/20 rounded-xl p-6 sm:p-8 shadow-xl">
			<address class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 not-italic">
				<?php foreach ($contact_section['contact_items'] as $item):
					$key = $item['key'];
					$display_key = $item['display_key'] ?? $key;
					$value = $contact_info[$key];
					$display = $contact_info[$display_key];
					$is_email = ($key === 'email');
					$is_phone = ($key === 'phone');
					$is_external = in_array($key, ['github', 'linkedin', 'instagram'], true);
					$href = null;
					if ($is_email) {
						$href = 'mailto:' . $value;
					} elseif ($is_phone) {
						$href = 'tel:' . $value;
					} elseif ($is_external) {
						$href = $value;
					}
				?>
					<?php if ($href !== null): ?>
						<a href="<?= htmlspecialchars($href) ?>"
						   class="group flex items-start gap-4 rounded-lg border border-secondary/10 bg-dark/50 hover:bg-dark/70 hover:border-secondary/40 p-5 transition-all duration-300"
						   <?php if ($is_external): ?>target="_blank" rel="noopener noreferrer me"<?php endif; ?>>
							<div class="shrink-0 inline-flex items-center justify-center rounded-xl border border-secondary/30 bg-dark p-3 text-secondary group-hover:bg-secondary/20 transition-all duration-300 group-hover:scale-110">
								<i class="<?= htmlspecialchars($item['icon']) ?> text-lg sm:text-xl" aria-hidden="true"></i>
							</div>
							<div class="min-w-0 flex-1">
								<div class="text-xs text-gray-400"><?= htmlspecialchars($item['type']) ?></div>
								<div class="text-base text-light truncate"><?= htmlspecialchars($display) ?></div>
							</div>
						</a>
					<?php else: ?>
						<div class="flex items-start gap-4 rounded-lg border border-secondary/10 bg-dark/50 p-5">
							<div class="shrink-0 inline-flex items-center justify-center rounded-xl border border-secondary/30 bg-dark p-3 text-secondary">
								<i class="<?= htmlspecialchars($item['icon']) ?> text-lg sm:text-xl" aria-hidden="true"></i>
							</div>
							<div class="min-w-0 flex-1">
								<div class="text-xs text-gray-400"><?= htmlspecialchars($item['type']) ?></div>
								<div class="text-base text-light"><?= htmlspecialchars($display) ?></div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</address>

			<div class="mt-8 pt-8 border-t border-secondary/10 flex justify-center">
				<a href="mailto:<?= htmlspecialchars($contact_info['email']) ?>"
				   class="inline-flex items-center gap-2 bg-linear-to-r from-secondary to-accent hover:from-accent hover:to-secondary text-primary font-semibold py-3 px-8 rounded-lg shadow-lg shadow-secondary/20 transition-transform duration-300 hover:scale-105 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50">
					<span><?= htmlspecialchars($contact_section['cta_text']) ?></span>
					<i class="fas fa-arrow-right" aria-hidden="true"></i>
				</a>
			</div>
		</div>
	</div>
</section>
