<?php 
/* Plugin Name: PCC for WordPress 
Plugin URI:http://wpcc.phploaded.com/
Description: This plugin allows you to create project cost calculator forms visually and easily.
Author: Satish Kumar Sharma
Version: 1.8
Author URI: http://phploaded.com/index.php?user=23
*/
error_reporting(0);

function wpcc_activate(){
mysql_query("CREATE TABLE IF NOT EXISTS `wp_wpcc_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `data` longtext NOT NULL,
  `em1` varchar(5000) NOT NULL,
  `em1sub` varchar(5000) NOT NULL,
  `em1body` varchar(6500) NOT NULL,
  `em2` varchar(5000) NOT NULL,
  `em2sub` varchar(5000) NOT NULL,
  `em2body` varchar(6500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;");

mysql_query("ALTER TABLE `wp_wpcc_forms` CHANGE `data` `data` LONGTEXT NOT NULL");
}

register_activation_hook( __FILE__, 'wpcc_activate' );

class Paginator{
	var $items_per_page;
	var $items_total;
	var $current_page;
	var $num_pages;
	var $mid_range;
	var $low;
	var $limit;
	var $return;
	var $default_ipp;
	var $querystring;
	var $ipp_array;

	function Paginator()
	{
		$this->current_page = 1;
		$this->mid_range = 7;
		$this->ipp_array = array(5,10,25,50,100);
		$this->items_per_page = (!empty($_GET['ipp'])) ? $_GET['ipp']:$this->default_ipp;
	}

	function paginate()
	{
		if(!isset($this->default_ipp)) $this->default_ipp=10;
		if($_GET['ipp'] == 'All')
		{
			$this->num_pages = 1;

		}
		else
		{
			if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		}
		$this->current_page = (isset($_GET['pagenumber'])) ? (int) $_GET['pagenumber'] : 1 ; // must be numeric > 0
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;
		if($_GET)
		{
			$args = explode("&",$_SERVER['QUERY_STRING']);
			foreach($args as $arg)
			{
				$keyval = explode("=",$arg);
				if($keyval[0] != "pagenumber" And $keyval[0] != "ipp") $this->querystring .= "&" . $arg;
			}
		}

		if($_POST)
		{
			foreach($_POST as $key=>$val)
			{
				if($key != "pagenumber" And $key != "ipp") $this->querystring .= "&$key=$val";
			}
		}
		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page > 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=\"$_SERVER[PHP_SELF]?pagenumber=$prev_page&ipp=$this->items_per_page$this->querystring\">&laquo; Previous</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Previous</span> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";

				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And $_GET['pagenumber'] != 'All') ? "<a title=\"Go to page $i of $this->num_pages\" class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" href=\"$_SERVER[PHP_SELF]?pagenumber=$i&ipp=$this->items_per_page$this->querystring\">$i</a> ";
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page < $this->num_pages And $this->items_total >= 10) And ($_GET['pagenumber'] != 'All') And $this->current_page > 0) ? "<a class=\"paginate\" href=\"$_SERVER[PHP_SELF]?pagenumber=$next_page&ipp=$this->items_per_page$this->querystring\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">&raquo; Next</span>\n";
			$this->return .= ($_GET['pagenumber'] == 'All') ? "<a class=\"current\" style=\"margin-left:10px;display:none;\" href=\"#\">All</a> \n":"<a class=\"paginate\" style=\"margin-left:10px\" href=\"$_SERVER[PHP_SELF]?pagenumber=1&ipp=All$this->querystring\">All</a> \n";
		}
		else
		{
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<a class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" href=\"$_SERVER[PHP_SELF]?pagenumber=$i&ipp=$this->items_per_page$this->querystring\">$i</a> ";
			}
			$this->return .= "<a class=\"paginate\" style=\"display:none;\" href=\"$_SERVER[PHP_SELF]?pagenumber=1&ipp=All$this->querystring\">All</a> \n";
		}
		$this->low = ($this->current_page <= 0) ? 0:($this->current_page-1) * $this->items_per_page;
		if($this->current_page <= 0) $this->items_per_page = 0;
		$this->limit = ($_GET['ipp'] == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}
	function display_items_per_page()
	{
		$items = '';
		if(!isset($_GET[ipp])) $this->items_per_page = $this->default_ipp;
		foreach($this->ipp_array as $ipp_opt) $items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n":"<option value=\"$ipp_opt\">$ipp_opt</option>\n";
		return " &nbsp; &nbsp; <span class=\"paginate\">Items per page : </span><select class=\"paginate\" onchange=\"window.location='$_SERVER[PHP_SELF]?pagenumber=1&ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>\n";
	}
	function display_jump_menu()
	{
		for($i=1;$i<=$this->num_pages;$i++)
		{
			$option .= ($i==$this->current_page) ? "<option value=\"$i\" selected>$i</option>\n":"<option value=\"$i\">$i</option>\n";
		}
		return "<span class=\"paginate\">Page:</span><select class=\"paginate\" onchange=\"window.location='$_SERVER[PHP_SELF]?pagenumber='+this[this.selectedIndex].value+'&ipp=$this->items_per_page$this->querystring';return false\">$option</select>\n";
	}
	function display_pages()
	{
		return $this->return;
	}
}

function quick_paginate($numrows, $text='Items'){

if($_GET['ipp']>0){
$per_page = $_GET['ipp'];
} else {
$per_page = 10;
}

if($_GET['pagenumber']>0){
$start = ($_GET['pagenumber']-1)*$per_page;
} else {
$start = 0;
}

$pages = new Paginator;
$pages->items_total = $numrows;
$pages->mid_range = 5;
$pages->paginate();
$paginate[data] = $pages->display_pages();
$paginate[data] =str_replace('Items', $text, '<div class="pagination"><span class="paginate">Total '.$numrows.' Items Found &nbsp; </span>'.$paginate[data] .''. $pages->display_items_per_page().'</div>');

$paginate[start] = $start;
$paginate[per_page] = $per_page;

return $paginate;
}


define('WPCCPATH', dirname(__FILE__).'/');
define('WPCCURL', plugins_url( '/', __FILE__ ));


function include_wpcc_setting_page(){
include('wpcc-settings.php');
}

function include_wpcc_new_tracking(){
include('wpcc-add-new.php');
}

function include_wpcc_updates(){
include('wpcc-updates.php');
}

function include_wpcc_completed(){
include('wpcc-completed.php');
}

function wpcc_admin_actions() {  
add_menu_page('WPCC Forms', 'WPCC Forms',0,'wpcc-settings.php', 'include_wpcc_setting_page',plugins_url( 'icon.png', __FILE__ ),680); 
}  

add_action('admin_menu', 'wpcc_admin_actions');


function init_wpcc_admin() {
wp_enqueue_script( 'jquery' );
wp_register_script( 'wpccajs', plugins_url( 'js/admin.min.js', __FILE__ ));
wp_enqueue_script( 'wpccajs' );
wp_register_style( 'wpccacss', plugins_url( 'css/admin.css', __FILE__ ));
wp_enqueue_style( 'wpccacss' );
wp_register_script( 'wpccjs', plugins_url( 'js/pcc.min.js', __FILE__ ));
wp_enqueue_script( 'wpccjs' );
wp_register_style( 'wpcccss', plugins_url( 'css/wpcc.css', __FILE__ ));
wp_enqueue_style( 'wpcccss' );
}

function wpcc_admin_head(){
echo '<script>wpcc_domain = "'.plugins_url().'/wpcc";
ajaxurl = \''.admin_url('admin-ajax.php').'\';</script>';
}


function wpcc_clean($data){
$data = htmlentities($data, ENT_COMPAT, "UTF-8");
return $data;
}

function wpcc_render( $atts ) {
extract( shortcode_atts( array(
'id' => 'id',
'emtext' => 'emtext',
'currency' => 'currency'
), $atts ) );

$fdata = mysql_fetch_assoc(mysql_query("SELECT * FROM `wp_wpcc_forms` WHERE `id`='$id'"));

$out = '<form method="post" data-emtext="'.$emtext.'" data-curr="'.$currency.'" id="wpcc-'.$id.'" class="pcc-form" action="index.html" name="ccc">'.html_entity_decode($fdata['data']).'</form>
<div class="wpcc-preview" id="wpcc-'.$id.'-show"></div>';

return do_shortcode($out);
}

add_shortcode( 'wpcc', 'wpcc_render' );


add_action('wp_ajax_nopriv_wpcc_mail', 'wpcc_send_mail');
add_action('wp_ajax_wpcc_mail', 'wpcc_send_mail');

function wpcc_send_mail() {
	global $wpdb; // this is how you get access to the database

$fid = str_replace("wpcc-", "", $_POST['fid']);

$xdata = mysql_fetch_assoc(mysql_query("SELECT * FROM `wp_wpcc_forms` WHERE `id`='$fid'"));

$to = $xdata['em1'];
$subject = $xdata['em1sub'];
$msg = $xdata['em1body'];
$msgc = $_POST['data']."<br /><h2>".$_POST['tot']."</h2>";

foreach($_POST['xtr'] as $key => $val){
$msg = str_replace("[".$key."]", $_POST['xtr'][$key], $msg);
}

$msg = str_replace("[wpcc-data]", $msgc, $msg);

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: <'.$_POST['mymail'].'>' . "\r\n";

mail($to,$subject,$msg,$headers);


$to = $_POST['mymail'];
$subject = $xdata['em2sub'];
$msg = nl2br(html_entity_decode($xdata['em2body']));
$msgc = $_POST['data']."<br /><h2>".$_POST['tot']."</h2>";

foreach($_POST['xtr'] as $key => $val){
$msg = str_replace("[".$key."]", nl2br(htmlentities($_POST['xtr'][$key], ENT_COMPAT, "UTF-8")), $msg);
}

$msg = str_replace("[wpcc-data]", $msgc, $msg);

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: <'.$xdata['em1'].'>' . "\r\n";

mail($to,$subject,$msg,$headers);


echo'Email sent successfully. If you dont receive email in inbox, dont forget to check in spam folder.';



die(); // this is required to return a proper result
}


add_action('admin_head', 'wpcc_admin_head');
add_action('wp_head', 'wpcc_admin_head');
add_action('admin_print_scripts', 'init_wpcc_admin');
add_action('wp_enqueue_scripts', 'init_wpcc_admin');

?>