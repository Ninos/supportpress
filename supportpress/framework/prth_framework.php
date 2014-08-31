<?php
/**
 * Press Themes
*/

 
// Check for PressThemes Framework
if(!defined('it_FRAMEWORK_DIR')) die( _('Framework location not defined.','prth'));



/*--------------------------------------*/
/* Included files
/*--------------------------------------*/

//load global variables
require_once('functions/variables.php');

//load index
require_once ('admin/index.php');

//load css & jquery
require_once('scripts/enqueue_css.php');
require_once('scripts/enqueue_js.php');

//load functions
require_once('functions/grid.php');
require_once('functions/pagination.php');
require_once('functions/imageresizer.php');
require_once('functions/enhanced_comments.php');
require_once('functions/custom_login.php');
require_once('functions/twitteroauth.php');

//load widgets
require_once('widgets/social.php');
require_once('widgets/video.php');
require_once('widgets/taxonomies.php');
require_once('widgets/recent-custom-types.php');

//load shortcodes
require_once('shortcodes/shortcodes.php');

//load only on admin
if(defined('WP_ADMIN') && WP_ADMIN ) {	
	//meta
	require_once('meta/meta_class.php');	
}




/*--------------------------------------*/
/* Filters
/*--------------------------------------*/

//shortcode support
add_filter('the_content', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');





/*--------------------------------------*/
/* Misc
/*--------------------------------------*/

//wp custom background support
add_theme_support('custom-background');
add_theme_support('post-thumbnails');

// add home link to menu
add_filter( 'wp_page_menu_args', 'home_page_menu_args' );
function home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

// functions run on activation --> !important --> flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}

?>