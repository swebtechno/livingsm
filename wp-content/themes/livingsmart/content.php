<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
		
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="post_date">
				<?php mediaonmars_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
			
			<?php if ( is_search() || is_category() ){
					echo "<h4 ";
				}
				else {
					echo "<h2 ";
				}
			?>
			class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			<?php if ( is_search() || is_category() ){
					echo "</h4>";
				}
				else {
					echo "</h2>";
				}
			?>
			<div class="clear"></div>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php if (is_category()){
			if (has_post_thumbnail( $post->ID )){ ?>
				<div class="featured">
					<?php
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					$feat_img_src = $image[0];
					?>
					<img src="<?php echo $feat_img_src; ?>" alt="<?php the_title(); ?>" />
					<?php
						$args = array( 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'numberposts' => null, 'post_parent' => $post->ID );
						$attachments = get_posts($args);
						if ($attachments) {
							foreach ( $attachments as $attachment ) {
								$image_title = $attachment->post_title;
								echo "<p>".$image_title."</p>";
							}
						}
					?>
				</div>
			<?php }
			the_excerpt(); ?>
			<div class="clear"></div>
			<?php } else { ?>
			<?php the_content(); ?>
			<?php } ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mediaonmars' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php $show_sep = false; ?>
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'mediaonmars' ) );
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'mediaonmars' ) );
				if ( $tags_list ):
				if ( $show_sep ) : ?>
			<span class="sep"> | </span>
				<?php endif; // End if $show_sep ?>
			<span class="tag-links">
				<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'mediaonmars' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				$show_sep = true; ?>
			</span>
			<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>
			
			<?php if ( comments_open() ) : ?>
			<?php if ( $show_sep ) : ?>
			<span class="sep"> | </span>
			<?php endif; // End if $show_sep ?>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'mediaonmars' ) . '</span>', __( '<b>1</b> Comment', 'mediaonmars' ), __( '<b>%</b> Comments', 'mediaonmars' ) ); ?></span>
			<div class="clear"></div>
			<?php endif; // End if comments_open() ?>

		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
	<div class="clear"></div>
