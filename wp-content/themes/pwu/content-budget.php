<?php
/*
 * The default template for displaying content
 */
?>

<!-- Start of blog wrapper -->
<div class="blog_wrapper">

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
          <?php echo shorten_string_by_chars(get_the_content(), 220, '...') ?>
        </div>
        <!-- End of read more -->

<!-- Start of post details -->
<div class="post_details">

<!-- Start of post date -->
<div class="post_date">
<i class="icon-calendar"></i>
<?php
    $year = get_field('year');
    if($year == ''){
        $year = rand(2000, 2014);
        $year = $year.'/'.($year + 1);
    }
    echo $year;
?>

</div><!-- End of post date -->

<!-- Start of post comment -->
<div class="post_comment">
<?php
    $status = reset(get_the_terms(get_the_ID(), 'budget_status'));
    echo '<span class="indicator '.$status->slug.'"><i class="icon-info"></i>'.$status->name.'</span>';
?>
</div><!-- End of post comment -->

<div class="post_comment">
<?php
    $committee = get_field('committee');
    if(!empty($committee)){
        echo '<i class="icon-group"></i>'.shorten_string_by_chars($committee->post_title, 30, '...');
    }
?>
</div><!-- End of post comment -->

<!-- Start of post read more -->
<div class="post_read_more">
<a href="<?php the_permalink (); ?>"><?php _e( 'View Budget', 'essentials' ); ?><img src="<?php echo get_template_directory_uri(); ?>/img/red-hoverarrow.png" width="15" height="15" alt="red arrow" /></a>

</div><!-- End of post read more -->

</div><!-- End of post details -->

</div><!-- End of post class -->

</div><!-- End of blog wrapper -->