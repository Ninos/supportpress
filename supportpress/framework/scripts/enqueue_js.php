<?php
/**
 * Enqueue jQuery Scripts
*/

add_action('wp_enqueue_scripts','prth_framework_scripts_function');
function prth_framework_scripts_function() {
	
	global $itdata; //get global variables
	$js_dir = it_FRAMEWORK_DIR . '/scripts/js'; //current directory
	
	//core
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('easing', $js_dir .'/easing.js', array('jquery'), '1.3', true);
	wp_enqueue_script('hoverIntent', $js_dir .'/hoverintent.js', array('jquery'), 'r6', true);
	wp_enqueue_script('superfish', $js_dir .'/superfish.js', array('jquery'), '1.4.8', true);
	wp_enqueue_script('flexslider', $js_dir .'/flexslider-min.js', array('jquery'), '2', true);

	//comments
	if(is_single() || is_page()) {
		wp_enqueue_script('comment-reply');
	}

	//google map
	wp_register_script('googlemap', $js_dir .'/googlemap.js', array('jquery'), '', true);
	wp_register_script('googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'), '', true);
}
?>