<?php

/* Template Name: Homepage */

get_header(); ?>

<?php if( get_option('of_home_slider') == 'true') {
	include(get_template_directory() .'/inc/slider.php');
} ?>

<?php if( get_option('of_home_msg') == 'true') { ?>
<section id="home-message">
<?php
	$home_msg_title = get_option('of_home_msg_title');
	if ($home_msg_title) { ?>
	<h1><?php echo stripslashes( $home_msg_title ); ?></h1>
	<?php } ?>
	<p><?php echo stripslashes( get_option('of_home_msg_text') ); ?></p>
</section><!-- /end #home-message -->
<?php } ?>

<section id="content" role="main" class="homepage">

	<?php if( get_option('of_portfolio_home') == 'true') { ?>
	<section id="portfolio">
		<?php
		if ($portfolio_home_title = stripslashes(get_option('of_portfolio_home_title'))) {
			echo '<h2>';
			echo stripslashes($portfolio_home_title);
			echo '</h2>';
		}
		?>
		<div id="container">
		<?php
			if( get_option('of_portfolio_home') == 'true') {
				get_template_part('/inc/portfolio-home');
			}
		?>
		</div><!-- /end #container -->
	</section><!-- /end #portfolio -->
	<?php } ?>

	<?php
		if( get_option('of_about_home') == 'true') {
			get_template_part('/inc/about-home');
		}

		if( get_option('of_blog_home') == 'true') {
			get_template_part('/inc/blog-home');
		}

		if( get_option('of_twitter') == 'true') {
			get_template_part('/inc/tweets');
		}

		if( get_option('of_clients_home') == 'true') {
			get_template_part('/inc/clients-home');
		}
	?>

</section><!-- /end #content .homepage -->


<script type="text/javascript">

	/*  CAMERA SLIDER
	------------------------------------------------------------------------------- */
	
	<?php
		$slider_effect = get_option('of_slider_effect');
		$slider_thumbnails = get_option('of_slider_thumbnails');
		$slider_pagination = get_option('of_slider_pagination');
		$slider_time = get_option('of_slider_time');
		$slider_transPeriod = get_option('of_slider_transPeriod');
		$slider_hover = get_option('of_slider_hover');
		$slider_playPause = get_option('of_slider_playPause');
	?>
	
	jQuery(function() {

		jQuery('#camera_wrap_1').camera({
			fx: '<?php if( get_option("of_slider_effect") ) { echo $slider_effect; } else { echo "random"; } ?>',
			height: '<?php echo $slider_height ?>',
			pagination: <?php echo $slider_pagination ?>,
			thumbnails: <?php echo $slider_thumbnails ?>,
			/* imagePath: 'images/', */	// the path to the image folder (it serves for the blank.gif, when you want to display videos)
			/* minHeight: '200px', */
			time: <?php echo $slider_time ?>,
			transPeriod: <?php echo $slider_transPeriod ?>,
			hover: <?php echo $slider_hover ?>,
			/* playPause: <?php echo $slider_playPause ?>, */
			playPause: false,
			loader: 'pie',	// pie, bar, none (even if you choose "pie", old browsers like IE8- can't display it... they will display always a loading bar)
			loaderColor: '#fff',
			loaderBgColor: 'transparent',
			/* loaderPadding: 2, */
			/* loaderStroke: 7, */
			loaderOpacity: .8
		});

	});

</script>

<?php get_footer(); ?>
