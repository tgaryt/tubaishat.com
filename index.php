<?php
declare(strict_types=1);
require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(SITE_LANG) ?>" dir="ltr">
<?php include 'includes/head.php'; ?>
<body>
	<a href="#main" class="skip-link">Skip to main content</a>

	<div class="pointer-events-none fixed inset-0 overflow-hidden -z-20" aria-hidden="true">
		<div class="absolute inset-0 bg-linear-to-br from-dark via-primary to-dark"></div>
		<div class="absolute inset-0 opacity-10 gradient-bg"></div>
	</div>

	<?php include 'components/header.php'; ?>

	<main id="main">
		<?php include 'components/sections/hero.php'; ?>
		<?php include 'components/sections/about.php'; ?>
		<?php include 'components/sections/experience.php'; ?>
		<?php include 'components/sections/skills.php'; ?>
		<?php include 'components/sections/contact.php'; ?>
	</main>

	<?php include 'components/footer.php'; ?>
	<?php include 'components/scroll-top.php'; ?>
</body>
</html>
