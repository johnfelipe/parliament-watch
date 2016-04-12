<?php
/*
 * The default template for displaying audio
 */
?>

<!-- Start of blog wrapper -->
<div class="blog_wrapper">

<!-- Start of post class -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<h2 class="blue"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h2>

  <?php 
				if ( function_exists( 'get_option_tree' ) ) {
				$readmoretext = get_option_tree( 'vn_readmore_button_text' );
				} ?>

        <!-- Start of read more -->
        <div class="read_more">
          <?php
				global $more;
				$more = 0;
				ob_start();
				the_content(('<span class="more-link">' . $readmoretext . '</span>'),true);
				$postOutput = preg_replace('/<img[^>]+./','', ob_get_contents());
				ob_end_clean();
				echo $postOutput;
				?>
        </div>
        <!-- End of read more -->

<!-- Start of post details -->
<div class="post_details">

<!-- Start of post date -->
<div class="post_date">
<?php the_time(get_option('date_format')); ?>

</div><!-- End of post date -->

<?php if ('open' == $post->comment_status) { ?>

<!-- Start of post comment -->
<div class="post_comment">
&nbsp; 
<?php
if (get_comments_number()==1) { ?>

<?php comments_popup_link( '0', '1', '%', 'comments-link', ''); ?>

<?php _e( 'COMMENT', 'essentials' ); ?>

<?php } else { ?>

<?php comments_popup_link( '0', '1', '%', 'comments-link', ''); ?>

<?php _e( 'COMMENTS', 'essentials' ); ?>

<?php } ?>

</div><!-- End of post comment -->

<?php } ?>

<!-- Start of post read more -->
<div class="post_read_more">
<a href="<?php the_permalink (); ?>"><?php _e( 'Continue Reading', 'essentials' ); ?><img src="<?php echo get_template_directory_uri(); ?>/img/red-hoverarrow.png" width="15" height="15" alt="red arrow" /></a>

</div><!-- End of post read more -->

</div><!-- End of post details -->

</div><!-- End of post class -->

</div><!-- End of blog wrapper -->