<?php $twitter_username = stripslashes(get_option('of_twitter_username')); ?>
<?php $twitter_count = stripslashes(get_option('of_twitter_count')); ?>
<?php $twitter_title = stripslashes(get_option('of_twitter_title')); ?>
<?php $twitter_textlink = stripslashes(get_option('of_twitter_textlink')); ?>
<script type='text/javascript'>

	jQuery(function($){
		jQuery(".tweet").tweet({
			username: "<?php echo $twitter_username ?>",
			join_text: "auto",
			//avatar_size: 48,
			count: <?php echo $twitter_count ?>,
			auto_join_text_default: "",
			auto_join_text_ed: "",
			auto_join_text_ing: "",
			auto_join_text_reply: "",
			auto_join_text_url: "",
			loading_text: "Loading tweets..."
		});
	});

</script>

<div id="twitter-wrapper">

	<?php if ($twitter_title) { ?><h3><?php echo $twitter_title; ?></h3><?php } ?>

	<section id="twitter_dock" role="contentinfo">

		<div class="tweet"></div>

		<ul id="follow">
			<li><a href="http://twitter.com/<?php echo $twitter_username ?>" id="twitter-link"><?php echo $twitter_textlink ?></a></li>
		</ul>

    </section>

</div><!-- /end #twitter-wrapper -->



