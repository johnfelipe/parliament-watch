<?php
/*
 * The default template for displaying content
 */
?>

<?php
    	$year = get_field('year');
	$committee = get_field('committee');
	$last_meeting = get_latest_bill_status_update(get_the_ID());
	$reading = reset(get_the_terms(get_the_ID(), 'bill_progress'));
	$status = reset(get_the_terms($last_meeting->ID, 'bill_status'));
    if(!empty($status)){
        $status = $status->name;
    }else{
        $status = $reading->name;
    }
?>




<div class="updates updates-inner-pages">
    <span class="pull-left bill-title-inner"> <a href="<?php permalink_link() ?>"> <?php the_title(); ?> </a> </span> 
    <span class="updates-btm"> <strong class="updates-bill-text" style="margin-left:0px;"> Year: </strong>  <?php the_field('year'); ?>  <strong class="updates-bill-text"> Committee: </strong> <?php echo $committee->post_title; ?> <strong class="updates-bill-text"> Status: </strong> <?php echo $status; ?>  </span>

</div>
