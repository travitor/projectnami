<?php if ( $wp_query->max_num_pages > 1 ) : /* display navigation to next/previous pages when applicable */ ?>
<div id="nav-above" class="navigation">
	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Older posts', 'mav' ) ); ?></div>
	<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"></span>', 'mav' ) ); ?></div>
</div>
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
<article id="post-0" class="post error404 not-found">
	<header><h1 class="entry-title"><?php _e( 'Not Found', 'mav' ); ?></h1></header>
	<section class="entry-content">
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mav' ); ?></p>
		<?php get_search_form(); ?>
	</section>
</article><!-- /end #post-## -->
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); /* start the loop */ ?>

<?php
/**
 * Post Formats
 */

/* `aside */
if ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'mav' ) )  ) :
include("inc/aside.php");

/* `link */
elseif ( ( function_exists( 'get_post_format' ) && 'link' == get_post_format( $post->ID ) ) || in_category( _x( 'link', 'link category slug', 'mav' ) ) ) :
include("inc/link.php");

/* `gallery */
elseif ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'mav' ) ) ) :
include("inc/gallery.php");

/* `quote  */
elseif ( ( function_exists( 'get_post_format' ) && 'quote' == get_post_format( $post->ID ) ) || in_category( _x( 'quote', 'quote category slug', 'mav' ) )  ) :
include("inc/quote.php");

/* `image */
elseif ( ( function_exists( 'get_post_format' ) && 'image' == get_post_format( $post->ID ) ) || in_category( _x( 'image', 'image category slug', 'mav' ) )  ) :
include("inc/image.php");

/* `video */
elseif ( ( function_exists( 'get_post_format' ) && 'video' == get_post_format( $post->ID ) ) || in_category( _x( 'video', 'video category slug', 'mav' ) )  ) :
include("inc/video.php");

/* `standard */
else : 

include("inc/standard.php");

?>

<?php comments_template( '', true ); ?>

<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>


<?php
	if(function_exists('wp_pagenavi')) {
		wp_pagenavi();
	} else {
?>
<nav id="nav-below" class="navigation">
	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"></span> Older posts', 'mav' ) ); ?></div>
	<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"></span>', 'mav' ) ); ?></div>
</nav>
<?php } ?>
