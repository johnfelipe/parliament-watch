<?php 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'tws_themesScripts' ) ) :

class tws_themesScripts{
	
	function __construct(){
	
		add_action( 'init', array( $this, 'register_scripts' ));

		add_action( 'wp_enqueue_scripts', array( $this , 'enqueue_styles' ) , 1 );
				
		add_action('wp_enqueue_scripts', array( $this ,  'enqueue_scripts' ));

	}
	

	/**
	 * Registers all scripts
	 * 
	 * @access public
	 * @return void
	 */
	function register_scripts(){	
		wp_register_style( 'tws-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic' , array(), '1.0' , false  );
        wp_register_style( 'ticker-style', get_template_directory_uri().'/css/ticker-style.css');

		wp_register_script('retina', get_template_directory_uri().'/js/retina.js', array('jquery'),'1.0', true );
		wp_register_script('easing', get_template_directory_uri().'/js/jquery.easing.1.3.js', array('jquery'),'1.0', true );
		wp_register_script('hover', get_template_directory_uri().'/js/hoverIntent.js', array('jquery'),'1.0', true );
		wp_register_script('commentvaljs', get_template_directory_uri().'/js/jquery.validate.pack.js', array('jquery'),'1.0', true );
		wp_register_script('commentval', get_template_directory_uri().'/js/comment-form-validation.js', array('jquery'),'1.0', true );
		wp_register_script( 'slider', get_template_directory_uri(). '/js/jquery.flexslider-min.js', array('jquery' ),'1.0', true );
		wp_register_script( 'menu', get_template_directory_uri(). '/js/jquery.sfmenu.js', array('jquery' ),'1.0', true );
        wp_register_script( 'ticker', get_template_directory_uri(). '/js/jquery.ticker.js', array('jquery' ),'1.0', true );
	}


	/**
	* Enqueue Theme Styles 
	*
	* @since 1.0
	* @access public
	* @return void
	*/
	function enqueue_styles() {
		if (is_admin()) {
			return;
		}
	
		if (!is_admin()) {
			//Load the main style.css
			wp_enqueue_style( 'tws-styles' );
			wp_enqueue_style( 'tws-opensans' );
            wp_enqueue_style( 'ticker-style' );
		}		
	}


	/**
	* Enqueue all frontend scripts
	*
	* @since 1.0
	* @access public
	* @return void
	*/
	
	function enqueue_scripts() {
		if (is_admin()) {
			return;
		}
	
		// If we're not in admin, lets do fun stuff
		if (!is_admin()){
			wp_enqueue_script( 'jquery');
			wp_enqueue_script( 'retina');
			wp_enqueue_script( 'easing' );
			wp_enqueue_script( 'hover' );
			wp_enqueue_script( 'commentvaljs' );
			wp_enqueue_script( 'commentval' );
			wp_enqueue_script( 'menu' );
			wp_enqueue_script( 'slider' );
	        wp_enqueue_script( 'ticker' );
		}
	
	}
	
}//end class

endif;

$tws_themes_scripts = new tws_themesScripts();

?>