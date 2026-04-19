const SCROLL_VISIBILITY_THRESHOLD_PX = 300;
const TYPEWRITER_DEFAULT_DELAY_MS = 45;

/**
 * Toggle the scroll-to-top button's visibility and tab-order via the data-visible attribute and hidden flag.
 */
const initScrollToTop = () => {
	const button = document.getElementById('scrollToTop');
	if (!button) {
		return;
	}

	let ticking = false;
	let isVisible = false;

	const update = () => {
		const shouldBeVisible = window.scrollY > SCROLL_VISIBILITY_THRESHOLD_PX;
		if (shouldBeVisible !== isVisible) {
			isVisible = shouldBeVisible;
			button.dataset.visible = shouldBeVisible ? 'true' : 'false';
			button.toggleAttribute('hidden', !shouldBeVisible);
		}
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

/**
 * Mobile navigation disclosure pattern with aria-expanded, inert panel, and Escape-to-close.
 */
const initMobileNav = () => {
	const toggle = document.getElementById('mobileNavToggle');
	const panel = document.getElementById('mobile-menu');
	if (!toggle || !panel) {
		return;
	}

	const openIcon = toggle.querySelector('[data-icon="open"]');
	const closeIcon = toggle.querySelector('[data-icon="close"]');

	const setOpen = (open) => {
		toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		panel.dataset.state = open ? 'open' : 'closed';
		panel.toggleAttribute('inert', !open);
		openIcon?.toggleAttribute('hidden', open);
		closeIcon?.toggleAttribute('hidden', !open);
	};

	toggle.addEventListener('click', () => {
		const open = toggle.getAttribute('aria-expanded') !== 'true';
		setOpen(open);
	});

	panel.querySelectorAll('a[href^="#"]').forEach((link) => {
		link.addEventListener('click', () => setOpen(false));
	});

	window.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
			setOpen(false);
			toggle.focus();
		}
	});

	setOpen(false);
};

/**
 * Progressive typewriter effect for the hero role. Skipped entirely when prefers-reduced-motion is set.
 * Uses a single textContent assignment per tick to avoid the read/modify/write anti-pattern.
 */
const initTypewriter = () => {
	const element = document.getElementById('heroTypewriter');
	if (!element) {
		return;
	}
	if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
		return;
	}

	const text = element.dataset.text ?? element.textContent ?? '';
	const delay = Number.parseInt(element.dataset.delay ?? String(TYPEWRITER_DEFAULT_DELAY_MS), 10);

	let current = '';
	element.textContent = '';
	let i = 0;
	const tick = () => {
		if (i < text.length) {
			current += text[i];
			element.textContent = current;
			i++;
			setTimeout(tick, delay);
		}
	};
	tick();
};

initScrollToTop();
initMobileNav();
initTypewriter();
