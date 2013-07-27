<?php 


/* `Shortcodes
----------------------------------------------------------------------------------- */

add_filter('widget_text', 'do_shortcode');



/* The year ---------------------- */

function the_year() {
	$the_year = date('Y');
	return '' . $the_year . '';
}

add_shortcode('the_year', 'the_year');
// Usage: [the_year]



/* Site link ---------------------- */

function site_link() {
	$site_link = home_url();
	$site_name = get_bloginfo( 'name' );
	return '<a href="' . $site_link . '">' . $site_name . '</a>';
}

add_shortcode('site_link', 'site_link');
// Usage: [site_link]



/* Buttons ---------------------- */

function button_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'color' => '',
		'link' => '',
		'size' => '',
						), $atts ) );

	return '<a href="' . $link . '" class="button ' . $color . ' ' . $size . '">' . do_shortcode($content) . '</a>';
}
	
add_shortcode('button', 'button_shortcode');

// Usage: [button color="blue, green, orange, yellow, red, teal, purple, pink, aqua, silver, white, black" link="http://...", size="small, medium, big"]



/* Info boxes ---------------------- */

function box_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => '',
						), $atts ) );

	return '<div class="box ' . $type . '">' . do_shortcode($content) . '</div>';
}
	
add_shortcode('box', 'box_shortcode');
// Usage: [box type="normal, info, tick, note, alert"][/box]



/* Columns ---------------------- */

function shortcodes_one_third( $atts, $content = null ) {
	return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'shortcodes_one_third');


function shortcodes_one_third_last( $atts, $content = null ) {
	return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'shortcodes_one_third_last');


function shortcodes_two_third( $atts, $content = null ) {
	return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'shortcodes_two_third');


function shortcodes_two_third_last( $atts, $content = null ) {
	return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'shortcodes_two_third_last');


function shortcodes_one_half( $atts, $content = null ) {
	return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'shortcodes_one_half');


function shortcodes_one_half_last( $atts, $content = null ) {
	return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'shortcodes_one_half_last');


function shortcodes_one_fourth( $atts, $content = null ) {
	return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'shortcodes_one_fourth');


function shortcodes_one_fourth_last( $atts, $content = null ) {
	return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'shortcodes_one_fourth_last');


function shortcodes_three_fourth( $atts, $content = null ) {
	return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'shortcodes_three_fourth');


function shortcodes_three_fourth_last( $atts, $content = null ) {
	return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'shortcodes_three_fourth_last');


function shortcodes_one_fifth( $atts, $content = null ) {
	return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'shortcodes_one_fifth');


function shortcodes_one_fifth_last( $atts, $content = null ) {
	return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'shortcodes_one_fifth_last');


function shortcodes_two_fifth( $atts, $content = null ) {
	return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'shortcodes_two_fifth');


function shortcodes_two_fifth_last( $atts, $content = null ) {
	return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'shortcodes_two_fifth_last');


function shortcodes_three_fifth( $atts, $content = null ) {
	return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'shortcodes_three_fifth');


function shortcodes_three_fifth_last( $atts, $content = null ) {
	return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'shortcodes_three_fifth_last');


function shortcodes_four_fifth( $atts, $content = null ) {
	return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'shortcodes_four_fifth');


function shortcodes_four_fifth_last( $atts, $content = null ) {
	return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'shortcodes_four_fifth_last');


function shortcodes_one_sixth( $atts, $content = null ) {
	return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'shortcodes_one_sixth');


function shortcodes_one_sixth_last( $atts, $content = null ) {
	return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'shortcodes_one_sixth_last');


function shortcodes_five_sixth( $atts, $content = null ) {
	return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'shortcodes_five_sixth');


function shortcodes_five_sixth_last( $atts, $content = null ) {
	return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'shortcodes_five_sixth_last');



/* Toggle ---------------------- */

function toggle_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'title' => 'toggle'
), $atts ) );

	$result = '<div class="toggler"><h3 class="toggle"><a href="javascript:void(0);">'.esc_attr($title).'</a></h3>
	<div class="toggle_container">
		<div class="block">
			<p>' . do_shortcode($content) . '</p>
		</div>
	</div>
	</div>';
	return $result;
}

add_shortcode('toggle', 'toggle_shortcode');



/* Tabs ---------------------- */

function tabs_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'titles' => 'tabs',
	), $atts ) );

	$tab_titles  = esc_attr($titles);
	$tab_totals = explode(",", $tab_titles);

	$result = '<div id="tabs">';

	$result .= '<ul class="tabs">';
	$s = 1;
	for ( $i = 0; $i <= count($tab_totals)-1; $i++) {
		$result .= '<li><a href="#tab'.$s++.'">'.trim($tab_totals[$i]).'</a></li>';
	}
	$result .= '</ul>';

	$result .= '<div class="tab_container">';
	$result .= do_shortcode($content);
	$result .= '</div>'; // close .tab_container
	$result .= '</div>'; // close #tabs

	return $result;	
}

add_shortcode('tabs', 'tabs_shortcode');

function tab_shortcode( $atts, $content = null ) {
	$result = '<div class="tab_content">';
	$result .= do_shortcode($content);
	$result .= '</div>';
	return $result;
}

add_shortcode('tab', 'tab_shortcode');

?>