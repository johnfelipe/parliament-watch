<?php  
/* 
Template Name: Homepage-DynamicWithSlider
*/  
?>

<?php get_header(); ?>

<!-- Start of slider wrapper -->
<section class="slider_wrapper">

<!-- Start of slider -->
<section class="slider">

<ul class="slides">

<?php
$my_query = null;
$my_query = new WP_Query('post_type=slider&showposts=10');
$my_query->query('post_type=slider&showposts=10');
?>

<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?> 
<li>
<?php the_content(); ?>
</li>

<?php endwhile; ?>

</ul>

<?php wp_reset_query(); ?>
    
</section><!-- End of slider -->

<!-- Start of clear fix --><div class="clear"></div>

</section><!-- End of slider wrapper -->

<!-- Start of searchbox -->
<div id="searchbox">

<!-- Start of search box -->
<?php get_search_form(); ?>
<!-- End of searchbox -->

</div><!-- End of searchbox -->

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of message wrapper -->
<div id="message_wrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper">

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$homepagemessageleft = get_option_tree( 'vn_homepagemessageleft' );
} ?>

<?php if ($homepagemessageleft != ('')){ ?>

<!-- Start of contentleft -->
<div class="contentleft">
<p><?php echo stripslashes($homepagemessageleft); ?></p>

</div><!-- End of contentleft -->

<?php } else { } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$homepagemessageright = get_option_tree( 'vn_homepagemessageright' );
} ?>

<?php if ($homepagemessageright != ('')){ ?>

<!-- Start of contentright -->
<div class="contentright">
<?php echo $homepagemessageright; ?>

</div><!-- End of contentright -->

<?php } else { } ?>

</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of message wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper body-wrapper">
<div class="news-ticker-wrapper">
<div class="content_wrapper">
<div id="news-ticker"><?php echo do_shortcode('[news_ticker]'); ?></div>
</div>
<div class="clear"></div>
</div>
<!-- Start of content wrapper -->
<div class="content_wrapper">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="one_half_first bill_updates">

<?php the_content(''); ?>
</div><!-- End of one half first -->

<!-- Start of one half -->
<div class="one_half">
<?php 
if ( function_exists( 'get_option_tree' ) ) {
$homepagerightcolumntitle = get_option_tree( 'vn_homepagerightcolumntitle' );
} ?>

<?php if ($homepagerightcolumntitle != ('')){ ?>

<h3><i class="icon-list-alt"></i><?php echo stripslashes($homepagerightcolumntitle); ?></h3>

<?php } else { } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$homepageleftcolumnlinktext = get_option_tree( 'vn_homepagerightcolumnlinktext' );
$homepagerightcolumnlink = get_option_tree( 'vn_homepagerightcolumnlink' );
} ?>

<?php if ($homepageleftcolumnlinktext != ('')){ ?>

<!-- Start of view all -->
<div class="viewall">
<a href="<?php echo $homepagerightcolumnlink; ?>"><?php echo stripslashes($homepageleftcolumnlinktext); ?></a>

</div><!-- End of view all -->

<?php } else { } ?>

<!-- Start of homepage slider section -->
<div class="homepage_slider_section">

<?php echo get_touchcarousel(1); ?>

</div><!-- End of homepage slider section -->
<!-- Start of Feedback Form -->
<h2><i class="icon-bullhorn"></i>Ask Questions/Give Us Feedback</h2>
<?php 
if (function_exists("add_formcraft_form"))
{ add_formcraft_form("[fc id='2'][/fc]"); } 
?>

</div><!-- End of one half -->
<hr />
<div class="one_half_first tweets">
    <h2><i class="icon-twitter"></i>Parliament Watch on Twitter</h2>
    <?php echo do_shortcode('[rotatingtweets screen_name="pwatchug" include_rts="0" links_in_new_window="1" show_meta_via="0"]') ?>
    <p style="margin-bottom:0;"><a href="https://twitter.com/pwatchug" class="twitter-follow-button" data-show-count="false">Follow @pwatchug</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></p>
</div>
<div class="one_half featured-mp">
    <h2 style="color: #4baad3;"><i class="icon-quote-left"></i>Quote of the Week</h2>
    <?php
        $quote = get_posts(array('cat' => 261, 'posts_per_page' => 1));
        $quote = $quote[0];
        $mp = get_field('mp', $quote->ID);
        $thumb = wp_get_attachment_url(get_post_thumbnail_id($mp->ID));
        $image = matthewruddy_image_resize($thumb, 200, 200, true);
        $image = $image['url'];
        echo '<img class="attachment-thumbnail alignleft wp-post-image" src="'.$image.'" />';
        echo '<a href="'.get_permalink($mp->ID).'">'.$mp->post_title.'</a><br/>';
        echo '<span class="constituency" style="display:none">'.get_field('constituency', $mp->ID).'</span>';
        echo '<p>"'.$quote->post_content.'"</p>'
        
    ?>
</div>

<?php endwhile; endif; ?>

<?php wp_reset_query(); ?>

<div class="clear"></div>

<hr />

<!-- Start of one half first -->
<div id="partners">
<?php 
if ( function_exists( 'get_option_tree' ) ) {
$homepageleftcolumntitle = get_option_tree( 'vn_homepageleftcolumntitle' );
} ?>

<?php if ($homepageleftcolumntitle != ('')){ ?>

<h3 style="text-align: center;"><?php echo stripslashes($homepageleftcolumntitle); ?></h3>

<?php } else { } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$homepageleftcolumnlinktext = get_option_tree( 'vn_homepageleftcolumnlinktext' );
$homepageleftcolumnlink = get_option_tree( 'vn_homepageleftcolumnlink' );
} ?>

<?php if ($homepageleftcolumnlinktext != ('')){ ?>

<?php } else { } ?>
<?php echo do_shortcode('[partner_logos]') ?> 
</div><!-- End of one half first -->


</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>