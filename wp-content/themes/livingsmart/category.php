<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */

get_header(); ?>

	<div id="primary">
		<div id="content">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h2 class="page-title"><?php
						printf( __( '%s', 'mediaonmars' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h2>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
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
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mediaonmars' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
		</div><!-- #content -->
		<div id="sidebar">
			
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Blog section sidebar") ) : ?><?php endif; ?>
			<aside class="widget">
				<div class="archives_widget">
					<div class="archives_widget_top"></div>
					<div class="archives_inner">
						<h3>Archive</h3>
						<?php
						$args = array(
							'type'                     => 'post',
							'child_of'                 => '5',
							'parent'                   => '',
							'orderby'                  => 'name',
							'order'                    => 'ASC',
							'hide_empty'               => 1,
							'hierarchical'             => 1,
							'exclude'                  => '',
							'include'                  => '',
							'number'                   => '',
							'taxonomy'                 => 'category',
							'pad_counts'               => false
						);
						$categories = get_categories( $args );
						$arr = '5,';
						foreach ($categories as $cat) {
							$arr .= $cat->term_id . ',';
						}
						$arr = substr($arr, 0, -1);
						?>
						<ul>
						<?php wp_get_archives(apply_filters('widget_archives_args', array('cat' => $arr, 'type' => 'monthly', 'show_post_count' => $c))); ?>
						</ul>
					</div>
					<div class="archives_widget_bottom"></div>
				</div>
			</aside>
			<aside class="widget">
				<div class="yellow_widget">
					<div class="yellow_widget_top"></div>
					<div class="yellow_widget_inner">
						<h3><a href="<?php echo esc_url( home_url( '/' ) ); ?>?feed=rss&amp;cat=5" target="_blank">RSS feeds <img src="<?php echo get_template_directory_uri(); ?>/images/rss.png" alt="RSS" /></a></h3>
					</div>
					<div class="yellow_widget_bottom"></div>
				</div>
			</aside>
		</div>
		<div class="clear"></div>
	</div><!-- #primary -->

<?php get_footer(); ?>
