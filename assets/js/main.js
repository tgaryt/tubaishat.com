const SCROLL_TO_TOP_THRESHOLD = 300;
const ANIMATION_DELAY = 300;
const OBSERVER_THRESHOLD = 0.1;
const OBSERVER_ROOT_MARGIN = '0px 0px -50px 0px';

const initScrollToTop = () => {
	const scrollToTopBtn = document.getElementById('scrollToTop');
	if (!scrollToTopBtn) return;

	let ticking = false;

	const handleScroll = () => {
		if (!ticking) {
			window.requestAnimationFrame(() => {
				const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

				if (scrollPosition > SCROLL_TO_TOP_THRESHOLD) {
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
		threshold: OBSERVER_THRESHOLD,
		rootMargin: OBSERVER_ROOT_MARGIN
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
