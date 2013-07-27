<?php
	$portfolio_home_postperpage = stripslashes(get_option('of_portfolio_home_postperpage'));
	$portfolio_orderby = get_option('of_portfolio_order_1'); // date,title
	$portfolio_order = get_option('of_portfolio_order_2'); // ASC,DESC
	
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	
	/* start portfolio loop */
	$query = new WP_Query();
	
	$query->query( array('post_type'=>'portfolio', 'posts_per_page'=> $portfolio_home_postperpage, 'paged' => $paged, 'orderby' => $portfolio_orderby, 'order' => $portfolio_order ) );
	
	while ($query->have_posts()) : $query->the_post();
	$terms = get_the_terms( get_the_ID(), 'portfolio_cat' );
	$terms = $terms == false ? array() : $terms;
?>

<?php
	$custom = get_post_custom(@$post->ID);
	$portfolio_permalink = $custom["portfolio_permalink"][0];
	$portfolio_desc = $custom["portfolio_desc"][0];
	$lightbox_path = $custom["lightbox_path"][0];
?>

<?php get_template_part('inc/portfolio'); ?>

<?php endwhile;  // WordPress loop ENDS ?>

<?php wp_reset_query(); // reset the query Loop ?>