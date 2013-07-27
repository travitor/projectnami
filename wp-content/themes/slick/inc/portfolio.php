<?php
	$custom = get_post_custom(@$post->ID);
	$portfolio_permalink = $custom["portfolio_permalink"][0];
	$portfolio_desc = $custom["portfolio_desc"][0];
	$lightbox_path = $custom["lightbox_path"][0];
?>
<div class="element <?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>">

	<figure>

		<?php if ( has_post_thumbnail() ) { ?>
		
		<?php if ($portfolio_permalink) { ?>
		<a href="<?php echo $portfolio_permalink ?>" rel="bookmark">
			<?php the_post_thumbnail(); ?>
		</a>
		<?php } elseif ($lightbox_path) { ?>
		<div class="lightbox-yes">
			<a href="<?php echo $lightbox_path ?>" data-rel="prettyPhoto" title="<?php the_title_attribute();  ?>">
				<span class="overlay"></span>
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
		<?php } else { ?>
		<a href="<?php the_permalink() ?>" rel="bookmark">
			<?php the_post_thumbnail(); ?>
		</a>
		<?php } ?>
		<?php } else { ?>
		<img class="attachment-post-thumbnail wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/thumb-ph.jpg" alt="<?php the_title_attribute(); ?>" />

		<?php } /* if has_post_thumbnail */ ?>

		<figcaption>
			<h3 class="item-title">
				<?php if ($portfolio_permalink) { ?>
				<a href="<?php echo $portfolio_permalink ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php } else { ?>
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php } ?>
			</h3>

			<p class="portfolio_categories">
				<?php
				$portfolio_categories = wp_get_object_terms(@$post->ID, 'portfolio_category');
				if ($portfolio_categories) {
						$portfolio_category = array();
						foreach($portfolio_categories as $category) {
	  						$portfolio_category[] = '<a href="'.get_home_url().'/?portfolio_category=' . $category->slug . '">' . $category->name . '</a>';
						}
						echo implode(' / ', $portfolio_category);
				}
				?>
			</p>

			<?php if ($portfolio_desc) { ?><p class="portfolio-description"><?php echo $portfolio_desc ?></p><?php } ?>

		</figcaption>

	</figure>

</div><!-- /end .element -->
