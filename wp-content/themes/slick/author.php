<?php get_header(); ?>

<section id="content" role="main">

	<?php if ( have_posts() ) the_post(); ?>

	<header>
		<h1 class="page-title author"><?php printf( __( 'Author Archives %s', 'mav' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>
	</header>

	<?php
	// If a user has filled out their description, show a bio on their entries.
	if ( get_the_author_meta( 'description' ) ) : ?>
	<section id="entry-author-info">
		<div id="author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'mav_author_bio_avatar_size', 80 ) ); ?></div>

		<div id="author-description">
			<h3><?php printf( __( 'About %s', 'mav' ), get_the_author() ); ?></h3>
			<?php the_author_meta( 'description' ); ?>
		</div>
	</section><!-- /end #entry-author-info -->
	<?php endif; ?>

	<?php
		/* Since we called the_post() above, we need to
 	 	 * rewind the loop back to the beginning that way
 	 	 * we can run the loop properly, in full.
 	 	 */
		rewind_posts();

		/* Run the loop for the author archive page to output the authors posts
 	 	 * If you want to overload this in a child theme then include a file
 	 	 * called loop-author.php and that will be used instead.
 	 	 */
 		get_template_part( 'loop', 'author' );
	?>

</section><!-- /end #content -->

<?php get_sidebar(); ?>	

<?php get_footer(); ?>
