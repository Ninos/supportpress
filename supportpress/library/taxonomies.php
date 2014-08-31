<?php
/*--------------------------------------*/
/*	Taxonomies
/*--------------------------------------*/
add_action( 'init', 'prth_create_tax' );

//create taxonomies
function prth_create_tax() {
	
	
	global $itdata; //get global variables for use in setting post type labels & permalinks
	
	
	/** Global **/

	$prth_tax = array(
		'name' => __( 'Categories', 'prth' ),
		'singular_name' => __( 'Category', 'prth' ),
		'search_items' =>  __( 'Search Categories', 'prth' ),
		'all_items' => __( 'All Categories', 'prth' ),
		'parent_item' => __( 'Parent Category', 'prth' ),
		'parent_item_colon' => __( 'Parent Category:', 'prth' ),
		'edit_item' => __( 'Edit  Category', 'prth' ),
		'update_item' => __( 'Update Category', 'prth' ),
		'add_new_item' => __( 'Add New  Category', 'prth' ),
		'new_item_name' => __( 'New Category Name', 'prth' ),
		'choose_from_most_used'	=> __( 'Choose from the most used categories', 'prth' )
	);
	
	
	/** Tickets **/
	
	if (isset($itdata['tickets_tax_slug_replacement'])) { $tickets_tax_slug_replacement = $itdata['tickets_tax_slug_replacement']; } else { $tickets_tax_slug_replacement = 'tickets-category'; }
	
	register_taxonomy('tickets_cats','tickets',array(
		'hierarchical' => true,
		'labels' => apply_filters('prth_tickets_tax_labels', $prth_tax),
		'query_var' => true,
		'rewrite' => array( 'slug' => $tickets_tax_slug_replacement ),
	));
		
	/** Documentation **/
	if (isset($itdata['docs_tax_slug_replacement'])) { $docs_tax_slug_replacement = $itdata['docs_tax_slug_replacement']; } else { $docs_tax_slug_replacement = 'docs-category'; }

	register_taxonomy('docs_cats','docs',array(
		'hierarchical' => true,
		'labels' => apply_filters('prth_docs_tax_labels', $prth_tax),
		'query_var' => true,
		'rewrite' => array( 'slug' => $docs_tax_slug_replacement ),
	));
	
	/** KnowledgeBase **/
	if (isset($itdata['kb_tax_slug_replacement'])) { $kb_tax_slug_replacement = $itdata['kb_tax_slug_replacement']; } else { $kb_tax_slug_replacement = 'kb-category'; }

	register_taxonomy('kb_cats','kb',array(
		'hierarchical' => true,
		'labels' => apply_filters('prth_kb_tax_labels', $prth_tax),
		'query_var' => true,
		'rewrite' => array( 'slug' => $kb_tax_slug_replacement ),
	));

	/** FAQS **/
	
	if (isset($itdata['faqs_tax_slug_replacement'])) { $faqs_tax_slug_replacement = $itdata['faqs_tax_slug_replacement']; } else { $faqs_tax_slug_replacement = 'faqs-category'; }
	register_taxonomy('faqs_cats','faqs',array(
		'hierarchical' => true,
		'labels' => apply_filters('prth_faqs_tax_labels', $prth_tax),
		'query_var' => true,
		'rewrite' => array( 'slug' => $faqs_tax_slug_replacement ),
	));
	
}


	/** Add Filter **/

function prth_add_filters() {
	global $typenow;

	if( $typenow == 'docs' || $typenow == 'tickets' || $typenow == 'kb' || $typenow == 'faqs' ){
		if( $typenow == 'tickets') { $taxonomies = array('tickets_cats'); }
		if( $typenow == 'docs') { $taxonomies = array('docs_cats'); }
		if( $typenow == 'kb') { $taxonomies = array('kb_cats'); }
		if( $typenow == 'faqs') { $taxonomies = array('faqs_cats'); }

		foreach ($taxonomies as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			if(count($terms) > 0) {
				echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
				echo "<option value=''>All Categories</option>";
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
				echo "</select>";
			}
		}
	}
}
add_action( 'restrict_manage_posts', 'prth_add_filters' );
?>