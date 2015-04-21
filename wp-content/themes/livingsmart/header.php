<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage MediaOnMars
 * @since Living Smart Theme 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]><html id="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'mediaonmars' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href="http://fonts.googleapis.com/css?family=Questrial" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/additionals.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/comments.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/livingsmart_custom.css" />
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon"/>
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-iphone.png" /> 
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-ipad.png" /> 
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-iphone4.png" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-ipad3.png" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script><![endif]-->
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
		wp_enqueue_script( 'jquery' );
		
	wp_head();
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js" type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
<?php
if (is_category()) {
	$category = get_the_category();
	$parent = get_cat_name($category[0]->category_parent);
	if (!empty($parent)) {
		$top_cat = $parent;
	} else {
		$top_cat = $category[0]->cat_name;
	}
	$category_ID = get_category_id($top_cat);
	$cat_img_src = z_taxonomy_image_url($category_ID);
}
elseif (has_post_thumbnail( $post->ID )){
	$category = get_the_category();
	$parent = $category[0]->category_parent;
	if ($parent != 5 && $category[0]->cat_ID != '5'){
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		$cat_img_src = $image[0];
	}
}
?>
<?php
	
?>
<div id="page" class="hfeed">
	<header id="header" <?php if ($cat_img_src){ ?>style="background: url('<?php echo $cat_img_src; ?>') repeat-x center bottom;" <?php } ?>>
		<div class="wrapper">
			<hgroup>
				<h1 id="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
				</h1>
			</hgroup>

			<nav id="mainmenu">
				<?php wp_nav_menu( array( 'container_class' => 'menu', 'menu' => 'Main menu', 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #mainmenu -->
		</div>
	</header><!-- #branding -->
	
	<div class="wrapper">
		<div id="main">