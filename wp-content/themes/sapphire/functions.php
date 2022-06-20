<?php

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	show_admin_bar(false);
}

function sapphire_files() {
	// remove jquery from loading on frontend

  wp_enqueue_script('main-sapphire-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  // wp_enqueue_style('custom-google-fonts-playfair', '//fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');
  // wp_enqueue_style('custom-google-fonts-lobster', '//fonts.googleapis.com/css2?family=Lobster');
  wp_enqueue_style('sapphire_main_styles', get_theme_file_uri('/build/style-index.css'));
  // wp_enqueue_style('sapphire_extra_styles', get_theme_file_uri('/build/index.css'));

  wp_localize_script('main-sapphire-js', 'sapphireData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ));

	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', false);
	}

}

add_action('wp_enqueue_scripts', 'sapphire_files');

function sapphire_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_editor_style(array('//fonts.googleapis.com/css2?family=Lobster&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap', 'build/style-index.css', 'build/index.css'));
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'sapphire' ),
			'footer' => esc_html__( 'Footer', 'sapphire' ),
		) );
}

add_action('after_setup_theme', 'sapphire_features');

/*==================================
=            Inline SVG            =
==================================*/
function inline_svg($name) {
	$file = get_template_directory();
	$file .= "/assets/svg/" . $name . ".svg";
	return file_get_contents($file);
}

// Site Title
function site_title() {
	$title = get_bloginfo('name');
	if(is_front_page()) {
		return '<h1 class="site-title"><div>Gingerbread</div><div>Kitchen</div></h1>';
	} else {
		return '<div class="site-title"><div>Gingerbread</div><div>Kitchen</div></div>';
	}
}

// Social Media
function social_media() {
	return '
		<div class="social-icons">
			<a href="#" target="_blank" aria-label="YouTube" rel="nofollow"><i class="icon-youtube"></i></a>
			<a href="#" target="_blank" aria-label="Pinterest" rel="nofollow"><i class="icon-pinterest"></i></a>
			<a href="#" target="_blank" aria-label="Instagram" rel="nofollow"><i class="icon-instagram"></i></a>
		</div>
	';
}


class PlaceholderBlock {
  function __construct($name) {
    $this->name = $name;
    add_action('init', [$this, 'onInit']);
  }

  function ourRenderCallback($attributes, $content) {
    ob_start();
    require get_theme_file_path("/blocks/{$this->name}/{$this->name}.php");
    return ob_get_clean();
  }

  function onInit() {
    wp_register_script($this->name, get_stylesheet_directory_uri() . "/blocks/{$this->name}/{$this->name}.js", array('wp-blocks', 'wp-editor'));
    
    register_block_type("sapphiretheme/{$this->name}", array(
      'editor_script' => $this->name,
      'render_callback' => [$this, 'ourRenderCallback']
    ));
  }
}

new PlaceholderBlock('navbar');
new PlaceholderBlock('header');
new PlaceholderBlock('footer');

class Sapphire_block {
	function __construct($name) {
		$this->name = $name;
		add_action('init', [$this, 'on_init_register_block']);
	}

	function on_init_register_block() {
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'), true);
		register_block_type("sapphiretheme/{$this->name}", array(
		'editor_script' => $this->name,
	));
	}
}

new Sapphire_block('image-content');

class Sapphire_block_php_render {
	function __construct($name) {
		$this->name = $name;
		add_action('init', [$this, 'on_init_register_block']);
	}

	function ourRenderCallback($attributes, $content) {
    ob_start();
    require get_theme_file_path("/blocks/{$this->name}/{$this->name}.php");
    return ob_get_clean();
  }

	function on_init_register_block() {
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'), true);
		register_block_type("sapphiretheme/{$this->name}", array(
		'editor_script' => $this->name,
		'render_callback' => [$this, 'ourRenderCallback']
	));
	}
}



