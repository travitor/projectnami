<div id="related-posts">

	<h4 class="related_title">You may also like</h4>
	<ul class="related-list">

	<?php
	$showposts = get_option('of_related_postperpage');

	global $post;
	$tags = wp_get_post_tags($post->ID);
	$do_not_duplicate[] = $post->ID;

	if ($tags) {
		$tag_ids = array();
		foreach($tags as $tag) $tag_ids[] = $tag->term_id;
		$args = array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page' => $showposts,
			'ignore_sticky_posts' => 1,
			'post__not_in' => $do_not_duplicate
		);

		$my_query = new wp_query( $args );

		if( $my_query->have_posts() ) {

			while( $my_query->have_posts() ) {
				$my_query->the_post();
	?>

		<li class="item">
			<figure>
				<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
				<?php } else { ?>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
					<img class="attachment-post-thumbnail wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/thumb-ph.jpg" alt="<?php the_title(); ?>" />
				</a>
				<?php } ?>
				<figcaption>
					<a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
						<?php
						$thetitle = $post->post_title; /* or you can use get_the_title() */
						$getlength = strlen($thetitle);
						$thelength = 44;
						echo substr($thetitle, 0, $thelength);
						if ($getlength > $thelength) echo "...";
						?>
					</a>
					<span class="item_date"><?php the_time('F j, Y'); ?></span>
				</figcaption>
			</figure>
		</li><!-- /end .item -->

	<?php
			}
		}
	} else {
	echo 'No posts found';
	}

	wp_reset_query();

	?>

	</ul><!-- /end .related-list -->
</div><!-- /end #related-posts -->

