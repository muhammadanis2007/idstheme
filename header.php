<!DOCTYPE html>
<html <?php language_attributes(); ?>     >
<head>


<base href="/" > 
 <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <title><?php bloginfo('name'); ?></title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
       
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php 
  echo '<input id="themepath" type="hidden"  value="'.get_stylesheet_directory_uri()."/partials/".'"'. '>';
  wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-migrate');
  ?>
  <?php wp_head();?>
</head>
<body  ng-app="idsapps" >
  
<div class="container" >
<header class="ids-branding" >
  
<h1>
  <img src="<?php echo get_bloginfo('template_directory').'/images/ids-logo.png' ?>" alt="IDS"  />
  <span>Ideas Dot Smart</span>
  </h1>
<?php wp_nav_menu( array( 'theme_location' => 'Main Menu',  'container' => 'nav', 'menu' => 'Main Menu', ) ); ?>

</header>

 