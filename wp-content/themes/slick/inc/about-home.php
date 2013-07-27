<?php
$about_title = stripslashes(get_option('of_about_title'));
$about_content = stripslashes(get_option('of_about_content'));
$about_img = stripslashes(get_option('of_about_img'));
$about_page_id = get_option('of_about_page_id');
?>
<aside id="about-home">
	<?php if ($about_title) { ?><h3><?php echo $about_title; ?></h3><?php } ?>

	<?php if ($about_img) { ?>
	<figure>
		<?php if ($about_page_id) { ?>
		<a href="<?php echo home_url( '/' ); ?>?page_id=<?php echo $about_page_id ?>"><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $about_img ?>"></a>
		<?php } else { ?>
		<img class="attachment-post-thumbnail wp-post-image" src="<?php echo $about_img ?>">
		<?php } ?>
	</figure>
	<?php } ?>

	<?php if ($about_content) { ?><p><?php echo $about_content; ?></p><?php } ?>
	<?php if ($about_page_id) { ?><a class="more-link" href="<?php echo home_url( '/' ); ?>?page_id=<?php echo $about_page_id ?>">Continue Reading</a><?php } ?>

</aside><!-- /end #about-home -->