<?php
/*
 * The default template for displaying content
 */
?>

<?php
  	$number = get_field('question_number');
	$mover = get_field('question_mover');
	$minster = get_field('minister');
     	$dor = get_field('date_of_receipt');
	$dod = get_field('date_of_dispatch');
	$doa = get_field('date_of_answer');
	$status = get_field('question_status');
	

?>

<!--
<table class="committee-list list-table" width="100%">
<tr align="center">
<td style="width:130px"><strong><font color="#000000"><?php the_field('question_number'); ?></font></strong></td>
<td style="width:130px"><strong><font color="#000000"><?php the_title(); ?></font></strong></td>
<td style="width:130px"><strong><font color="#000000"><?php echo $mover->post_title; ?></font></strong></td>
<td style="width:130px"><strong><font color="#000000"><?php the_field('minister'); ?></font></strong></td>
<td style="width:130px"><strong><font color="#000000"><?php the_field('question_status'); ?></font></strong></td>
<td style="width:80px" align="center"><strong><font color="#000000"><a href="<?php permalink_link() ?>">Details</font></strong></a></td></strong>
</tr>
</table>
</center>  -->

<div class="updates updates-inner-pages">
    <span class="pull-left bill-title-inner"> <strong><?php the_field('question_number'); ?> : </strong> <a href="<?php permalink_link() ?>"> <?php the_title(); ?> </a> </span> 
    
    <span class="pull-left mover"> <strong>Mover of Question : </strong> <a href="<?php permalink_link() ?>"> <?php echo $mover->post_title; ?> </a> </span> 
    
    <span class="updates-btm"> <strong class="updates-bill-text" style="margin-left:0px;"> Minister: </strong>  <?php the_field('minister'); ?>  <strong class="updates-bill-text"> Question Status </strong> <?php the_field('question_status'); ?> </span>

</div>