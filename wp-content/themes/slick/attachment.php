<?php get_header(); ?>

<section id="content" class="one-column" role="main">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	<?php if ( ! empty( $post->post_parent ) ) : ?>
	<p class="page-title"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr( printf( __( 'Return to %s', 'mav' ), get_the_title( $post->post_parent ) ) ); ?>" rel="gallery"><?php
	/* translators: %s - title of parent post */
	printf( __( '%s', 'mav' ), get_the_title( $post->post_parent ) );
	?></a></p>
	<?php endif; ?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header>
			<h2 class="entry-title"><?php the_title(); ?></h2>
		</header>
	
		<section class="entry-meta">
			<?php
				printf( __( '<span class="%1$s">Published by</span> %2$s', 'mav' ),
					'meta-prep meta-prep-author',
					sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
					get_author_posts_url( get_the_author_meta( 'ID' ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'mav' ), get_the_author() ) ),
						get_the_author()
					)
				);
			?>
			<span class="meta-sep">/</span>
			<?php
				printf( __( '<span class="%1$s"></span> %2$s', 'mav' ),
					'meta-prep meta-prep-entry-date',
					sprintf( '<span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span>',
					esc_attr( get_the_time() ),
						get_the_date()
					)
				);
				if ( wp_attachment_is_image() ) {
					echo ' <span class="meta-sep">/</span> ';
						$metadata = wp_get_attachment_metadata();
						printf( __( 'Full size is %s pixels', 'mav' ),
						sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
						wp_get_attachment_url(),
						esc_attr( __( 'Link to full-size image', 'mav' ) ),
							$metadata['width'],
							$metadata['height']
						)
					);
				}
			?>
		</section><!-- /end .entry-meta -->
	
		<section class="entry-content">
	
			<div class="entry-attachment">
				<?php if ( wp_attachment_is_image() ) :
				$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
				foreach ( $attachments as $k => $attachment ) {
					if ( $attachment->ID == $post->ID )
						break;
				}
				$k++;
				// If there is more than 1 image attachment in a gallery
				if ( count( $attachments ) > 1 ) {
					if ( isset( $attachments[ $k ] ) )
						// get the URL of the next image attachment
					$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
					else
					// or get the URL of the first image attachment
					$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
				} else {
					// or, if there's only 1 image attachment, get the URL of the image
					$next_attachment_url = wp_get_attachment_url();
				}
				?>
				<p class="attachment"><a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
				$attachment_width  = apply_filters( 'mav_attachment_size', 940 );
				$attachment_height = apply_filters( 'mav_attachment_height', 940 );
				echo wp_get_attachment_image( $post->ID, array( $attachment_width, $attachment_height ) ); // filterable image width with, essentially, no limit for image height.
				?></a></p>
	
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_image_link( false ); ?></div>
					<div class="nav-next"><?php next_image_link( false ); ?></div>
				</div>
				<?php else : ?>
				<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
				<?php endif; ?>
			</div>
	
			<div class="entry-caption"><?php if ( !empty( $post->post_excerpt ) ) the_excerpt(); ?></div>
	
			<?php the_content( __( 'Continue reading <span class="meta-nav"></span>', 'mav' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mav' ), 'after' => '</div>' ) ); ?>
	
		</section><!-- /end .entry-content -->
	
	
		<footer class="entry-utility">
			<?php mav_posted_in(); ?>
			<?php edit_post_link( __( 'Edit', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- /end .entry-utility -->
	
	</article><!-- /end #post-## -->
	
	<?php comments_template(); ?>
	
	<?php endwhile; // end of the loop. ?>

</section><!-- /end #content -->

<?php get_footer(); ?>
