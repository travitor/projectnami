<?php

/* Template Name: Archives */

get_header(); ?>

<section id="content" role="main">
	
	<?php the_post(); ?>

	<header>
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<section class="entry-content">
		<?php the_content(); ?>
	</section><!-- /end .entry-content -->

	<aside id="archives-content">

		<section class="archives-block-first">

			<section class="archives-content-categories">
				<h3>Archives by Categories</h3>
				<ul>
					<?php wp_list_categories( 'title_li=' ); ?>
				</ul>
			</section><!-- /end .archives-content-categories -->

			<section class="archives-content-month">
				<h3>Archives by Month</h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</section><!-- /end .archives-content-month -->

		</section><!-- /end .archives-block-first -->


		<section class="archives-block-second">

			<section class="archives-content-blog-posts">
				<h3>Latest 30 Blog Posts</h3>
				<ul>
					<?php
					$args = array( 'numberposts' => '30' );
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $post ){
						echo '<li><a href="' . get_permalink($post["ID"]) . '" title="Look '.$post["post_title"].'" >' .   $post["post_title"].'</a> </li> ';
					}
					?>
				</ul>
			</section><!-- /end .archives-content-blog-posts -->

			<section class="archives-content-portfolio">
				<h3>Portfolio Projects by Category</h3>
				<?php $portfolio_categories = get_terms('portfolio_category', 'hide_empty=1'); ?>
				<ul>
				<?php foreach( $portfolio_categories as $category ) : ?>
					<li>
						<span class="portfolio_cat"><?php echo $category->name; ?></span>
						<ul>
							<?php
							$args = array( 'post_type' => 'portfolio', 'taxonomy' => 'portfolio_category', 'term' => $category->slug ); // , 'posts_per_page' => 1
							$portfolio_categories_posts = new WP_Query ( $args );
							?>
							<?php foreach( $portfolio_categories_posts->posts as $post ) : ?>
								<li><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo $post->post_title; ?></a></li>
		  					<?php endforeach ?>
						</ul>
					</li>
				<?php endforeach ?>
				</ul>
			</section><!-- /end .archives-content-portfolio -->

		</section><!-- /end .archives-block-second -->

	</aside><!-- /end .archives-content -->

</section><!-- /end #content -->

<?php get_sidebar('page'); ?>

<?php get_footer(); ?>
