<?php
/**
 * tretrakSoup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package tretrakSoup
 */

if ( ! defined( 'TRETRAKSOUP_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'TRETRAKSOUP_VERSION', '0.1.0' );
}

if ( ! function_exists( 'tretraksoup_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function tretraksoup_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on tretrakSoup, use a find and replace
		 * to change 'tretrak-soup' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'tretrak-soup', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'tretrak-soup' ),
				'menu-2' => __( 'Footer Menu', 'tretrak-soup' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'tretraksoup_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function tretraksoup_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'tretrak-soup' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'tretrak-soup' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'tretraksoup_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function tretraksoup_scripts() {
	wp_enqueue_style( 'tretrak-soup-style', get_stylesheet_uri(), array(), TRETRAKSOUP_VERSION );
	wp_enqueue_script( 'tretrak-soup-script', get_template_directory_uri() . '/js/script.min.js', array(), TRETRAKSOUP_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'tretraksoup_scripts' );

/**
 * Add the block editor class to TinyMCE.
 *
 * This allows TinyMCE to use Tailwind Typography styles.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function tretraksoup_tinymce_add_class( $settings ) {
	$settings['body_class'] = 'block-editor-block-list__layout';
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'tretraksoup_tinymce_add_class' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
