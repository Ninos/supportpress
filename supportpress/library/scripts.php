<?php
/**
 * Load css and jquery for current theme
*/

//hook function
add_action('wp_enqueue_scripts','theme_specific_scripts');

//start function
function theme_specific_scripts() {
	
	global $itdata; //get global variables


	/* jQuery */

	//services
	if(is_page_template('template-services.php') || is_tax('services_cats')) {
		wp_enqueue_script('servicesinit', it_JS_DIR .'/services.js', array('jquery'), '2.0', true);
	}

	//portfolio - listing
	if(is_page_template('template-portfolio-with-filter.php') || is_page_template('template-portfolio-filter-sidebar.php')) {
		wp_enqueue_script('quicksand', it_JS_DIR .'/quicksand.js', array('jquery','easing'), '1.2.2', true);
		wp_enqueue_script('quicksand-portfolio', it_JS_DIR .'/quicksand_portfolio.js', array('jquery','easing','quicksand'), '1.0', true);
	}
	
	//portfolio - single
	if(get_post_type() == 'portfolio') {
		wp_enqueue_script('single-portfolio', it_JS_DIR .'/single_portfolio.js', array('jquery'), '1.0', true);
	}
	
	//FAQs
	if(is_page_template('template-faqs.php') || is_tax('faqs_cats')) {
		wp_enqueue_script('toggle-faqs', it_JS_DIR .'/toggle_faqs.js', array('jquery','easing'), '1.0', true);
	}
	
	//prettyphoto lightbox
	if($itdata['prettyphoto_show_hide'] !='disable') {
		
		wp_enqueue_script('prettyphoto', it_JS_DIR .'/prettyphoto.js', array('jquery'), '3.1.4', true);
		wp_enqueue_style('prettyphoto', it_CSS_DIR . '/prettyphoto.css', 'style', true);
		
		
		//localize lightbox
		$lightbox_params = array(
			'theme' => $itdata['prettyphoto_theme'],
			'title' => $itdata['prettyphoto_title'],
			'resize' => $itdata['prettyphoto_resize'],
			'slideshow' => $itdata['prettyphoto_slideshow'],
			'opacity' => $itdata['prettyphoto_opacity'],
			'width' => $itdata['prettyphoto_width'],
			'height' => $itdata['prettyphoto_height']
		);
		wp_localize_script( 'prettyphoto', 'lightboxLocalize', $lightbox_params );
	
	} //else prettyphoto disabled
	

	//Responsive
	wp_enqueue_script('fitvids', it_JS_DIR .'/fitvids.js', array('jquery'), 1.0, true);
	wp_enqueue_script('uniform', it_JS_DIR .'/uniform.js', array('jquery'), '1.7.5', true);
	wp_enqueue_script('prth-responsive', it_JS_DIR .'/responsive.js', array('jquery'), '', true);
	
	//localize responsive menu text
	$nav_params = array(
		'text' => $itdata['responsive_menu_text'],
	);
	wp_localize_script( 'prth-responsive', 'responsiveLocalize', $nav_params );
	
	
	//initialize
	wp_enqueue_script('initialize', it_JS_DIR .'/initialize.js', false, '1.0', true);


	/* TF - UPDATE NOTIFIER */

	
	if(isset($_GET['page']) && ($_GET['page']=='theme-update-notifier')){
		//enqueue the scripts for the Update notifier page
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_script('prth-update',it_JS_DIR.'update-notifier.js');

		//enqueue the styles for the Update notifier page
		wp_enqueue_style('prth-update-style',it_CSS_DIR.'update-notifier.css');
		wp_enqueue_style('prth-admin-style',it_CSS_DIR.'page_style.css');
	}


	/* CSS */
	
	//Responsive
		wp_enqueue_style('responsive', it_CSS_DIR . '/responsive.css', 'style', true);
	
	//color scheme
	$color_option = $itdata['color_option']; //get admin option

	if($color_option !='black'){
		//load color scheme if not set to the default black color
		wp_enqueue_style('prth-color-skin', it_CSS_DIR . '/skins/'.$color_option.'.css', 'style', true);
	}
	
	
	
} //end theme_specific_scripts()
?>