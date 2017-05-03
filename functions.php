<?php

/**
 * welded Child Theme functions and definitions
 *
 * @package welded Child Theme
 */

/**
 * Enqueue scripts and styles.  Grabs styles from parent theme for foundation inclusion.
 */
function welded_scripts()
{
	/* Add Google Fonts */
	
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Droid+Sans:400,700|Droid+Serif:400,700' );	
	
	/* Add Parent Theme Styles */

	wp_enqueue_style( 'lccc-framework-style', get_template_directory_uri() .'/style.css' );

	/* ----- Add Foundation Support From Parent Theme ----- */
		/* Foudnation Init JS */
 wp_enqueue_script( 'foundation-init-js', get_template_directory_uri() . '/foundation.js', array( 'jquery', 'foundation-js' ), '1', true );
	
	 wp_enqueue_style( 'foundation-app',  get_template_directory_uri() . '/foundation/css/app.css' );
		wp_enqueue_style( 'foundation-normalize', get_template_directory_uri() . '/foundation/css/normalize.css' );
		wp_enqueue_style( 'foundation',  get_template_directory_uri() . '/foundation/css/foundation.css' );

		wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/foundation/js/vendor/foundation.js', array( 'jquery' ), '1', true );
		wp_enqueue_script( 'foundation-whatinput', get_template_directory_uri() . '/foundation/js/vendor/what-input.js', array( 'jquery' ), '1', true);
	/* ----- End Foundation Support ----- */
	
	wp_enqueue_script( 'lccc-framework-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'lccc-framework-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_style( 'welded-style', get_stylesheet_directory_uri().'/style.css' );
}
add_action( 'wp_enqueue_scripts', 'welded_scripts' );

/**
 * Enable thumbnail support
 */
	add_theme_support( 'post-thumbnails' );
	
/**
 * Add Editor Style Support
 */
function welded_add_editor_styles() {
	add_editor_style( 'style.css' );
}

add_action( 'admin_init', 'welded_add_editor_styles' );

/**
 * Menu Support
 */

register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'welded' ),
		'secondary' => esc_html__( 'Secondary Menu', 'welded' ),
	) );
	
	/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function welded_widgets_init() {
				register_sidebar( array(
								'name'          => __( 'Sidebar', 'welded' ),
								'id'            => 'sidebar-1',
								'description'   => '',
								'before_widget' => '<aside id="%1$s" class="widget %2$s">',
								'after_widget'  => '</aside>',
								'before_title'  => '<h1 class="widget-title">',
								'after_title'   => '</h1>',
				) );
						register_sidebar( array(
								'name'          => __( 'Navigation Sidebar', 'welded' ),
								'id'            => 'sidebarnavigation',
								'description'   => '',
								'before_widget' => '<aside id="%1$s" class="widget %2$s">',
								'after_widget'  => '</aside>',
								'before_title'  => '<h1 class="widget-title">',
								'after_title'   => '</h1>',
				) );
								register_sidebar( array(
								'name'          => __( 'Header Sidebar', 'welded' ),
								'id'            => 'headersidebar',
								'description'   => '',
								'before_widget' => '<aside id="%1$s" class="widget %2$s">',
								'after_widget'  => '</aside>',
								'before_title'  => '<h1 class="widget-title">',
								'after_title'   => '</h1>',
				) );
}
add_action( 'widgets_init', 'welded_widgets_init' );
add_theme_support( 'post-thumbnails' );
add_theme_support('custom-background');

/* Menu Functions */

class lc_top_bar_menu_walker extends Walker_Nav_Menu
{
	/*
	 * Add vertical menu class and submenu data attribute to sub menus
	 */

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\" data-submenu>\n";
	}
}

//Optional fallback
function lc_topbar_menu_fallback($args)
{
	/*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	 */

	$walker_page = new Walker_Page();
	$fallback = $walker_page->walk(get_pages(), 0);
	$fallback = str_replace("<ul class='children'>", '<ul class="children submenu menu vertical" data-submenu>', $fallback);

	echo '<ul class="dropdown menu" data-dropdown-menu">'.$fallback.'</ul>';
}

class lc_drill_menu_walker extends Walker_Nav_Menu
{
	/*
	 * Add vertical menu class
	 */

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"vertical menu\">\n";
	}
}

function lc_drill_menu_fallback($args)
{
	/*
	 * Instantiate new Page Walker class instead of applying a filter to the
	 * "wp_page_menu" function in the event there are multiple active menus in theme.
	 */

	$walker_page = new Walker_Page();
	$fallback = $walker_page->walk(get_pages(), 0);
	$fallback = str_replace("children", "children vertical menu", $fallback);
	echo '<ul class="vertical menu" data-drilldown="">'.$fallback.'</ul>';
}

/* End Menu Functions */

