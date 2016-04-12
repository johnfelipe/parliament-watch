<?php
function generate_data(){
    if($_GET['action'] == 'gen'){
        set_time_limit(0);
        include_once 'autoload.php';
        $faker = Faker\Factory::create();
        $phone_prefix = array(
            '077',
            '071',
            '078',
            '079',
            '070',
            '075',
            '074',
            '0414',
            '031'
        );
        
        $photos = range(1125, 1136);
        
        $years = range(2000, 2013);
        $months = range(1, 12);
        $days = range(1,25);
        
        /*$dir = 'C:/xampp/htdocs/watch/files';
        $docs = scandir($dir);
        $files = array();
        foreach($docs as $f){
            if(strlen($f) > 10){
                $files[] = $f;
            }
        }*/
        
        /*$status = get_terms('budget_status', array('hide_empty' => 0, 'orderby' => 'id', 'order' => 'id'));
        $motions = get_posts(array('post_type' => 'motion', 'posts_per_page' => -1, 'orderby' => 'rand'));*/
        //$parliaments = get_terms('mp_parliament', array('hide_empty' => 0));
        /*$bill_tags = get_terms('bill_tag', array('hide_empty' => 0));
        $bills = get_posts(array('post_type' => 'bill', 'posts_per_page' => -1));*/
        //$committees = get_posts(array('post_type' => 'committee', 'posts_per_page' => -1/*, 'tax_query' => array(array('taxonomy'=>'committee_type','field'=>'term_id','terms'=>194))*/));
        /*$types = get_terms('meeting_type', array('hide_empty' => 0));
        $origins = array('New', 'Motion or Petition');*/
        
        $post_type = 'post';

        for($i = 0; $i < 50; $i++){
            $title = get_random_sentence(rand(3, 5));
            $url = strtolower(str_replace(' ', '', $title));
            $thumb_id = $photos[array_rand($photos)];
            $content = $faker->sentence(60);
            $phone = $phone_prefix[rand(0, count($phone_prefix) - 1)].''.$faker->randomNumber(7);
            $address = get_random_address();
            $lat = $min_lat + ((mt_rand() / mt_getrandmax()) * $lat_span);
            $lon = $min_lon + ((mt_rand() / mt_getrandmax()) * $lon_span);
            $email = $faker->email;
            $web = 'wwww.'.$faker->domainWord.'.'.$faker->tld;
            $facebook = 'http://www.facebook.com/'.$url;
            $twitter = 'http://www.twitter.com/'.$url;
            
            /*$tags = array_rand($bill_tags, rand(2, 4));
            $b_t = array();
            foreach($tags as $tt){
                $b_t[] = $bill_tags[$tt]->name;
            }*/
            $y = $years[array_rand($years, 1)];
            $m = $months[array_rand($months, 1)];
            $d = $days[array_rand($days, 1)];
            $date = $y.str_pad($m,2,'0', STR_PAD_LEFT).str_pad($d,2,'0', STR_PAD_LEFT);
            //echo 'Date -> '.$date.'<br/>';
            /*$c = $committees[array_rand($committees)]->ID;
            $m = $motions[array_rand($motions)]->ID;
            $b = $bills[array_rand($bills)]->ID;*/
            
            //$mover = $mps[array_rand($mps)]->ID;
            
            //$s = $status[array_rand($status)]->term_id;
        
            /*$t = $types[array_rand($types)]->term_id;
            $old = get_page_by_title($name, ARRAY_A, $post_type);
            if(!empty($old)){
                continue;
            }*/
            $post = array(
                'post_title' => $title,
                'post_content' => $content,
                'post_type' => $post_type,
                'post_status' => 'publish',
                'post_category' => array(260),
                'post_date' => $date
            );
            
            $post_id = wp_insert_post($post);
            
            //update_post_meta($post_id, '_thumbnail_id', $thumb_id, true);
            //update_post_meta($post_id, 'facebook', $facebook, true);
            //update_post_meta($post_id, 'twitter', $twitter, true);
            //update_post_meta($post_id, 'constituency', get_random_sentence(rand(2, 3)), true);
            update_post_meta($post_id, '_committee', 'field_54d5548a7d927');
            update_post_meta($post_id, 'committee', 1924);
            //update_post_meta($post_id, '_date', 'field_54d555cd21d67');
            //update_post_meta($post_id, 'date', $date);
            //update_post_meta($post_id, '_motion_or_petition', 'field_54b594430a590');
            //update_post_meta($post_id, 'motion_or_petition', $m);
            //update_post_meta($post_id, 'temp_doc', home_url().'/files/'.$files[array_rand($files)]);
            
            //wp_set_object_terms($post_id, intval($t), 'meeting_type');
            //wp_set_object_terms($post_id, $b_t, 'bill_tag');
            
            //wp_update_post(array('ID' => $thumb_id, 'post_parent' => $post_id)); //attach thumbnail to post
        }
        echo 'Done...!';
        exit();
    }
}
    
//add_action('init', 'generate_data', 100);

function get_random_company(){
    include_once 'autoload.php';
    $faker = Faker\Factory::create();
    return $faker->company;
}

function get_random_period(){
    include_once 'autoload.php';
    $faker = Faker\Factory::create();
    return $faker->date($format = 'M, Y', $max = 'now').' - '.$faker->date($format = 'M, Y', $max = 'now');
}

function get_random_address(){
    include_once 'autoload.php';
    $faker = Faker\Factory::create();
    return $faker->streetAddress;
}

function get_random_email(){
    include_once 'autoload.php';
    $faker = Faker\Factory::create();
    return str_replace(' ', '', strtolower(get_the_title())).'@'.$faker->freeEmailDomain();
}

function get_random_civil_status(){
    $status = array(
        'Single',
        'Married',
        'Divorced'
    );
    return $status[rand(0, count($status) - 1)];
}

function get_random_gender(){
    $gender = array(
        'Male',
        'Female',
    );
    return $gender[rand(0, count($gender) - 1)];
}

function get_random_dob(){
    include_once 'autoload.php';
    $faker = Faker\Factory::create();
    return $faker->date($format = 'd M, Y', $max = 'now');
}

function get_random_sentence($count){
    include_once 'autoload.php';
    $faker = Faker\Factory::create();
    return $faker->sentence($count);
}

function get_random_district(){
    $districs = array(
            'Maracha',
            'Arua',
            'Moyo',
            'Adjumani',
            'Nebbi',
            'Yumbe',
            'Zombo',
            'Koboko',
            'Apac',
            'Gulu',
            'Kole',
            'Nwoya',
            'Agago',
            'Kitgum',
            'Lira',
            'Pader',
            'Amolatar',
            'Dokolo',
            'Amuru',
            'Oyam', 
            'Lamwo',
            'Otuke',
            'Alebtong',
            'Bundibugyo',
            'Hoima', 
            'Kabarole', 
            'Kasese',
            'Kibaale', 
            'Masindi',
            'Kamwenge',
            'Kyenjojo',
            'Buliisa', 
            'Kyegegwa', 
            'Kiryandongo',
            'Ntoroko',
            'Mbarara',
            'Ntungamo', 
            'Busheny',
            'Kabale', 
            'Kisoro',
            'Rukungiri', 
            'Kanungu', 
            'Ibanda',
            'Isingiro', 
            'Kiruhura',
            'Mitooma',
            'Buhweju', 
            'Sheema',
            'Rubirizi',
            'Sironko', 
            'Kamuli', 
            'Iganga', 
            'Jinja',
            'Pallisa',
            'Tororo',
            'Mayuge',
            'Bugiri',
            'Busia', 
            'Butaleja', 
            'Manafwa',
            'Kaliro',
            'Budaka',
            'Namutumba',
            'Bududa',
            'Kibuku',
            'Bulambuli',
            'Mbale',
            'Buyende', 
            'Luuka',
            'Namayingo',
            'Kween',
            'Napak',
            'Ngora',
            'Kapchorwa',
            'Kotido',
            'Kumi',
            'Moroto',
            'Soroti',
            'Katakwi',
            'Kaberamaido',
            'Nakapiripirit',
            'Amuria',
            'Bukwo',
            'Kaabong',
            'Serere',
            'Abim',
            'Amudat',
            'Bukedea',
            'Kampala',
            'Kiboga',
            'Kayunga',
            'Buvuma',
            'Mukono',
            'Nakasongola',
            'Luweero',
            'Buikwe',
            'Kyankwanzi',
            'Nakaseke',
            'Kalungu',
            'Lwengo',
            'Kalangala',
            'Lyantonde',
            'Wakiso',
            'Gomba',
            'Bukomansimbi',
            'Butambala',
            'Masaka',
            'Mpigi',
            'Rakai',
            'Ssembabule',
            'Mityana',
            'Mubende'
        );
        
        return $districs[rand(0, count($districs) -1)];
}

?>