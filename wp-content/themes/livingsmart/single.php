<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Blank Theme 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content">
				
				<?php
					$category = get_the_category();
					$parent = $category[0]->category_parent;
					if (!empty($parent)) {
						$top_cat = $parent;
						$top_cat_name = get_cat_name($category[0]->category_parent);
					} else {
						$top_cat = $category[0]->cat_ID;
						$top_cat_name = $category[0]->cat_name;
					}
					
				?>
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					if($top_cat=='5'){
						get_template_part( 'content', 'blog' );
					}
					else {
						get_template_part( 'content', 'single' );
					}?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

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