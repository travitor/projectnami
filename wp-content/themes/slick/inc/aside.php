<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">

		<hgroup>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mav' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php /* <h3 class="entry-format"><?php _e( 'Aside', 'mav' ); ?></h3> */ ?>
		</hgroup>

		<?php /* if ( comments_open() && ! post_password_required() ) : ?>
		<div class="comments-link">
			<?php comments_popup_link( '<span class="leave-reply">' . __( 'Reply', 'mav' ) . '</span>', _x( '1', 'comments number', 'mav' ), _x( '%', 'comments number', 'mav' ) ); ?>
		</div>
		<?php endif; */ ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<?php else : ?>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav"></span>', 'mav' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mav' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php mav_posted_on(); ?>
		<?php if ( comments_open() ) : ?>
		<span class="sep"> / </span>
		<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'mav' ) . '</span>', __( '<b>1</b> Reply', 'mav' ), __( '<b>%</b> Replies', 'mav' ) ); ?></span>
		<?php endif; ?>
		<?php edit_post_link( __( 'Edit', 'mav' ), '<span class="sep">/</span> <span class="edit-link">', '</span>' ); ?>

	</footer><!-- #entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->
