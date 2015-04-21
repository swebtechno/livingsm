<?php

/*
	Template Name: Courses Template
*/

?>
<?php
get_header(); 

?>

		<div id="primary">
			<div id="content">

				<?php the_post(); ?>

				<header class="entry-header">
                <?php
		$wp_password_required = post_password_required($post->ID);
                 if($wp_password_required) {
                      	echo get_the_password_form(); 
                        }
                          else {
	
?>
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
         
			<?php
           			
					 echo do_shortcode("[ESPRESSO_EVENTS] ");
					 echo do_shortcode("[EVENT_LIST show_expired=true]");
				?>
              <?php }?>
		
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