<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package LCCC Framework
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lccc-framework' ); ?></a>

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">
<div class="hide-for-medium-up">
    <nav class="tab-bar">
      <section class="left-small">
        <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
							
      </section>
      <section class="middle tab-bar-section">
        <h1 class="title">Menu</h1>
      </section>
    </nav>
			</div>
    <aside class="left-off-canvas-menu">
      <ul class="off-canvas-list">
        <li><label>Midpointcampus</label></li>
        <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
      </ul>
    </aside>
			
	<div class="row">
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<div class="small-12  medium-8 large-8 columns">
			<a href="<?php echo home_url(); ?>">
		<img src='<?php echo get_stylesheet_directory_uri();  ?>/images/welded-logo.png' border="0" />
			</a>
				</div>
			<div class="small-12  medium-4 large-4 columns headersidebar">
							<?php if ( is_active_sidebar( 'headersidebar' ) ) : ?>
					<ul id="navsidebar">
						<?php dynamic_sidebar( 'headersidebar' ); ?>
					</ul>
				<?php endif; ?>
			
			</div>
		</div><!-- .site-branding -->
	
	</header><!-- #masthead -->
	<div id="content" class="site-content">
		