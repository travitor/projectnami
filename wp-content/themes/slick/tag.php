<?php get_header(); ?>

<section id="content" role="main">

	<header>
		<h1 class="page-title"><?php printf( __( 'Tag Archives %s', 'mav' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
	</header>

	<?php
	$tag_description = tag_description();
	if ( ! empty( $tag_description ) )
	echo '<div class="archive-meta">' . $tag_description . '</div>';

	get_template_part( 'loop', 'tag' );

	?>

</section><!-- /end #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
