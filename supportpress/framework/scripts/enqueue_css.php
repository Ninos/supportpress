<?php
/**
 * Enqueue CSS
*/

/*--------------------------------------*/
/* Stylesheets
/*--------------------------------------*/
add_action('wp_enqueue_scripts', 'prth_enqueue_css');
function prth_enqueue_css() {
	
	global $itdata; //get global variables
	$current_dir = it_FRAMEWORK_DIR . '/scripts'; //current directory
	
	//PressThemes framework CSS
	wp_enqueue_style('framework', $current_dir . '/css/framework.css', 'style');
	
	//Responsive CSS
	wp_enqueue_style('framework-responsive', $current_dir . '/css/framework_responsive.css', 'style');
	
	//Theme Main css
	wp_enqueue_style('style', get_stylesheet_uri(), 'style');
	
}
?>