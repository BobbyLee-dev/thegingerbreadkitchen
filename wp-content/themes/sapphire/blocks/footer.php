<footer class="site-footer">

	<div class="f-social">
		<a href="#" target="_blank" aria-label="YouTube" rel="nofollow"></a>
		<a href="#" target="_blank"><i title="Pinterest" class="fa-brands fa-pinterest-p"></i></a>
		<a href="#" target="_blank"><i title="Instagram" class="fa-brands fa-instagram"></i></a>
	</div>

	<?php // Footer Nav
		wp_nav_menu(array(
			'menu' 				=> 'footer',
			'menu_class' 	=> 'footer-nav',
			'container' 	=> '',
		))
	?>

	<div class="f-copyright">&copy; <?php echo date('Y') ?> GingerbreadKitchen. Design by Sapphire Web and Design.</div>

</footer>