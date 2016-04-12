<?php
function create_bill_post_type(){
    register_post_type('bill',
        array(
            'labels' => array(
                'name' => 'Bills',
                'singular_name' => 'Bill',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Bill',
                'edit' => 'Edit',
                'edit_item' => 'Bill Details',
                'new_item' => 'New Bill',
                'view' => 'View',
                'view_item' => 'View Bill',
                'search_items' => 'Search Bills',
                'not_found' => 'No Bills found',
                'not_found_in_trash' => 'No Bills found in Trash',
                'parent' => 'Parent Bill'
            ),
 
            'public' => true,
            'taxonomies' => array('bill_type', 'bill_tag', 'bill_progress'),
            'supports' => array('title', 'editor'),
            'has_archive' => 'bills',
            'show_in_admin_bar' => false,
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'bills',
                'with_front' => true
            )
            /*'menu_icon' => plugins_url('cvbank/images/icon-cv.png')*/
        )
    );
    
    register_taxonomy(
		'bill_type',
		'bill',
		array(
			'labels' => array(
				'name' => 'Bill Type',
				'add_new_item' => 'Add New Type',
				'new_item_name' => 'New Type'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
    
    register_taxonomy(
		'bill_tag',
		'bill',
		array(
			'labels' => array(
				'name' => 'Bill Tag',
				'add_new_item' => 'Add New Tag',
				'new_item_name' => 'New Tag'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => false
		)
	);
    
    register_taxonomy(
		'bill_progress',
		'bill',
		array(
			'labels' => array(
				'name' => 'Bill Progress',
				'add_new_item' => 'Add New Progress',
				'new_item_name' => 'New Progress'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
}
add_action('init', 'create_bill_post_type');