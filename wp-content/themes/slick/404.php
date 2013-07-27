<?php get_header(); ?>

<section id="content" role="main">

	<article id="post-0" class="post error404 not-found">

		<header>
			<h1 class="page-title"><?php _e( '404 - Not Found', 'mav' ); ?></h1>
		</header>

		<section class="entry-content">
			<p><?php _e( 'Apologies, but the page you requested could not be found.', 'mav' ); ?></p>
			<ul style="list-style:none;margin-left:0">
				<li style="margin-bottom:50px">
					<?php get_search_form(); ?>
				</li>
			</ul>
		</section><!-- /end .entry-content -->

	</article><!-- /end #post-## -->

</section><!-- /end #content -->

<script type="text/javascript">
	// focus on search field after it has loaded
	document.getElementById('s') && document.getElementById('s').focus();
</script>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
