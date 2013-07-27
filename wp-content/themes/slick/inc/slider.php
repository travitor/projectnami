<?php
	$slider_height = get_option('of_slider_height');
	$slider_title = get_option('of_slider_title');
?>
<section id="camera-slider-wrapper">

	<div class="fluid_container">

	    <div id="camera_wrap_1" class="camera_wrap mav_skin">

	    	<?php
				global $slides;

				$slides = array();

				if(get_option('slides')) {
				$slides = get_option('slides');
				} else {
				$slides = false; ?>

				<div data-thumb="<?php echo get_template_directory_uri(); ?>/images/thumb-ph.jpg" data-src="<?php echo get_template_directory_uri(); ?>/admin/slidermanager/slider.jpg"></div>
			<?php }

			if (is_array($slides) && count($slides) > 0) {

				foreach ($slides as $num => $slide) :

					if ($slide['src'] != '') { ?>

					<div data-thumb="<?php echo $slide['src'] ?>" data-src="<?php echo $slide['src'] ?>" data-link="<?php echo $slide['link'] ?>">
						<?php if($slide['caption'] != '') { ?>
						<div class="camera_caption fadeFromBottom">
							<?php echo stripslashes($slide['caption']) ?>
						</div>
						<?php } ?>
					</div>

				<?php } else { ?>

				<div data-thumb="<?php echo get_template_directory_uri(); ?>/images/thumb-ph.jpg" data-src="<?php echo get_template_directory_uri(); ?>/admin/slidermanager/slider.jpg"></div>

			<?php } endforeach;
			
			} // end if(is_array

			?>

		</div><!-- /end #camera_wrap_1 -->

	</div><!-- /end .fluid_container -->

</section><!-- /end #slider-wrapper -->


