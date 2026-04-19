const TYPEWRITER_DEFAULT_DELAY_MS = 45;

/**
 * Toggle the scroll-to-top button by observing when the hero section leaves the viewport.
 * Uses IntersectionObserver (MDN/web.dev-recommended) instead of a scroll handler to avoid
 * the forced-reflow pattern of read-scrollY-then-write-attribute on every scroll tick.
 */
const initScrollToTop = () => {
	const button = document.getElementById('scrollToTop');
	const hero = document.getElementById('home');
	if (!button || !hero) {
		return;
	}

	const setVisible = (visible) => {
		button.dataset.visible = visible ? 'true' : 'false';
		button.toggleAttribute('inert', !visible);
	};

	const observer = new IntersectionObserver(
		([entry]) => setVisible(!entry.isIntersecting),
		{ threshold: 0 },
	);
	observer.observe(hero);

	button.addEventListener('click', () => {
		window.scrollTo({ top: 0, behavior: 'smooth' });
	});

	setVisible(false);
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
	const parsedDelay = Number.parseInt(element.dataset.delay ?? '', 10);
	const delay = Number.isFinite(parsedDelay) && parsedDelay > 0 ? parsedDelay : TYPEWRITER_DEFAULT_DELAY_MS;

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
