<?php

/* Template Name: Contact */

get_header(); ?>

<?php
if(isset($_POST['submitted'])) {
if(trim($_POST['contactName']) === '') {
	$nameError = 'Please enter your name.';
	$hasError = true;
} else {
	$name = trim($_POST['contactName']);
}

$phone = trim($_POST['contactPhone']);

$url = trim($_POST['contactURL']);

if(trim($_POST['email']) === '')  {
	$emailError = 'Please enter your email address.';
	$hasError = true;
} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
	$emailError = 'You entered an invalid email address.';
	$hasError = true;
} else {
	$email = trim($_POST['email']);
}

if(trim($_POST['comments']) === '') {
	$commentError = 'Please enter a message.';
	$hasError = true;
} else {
	if(function_exists('stripslashes')) {
		$comments = stripslashes(trim($_POST['comments']));
	} else {
		$comments = trim($_POST['comments']);
	}
}

if(!isset($hasError)) {
	$emailTo = get_option('of_contact_email');
	if (!isset($emailTo) || ($emailTo == '') ){
		$emailTo = get_option('admin_email');
	}

	$website_name = get_bloginfo( 'name' );

	$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
	// $subject = 'From '.$name;
	$subject = 'Message sent via ' .$website_name;
	$body = "$comments \n\n\nName: $name \n\nEmail: $email \n\nPhone: $phone \n\nURL: $url";

	mail($emailTo, $subject, $body, $headers);
	$emailSent = true;
}

} ?>

<?php get_header(); ?>

<?php
$contact_page_desc = get_option('of_contact_page_desc');

$office1 = get_option('of_office1');
$office2 = get_option('of_office2');

$gmap_uri = get_option('of_gmap_uri');
$gmap_uri_o1 = get_option('of_gmap_uri_o1');
$gmap_uri_o2 = get_option('of_gmap_uri_o2');

$address_title1 = get_option('of_address_title1');
$address_title2 = get_option('of_address_title2');

$phone1 = get_option('of_phone1');
$phone2 = get_option('of_phone2');
$phone3 = get_option('of_phone3');

$address1 = get_option('of_address1');
$address2 = get_option('of_address2');
$address3 = get_option('of_address3');

$phone4 = get_option('of_phone4');
$phone5 = get_option('of_phone5');
$phone6 = get_option('of_phone6');
$address4 = get_option('of_address4');
$address5 = get_option('of_address5');
$address6 = get_option('of_address6');

$social_title = get_option('of_social_title');

$social1 = get_option('of_social1');
$social2 = get_option('of_social2');
$social3 = get_option('of_social3');
$social4 = get_option('of_social4');
$social5 = get_option('of_social5');
$social1_link = get_option('of_social1_link');
$social2_link = get_option('of_social2_link');
$social3_link = get_option('of_social3_link');
$social4_link = get_option('of_social4_link');
$social5_link = get_option('of_social5_link');
?>

<section id="content" class="contact" role="main">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	
		<header id="page-intro">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php if ($contact_page_desc) { ?><p><?php echo $contact_page_desc; ?></p><?php } ?>
		</header><!-- /end #page-intro -->
	
		<section class="entry-content">
	
			<?php if ($gmap_uri) { ?>
			<section class="gmap">
				<iframe src="<?php echo $gmap_uri; ?>&amp;spn=0,0&amp;iwloc=&amp;output=embed"></iframe>
			</section>
			<?php } ?>
	
			<?php if( get_option('of_office1') == 'true') { ?>
			<section id="contact-details">
	
				<?php if( get_option('of_office1') == 'true') { ?>
				<section class="office">
	
					<?php if ($address_title1) { ?><h3><?php echo $address_title1; ?></h3><?php } ?>
	
					<ul class="phones">
						<?php if ($phone1) { ?><li><?php echo $phone1; ?></li><?php } ?>
						<?php if ($phone2) { ?><li><?php echo $phone2; ?></li><?php } ?>
						<?php if ($phone3) { ?><li><?php echo $phone3; ?></li><?php } ?>
					</ul><!-- /end .phones -->
	
					<ul class="address">
						<?php if ($address1) { ?><li><?php echo $address1; ?></li><?php } ?>
						<?php if ($address2) { ?><li><?php echo $address2; ?></li><?php } ?>
						<?php if ($address3) { ?><li><?php echo $address3; ?></li><?php } ?>
					</ul><!-- /end .address -->
	
					<?php if ($gmap_uri_o1) { ?><a class="more-link" href="<?php echo $gmap_uri_o1; ?>" target="_blank">Google Map</a><?php } ?>
	
				</section><!-- /end .office -->
				<?php } ?>
	
				<?php if( get_option('of_office2') == 'true') { ?>
				<section class="office">
					<?php if ($address_title2) { ?><h3><?php echo $address_title2; ?></h3><?php } ?>
	
					<ul class="phones">
						<?php if ($phone4) { ?><li><?php echo $phone4; ?></li><?php } ?>
						<?php if ($phone5) { ?><li><?php echo $phone5; ?></li><?php } ?>
						<?php if ($phone6) { ?><li><?php echo $phone6; ?></li><?php } ?>
					</ul><!-- /end .phones -->
	
					<ul class="address">
						<?php if ($address4) { ?><li><?php echo $address4; ?></li><?php } ?>
						<?php if ($address5) { ?><li><?php echo $address5; ?></li><?php } ?>
						<?php if ($address6) { ?><li><?php echo $address6; ?></li><?php } ?>
					</ul><!-- /end .address -->
	
					<?php if ($gmap_uri_o2) { ?><a class="more-link" href="<?php echo $gmap_uri_o2; ?>" target="_blank">Google Map</a><?php } ?>
	
				</section><!-- /end .office -->
				<?php } ?>
	
				<?php if( get_option('of_social') == 'true') { ?>
				<section class="socials">
					<?php if ($social_title) { ?><h3><?php echo $social_title; ?></h3><?php } ?>
					<ul>
						<?php if ($social1) { ?><li><a href="<?php echo $social1_link; ?>" target="_blank"><?php echo $social1; ?></a></li><?php } ?>
						<?php if ($social2) { ?><li><a href="<?php echo $social2_link; ?>" target="_blank"><?php echo $social2; ?></a></li><?php } ?>
						<?php if ($social3) { ?><li><a href="<?php echo $social3_link; ?>" target="_blank"><?php echo $social3; ?></a></li><?php } ?>
						<?php if ($social4) { ?><li><a href="<?php echo $social4_link; ?>" target="_blank"><?php echo $social4; ?></a></li><?php } ?>
						<?php if ($social5) { ?><li><a href="<?php echo $social5_link; ?>" target="_blank"><?php echo $social5; ?></a></li><?php } ?>
					</ul>
				</section><!-- /end .social -->
				<?php } ?>
	
			</section><!-- /end #contact-details  -->
			<?php } ?>
	
			<?php if(isset($emailSent) && $emailSent == true) { ?>
			<div class="thanks">
				<p class="sent-ok">Thank you, your email was successfully sent!</p>
			</div>
			<?php } else { ?>
		
			<?php the_content(); ?>
		
			<?php if(isset($hasError) || isset($captchaError)) { ?>
			<p class="error">Sorry, an error occured.<p>
			<?php } ?>
	
			<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
	
				<ul class="contactform">
					<li>
						<label class="contact-labels" for="contactName">Name</label>
						<input class="contactName required requiredField" type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" />
						<?php
						$nameError = '';
							if($nameError != '') { ?>
							<span class="error"><?php $nameError; ?></span>
						<?php } ?>
					</li>
	
					<li class="email_right">
						<label class="contact-labels" for="email">Email</label>
						<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" />
						<?php
						$emailError = '';
							if($emailError != '') { ?>
							<span class="error"><?php $emailError; ?></span>
						<?php } ?>
					</li>
							
					<li>
						<label class="contact-labels" for="contactPhone">Phone</label>
						<input class="contactPhone" type="text" name="contactPhone" id="contactPhone" value="<?php if(isset($_POST['contactPhone'])) echo $_POST['contactPhone'];?>" />
					</li>
								
					<li class="website_right">
						<label class="contact-labels" for="contactURL">Website</label>
						<input class="contactURL" type="text" name="contactURL" id="contactURL" value="<?php if(isset($_POST['contactURL'])) echo $_POST['contactURL'];?>" />
					</li>
	
					<li>
						<label class="contact-labels" for="commentsText">Message</label>
						<textarea name="comments" id="commentsText" rows="9" cols="30" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
						<?php
						$commentError = '';
							if($commentError != '') { ?>
							<span class="error"><?php $commentError; ?></span>
						<?php } ?>
					</li>
	
					<li>
						<input class="send-button" type="submit" value="Send">
					</li>
				
				</ul><!-- /end .contactform -->
							
				<input type="hidden" name="submitted" id="submitted" value="true" />
					
			</form>
	
			<?php } ?>
	
		</section><!-- /end .entry-content -->
	
		<?php endwhile; endif; ?>

	</div><!-- /end #post-# -->

</section><!-- /end #content -->

<?php get_sidebar('page'); ?>

<?php get_footer(); ?>
