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

    <?php $petitioner = get_field('petitioner');
	
    $date_presented = get_field('date_presented');
	$document = get_field('document');
	$committee = get_field('committee');
	$status = get_field('status');
	$committee_report = get_field('committee_report');
	$date_report_laid = get_field('date_report_laid');
?>


<div id="left_content" class="left_content">
    
    <h3 class="inner-title"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h3>
       
    <div class="bill-details">
    <table class="table">
        <tr>
            <td><span class="label">Petitioners</span><span class="value"><strong><?php the_field ('petitioner'); ?></strong></span></td>
            <td><span class="label">Date Presented</span><span class="value"><strong><?php echo date("d M Y", strtotime($date_presented)); ?></strong></span></td>
        </tr>
       <tr>
            <td><span class="label">Committee</span><span class="value"><strong><?php echo $committee->post_title ?></strong></span></td>
	 <td><span class="label">Committee Report Laid</span><span class="value"><strong>
<?php if($date_report_laid != ''){
            echo date("d M Y", strtotime($date_report_laid));
        }
else{
            echo '<p><strong><font color="red">No Committee Report Yet</font></strong></p>';
 }	?>
</strong></span></td>
        </tr>
	<tr>
            <td colspan="2"><span class="label">Status</span><span class="value"><font color="red"><strong><?php the_field ('status'); ?></strong></font></span></td></tr>
    </table>
</div>
    

    <?php
        the_content(); ?>
</div>
<div id="right_content" class="right_content">
<h5 class="title">
<?php echo $committee->post_title ?> Report</h5>
<?php
        $committee_report = get_field('committee_report');
        if($committee_report != ''){
            echo do_shortcode('[pdfjs-viewer url='.$committee_report['url'].' viewer_height=500px]');
        }
else{
            echo '<p><strong><font color="red">No Committee Report Yet</font></strong></p>';
 }	?>
</div>

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'essentials' ); ?></p> 

<?php endif; ?>
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>