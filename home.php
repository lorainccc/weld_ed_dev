<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package LCCC Framework
 */

get_header(); ?>
<div class="small-12 medium-12 large-12 columns maincontent">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="medium-3 large-3 columns show-for-medium sidenavigation">
			<?php if ( is_active_sidebar( 'sidebarnavigation' ) ) : ?>
					<ul id="navsidebar">
						<?php dynamic_sidebar( 'sidebarnavigation' ); ?>
					</ul>
				<?php endif; ?>
			
			</div>
			<div class="small-12 medium-4 large-4 columns">
		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
			</div>
			<div class="small-12 medium-4 large-4 columns">
			<?php get_sidebar(); ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
		
</div>

<?php get_footer(); ?>
