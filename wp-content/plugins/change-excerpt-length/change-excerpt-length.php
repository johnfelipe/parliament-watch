<?php
/*
Plugin Name: Change Excerpt Length
Plugin URI: http://learnwebtipz.com/
Description: Adds an Excerpt Length field setting to the <a href="options-reading.php">Reading Settings</a> section. This value is used to specify the number of words that you would like to appear in the <a href="http://codex.wordpress.org/Template_Tags/the_excerpt" rel="external">the_excerpt()</a>.
Author: ShinoRex
Version: 1.0
Author URI: http://learnwebtipz.com/
*/

function sh_excerpt_length_init() {
	add_settings_field( 'sh-excerpt-length-field', 'Excerpt Length', 'sh_excerpt_length_field_callback_function', 'reading', 'default', array( 'label_for' => 'sh-excerpt-length-field' ) );

	register_setting( 'reading', 'sh-excerpt-length-value', 'intval' );
}

function sh_excerpt_length_field_callback_function() {
	$excerpt_length = get_option( 'sh-excerpt-length-value', 55 );
	
	if ( '' == $excerpt_length || '0' == $excerpt_length )
		$excerpt_length = 55; //  default exceprt value
	
	echo "<input type='text' name='sh-excerpt-length-value' id='sh-excerpt-length-field' value='$excerpt_length' />\n";
	echo '<span class="setting-description">The number of words that you want to show in <a href="http://codex.wordpress.org/Template_Tags/the_excerpt" rel="external">the_excerpt()</a></span>';
}


function sh_excerpt_length( $default_value ) {
	$excerpt_length = get_option( 'sh-excerpt-length-value' );
	return ( '' != $excerpt_length && '0' != $excerpt_length ) ? $excerpt_length : $default_value;
}


function filter_plugin_meta($links, $file) {
	if ( $file == plugin_basename( __FILE__ ) )
		return array_merge( $links, array( sprintf( '<a href="options-reading.php">%s</a>', __('Settings') ) ) );
	return $links;
}

add_action( 'admin_init', 'sh_excerpt_length_init' );
add_filter( 'excerpt_length', 'sh_excerpt_length' );
add_filter( 'plugin_row_meta', 'filter_plugin_meta', 10, 2 );
?>
