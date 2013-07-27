</div><!-- MAIN ENDS -->

<section id="footer-wrapper">

	<footer id="footer" role="contentinfo">

		<?php //get_sidebar( 'footer' ); ?>

		<section id="site-info">

			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'secondary' ) ); ?>

			<script type="text/javascript">
				jQuery('#site-info .menu-header ul').prepend('<li><a <?php if (is_front_page()) : ?>class="home-button-current"<?php else : ?>class="home-button"<?php endif ?> href="<?php echo home_url(); ?>/">Home</a></li>');
				jQuery("#site-info .menu ul li a:first").addClass("<?php if (is_front_page()) : ?>home-button-current<?php else : ?>home-button<?php endif ?>");
			</script>

		</section><!-- /end #site-info -->

		<section id="site-generator">
			<?php if( get_option('of_footer_right') ) {
				echo '<p class="foo-text-right">';
				echo do_shortcode( stripslashes( get_option('of_footer_right') ) );
				echo '</p>';
				}
			?>

			<?php get_template_part('/inc/social-icons'); ?>

		</section><!-- /end #site-generator -->
		
		<?php /* Replace default copyright text if option is up */
			if( get_option('of_footer_left') ) {
				echo '<p class="copyright">';
				echo do_shortcode( stripslashes( get_option('of_footer_left') ) );
				echo '</p>';
			} else {
		?>
		<p class="copyright">&copy; Copyright <?php echo date( 'Y' ); ?> <a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" ><?php bloginfo( 'name' ); ?></a></p> 
		<?php } ?>

	</footer><!-- /end #footer -->

</section><!-- /end #footer-wrapper -->

</div><!-- /end #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
