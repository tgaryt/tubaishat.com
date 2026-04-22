<?php
declare(strict_types=1);

use Tubaishat\Support\Icon;

$current_year = date('Y');
?>
<footer class="py-8 bg-dark border-t border-secondary/20">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex flex-col md:flex-row justify-between items-center gap-6">
			<div class="text-center md:text-left">
				<div class="flex items-center justify-center md:justify-start gap-2 mb-2">
					<a href="#home"
					   class="text-secondary text-lg sm:text-xl font-bold font-mono hover:text-accent transition-colors duration-300 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded"
					   aria-label="Back to top">
						&lt;RT/&gt;
					</a>
					<span class="text-light"><?= htmlspecialchars($about['developer_info']['name'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?></span>
				</div>
				<p class="text-sm text-gray-400">
					&copy; <?= $current_year ?> <?= htmlspecialchars($footer['copyright_suffix'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>
				</p>
			</div>

			<nav aria-label="Social and contact links">
				<ul class="flex items-center gap-4 sm:gap-6">
					<li>
						<a href="mailto:<?= htmlspecialchars($contact_info['email'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						   aria-label="Email me"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<?= Icon::render('envelope', 'text-lg sm:text-xl') ?>
						</a>
					</li>
					<li>
						<a href="tel:<?= htmlspecialchars($contact_info['phone'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						   aria-label="Call me"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<?= Icon::render('phone', 'text-lg sm:text-xl') ?>
						</a>
					</li>
					<li>
						<a href="<?= htmlspecialchars($contact_info['whatsapp'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						   target="_blank"
						   rel="noopener noreferrer me"
						   aria-label="Message me on WhatsApp"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<?= Icon::render('whatsapp', 'text-lg sm:text-xl') ?>
						</a>
					</li>
					<li>
						<a href="<?= htmlspecialchars($contact_info['github'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						   target="_blank"
						   rel="noopener noreferrer me"
						   aria-label="Visit my GitHub profile"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<?= Icon::render('github', 'text-lg sm:text-xl') ?>
						</a>
					</li>
					<li>
						<a href="<?= htmlspecialchars($contact_info['linkedin'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						   target="_blank"
						   rel="noopener noreferrer me"
						   aria-label="Visit my LinkedIn profile"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<?= Icon::render('linkedin', 'text-lg sm:text-xl') ?>
						</a>
					</li>
					<li>
						<a href="<?= htmlspecialchars($contact_info['instagram'], ENT_QUOTES | ENT_HTML5 | ENT_SUBSTITUTE, 'UTF-8') ?>"
						   target="_blank"
						   rel="noopener noreferrer me"
						   aria-label="Visit my Instagram profile"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<?= Icon::render('instagram', 'text-lg sm:text-xl') ?>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</footer>
