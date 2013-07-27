<?php get_header(); ?>

<section id="content" role="main">
	
	
	<?php while ( have_posts() ) : the_post(); ?>
	
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'mav' ) . '</span> %title' ); ?></div>
		<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'mav' ) . '</span>' ); ?></div>
	</div>
	
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
			<?php if ( has_post_format( 'link' )) {
			$meta = get_post_meta( get_the_ID(), 'mav_link', true ); ?>
			<a href="<?php echo $meta; ?> "><span class="link">&ndash; <?php echo $meta; ?></span></a>
			<?php } ?>
	
			<?php
			if ( has_post_format( 'quote' )) {
			$meta = get_post_meta( get_the_ID(), 'mav_quote', true ); ?>
			<h2 class="entry-title"><?php echo $meta; ?></h2>
			<?php } ?>
	
			
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php mav_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
		
			<?php if ( has_post_format( 'video' )) {
				$meta_vimeo = get_post_meta( get_the_ID(), 'mav_video_vimeo', true );
				$meta_youtube = get_post_meta( get_the_ID(), 'mav_video_youtube', true );
		    ?>
	
	    	<?php if ($meta_vimeo) { ?>
	    	<section class="videoWrapper">
	    		<iframe src="http://player.vimeo.com/video/<?php echo $meta_vimeo; ?>"></iframe>
	    	</section>
	    	<?php } ?>
	
	    	<?php if ($meta_youtube) { ?>
	    	<section class="videoWrapper">
	        	<iframe src="http://www.youtube.com/embed/<?php echo $meta_youtube; ?>"></iframe>
	        </section>
	        <?php }
			} ?>
	
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mav' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	
		<footer class="entry-meta">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'mav' ) );
	
				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'mav' ) );
				if ( '' != $tag_list ) {
					$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'mav' );
				} elseif ( '' != $categories_list ) {
					$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'mav' );
				} else {
					$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'mav' );
				}
	
				printf(
					$utility_text,
					$categories_list,
					$tag_list,
					esc_url( get_permalink() ),
					the_title_attribute( 'echo=0' ),
					get_the_author(),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
				);
			?>
			<?php edit_post_link( __( 'Edit', 'mav' ), '<span class="sep">/</span> <span class="edit-link">', '</span>' ); ?>
	
			<?php if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries ?>
			<div id="author-info">
				<div id="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'mav_author_bio_avatar_size', 68 ) ); ?>
				</div><!-- #author-avatar -->
				<div id="author-description">
					<h2><?php printf( __( 'About %s', 'mav' ), get_the_author() ); ?></h2>
					<?php the_author_meta( 'description' ); ?>
					<div id="author-link">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
							<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'mav' ), get_the_author() ); ?>
						</a>
					</div><!-- #author-link	-->
				</div><!-- #author-description -->
			</div><!-- #author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
	
	
	<?php if( get_option('of_related_posts') == 'true') {
		get_template_part('/inc/related-posts');
	} ?>
	
	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'mav' ) . '</span> %title' ); ?></div>
		<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'mav' ) . '</span>' ); ?></div>
	</div>
	
	<?php comments_template( '', true ); ?>
	
	<?php endwhile; // end of the loop. ?>


</section><!-- /end #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
