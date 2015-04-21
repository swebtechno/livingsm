<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'sidebar-footer'  )	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="supplementary">
	<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
	<div id="first" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>

</div><!-- #supplementary -->