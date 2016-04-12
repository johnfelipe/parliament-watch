<?php
function create_motion_post_type(){
    register_post_type('motion',
        array(
            'labels' => array(
                'name' => 'Motions',
                'singular_name' => 'Motion',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Motion',
                'edit' => 'Edit',
                'edit_item' => 'Motion Details',
                'new_item' => 'New Motion',
                'view' => 'View',
                'view_item' => 'View Motion',
                'search_items' => 'Search Motions',
                'not_found' => 'No Motions found',
                'not_found_in_trash' => 'No Motions found in Trash',
                'parent' => 'Parent Motion'
            ),
 
            'public' => true,
            'taxonomies' => array('motion_tag'),
            'supports' => array('title', 'editor'),
            'has_archive' => 'motions',
            'rerwite' => array('slug' => 'motions', 'with_front' => true),
            'show_in_admin_bar' => false,
            /*'menu_icon' => plugins_url('cvbank/images/icon-cv.png')*/
        )
    );
    
    register_taxonomy(
		'motion_tag',
		'motion',
		array(
			'labels' => array(
				'name' => 'Motion Tag',
				'add_new_item' => 'Add New Tag',
				'new_item_name' => 'New Tag'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => false
		)
	);
}
add_action('init', 'create_motion_post_type');