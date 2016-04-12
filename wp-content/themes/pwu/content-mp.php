<?php
/*
 * The default template for displaying content
 */
?>

<?php
    	$party = get_field('party');
	$constituency = get_field('constituency');
?>
<?php 
if (has_post_thumbnail()) {  ?>

<?php
    $thumb = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
    $image = matthewruddy_image_resize($thumb, 50, 50, true);
    $image = $image['url'];
?>
<table class="committee-list list-table" width="100%">
<tr align="center">
<td style="width:80px"><img class="attachment-thumbnail wp-post-image" src="<?php echo $image ?>" />
<?php } ?></td>
<td style="width:200px"><strong><font color="#000000"><?php the_title(); ?></font></strong></td>
<td style="width:200px"><strong><font color="#000000"><?php the_field('constituency'); ?></font></strong></td>
<td style="width:80px"><strong><font color="#000000"><?php the_field('party'); ?></font></strong></td>
<div class="post_read_more">
<td style="width:80px" align="center"><strong><font color="#000000"><a href="<?php the_permalink (); ?>"><?php _e( 'Details', 'essentials' ); ?><img src="<?php echo get_template_directory_uri(); ?>/img/red-hoverarrow.png" width="15" height="15" alt="red arrow" /></a></td></strong></div>
</tr>
</table>
</center>