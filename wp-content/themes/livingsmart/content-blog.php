<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */
?>

	<h2 class="blog-post-title"><?php echo get_topcat_name(); ?></h2>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="post_date">
				<?php mediaonmars_posted_on(); 	?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
			
			<h4 class="entry-title"><?php the_title(); ?></h4>
			<div class="clear"></div>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php if (has_post_thumbnail( $post->ID )){ ?>
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
			<?php } ?>
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mediaonmars' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		
		<footer class="entry-meta">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'mediaonmars' ) );
				if ( $tags_list ): ?>
			<p>
				<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'mediaonmars' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				$show_sep = true; ?>
			</p>
			<?php endif; // End if $tags_list ?>

		</footer><!-- #entry-meta -->
		
	</article><!-- #post-<?php the_ID(); ?> -->
	<div class="clear"></div>
