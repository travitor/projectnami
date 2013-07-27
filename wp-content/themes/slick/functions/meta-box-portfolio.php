<?php

/* `Portfolio Meta box
----------------------------------------------------------------------------------- */

// Adding the Meta Box
add_action( 'add_meta_boxes', 'cd_meta_box_add' );

	function cd_meta_box_add() {
		add_meta_box( 'my-meta-box-id', 'Portfolio Options', 'cd_meta_box_cb', 'portfolio', 'normal', 'high' );
	}

	// Rendering the Meta Box
	function cd_meta_box_cb( $post ) {

		$values = get_post_custom( $post->ID );

		$client_name = isset( $values['client_name'] ) ? esc_attr( $values['client_name'][0] ) : '';
		$client_name_link = isset( $values['client_name_link'] ) ? esc_attr( $values['client_name_link'][0] ) : '';
		$portfolio_desc = isset( $values['portfolio_desc'] ) ? esc_attr( $values['portfolio_desc'][0] ) : '';
		$project_img_url = isset( $values['project_img_url'] ) ? esc_attr( $values['project_img_url'][0] ) : '';
		$project_vimeo_id = isset( $values['project_vimeo_id'] ) ? esc_attr( $values['project_vimeo_id'][0] ) : '';
		$project_youtube_id = isset( $values['project_youtube_id'] ) ? esc_attr( $values['project_youtube_id'][0] ) : '';
		$project_link_text = isset( $values['project_link_text'] ) ? esc_attr( $values['project_link_text'][0] ) : '';
		$project_link = isset( $values['project_link'] ) ? esc_attr( $values['project_link'][0] ) : '';
		$lightbox_path = isset( $values['lightbox_path'] ) ? esc_attr( $values['lightbox_path'][0] ) : '';
		$techs1 = isset( $values['techs1'] ) ? esc_attr( $values['techs1'][0] ) : '';
		$techs2 = isset( $values['techs2'] ) ? esc_attr( $values['techs2'][0] ) : '';
		$techs3 = isset( $values['techs3'] ) ? esc_attr( $values['techs3'][0] ) : '';
		$techs4 = isset( $values['techs4'] ) ? esc_attr( $values['techs4'][0] ) : '';
		$techs5 = isset( $values['techs5'] ) ? esc_attr( $values['techs5'][0] ) : '';
		$techs6 = isset( $values['techs6'] ) ? esc_attr( $values['techs6'][0] ) : '';		
		$portfolio_permalink = isset( $values['portfolio_permalink'] ) ? esc_attr( $values['portfolio_permalink'][0] ) : '';
	
		wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	
	<p style="margin-top:15px">
		<label for="portfolio_desc"><strong>Description</strong></label><br/>
		<textarea style="width:98%;margin:6px 0 3px 0" name="portfolio_desc" id="portfolio_desc" type="text" rows="3" cols=""><?php echo $portfolio_desc; ?></textarea>
		<label><span style="color:#808995;margin-bottom:25px;display:block">Write the portfolio description in this field</span></label>
	</p>

	<p>
		<label><strong>Project image URL</strong></label><br/>
		<input style="width:98%;margin:6px 0 5px 0" type="text" name="project_img_url" id="project_img_url" value="<?php echo $project_img_url; ?>" />
		<label><span style="color:#808995;margin-top:3px;margin-bottom:25px;display:block">Enter the image path URL (eg: http://yourdomain.com/image.jpg)</span></label>
	</p>
	
	<p>
		<label><strong>Vimeo Video ID</strong></label><br/>
		<input style="width:98%;margin:6px 0 5px 0" type="text" name="project_vimeo_id" id="project_vimeo_id" value="<?php echo $project_vimeo_id; ?>" />
		<label><span style="color:#808995;margin-top:3px;margin-bottom:25px;display:block">Enter the Vimeo video ID (eg: 23534361)</span></label>
	</p>
	
	<p>
		<label><strong>YouTube Video ID</strong></label><br/>
		<input style="width:98%;margin:6px 0 5px 0" type="text" name="project_youtube_id" id="project_youtube_id" value="<?php echo $project_youtube_id; ?>" />
		<label><span style="color:#808995;margin-top:3px;margin-bottom:25px;display:block">Enter the YouTube video ID (eg: UX7GycmeQVo)</span></label>
	</p>

	<p>
		<label for="project_link_text"><strong>Project Link Text</strong></label><br/>
		<input style="width:98%;margin:6px 0 5px 0" type="text" name="project_link_text" id="project_link_text" value="<?php echo $project_link_text; ?>" />
		<label><span style="color:#808995;margin-top:3px;margin-bottom:25px;display:block">Enter the project link button text</span></label>
	</p>

	<p>
		<label for="project_link"><strong>Project Link URL</strong></label><br/>
		<input style="width:98%;margin:6px 0 5px 0" type="text" name="project_link" id="project_link" value="<?php echo $project_link; ?>" />
		<label><span style="color:#808995;margin-top:3px;margin-bottom:25px;display:block">Enter the URL you wish to link your project to</span></label>
	</p>

	<p>
		<label for="client_name"><strong>Client</strong></label><br/>
		<input style="width:98%;margin:6px 0 5px 0" type="text" name="client_name" id="client_name" value="<?php echo $client_name; ?>" />
		<label><span style="color:#808995;margin-top:3px;margin-bottom:25px;display:block">Your Client Name</span></label>
	</p>
	
	<p>
		<label for="client_name_link"><strong>Client Link URL</strong></label><br/>
		<input style="width:98%;margin:6px 0 5px 0" type="text" name="client_name_link" id="client_name_link" value="<?php echo $client_name_link; ?>" />
		<label><span style="color:#808995;margin-top:3px;margin-bottom:25px;display:block">Enter the Client Link URL</span></label>
	</p>

	<p>
		<label for="techs"><strong>Technology</strong></label><br/>
		<label><span style="color:#808995;margin-top:5px;margin-bottom:3px;display:block">Enter the Technology used in the Project</span></label>
		<input style="width:49%;margin:6px 0 3px 0" type="text" name="techs1" id="techs1" value="<?php echo $techs1; ?>" />
		<input style="width:49%;margin:6px 0 3px 0" type="text" name="techs2" id="techs2" value="<?php echo $techs2; ?>" />
		<input style="width:49%;margin:6px 0 3px 0" type="text" name="techs3" id="techs3" value="<?php echo $techs3; ?>" />
		<input style="width:49%;margin:6px 0 3px 0" type="text" name="techs4" id="techs4" value="<?php echo $techs4; ?>" />
		<input style="width:49%;margin:6px 0 15px 0" type="text" name="techs5" id="techs5" value="<?php echo $techs5; ?>" />
		<input style="width:49%;margin:6px 0 15px 0" type="text" name="techs6" id="techs6" value="<?php echo $techs6; ?>" />
	</p>

	<p style="margin-bottom:25px">
		<label for="lightbox_path"><strong>URL Link for Lightbox</strong></label><br/>
		<label><span style="color:#808995;margin-top:5px;margin-bottom:3px;display:block">It can be image or video, it will be opened in the portfolio page</span></label>
		<input style="width:98%;margin:6px 0 15px 0" type="text" name="lightbox_path" id="lightbox_path" value="<?php echo $lightbox_path; ?>" />
		<strong>Sample formats:</strong><br/>
		<label><span style="color:#808995;">Image: http://yourdomain.com/image.jpg</span></label><br/>
		<label><span style="color:#808995;">Vimeo: http://vimeo.com/23534361</span></label><br/>
		<label><span style="color:#808995;">YouTube: http://www.youtube.com/watch?v=UX7GycmeQVo</span></label><br/>
		<label><span style="color:#808995;">More at:</span> <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/</a></label>
		<br/>
	</p>
	
	<p>
		<label for="portfolio_permalink"><strong>Custom Permalink</strong></label><br/>
		<label><span style="color:#808995;margin-top:5px;margin-bottom:3px;display:block">Redirect your portfolio post to link somewhere else, eg: http://mattiaviviani.com</span></label>
		<input style="width:98%;margin:6px 0 15px 0" type="text" name="portfolio_permalink" id="portfolio_permalink" value="<?php echo $portfolio_permalink; ?>" />
	</p>

	<?php
}

// Saving the Data
add_action( 'save_post', 'cd_meta_box_save' );

function cd_meta_box_save( $post_id ) {

	// Bail if we're doing an auto save
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

	// if our current user can't edit this post, bail
	if( !current_user_can( 'edit_post' ) ) return;

	// now we can actually save the data
	$allowed = array( 
		'a' => array( // on allow a tags
			'href' => array() // and those anchords can only have href attribute
		)
	);

	// Probably a good idea to make sure your data is set
	if( isset( $_POST['portfolio_desc'] ) )
		update_post_meta( $post_id, 'portfolio_desc', wp_kses( $_POST['portfolio_desc'], $allowed ) );
	
	if( isset( $_POST['project_img_url'] ) )
		update_post_meta( $post_id, 'project_img_url', wp_kses( $_POST['project_img_url'], $allowed ) );
		
	if( isset( $_POST['project_vimeo_id'] ) )
		update_post_meta( $post_id, 'project_vimeo_id', wp_kses( $_POST['project_vimeo_id'], $allowed ) );

	if( isset( $_POST['project_youtube_id'] ) )
		update_post_meta( $post_id, 'project_youtube_id', wp_kses( $_POST['project_youtube_id'], $allowed ) );

	if( isset( $_POST['project_link_text'] ) )
		update_post_meta( $post_id, 'project_link_text', wp_kses( $_POST['project_link_text'], $allowed ) );

	if( isset( $_POST['project_link'] ) )
		update_post_meta( $post_id, 'project_link', wp_kses( $_POST['project_link'], $allowed ) );
		
	if( isset( $_POST['client_name'] ) )
		update_post_meta( $post_id, 'client_name', wp_kses( $_POST['client_name'], $allowed ) );
	
	if( isset( $_POST['client_name_link'] ) )
		update_post_meta( $post_id, 'client_name_link', wp_kses( $_POST['client_name_link'], $allowed ) );

	if( isset( $_POST['lightbox_path'] ) )
		update_post_meta( $post_id, 'lightbox_path', wp_kses( $_POST['lightbox_path'], $allowed ) );
		
	if( isset( $_POST['techs1'] ) )
		update_post_meta( $post_id, 'techs1', wp_kses( $_POST['techs1'], $allowed ) );
	if( isset( $_POST['techs2'] ) )
		update_post_meta( $post_id, 'techs2', wp_kses( $_POST['techs2'], $allowed ) );
	if( isset( $_POST['techs3'] ) )
		update_post_meta( $post_id, 'techs3', wp_kses( $_POST['techs3'], $allowed ) );
	if( isset( $_POST['techs4'] ) )
		update_post_meta( $post_id, 'techs4', wp_kses( $_POST['techs4'], $allowed ) );
	if( isset( $_POST['techs5'] ) )
		update_post_meta( $post_id, 'techs5', wp_kses( $_POST['techs5'], $allowed ) );
	if( isset( $_POST['techs6'] ) )
		update_post_meta( $post_id, 'techs6', wp_kses( $_POST['techs6'], $allowed ) );
	
	if( isset( $_POST['portfolio_permalink'] ) )
		update_post_meta( $post_id, 'portfolio_permalink', wp_kses( $_POST['portfolio_permalink'], $allowed ) );

}

?>
