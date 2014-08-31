<?php
/*--------------------------------------*/
/* used for taxonomy pagination
/*--------------------------------------*/

//get posts per page
$prth_option_posts_per_page = get_option( 'posts_per_page' );

//add posts per page filter
add_action( 'init', 'prth_modify_posts_per_page', 0);
function prth_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'prth_option_posts_per_page' );
}

//modify posts per page
function prth_option_posts_per_page( $value ) {
	global $itdata;
	global $prth_option_posts_per_page;
	
	//tax pagination
    if(is_tax('portfolio_cats')) return $itdata['portfolio_tax_pages'];
	if(is_tax('staff_cats')) return $itdata['staff_tax_pages'];
	if(is_tax('faqs_cats')) { return -1; } else { return $prth_option_posts_per_page; }
}

?>