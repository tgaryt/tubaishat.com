<nav x-data="{ isOpen: false }" class="fixed top-0 left-0 right-0 z-50 backdrop-blur-xl bg-dark/90 border-b border-secondary/10 shadow-lg shadow-primary/5">
	<div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
		<div class="flex items-center justify-between h-14 sm:h-16">
			<div class="flex items-center">
				<div class="flex-shrink-0">
					<a href="/"
					   class="text-secondary text-lg sm:text-xl font-bold font-mono hover:text-accent transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-secondary/50 rounded"
					   aria-label="Rayyan Tubaishat - Home">&lt;RT/&gt;</a>
				</div>
				<div class="hidden md:block">
					<nav class="ml-6 lg:ml-10 flex items-baseline space-x-3 lg:space-x-6" role="navigation" aria-label="Main navigation">
						<?php foreach ($navigation_links as $key => $value): ?>
							<?php if ($key === 'contact'): ?>
								<a href="#<?= htmlspecialchars($key) ?>"
								   class="bg-gradient-to-r from-secondary to-accent text-primary hover:from-accent hover:to-secondary px-3 lg:px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105 shadow-lg shadow-secondary/20 focus:outline-none focus:ring-2 focus:ring-secondary/50"
								   aria-label="<?= htmlspecialchars($value) ?> section"><?= htmlspecialchars($value) ?></a>
							<?php else: ?>
								<a href="#<?= htmlspecialchars($key) ?>"
								   class="text-light hover:text-secondary transition-all duration-300 px-2 lg:px-3 py-2 text-sm font-medium relative group focus:outline-none focus:ring-2 focus:ring-secondary/50 rounded"
								   aria-label="<?= htmlspecialchars($value) ?> section">
									<?= htmlspecialchars($value) ?>
									<span class="absolute bottom-0 left-0 w-0 h-0.5 bg-secondary transition-all duration-300 group-hover:w-full"></span>
								</a>
							<?php endif; ?>
						<?php endforeach; ?>
					</nav>
				</div>
			</div>
			<div class="md:hidden">
				<button @click="isOpen = !isOpen"
						type="button"
						class="inline-flex items-center justify-center p-2 rounded-md text-light hover:text-secondary hover:bg-primary/60 focus:outline-none focus:ring-2 focus:ring-secondary/50 transition-all duration-300"
						:aria-expanded="isOpen"
						aria-controls="mobile-menu"
						aria-label="Toggle navigation menu">
					<svg class="h-5 w-5 sm:h-6 sm:w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
						<path :class="{'hidden': isOpen, 'inline-flex': !isOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
						<path :class="{'hidden': !isOpen, 'inline-flex': isOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
		</div>
	</div>
	<div id="mobile-menu"
		 x-cloak
		 x-show="isOpen"
		 x-transition:enter="transition ease-out duration-200"
		 x-transition:enter-start="opacity-0 -translate-y-1"
		 x-transition:enter-end="opacity-100 translate-y-0"
		 x-transition:leave="transition ease-in duration-150"
		 x-transition:leave-start="opacity-100 translate-y-0"
		 x-transition:leave-end="opacity-0 -translate-y-1"
		 class="md:hidden"
		 role="dialog"
		 aria-modal="true"
		 aria-label="Mobile navigation menu">
		<nav class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-secondary/10 bg-dark/95 backdrop-blur-lg" role="navigation">
			<?php foreach ($navigation_links as $key => $value): ?>
				<?php if ($key === 'contact'): ?>
					<a href="#<?= htmlspecialchars($key) ?>"
					   @click="isOpen = false"
					   class="bg-gradient-to-r from-secondary to-accent text-primary hover:from-accent hover:to-secondary block px-3 py-2 rounded-lg text-base font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-secondary/50"
					   aria-label="<?= htmlspecialchars($value) ?> section"><?= htmlspecialchars($value) ?></a>
				<?php else: ?>
					<a href="#<?= htmlspecialchars($key) ?>"
					   @click="isOpen = false"
					   class="text-light hover:bg-primary/60 hover:text-secondary block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-secondary/50"
					   aria-label="<?= htmlspecialchars($value) ?> section"><?= htmlspecialchars($value) ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</nav>
	</div>
</nav>
