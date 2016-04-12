<?php
global $wpdb;
if($_POST['name']!=''){
$wpdb->query("UPDATE `wp_wpcc_forms` SET `name` = '".wpcc_clean($_POST['name'])."',
`em1` = '".wpcc_clean($_POST['em1'])."',
`em1sub` = '".wpcc_clean($_POST['em1sub'])."',
`em1body` = '".wpcc_clean($_POST['em1body'])."',
`em2sub` = '".wpcc_clean($_POST['em2sub'])."',
`em2body` = '".wpcc_clean($_POST['em2body'])."' WHERE `id` ='".$_GET['edit']."'");
}

$xdata = $wpdb->get_row("SELECT * FROM `wp_wpcc_forms` WHERE `id`='".$_GET['edit']."'",ARRAY_A);

?>
<h2>Editing settings for "<?php echo $xdata['name']; ?>"<br /><br /><a href="admin.php?page=wpcc-settings.php">Back to form list</a></h2>

<form name="ddd" action="" method="post">
<table width="95%" class="skswp-table">
<tr>
<td width="150"><b>Name</b></td>
<td><input type="text" name="name" value="<?php echo $xdata['name']; ?>" /></td>
</tr>

<tr>
<td><b>Your Email Address</b></td>
<td><input type="text" name="em1" value="<?php echo $xdata['em1']; ?>" /></td>
</tr>

<tr>
<td><b>Your Email Subject</b></td>
<td><input type="text" name="em1sub" value="<?php echo $xdata['em1sub']; ?>" /></td>
</tr>

<tr>
<td><b>Your Email body</b></td>
<td><textarea rows="6" name="em1body"><?php echo $xdata['em1body']; ?></textarea></td>
</tr>

<tr>
<td><b>Visitor's Email Subject</b></td>
<td><input type="text" name="em2sub" value="<?php echo $xdata['em2sub']; ?>" /></td>
</tr>

<tr>
<td><b>Visitor's Email body</b></td>
<td><textarea rows="6" name="em2body"><?php echo $xdata['em2body']; ?></textarea></td>
</tr>


<tr>
<td colspan="2" align="right"><input type="submit" class="button button-primary button-large" name="ddd" value="Save Changes" /> &nbsp; <input type="reset" class="button button-large" name="ggg" value="Reset Changes" /></td>
</tr>
</table>
</form>