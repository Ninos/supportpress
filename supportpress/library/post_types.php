<?php
/*--------------------------------------*/
/*	Post Types
/*--------------------------------------*/
add_action( 'init', 'prth_create_post_types' );
function prth_create_post_types() {
	
	//get global variables
	global $itdata;


	/** Slider **/
	register_post_type( 'Slides', //careful editing the post type name you could lose your valuable content!
		array(
		  'labels' => array(
			'name' => __( 'Slider', 'prth' ),
			'singular_name' => __( 'Slider', 'prth' ),		
			'add_new' => _x( 'Add New', 'Slider', 'prth' ),
			'add_new_item' => __( 'Add New Slider', 'prth' ),
			'edit_item' => __( 'Edit Slider', 'prth' ),
			'new_item' => __( 'New Slider', 'prth' ),
			'view_item' => __( 'View Slider', 'prth' ),
			'search_items' => __( 'Search Sliders', 'prth' ),
			'not_found' =>  __( 'No Sliders found', 'prth' ),
			'not_found_in_trash' => __( 'No Sliders found in Trash', 'prth' ),
			'parent_item_colon' => ''
			
		  ),
		  'public' => true,
		  'supports' => array('title', 'revisions'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => 'slides' ),
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		   'menu_icon' => get_template_directory_uri() . '/images/admin/custom-post-type.png',
		)
	  );
	  
	  

	/** Tickets **/
	
	//tickets name
	if (isset($itdata['tickets_post_type_replacement'])) { $tickets_post_type_replacement = $itdata['tickets_post_type_replacement']; } else { $tickets_post_type_replacement = 'Tickets'; }
	
	//tickets slug
	if (isset($itdata['tickets_post_type_slug_replacement'])) { $tickets_slug = $itdata['tickets_post_type_slug_replacement']; } else { $tickets_slug = 'tickets'; }
	
	//tickets labels
	$tickets_labels = array( 'name' => $tickets_post_type_replacement );
	
	//register tickets post type
	register_post_type( 'tickets', //careful editing the post type name you could lose your valuable content!
		array(
		  'labels' => apply_filters('prth_tickets_labels', $tickets_labels),
		  'public' => true,
		  'supports' => array('title','editor','thumbnail','excerpt','revisions','comments'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => $tickets_slug ),
		   'menu_icon' => get_template_directory_uri() . '/images/admin/custom-post-type.png',
		)
	);
	
	
  
	/** Knowledge Base **/
	
	//kb name
	if (isset($itdata['kb_post_type_replacement'])) {$kb_post_type_replacement = $itdata['kb_post_type_replacement']; } else { $kb_post_type_replacement = 'KnowledgeBase'; }
	
	//kb slug
	if (isset($itdata['kb_post_type_slug_replacement'])) { $kb_slug = $itdata['kb_post_type_slug_replacement']; } else { $kb_slug = 'kb'; }
	
	//kb labels
	$kb_labels = array( 'name' => $kb_post_type_replacement );
	
	//register kb post type
	register_post_type( 'kb', //careful editing the post type name you could lose your valuable content!
		array(
		  'labels' => apply_filters('prth_kb_labels', $kb_labels),
		  'public' => true,
		  'supports' => array('title', 'thumbnail', 'editor', 'revisions', 'comments', 'excerpt'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => $kb_slug ),
		   'menu_icon' => get_template_directory_uri() . '/images/admin/custom-post-type.png',
		)
	);
	  
	  
	/** Documentation **/
		
	//docs name
	if (isset($itdata['docs_post_type_replacement'])) { $docs_post_type_replacement = $itdata['docs_post_type_replacement']; } else { $docs_post_type_replacement = 'Documentation'; }
	
	//docs slug
	if (isset($itdata['docs_post_type_slug_replacement'])) { $docs_slug = $itdata['docs_post_type_slug_replacement']; } else { $docs_slug = 'docs'; }
	
	//docs labels
	$docs_labels = array( 'name' => $docs_post_type_replacement );
	
	//register docs post type
	register_post_type( 'docs', //careful editing the post type name you could lose your valuable content!
		array(
		  'labels' => apply_filters('prth_docs_labels', $docs_labels),
		  'public' => true,
		  'supports' => array('title','editor','revisions','thumbnail','comments'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => $docs_slug ),
		   'menu_icon' => get_template_directory_uri() . '/images/admin/custom-post-type.png',
		)
	);
	
		
	/** FAQS **/
	
	//faqs name
	if (isset($itdata['faqs_post_type_replacement'])) { $faqs_post_type_replacement = $itdata['faqs_post_type_replacement']; } else { $faqs_post_type_replacement = 'FAQs'; }
	
	//faqs slug
	if (isset($itdata['faqs_post_type_slug_replacement'])) { $faqs_slug = $itdata['faqs_post_type_slug_replacement']; } else { $faqs_slug = 'faqs'; }
	
	//faqs labels
	$faqs_labels = array( 'name' => $faqs_post_type_replacement );
	
	//register faqs post type
	register_post_type( 'FAQS', //careful editing the post type name you could lose your valuable content!
		array(
		  'labels' => apply_filters('prth_portfolio_labels', $faqs_labels),
		  'public' => true,
		  'supports' => array('title','editor', 'revisions','comments'),
		  'query_var' => true,
		  'rewrite' => array( 'slug' => $faqs_slug ),
		   'menu_icon' => get_template_directory_uri() . '/images/admin/custom-post-type.png',
		)
	);

}
?>