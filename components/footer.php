<footer class="py-6 sm:py-8 bg-dark border-t border-secondary/20" role="contentinfo">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex flex-col md:flex-row justify-between items-center gap-6">
			<div class="text-center md:text-left">
				<div class="flex items-center justify-center md:justify-start mb-4">
					<a href="#home"
					   class="text-secondary text-lg sm:text-xl font-bold font-mono hover:text-accent transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-secondary/50 rounded"
					   aria-label="Back to top">&lt;RT/&gt;</a>
					<span class="ml-2 text-light whitespace-nowrap">Rayyan Tubaishat</span>
				</div>
				<p class="text-gray-300 text-sm sm:text-base">
					<?= $footer_section['copyright'] ?>
				</p>
			</div>
			<div class="flex flex-col items-center md:items-end">
				<nav aria-label="Social media links" class="flex space-x-4 sm:space-x-6">
					<a href="mailto:<?= $contact_info['email'] ?>"
					   class="text-gray-400 hover:text-secondary transition-all duration-300 transform hover:scale-110"
					   aria-label="Email me">
						<i class="fas fa-envelope text-lg sm:text-xl" aria-hidden="true"></i>
					</a>
					<a href="<?= $contact_info['github'] ?>"
					   target="_blank"
					   rel="noopener noreferrer"
					   class="text-gray-400 hover:text-secondary transition-all duration-300 transform hover:scale-110"
					   aria-label="Visit my GitHub profile">
						<i class="fab fa-github text-lg sm:text-xl" aria-hidden="true"></i>
					</a>
					<a href="<?= $contact_info['linkedin'] ?>"
					   target="_blank"
					   rel="noopener noreferrer"
					   class="text-gray-400 hover:text-secondary transition-all duration-300 transform hover:scale-110"
					   aria-label="Visit my LinkedIn profile">
						<i class="fab fa-linkedin text-lg sm:text-xl" aria-hidden="true"></i>
					</a>
					<a href="<?= $contact_info['instagram'] ?>"
					   target="_blank"
					   rel="noopener noreferrer"
					   class="text-gray-400 hover:text-secondary transition-all duration-300 transform hover:scale-110"
					   aria-label="Visit my Instagram profile">
						<i class="fab fa-instagram text-lg sm:text-xl" aria-hidden="true"></i>
					</a>
					<a href="tel:<?= $contact_info['phone'] ?>"
					   class="text-gray-400 hover:text-secondary transition-all duration-300 transform hover:scale-110"
					   aria-label="Call me">
						<i class="fas fa-phone text-lg sm:text-xl" aria-hidden="true"></i>
					</a>
				</nav>
			</div>
		</div>
	</div>
</footer>
