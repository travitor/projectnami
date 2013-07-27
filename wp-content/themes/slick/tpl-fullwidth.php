<?php

/* Template Name: Full Width */

get_header(); ?>

<section id="content" class="one-column" role="main">
	<?php
	/* Run the loop to output the page.
 	 * If you want to overload this in a child theme then include a file
 	 * called loop-page.php and that will be used instead.
 	 */
	get_template_part( 'loop', 'page' );
	?>
</section><!-- /end #content .one-column -->

<?php get_footer(); ?>
