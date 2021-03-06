<?php

/* `Portfolio Post Type
----------------------------------------------------------------------------------- */

/**
 * Flushes rewrite rules on plugin activation to ensure portfolio posts don't 404
 * http://codex.wordpress.org/Function_Reference/flush_rewrite_rules
 */

function portfolioposttype_activation() {
	portfolioposttype();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'portfolioposttype_activation' );


function portfolioposttype() {

	/**
	 * Enable the Portfolio custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	$labels = array(
		'name' => __( 'Portfolio', 'portfolioposttype', '' ),
		'singular_name' => __( 'Portfolio Item', 'portfolioposttype', '' ),
		'add_new' => __( 'Add New', 'portfolioposttype', 'mav' ),
		'add_new_item' => __( 'Add New Portfolio Item', 'portfolioposttype', '' ),
		'edit_item' => __( 'Edit Portfolio Item', 'portfolioposttype', '' ),
		'new_item' => __( 'Add New Portfolio Item', 'portfolioposttype', '' ),
		'view_item' => __( 'View Item', 'portfolioposttype', '' ),
		'search_items' => __( 'Search Portfolio', 'portfolioposttype', '' ),
		'not_found' => __( 'No portfolio items found', 'portfolioposttype', '' ),
		'not_found_in_trash' => __( 'No portfolio items found in trash', 'portfolioposttype', '' ),
		'all_items' => __( 'All Portfolio Posts', 'portfolio', '' )
	);

	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' ),
		'capability_type' => 'post',
		'rewrite' => array( "slug" => "portfolio-item", 'with_front' => false ), // Permalinks format
		'menu_position' => 5,
		'has_archive' => true
	);

	register_post_type( 'portfolio', $args );


	/**
	 * Register a taxonomy for Portfolio Categories
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

    $taxonomy_portfolio_category_labels = array(
		'name' => _x( 'Portfolio Categories', 'portfolioposttype', '' ),
		'singular_name' => _x( 'Portfolio Category', 'portfolioposttype', '' ),
		'search_items' => _x( 'Search Portfolio Categories', 'portfolioposttype', '' ),
		'popular_items' => _x( 'Popular Portfolio Categories', 'portfolioposttype', '' ),
		'all_items' => _x( 'All Portfolio Categories', 'portfolioposttype', '' ),
		'parent_item' => _x( 'Parent Portfolio Category', 'portfolioposttype', '' ),
		'parent_item_colon' => _x( 'Parent Portfolio Category:', 'portfolioposttype', '' ),
		'edit_item' => _x( 'Edit Portfolio Category', 'portfolioposttype', '' ),
		'update_item' => _x( 'Update Portfolio Category', 'portfolioposttype', '' ),
		'add_new_item' => _x( 'Add New Portfolio Category', 'portfolioposttype', '' ),
		'new_item_name' => _x( 'New Portfolio Category Name', 'portfolioposttype', '' ),
		'separate_items_with_commas' => _x( 'Separate portfolio categories with commas', 'portfolioposttype', '' ),
		'add_or_remove_items' => _x( 'Add or remove portfolio categories', 'portfolioposttype', '' ),
		'choose_from_most_used' => _x( 'Choose from the most used portfolio categories', 'portfolioposttype', '' ),
		'menu_name' => _x( 'Portfolio Categories', 'portfolioposttype', '' )
    );

    $taxonomy_portfolio_category_args = array(
		'labels' => $taxonomy_portfolio_category_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'portfolio-category', 'with_front' => false ),
		'query_var' => true
    );

    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $taxonomy_portfolio_category_args );


	/**
	 * Register a taxonomy for Portfolio Tags
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

	$taxonomy_portfolio_tag_labels = array(
		'name' => _x( 'Portfolio Tags', 'portfolioposttype', '' ),
		'singular_name' => _x( 'Portfolio Tag', 'portfolioposttype', '' ),
		'search_items' => _x( 'Search Portfolio Tags', 'portfolioposttype', '' ),
		'popular_items' => _x( 'Popular Portfolio Tags', 'portfolioposttype', '' ),
		'all_items' => _x( 'All Portfolio Tags', 'portfolioposttype', '' ),
		'parent_item' => _x( 'Parent Portfolio Tag', 'portfolioposttype', '' ),
		'parent_item_colon' => _x( 'Parent Portfolio Tag:', 'portfolioposttype', '' ),
		'edit_item' => _x( 'Edit Portfolio Tag', 'portfolioposttype', '' ),
		'update_item' => _x( 'Update Portfolio Tag', 'portfolioposttype', '' ),
		'add_new_item' => _x( 'Add New Portfolio Tag', 'portfolioposttype', '' ),
		'new_item_name' => _x( 'New Portfolio Tag Name', 'portfolioposttype', '' ),
		'separate_items_with_commas' => _x( 'Separate portfolio tags with commas', 'portfolioposttype', '' ),
		'add_or_remove_items' => _x( 'Add or remove portfolio tags', 'portfolioposttype', '' ),
		'choose_from_most_used' => _x( 'Choose from the most used portfolio tags', 'portfolioposttype', '' ),
		'menu_name' => _x( 'Portfolio Tags', 'portfolioposttype', '' )
	);

	$taxonomy_portfolio_tag_args = array(
		'labels' => $taxonomy_portfolio_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'portfolio-tag', 'with_front' => false ),
		'query_var' => true
	);

	register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $taxonomy_portfolio_tag_args );

}

add_action( 'init', 'portfolioposttype' );


// Allow thumbnails to be used on portfolio post type
add_theme_support( 'post-thumbnails', array( 'portfolio' ) );


/**
 * Add Columns to Portfolio Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */

function portfolioposttype_edit_columns($portfolio_columns){
	$portfolio_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Title', 'column name', '' ),
		"author" => __('Author', 'portfolioposttype', '' ),
		"portfolio_category" => __('Categories', 'portfolioposttype', '' ),
		"portfolio_tag" => __('Tags', 'portfolioposttype', '' ),
		"comments" => __('Comments', 'portfolioposttype', '' ),
		"date" => __('Date', 'portfolioposttype', '' ),
		"thumbnail" => __('Thumbnail', 'portfolioposttype', '' )
	);
	$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	return $portfolio_columns;
}

add_filter( 'manage_edit-portfolio_columns', 'portfolioposttype_edit_columns' );


function portfolioposttype_columns_display($portfolio_columns, $post_id){

	switch ( $portfolio_columns )
	
	{
		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
		
		case "thumbnail":
			$width = (int) 50;
			$height = (int) 50;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset($thumb) ) {
				echo $thumb;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;	
			
			// Display the portfolio tags in the column view
			case "portfolio_category":
			
			if ( $category_list = get_the_term_list( $post_id, 'portfolio_category', '', ', ', '' ) ) {
				echo $category_list;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;	
			
			// Display the portfolio tags in the column view
			case "portfolio_tag":
			
			if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo __('None', 'portfolioposttype');
			}
			break;			
	}
}

add_action( 'manage_posts_custom_column',  'portfolioposttype_columns_display', 10, 2 );


/**
 * Add Portfolio count to "Right Now" Dashboard Widget
 */

function add_portfolio_counts() {
        if ( ! post_type_exists( 'portfolio' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'portfolio' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'Portfolio Item', 'Portfolio Items', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=portfolio'>$num</a>";
            $text = "<a href='edit.php?post_type=portfolio'>$text</a>";
        }
        echo '<td class="first b b-portfolio">' . $num . '</td>';
        echo '<td class="t portfolio">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'Portfolio Item Pending', 'Portfolio Items Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=portfolio'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=portfolio'>$text</a>";
            }
            echo '<td class="first b b-portfolio">' . $num . '</td>';
            echo '<td class="t portfolio">' . $text . '</td>';

            echo '</tr>';
        }
}

add_action( 'right_now_content_table_end', 'add_portfolio_counts' );


// Add Portfolio Meta box

include('meta-box-portfolio.php');

?>