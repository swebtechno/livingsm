<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */

$options = mediaonmars_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area">
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>