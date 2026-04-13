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
					<span class="text-light"><?= htmlspecialchars($about_section['developer_info']['name']) ?></span>
				</div>
				<p class="text-sm text-gray-400">
					<?= $footer_section['copyright'] ?>
				</p>
			</div>

			<nav aria-label="Social and contact links">
				<ul class="flex items-center gap-4 sm:gap-6">
					<li>
						<a href="mailto:<?= htmlspecialchars($contact_info['email']) ?>"
						   aria-label="Email me"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<i class="fas fa-envelope text-lg sm:text-xl" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="<?= htmlspecialchars($contact_info['github']) ?>"
						   target="_blank"
						   rel="noopener noreferrer me"
						   aria-label="Visit my GitHub profile"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<i class="fab fa-github text-lg sm:text-xl" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="<?= htmlspecialchars($contact_info['linkedin']) ?>"
						   target="_blank"
						   rel="noopener noreferrer me"
						   aria-label="Visit my LinkedIn profile"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<i class="fab fa-linkedin text-lg sm:text-xl" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="<?= htmlspecialchars($contact_info['instagram']) ?>"
						   target="_blank"
						   rel="noopener noreferrer me"
						   aria-label="Visit my Instagram profile"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<i class="fab fa-instagram text-lg sm:text-xl" aria-hidden="true"></i>
						</a>
					</li>
					<li>
						<a href="tel:<?= htmlspecialchars($contact_info['phone']) ?>"
						   aria-label="Call me"
						   class="text-gray-400 hover:text-secondary hover:scale-110 transition-all duration-300 inline-block focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 rounded">
							<i class="fas fa-phone text-lg sm:text-xl" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</footer>
