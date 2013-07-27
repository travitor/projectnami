<?php

/**
 * Functions and definitions
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! isset( $content_width ) )
	$content_width = 600;

// Tell WordPress to run mav_setup() when the 'after_setup_theme' hook is run.
add_action( 'after_setup_theme', 'mav_setup' );

if ( ! function_exists( 'mav_setup' ) ):


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */

function mav_setup() {

	// Post Format support
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'link', 'quote', 'video' ) );


	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 310, 200, true );


	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );


	// Make theme available for translation
	load_theme_textdomain( 'mav',  get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file =  get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );


	// Register WP3.0+ Menus
	register_nav_menus( array(
		'primary' => __( 'Header Navigation', 'mav' ),
		'secondary' => __( 'Footer Navigation', 'mav' )
	) );


	// This theme allows users to set a custom background
	$args = array(
		'default-image'          => get_template_directory_uri() . '/images/body-BG.png',
		'default-color'          => '4a4f54',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	);
	
	add_theme_support( 'custom-background', $args );

}

endif;


/**
 * Get our wp_nav_menu() fallback,
 * wp_page_menu(), to show a home link.
 */

function mav_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

add_filter( 'wp_page_menu_args', 'mav_page_menu_args' );



/**
 * Sets the post excerpt length to 40 characters.
 */

function mav_excerpt_length( $length ) {
	return 40; // 40 default
}

add_filter( 'excerpt_length', 'mav_excerpt_length' );



/**
 * Returns a "Continue Reading" link for excerpts
 */

function mav_continue_reading_link() {
	return '<p><a class="more-link" href="'. get_permalink() . '">' . __( 'Continue Reading', 'mav' ) . '</a></p>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts)
 * with an ellipsis and mav_continue_reading_link().
 */

function mav_auto_excerpt_more( $more ) {
	return ' &hellip;' . mav_continue_reading_link();
}

add_filter( 'excerpt_more', 'mav_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */

function mav_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= mav_continue_reading_link();
	}
	return $output;
}

add_filter( 'get_the_excerpt', 'mav_custom_excerpt_more' );


/**
 * Remove inline styles printed when the gallery shortcode is used.
 */

add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * `Gravatar
 */

add_filter( 'avatar_defaults', 'newgravatar' );

function newgravatar ($avatar_defaults) {
	$myavatar = get_template_directory_uri() . '/images/gravatar.png';
	$avatar_defaults[$myavatar] = "Theme Gravatar";
	return $avatar_defaults;
}


/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 */

function mav_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'mav_remove_gallery_css' );

if ( ! function_exists( 'mav_comment' ) ) :


/**
 * Template for Comments and Pingbacks
 */

function mav_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'mav' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
			/* translators: 1: date, 2: time */
			printf( __( '%1$s at %2$s', 'mav' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'mav' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->
		
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mav' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
	break;
	case 'pingback'  :
	case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mav' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'mav' ), ' ' ); ?></p>
	<?php
	break;
	endswitch;
}
endif;


/**
 * Register `Sidebars
 */

function mav_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Sidebar Blog', 'mav' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Located in the primary sidebar widget area. Widgets dragged here will be displayed in blog and single blog pages.', 'mav' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar Pages', 'mav' ),
		'id' => 'primary-widget-area-page',
		'description' => __( 'Located in the primary sidebar widget area. Widgets dragged here will be displayed in standard pages included page templates as contact and archives.', 'mav' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Sidebar Secondary', 'mav' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Located in the secondary sidebar widget area (all pages).', 'mav' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

/*
	// FOOTER WIDGET AREA
	register_sidebar( array(
		'name' => __( 'Footer First', 'mav' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'Located in the first footer widget area.', 'mav' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Second', 'mav' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'Located in the second footer widget area.', 'mav' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Third', 'mav' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'Located in the third footer widget area.', 'mav' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	

	register_sidebar( array(
		'name' => __( 'Footer Fourth', 'mav' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'Located in the fourth footer widget area.', 'mav' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
*/

}

// Register sidebars by running mav_widgets_init() on the widgets_init hook
add_action( 'widgets_init', 'mav_widgets_init' );



/**
 * Register `Widgets
 */

function of_register_widgets() {

	// Load each widget file
	require_once( 'admin/widgets/widget-custom-content.php' );
	require_once( 'admin/widgets/widget-latest-tweets.php' );
	require_once( 'admin/widgets/widget-blog-posts.php' );
	require_once( 'admin/widgets/widget-recent-work.php' );
	require_once( 'admin/widgets/widget-contact-info.php' );

	// Register each widget
	register_widget( 'of_Custom_Content_Widget' );
	register_widget( 'of_Latest_Tweet_Widget' );
	register_widget( 'of_Blog_Posts_Widget' );
	register_widget( 'of_Latest_Work_Widget' );
	register_widget( 'of_Contact_Info_Widget' );
}

add_action( 'widgets_init', 'of_register_widgets');


// Unregister all default WP Widgets
function unregister_default_wp_widgets() {
	unregister_widget('WP_Widget_Calendar');
}

add_action('widgets_init', 'unregister_default_wp_widgets', 1);


/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */

function mav_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

add_action( 'widgets_init', 'mav_remove_recent_comments_style' );


if ( ! function_exists( 'mav_posted_on' ) ) :

function mav_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="sep.by">by</span> %3$s', 'mav' ),
	'meta-prep meta-prep-author',
	sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
		get_permalink(),
		esc_attr( get_the_time() ),
		get_the_date()
	),
	sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
		get_author_posts_url( get_the_author_meta( 'ID' ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'mav' ), get_the_author() ) ),
		get_the_author()
	)
);
}
endif;


if ( ! function_exists( 'mav_posted_in' ) ) :

// Prints HTML with meta information for the current post (category, tags and permalink).
function mav_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', '<span class="sep"> / </span>' );
	if ( $tag_list ) {
		$posted_in = __( '<span>This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.</span>', 'mav' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'mav' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'mav' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( '<span class="sep"> / </span>' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


/**
 * `Register Javascripts
 */

function mav_include_js() {

	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/jquery.custom.js' );
	wp_register_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js' );
	wp_register_script( 'jquery-easing-compatibility', get_template_directory_uri() . '/js/jquery.easing.compatibility.js' );
	wp_register_script( 'form-validate', get_template_directory_uri() . '/js/jquery.validate.min.js' );
	wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js' );
	wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js' );
	wp_register_script( 'scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo-min.js' );
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr-2.5.3.js' );
	wp_register_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js' );
	wp_register_script( 'camera', get_template_directory_uri() . '/js/camera.min.js' );
	wp_register_script( 'jquery-tweet', get_template_directory_uri() . '/js/jquery.tweet.js' );

	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
	wp_enqueue_script( 'jquery-easing' );
	wp_enqueue_script( 'jquery-easing-compatibility' );
	wp_enqueue_script( 'form-validate' );
	wp_enqueue_script( 'prettyPhoto' );
	wp_enqueue_script( 'superfish' );
	wp_enqueue_script( 'scrollTo' );
	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'isotope' );
	wp_enqueue_script( 'camera' );
	wp_enqueue_script( 'jquery-mobile' );
	wp_enqueue_script( 'jquery-tweet' );

}

add_action( 'wp_enqueue_scripts', 'mav_include_js' );


/**
 * `Register Styles
 */

function mav_include_styles() {

	// Register the style like this for a theme:
	wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/styles/prettyPhoto.css');
	wp_register_style( 'plugins', get_template_directory_uri() . '/styles/plugins.css');
	wp_register_style( 'camera', get_template_directory_uri() . '/styles/camera.css');
	wp_register_style( 'media-queries', get_template_directory_uri() . '/styles/media-queries.css');

	// For either a plugin or a theme, you can then enqueue the style:
	wp_enqueue_style( 'prettyPhoto' );
	wp_enqueue_style( 'plugins' );
	wp_enqueue_style( 'camera' );
	wp_enqueue_style( 'media-queries' );

}  

add_action( 'wp_print_styles', 'mav_include_styles' );


/**
 * Option `Framework functions
 */

// Set the file path based on whether the Options Framework is in a parent theme or child theme
if ( get_stylesheet_directory() ==  get_template_directory() ) {
	define('OF_FILEPATH',  get_template_directory() );
	define('OF_DIRECTORY', get_template_directory_uri());
} else {
	define('OF_FILEPATH', get_stylesheet_directory());
	define('OF_DIRECTORY', get_stylesheet_directory_uri());
}

/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 		// Theme actions based on options settings



/**
 * Custom Menu Walker for `Responsive Menus
 * http://wpconsult.net/change-wordpress-navigation-to-a-dropdown-select-element-for-mobile/
 */

class Walker_Responsive_Menu extends Walker_Nav_Menu {

	var $to_depth = -1;

	function start_lvl(&$output, $depth) {
		$output .= '</option>';
	}

	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth); // don't output children closing tag
	}

	function start_el(&$output, $item, $depth, $args) {
		$indent = ( $depth ) ? str_repeat( "&nbsp;", $depth * 4 ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$value = ' value="'. $item->url .'"';
		$output .= '<option'.$id.$value.$class_names.'>';
		$item_output = $args->before;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$output .= $indent.$item_output;
	}

	function end_el(&$output, $item, $depth) {
		if(substr($output, -9) != '</option>')
		$output .= "</option>"; // replace closing </li> with the option tag
	}

}


/**
 * Custom `logo login
 */

add_action("login_head", "my_login_head");
function my_login_head() {
	echo "<style>
		body.login #login h1 a {
		background: url('".get_template_directory_uri()."/images/custom-logo-login.png') no-repeat scroll center top transparent;
		margin-bottom: 15px;
		min-height: 60px;
		background-size: auto;
	}
	</style>";
}


/**
 * `Slider Manager
 */

require_once(STYLESHEETPATH . '/admin/slidermanager/loader.php');


/**
 * Add Portfolio functions
 */

include('functions/portfolio-functions.php');


/**
 * Add Post formats Meta box
 */

include('functions/meta-box.php');


/**
 * Add Shortcodes
 */

include("functions/shortcodes.php");
