<footer class="site-footer">

	<div class="f-social"><?php echo social_media(); ?></div>

	<?php // Footer Nav
		wp_nav_menu(array(
			'menu' 				=> 'footer',
			'menu_class' 	=> 'footer-nav',
			'container' 	=> '',
		))
	?>

	<!-- Cat Cup -->
	<button aria-label="Cat Animation" class="cat-cup"><?php echo inline_svg('cat-cup') ?></button>

	<div class="f-copyright">&copy; <?php echo date('Y') ?> GingerbreadKitchen. Design by Sapphire Web and Design.</div>

</footer>