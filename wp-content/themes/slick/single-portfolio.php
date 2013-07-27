<?php get_header(); ?>

<section id="content" class="portfolio" role="main">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php
	$portfolio_page_id = get_option('of_portfolio_page_id');

	$custom = get_post_custom($post->ID);

	$client_name = $custom["client_name"][0];
	$client_name_link = $custom["client_name_link"][0];
	$portfolio_desc = $custom["portfolio_desc"][0];
	$project_img_url = $custom["project_img_url"][0];
	$project_vimeo_id = $custom["project_vimeo_id"][0];
	$project_youtube_id = $custom["project_youtube_id"][0];
	$project_link = $custom["project_link"][0];
	$project_link_text = $custom["project_link_text"][0];
	$techs1 = $custom["techs1"][0];
	$techs2 = $custom["techs2"][0];
	$techs3 = $custom["techs3"][0];
	$techs4 = $custom["techs4"][0];
	$techs5 = $custom["techs5"][0];
	$techs6 = $custom["techs6"][0];
	?>

	<div id="nav-above" class="navigation">
		<div class="nav-previous portfolio-back">
			<?php if( get_option('of_portfolio_page_id') ){ ?>
			<a class="back" href="<?php echo home_url( '/' ); ?>?page_id=<?php echo $portfolio_page_id ?>"><span class="meta-nav"></span>Back to Portfolio</a>
			<?php } else { ?>
			<a class="back" href="javascript:javascript:history.go(-1)"><span class="meta-nav"></span> Back to Portfolio</a>
			<?php } ?>
		</div>

		<p class="portfolio_categories">
		<?php
		$portfolio_categories = wp_get_object_terms(@$post->ID, 'portfolio_category');
		if ($portfolio_categories) {
				$portfolio_category = array();
				foreach($portfolio_categories as $category) {
/* 					$portfolio_category[] = '<a href="?portfolio_category=' . $category->slug . '">' . $category->name . '</a>'; */
					$portfolio_category[] = '<a href="'.get_home_url().'/?portfolio_category=' . $category->slug . '">' . $category->name . '</a>';
				}
				echo implode(' / ', $portfolio_category);
		}
		?>
		</p><!-- /end .portfolio_categories -->

	</div>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<header id="project_intro">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php if ($portfolio_desc) { ?><p class="portfolio-description"><?php echo $portfolio_desc ?></p><?php } ?>
		</header>

		<?php if ($project_vimeo_id) { ?>
		<section class="videoWrapper">
			<iframe src="http://player.vimeo.com/video/<?php echo $project_vimeo_id ?>"></iframe>
		</section>
		<?php } ?>
		
		<?php if ($project_youtube_id) { ?>
		<section class="videoWrapper">
			<iframe src="http://www.youtube.com/embed/<?php echo $project_youtube_id ?>"></iframe>
		</section>
		<?php } ?>

		<?php if ($project_img_url) { ?><img class="img_head_portfolio" src="<?php echo $project_img_url ?>" height="auto"><?php } ?>

		<section class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mav' ), 'after' => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'mav' ), '<span class="edit-link">', '</span>' ); ?>
		</section><!-- /end .entry-content -->


		<section id="portfolio-details">
			
			<section class="details">
				<?php if ($project_link_text) { ?>
				<a class="project-link" href="<?php echo $project_link ?>" target="_blank"><?php echo $project_link_text ?></a>
				<?php } ?>
	
				<?php if ($client_name) { ?>
				<p class="client-name">
					<span>Client</span>
					<?php if ($client_name_link) { ?>
					<a href="<?php echo $client_name_link ?>" target="_blank"><?php echo $client_name ?></a>
					<?php } else { ?>
					<?php echo $client_name ?>
					<?php } ?>
				</p>
				<?php } ?>
	
				<p class="release-date">
					<span>Release Date</span>
					<?php the_time('F d, Y') ?>
				</p>
	
				<section class="techs">
					<?php if ($techs1) { ?>
					<span>Technology</span>
					<ul>
						<?php if ($techs1) { ?><li><span class="techs_color"><?php echo $techs1 ?></span></li><?php } ?>
						<?php if ($techs2) { ?><li><span class="techs_color"><?php echo $techs2 ?></span></li><?php } ?>
						<?php if ($techs3) { ?><li><span class="techs_color"><?php echo $techs3 ?></span></li><?php } ?>
						<?php if ($techs4) { ?><li><span class="techs_color"><?php echo $techs4 ?></span></li><?php } ?>
						<?php if ($techs5) { ?><li><span class="techs_color"><?php echo $techs5 ?></span></li><?php } ?>
						<?php if ($techs6) { ?><li><span class="techs_color"><?php echo $techs6 ?></span></li><?php } ?>
					</ul>
					<?php } ?>
				</section><!-- /end .techs -->
			</section>

			<?php if( get_option('of_similar_projects') == 'true') {
				get_template_part('/inc/similar-projects');
			} ?>

		</section><!-- /end #portfolio-details -->

		<?php
		$portfolio_tags = wp_get_object_terms(@$post->ID, 'portfolio_tag');
	
		if ($portfolio_tags) {
			$portfolio_tag = array();
			foreach($portfolio_tags as $tag) {
				$portfolio_tag[] = '<a href="'.get_home_url().'/?portfolio_tag=' . $tag->slug . '">' . $tag->name . '</a>';
			} ?>
		<footer class="portfolio_tags">
			<span><?php echo implode(' ', $portfolio_tag); ?></span>
		</footer>
		<?php } ?>

	</article><!-- /end #post-## -->

	<div id="nav-below" class="navigation">
		<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '', 'Previous post link', 'mav' ) . '</span> %title' ); ?></div>
		<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '', 'Next post link', 'mav' ) . '</span>' ); ?></div>
	</div>
		
	<?php comments_template( '', true ); ?>
		
	<?php endwhile; // end of the loop. ?>
			
</section><!-- /end #content -->

<?php /* get_sidebar('portfolio'); */ ?>

<?php get_footer(); ?>
