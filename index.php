<?php
declare(strict_types=1);
require_once 'config/config.php';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<?php include 'includes/head.php'; ?>
<body class="bg-gradient-to-b from-dark to-primary text-light font-sans antialiased">
	<div class="fixed inset-0 overflow-hidden -z-20">
		<div class="absolute inset-0 bg-gradient-to-br from-dark via-primary to-dark"></div>
		<div class="absolute inset-0 opacity-10 gradient-bg"></div>
	</div>

	<main>
		<?php include 'components/header.php'; ?>
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
