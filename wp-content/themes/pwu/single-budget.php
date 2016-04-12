<?php
/*
Single Post Template: [Blog Single Right Sidebar]
Description: This part is optional, but helpful for describing the Post Template
*/
?>

<?php get_header(); ?>

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of breadcrumb wrapper -->
<div class="breadcrumb_wrapper">

<div class="breadcrumbs">
    <h2 class="title"><?php the_title (); ?><span class="indicator <?php echo $status->slug ?>"><?php echo $status->name ?></span></h2>
</div>

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper">
<!-- Start of left content -->

<!-- Start of left content -->

<div class="left_content">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
     <h3 class="inner-title"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h3>
<div class="bill-details">

</div>

<div id="content">
    <?php the_content() ?>
</div>
    <?php
$post_tags = wp_get_post_tags($post->ID);

if(!empty($post_tags)) { ?>

    <!-- Start of post tags wrap -->
    <div class="post_tags_wrap">
      <!-- Start of post tags title -->
      <div class="post_tags_title">
        <?php _e( 'TAGS', 'essentials' ); ?>
      </div>
      <!-- End of post tags title -->

      <!-- Start of cat tags -->
      <div class="cat_tags" >
        <?php the_tags('', '&nbsp; ', ''); ?>
      </div>
      <!-- End of cat tags -->
    </div>
    <!-- End of post tags wrap -->

    <?php } ?>

<?php endwhile; ?>

<?php else: ?>
<p><?php _e( 'There are no posts to display. Try using the search.', 'essentials' ); ?></p>

<?php endif; ?>

</div><!-- End of left content -->

    <div class="content_left documents">
    <h3>Supporting Documents</h3>
    <?php
        $documents = get_field('related_documents');
        if(!empty($documents)){
            echo '<ul class="docs">';
            foreach($documents as $d){
                echo '<li><a href="'.$d['document'].'">'.$d['document_title'].'</a></li>';
            }
            echo '</ul>';
        }else{
            echo '<p>No supporting documents</p>';
        }
    ?>
</div><!-- End of left content -->
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>
