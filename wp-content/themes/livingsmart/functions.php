<?php
/**
 * Living Smart Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, mediaonmars_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'mediaonmars_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */

/**
 * Tell WordPress to run mediaonmars_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'mediaonmars_setup' );

if ( ! function_exists( 'mediaonmars_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override mediaonmars_setup() in a child theme, add your own mediaonmars_setup to your child theme's
 * functions.php file.
 * 
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats. 
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Living Smart Theme 1.0
 */
function mediaonmars_setup() {

	// Load up our theme options page and related code.
	require( dirname( __FILE__ ) . '/inc/theme-options.php' );

	// Grab Living Smart Theme's Ephemera widget.
	require( dirname( __FILE__ ) . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// Add support for custom backgrounds
	add_custom_background();

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// The next four constants set how Living Smart Theme supports custom headers.
	
	//If you don't want to allow changing the header text color, remove next line: 
	define('NO_HEADER_TEXT', true );

	// By leaving empty, we allow for random image rotation.
	define( 'HEADER_IMAGE', '' );

	// The height and width of your custom header.
	// Add a filter to mediaonmars_header_image_width and mediaonmars_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'mediaonmars_header_image_width', 1000 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'mediaonmars_header_image_height', 288 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Add Living Smart Theme's custom image sizes
	add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true ); // Used for large feature (header) images
	add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist

	// Turn on random header image rotation by default.
	add_theme_support( 'custom-header', array( 'random-default' => true ) );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See mediaonmars_admin_header_style(), below.
	add_custom_image_header( 'mediaonmars_header_style', 'mediaonmars_admin_header_style', 'mediaonmars_admin_header_image' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'wheel' => array(
			'url' => '%s/images/headers/wheel.jpg',
			'thumbnail_url' => '%s/images/headers/wheel-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Wheel', 'mediaonmars' )
		),
		'shore' => array(
			'url' => '%s/images/headers/shore.jpg',
			'thumbnail_url' => '%s/images/headers/shore-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Shore', 'mediaonmars' )
		)
	) );
}
endif; // mediaonmars_setup

if ( ! function_exists( 'mediaonmars_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function mediaonmars_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return '';
}
endif; // mediaonmars_header_style

if ( ! function_exists( 'mediaonmars_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in mediaonmars_setup().
 *
 * @since Twenty Eleven 1.0
 */
function mediaonmars_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1,
	#desc {
		font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
	}
	#headimg h1 {
		margin: 0;
	}
	#headimg h1 a {
		font-size: 32px;
		line-height: 36px;
		text-decoration: none;
	}
	#desc {
		font-size: 14px;
		line-height: 23px;
		padding: 0 0 3em;
	}	
	#headimg img {
		max-width: 1000px;
		height: auto;
		width: 100%;
	}
	</style>
<?php
}
endif; // mediaonmars_admin_header_style

if ( ! function_exists( 'mediaonmars_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in mediaonmars_setup().
 *
 * @since Living Smart Theme 1.0
 */
function mediaonmars_admin_header_image() { ?>
	<div id="headimg">
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
<?php }
endif; // mediaonmars_admin_header_image

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 */
function mediaonmars_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'mediaonmars_excerpt_length' );

/**
 * Returns a "Read more" link for excerpts
 */
function mediaonmars_continue_reading_link() {
	return '<div class="read_more"><a href="'. esc_url( get_permalink() ) . '">' . __( 'Read more...', 'mediaonmars' ) . '</a></div>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and mediaonmars_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function mediaonmars_auto_excerpt_more( $more ) {
	return ' &hellip;' . mediaonmars_continue_reading_link();
}
add_filter( 'excerpt_more', 'mediaonmars_auto_excerpt_more' );

/**
 * Adds a pretty "Read more" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function mediaonmars_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= mediaonmars_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'mediaonmars_custom_excerpt_more' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function mediaonmars_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mediaonmars_page_menu_args' );

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Living Smart Theme 1.0
 */
function mediaonmars_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'mediaonmars' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<div class="clear"></div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Blog section sidebar', 'mediaonmars' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '<div class="clear"></div></aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'mediaonmars_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
function mediaonmars_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<div class="nav-previous"><?php next_posts_link( __( 'Previous', 'mediaonmars' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Next', 'mediaonmars' ) ); ?></div>
			<div class="clear"></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Return the URL for the first link found in the post content.
 *
 * @since Living Smart Theme 1.0
 * @return string|bool URL or false when no link is present.
 */
function mediaonmars_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}


if ( ! function_exists( 'mediaonmars_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own mediaonmars_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Living Smart Theme 1.0
 */
function mediaonmars_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mediaonmars' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'mediaonmars' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<h6 class="comment-author vcard">
					<?php

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s says on %2$s', 'mediaonmars' ),
							sprintf( '%s', get_comment_author_link() ),
							sprintf( '%3$s',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'C' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'mediaonmars' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'mediaonmars' ), '<span class="edit-link">', '</span>' ); ?>
				</h6><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mediaonmars' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for mediaonmars_comment()

if ( ! function_exists( 'mediaonmars_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own mediaonmars_posted_on to override in a child theme
 *
 * @since Living Smart Theme 1.0
 */
function mediaonmars_posted_on() {
	printf( __( '<b>%3$s</b><span>%4$s</span>%5$s', 'mediaonmars' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'd' ) ),
		esc_attr( get_the_date( 'M' ) ),
		esc_attr( get_the_date( 'Y' ) ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'mediaonmars' ), get_the_author() ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds two classes to the array of body classes.
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Living Smart Theme 1.0
 */
function mediaonmars_body_classes( $classes ) {

	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'mediaonmars_body_classes' );

function get_category_id($cat_name){
	$term = get_term_by('name', $cat_name, 'category');
	return $term->term_id;
}

function the_post_thumbnail_caption() {
  global $post;

  $thumbnail_id    = get_post_thumbnail_id($post->ID);
  echo $thumbnail_image;
  $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    echo $thumbnail_image[0]->post_excerpt;
  }
}

function get_topcat_name() {
	global $post;
	
	$category = get_the_category();
	$parent = $category[0]->category_parent;
	if (!empty($parent)) {
		$top_cat_name = get_cat_name($parent);
	} else {
		$top_cat_name = $category[0]->cat_name;
	}
	return $top_cat_name;
}

function remove_private_prefix($title) {
 $title = str_replace(
 'Private:',
 '',
 $title);
 return $title;
 }
 add_filter('the_title','remove_private_prefix');