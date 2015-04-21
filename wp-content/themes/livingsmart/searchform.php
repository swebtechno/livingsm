<?php
/**
 * The template for displaying search forms in Living Smart Theme
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'mediaonmars' ); ?></label>
		<input type="text" class="field" name="s" id="s" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mediaonmars' ); ?>" />
	</form>
