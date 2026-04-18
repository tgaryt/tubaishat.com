<?php
declare(strict_types=1);
?>
<header class="fixed inset-x-0 top-0 z-50 backdrop-blur-xl bg-dark/80 border-b border-secondary/10 shadow-lg shadow-primary/5">
	<nav aria-label="Primary" class="max-w-7xl mx-auto flex items-center justify-between h-14 sm:h-16 px-4 sm:px-6 lg:px-8">
		<a href="/"
		   aria-label="<?= htmlspecialchars($about['developer_info']['name'], ENT_QUOTES, 'UTF-8') ?> - Home"
		   class="text-secondary text-lg sm:text-xl font-bold font-mono hover:text-accent transition-colors duration-300 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
			&lt;RT/&gt;
		</a>

		<ul class="hidden md:flex items-center gap-3 lg:gap-6">
			<?php foreach ($navigation_links as $key => $value): ?>
				<li>
					<?php if ($key === 'contact'): ?>
						<a href="#<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>"
						   class="bg-linear-to-r from-secondary to-accent text-primary hover:from-accent hover:to-secondary px-3 lg:px-4 py-2 rounded-lg text-sm font-medium transition-transform duration-300 hover:scale-105 shadow-lg shadow-secondary/20 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50">
							<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>
						</a>
					<?php else: ?>
						<a href="#<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>"
						   class="text-light hover:text-secondary transition-colors duration-300 px-2 lg:px-3 py-2 text-sm font-medium relative group focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>
							<span class="absolute inset-x-0 bottom-0 h-0.5 w-0 bg-secondary transition-all duration-300 group-hover:w-full" aria-hidden="true"></span>
						</a>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>

		<button id="mobileNavToggle"
		        type="button"
		        aria-expanded="false"
		        aria-controls="mobile-menu"
		        aria-label="Toggle navigation menu"
		        class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-light hover:text-secondary hover:bg-primary/60 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 transition-colors duration-300">
			<svg data-icon="open" class="h-5 w-5 sm:h-6 sm:w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
			</svg>
			<svg data-icon="close" hidden class="h-5 w-5 sm:h-6 sm:w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
			</svg>
		</button>

		<div id="mobile-menu"
		     data-state="closed"
		     inert
		     class="mobile-menu md:hidden absolute top-full inset-x-0 border-t border-secondary/10 bg-dark/95 backdrop-blur-lg">
			<ul class="px-4 py-3 space-y-1">
				<?php foreach ($navigation_links as $key => $value): ?>
					<li>
						<a href="#<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>"
						   class="<?= $key === 'contact' ? 'bg-linear-to-r from-secondary to-accent text-primary' : 'text-light hover:bg-primary/60 hover:text-secondary' ?> block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50">
							<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</nav>
</header>
