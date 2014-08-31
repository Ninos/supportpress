<?php
/**
 * IcarusThemes
 */
 
 
global $itdata; //get theme options
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />


<!-- Responsive CSS
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--[if lt IE 9]>
	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->


<?php if(!empty($itdata['custom_fav'])) { ?>
<!-- Custom Favicon
================================================== -->
<link rel="icon" type="image/png" href="<?php echo $itdata['custom_fav']; ?>" />
<?php } ?>


<!-- Title
================================================== -->
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' |'; } ?> <?php bloginfo('name'); ?></title>


<!-- IE Fixes
================================================== -->
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lte IE 7]>
	<script src="js/IE8.js" type="text/javascript"></script><![endif]-->
<!--[if lt IE 7]>
	<link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/>
<![endif]-->
<!--[if IE 7]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie7.css" media="screen" />
<![endif]-->
<!--[if IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie8.css" media="screen" />
<![endif]-->


<?php
//header analytics code
echo stripslashes($itdata['analytics_header']);
?>
<!-- WP Head
================================================== -->
<?php wp_head(); ?>

</head><!-- /end head -->

<!-- Begin Body
================================================== -->
<body <?php body_class('body '. $itdata['color_option'] .''); ?>>


    <div id="topbar" <?php if($itdata['topbar_position'] == 'fixed') { echo 'class="topbar-fixed"'; } ?>>
        <div id="topbar-inner" class="outer-container clearfix">
        
                <nav id="top-navigation">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'top_menu',
                        'menu_class' => 'top-menu-nav sf-menu',
                        'sort_column' => 'menu_order',
                        'fallback_cb' => false,
                        'walker' => new prth_menu_walker()
                    )); ?>
                </nav><!-- /topbar-nav -->


         
			    <div id="header-right">
			    	<div id="logo">
				        <?php if($itdata['custom_logo']) { ?>
				            <a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><img src="<?php if ($itdata['custom_logo'] == '' ) { echo get_template_directory_uri() . '/images/logo.png'; } else { echo $itdata['custom_logo']; } ?>" alt="<?php get_bloginfo( 'name' ) ?>" /></a>
				        <?php } else { ?>
				        	 <h2><a href="<?php echo home_url(); ?>/" title="<?php get_bloginfo( 'name' ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a></h2>
				        <?php } ?>
					</div>
			    </div><!-- /header-right -->
			         
			         
         
         

