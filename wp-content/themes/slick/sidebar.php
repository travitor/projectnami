<aside id="primary" class="widget-area" role="complementary">

	<ul class="xoxo">
	<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

		<li id="search" class="widget-container widget_search">
			<?php get_search_form(); ?>
		</li>

		<li id="archives" class="widget-container widget_archive">
			<h3 class="widget-title"><?php _e( 'Archives', 'mav' ); ?></h3>
			<ul>
				<?php wp_get_archives( 'type=monthly' ); ?>
			</ul>
		</li>

		<li id="categories" class="widget-container widget_categories">
			<h3 class="widget-title"><?php _e( 'Categories', 'mav' ); ?></h3>
			<ul>
				<?php wp_list_categories( 'title_li=' ); ?>
			</ul>
		</li>

	<?php endif; // end primary widget area ?>
	</ul>

</aside><!-- /end #primary -->


<?php if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

<aside id="secondary" class="widget-area" role="complementary">
	<ul class="xoxo">
		<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
	</ul>
</aside><!-- /end #secondary -->

<?php endif; ?>
