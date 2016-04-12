<?php  
/* 
Template Name: Careers
*/  
?>

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

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php 
if ( has_post_thumbnail() ) {  ?>

<?php the_post_thumbnail('slide'); ?>

<?php } ?>

<?php the_content('        '); ?> 

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'essentials' ); ?></p> 

<?php endif; ?>

<!-- Start of left content -->
<div class="left_content">
<?php if (have_posts()) : ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts('post_type=careers&paged='. $paged ); ?>
<?php while (have_posts()) : the_post(); ?>

<!-- Start of blog wrapper -->
<div class="blog_wrapper">

<h5><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h5>

  <?php 
				if ( function_exists( 'get_option_tree' ) ) {
				$readmoretext = get_option_tree( 'vn_readmore_button_text' );
				} ?>

        <!-- Start of read more -->
        <div class="read_more">
          <?php
				global $more;
				$more = 0;
				ob_start();
				the_content(('<span class="more-link">' . $readmoretext . '</span>'),true);
				$postOutput = preg_replace('/<img[^>]+./','', ob_get_contents());
				ob_end_clean();
				echo $postOutput;
				?>
        </div>
        <!-- End of read more -->

<!-- Start of post details -->
<div class="post_details">

<!-- Start of post date -->
<div class="post_date">
<?php the_time(get_option('date_format')); ?>

</div><!-- End of post date -->

<!-- Start of post read more -->
<div class="post_read_more">
<a href="<?php the_permalink (); ?>"><?php _e( 'Continue Reading', 'essentials' ); ?><img src="<?php echo get_template_directory_uri(); ?>/img/red-hoverarrow.png" width="15" height="15" alt="red arrow" /></a>

</div><!-- End of post read more -->

</div><!-- End of post details -->

</div><!-- End of blog wrapper -->

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'essentials' ); ?></p> 

<?php endif; ?>

</div><!-- End of left content -->

<!-- Start of right content -->
<div class="right_content">
<?php get_sidebar ('careers'); ?> 

</div><!-- End of right content -->

<!-- Start of pagination -->
<div class="pagination">
<?php if (function_exists("pagination")) {
    pagination($wp_query->max_num_pages);
} ?>

</div><!-- End of pagination -->

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->
           
<?php get_footer(); ?>