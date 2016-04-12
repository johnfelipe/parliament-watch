<?php get_header(); ?>

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of breadcrumb wrapper -->
<div class="breadcrumb_wrapper">

<div class="breadcrumbs">
    <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper">

<!-- Start of left content -->
<?php
/*
Plugin Name: Force Category Template
Plugin URI: http://txfx.net/code/wordpress/force-category-template/
Description: 
Author: Mark Jaquith
Version: 0.1
Author URI: http://txfx.net/
*/

/* GPL goes here */

function txfx_force_category_template() {

	if ( !is_single() || is_404() ) return; // we only care about single posts

	global $posts, $post;

	$post = $posts[0];
	$categories = get_the_category($post->ID);
	
	if ( !count($categories) ) return; // no category with which to work

	foreach ( $categories as $category ) {
		if ( file_exists(TEMPLATEPATH . "/category-" . $category->cat_ID . '.php') ) {
			include(TEMPLATEPATH . "/category-" . $category->cat_ID . '.php');
			exit;
		}
	}
}

add_action('template_redirect', 'txfx_force_category_template');
?>

<div class="left_content">

<?php echo do_shortcode("[wp-publication-archive] "); ?> 

</div><!-- End of left content -->

</div><!-- End of right content -->

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>