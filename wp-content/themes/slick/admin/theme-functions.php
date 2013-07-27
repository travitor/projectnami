<?php

/* These are functions specific to the included option settings and this theme */

/*-----------------------------------------------------------------------------------*/
/* Theme Header Output - wp_head() */
/*-----------------------------------------------------------------------------------*/

// This sets up the layouts and styles selected from the options panel

if (!function_exists('optionsframework_wp_head')) {
	function optionsframework_wp_head() { 
		$shortname =  get_option('of_shortname');

		/*
// Styles
		if(!isset($_REQUEST['style']))
			$style = '';
		else
			$style = $_REQUEST['style'];
		if ($style != '') {
			$GLOBALS['stylesheet'] = $style;
			echo '<link href="'. OF_DIRECTORY .'/styles/'. $GLOBALS['stylesheet'] . '.css" rel="stylesheet" type="text/css" />'."\n";
		} else {
			$GLOBALS['stylesheet'] = get_option('of_alt_stylesheet');
				if($GLOBALS['stylesheet'] != '')
				echo '<link href="'. OF_DIRECTORY .'/styles/'. $GLOBALS['stylesheet'] .'" rel="stylesheet" type="text/css" />'."\n";
			else
				echo '<link href="'. OF_DIRECTORY .'/styles/alternate.php" rel="stylesheet" type="text/css" />'."\n";
		}
*/

		// This prints out the custom css and specific styling options
		of_head_css();
	}
}

add_action('wp_head', 'optionsframework_wp_head');


/*-----------------------------------------------------------------------------------*/
/* Output CSS from standarized options */
/*-----------------------------------------------------------------------------------*/

function of_head_css() {

	$shortname =  get_option('of_shortname');
	$output = '';

	$custom_css = get_option('of_custom_css');

	$primary_link = get_option('of_primary_link');
	$secondary_link = get_option('of_secondary_link');
	$selection_color = get_option('of_selection_color');
	$body_color = get_option('of_body_color');
	$body_image = get_option('of_body_image');
	$body_repeat = get_option('of_body_repeat');
	$body_pos = get_option('of_body_pos');
	$body_image_default = get_option('of_body_image_default');


/*
	if ($body_image <> '' && $body_image_default == "false") {
		$output .= "
body {
background-color: " . $body_color . ";
background-image: url(" . $body_image . ");
background-repeat: " . $body_repeat . ";
background-position: " . $body_pos . ";
}\n";
	}

	elseif ($body_image_default == "true") {
		$output .= "
body {
background-color: " . $body_color . ";
background-image: url(". OF_DIRECTORY ."/images/body-BG.png);
background-repeat: " . $body_repeat . ";
background-position: " . $body_pos . ";
}\n";
	}
	

	//elseif (empty ($body_image) ) {
	else {
		$output .= "
body { background-color: " . $body_color . "; }\n";
	}
*/


	if ($primary_link <> '') {
		$output .= "
a:link,
a:visited,
.tag-links a,
.tag-links a:link,
.tag-links a:visited,
.techs ul,
ul.tabs li.active a,
ul.tabs li.active a:hover,
h3.toggle.active a,
#site-info a:hover,
.entry-title a:active,
.entry-title a:hover,
a#twitter-link:hover,
p.copyright a:hover,
.single-portfolio .portfolio_categories a,
#navi ul li.current_page_item > a,
#navi ul li.current-menu-ancestor > a,
#navi ul li.current-menu-item > a,
#navi ul li.current-menu-parent > a,
#navi ul ul li.current_page_item > a,
#navi ul ul li.current-menu-ancestor > a,
#navi ul ul li.current-menu-item > a,
#navi ul ul li.current-menu-parent > a { color: " . $primary_link . "; }

h3.widget-title,
#navi-sidebar ul li.current_page_item > a,
#navi-sidebar ul li.current-menu-ancestor > a,
#navi-sidebar ul li.current-menu-item > a,
#navi-sidebar ul li.current-menu-parent > a,
.sticky .entry-format { background: " . $primary_link . "; }

.tagcloud a:hover,
#respond .form-submit input:hover,
.post-password-required input[type=\"submit\"]:hover,
#contactForm input.send-button:hover,
.portfolio_tags a:hover,
a.project-link:hover,
ul#filters li a:hover,
ul#filters li a.selected { background-color: " . $primary_link . "; border-color: " . $primary_link . "; }

blockquote { border-color: " . $primary_link . "; }

#navi-sidebar a.home-button-current,
#navi-sidebar a.home-button-current:hover,
#navi-sidebar .menu a.home-button-current,
#navi-sidebar .menu a.home-button-current:hover,
.page-template-tpl-homepage-php #navi-sidebar a.home-button,
.page-template-tpl-homepage-php #navi-sidebar .menu a.home-button { background-color: " . $primary_link . "; }\n";
	}


	if ($secondary_link <> '') {
		$output .= "
a:active,
a:hover,
.tag-links a:active,
.tag-links a:hover,
.archives-content-month li a:hover,
.archives-content-categories li a:hover,
.archives-content-blog-posts li a:hover,
.archives-content-portfolio li a:hover,
ul.related-list li a:hover,
#archives-content li a:hover,
.entry-meta a:active,
.entry-meta a:hover,
.entry-utility a:active,
.entry-utility a:hover,
.single-portfolio .portfolio_categories a:hover,
.wp-pagenavi a { color: " . $secondary_link . "; }

.wp-pagenavi a:hover { background: " . $secondary_link . " !important; border-color: " . $secondary_link . "; }\n";
	}


	if ($selection_color <> '') {
		$output .= "
::-webkit-selection { background: " . $selection_color . "; }
::-moz-selection { background: " . $selection_color . "; }
::selection { background: " . $selection_color . "; }\n";
	}


	if ($custom_css <> '') {
		$output .= $custom_css . "\n";
	}

	// Output styles
	if ($output <> '') {
		$output = "<!-- Custom Styling -->\n<style type=\"text/css\">" . $output . "</style>\n\n";
		echo $output;
	}

}


/*-----------------------------------------------------------------------------------*/
/* Add Body Classes for Layout
/*-----------------------------------------------------------------------------------*/

// This used to be done through an additional stylesheet call, but it seemed like
// a lot of extra files for something so simple. Adds a body class to indicate sidebar position.

add_filter('body_class','of_body_class');
 
function of_body_class($classes) {
	$shortname =  get_option('of_shortname');
	$layout = get_option($shortname .'_layout');
	if ($layout == '') {
		$layout = 'layout-2cr';
	}
	$classes[] = $layout;
	return $classes;
}


/*-----------------------------------------------------------------------------------*/
/* Add Favicon
/*-----------------------------------------------------------------------------------*/

function childtheme_favicon() {
		$shortname =  get_option('of_shortname');
		if (get_option($shortname . '_custom_favicon') != '') {
	        echo '<link rel="shortcut icon" href="'.  get_option('of_custom_favicon')  .'"/>'."\n";
	    }
		else { ?>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/admin/images/favicon.ico" />
<?php }
}

add_action('wp_head', 'childtheme_favicon');


/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function childtheme_analytics(){
	$shortname =  get_option('of_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','childtheme_analytics');

?>
