<?php
/*
Single Post Template: [Blog Single Right Sidebar]
Description: This part is optional, but helpful for describing the Post Template
*/
?>

<?php get_header(); ?>
<?php
    $type = reset(get_the_terms(get_the_ID(), 'committee_type'));
?>
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of header wrapper -->

<!-- Start of breadcrumb wrapper -->
<div class="breadcrumb_wrapper">

<div class="breadcrumbs">
    <h2 class="title"><?php the_title (); ?>   <span class="indicator <?php echo $type->slug ?>"><?php echo $type->name ?></span></h2>
</div>

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of breadcrumb wrapper -->

<!-- Start of content wrapper -->
<div id="contentwrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper">

<div class="left_content">
<div id="content">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<h3 class="inner-title"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h3>
<?php
    the_content();
    echo '<h3>Committee Members</h3>';
    $members = get_field('members');
    if(!empty($members)){
        echo '<table class="table">';
        echo '<tr><th style="width:300px">Name</th><th style="width:200px">Constituency</th></tr>';
        foreach($members as $p){
            $c = get_field('constituency', $p->ID);
            $parliament = reset(get_the_terms($p->ID, 'mp_parliament'));
            echo '<tr><td style="width:300px"><a href="'.get_permalink($p->ID).'">'.$p->post_title.'</a></td><td style="width:200px">'.$c.'</td></tr>';
        }
        echo '</table>';
    }
?>

<!--<div class="loader-container"><img src="<?php echo get_template_directory_uri().'/img/ajax-loader.gif' ?>" class="ajax-loader" /></div>-->
</div>
</div>

<div class="content_left documents">
    <h3>Meetings</h3>
    <?php
        $meetings = get_committee_meetings(get_the_ID());
        if(!empty($meetings)){
            echo '<ul class="meetings">';
            foreach($meetings as $update){
                $s = reset(get_the_terms($update->ID, 'meeting_type'));
                $date_span = '<span class="indicator date">'.date('d M, Y', strtotime($update->post_date)).'</span>';
                $status_span = '<span class="indicator '.$s->slug.'">'.$s->name.'</span>';
                echo '<li>'.$date_span.'<br/>'.$status_span.'<br/><a href="'.get_permalink($update->ID).'" post-id="'.$update->ID.'">'.$update->post_title.'</a></li>';
            }
            echo '</ul>';
        }else{
            echo '<p>No meetings yet</p>';
        }
    ?>
</div><!-- End of left content -->

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no committees to display. Try using the search.', 'essentials' ); ?></p> 

<?php endif; ?>
</div><!-- End of content wrapper -->

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of content wrapper -->

<?php get_footer(); ?>