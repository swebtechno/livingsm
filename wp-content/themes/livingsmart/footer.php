<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */
?>

		</div><!-- #main -->

	</div>
	<div class="clear"></div>
</div><!-- #page -->

<footer id="footer">
	
	<div class="wrapper">
		<div class="container">
		<div class="inner">
			<div class="contacts">
				<h4>Contact us</h4>
				<div class="cnt">
					<p>Living Smart</p>
					<p>PO Box 1358</p>
					<p>Fremantle WA 6959</p>
				</div>
				<div class="cnt">
					<p>+61 8 9432 9877</p>
					<p><a href="mailto:info@livingsmart.org.au">info@livingsmart.org.au</a></p>
				</div>
			</div>
			
			<div class="socials">
				<img src="<?php bloginfo('template_directory'); ?>/images/footer_socials.png" alt="Find us" usemap="#socials">
				<map name="socials">
					<area shape="poly" coords="78,26,76,53,71,80,86,83,123,80,121,31" href="https://www.facebook.com/belivingsmart" alt="Find us on Facebook">
					<area shape="poly" coords="125,28,127,54,124,83,142,85,178,77,168,28" href="https://twitter.com/LivingSmartAU" alt="Find us on Twitter">
				</map>
			</div>
			
			<div class="clear"></div>
			
			<div class="copyrights">
				<p class="authors">Web design by <a href="http://www.mediaonmars.com.au/" onclick="this.target='_blank'" title="Media On Mars">Media On Mars</a></p>
				<div id="site-generator">
					&copy; 2012 <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		</div>
	</div>
</footer><!-- #footer -->

<?php wp_footer(); ?>

</body>
</html>