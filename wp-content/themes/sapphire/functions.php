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
  add_editor_style(array('//fonts.googleapis.com/css2?family=EB+Garamond&family=Lobster&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap', 'build/style-index.css', 'build/index.css'));
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header' => esc_html__( 'Header', 'sapphire' ),
			'footer' => esc_html__( 'Footer', 'sapphire' ),
		) );
}

add_action('after_setup_theme', 'sapphire_features');

// Custom post types
function sapphire_post_types() {
	// Recipe Post Type
  register_post_type('recipe', array(
    'menu_icon' => 'dashicons-food',
    'labels' => array(
      'name' => 'Recipes',
      'add_new_item' => 'Add New Recipe',
      'edit_item' => 'Edit Recipe',
      'all_items' => 'All Recipes',
      'singular_name' => 'Recipe'
    ),
		'taxonomies' => array(
			// 'post_tag',
			'category'
		),
		'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
  ));
}

add_action('init', 'sapphire_post_types');

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
  public function __construct($name) {
    $this->name = $name;
    add_action('init', [$this, 'onInit']);
  }

  public function ourRenderCallback($attributes, $content) {
    ob_start();
    require get_theme_file_path("/blocks/{$this->name}/{$this->name}.php");
    return ob_get_clean();
  }

  public function onInit() {
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
	public function __construct($name) {
		$this->name = $name;
		add_action('init', [$this, 'on_init_register_block']);
	}

	public function on_init_register_block() {
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'), true);
		register_block_type("sapphiretheme/{$this->name}", array(
		'editor_script' => $this->name,
	));
	}
}


class Sapphire_block_php_render {
	public function __construct($name) {
		$this->name = $name;
		add_action('init', [$this, 'on_init_register_block']);
	}

	public function sapphireRenderCallback($attributes) {
    ob_start();
    require get_theme_file_path("/blocks/{$this->name}/{$this->name}.php");
    return ob_get_clean();
  }

	public function on_init_register_block() {
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'), true);
			register_block_type("sapphiretheme/{$this->name}", array(
			'editor_script' => $this->name,
			'render_callback' => [$this, 'sapphireRenderCallback']
		));
	}
}

new Sapphire_block_php_render('split-image-content');

// Creates custom endpoint for Recipe
class Sapphire_block_featured_recipe {
	public function __construct($name) {
		$this->name = $name;
		require_once plugin_dir_path(__FILE__) . 'inc/generate_recipe_html.php';
		add_action('init', [$this, 'on_init_register_block']);
		// add_action('rest_api_init', [$this, 'recipe_html']);
	}

	public function recipe_html() {
		register_rest_route('featured-recipe/v1', 'get-html', array(
      'methods' => WP_REST_SERVER::READABLE,
      'callback' => [$this, 'get_recipe_html']
    ));
	}

	public function get_recipe_html() {
		return '<h1>hi lol</h1>';
	}
	  

	public function sapphire_render_callback($attributes) {
    if ($attributes['recipeId']) {
      return generate_recipe_html($attributes['recipeId']);
    } else {
      return NULL;
    }
  }

	public function on_init_register_block() {
		wp_register_script($this->name, get_stylesheet_directory_uri() . "/build/{$this->name}.js", array('wp-blocks', 'wp-editor'), true);
			register_block_type("sapphiretheme/{$this->name}", array(
			'editor_script' => $this->name,
			'render_callback' => [$this, 'sapphire_render_callback']
		));
	}
}

new Sapphire_block_featured_recipe('featured-recipe');
