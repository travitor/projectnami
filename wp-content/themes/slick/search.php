<?php get_header(); ?>

<section id="content" role="main">

	<?php if ( have_posts() ) : ?>
	<header>
		<h1 class="page-title"><?php printf( __( 'Search Results for %s', 'mav' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header>
	
	<?php
		/* Run the loop for the search to output the results.
		 * If you want to overload this in a child theme then include a file
		 * called loop-search.php and that will be used instead.
		 */
		 get_template_part( 'loop', 'search' );
	?>
	<?php else : ?>

	<article id="post-0" class="post no-results not-found">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'mav' ); ?></h1>
		<section class="entry-content">
			<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'mav' ); ?></p>
			<?php get_search_form(); ?>
		</section>
	</article><!-- /end #post-## -->

	<?php endif; ?>

</section><!-- /end #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
