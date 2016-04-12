<?php get_header(); ?>
<?php
    $mps = array();
?>
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of breadcrumb wrapper -->
<div class="breadcrumb_wrapper">

<div class="breadcrumbs">
    <h2 class="title">Members of Parliament</h2>
<?php echo do_shortcode( '[searchandfilter taxonomies="search" submit_label="Find Your MP" search_placeholder="Name or Constituency"]' ); ?>
       
</div>

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper">

<!-- Start of left content -->
<div class="left_content">
<center>
<table class="committee-list list-table" width="100%">
<tr>
<th style="width:80px"></th>
<th style="width:200px">Name of MP</th>
<th style="width:200px">Constituency</th>
<th style="width:80px">Party</th>
<th style="width:80px"></th>
</tr>
<?php
    foreach($mps as $p){
        $post = $p;
        get_template_part('content', 'mp');
    }
    
?>
</table>
</center>
<?php while(have_posts()) : the_post(); ?>

<?php get_template_part('content', 'mp'); ?>

<?php endwhile; ?>

</div><!-- End of left content -->

<!-- Start of right content-->
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