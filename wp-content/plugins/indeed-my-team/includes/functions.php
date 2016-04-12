<?php
function imt_checkupdatecf($custom_field, $value, $post_id){
    //create or update a custom field
    $data = get_post_meta($post_id, $custom_field, TRUE);
    if(isset($data)) update_post_meta($post_id, $custom_field, $value);
    else add_post_meta($post_id, $custom_field, $value, TRUE);
}
function checkIfSelected($val1, $val2, $type){
    // check if val1 is equal with val2 and return an select attribute for checkbox, radio or select tag
    if($val1==$val2){
        if($type=='checkbox') return 'checked="checked"';
        else return 'selected="selected"';
    }else return '';
}
/***********************TEAM FUNCTIONS***************************/
function imt_init_plugin_arr(){
    //SHORTCODE INIT VALUES ARRAY
   $arr = array(
                        'team' => 'all',
                        'order_by' => 'date',
                        'order' => 'ASC',
                        'limit' => 10,
                        'name' => 1,
                        'photo' => 1,
                        'description' => 1,
                        'job' => 1,
                        'email' => 0,
                        'location' => 0,
                        'tel' => 0,
                        'website' => 0,
                        'social_icon' => 1,
                        'skills' => 1,
                        'page_inside' => 0,
   						'tm_custom_href' => 0,
                        'inside_template' => '',
                        'theme' => 'theme_1',
                        'color_scheme' => '',
                        'slider_cols' => 1,
                        'columns' => 4,
   						'hide_small_icons' => 0,
   						'align_center' => 0,
                        //slide opt
                        'slider_set' => 0,
                        'items_per_slide' => 2,
                        'bullets' => 1,
                        'nav_button' => 1,
                        'autoplay' => 1,
                        'stop_hover' => 1,
                        'speed' => 5000,
                        'pagination_speed' => 500,
                        'responsive' => 1,
                        'lazy_load' => 0,
                        'autoheight' => 0,						
                        'loop' => 1,
                        'pagination_theme' => 'pag-theme1',
                        );
    return $arr;
}
function imt_init_widget_arr(){
    //WIDGET INIT VALUES ARRAY
  $arr = array(
                        'team' => 'all',
                        'order_by' => 'title',
                        'order' => 'ASC',
                        'limit' => 3,
                        'page_inside' => 0,
                        'inside_template' => '',
                        'theme' => 'theme_1',
                        'color_scheme' => '',
                        'show' => 'name,photo,description,skills,social_icon',
                        'slider_cols' => 1,
                        'columns' => 1,
                        //slide opt
                        'slider_set' => 0,
                        'items_per_slide' => 2,
                        'slide_opt' => 'bullets,nav_button,autoplay,stop_hover,responsive',
                        'slide_speed' => 500,
                        'slide_pagination_speed' => 500,
              );
  return $arr;
}
function imt_metabox_ti($team){
    $email = esc_html(get_post_meta($team->ID, 'in_team_email', true));
    $telephone = esc_html(get_post_meta($team->ID, 'in_team_telephone', true));
    $location = esc_html(get_post_meta($team->ID, 'in_team_location', true));
    $job_title = esc_html(get_post_meta($team->ID, 'in_team_jobtitle', true));
    $website = esc_html(get_post_meta($team->ID, 'in_team_website', true));
    ?>
    <table class="it-table">
		<tr>
            <td class="it-label"><i class="icon-tags"></i> <?php echo __('Job Title:', 'imt');?> </td>
            <td>
                <input type="text" value="<?php echo $job_title;?>" name="in_team_jobtitle" />
            </td>
        </tr>
        <tr>
            <td class="it-label"><i class="icon-envelope"></i> <?php echo __('E-Mail:', 'imt');?> </td>
            <td>
                <input type="text" value="<?php echo $email;?>" name="in_team_email" />
            </td>
        </tr>
        <tr>
            <td class="it-label"><i class="icon-globe"></i> <?php echo __('Website:', 'imt');?> </td>
            <td>
                <input type="text" value="<?php echo $website;?>" name="in_team_website" />
            </td>
        </tr>
	</table>
	<table class="it-table">
        <tr>
            <td class="it-label"><i class="icon-phone"></i> <?php echo __('Telephone:', 'imt');?> </td>
            <td>
                <input type="text" value="<?php echo $telephone;?>" name="in_team_telephone" />
            </td>
        </tr>
        <tr>
            <td class="it-label" style="vertical-align:top;"><i class="icon-home"></i> <?php echo __('Location:', 'imt');?> </td>
            <td>
                <textarea value="<?php echo $location;?>" name="in_team_location"><?php echo $location;?></textarea>
            </td>
        </tr>
    </table>
	<div class="clear"></div>
<?php
}

function imt_metabox_tsm($team){
    $fb_link = esc_html(get_post_meta($team->ID, 'indeed_fb_lnk', true));
    $tw_link = esc_html(get_post_meta($team->ID, 'indeed_tw_lnk', true));
    $lk_link = esc_html(get_post_meta($team->ID, 'indeed_ld_lnk', true));
    $g_link = esc_html(get_post_meta($team->ID, 'indeed_gp_lnk', true));
    $isg_link = esc_html(get_post_meta($team->ID, 'indeed_ins_lnk', true));
    ?>
    <table class="it-table">
        <tr>
            <td class="it-label"><i class="icon-share"></i> Facebook: </td>
            <td>
                <input type="text" value="<?php echo $fb_link;?>" name="indeed_fb_lnk" />
            </td>
        </tr>
        <tr>
            <td class="it-label"><i class="icon-share"></i> Twiter: </td>
            <td>
                <input type="text" value="<?php echo $tw_link;?>" name="indeed_tw_lnk" />
            </td>
        </tr>
        <tr>
            <td class="it-label"><i class="icon-share"></i> Linkedin: </td>
            <td>
                <input type="text" value="<?php echo $lk_link;?>" name="indeed_ld_lnk" />
            </td>
        </tr>
	</table>
	<table class="it-table">
        <tr>
            <td class="it-label"><i class="icon-share"></i> Google: </td>
            <td>
                <input type="text" value="<?php echo $g_link;?>" name="indeed_gp_lnk" />
            </td>
        </tr>
        <tr>
            <td class="it-label"><i class="icon-share"></i> Instagram: </td>
            <td>
                <input type="text" value="<?php echo $isg_link;?>" name="indeed_ins_lnk" />
            </td>
         </tr>
     </table>
	 <div class="clear"></div>

 <?php
}

function imt_save_post_meta_values($post_id){
	$arr = array(
				  	'indeed_fb_lnk',
					'indeed_tw_lnk',
					'indeed_ld_lnk',
					'indeed_gp_lnk',
					'indeed_ins_lnk',
					'indeed_author_id',
					'in_team_email',
					'in_team_telephone',
					'in_team_location',
					'in_team_jobtitle',
					'in_team_website',
					'indeed_team_skill_0',
					'indeed_team_skill_1',
					'indeed_team_skill_2',
					'indeed_team_skill_3',
					'indeed_skill_percent_0',
					'indeed_skill_percent_1',
					'indeed_skill_percent_2',
					'indeed_skill_percent_3',
					'imt_team_href',
					'imt_team_href-custom',
					);
	foreach($arr as $k){
		if( isset($_REQUEST[ $k ]) ) imt_checkupdatecf($k, $_REQUEST[$k], $post_id);
	}
	//echo '<pre>';
	//print_r($_REQUEST);
	//die();
}


function imt_metabox_ts($team){
    for($i=0;$i<4;$i++){
        $skill_arr[] = esc_html(get_post_meta($team->ID, 'indeed_team_skill_'.$i, true));
        $percent[] = esc_html(get_post_meta($team->ID, 'indeed_skill_percent_'.$i, true));
    }
    ?>
    <table class="it-table">
    <?php
        foreach($skill_arr as $k=>$skill){
    ?>
              <tr>
                  <td class="it-label"><i class="icon-check"></i> <?php echo __('Skill Name:', 'imt');?> </td>
                  <td>
                      <input type="text" value="<?php echo $skill;?>" name="indeed_team_skill_<?php echo $k;?>" />
                  </td>
                  <td> - </td>
                  <td>
                      <input type="number" min="0" max="100" value="<?php echo $percent[$k];?>" name="indeed_skill_percent_<?php echo $k;?>" style="width:45px; min-width:45px;" />%
                  </td>
              </tr>
    <?php
        }
    ?>
    </table>
	<div class="clear"></div>
    <?php
}


function imt_general_settings_meta(){
	$arr = array(
			'imt_responsive_settings_small' => 1,
			'imt_responsive_settings_medium' => 2,
			'imt_responsive_settings_large' => 'auto',
			'imt_custom_page_entry_infos' => 'name,photo,description,job,email,location,tel,website,social_icon,skills',
			'imt_custom_css' => '',
			'imt_latest_posts' => 0,		
			'imt_target_blank' => 0,	
	);
	foreach($arr as $key=>$value){
		if(get_option($key)!==FALSE){
			$arr[$key] = get_option($key);
		}
	}
	return $arr;
}

function imtSelectAuthorMetaBox($team){
	$author = esc_html(get_post_meta($team->ID, 'indeed_author_id', true));
	?>
		 <div>
			<?php 
				$authors = imt_get_wp_users();
			?>
		 	<select name="indeed_author_id" style="width: 50%;">
		 		<option value=''>...</option>
		 		<?php 
		 			foreach($authors as $k=>$v){
		 				$selected = '';
		 				if($k==$author) $selected = 'selected="selected"';
		 				?>
		 				<option value="<?php echo $k;?>" <?php echo $selected;?> ><?php echo $v;?></option>	
		 				<?php 
		 			}
		 		?>
		 	</select>
		 </div>	
	<?php 
}

function imt_save_update_metas(){
	$arr = imt_general_settings_meta();
	foreach($arr as $key=>$value){
		if(get_option($key)!==FALSE){
			update_option($key, $_REQUEST[$key]);
		}else{
			add_option($key, $_REQUEST[$key]);
		}
	}
}

function imt_return_infos_str_for_template(){
		global $post;
		$str = array(   'name'=>'',
						'photo'=>'',
						'description'=>'',
						'job'=>'',
						'email'=>'',
						'website'=>'',
						'tel'=>'',
						'location'=>'',
						'social_icon'=>array('fb'=>'','tw'=>'', 'ld'=>'', 'gp'=>'','ins'=>''),
						'skills'=>'',
						'author_id' => '',  
					 );
		$entry_info = get_option('imt_custom_page_entry_infos');
		if($entry_info===FALSE){
			$arr = imt_general_settings_meta();
			$entry_info = $arr['imt_custom_page_entry_infos'];
		}
			$infos = explode(',', $entry_info);
			////NAME
			if(in_array('name', $infos)) $str['name'] = get_the_title($post->ID);
			////PHOTO
			if(in_array('photo', $infos))$str['photo'] = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', false, '' );
			////DESCRIPTION
			if(in_array('description', $infos))$str['description'] = $post->post_content;
			////JOB
			if(in_array('job', $infos)) $str['job'] = get_post_meta( $post->ID, 'in_team_jobtitle', true );
			////EMAIL
			if(in_array('email', $infos)) $str['email'] = get_post_meta( $post->ID, 'in_team_email', true );
			////WEBSITE
			if(in_array('website', $infos)) $str['website'] = get_post_meta( $post->ID, 'in_team_website', true );
			////TELEPHONE
			if(in_array('tel', $infos)) $str['tel'] = get_post_meta( $post->ID, 'in_team_telephone', true );
			////LOCATION
			if(in_array('location', $infos)) $str['location'] = get_post_meta( $post->ID, 'in_team_location', true );			
			////SOCIAL ICON
			if(in_array('social_icon', $infos)) {
					$str['social_icon']['fb'] = get_post_meta( $post->ID, 'indeed_fb_lnk', true );
					$str['social_icon']['tw'] = get_post_meta( $post->ID, 'indeed_tw_lnk', true );
					$str['social_icon']['ld'] = get_post_meta( $post->ID, 'indeed_ld_lnk', true );
					$str['social_icon']['gp'] = get_post_meta( $post->ID, 'indeed_gp_lnk', true );
					$str['social_icon']['ins'] = get_post_meta( $post->ID, 'indeed_ins_lnk', true );	
			}	
			////SKILLS
			if(in_array('skills', $infos)) {
				$skill_arr = array();
            	$percent = array();
				$skill_str = "";
            	for($i=0;$i<4;$i++){
                	$skill_arr[] = get_post_meta($post->ID, 'indeed_team_skill_'.$i, true);
                	$percent[] = get_post_meta($post->ID, 'indeed_skill_percent_'.$i, true);
            	}
				foreach($skill_arr as $k=>$skill){
                if(!empty($skill)) $skill_str .= "<div class=\"skill-label\">$skill</div><div class=\"skill-prog\"><div class=\"fill\" data-progress-animation=\"{$percent[$k]}%\"data-appear-animation-delay=\"400\" style=\"width:{$percent[$k]}%;\"></div></div>";
           		 }
				$str['skills'] = $skill_str;	
			}	
			$latest_posts = get_option('imt_latest_posts');
			if(isset($latest_posts) && $latest_posts==1){
				$author = get_post_meta($post->ID, 'indeed_author_id', TRUE);
				if(isset($author) && $author!=''){
					$str['author_id'] = $author;
				}
			}					
		return $str;
}

function imt_reorder_by_last_name($arr, $order){
	$temp_arr = array();
	$j = 0;
	foreach($arr as $obj){
		$name = get_the_title($obj->ID);
		try{
			$name_arr = explode(' ', $name);
			if(isset($name_arr[1]) && $name_arr[1]!=''){
				$name = $name_arr[1].$name_arr[0];
			}
		}catch(Exception $e){
			//
		}
		if(isset($name) && $name!='' ){
			if(array_key_exists($name, $temp_arr)){
				$temp_arr[$name.$j] = $obj;
				$j++;
			}else{
				$temp_arr[$name] = $obj;	
			}
		}
		else $temp_arr[] = $obj;
	}
	if($order=='ASC') ksort($temp_arr);
	else krsort($temp_arr);
	return $temp_arr;
}

function imt_get_wp_users(){
	$arr = array();
	$authors = get_users();
	foreach($authors as $author){
		if( isset($author->ID) && isset($author->user_nicename) ){
			$arr[$author->ID] = $author->user_nicename;
		}
	}
	return $arr;
}

function imt_admin_get_all_themes(){
	//standard themes
	$handle = opendir( IMT_DIR_PATH . 'themes' );
    while (false !== ($entry = readdir($handle))) {
		if ($entry!='.' && $entry!='..'){
            $arr_str = explode('_', $entry);
            $themes_arr[$arr_str[1]] = $arr_str[0];
        }
    }
    ksort($themes_arr);
    
	//special themes
	$plugins_arr = array('indeed-my-team-theme-pack');//list of plugins where to search for themes
	foreach ($plugins_arr as $name){
		$plugin_dir = str_replace('indeed-my-team', $name, IMT_DIR_PATH );
		if (file_exists($plugin_dir)){
			$handle = opendir( $plugin_dir . 'themes' );
			while (false !== ($entry = readdir($handle))) {
				if ($entry!='.' && $entry!='..'){
					$arr_str = explode('_', $entry);
					$themes_arr[$arr_str[1]] = $arr_str[0];
				}
			}			
		}
	}

	return $themes_arr;
}

function imtCustomHrefMetaBox(){
	global $post;
	$data = '';
	$data = get_post_meta($post->ID, 'imt_team_href', TRUE);
	$arr = imt_get_all_pages_and_posts();
	$arr[-2] = 'None';
	$arr[-1] = 'Custom Link ...';
	ksort($arr);
	?>
		<div>
			Select an option:
			<select name="imt_team_href" onChange="imtTeamCustomHref(this.value, '#imt_custom_href_div');">
				<?php 
					foreach ($arr as $k=>$v){
						?>
							<option value="<?php echo $k;?>" <?php if ($k==$data) echo 'selected';?> ><?php echo $v;?></option>
						<?php 	
					}
				?>
			</select>
		</div>
		<?php 
			/////custom href	
		$custom = get_post_meta($post->ID, 'imt_team_href-custom', TRUE);
		?>
			<div style="margin-top: 10px;<?php if ($data<1 && $data != '') echo 'display: block;'; else echo 'display:none;'?>" id="imt_custom_href_div">
				<strong>Custom Link:</strong>  
				<input type="text" value="<?php echo $custom;?>" name="imt_team_href-custom" style="min-width: 303px;"/>
			</div>
		<?php 	 
}

function imt_get_all_pages_and_posts(){
	$arr = array();
	$args = array(
					'posts_per_page' => -1,
					'sort_order' => 'ASC',
					'sort_column' => 'post_title',
	    			'post_type' => array( 'page', 'post' ),
	    			'orderby' => 'menu_order',
					'post_status' => 'publish',
	);
	$items = new WP_Query( $args );
	
	if (isset($items->posts) && count($items->posts)){
		foreach ($items->posts as $item){
			if ($item->post_title=='') $item->post_title = '(no title)';
			$arr[$item->ID] = $item->post_title;
		}
	}
	return $arr;	
}