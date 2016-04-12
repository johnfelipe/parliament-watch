<?php
function create_bill_update_post_type(){
    register_post_type('bill_update',
        array(
            'labels' => array(
                'name' => 'Bill Updates',
                'singular_name' => 'Bill Update',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Update',
                'edit' => 'Edit',
                'edit_item' => 'Update Details',
                'new_item' => 'New Update',
                'view' => 'View',
                'view_item' => 'View Update',
                'search_items' => 'Search Updates',
                'not_found' => 'No Updates found',
                'not_found_in_trash' => 'No Updates found in Trash',
                'parent' => 'Parent Bill'
            ),
 
            'public' => true,
            'taxonomies' => array('bill_status', 'bill_status_tags'),
            'supports' => array('title', 'editor', 'thumbnail'),
            'has_archive' => true,
            'show_in_admin_bar' => false,
            'rewrite' => array(
                'slug' => 'bill-updates',
                'with_front' => true
            )
            /*'menu_icon' => plugins_url('cvbank/images/icon-cv.png')*/
        )
    );
    
    register_taxonomy(
		'bill_status',
		'bill_update',
		array(
			'labels' => array(
				'name' => 'Bill Status',
				'add_new_item' => 'Add New Status',
				'new_item_name' => 'New Status'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
    
    register_taxonomy(
		'bill_status_tags',
		'bill_update',
		array(
			'labels' => array(
				'name' => 'Bill Status Tags',
				'add_new_item' => 'Add New Tag',
				'new_item_name' => 'New Tag'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
}
add_action('init', 'create_bill_update_post_type');