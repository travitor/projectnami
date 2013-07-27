<?php

/*
	THEME OPTIONS

	----------------------------------------------------------------------------------- */
	
	add_action('init', 'of_options');

	if (!function_exists('of_options')) {
	function of_options(){
	
	// VARIABLES
	$theme_data = wp_get_theme($stylesheet = null, $theme_root = null);
	$themename = $theme_data['Name'];
	$themeversion = $theme_data['Version'];
	$shortname = "of";

	// Populate OptionsFramework option in array for use in theme
	global $of_options;
	$of_options = get_option('of_options');

	$GLOBALS['template_path'] = OF_DIRECTORY;

	// Access the WordPress Categories via an Array
	$of_categories = array();
	$of_categories_obj = get_categories('hide_empty=0');
	foreach ($of_categories_obj as $of_cat) {
    	$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
	$categories_tmp = array_unshift($of_categories, "Select a category:");

	// Access the WordPress Pages via an Array
	$of_pages = array();
	$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
	foreach ($of_pages_obj as $of_page) {
    	$of_pages[$of_page->ID] = $of_page->post_name; }
	$of_pages_tmp = array_unshift($of_pages, "Select a page:");

	// Image Alignment radio box
	$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");

	// Image Links to Options
	$options_image_link_to = array("image" => "The Image","post" => "The Post");

	// Select
/* 	$options_select = array("one","two","three","four","five"); */
	$options_select = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","-1");
	$portfolio_order_1 = array("date","title");
	$portfolio_order_2 = array("DESC","ASC");
	$slider_effect_options_select = array(
		"random" => "random",
		"simpleFade" => "simpleFade",
		"curtainTopLeft" => "curtainTopLeft",
		"curtainTopRight" => "curtainTopRight",
		"curtainBottomLeft" => "curtainBottomLeft",
		"curtainBottomRight" => "curtainBottomRight",
		"curtainSliceLeft" => "curtainSliceLeft",
		"curtainSliceRight" => "curtainSliceRight",
		"blindCurtainTopLeft" => "blindCurtainTopLeft",
		"blindCurtainTopRight" => "blindCurtainTopRight",
		"blindCurtainBottomLeft" => "blindCurtainBottomLeft",
		"blindCurtainBottomRight" => "blindCurtainBottomRight",
		"blindCurtainSliceBottom" => "blindCurtainSliceBottom",
		"blindCurtainSliceTop" => "blindCurtainSliceTop",
		"mosaic" => "mosaic",
		"mosaicReverse" => "mosaicReverse",
		"mosaicRandom" => "mosaicRandom",
		"mosaicSpiral" => "mosaicSpiral",
		"mosaicSpiralReverse" => "mosaicSpiralReverse",
		"topLeftBottomRight" => "topLeftBottomRight",
		"bottomRightTopLeft" => "bottomRightTopLeft",
		"bottomLeftTopRight" => "bottomLeftTopRight",
		"scrollLeft" => "scrollLeft",
		"scrollRight" => "scrollRight",
		"scrollHorz" => "scrollHorz",
		"scrollBottom" => "scrollBottom",
		"scrollTop" => "scrollTop"
	);

	// More Options
	$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	$uploads_arr = wp_upload_dir();
	$all_uploads_path = $uploads_arr['path'];
	$all_uploads = get_option('of_uploads');
	$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15");
/* 	$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat"); */
	$body_repeat = array('repeat' => "repeat", 'no-repeat' => 'no-repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y');
/* 	$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right"); */
	$body_pos = array(
		'top left' => 'top left',
		'top center' => "top center",
		'top right' => 'top right',
		'center left' => 'center left',
		'center center' => 'center center',
		'center right' => 'center right',
		'bottom left' => 'bottom left',
		'bottom center' => 'bottom center',
		'bottom right' => 'bottom right'
	);

	$true_false = array("true","false");

	// Stylesheets Reader /* array in this page, function in theme-functions.php */
/*
	$alt_stylesheet_path = OF_FILEPATH . '/styles/';
	$alt_stylesheets = array();

	if ( is_dir($alt_stylesheet_path) ) {
    	if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        	while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            	if(stristr($alt_stylesheet_file, ".css") !== false) {
                	$alt_stylesheets[] = $alt_stylesheet_file;
            	}
        	}
    	}
	}
*/


	// Set the Options Array
	$options = array();


	// General Settings
	$options[] = array( "name" => "General Settings",
                    	"type" => "heading"
						);


	$options[] = array( "name" => "",
						"desc" => "In this area you may configure the general set up of your theme. Upload your logo, choose the layout, add a favicon and your analytics tracking code.",
						"type" => "intro"
						);

	// Logo
	$options[] = array( "name" => "Logo",
						"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
						"id" => $shortname."_logo",
						"std" => "",
						"type" => "upload"
						);
	
	// Logo text
	$options[] = array( "name" => "Enable Plain Text Logo",
						"desc" => "Check this to use a plain text logo rather than an image",
						"id" => $shortname."_logo_text",
						"std" => "false",
						"type" => "checkbox"
						);

	// Layout
	$url =  OF_DIRECTORY . '/admin/images/';
	$options[] = array( "name" => "Layout",
						"desc" => "Select the sidebar alignment",
						"id" => $shortname."_layout",
						"std" => "layout-2cr",
						"type" => "images",
						"options" => array(
							'layout-2cr' => $url . '2cr.png',
							'layout-2cl' => $url . '2cl.png')
						);

	// Custom Favicon
	$options[] = array( "name" => "Custom Favicon",
						"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon",
						"id" => $shortname."_custom_favicon",
						"std" => "",
						"type" => "upload"
						);

	// Tracking Code
	$options[] = array( "name" => "Tracking Code",
						"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme",
						"id" => $shortname."_google_analytics",
						"std" => "",
						"type" => "textarea"
						);



	/* `Styling options
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Styling Options",
						"type" => "heading"
						);
	
	$options[] = array( "name" => "",
/*						"desc" => "Here you configure the visual appearance of you theme, choose link colors, modify the background color and image. You may also insert some custom CSS.", */
 						"desc" => "Here you configure the visual appearance of you theme, choose link colors and insert some custom CSS. To modify the background color or image go to <strong>Appearance > <a href=\"?page=custom-background\">Background</a></strong>",
						"type" => "intro"
						);


	$options[] = array( "name" => "Primary Link Color (default #5cb3dc)",
						"desc" => "Select the primary link color",
						"id" => $shortname."_primary_link",
						"std" => "#5cb3dc",
						"type" => "color"
						);

	$options[] = array( "name" => "Secondary Link Color (default #d16495)",
						"desc" => "Select the secondary link color",
						"id" => $shortname."_secondary_link",
						"std" => "#d16495",
						"type" => "color"
						);

	$options[] = array( "name" => "Selection Color (default #e28ab2)",
						"desc" => "Select the selection color",
						"id" => $shortname."_selection_color",
						"std" => "#e28ab2",
						"type" => "color"
						);

	/*
$options[] = array( "name" => "Background Image",
						"desc" => 'Upload a background image',
						"id" => $shortname."_body_image",
						"std" => "",
						//"std" => get_template_directory_uri() . "/images/body-BG.png",
						"type" => "upload"
						);

	$options[] = array( "name" => "Theme Background Image (default)",
						"desc" => "Check this if you wish to use the default theme background image. Your uploaded background image (if any) will be replaced by the one used in the theme demo.",
						"id" => $shortname."_body_image_default",
						"std" => "false",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Body Background Color (default #4a4f54)",
						"desc" => "Select the body background color",
						"id" => $shortname."_body_color",
						"std" => "#4a4f54",
						"type" => "color"
						);

	$options[] = array( "name" => "Background Repeat",
						"desc" => "Set the background repeat for the background image",
						"id" => $shortname."_body_repeat",
						"std" => "repeat",
						"type" => "radio",
						"options" => $body_repeat
						);

	$options[] = array( "name" => "Background Position",
						"desc" => "Set the background position for the background image",
						"id" => $shortname."_body_pos",
						"std" => "top left",
						"type" => "radio",
						"options" => $body_pos
						);
*/

	$options[] = array( "name" => "Custom CSS",
                    	"desc" => "Quickly add some CSS to your theme by adding it to this block",
                    	"id" => $shortname."_custom_css",
                    	"std" => "",
                    	"type" => "textarea"
						);

/*
	$options[] = array( "name" => "Theme Stylesheet",
						"desc" => "Select your themes alternative color scheme. You may find the css file in the style folder.",
						"id" => $shortname."_alt_stylesheet",
						"std" => "alternate.css",
						"type" => "select",
						"options" => $alt_stylesheets
						);
*/

/*	$options[] = array( "name" => "Example Options",
						"type" => "heading"
						);

	$options[] = array( "name" => "Typograpy",
						"desc" => "This is a typographic specific option.",
						"id" => $shortname."_typograpy",
						"std" => array('size' => '16','unit' => 'em','face' => 'verdana','style' => 'bold italic','color' => '#123456'),
						"type" => "typography"
						);
					
	$options[] = array( "name" => "Border",
						"desc" => "This is a border specific option.",
						"id" => $shortname."_border",
						"std" => array('width' => '2','style' => 'dotted','color' => '#444444'),
						"type" => "border"
						);
					
	$options[] = array( "name" => "Colorpicker",
						"desc" => "No color selected.",
						"id" => $shortname."_example_colorpicker",
						"std" => "",
						"type" => "color"
						);
					
	$options[] = array( "name" => "Colorpicker (default #2098a8)",
						"desc" => "Color selected.",
						"id" => $shortname."_example_colorpicker_2",
						"std" => "#2098a8",
						"type" => "color"
						);
                    
	$options[] = array( "name" => "Upload Basic",
						"desc" => "An image uploader without text input.",
						"id" => $shortname."_uploader",
						"std" => "",
						"type" => "upload_min"
						);
                                    
	$options[] = array( "name" => "Input Text",
						"desc" => "A text input field.",
						"id" => $shortname."_test_text",
						"std" => "Default Value",
						"type" => "text"
						);
                                        
	$options[] = array( "name" => "Input Checkbox (false)",
						"desc" => "Example checkbox with false selected.",
						"id" => $shortname."_example_checkbox_false",
						"std" => "false",
						"type" => "checkbox"
						);
                                        
	$options[] = array( "name" => "Input Checkbox (true)",
						"desc" => "Example checkbox with true selected.",
						"id" => $shortname."_example_checkbox_true",
						"std" => "true",
						"type" => "checkbox"
						);
                                                                               
	$options[] = array( "name" => "Input Select Small",
						"desc" => "Small Select Box.",
						"id" => $shortname."_example_select",
						"std" => "three",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select
						);

	$options[] = array( "name" => "Input Select Wide",
						"desc" => "A wider select box.",
						"id" => $shortname."_example_select_wide",
						"std" => "two",
						"type" => "select2",
						"options" => $options_radio
						);

	$options[] = array( "name" => "Input Radio (one)",
						"desc" => "Radio select with default of 'one'.",
						"id" => $shortname."_example_radio",
						"std" => "one",
						"type" => "radio",
						"options" => $options_radio
						);
					
	$url =  get_bloginfo('stylesheet_directory') . '/admin/images/';
	$options[] = array( "name" => "Image Select",
						"desc" => "Use radio buttons as images.",
						"id" => $shortname."_images",
						"std" => "",
						"type" => "images",
						"options" => array(
							'warning.css' => $url . 'warning.png',
							'accept.css' => $url . 'accept.png',
							'wrench.css' => $url . 'wrench.png'
							)
						);
                                        
	$options[] = array( "name" => "Textarea",
						"desc" => "Textarea description.",
						"id" => $shortname."_example_textarea",
						"std" => "Default Text",
						"type" => "textarea"
						);

	$options[] = array( "name" => "Multicheck",
						"desc" => "Multicheck description.",
						"id" => $shortname."_example_multicheck",
						"std" => "two",
						"type" => "multicheck",
						"options" => $options_radio
						);
                                        
	$options[] = array( "name" => "Select a Category",
						"desc" => "A list of all the categories being used on the site.",
						"id" => $shortname."_example_category",
						"std" => "Select a category:",
						"type" => "select",
						"options" => $of_categories
						);
	*/


	/* `Slider
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Slider",
						"type" => "heading"
						);

	$options[] = array( "name" => "",
						"desc" => "In this section you may set up the homepage slider. Use the <strong><a href=\"?page=slidermanager\">Slider Manager</a></strong> to add images.",
						"type" => "intro"
						);

	$options[] = array( "name" => "Enable Homepage Slider",
						"desc" => "Check this to display the homepage slider",
						"id" => $shortname."_home_slider",
						"std" => "true",
						"type" => "checkbox"
						);
						
	$options[] = array( "name" => "Slider Height",
						"desc" => "Enter the height value in percentage of your slider (relative to the width of the slideshow, for instance '43%' by default)",
						"id" => $shortname."_slider_height",
						"std" => "43%",
						"type" => "text"
						);

	$options[] = array( "name" => "Effect",
						"desc" => "Select the slider effect",
						"id" => $shortname."_slider_effect",
						"std" => "",
						"type" => "select",
						"class" => "tiny", //mini, tiny, small
						"options" => $slider_effect_options_select
						);

	$options[] = array( "name" => "Pause hover",
						"desc" => "true or false. Pause on state hover. Not available for mobile devices (true by default)",
						"id" => $shortname."_slider_hover",
						"std" => "true",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $true_false
						);

	// RELATIVE TO CAMERA, JUST HIDDEN
	// $options[] = array( "name" => "Play/Pause",
	// 					"desc" => "true or false, to display or not the play/pause buttons (true by default)",
	// 					"id" => $shortname."_slider_playPause",
	// 					"std" => "true",
	// 					"type" => "select",
	// 					"class" => "mini", //mini, tiny, small
	// 					"options" => $true_false
	// 					);

	$options[] = array( "name" => "TransPeriod",
						"desc" => "Length of the sliding effect in milliseconds (1500 by default)",
						"id" => $shortname."_slider_transPeriod",
						"std" => "1500",
						"type" => "text"
						);

	$options[] = array( "name" => "Time",
						"desc" => "Milliseconds between the end of the sliding effect and the start of the nex one (7000 by default)",
						"id" => $shortname."_slider_time",
						"std" => "7000",
						"type" => "text"
						);

	$options[] = array( "name" => "Pagination",
						"desc" => "true or false (true by default)",
						"id" => $shortname."_slider_pagination",
						"std" => "true",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $true_false
						);

	$options[] = array( "name" => "Thumbnails",
						"desc" => "true or false (true by default)",
						"id" => $shortname."_slider_thumbnails",
						"std" => "true",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $true_false
						);




	/* `Welcome Messsage
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Welcome Message",
						"type" => "heading"
						);

	$options[] = array( "name" => "",
						"desc" => "Use this section to write down an awesome introduction.",
						"type" => "intro"
						);

	// Home Message
	$options[] = array( "name" => "Enable Welcome Message",
						"desc" => "Check this to display the Welcome Message in the homepage",
						"id" => $shortname."_home_msg",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Title",
						"desc" => "Enter the Welcome Message title",
						"id" => $shortname."_home_msg_title",
						"std" => "Title here",
						"type" => "text"
						);

	$options[] = array( "name" => "Text Content",
						"desc" => "Enter the text you would like to display as a Welcome Message, you may use HTML",
						"id" => $shortname."_home_msg_text",
						"std" => "Your content here",
						"type" => "textarea"
						);




	/* `Portfolio
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Portfolio",
						"type" => "heading"
						);

	$options[] = array( "name" => "",
						"desc" => "In this area you can configure and control all the portfolio settings, number of posts to display, pagination, the order of your portfolio posts, similar projects etc..",
						"type" => "intro"
						);

	// allow portfolio posts in homepage, true by default
	$options[] = array( "name" => "Enable Homepage Portfolio",
						"desc" => "Check this to display your Portfolio in the homepage",
						"id" => $shortname."_portfolio_home",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Title",
						"desc" => "The title will be displayed in the <strong>HOMEPAGE ONLY</strong>",
						"id" => $shortname."_portfolio_home_title",
						"std" => "Recent Works",
						"type" => "text"
						);

	$options[] = array( "name" => "Number of Posts",
						"desc" => "Define the number of posts you want to display in the homepage (-1 shows all posts)",
						"id" => $shortname."_portfolio_home_postperpage",
						"std" => "8",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select
						);

	$options[] = array( "name" => "Text Content",
						"desc" => "Enter the text content for the portfolio page, you may use HTML. It will be displayed in the <strong>portfolio page template</strong>",
						"id" => $shortname."_portfolio_intro",
						"std" => "Your content here",
						"type" => "textarea"
						);

	// Portfolio Page ID
	$options[] = array( "name" => "Portfolio Page ID",
						"desc" => "The ID you enter will be used to make works properly the <u>Back to Portfolio</u> link button in the <strong>single portfolio page</strong>",
						"id" => $shortname."_portfolio_page_id",
						"std" => '',
						"type" => "text"
						);
	
	
	$options[] = array( "name" => "",
						"desc" => "The following settings will be used for the portfolio page only.",
						"type" => "intro"
						);
	
	// Portfolio Pagination
	$options[] = array( "name" => "Number of Posts (Use Pagination)",
						"desc" => "Define the number of posts you want to display in the Portfolio Page (-1 shows all posts). <strong>The pagination will works only if WP-PageNavi plugin is installed (download from <a href=\"http://wordpress.org/extend/plugins/wp-pagenavi/\">http://wordpress.org/extend/plugins/wp-pagenavi/</a>)</strong>",
						"id" => $shortname."_portfolio_postperpage",
						"std" => "-1",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select
						);
	
	// Portfolio ORDER
	$options[] = array( "name" => "Order items by",
						"desc" => "You may choose to order your portfolio page by 'date' or by 'title'",
						"id" => $shortname."_portfolio_order_1",
						"std" => "",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $portfolio_order_1
						);

	$options[] = array( "name" => "",
						"desc" => "It may also be sorted by 'ASC' (ascending) or 'DESC' (descending)",
						"id" => $shortname."_portfolio_order_2",
						"std" => "",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $portfolio_order_2
						);

	// Similar Projects
	$options[] = array( "name" => "Enable Similar Projects",
						"desc" => "Check this to display the Related Posts for the single portfolio page (by entry tags)",
						"id" => $shortname."_similar_projects",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Number of Similar Projects",
						"desc" => "Select the number of posts you want to display as related content (-1 shows all posts)",
						"id" => $shortname."_similar_projects_perpage",
						"std" => "3",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select
						);



	/* `About
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "About",
						"type" => "heading"
						);
	
	$options[] = array( "name" => "",
						"desc" => "Use this section to write down an awesome introduction.",
						"type" => "intro"
						);

	$options[] = array( "name" => "Enable Homepage About",
						"desc" => "Check this to display the About area on the homepage",
						"id" => $shortname."_about_home",
						"std" => "true",
						"type" => "checkbox"
						);
	
	$options[] = array( "name" => "Title",
						"desc" => "The title will be displayed in the <strong>HOMEPAGE ONLY</strong>",
						"id" => $shortname."_about_title",
						"std" => "About Us",
						"type" => "text"
						);
	
	$options[] = array( "name" => "Image URL",
						"desc" => "",
						"id" => $shortname."_about_img",
						"std" => "",
						"type" => "upload"
						);

	$options[] = array( "name" => "Text Content",
						"desc" => "Enter the text content for the about area, you may use HTML. It will be displayed in the <strong>HOMEPAGE ONLY</strong>",
						"id" => $shortname."_about_content",
						"std" => "Your content here",
						"type" => "textarea"
						);

	$options[] = array( "name" => "About Page ID",
						"desc" => "The ID you enter will be used to connect the <u>Continue reading</u> link button in the <strong>homepage</strong> to your <strong>about page</strong>",
						"id" => $shortname."_about_page_id",
						"std" => '',
						"type" => "text"
						);



	/* `Blog
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Blog",
						"type" => "heading"
						);

	$options[] = array( "name" => "",
						"desc" => "In this area you can configure and control the blog homepage and blog page settings.",
						"type" => "intro"
						);

	// allow blog posts in homepage, true by default
	$options[] = array( "name" => "Enable Homepage Blog",
						"desc" => "Check this to display the Blog Posts in the homepage",
						"id" => $shortname."_blog_home",
						"std" => "true",
						"type" => "checkbox"
						);
	
	$options[] = array( "name" => "Homepage Posts Category",
						"desc" => "Select the category you want to display in the homepage",
						"id" => $shortname."_blog_home_cat",
						"std" => "Uncategorized",
						"type" => "select",
						"options" => $of_categories
						);
	
	$options[] = array( "name" => "Number of Posts",
						"desc" => "Define the number of posts you want to display in the homepage (-1 shows all posts)",
						"id" => $shortname."_blog_home_postperpage",
						"std" => "1",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select
						);
	
/*
	$options[] = array( "name" => "Show Post Image",
						"desc" => "Check this to display the thumbnail image",
						"id" => $shortname."_blog_home_thumbnail",
						"std" => "true",
						"type" => "checkbox"
						);
*/
					
	$options[] = array( "name" => "Blog Page ID",
						"desc" => "The ID you enter will be used to connect the <u>Read the Blog</u> link button in the <strong>homepage</strong> to the <strong>blog page</strong>",
						"id" => $shortname."_blog_page_id",
						"std" => '',
						"type" => "text"
						);

	// Blog Page Title
	$options[] = array( "name" => "Title",
						"desc" => "Eg: Our Blog. This title will be displayed in the <strong>homepage</strong> and <strong>blog post page</strong>",
						"id" => $shortname."_blog_page_title",
						"std" => 'Blog',
						"type" => "text"
						);

	$options[] = array( "name" => "Text Content",
						"desc" => "Enter the text content for the portfolio page, you may use HTML. It will be displayed in the <strong>blog post page</strong>",
						"id" => $shortname."_blog_intro",
						"std" => "Your content here",
						"type" => "textarea"
						);

	// Related Posts
	$options[] = array( "name" => "Enable Related Posts",
						"desc" => "Check this to display the Related Posts for the single blog page (by post tags)",
						"id" => $shortname."_related_posts",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Number of Related Posts",
						"desc" => "Select the number of posts you want to display as related content (-1 shows all posts)",
						"id" => $shortname."_related_postperpage",
						"std" => "4",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $options_select
						);



	/* `Twitter homepage
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Twitter",
						"type" => "heading"
						);

	$options[] = array( "name" => "",
						"desc" => "Control and set up the homapage Twitter settings.",
						"type" => "intro"
						);

	$options[] = array( "name" => "Enable Homepage Twitter",
						"desc" => "Check this to display your Tweets in the homepage. To use the Twitter feature in the sidebars please see <strong>Appearance > Widgets</strong> and drag the <strong>Latest Tweets</strong> widget into a sidebar area",
						"id" => $shortname."_twitter",
						"std" => "true",
						"type" => "checkbox"
						);

	$options[] = array( "name" => "Username",
						"desc" => "Enter your twitter username. It will be used to show your latest tweets in the homepage",
						"id" => $shortname."_twitter_username",
						"std" => "MattiaViviani",
						"type" => "text"
						);

	$options[] = array( "name" => "Title",
						"desc" => "",
						"id" => $shortname."_twitter_title",
						"std" => "Latest Tweets",
						"type" => "text"
						);

	$options[] = array( "name" => "Text Link",
						"desc" => "For example, Follow me on Twitter, Stay up-to-date etc..",
						"id" => $shortname."_twitter_textlink",
						"std" => "Follow Me",
						"type" => "text"
						);

	$options[] = array( "name" => "How many tweets?",
						"desc" => "Choose how many tweets to display",
						"id" => $shortname."_twitter_count",
						"std" => "3",
						"type" => "select",
						"class" => "tiny", //mini, tiny, small
						"options" => $options_select
						);



	/* `Clients
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Clients",
						"type" => "heading"
						);

	$options[] = array( "name" => "",
						"desc" => "Here you can control and configure your homepage clients settings, write down an introduction and upload clients images.",
						"type" => "intro"
						);

	$options[] = array( "name" => "Enable Homepage Clients",
						"desc" => "Check this to display your client list on the homepage",
						"id" => $shortname."_clients_home",
						"std" => "true",
						"type" => "checkbox"
						);
	
	$options[] = array( "name" => "Title",
						"desc" => "The title will be displayed in the <strong>HOMEPAGE ONLY</strong>",
						"id" => $shortname."_clients_title",
						"std" => "Our Clients",
						"type" => "text"
						);
	
	$options[] = array( "name" => "Text Content",
						"desc" => "Enter the text content for the client list, you may use HTML. It will be displayed in the <strong>HOMEPAGE ONLY</strong>",
						"id" => $shortname."_clients_desc",
						"std" => "Your content here",
						"type" => "textarea"
						);

	$options[] = array( "name" => "Client 1 image URL",
						"desc" => "Recommended image size 200px * 135px",
						"id" => $shortname."_client1",
						"std" => "",
						"type" => "upload"
						);

	$options[] = array( "name" => "Client 2 Image URL",
						"desc" => "Recommended image size 200px * 135px",
						"id" => $shortname."_client2",
						"std" => "",
						"type" => "upload"
						);

	$options[] = array( "name" => "Client 3 Image URL",
						"desc" => "Recommended image size 200px * 135px",
						"id" => $shortname."_client3",
						"std" => "",
						"type" => "upload"
						);

	$options[] = array( "name" => "Client 4 Image URL",
						"desc" => "Recommended image size 200px * 135px",
						"id" => $shortname."_client4",
						"std" => "",
						"type" => "upload"
						);

	$options[] = array( "name" => "Client 5 Image URL",
						"desc" => "Recommended image size 200px * 135px",
						"id" => $shortname."_client5",
						"std" => "",
						"type" => "upload"
						);

	$options[] = array( "name" => "Client 6 Image URL",
						"desc" => "Recommended image size 200px * 135px",
						"id" => $shortname."_client6",
						"std" => "",
						"type" => "upload"
						);
	
	$options[] = array( "name" => "Client 7 Image URL",
						"desc" => "Recommended image size 200px * 135px",
						"id" => $shortname."_client7",
						"std" => "",
						"type" => "upload"
						);

	$options[] = array( "name" => "Client 8 Image URL",
						"desc" => "Recommended image size 200px * 135px",
						"id" => $shortname."_client8",
						"std" => "",
						"type" => "upload"
						);



	/* `Contact
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Contact",
						"type" => "heading"
						);

	$options[] = array( "name" => "",
						"desc" => "Set up your contact page, add the email address, write down an introduction, add Google Maps and other details related to your office/s.",
						"type" => "intro"
						);

	$options[] = array( "name" => "Text Content",
						"desc" => "Enter a description for the contact page",
						"id" => $shortname."_contact_page_desc",
						"std" => "",
						"type" => "textarea"
						);

	// Contact Email
	$options[] = array( "name" => "Email",
						"desc" => "The email address you enter will be used in the <strong>contact page template</strong>",
						"id" => $shortname."_contact_email",
						"std" => '',
						"type" => "text"
						);

	// Google Map URI
	$options[] = array( "name" => "Google Map URI",
						"desc" => "Add Google Maps to your website: http://maps.google.com/help/maps/getmaps/plot-one.html",
						"id" => $shortname."_gmap_uri",
						"std" => '',
						"type" => "text"
						);

	// OFFICE 1
	$options[] = array( "name" => "Enable Office 1",
						"desc" => "Check this to display the first business address",
						"id" => $shortname."_office1",
						"std" => "true",
						"type" => "checkbox"
						);

	// Address Title 1
	$options[] = array( "name" => "Address Title 1",
						"desc" => "Example: New York",
						"id" => $shortname."_address_title1",
						"std" => '',
						"type" => "text"
						);

	// Phone 1
	$options[] = array( "name" => "Phone 1",
						"desc" => "",
						"id" => $shortname."_phone1",
						"std" => '',
						"type" => "text"
						);

	// Phone 2
	$options[] = array( "name" => "Phone 2",
						"desc" => "",
						"id" => $shortname."_phone2",
						"std" => '',
						"type" => "text"
						);

	// Phone 3
	$options[] = array( "name" => "Phone 3",
						"desc" => "",
						"id" => $shortname."_phone3",
						"std" => '',
						"type" => "text"
						);

	// Address 1
	$options[] = array( "name" => "Address 1",
						"desc" => "",
						"id" => $shortname."_address1",
						"std" => '',
						"type" => "text"
						);

	// Address 2
	$options[] = array( "name" => "Address 2",
						"desc" => "",
						"id" => $shortname."_address2",
						"std" => '',
						"type" => "text"
						);

	// Address 3
	$options[] = array( "name" => "Address 3",
						"desc" => "",
						"id" => $shortname."_address3",
						"std" => '',
						"type" => "text"
						);

	// Office 1 Google Map Link
	$options[] = array( "name" => "Office 1 Google Map Link",
						"desc" => "Add Google Maps link for your first office",
						"id" => $shortname."_gmap_uri_o1",
						"std" => '',
						"type" => "text"
						);

	// OFFICE 2
	$options[] = array( "name" => "Enable Office 2",
						"desc" => "Check this to display the second business address",
						"id" => $shortname."_office2",
						"std" => "true",
						"type" => "checkbox"
						);

	// Address Title 1
	$options[] = array( "name" => "Address Title 2",
						"desc" => "Example: Los Angeles",
						"id" => $shortname."_address_title2",
						"std" => '',
						"type" => "text"
						);

	// Phone 1
	$options[] = array( "name" => "Phone 1",
						"desc" => "",
						"id" => $shortname."_phone4",
						"std" => '',
						"type" => "text"
						);

	// Phone 2
	$options[] = array( "name" => "Phone 2",
						"desc" => "",
						"id" => $shortname."_phone5",
						"std" => '',
						"type" => "text"
						);

	// Phone 3
	$options[] = array( "name" => "Phone 3",
						"desc" => "",
						"id" => $shortname."_phone6",
						"std" => '',
						"type" => "text"
						);

	// Address 1
	$options[] = array( "name" => "Address 1",
						"desc" => "",
						"id" => $shortname."_address4",
						"std" => '',
						"type" => "text"
						);

	// Address 2
	$options[] = array( "name" => "Address 2",
						"desc" => "",
						"id" => $shortname."_address5",
						"std" => '',
						"type" => "text"
						);

	// Address 3
	$options[] = array( "name" => "Address 3",
						"desc" => "",
						"id" => $shortname."_address6",
						"std" => '',
						"type" => "text"
						);

	// Office 2 Google Map Link
	$options[] = array( "name" => "Office 2 Google Map Link",
						"desc" => "Add Google Maps link for your second office",
						"id" => $shortname."_gmap_uri_o2",
						"std" => '',
						"type" => "text"
						);

	// SOCIAL
	$options[] = array( "name" => "Enable Social Links",
						"desc" => "Check this to display your social links list",
						"id" => $shortname."_social",
						"std" => "true",
						"type" => "checkbox"
						);

	// Social Title
	$options[] = array( "name" => "Social Links Title",
						"desc" => "Example: Follow Us",
						"id" => $shortname."_social_title",
						"std" => '',
						"type" => "text"
						);

	// Social 1
	$options[] = array( "name" => "Social 1",
						"desc" => "Enter a social network name (eg: Facebook, Twitter, Google+)",
						"id" => $shortname."_social1",
						"std" => '',
						"type" => "text"
						);
	
	$options[] = array( "name" => "Social 1 Link",
						"desc" => "Enter the social network link URI (eg: http://twitter.com/MattiaViviani)",
						"id" => $shortname."_social1_link",
						"std" => '',
						"type" => "text"
						);
	// Social 2
	$options[] = array( "name" => "Social 2",
						"desc" => "Enter a social network name (example: Facebook, Twitter, Google+)",
						"id" => $shortname."_social2",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Social 2 Link",
						"desc" => "Enter the social network link URI (eg: http://twitter.com/MattiaViviani)",
						"id" => $shortname."_social2_link",
						"std" => '',
						"type" => "text"
						);
	
	// Social 3
	$options[] = array( "name" => "Social 3",
						"desc" => "Enter a social network name (eg: Facebook, Twitter, Google+)",
						"id" => $shortname."_social3",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Social 3 Link",
						"desc" => "Enter the social network link URI (eg: http://twitter.com/MattiaViviani)",
						"id" => $shortname."_social3_link",
						"std" => '',
						"type" => "text"
						);

	// Social 4
	$options[] = array( "name" => "Social 4",
						"desc" => "Enter a social network name (eg: Facebook, Twitter, Google+)",
						"id" => $shortname."_social4",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Social 4 Link",
						"desc" => "Enter the social network link URI (eg: http://twitter.com/MattiaViviani)",
						"id" => $shortname."_social4_link",
						"std" => '',
						"type" => "text"
						);

	// Social 5
	$options[] = array( "name" => "Social 5",
						"desc" => "Enter a social network name (eg: Facebook, Twitter, Google+)",
						"id" => $shortname."_social5",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Social 5 Link",
						"desc" => "Enter the social network link URI (eg: http://twitter.com/MattiaViviani)",
						"id" => $shortname."_social5_link",
						"std" => '',
						"type" => "text"
						);



	/* `Footer + Social icons
	------------------------------------------------------------------------------- */

	$options[] = array( "name" => "Footer & Social Icons",
                    	"type" => "heading"
						);

	$options[] = array( "name" => "",
						"desc" => "Control and configure the footer area and social icons.",
						"type" => "intro"
						);

	// Footer Text
	$options[] = array( "name" => "Footer Text",
						"desc" => "Enter the text you would like to display in the <strong>left</strong> side of the footer, example: <strong>&copy; Copyright [the_year] [site_link]</strong>",
						"id" => $shortname."_footer_left",
						"std" => "",
						"type" => "textarea"
						);

/*
	// Footer Text (Right)
	$options[] = array( "name" => "Footer Text (Right)",
						"desc" => "Enter the text you would like to display in the <strong>right</strong> side of the footer.",
						"id" => $shortname."_footer_right",
						"std" => '',
						"type" => "textarea"
						);
*/
	
	// Enable Feeds
	$options[] = array( "name" => "Enable Feeds Icon",
						"desc" => "Check this to display the Feeds URL icon",
						"id" => $shortname."_feed_icon_yes",
						"std" => "true",
						"type" => "checkbox"
						);

	// Feeds URL
	$options[] = array( "name" => "Feeds URL",
						"desc" => "If you have an alternate feed address you can enter it here to have the theme redirect your feed links",
						"id" => $shortname."_feed_icon",
						"std" => '',
						"type" => "text"
						);

	// Social icons
	$options[] = array( "name" => "Facebook",
						"desc" => "Enter your Facebook account URL. eg:<br/>http://www.facebook.com/MattiaViviani.com",
						"id" => $shortname."_facebook_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Twitter",
						"desc" => "Enter your Twitter account URL",
						"id" => $shortname."_twitter_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Google",
						"desc" => "Enter your Google+ account URL",
						"id" => $shortname."_gplus_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Envato",
						"desc" => "Enter your Envato account URL",
						"id" => $shortname."_envato_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Dribbble",
						"desc" => "Enter your Dribbble account URL",
						"id" => $shortname."_dribbble_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "LinkedIn",
						"desc" => "Enter your LinkedIn account URL",
						"id" => $shortname."_linkedin_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Delicious",
						"desc" => "Enter your Delicious account URL",
						"id" => $shortname."_delicious_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Flickr",
						"desc" => "Enter your Flickr account URL",
						"id" => $shortname."_flickr_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Tumblr",
						"desc" => "Enter your Tumblr account URL",
						"id" => $shortname."_tumblr_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Vimeo",
						"desc" => "Enter your Vimeo account URL",
						"id" => $shortname."_vimeo_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "YouTube",
						"desc" => "Enter your YouTube account URL",
						"id" => $shortname."_youtube_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "deviantART",
						"desc" => "Enter your deviantART account URL",
						"id" => $shortname."_deviantart_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Last.fm",
						"desc" => "Enter your Last.fm account URL",
						"id" => $shortname."_lastfm_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Digg",
						"desc" => "Enter your Digg account URL",
						"id" => $shortname."_digg_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Stumbleupon",
						"desc" => "Enter your Stumbleupon account URL",
						"id" => $shortname."_stumbleupon_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Aol",
						"desc" => "Enter your Aol account URL",
						"id" => $shortname."_aol_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "MySpace",
						"desc" => "Enter your MySpace account URL",
						"id" => $shortname."_myspace_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Netvibes",
						"desc" => "Enter your Netvibes account URL",
						"id" => $shortname."_netvibes_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Newsvine",
						"desc" => "Enter your Newsvine account URL",
						"id" => $shortname."_newsvine_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Reddit",
						"desc" => "Enter your Reddit account URL",
						"id" => $shortname."_reddit_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "ShareThis",
						"desc" => "Enter your ShareThis account URL",
						"id" => $shortname."_sharethis_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Technorati",
						"desc" => "Enter your Technorati account URL",
						"id" => $shortname."_technorati_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Yahoo",
						"desc" => "Enter your Yahoo account URL",
						"id" => $shortname."_yahoo_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Yelp",
						"desc" => "Enter your Yelp account URL",
						"id" => $shortname."_yelp_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Foursquare",
						"desc" => "Enter your Foursquare account URL",
						"id" => $shortname."_foursquare_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Posterous",
						"desc" => "Enter your Posterous account URL",
						"id" => $shortname."_posterous_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "Pinterest",
						"desc" => "Enter your Pinterest account URL",
						"id" => $shortname."_pinterest_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "GitHub",
						"desc" => "Enter your GitHub account URL",
						"id" => $shortname."_github_icon",
						"std" => '',
						"type" => "text"
						);

	$options[] = array( "name" => "MattiaViviani.com",
						"desc" => "http://mattiaviviani.com",
						"id" => $shortname."_mav_icon",
						"std" => '',
						"type" => "text"
						);


		update_option('of_template',$options);			  
		update_option('of_themename',$themename);
		update_option('of_shortname',$shortname);

		}
	}

?>