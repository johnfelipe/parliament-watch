<?php
function create_meeting_post_type(){
    register_post_type('meeting',
        array(
            'labels' => array(
                'name' => 'Meetings',
                'singular_name' => 'Meeting',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Meeting',
                'edit' => 'Edit',
                'edit_item' => 'Meeting Details',
                'new_item' => 'New Meeting',
                'view' => 'View',
                'view_item' => 'View Meeting',
                'search_items' => 'Search Meetings',
                'not_found' => 'No Meetings found',
                'not_found_in_trash' => 'No Meetings found in Trash',
                'parent' => 'Parent Meeting'
            ),
 
            'public' => true,
            'taxonomies' => array('meeting_type'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'has_archive' => true,
            'rerwite' => array('slug' => 'meetings', 'with_front' => true),
            'show_in_admin_bar' => false,
            /*'menu_icon' => plugins_url('cvbank/images/icon-cv.png')*/
        )
    );
    
    register_taxonomy(
		'meeting_type',
		'meeting',
		array(
			'labels' => array(
				'name' => 'Meeting Type',
				'add_new_item' => 'Add New Type',
				'new_item_name' => 'New Type'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
}
add_action('init', 'create_meeting_post_type');