<?php

/*
	LATEST WORK WIDGET

	----------------------------------------------------------------------------------- */


	// Widget class
	class of_latest_work_widget extends WP_Widget {


/*
	Widget Setup
	----------------------------------------------------------------------------------- */

	function of_Latest_Work_Widget() {

		// Widget settings
		$widget_ops = array(
			'classname' => 'of_latest_work_widget',
			'description' => __('Your latest work, everywhere!', 'of_latest_work_widget')
		);

		// Widget control settings
		/*$control_ops = array(
			'width' => 240,
			'height' => 350,
			'id_base' => 'of_latest_work_widget'
		);*/

		// Create the widget
//		$this->WP_Widget( 'of_latest_work_widget', __('# Latest Work', 'of_latest_work_widget'), $widget_ops, $control_ops ); // Only if $control_ops uncommented.
		$this->WP_Widget( 'of_latest_work_widget', __('# Recent Work', 'of_latest_work_widget'), $widget_ops );

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

		$showposts = $instance['showposts'];
		$category_name = $instance['category_name'];

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

		?>


		<?php // PORTFOLIO ITEM STARTS HERE ?>
		
		<?php the_post(); // Needed to retrieve the page content ?>

		<?php // START PORTFOLIO LOOP
		$query = new WP_Query();
		$query->query( array('post_type'=>'portfolio', 'posts_per_page'=>$showposts, 'orderby' => 'date' ) );
		while ($query->have_posts()) : $query->the_post();
		$terms = get_the_terms( get_the_ID(), 'portfolio_category' );
		$terms = $terms == false ? array() : $terms;
		?>

		<?php
		$custom = get_post_custom(@$post->ID);
		$portfolio_permalink = $custom["portfolio_permalink"][0];
		$portfolio_desc = $custom["portfolio_desc"][0];
		$lightbox_path = $custom["lightbox_path"][0];
		?>

		<ul>
			<li class="item" data-id="id-<?php echo($query->current_post + 1); ?>" data-type="<?php foreach ($terms as $term) { echo strtolower(preg_replace('/\s+/', '-', $term->name)). ' '; } ?>all">
					
					<figure>
						<?php if ( has_post_thumbnail() ) { ?>
	
						<?php if ($portfolio_permalink) { ?>
						<a href="<?php echo $portfolio_permalink ?>" rel="bookmark">
							<?php the_post_thumbnail(); ?>
						</a>
						<?php } elseif ($lightbox_path) { ?>
						<div class="lightbox-yes">
							<a href="<?php echo $lightbox_path ?>" data-rel="prettyPhoto" title="<?php the_title_attribute();  ?>">
								<?php /* <span class="overlay"></span> */ /* hide because of mobile layout - float:left; */ ?>
								<?php the_post_thumbnail(); ?>
							</a>
						</div>
						<?php } else { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark">
							<?php the_post_thumbnail(); ?>
						</a>
						<?php } ?>
						<?php } else { ?>
						<img class="attachment-post-thumbnail wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/thumb-ph.jpg" alt="<?php the_title_attribute(); ?>" />
				
						<?php } /* if has_post_thumbnail */ ?>
					</figure>
					
					<h3 class="item-title">
						<?php if ($portfolio_permalink) { ?>
						<a href="<?php echo $portfolio_permalink ?>" rel="bookmark" title=""><?php the_title(); ?></a>
						<?php } else { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" title=""><?php the_title(); ?></a>
						<?php } ?>
					</h3>

					<?php
					// $portfolio_categories = wp_get_object_terms(@$post->ID, 'portfolio_category');
					$portfolio_categories = get_the_terms( @$post->ID, 'portfolio_category' ); // This is slightly different from portfolio.php

					if ($portfolio_categories) {
					echo '<p class="portfolio_categories">';
						$portfolio_category = array();
						foreach($portfolio_categories as $category) {
							$portfolio_category[] = '<a href="'.get_home_url().'/?portfolio_category=' . $category->slug . '">' . $category->name . '</a>';
						}
						echo implode(' / ', $portfolio_category);
						echo '</p>';
					}
					?>

					<?php if ($portfolio_desc) { ?>
					<p><?php
						$getlength = strlen($portfolio_desc);
						$thelength = 91;
						echo substr($portfolio_desc, 0, $thelength);
						if ($getlength > $thelength) echo "...";
					?></p>
					<?php } else {
/* 						echo '<br/>'; */
					} ?>

					<a class="more-link" href="<?php the_permalink() ?>">Continue Reading</a>

			</li>

		</ul>

		<?php endwhile; ?>

		<?php wp_reset_query(); ?>

		<?php
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
			'title' => 'Recent Work',
			'category_name' => @$category_name,
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

			<?php /*
			<!-- Category Name -->
			<p style="margin-bottom:3px;"><strong>Category Name</strong></p>
			<p>
				<select id="<?php echo $this->get_field_id( 'category_name' ); ?>" name="<?php echo $this->get_field_name( 'category_name' ); ?>" class="widefat" style="width:100%;">
					<option <?php if ( !$instance['category_name'] ) echo ' selected="selected"'; ?> value=""></option>
					<?php $cats = get_categories( array('taxonomy' => 'portfolio_categories') );?>
					<?php foreach ( $cats as $cat ) : ?>
						<option <?php if ( $cat->slug == $instance['category_name'] ) echo 'selected="selected"'; ?>><?php echo $cat->slug; ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			*/ ?>

			<!-- Showposts -->
			<p style="margin-bottom:3px;"><strong>Number of Posts</strong></p>
			<p><input class="widefat" id="<?php echo $this->get_field_id( 'showposts' ); ?>" name="<?php echo $this->get_field_name( 'showposts' ); ?>" value="<?php echo $instance['showposts']; ?>" /></p>

		</div>

		<div style="clear:both;">&nbsp;</div>

		<?php
		}
	}
?>
