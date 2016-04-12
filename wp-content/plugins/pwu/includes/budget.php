<?php
function create_budget_post_type(){
    register_post_type('budget',
        array(
            'labels' => array(
                'name' => 'Budgets',
                'singular_name' => 'Budget',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Budget',
                'edit' => 'Edit',
                'edit_item' => 'Budget Details',
                'new_item' => 'New Budget',
                'view' => 'View',
                'view_item' => 'View Budget',
                'search_items' => 'Search Budgets',
                'not_found' => 'No Budgets found',
                'not_found_in_trash' => 'No Budgets found in Trash',
                'parent' => 'Parent Budget'
            ),
 
            'public' => true,
            'taxonomies' => array('budget_status'),
            'supports' => array('title', 'editor'),
            'has_archive' => 'budgets',
            'show_in_admin_bar' => false,
            'rerwite' => array('slug' => 'budgets', 'with_front' => true),
            /*'menu_icon' => plugins_url('cvbank/images/icon-cv.png')*/
        )
    );
    
    register_taxonomy(
		'budget_status',
		'budget',
		array(
			'labels' => array(
				'name' => 'Budget Status',
				'add_new_item' => 'Add New Status',
				'new_item_name' => 'New Status'
			),
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true
		)
	);
}
add_action('init', 'create_budget_post_type');