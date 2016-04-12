<?php  
/* 
Template Name: Page-FullWidth 
*/  
?>

<?php get_header(); ?>

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of breadcrumb wrapper -->
<div class="breadcrumb_wrapper">

<!-- <div class="breadcrumbs">
    <h2 class="title"><?php the_title(); ?></h2>
</div> -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper" class="container body-wrapper">

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


</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>