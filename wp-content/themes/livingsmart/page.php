<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content">

				<?php the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

			</div><!-- #content -->
			<div id="sidebar">
				
				<?php if ( current_user_can('read_private_pages')&&current_user_can('read_private_posts') ) { ?>
					<aside class="widget private_nav">
						<div class="subcats_top"></div>
						<div class="subcats_inner">
							<h3 class="widget-title">Facilitators</h3>
							<?php wp_nav_menu( array( 'container_class' => 'subcats', 'menu' => 'Facilitators menu', 'theme_location' => 'primary' ) ); ?>
						</div>
						<div class="subcats_bottom"></div>
					</aside>
				<?php } ?>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Sidebar") ) : ?><?php endif; ?>
				
			</div>
			<div class="clear"></div>
		</div><!-- #primary -->

<?php get_footer(); ?>