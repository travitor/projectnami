<?php get_header(); ?>

<section id="content" role="main">
		
	<?php
	if ($blog_page_title = stripslashes(get_option('of_blog_page_title'))) {
	echo '<header id="page-intro">';
		echo '<h1 class="page-title">';
		echo stripslashes($blog_page_title);
		echo '</h1>';
		} ?>

		<?php
		if ($blog_intro = stripslashes(get_option('of_blog_intro'))) {
		echo '<p>';
		echo $blog_intro;
		echo '</p>';
	echo '</header><!-- /end #page-intro -->';
	} ?>

	<?php get_search_form(); ?>

	<?php
		/* Run the loop to output the posts */
		get_template_part( 'loop', 'index' );
	?>

</section><!-- /end #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
