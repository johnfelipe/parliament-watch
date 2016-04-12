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

<!-- Start of employee image single -->
<div class="employee_image_single">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php
$stafftitle = get_post_meta($post->ID, 'stafftitle', $single = true); 
$stafffullwidthimage = get_post_meta($post->ID, 'stafffullwidthimage', $single = true); 
?>

<?php echo wp_get_attachment_image($stafffullwidthimage, ''); ?>

</div><!-- End of employee image single -->

<h2><?php the_title (); ?></h2>

<!-- Start of employee info -->
<div class="employee_info">

<!-- Start of social icons -->
<div class="social_icons">

    <?php $repeatable_fields = get_post_meta($post->ID, 'repeatable', true);
	if ($repeatable_fields != ('')){ 
	foreach ($repeatable_fields as $v) { ?>
    
<a href="<?php echo $v['repeatable_socailurl']; ?>"><?php echo wp_get_attachment_image($v['repeatable_socailimage'], ''); ?></a>
<?php } } else { }?>

</div><!-- End of social icons -->

<!-- Start of employee title -->
<div class="employee_title">
<?php if ($stafftitle != ('')){ ?>
<?php echo stripslashes($stafftitle); ?>
<?php } else { } ?>

</div><!-- End of employee title -->

</div><!-- End of employee info -->

<?php 
if ( has_post_thumbnail() ) {  ?>

<a href="<?php the_permalink (); ?>"><?php the_post_thumbnail('slide'); ?></a>

<?php } ?>


<?php the_content('        '); ?> 

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'essentials' ); ?></p> 

<?php endif; ?>

<?php if ('open' == $post->comment_status) { ?>

<!-- Clear Fix --><div class="clearbig"></div>

<!-- Start of comment wrapper -->
<div class="comment_wrapper">

<!-- Start of comment wrapper main -->
<div class="comment_wrapper_main">

<?php comments_template(); ?>
<?php comment_form(); ?>

</div><!-- End of comment wrapper main -->

<div class="clear"></div>

</div><!-- End of comment wrapper -->

<?php } ?> 

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>