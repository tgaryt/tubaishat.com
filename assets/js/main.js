const initScrollToTop = () => {
	const scrollToTopBtn = document.getElementById('scrollToTop');
	if (!scrollToTopBtn) return;

	let ticking = false;

	const handleScroll = () => {
		if (!ticking) {
			window.requestAnimationFrame(() => {
				const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
				const threshold = 300;

				if (scrollPosition > threshold) {
					scrollToTopBtn.classList.remove('opacity-0', 'invisible');
					scrollToTopBtn.classList.add('opacity-100', 'visible');
				} else {
					scrollToTopBtn.classList.remove('opacity-100', 'visible');
					scrollToTopBtn.classList.add('opacity-0', 'invisible');
				}

				ticking = false;
			});

			ticking = true;
		}
	};

	window.addEventListener('scroll', handleScroll, { passive: true });

	scrollToTopBtn.addEventListener('click', () => {
		window.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	});
};

const initKeyboardNavigation = () => {
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape') {
			const mobileMenuButton = document.querySelector('[x-data*="isOpen"]');
			if (mobileMenuButton && mobileMenuButton.__x) {
				mobileMenuButton.__x.$data.isOpen = false;
			}
		}
	});
};

const initScrollAnimations = () => {
	const observerOptions = {
		threshold: 0.1,
		rootMargin: '0px 0px -50px 0px'
	};

	const observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				entry.target.classList.add('animate-slideIn');
				observer.unobserve(entry.target);
			}
		});
	}, observerOptions);

	document.querySelectorAll('section').forEach(section => {
		observer.observe(section);
	});
};

document.addEventListener('DOMContentLoaded', () => {
	initScrollToTop();
	initKeyboardNavigation();
	initScrollAnimations();
});
