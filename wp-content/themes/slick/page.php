<?php get_header(); ?>

<section id="content" role="main">
	
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<header>
			<?php if ( is_front_page() ) { ?>
			<h2 class="entry-title"><?php the_title(); ?></h2>
			<?php } else { ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php } ?>
		</header>
	
		<section class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mav' ), 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
		</section><!-- /end .entry-content -->
	
	</article><!-- /end #post-## -->
	
	<?php comments_template( '', true ); ?>
	
	<?php endwhile; // end of the loop. ?>
	
</section><!-- /end #content -->

<?php get_sidebar('page'); ?>

<?php get_footer(); ?>
