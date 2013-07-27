<?php
$blog_home_postperpage = stripslashes(get_option('of_blog_home_postperpage'));
$blog_home_cat = stripslashes(get_option('of_blog_home_cat'));
$blog_title = stripslashes(get_option('of_blog_page_title'));
$blog_intro = stripslashes(get_option('of_blog_intro'));
$blog_page_id = get_option('of_blog_page_id');
?>

<?php	
$cat_term_id = get_cat_ID( $blog_home_cat );
$args = array(
	'posts_per_page'=> $blog_home_postperpage, // Number of latest posts that will be shown.
	'ignore_sticky_posts'=>1,
	'category__in' => $cat_term_id
	);
$categories=get_categories($args);				
$my_query = new WP_Query($args);
$wp_query = $my_query;
	if( $my_query->have_posts() ) {
?>

<section id="blog-home">

	<?php if ($blog_title) { ?><h3><?php echo $blog_title; ?></h3><?php } ?>

	<ul class="blog-list-home">
		<?php
		while( $my_query->have_posts() ) {
			$my_query->the_post(); ?>

		<li class="item">
			<article>
				<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="">
					<?php the_post_thumbnail(); ?>
				</a>
				<?php } else { ?>
				<img class="attachment-post-thumbnail wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/thumb-ph.jpg" alt="<?php the_title_attribute(); ?>" />
				<?php } // if has_post_thumbnail ?>

				<h3 class="item-title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h3>
				<span class="item_date"><?php the_time('F j, Y'); ?></span>
				<?php the_excerpt(); ?>
			</article>
		</li><!-- /end .item -->

		<?php } // /end while( $my_query->have_posts()

	echo '</ul><!-- /end .blog-list-home -->
</section><!-- /end #blog-home -->';

	} // END if( $my_query->have_posts()

	wp_reset_query(); ?>

