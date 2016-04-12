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
   <h2 class="title"><?php the_title (); ?></h2>
</div>

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php 
    $number = get_field('question_number');
    $mover = get_field('question_mover');
    $minster = get_field('minister');
    $dor = get_field('date_of_receipt');
    $dod = get_field('date_of_dispatch');
    $doa = get_field('date_of_answer');
    $status = get_field('question_status');
    $answer = get_field('answer');
?>


<div id="left_content" class="left_content">
    <h3 class="inner-title"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h3>
    
    <div class="bill-details">
    <table class="table">
        <tr>
            <td><span class="label">Question REF</span><span class="value"><strong><?php the_field ('question_number'); ?></strong></span></td>
            <td><span class="label">Mover of Petition</span><span class="value"><strong><?php echo $mover->post_title ?></strong></span></td>
        </tr>
  <tr>
            <td><span class="label">Ministry Responsible</span><span class="value"><strong><?php the_field('minister'); ?></strong></span></td>
	        <td><span class="label">Date of Receipt</span><span class="value"><strong><?php echo date("d M Y", strtotime($dor)); ?></strong></span></td>
        </tr>
        <tr>
            <td><span class="label">Date Dispatched</span><span class="value"><strong><?php echo date("d M Y", strtotime($dod)); ?></strong></span></td>
          <td><span class="label">Status</span><span class="value"><font color="red"><strong><?php the_field('question_status'); ?></strong></font></span></td></tr>

    </table>
            
</div>
    
 <h5 class="title"><u>The Question</u></h5>

    <?php
        the_content(); ?>
    
    <div id="right_content">
<h5 class="title"><u>The Answer</u> (Date Answered: <?php if($doa != ''){
            echo date("d M Y", strtotime($doa));
        }
else{
            echo '<p><strong><font color="red">Date of Answer not set yet</font></strong></p>';
 };  ?>)
<br>
<?php
      if($answer != ''){
            echo the_field('answer');
      }
else{
            echo '<p><strong><font color="red">Answer Not Available for display</font></strong></p>';
 } ?>
</div>
</div>

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'essentials' ); ?></p> 

<?php endif; ?>
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>