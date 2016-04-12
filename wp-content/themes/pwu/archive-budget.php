<?php get_header(); ?>

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of breadcrumb wrapper -->
<div class="breadcrumb_wrapper">

<div class="breadcrumbs">
    <h2 class="title">Budgets</h2>
</div>

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper">

<!-- Start of left content -->
<div class="left_content">

<?php while(have_posts()) : the_post(); ?>

<?php get_template_part('content', 'budget'); ?>

<?php endwhile; ?> 

</div><!-- End of left content -->

<!-- Start of right content -->
<div class="right_content">
<?php get_sidebar ('blog'); ?> 

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