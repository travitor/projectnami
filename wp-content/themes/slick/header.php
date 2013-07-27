<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie ie7 no-js"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie ie7 no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie ie8 no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<!-- A design by MattiaViviani.com -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php
	// Print the <title> tag based on what is being viewed.
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
		echo ' | ' . sprintf( __( 'Page %s', 'mav' ), max( $paged, $page ) );

	?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<?php
		/* include jQuery */
		wp_enqueue_script('jquery');

		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>

</head>

<body <?php body_class(); ?>>

	<?php /* jQuery topLink Plugin - http://davidwalsh.name/jquery-top-link */ ?>
	<a href="#top" id="top-link">Top of Page</a>

	<div id="wrapper">