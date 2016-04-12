<?php
function create_mp_post_type(){
    register_post_type('mp',
        array(
            'labels' => array(
                'name' => 'MPs',
                'singular_name' => 'MP',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New MP',
                'edit' => 'Edit',
                'edit_item' => 'MP Details',
                'new_item' => 'New MP',
                'view' => 'View',
                'view_item' => 'View MP',
                'search_items' => 'Search MPs',
                'not_found' => 'No MPs found',
                'not_found_in_trash' => 'No MPs found in Trash',
                'parent' => 'Parent MP'
            ),
 
            'public' => true,
            'taxonomies' => array('mp_parliament'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'has_archive' => 'mps',
            'rerwite' => array('slug' => 'mps', 'with_front' => true),
            'show_in_admin_bar' => false,
        )
    );
    
    register_taxonomy(
		'mp_parliament',
		'mp',
		array(
			'labels' => array(
				'name' => 'Parliament',
				'add_new_item' => 'Add New Parliament',
				'new_item_name' => 'New Parliament'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
}
add_action('init', 'create_mp_post_type');