<?php
/*
 * The default template for displaying content
 */
 $type = reset(get_the_terms(get_the_ID(), 'committee_type'));
?>
<!-- Start of blog wrapper -->
<div class="blog_wrapper <?php echo $type->slug ?>">

<!-- Start of post class -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<h2 class="blue"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h2>

<?php 
if (has_post_thumbnail()) {  ?>

<!-- Clear Fix --><div class="clear"></div>

<?php the_post_thumbnail('slide'); ?>

<!-- Clear Fix --><div class="clearbig"></div>

<?php } ?>

  <?php 
				if ( function_exists( 'get_option_tree' ) ) {
				$readmoretext = get_option_tree( 'vn_readmore_button_text' );
				} ?>

        <!-- Start of read more -->
        <div class="read_more">
          <?php echo shorten_string_by_chars(get_the_content(), 150, '...') ?>
        </div>
        <!-- End of read more -->

<!-- Start of post details -->
<div class="post_details">

<!-- Start of post comment -->
<div class="post_comment">
<i class="icon-tag"></i>
<strong><?php
    echo $type->name;
?></strong>
</div><!-- End of post comment -->

<!-- Start of post date -->
<div class="post_date">
<i class="icon-group"></i>
<?php
    $members = get_field('members');
    echo count($members).' Members';
?>

</div><!-- End of post date -->

<div class="post_comment" style="display: none;">
<?php
    $meeting = get_latest_bill_status_update(get_the_ID());
    if(!empty($meeting)){
        $status = reset(get_the_terms($meeting->ID, 'bill_status'));
        echo '<span class="indicator '.$status->slug.'"><i class="icon-info"></i>'.$status->name.'</span>';
    }else{
        echo '<span class="indicator committee-presentation"><i class="icon-info"></i>Pending Status</span>';
    }
?>
</div><!-- End of post comment -->

<!-- Start of post read more -->
<div class="post_read_more">
<a href="<?php the_permalink (); ?>"><strong><?php _e( 'Read Reports of Committee', 'essentials' ); ?><img src="<?php echo get_template_directory_uri(); ?>/img/red-hoverarrow.png" width="15" height="15" alt="red arrow" /></strong></a>

</div><!-- End of post read more -->

</div><!-- End of post details -->

</div><!-- End of post class -->

</div><!-- End of blog wrapper -->