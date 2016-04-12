<?php
/*
 * The default template for displaying content
 */
?>

<!-- Start of blog wrapper -->
<div class="blog_wrapper">

<!-- Start of post class -->
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<h3 class="inner-title"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h3>

<div class="blog-content pull-left">
  <div class="blog-img pull-left">
    <?php
    if ( has_post_thumbnail() ) {  ?>
    <?php the_post_thumbnail('slide'); ?>

    <?php } ?>

   </div>

     <?php
   				if ( function_exists( 'get_option_tree' ) ) {
   				$readmoretext = get_option_tree( 'vn_readmore_button_text' );
   				} ?>

           <!-- Start of read more -->
           <div class="read_more pull-left">


             <?php
   				global $more;
   				$more = 0;
   				ob_start();
   				the_content(('<span class="more-link">' . $readmoretext . '</span>'),true);
   				$postOutput = preg_replace('/<img[^>]+./','', ob_get_contents());
                   $postOutput = shorten_string_by_chars($postOutput, 160, '...');
   				ob_end_clean();
   				echo $postOutput;
   				?>
           </div>


</div>



        <!-- End of read more -->

<!-- Start of post details -->
<div class="post_details">

<!-- Start of post date -->
<div class="post_date">
  <p> <strong><?php the_time(get_option('date_format')); ?></strong> </p>


</div><!-- End of post date -->

<?php if ('open' == $post->comment_status) { ?>

<!-- Start of post comment -->
<div class="post_comment">

<p> | <strong>By: &nbsp;<?php the_author(); ?> </strong> | </p>


</div><!-- End of post comment -->

<?php } ?>

<!-- Start of post read more -->
<div class="post_read_more">
  <p><strong><a href="<?php the_permalink (); ?>"><?php _e( 'Continue Reading', 'essentials' ); ?><img src="<?php echo get_template_directory_uri(); ?>/img/red-hoverarrow.png" width="12" height="12" alt="red arrow" /></a></strong>
  </p>

</div><!-- End of post read more -->

</div><!-- End of post details -->

</div><!-- End of post class -->

</div><!-- End of blog wrapper -->
