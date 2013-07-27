<?php
	$aol_icon_url = get_option('of_aol_icon');
	$facebook_icon_url = get_option('of_facebook_icon');
	$twitter_icon_url = get_option('of_twitter_icon');
	$linkedin_icon_url = get_option('of_linkedin_icon');
	$delicious_icon_url = get_option('of_delicious_icon');
	$flickr_icon_url = get_option('of_flickr_icon');
	$tumblr_icon_url = get_option('of_tumblr_icon');
	$vimeo_icon_url = get_option('of_vimeo_icon');
	$youtube_icon_url = get_option('of_youtube_icon');
	$deviantart_icon_url = get_option('of_deviantart_icon');
	$digg_icon_url = get_option('of_digg_icon');
	$lastfm_icon_url = get_option('of_lastfm_icon');
	$myspace_icon_url = get_option('of_myspace_icon');
	$netvibes_icon_url = get_option('of_netvibes_icon');
	$newsvine_icon_url = get_option('of_newsvine_icon');
	$reddit_icon_url = get_option('of_reddit_icon');
	$stumbleupon_icon_url = get_option('of_stumbleupon_icon');
	$sharethis_icon_url = get_option('of_sharethis_icon');
	$technorati_icon_url = get_option('of_technorati_icon');
	$yahoo_icon_url = get_option('of_yahoo_icon');
	$yelp_icon_url = get_option('of_yelp_icon');
	$foursquare_icon_url = get_option('of_foursquare_icon');
	$posterous_icon_url = get_option('of_posterous_icon');
	$pinterest_icon_url = get_option('of_pinterest_icon');
	$github_icon_url = get_option('of_github_icon');
	$gplus_icon_url = get_option('of_gplus_icon');
	$dribbble_icon_url = get_option('of_dribbble_icon');
	$envato_icon_url = get_option('of_envato_icon');
	$mav_icon_url = get_option('of_mav_icon');
	
	// Last icons feed
	$feed_icon_yes = get_option('of_feed_icon_yes');
	$feed_icon_url = get_option('of_feed_icon');
?>


<ul class="social_icons">
	
	<?php if ($facebook_icon_url) { ?>
	<li class="facebook_icon">
		<a title="Facebook" href="<?php echo $facebook_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/facebook.png" alt="Facebook">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/facebook_active.png" alt="Facebook"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($twitter_icon_url) { ?>
	<li class="twitter_icon">
		<a title="Twitter" href="<?php echo $twitter_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter.png" alt="Twitter">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/twitter_active.png" alt="Twitter"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($gplus_icon_url) { ?>
	<li class="gplus_icon">
		<a title="Google+" href="<?php echo $gplus_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/google-plus.png" alt="Google">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/google_active.png" alt="Google"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($dribbble_icon_url) { ?>
	<li class="dribbble_icon">
		<a title="Dribbble" href="<?php echo $dribbble_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/dribbble.png" alt="Dribbble">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/dribbble_active.png" alt="Dribbble"> */ ?>
		</a>
	</li><?php } ?>
	
	<?php if ($linkedin_icon_url) { ?>
	<li class="linkedin_icon">
		<a title="LinkedIn" href="<?php echo $linkedin_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/linkedin.png" alt="LinkedIn">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/linkedin_active.png" alt="LinkedIn"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($delicious_icon_url) { ?>
	<li class="delicious_icon">
		<a title="Delicious" href="<?php echo $delicious_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/delicious.png" alt="Delicious">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/delicious_active.png" alt="Delicious"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($flickr_icon_url) { ?>
	<li class="flickr_icon">
		<a title="Flickr" href="<?php echo $flickr_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/flickr.png" alt="Flickr">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/flickr_active.png" alt="Flickr"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($tumblr_icon_url) { ?>
	<li class="tumblr_icon">
		<a title="Tumblr" href="<?php echo $tumblr_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/tumblr.png" alt="Tumblr">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/tumblr_active.png" alt="Tumblr"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($vimeo_icon_url) { ?>
	<li class="vimeo_icon">
		<a title="Vimeo" href="<?php echo $vimeo_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/vimeo.png" alt="Vimeo">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/vimeo_active.png" alt="Vimeo"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($youtube_icon_url) { ?>
	<li class="youtube_icon">
		<a title="YouTube" href="<?php echo $youtube_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/youtube.png" alt="YouTube">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/youtube_active.png" alt="YouTube"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($deviantart_icon_url) { ?>
	<li class="deviantart_icon">
		<a title="deviantART" href="<?php echo $deviantart_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/deviantart.png" alt="deviantART">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/deviantart_active.png" alt="deviantART"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($lastfm_icon_url) { ?>
	<li class="lastfm_icon">
		<a title="Lasf.fm" href="<?php echo $lastfm_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/lastfm.png" alt="Last.fm">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/lastfm_active.png" alt="Last.fm"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($digg_icon_url) { ?>
	<li class="digg_icon">
		<a title="Digg" href="<?php echo $digg_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/digg.png" alt="Digg">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/digg_active.png" alt="Digg"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($stumbleupon_icon_url) { ?>
	<li class="stumbleupon_icon">
		<a title="stumbleupon" href="<?php echo $stumbleupon_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/stumbleupon.png" alt="stumbleupon">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/stumbleupon_active.png" alt="stumbleupon"> */ ?>
		</a>
	</li><?php } ?>
	
	<?php if ($aol_icon_url) { ?>
	<li class="aol_icon">
		<a title="aol" href="<?php echo $aol_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/aol.png" alt="aol">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/aol_active.png" alt="aol"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($myspace_icon_url) { ?>
	<li class="myspace_icon">
		<a title="MySpace" href="<?php echo $myspace_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/myspace.png" alt="MySpace">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/myspace_active.png" alt="MySpace"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($netvibes_icon_url) { ?>
	<li class="netvibes_icon">
		<a title="Netvibes" href="<?php echo $netvibes_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/netvibes.png" alt="Netvibes">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/netvibes_active.png" alt="Netvibes"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($newsvine_icon_url) { ?>
	<li class="newsvine_icon">
		<a title="Newsvine" href="<?php echo $newsvine_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/newsvine.png" alt="Newsvine">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/newsvine_active.png" alt="Newsvine"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($reddit_icon_url) { ?>
	<li class="reddit_icon">
		<a title="Reddit" href="<?php echo $reddit_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/reddit.png" alt="Reddit">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/reddit_active.png" alt="Reddit"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($sharethis_icon_url) { ?>
	<li class="sharethis_icon">
		<a title="ShareThis" href="<?php echo $sharethis_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/sharethis.png" alt="ShareThis">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/sharethis_active.png" alt="ShareThis"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($technorati_icon_url) { ?>
	<li class="technorati_icon">
		<a title="Technorati" href="<?php echo $technorati_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/technorati.png" alt="Technorati">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/technorati_active.png" alt="Technorati"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($yahoo_icon_url) { ?>
	<li class="yahoo_icon">
		<a title="Yahoo" href="<?php echo $yahoo_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/yahoo.png" alt="Yahoo">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/yahoo_active.png" alt="Yahoo"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($yelp_icon_url) { ?>
	<li class="yelp_icon">
		<a title="Yelp" href="<?php echo $yelp_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/yelp.png" alt="Yelp">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/yelp_active.png" alt="Yelp"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($foursquare_icon_url) { ?>
	<li class="foursquare_icon">
		<a title="Foursquare" href="<?php echo $foursquare_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/foursquare.png" alt="Foursquare">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/foursquare_active.png" alt="Foursquare"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($posterous_icon_url) { ?>
	<li class="posterous_icon">
		<a title="Posterous" href="<?php echo $posterous_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/posterous.png" alt="Posterous">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/posterous_active.png" alt="Posterous"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($pinterest_icon_url) { ?>
	<li class="pinterest_icon">
		<a title="Pinterest" href="<?php echo $pinterest_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/pinterest.png" alt="Pinterest">
		</a>
	</li><?php } ?>

	<?php if ($github_icon_url) { ?>
	<li class="github_icon">
		<a title="GitHub" href="<?php echo $github_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/github.png" alt="GitHub">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/github_active.png" alt="GitHub"> */ ?>
		</a>
	</li><?php } ?>

	<?php if ($envato_icon_url) { ?>
	<li class="envato_icon">
		<a title="Envato" href="<?php echo $envato_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/envato.png" alt="Envato">
		</a>
	</li><?php } ?>
	
	<?php if ($mav_icon_url) { ?>
	<li class="mav_icon">
		<a title="MattiaViviani.com" href="<?php echo $mav_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/mav.png" alt="MattiaViviani.com">
		</a>
	</li><?php } ?>

	<?php if ($feed_icon_yes == "true" && $feed_icon_url) { ?>
	<li class="feed_icon">
		<a title="Feed" href="<?php echo $feed_icon_url ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/rss.png" alt="Feed">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/rss_active.png" alt="Feed"> */ ?>
		</a>
	</li>
	<?php } elseif ($feed_icon_yes == "true") { ?>
	<li class="feed_icon">
		<a title="Feed" href="<?php bloginfo('rss_url'); ?>">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/images/icons/rss.png" alt="Feed">
			<?php /* <img class="icon_active" src="<?php echo get_template_directory_uri(); ?>/images/icons/rss_active.png" alt="Feed"> */ ?>
		</a>
	</li>
	<?php } else { ?>
	<?php // No icon to display  ?>
	<?php } ?>


</ul><!-- /end .social_icons -->

