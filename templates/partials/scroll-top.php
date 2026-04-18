<?php
declare(strict_types=1);

use Tubaishat\Support\Icon;
?>
<button id="scrollToTop"
        type="button"
        data-visible="false"
        hidden
        aria-label="Scroll to top"
        class="fixed bottom-4 sm:bottom-6 right-4 sm:right-6 z-40 inline-flex items-center justify-center w-10 h-10 sm:w-12 sm:h-12 bg-linear-to-r from-secondary to-accent hover:from-accent hover:to-secondary text-primary rounded-full shadow-lg shadow-secondary/30 opacity-0 pointer-events-none transition-all duration-300 hover:scale-110 focus:outline-hidden focus-visible:ring-2 focus-visible:ring-secondary/50 data-[visible=true]:opacity-100 data-[visible=true]:pointer-events-auto">
	<?= Icon::render('arrow-up', 'text-sm sm:text-base') ?>
</button>
