<?php

/*

Single Post Template: [Blog Single Right Sidebar]

Description: This part is optional, but helpful for describing the Post Template

*/

?>



<?php get_header(); ?>

<?php

    $last_meeting = get_latest_bill_status_update(get_the_ID());

    $status = reset(get_the_terms($last_meeting->ID, 'bill_status'));

    $committee = get_field('committee');

    $mp = get_field('mp');

    $type = reset(get_the_terms(get_the_ID(), 'bill_type'));

    $reading = reset(get_the_terms(get_the_ID(), 'bill_progress'));

    if(!empty($reading)){

        $reading = $reading->name;

    }else{

        $reading = 'N/A';

    }

    if($type->term_id == 239){//public bill

        $mp = 'N/A';

    }else{

        if(!empty($mp)){

            $mp = '<a href="'.get_permalink($mp->ID).'">'.$mp->post_title.'</a>';

        }else{

            $mp = 'N/A';

        }

    }

    $motion = get_field('motion_or_petition');

?>

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




<div class="left_content">

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<h3 class="inner-title"><a href="<?php the_permalink (); ?>"><?php the_title (); ?></a></h3>

<div class="bill-details">

       <table class="table">
        <tr>
            <td><span >Year : </span><span ><strong><?php the_field('year') ?></strong></span></td>
        </tr>
	<tr>
	<td><span >Status : </span><span ><strong><?php echo $status->name ?></strong></span></td>
	</tr>
        <tr>
            <td colspan="2"><span >Type : </span><span ><strong><?php echo $type->name ?>&nbsp; Bill</strong></span></td>
        </tr>
        <tr>
 	<td colspan="2"><span >Sponsor : </span><span ><strong><?php echo $mp ?></strong></span></td>           
        </tr>
        <tr>
            <td colspan="2"><span >Committee : </span><span><strong><a href="<?php echo get_permalink($committee->ID) ?>"><?php echo $committee->post_title ?></a></strong></span></td>
        </tr>
    </table>

</div>

<!-- <div class="loader-container"><img src="<?php echo get_template_directory_uri().'/img/ajax-loader.gif' ?>" class="ajax-loader" /></div> -->

<div id="content">

    <?php

        the_content();

        $related_posts = get_field('related_editorials');

        if(!empty($related_posts)){

            echo '<div class="related"><h3>Related Analysis</h3>';

            echo '<ul>';

            foreach($related_posts as $p){

                echo '<li><a href="'.get_permalink($p->ID).'" title="'.$p->post_title.'">'.$p->post_title.'</a></li>';

            }

            echo '</ul>';

        }

    ?>

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



<!-- Start of left content -->

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

    <h3>Bill Updates</h3>

    <?php

        $updates = get_bill_updates(get_the_ID());

        if(!empty($updates)){

            echo '<ul class="updates docs">';

            foreach($updates as $update){

                $s = reset(get_the_terms($update->ID, 'bill_status'));

                $date_span = '<span class="indicator date">'.date('d M, Y', strtotime($update->post_date)).'</span>';

                $status_span = '<span class="indicator bill-status '.$s->slug.'">'.$s->name.'</span>';

                echo '<li>'.$date_span.'<br/>'.$status_span.'<br/><a href="'.get_permalink($update->ID).'" post-id="'.$update->ID.'">'.$update->post_title.'</a></li>';

            }

            echo '</ul>';

        }else{

            echo '<p>No updates yet</p>';

        }

    ?>

</div><!-- End of left content -->

<!-- Start of left content -->



</div><!-- End of content wrapper -->



<!-- Clear Fix --><div class="clear"></div>



</div><!-- End of content wrapper -->



<?php get_footer(); ?>