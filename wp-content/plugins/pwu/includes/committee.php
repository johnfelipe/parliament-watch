<?php
function create_committee_post_type(){
    register_post_type('committee',
        array(
            'labels' => array(
                'name' => 'Committees',
                'singular_name' => 'Committee',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Committee',
                'edit' => 'Edit',
                'edit_item' => 'Committee Details',
                'new_item' => 'New Committee',
                'view' => 'View',
                'view_item' => 'View Committee',
                'search_items' => 'Search Committees',
                'not_found' => 'No Committees found',
                'not_found_in_trash' => 'No Committees found in Trash',
                'parent' => 'Parent Committee'
            ),
 
            'public' => true,
            'taxonomies' => array('committee_type'),
            'supports' => array('title', 'editor'),
            'has_archive' => 'committees',
            'show_in_admin_bar' => false,
            'rerwite' => array('slug' => 'committees', 'with_front' => true),
            /*'menu_icon' => plugins_url('cvbank/images/icon-cv.png')*/
        )
    );
    
    register_taxonomy(
		'committee_type',
		'committee',
		array(
			'labels' => array(
				'name' => 'Committee Type',
				'add_new_item' => 'Add New Type',
				'new_item_name' => 'New Type'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
}
add_action('init', 'create_committee_post_type');