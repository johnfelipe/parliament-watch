<?php
/*
Plugin Name: Parliament Watch Uganda
Plugin URI: http://www.parliamentwatch.ug/
Description: Manages bills and parliament activities
Version: 1.0
Author: Zed Jasper Onono
Author URI: http://www.parliamentwatch.ug/
*/
include_once 'includes/mp.php';
include_once 'includes/committee.php';
include_once 'includes/budget.php';
include_once 'includes/motion.php';
include_once 'includes/bill.php';
include_once 'includes/meeting.php';
include_once 'includes/bill-update.php';

function pwu_enqueue_scripts(){
    wp_register_script('pwu_script', plugins_url('js/scripts.js', __FILE__), array('jquery'), '1.23', true);
    wp_localize_script('pwu_script', 'pwuajax', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('pwu_script');
    
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'pwu_enqueue_scripts');

function home_meetings_shortcode(){
    $ret = '<div id="home-bill-updates">';
    
    $ret .= '<div class="creativ-shortcode-col-inner ">';
    $meetings = get_posts(array('post_type' => 'meeting', 'posts_per_page' => 3));
    foreach($meetings as $meeting){
        $thumb_id = get_post_thumbnail_id($meeting->ID);
        $thumb = wp_get_attachment_image_src($thumb_id, 'thumbnail');
        
        $committee = get_field('committee', $meeting->ID);
        $type = reset(get_the_terms($meeting->ID, 'meeting_type'));
        $ret .= '<div class="updates" > <span class="indicator date pull-left">'.date('d M, Y', strtotime($meeting->post_date)).'</span> <span class="comm-image pull-left vc_col-sm-4"> <img src="'.$thumb[0].'" /> </span> <span class="comm-meeting pull-left vc_col-sm-8">  <a href="'.get_permalink($meeting->ID).'">'.$meeting->post_title.'</a> '.shorten_string_by_chars($meeting->post_content, 120).' <span class="comm-link pull-left "> <a href="'.get_permalink($committee->ID).'">' .$committee->post_title.'</a> | ' .date('d M, Y', strtotime($meeting->post_date)). '</span>  </div>';
    }
    $ret .= '</div></div>';
    return $ret;
}
add_shortcode('home_meetings', 'home_meetings_shortcode');

function home_bill_updates_shortcode(){
    $ret = '<div id="home-bill-updates">';
    
    $ret .= '<div class="creativ-shortcode-col-inner">';
    $updates = get_posts(array('post_type' => 'bill_update', 'posts_per_page' => 3));
    foreach($updates as $update){
        $bill = get_field('bill', $update->ID);
        $status = reset(get_the_terms($update->ID, 'bill_status'));
        $type = reset(get_the_terms($bill->ID, 'bill_type'));
        $year = get_field('year', $bill->ID);
        $committe = get_field('committee', $bill->ID);
        
        $ret .= ' <div class="updates"> <span class="pull-left bill-title-inner"> <a href="'.get_permalink($bill->ID).'">'.$bill->post_title.'</a> </span> <span class="bill-status indicator pull-left '.$status->slug.'"> STATUS:'.$status->name.'</span> <span class= "pull-left">' .shorten_string_by_chars($bill->post_content, 120). '</span> <span class="updates-btm"> <strong> Year: </strong>  '.$year.' <strong> Type: </strong>  '.$type->name.'  <strong> Committee: </strong> '.$committe->post_title.'</span> </div>';
    }
    $ret .= '</div></div>';
    
    return $ret;
}
add_shortcode('home_bill_updates', 'home_bill_updates_shortcode');


function widget_bill_updates_shortcode(){
    $ret = '<div class="updates"><table>';
    $updates = get_posts(array('post_type' => 'bill_update', 'posts_per_page' => 5));
    foreach($updates as $update){
        $bill = get_field('bill', $update->ID);
        $status = reset(get_the_terms($update->ID, 'bill_status'));
        $ret .= '<tr><td><span class="bill-status indicator '.$status->slug.'">'.$status->name.'</span><a href="'.get_permalink($bill->ID).'">'.$bill->post_title.'</a></td></tr>';
    }
    $ret .= '</table></div>';
    return $ret;
}
add_shortcode('widget_bill_updates', 'widget_bill_updates_shortcode');

function widget_meetings_shortcode(){
    $ret .= '<div class="updates"><table>';
    $updates = get_posts(array('post_type' => 'meeting', 'posts_per_page' => 5));
    foreach($updates as $update){
        $committee = get_field('committee', $update->ID);
        $type = reset(get_the_terms($update->ID, 'meeting_type'));
        $ret .= '<tr><td><span class="meeting-type indicator '.$type->slug.'">'.$type->name.'</span><a href="'.get_permalink($committee->ID).'">'.$committee->post_title.'</a></td></tr>';
    }
    $ret .= '</table></div>';
    return $ret;
}
add_shortcode('widget_meetings', 'widget_meetings_shortcode');

function partner_logos_shortcode(){
    $content = '<div class="partner-logos">';
    $partners = array(
        'gaap.png' => '#',
        'NEDlogo.png' => 'http://www.ned.org/',
        'osf.png' => 'http://www.opensocietyfoundations.org/about/offices-foundations/open-society-initiative-eastern-africa',
        'usa-ug.png' => 'http://kampala.usembassy.gov/'
    );
    
    foreach($partners as $img => $link){
        $content .= '<a href="'.$link.'" target="_blank"><img src="'.home_url('images/'.$img).'" /></a>';
    }
    
    $content .= '</div>';
    
    return $content;
}
add_shortcode('partner_logos', 'partner_logos_shortcode');

function shorten_string_by_chars($string, $max_chars, $append = ' &raquo;'){
    $string = preg_replace("/<img[^>]+\>/i", "", $string);
    $string = strip_tags($string);
    $ret_val = $string;
    $chars = strlen($string);
    if($chars <= $max_chars){
        $ret_val = $string;
    }else{
        $ret_val = substr($string, 0, $max_chars) . $append;
    }
    return $ret_val;
}

function get_latest_bill_status_update($bill_id){
    $meta_query = array(
		array(
			'key'     => 'bill',
			'value'   => get_the_ID(),
			'compare' => '='
		)
	);
    $meeting = reset(get_posts(array('post_type' => 'bill_update', 'meta_query' => $meta_query, 'posts_per_page' => 1)));
    
    return $meeting;
}

function get_bill_updates(){
    $meta_query = array(
		array(
			'key'     => 'bill',
			'value'   => get_the_ID(),
			'compare' => '='
		)
	);
    $meetings = get_posts(array('post_type' => 'bill_update', 'meta_query' => $meta_query, 'posts_per_page' => -1));
    
    return $meetings;
}

function get_committee_meetings(){
    $meta_query = array(
		array(
			'key'     => 'committee',
			'value'   => get_the_ID(),
			'compare' => '='
		)
	);
    $meetings = get_posts(array('post_type' => 'meeting', 'meta_query' => $meta_query, 'posts_per_page' => -1));
    
    return $meetings;
}

function pwu_ajax_get_pdf_view(){
    if(isset($_POST['file'])){
        echo '<h3>'.$_POST['title'].'</h3><i style="padding-right:10px" class="icon-zoom-in"></i>'.do_shortcode('[pdfjs-viewer url='.$_POST['file'].' viewer_height=500px]');
    }else{
        echo '-1';
    }
    die();
}

add_action('wp_ajax_pwu_ajax_get_pdf_view', 'pwu_ajax_get_pdf_view');
add_action('wp_ajax_nopriv_pwu_ajax_get_pdf_view', 'pwu_ajax_get_pdf_view');

function pwu_ajax_get_update_content(){
    if(isset($_POST['id'])){
        $update = get_post($_POST['id']);
        $s = reset(get_the_terms($update->ID, 'bill_status'));
        $date_span = '<span class="indicator date">'.date('d M, Y', strtotime($update->post_date)).'</span>';
        $status_span = '<span class="indicator '.$s->slug.'">'.$s->name.'</span>';
        echo '<h3>'.$date_span.$status_span.$update->post_title.'</h3>'.apply_filters('the_content', $update->post_content);
    }else{
        echo '-1';
    }
    die();
}

add_action('wp_ajax_pwu_ajax_get_update_content', 'pwu_ajax_get_update_content');
add_action('wp_ajax_nopriv_pwu_ajax_get_update_content', 'pwu_ajax_get_update_content');

function pwu_ajax_get_meeting_content(){
    if(isset($_POST['id'])){
        $meeting = get_post($_POST['id']);
        $s = reset(get_the_terms($meeting->ID, 'meeting_type'));
        $date_span = '<span class="indicator date">'.date('d M, Y', strtotime($meeting->post_date)).'</span>';
        $status_span = '<span class="indicator '.$s->slug.'">'.$s->name.'</span>';
        $ret = '<h3>'.$date_span.$status_span.$meeting->post_title.'</h3>'.apply_filters('the_content', $meeting->post_content);
        $document = get_field('document', $_POST['id']);
        if(!empty($document)){
            //print_r($document);
            $ret .= '<h4>Related Document</h4><i style="padding-right:10px" class="icon-zoom-in"></i>'.do_shortcode('[pdfjs-viewer url='.$document['url'].' viewer_height=500px]');
        }
        
        echo $ret;
    }else{
        echo '-1';
    }
    die();
}

add_action('wp_ajax_pwu_ajax_get_meeting_content', 'pwu_ajax_get_meeting_content');
add_action('wp_ajax_nopriv_pwu_ajax_get_meeting_content', 'pwu_ajax_get_meeting_content');

function news_ticker_shortcode(){
    $news = get_posts(array('posts_per_page' => 5, 'cat' => 290));
    $ret = '<ul id="ticker">';
    foreach($news as $n){
        $ret .= '<li class="news-item"><a href="'.get_permalink($n->ID).'">'.$n->post_title.'</a></li>';
    }
    $ret .= '</ul>';
    wp_reset_query();
    return $ret;
}
add_shortcode('news_ticker', 'news_ticker_shortcode');

function budget_sniplet_shortcode(){
    $posts = get_posts(array('posts_per_page' => 20, 'cat' => 254));
    $ret = '<ul class="budget-sniplets">';
    foreach($posts as $p){
        $ret .= '<li><a href="'.get_permalink($p->ID).'">'.$p->post_title.'</a></li>';
    }
    $ret .= '</ul>';
    wp_reset_query();
    return $ret;
}
add_shortcode('budget_sniplets', 'budget_sniplet_shortcode');

function budget_selector_shortcode(){
    $posts = get_posts(array('posts_per_page' => -1, 'post_type' => 'budget'));
    $ret = '<div id="budget-selector"><h3>View Budgets by Sector</h3><select>';
    $ret .= '<option value="">-- Select Budget --</option>';
    foreach($posts as $p){
        $ret .= '<option value="'.get_permalink($p->ID).'">'.$p->post_title.'</option>';
    }
    $ret .= '</select></div>';
    wp_reset_query();
    return $ret;
}
add_shortcode('budget_selector', 'budget_selector_shortcode');

function alter_posts_per_page($query){
    if(!$query->is_main_query()){
        return;
    }
    
    if(is_post_type_archive('committee') || is_post_type_archive('motion')){
        $query->set('posts_per_page', 100);
    }
    if(is_post_type_archive('mp')){
        if($_POST['mp-name'] != '' || $_POST['mp-constituency'] != ''){
            if($_POST['mp-constituency'] != ''){ //search by constitunecy only
                $meta_query = array(
                    array(
                        'key' => 'constituency',
                        'value' => htmlspecialchars($_POST['mp-constituency']),
                        'compare' => 'LIKE'
                    )
                );
                $query->set('meta_query', $meta_query);
            }else{ //search by name
                $query->set('s', htmlspecialchars($_POST['mp-name']));
            }
        }
    }
    if($query->is_search()){
        $query->set('post_type', array('post', 'committee', 'mp', 'bill', 'motion', 'budget'));
        //print_r($query);
    }
    return $query;
}

add_action( 'pre_get_posts', 'alter_posts_per_page', 10);