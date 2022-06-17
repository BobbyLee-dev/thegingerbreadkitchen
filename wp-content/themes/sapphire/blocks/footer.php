<footer class="site-footer">

	<div class="f-social">
		<a href="#" target="_blank" aria-label="YouTube" rel="nofollow"><i class="icon-youtube"></i></a>
		<a href="#" target="_blank" aria-label="Pinterest" rel="nofollow"><i class="icon-pinterest"></i></a>
		<a href="#" target="_blank" aris-label-="Instagram" rel="nofollow"><i class="icon-instagram"></i></a>
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