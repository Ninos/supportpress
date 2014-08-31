<?php
/*--------------------------------------*/
/*	Post Type Pagination
/*--------------------------------------*/
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'prth_modify_posts_per_page', 0);

function prth_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'prth_option_posts_per_page' );
}
function prth_option_posts_per_page( $value ) {
	global $itdata;
	global $option_posts_per_page;
	
	// Get theme panel admin
	if($itdata['portfolio_cat_pagination']) {
		$portfolio_posts_per_page = $itdata['portfolio_cat_pagination'];
		} else {
			$portfolio_posts_per_page = '-1';
			}
	
    if (is_tax( 'portfolio_cats') ) {
        return $portfolio_posts_per_page;
    }
	if (is_tax( 'staff_departments')) {
		return -1;
	}
	else {
        return $option_posts_per_page;
    }
}
?>