<?php
include_once 'resize.php';
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////       WP Default Functionality       ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 980, 999999, true );

add_theme_support( 'custom-background' );

add_theme_support( 'custom-header' );

add_theme_support( 'automatic-feed-links' );

function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

add_post_type_support( 'attachment:audio', 'thumbnail' );
add_post_type_support( 'attachment:video', 'thumbnail' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     WP Tag Cloud     //////////////////////////////////////////////// 
////////////////////////////////////////////////////////////////////////////////////////////
add_filter( 'wp_tag_cloud', 'remove_tag_cloud', 10, 2 );

function remove_tag_cloud ( $return, $args )
{
        return false;
}

function mytheme_tags() {
			
$tags = get_tags();
foreach ($tags as $tag) {
$tag_link = get_tag_link($tag->term_id);
$html = '<div class="button_tag">';
$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
$html .= "{$tag->name}</a>";
$html .= '</div>';
echo $html;
}
}
	
add_filter('widget_tag_cloud_args', 'mytheme_tags');	


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Prev & Next Buttons    //////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="button arrow_left"';
}
function posts_link_attributes_2() {
    return 'class="button arrow_right"';
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Post Format     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_theme_support( 'post-formats', array() );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     2 WP Nav Menus     //////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
register_nav_menus( array(  
  'primary' => __( 'Primary Navigation', 'essentials' ),
  'topsub' => __( 'Top Sub Menu Navigation', 'essentials' ), 
  'sidebarone' => __('Sidebar Menu', 'essentials')  

) );  	


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Setting up Option Tree includes     /////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/* START OPTION TREE */ 
add_filter( 'ot_show_pages', '__return_false' );  
add_filter( 'ot_theme_mode', '__return_true' );
//add_filter( 'ot_show_pages', '__return_true' );  
//add_filter( 'ot_theme_mode', '__return_false' );
include_once( 'option-tree/ot-loader.php' );
include_once( 'functions/theme-options.php' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Comments     ////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   
   <div class="comment-author-avatar">
   <?php echo get_avatar($comment, $size='64', $default=''); ?>
         
   </div>
   
   <div class="comment-main">
   
     <div class="comment-meta">
     <?php printf(__('<span class="comment-author">Written by: %s</span>', 'essentials'), get_comment_author()) ?>
     <div class="button"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
     </div>   
     
     <div class="comment-content">      
     <?php if ($comment->comment_approved == '0') : ?>
     <p><em><?php _e('Your comment is awaiting moderation.', 'essentials') ?></em></p>
     <?php comment_text() ?>
 
     </div> 
     
     </div>
     
     
     <?php else : { ?>
 
     <?php comment_text() ?>  
     
     <?php } ?>  
     
	 <?php endif; ?>
	 
     
     
     <?php
       }
				
	
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Content width set     ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
if ( ! isset( $content_width ) ) 
    $content_width = 980;
		

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Text Domain     /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_theme_textdomain ('essentials');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Multi Language Ready     ////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
load_theme_textdomain( 'essentials', get_template_directory().'/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);
	

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Contact Form 7     //////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/**
 * Functions:	Optimize and style Contact Form 7 - WPCF7
 *
 */
// Remove the default Contact Form 7 Stylesheet
function remove_wpcf7_stylesheet() {
	remove_action( 'wp_head', 'wpcf7_wp_head' );
}

// Add the Contact Form 7 scripts on selected pages
function add_wpcf7_scripts() {
	if ( is_page('contact') )
		wpcf7_enqueue_scripts();
}

// Change the URL to the ajax-loader image
function change_wpcf7_ajax_loader($content) {
	if ( is_page('contact') ) {
		$string = $content;
		$pattern = '/(<img class="ajax-loader" style="visibility: hidden;" alt="ajax loader" src=")(.*)(" \/>)/i';
		$replacement = "$1".get_template_directory_uri()."/images/ajax-loader.gif$3";
		$content =  preg_replace($pattern, $replacement, $string);
	}
	return $content;
}

// If the Contact Form 7 Exists, do the tweaks
if ( function_exists('wpcf7_contact_form') ) {
	if ( ! is_admin() && WPCF7_LOAD_JS )
		remove_action( 'init', 'wpcf7_enqueue_scripts' );

	add_action( 'wp', 'add_wpcf7_scripts' );
	add_action( 'init' , 'remove_wpcf7_stylesheet' );
	add_filter( 'the_content', 'change_wpcf7_ajax_loader', 100 );
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Include post and page in search     /////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function filter_search($query) {
    if ($query->is_search) {
	$query->set('post_type', array('post', 'page', 'bill', 'mp', 'committee', 'budget', 'motion'));
    };
    return $query;
};
add_filter('pre_get_posts', 'filter_search');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Remove the jump on read more     ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function remove_more_jump_link($link) { 
$offset = strpos($link, '#more-');
if ($offset) {
$end = strpos($link, '"',$offset);
}
if ($end) {
$link = substr_replace($link, '', $offset, $end-$offset);
}
return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Load JS & Stylesheet Scripts     ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'functions/theme-scripts.php' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Theme Options for widget  and metabox   /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
include_once( 'functions/theme-options-widgets.php' );
include_once( 'metaboxes/meta_box.php' );


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Careers post type     /////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
//add_action('init', 'create_careers');

function create_careers() {
    	$careers_args = array(
        	'label' => __('Career Items', 'essentials'),
        	'singular_label' => __('Career Item', 'essentials'),
        	'public' => true,
        	'show_ui' => true,
			'query_var' => true,
        	'rewrite' => true,
			'capability_type' => 'post',
        	'hierarchical' => false,
			'menu_position' => null,
        	'supports' => array('title', 'editor', 'thumbnail', 'comments')
        );
    	register_post_type('careers',$careers_args);
	}

// Field Array
$custom_meta_fields_careers = array(
	array(
            'label' => __('Print Icon Text', 'essentials'),
            'desc' => __('Print This Page.  Leave blank to disable the icon.', 'essentials'),
            'id' => 'printicontext',
            'type' => 'text',
            'std' => ""
        ),
	array(
            'label' => __('Download Icon Text', 'essentials'),
            'desc' => __('Download PDF File.  If you do not upload a file (see below) this text will not appear', 'essentials'),
            'id' => 'downloadicontext',
            'type' => 'text',
            'std' => ""
        ),
	array(
            'label' => __('Attach PDF', 'essentials'),
            'desc' => __('PDF Media Library List.  If you choose not to upload, the text you placed above (Download Icon Text) will not appear.', 'essentials'),
            'id' => 'wp_custom_attachment',
            'type' => 'pdf_list',
            'std' => ""
        )
);

$careers_box = new custom_add_meta_box( 'careers_box', __('Career Data', 'essentials'), $custom_meta_fields_careers, 'careers', true );

	
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Custom taxonomies     ///////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
//add_action( 'init', 'department', 0 );
function department()	{
	register_taxonomy( 
		'department', 
		'careers', 
			array( 
				'hierarchical' => true, 
				'label' => __('Department', 'essentials'),
				'query_var' => true, 
				'rewrite' => array( 'slug' => 'department' ),
			) 
	);
 
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     PAGINATION     //////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function pagination($pages = '', $range = 1)
{ 
     $showitems = ($range * 2)+1; 
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }  
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
 
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }
 
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Slider post type     ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_action('init', 'slider_register');
 
function slider_register() {
 
	$labels = array(
		'name' => __('Slider Images', 'post type general name', 'essentials'),
		'singular_name' => __('Slider Item', 'post type singular name', 'essentials'),
		'add_new' => __('Add New', 'slider item', 'essentials'),
		'add_new_item' => __('Add New Slider Item', 'essentials'),
		'edit_item' => __('Edit Slider Item', 'essentials'),
		'new_item' => __('New Slider Item', 'essentials'),
		'view_item' => __('View Slider Item', 'essentials'),
		'search_items' => __('Search Slider', 'essentials'),
		'not_found' =>  __('Nothing found', 'essentials'),
		'not_found_in_trash' => __('Nothing found in Trash', 'essentials'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
	  ); 
 
	register_post_type( 'slider' , $args );
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Case Study post type     ////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
//add_action('init', 'casestudy_register');
 
function casestudy_register() {
 
	$labels = array(
		'name' => __('Case Study', 'post type general name', 'essentials'),
		'singular_name' => __('Case Study', 'post type singular name', 'essentials'),
		'add_new' => __('Add New', 'case study item', 'essentials'),
		'add_new_item' => __('Add New Case Study Item', 'essentials'),
		'edit_item' => __('Edit Case Study Item', 'essentials'),
		'new_item' => __('New Case Study Item', 'essentials'),
		'view_item' => __('View Case Study Item', 'essentials'),
		'search_items' => __('Search Case Study', 'essentials'),
		'not_found' =>  __('Nothing found', 'essentials'),
		'not_found_in_trash' => __('Nothing found in Trash', 'essentials'),
		'parent_item_colon' => 'Case Study'
	);
 
	$casestudyargs = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','comments')
	  ); 
 
	register_post_type( 'casestudy' , $casestudyargs );
}


////////////////////////////////////////////////////////////////////////////////////////////
/////////////////    Extract first occurance of text from a string     /////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
// Extract first occurance of text from a string
function my_extract_from_string($start, $end, $tring) {
	$tring = stristr($tring, $start);
	$trimmed = stristr($tring, $end);
	return substr($tring, strlen($start), -strlen($trimmed));
}



function get_content_link( $content = false, $echo = false )
{
    // allows using this function also for excerpts
    if ( $content === false )
        $content = get_the_content(); // You could also use $GLOBALS['post']->post_content;

    $content = preg_match_all( '/href\s*=\s*[\"\']([^\"\']+)/', $content, $links );
    $content = $links[1][0];
    $content = make_clickable( $content );

    // if you set the 2nd arg to true, you'll echo the output, else just return for later usage
    if ( $echo === true )
        echo $content;

    return $content;
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Allow Shortcodes in Widgets     /////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_filter('widget_text', 'do_shortcode');


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Remove height/width on images for responsive     ////////////////
////////////////////////////////////////////////////////////////////////////////////////////
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////              Exclude thumbnail from gallery              ////////////
////////////////////////////////////////////////////////////////////////////////////////////
function exclude_thumbnail_from_gallery($null, $attr)
{
    if (!$thumbnail_ID = get_post_thumbnail_id())
        return $null; // no point carrying on if no thumbnail ID

    // temporarily remove the filter, otherwise endless loop!
    remove_filter('post_gallery', 'exclude_thumbnail_from_gallery');

    // pop in our excluded thumbnail
    if (!isset($attr['exclude']) || empty($attr['exclude']))
        $attr['exclude'] = array($thumbnail_ID);
    elseif (is_array($attr['exclude']))
        $attr['exclude'][] = $thumbnail_ID;

    // now manually invoke the shortcode handler
    $gallery = gallery_shortcode($attr);

    // add the filter back
    add_filter('post_gallery', 'exclude_thumbnail_from_gallery', 10, 2);

    // return output to the calling instance of gallery_shortcode()
    return $gallery;
}
add_filter('post_gallery', 'exclude_thumbnail_from_gallery', 10, 2);


////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////    Link Extraction for Post Format Link     /////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
// Extract first occurance of text from a string
if( !function_exists ('extract_from_string') ) :
function extract_from_string($start, $end, $tring) {
	$tring = stristr($tring, $start);
	$trimmed = stristr($tring, $end);
	return substr($tring, strlen($start), -strlen($trimmed));
}
endif;

function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

function cleanup_shortcode_fix($content) {   
          $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']',
            ']<br>' => ']',
			'<br />' => '',
			'<br>' => ''
          );
          $content = strtr($content, $array);
            return $content;
        }
        add_filter('the_content', 'cleanup_shortcode_fix', 10);
		
////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////     Staff post type     /////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
//add_action('init', 'create_staff');

function create_staff() {
	
	$labels = array(
		'name' => __('Staff', 'post type general name', 'essentials'),
		'singular_name' => __('Staff', 'post type singular name', 'essentials'),
		'add_new' => __('Add New', 'staff member', 'essentials'),
		'add_new_item' => __('Add New Staff Member', 'essentials'),
		'edit_item' => __('Edit Staff Member', 'essentials'),
		'new_item' => __('New Staff Member', 'essentials'),
		'view_item' => __('View Staff Member', 'essentials'),
		'search_items' => __('Search Staff', 'essentials'),
		'not_found' =>  __('Nothing found', 'essentials'),
		'not_found_in_trash' => __('Nothing found in Trash', 'essentials'),
		'parent_item_colon' => 'Staff'
	);
	
    	$staff_args = array(
        	'labels' => $labels,
        	'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail','comments')
        );
    	register_post_type('staff',$staff_args);
	}

$fields = array(
	array(
		'label'	=> __('Staff Title', 'essentials'),
		'desc'	=> __('Enter the professional title of this staff member.', 'essentials'),
		'id'	=> 'stafftitle',
		'type'	=> 'text'
	),
	array(
		'label'	=> __('Staff Head Shot Image', 'essentials'),
		'desc'	=> __('Upload your employees head shot image here.  Recommended size is 310px X 400px.', 'essentials'),
		'id'	=> 'staffheadshot',
		'type'	=> 'image'
	),
	array(
		'label'	=> __('Staff Single Page Full Width Image', 'essentials'),
		'desc'	=> __('Upload the full width image that will display on the staff single page.  Recommended size is 980px X your choice of height.', 'essentials'),
		'id'	=> 'stafffullwidthimage',
		'type'	=> 'image'
	),
	array( // Repeatable & Sortable Text inputs
		'label'	=> 'Social Follow', // <label>
		'desc'	=> 'Add as many social follows as you would like.', // description
		'id'	=> 'repeatable', // field id and name
		'type'	=> 'repeatable', // type of field
		'sanitizer' => array( // array of sanitizers with matching kets to next array
			'url' => 'sanitize_text_field'
		),
		'repeatable_fields' => array ( // array of fields to be repeated
			array( // Image ID field
				'label'	=> 'Image', // <label>
				'id'	=> 'repeatable_socailimage', // field id and name
				'type'	=> 'image' // type of field
			),
			'url' => array(
				'label' => 'URL',
				'id' => 'repeatable_socailurl',
				'type' => 'url'
			)
		)
	)
);

/**
 * Instantiate the class with all variables to create a meta box
 * var $id string meta box id
 * var $title string title
 * var $fields array fields
 * var $page string|array post type to add meta box to
 * var $js bool including javascript or not
 */
$sample_box = new custom_add_meta_box( 'sample_box', __('Staff Data', 'essentials'), $fields, 'staff', true );

add_image_size('mp_thumb', 150, 150, true);

?>