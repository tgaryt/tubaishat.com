const SCROLL_VISIBILITY_THRESHOLD_PX = 300;

/**
 * Toggles the scroll-to-top button's visibility via the data-visible attribute and wires the smooth scroll click handler.
 */
const initScrollToTop = () => {
	const button = document.getElementById('scrollToTop');
	if (!button) {
		return;
	}

	let ticking = false;

	const update = () => {
		const y = window.scrollY || document.documentElement.scrollTop;
		button.dataset.visible = y > SCROLL_VISIBILITY_THRESHOLD_PX ? 'true' : 'false';
		ticking = false;
	};

	const onScroll = () => {
		if (!ticking) {
			window.requestAnimationFrame(update);
			ticking = true;
		}
	};

	window.addEventListener('scroll', onScroll, { passive: true });

	button.addEventListener('click', () => {
		window.scrollTo({ top: 0, behavior: 'smooth' });
	});

	update();
};

initScrollToTop();
