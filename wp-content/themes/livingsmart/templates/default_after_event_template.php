<?php

/*
	Template Name: After Defult Template 
*/

?>
<?php
get_header(); ?>

		<div id="primary">
			<div id="content">
            <?php the_content(); ?>
            
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