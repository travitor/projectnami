<?php

/* `Post format Meta box
----------------------------------------------------------------------------------- */

$prefix = 'mav_';

$meta_boxes = array();
 
// Video (Vimeo) meta box
$meta_boxes[] = array(
    'id' => 'mav-meta-box-video',
    'title' => 'Format Video',
    'pages' => array('post'), // multiple post types
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => '<strong>Vimeo ID</strong>',
            'desc' => '<span style="color:#808995;margin-top:3px;margin-left:2px;float:left;">Enter the Vimeo video ID (eg: 23534361)</span>',
            'id' => $prefix . 'video_vimeo', 
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => '<strong>YouTube ID</strong>',
            'desc' => '<span style="color:#808995;margin-top:3px;margin-left:2px;float:left;">Enter the YouTube video ID (eg: UX7GycmeQVo)</span>',
            'id' => $prefix . 'video_youtube',
            'type' => 'text',
            'std' => ''
        )
    )
);


// Link meta box
$meta_boxes[] = array(
    'id' => 'mav-meta-box-link',
    'title' => 'Format Link',
    'pages' => array('post'), // multiple post types
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => '<strong>Link URL</strong>',
            'desc' => '<span style="color:#808995;margin-top:3px;margin-left:2px;float:left;">Enter the URL you wish to link to</span>',
            'id' => $prefix . 'link',
            'type' => 'text',
            'std' => ''
        )
    )
);


// Quote meta box
$meta_boxes[] = array(
    'id' => 'mav-meta-box-quote',
    'title' => 'Format Quote',
    'pages' => array('post'), // multiple post types
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => '<strong>Quote</strong>',
            'desc' => '<span style="color:#808995;margin-top:0;margin-left:2px;float:left;">Write your quote in this field</span>',
            'id' => $prefix . 'quote',
            'type' => 'textarea',
            'std' => ''
        )
    )
);






add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {

    global $meta_box;

    foreach ($meta_box['pages'] as $page) {
        add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $page, $meta_box['context'], $meta_box['priority']);
    }
}


foreach ($meta_boxes as $meta_box) {
    $my_box = new My_meta_box($meta_box);
}


class My_meta_box {
 
    protected $_meta_box;
 
    // create meta box based on given data
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));
 
        add_action('save_post', array(&$this, 'save'));
    }
 
    /// Add meta box for multiple post types
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }
 
    // Callback function to show fields in meta box
    function show() {
        global $post;
 
        // Use nonce for verification
        echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
        echo '<table class="form-table">';
 
        foreach ($this->_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);
 
            echo '<tr>',
                    '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                    '<td>';
            switch ($field['type']) {
                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                        '<br />', $field['desc'];
                    break;
                case 'textarea':
                    echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
                        '<br />', $field['desc'];
                    break;
                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                    }
                    echo '</select>';
                    break;
                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    break;
            }
            echo     '<td>',
                '</tr>';
        }
 
        echo '</table>';
    }


    // Save data from meta box
    function save($post_id) {
        // verify nonce
        if (@!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) { /* added @ to prevent notice */
            return $post_id;
        }
 
        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
 
        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
 
        foreach ($this->_meta_box['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];
 
            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }
}



/* `SWITCH META BOXES
----------------------------------------------------------------------------------- */

function meta_box_switch() {
    if ( is_admin() ) {
        $script = <<< EOF
<script type='text/javascript'>

    jQuery(document).ready(function($) {

	    $('#mav-meta-box-link').hide();
	    $('#mav-meta-box-quote').hide();
	    $('#mav-meta-box-video').hide();

	    /* standard, aside, gallery, image */
        $('#post-format-0, #post-format-aside, #post-format-gallery, #post-format-image').click(function() {
            $('#mav-meta-box-link').hide();
            $('#mav-meta-box-quote').hide();
            $('#mav-meta-box-video').hide();
        });
        
        /* video */
        $('#post-format-video').is(':checked') ? $("#mav-meta-box-video").show() : $("#mav-meta-box-video").hide();
        $('#post-format-video').click(function() {
            $("#mav-meta-box-video").toggle(this.checked);
            $('#mav-meta-box-link').hide();
            $('#mav-meta-box-quote').hide();
        });

        /* link */
        $('#post-format-link').is(':checked') ? $("#mav-meta-box-link").show() : $("#mav-meta-box-link").hide();
        $('#post-format-link').click(function() {
            $("#mav-meta-box-link").toggle(this.checked);
            $('#mav-meta-box-video').hide();
            $('#mav-meta-box-quote').hide();
        });

        /* quote */
        $('#post-format-quote').is(':checked') ? $("#mav-meta-box-quote").show() : $("#mav-meta-box-quote").hide();
        $('#post-format-quote').click(function() {
            $("#mav-meta-box-quote").toggle(this.checked);
            $('#mav-meta-box-link').hide();
            $('#mav-meta-box-video').hide();
        });

    });
</script>
EOF;
        echo $script;
    }
}
add_action('admin_footer', 'meta_box_switch');

?>
