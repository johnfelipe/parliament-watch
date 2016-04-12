<?php
/*
 * The default template for displaying content
 */
?>

<?php
  	$petitioner = get_field('petitioner');
     	$date_presented = get_field('date_presented');
	$committee = get_field('committee');
	$status = get_field('status');
	

?>

<div class="updates updates-inner-pages">
    <span class="pull-left bill-title-inner"> <a href="<?php permalink_link() ?>"> <?php the_title(); ?> </a> </span> 
    <span class="updates-btm"> <strong class="updates-bill-text" style="margin-left:0px;"> Date Presented: </strong>  <?php echo date("d M Y", strtotime($date_presented)); ?> <strong class="updates-bill-text"> Committee: </strong> <?php echo $committee->post_title; ?> <strong class="updates-bill-text"> Status: </strong> <?php echo $status; ?>  </span>

</div>
