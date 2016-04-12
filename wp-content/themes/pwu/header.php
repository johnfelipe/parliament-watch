<!DOCTYPE HTML>

<html <?php language_attributes(); ?>>

<!--[if IE 7 ]>    <html class= "ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class= "ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class= "ie9"> <![endif]-->

<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->

<title><?php echo get_option('blogname'); ?><?php wp_title(); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="format-detection" content="telephone=no">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<?php
if ( function_exists( 'get_option_tree') ) {
  $specstyle = get_option_tree( 'vn_specstyle' );
  }
?>
<link href="http://parliamentwatch.ug/wp-content/themes/pwu/css/font-awesome.css" rel="stylesheet">

<?php if ($specstyle != ('')){ ?>

<link href="<?php echo ($specstyle); ?>" rel="stylesheet" type="text/css" media="screen" />

<?php } else { ?>

<link href="<?php bloginfo('stylesheet_url').'?v=434354' ?>" rel="stylesheet" type="text/css" media="screen" />

<?php } ?>

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

 <!-- *************************************************************************
*****************                FAVICON               ********************
************************************************************************** -->

<?php
if ( function_exists( 'get_option_tree') ) {
  $favicon = get_option_tree( 'vn_favicon' );
}
?>
<link rel="shortcut icon" href="<?php echo ($favicon); ?>" />

<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- *************************************************************************
*****************              CUSTOM CSS              ********************
************************************************************************** -->


<style type="text/css">
<?php
if ( function_exists( 'get_option_tree') ) {
  $css = get_option_tree( 'vn_customcss' );
}
?>
<?php echo ($css); ?>

</style>
<script  type="text/javascript" src="http://parliamentwatch.ug/wp-content/plugins/tablefilter/tablefilter.js"></script>
<script  type="text/javascript" src="http://parliamentwatch.ug/wp-content/themes/pwu/js/jquery-1.12.0.min.js "></script>
<script type="text/javascript" src="http://parliamentwatch.ug/wp-content/themes/pwu/js/bootstrap.min.js "></script>
<link href="http://parliamentwatch.ug/wp-content/themes/pwu/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<!--
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
 -->
<style type="text/css">
<!--
.even {background: #ccc;}
-->
</style>

<script type="text/javascript">
 $(document).ready(function(){
 $("tr:even").addClass("even");
 });
</script>
<?php wp_head(); ?>

</head>

<?php $theme_options = get_option('option_tree'); ?>

<body <?php body_class(); ?>>

    <div class="row">



<!-- Start of top wrapper -->
<!-- <div id="top_wrapper">

</div> End of top wrapper -->

<!-- Start of header wrapper -->
<div id="header_wrapper">

<!-- Start of content wrapper -->
<div class="content_wrapper">

<!-- Start of logo -->
<div id="logo" class = "pull-left">
<a href="<?php echo site_url(); ?>"><?php
if ( function_exists( 'get_option_tree' ) ) {
$logopath = get_option_tree( 'vn_toplogo' );
} ?><img src="<?php echo $logopath; ?>" alt="logo" /></a>

</div><!-- End of logo -->

    <!-- Start of searchbox -->
<div id="searchbox" class= " pull-right">

<!-- Start of search box -->
<?php get_search_form(); ?>
<!-- End of searchbox -->

</div><!-- End of searchbox -->

<!-- Start of top menu wrapper -->
<div class="topmenuwrapper">

<!-- Start of topmenu -->
<nav class="topmenu">

<?php wp_nav_menu(
array(
'menu_class' => 'sf-menu',
'theme_location'  => 'primary',
)
);
?>

</nav><!-- End of topmenu -->

<?php
if ( function_exists( 'get_option_tree' ) ) {
$telephonenumber = get_option_tree( 'vn_telephonenumber' );
} ?>

<?php if ($telephonenumber != ('')){ ?>

<!-- Start of header phone -->
<div class="header_phone">
<?php echo stripslashes($telephonenumber); ?>

</div><!-- End of header phone -->

<?php } else { } ?>

<!-- Clear Fix --><div class="clear"></div>

</div><!-- End of top menu wrapper -->
