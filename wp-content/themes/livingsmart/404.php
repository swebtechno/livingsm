<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */

get_header(); ?>

	<div id="primary">
		<div id="content">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h2 class="entry-title"><?php _e( "This page does not exist", 'mediaonmars' ); ?></h2>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'mediaonmars' ); ?></p>
					<p><?php _e( 'Perhaps searching can help.', 'mediaonmars' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		
		</div><!-- #content -->
		<div id="sidebar">
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Sidebar") ) : ?><?php endif; ?>
			
		</div>
		<div class="clear"></div>
	</div><!-- #primary -->

<?php get_footer(); ?>