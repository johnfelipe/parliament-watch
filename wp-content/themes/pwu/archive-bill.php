<?php get_header(); ?>
<?php
    $bills = array();
?>
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper" style="padding-top:30px;">
  <div class="content_search">
  <?php echo do_shortcode( '[ULWPQSF id=6045]' ); ?>
  </div>
<!-- Start of left content -->
<div class="left_content left_search">

    <h3 class="inner-title"> Bills Tracker </h3>



<div class="container">


    <?php
    foreach($bills as $p){
        $post = $p;
        get_template_part('content', 'bill');
    }

    ?>
    </div>

<?php while(have_posts()) : the_post(); ?>

<?php get_template_part('content', 'bill'); ?>

<?php endwhile; ?>

</div><!-- End of left content -->

<div class="right_content">
<?php get_sidebar ('blog'); ?>

</div> <!-- End of right content -->

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
