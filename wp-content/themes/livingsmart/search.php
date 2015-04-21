<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'mediaonmars' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</header>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php mediaonmars_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h2 class="entry-title"><?php _e( 'Nothing Found', 'mediaonmars' ); ?></h2>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria.<br />Please try again with some different keywords.', 'mediaonmars' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
			<div id="sidebar">
			
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Main Sidebar") ) : ?><?php endif; ?>
				
			</div>
			<div class="clear"></div>
		</div><!-- #primary -->

<?php get_footer(); ?>