<?php


function sapphire_files() {
  wp_enqueue_script('main-sapphire-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('sapphire_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('sapphire_extra_styles', get_theme_file_uri('/build/index.css'));

  wp_localize_script('main-sapphire-js', 'sapphireData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ));

}

add_action('wp_enqueue_scripts', 'sapphire_files');

function sapphire_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('editor-styles');
  add_editor_style(array('https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i', 'build/style-index.css', 'build/index.css'));
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'sapphire' ),
			'footer' => esc_html__( 'Footer', 'sapphire' ),
		) );
}

add_action('after_setup_theme', 'sapphire_features');


class Sapphire_block {
	function __construct($name) {
		$this->name = $name;
		add_action('init', [$this, 'on_init_register_block']);
	}

	function on_init_register_block() {
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'), true);
		register_block_type("sapphirethemeblocks/{$this->name}", array(
		'editor_script' => $this->name,
	));
	}
}

new Sapphire_block('banner');
new Sapphire_block('sapphire-heading');
