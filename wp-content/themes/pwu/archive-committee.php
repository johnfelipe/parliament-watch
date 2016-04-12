<?php get_header(); ?>

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of breadcrumb wrapper -->
<div class="breadcrumb_wrapper">

<div class="breadcrumbs">
    <h2 class="title" style="display:inline">Committees</h2>
	<?php
        $terms = get_terms('committee_type', array('hide_empty' => 0));
    ?>
    <select id="committee-filter" style="margin-left:20px;padding:8px; border:1px solid ##1E4E1D;">
        <option value="-1">All Committees</option>
        <?php
            foreach($terms as $t){
                echo '<option value="'.$t->slug.'">'.$t->name.'</option>';
            }
        ?>
    </select>
</div>

    
<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper">

<!-- Start of content wrapper -->


<!-- Start of left content -->
<div class="left_content">
<p> 
Membership of Standing committees is for the entire life of Parliament while Sessional Committees are constituted at the beginning of every session of Parliament, and their functions are similar to those of Standing Committees.
    
</p>
    
<?php while(have_posts()) : the_post(); ?>

<?php get_template_part('content', 'committee'); ?>

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