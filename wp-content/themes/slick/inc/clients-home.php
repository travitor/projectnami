<?php
$clients_title = stripslashes(get_option('of_clients_title'));
$clients_desc = stripslashes(get_option('of_clients_desc'));

$client1 = stripslashes(get_option('of_client1'));
$client2 = stripslashes(get_option('of_client2'));
$client3 = stripslashes(get_option('of_client3'));
$client4 = stripslashes(get_option('of_client4'));
$client5 = stripslashes(get_option('of_client5'));
$client6 = stripslashes(get_option('of_client6'));
$client7 = stripslashes(get_option('of_client7'));
$client8 = stripslashes(get_option('of_client8'));
?>

<aside id="clients-home">
	
	<?php if ($clients_title) { ?><h2><?php echo $clients_title; ?></h2><?php } ?>
	
	<?php if ($clients_desc) { ?><p><?php echo $clients_desc; ?></p><?php } ?>
	<section class="clients-list">
		<?php if ($client1) { ?><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $client1 ?>"><?php } ?>
		<?php if ($client2) { ?><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $client2 ?>"><?php } ?>
		<?php if ($client3) { ?><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $client3 ?>"><?php } ?>
		<?php if ($client4) { ?><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $client4 ?>"><?php } ?>
		<?php if ($client5) { ?><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $client5 ?>"><?php } ?>
		<?php if ($client6) { ?><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $client6 ?>"><?php } ?>
		<?php if ($client7) { ?><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $client7 ?>"><?php } ?>
		<?php if ($client8) { ?><img class="attachment-post-thumbnail wp-post-image" src="<?php echo $client8 ?>"><?php } ?>
	</section>
</aside><!-- /end #clients-home -->