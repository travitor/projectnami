<?php

/*
	BLOG POSTS WIDGET

	----------------------------------------------------------------------------------- */


	// Widget class
	class of_blog_posts_widget extends WP_Widget {


/*
	Widget Setup
	----------------------------------------------------------------------------------- */

	function of_Blog_Posts_Widget() {

		// Widget settings
		$widget_ops = array(
			'classname' => 'of_blog_posts_widget',
			'description' => __('Latest blog posts by category', 'of_blog_posts_widget')
		);

		// Widget control settings
		/*$control_ops = array(
			'width' => 240,
			'height' => 350,
			'id_base' => 'of_blog_posts_widget'
		);*/

		// Create the widget
//		$this->WP_Widget( 'of_blog_posts_widget', __('# Blog Posts', 'of_blog_posts_widget'), $widget_ops, $control_ops ); // Only if $control_ops uncommented.
		$this->WP_Widget( 'of_blog_posts_widget', __('# Blog Posts', 'of_blog_posts_widget'), $widget_ops );

	}


/*
	FRONT-END
	Display Widget
	----------------------------------------------------------------------------------- */

	function widget( $args, $instance ) {
		extract( $args );

		// Arguments for the query
		$args = array();

		// Widget title and things not in query arguments
		$title = apply_filters('widget_title', $instance['title'] );
		$display = $instance['display'];

		// Ordering and such
		if ( $instance['showposts'] )
			$args['showposts'] = (int)$instance['showposts'];

		// Category arguments
		if ( $instance['category_name'] )
			$args['category_name'] = $instance['category_name'];

		// Begin display of widget
		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

		query_posts( $args );

		if ( $display == 'ul' || $display == 'ol' ) : ?>

			<<?php echo $display; ?>>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_title( '<li><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">', '</a></li>' ); ?>
			<?php endwhile; endif; ?>
			</<?php echo $display; ?>>

		<?php else: ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); global $post; ?>

				<div <?php post_class(); ?>>

					<?php if ( function_exists( 'get_the_image' ) && $thumbnail )
						get_the_image( array( 'custom_key' => array( 'Thumbnail', 'thumbnail' ), 'default_size' => 'thumbnail' ) ); ?>

					<?php if ( $display == 'the_content' ) : ?>

					<div class="entry-content">
						<?php the_content( __('Continue reading', 'of_blog_posts_widget') . ' ' . the_title( '"', '"', false ) ); ?>
						<?php wp_link_pages( array( 'before' => '<p class="pages">' . __('Pages:', 'of_blog_posts_widget'), 'after' => '</p>' ) ); ?>
					</div>

					<?php else : ?>

					<?php
					// Retrieves the attachment for the lightbox. The image is automatically retrieved from the Media Library.
					$attachment_id = get_post_thumbnail_id($post->ID); // Defines ID for image
					$image_attributes = wp_get_attachment_image_src( $attachment_id ); // returns an array
					?>

					<article>

						<?php if ($image_attributes) { ?>
						<figure>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail(); ?>
							</a>
						</figure>
						<?php } ?>

						<h3 class="item-title">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h3>

						<span class="item_date"><?php the_time('F j, Y'); ?></span>

						<?php the_excerpt(); ?>

					</article>

					<?php endif; ?>

					<?php if ( 'page' != $post->post_type ) : ?>

					<?php endif; ?>

				</div><!-- /end .post-## -->

			<?php endwhile; endif; ?>

		<?php endif;

		echo $after_widget;
	}


/*
	Update Widget
	----------------------------------------------------------------------------------- */

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['display'] = $new_instance['display'];
		$instance['showposts'] = strip_tags( $new_instance['showposts'] );
		$instance['category_name'] = $new_instance['category_name'];

		return $instance;
	}


/*
	Widget Settings (Displays the widget settings controls on the widget panel)
	----------------------------------------------------------------------------------- */

	function form( $instance ) {

		// Set up default widget settings
		$defaults = array(
			'showposts' => '1',
			'title' => 'From the Blog',
			'category_name' => 'uncategorized',
			'display' => 'the_excerpt',
			'post_type' => 'post',
			'post_status' => 'publish',
			'order' => 'DESC',
			'orderby' => 'date',
			'ignore_sticky_posts' => true,
			'wp_reset_query' => true
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="width:218px">

			<!-- Widget Title -->
			<p style="margin-bottom:3px;"><strong>Widget Title</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" /></p>

			<!-- Category Name -->
			<p style="margin-bottom:3px;"><strong>Category Name</strong></p>
			<p>
				<select id="<?php echo $this->get_field_id( 'category_name' ); ?>" name="<?php echo $this->get_field_name( 'category_name' ); ?>" class="widefat" style="width:100%;">
					<option <?php if ( !$instance['category_name'] ) echo ' selected="selected"'; ?> value=""></option>
					<?php $cats = get_categories( array( 'type' => 'post' ) ); ?>
					<?php foreach ( $cats as $cat ) : ?>
						<option <?php if ( $cat->slug == $instance['category_name'] ) echo 'selected="selected"'; ?>><?php echo $cat->slug; ?></option>
					<?php endforeach; ?>
				</select>
			</p>

			<!-- Showposts -->
			<p style="margin-bottom:3px;"><strong>Number of Posts</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" value="<?php echo $instance['showposts']; ?>" /></p>

		</div>

		<div style="clear:both;">&nbsp;</div>

		<?php
		}
	}
?>
