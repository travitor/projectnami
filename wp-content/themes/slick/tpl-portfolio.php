<?php

/* Template Name: Portfolio */

get_header(); ?>

<section id="content" class="portfolio" role="main">

	<header id="page-intro">

		<h1 class="page-title"><?php the_title(); ?></h1>
		<?php $portfolio_intro = stripslashes(get_option('of_portfolio_intro')); ?>
		<?php if ($portfolio_intro) { ?><p><?php echo $portfolio_intro; ?></p><?php } ?>

	</header><!-- /end #page-intro -->

	<?php the_post(); // Needed to retrieve the page content ?>

	<?php the_content(); ?>


	<ul id="filters" class="option-set">
		<li><a href="#" data-filter="*" class="show-all selected">show all</a></li>
		<?php
		$portfolio_categories = get_categories( array('taxonomy' => 'portfolio_category') );
			foreach($portfolio_categories as $category) {
				echo '<li><a href="#" data-filter=".' . $category->category_nicename . '">' . $category->name . '</a> </li>';
			}
		?>
	</ul>

	<section id="portfolio">

		<div id="container">

			<?php
			$portfolio_postperpage = stripslashes(get_option('of_portfolio_postperpage'));
			$portfolio_orderby = get_option('of_portfolio_order_1'); // date,title
			$portfolio_order = get_option('of_portfolio_order_2'); // ASC,DESC

			$paged = get_query_var('paged') ? get_query_var('paged') : 1;

			// START PORTFOLIO LOOP
			$query = new WP_Query();
			$query->query( array('post_type'=>'portfolio', 'posts_per_page'=> $portfolio_postperpage, 'paged' => $paged, 'orderby' => $portfolio_orderby, 'order' => $portfolio_order ) );

			while ($query->have_posts()) : $query->the_post();
			$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
			$terms = $terms == false ? array() : $terms;
			?>

			<?php include(get_template_directory() .'/inc/portfolio.php'); ?>

			<?php endwhile;  // WordPress Loop ENDS ?>

			<?php wp_reset_query(); // Reset the Query Loop ?>

		</div><!-- /end #container -->

	</section><!-- /end #portfolio -->

	<?php
		if(function_exists('wp_pagenavi')) {
			wp_pagenavi(array( 'query' => $query ) );
			wp_reset_postdata();
		}
	?>

</section><!-- /end #content -->

<?php // get_sidebar('portfolio'); ?>

<?php get_footer(); ?>
