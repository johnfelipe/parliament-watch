<?php get_header(); ?>
<?php

    $motions = array();
    $petitions = array();

?>
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->


<style type="text/css">
 .table {
    /* width: 100%; */
    /* max-width: 100%; */
    margin-bottom: 20px;
    border: none;
    background: none;
}

    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    background: none ! important;
    float: left;
    width: 100%;
    vertical-align: top;
    /* border-top: 1px solid #ddd; */
}



</style>


<!-- Start of breadcrumb wrapper -->
<div class="breadcrumb_wrapper">

<div class="breadcrumbs">
    <h2 class="title">Petitions Tracker</h2>
<?php echo do_shortcode( '[searchandfilter taxonomies="search" submit_label="Search Petitions" search_placeholder="Find a Petition..."]' ); ?>
</div>

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper" >

<!-- Start of content wrapper -->
<div class="content_wrapper" style="padding-top:30px;">
  <div class="content_search">
  <?php echo do_shortcode( '[ULWPQSF id=6046]' ); ?>
  </div>
<!-- Start of left content -->
<div class="left_content left_search">

     <h3 class="inner-title"> Petition Tracker </h3>
<p>The Petitions Tracker provides an overview of the current status of all Petitions before Parliament</p>

<?php while(have_posts()) : the_post(); ?>

<?php
//get_template_part('content', 'motion');

$p = get_field('petition');


if($p){
   $petitions[] = $post;
}else{
    $motions[] = $post;
}
?>

<?php endwhile; ?>

    <div class="row">
    <?php
    foreach($motions as $p){
        $post = $p;
        get_template_part('content', 'motion');
    }

?>

    </div>



<!-- <h3>Petitions</h3>
<table class="committee-list list-table">
<tr><th>Petition</th><th>Mover</th></tr>
<?php
    foreach($petitions as $p){
        $post = $p;
        get_template_part('content', 'motion');
    }

?> -->

</div><!-- End of left content -->

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
