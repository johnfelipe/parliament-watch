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
<div class="loader-container"><img src="<?php echo get_template_directory_uri().'/img/ajax-loader.gif' ?>" class="ajax-loader" /></div>
<div id="content">
    <?php 
        $constituency = get_field('constituency');
        if($constituency == ''){
            $constituency = 'N/A';
        }
        $parliament = reset(get_the_terms(get_the_ID(), 'mp_parliament'));
    ?>
    <div class="mover"><i class="icon-flag"></i>Constituency: <?php echo $constituency ?><span class="padding"></span>|<span class="padding"></span><i class="icon-calendar"></i>Parliament: <?php echo $parliament->name; ?></div>
    <div class="commitees"><span>Committees: </span>
        <?php
            $committees = get_posts(array('post_type' => 'committee', 'posts_per_page' => -1));
            foreach($committees as $c){
                $members = get_field('members', $c->ID);
                foreach($members as $m){
                    if($m->ID == get_the_ID()){
                        echo '<a href="'.get_permalink($c->ID).'">'.$c->post_title.'</a>';
                        break;
                    }
                }
            }
        ?>
    </div>
    <?php
        if(has_post_thumbnail()){
            $thumb = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
            $image = matthewruddy_image_resize($thumb, 200, 200, true);
            $image = $image['url'];
        ?>
        <img class="attachment-thumbnail wp-post-image" src="<?php echo $image ?>" />
        <?php }
        the_content();
    ?>
</div>

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'essentials' ); ?></p> 

<?php endif; ?>
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>