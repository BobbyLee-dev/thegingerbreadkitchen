<?php 
	$image = array_key_exists('image', $attributes) ? $attributes['image'] : '';
	$heading = array_key_exists('heading', $attributes) ? $attributes['heading'] : '';
	$content = array_key_exists('content', $attributes) ? $attributes['content'] : '';
	$button_text = array_key_exists('buttonText', $attributes) ? $attributes['buttonText'] : ''; 
	$link_object = array_key_exists('linkObject', $attributes) ? $attributes['linkObject'] : '';
	
?>

<section class="split-image-content">
	<div class="wrapper">

	 	<?php if($image): ?>
			<div class="image-wrap">
				<img src="<?= $image ?>" alt=""/>
			</div>
		<?php endif; ?>

		<div class="block-content-wrap">
			<?= $heading ? '<h2 class="block-heading">'.$heading.'</h2>' : ''; ?>
			<?= $content ? '<div class="block-text">'.$content.'</div>' : ''; ?> 
			<?= $link_object ? '<a class="button" href="'.$link_object['url'].'">'.$button_text.'</a>' : ''; ?>
		</div>

	</div>
</section>