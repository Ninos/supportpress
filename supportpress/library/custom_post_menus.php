<?php
/**
* Register Custom Post Menus */
 
$prefix = 'prth_';
$prth_meta_boxes = array();

	//location of admin images
	$url =  ADMIN_DIR . 'assets/images/';


	

/* Documentation EXTRAS */
$prth_meta_boxes[] = array(
	'id' => 'prth_docs_entry_meta',
	'title' => __('Documentation Options','prth'),
	'pages' => array('docs'),

	'fields' => array(
		array(
            'name' => __('Custom Documentation Order','prth'),
            'desc' => __('Specify the sorted order that this article/process should be in it\'s category. By default - documentation is sorted by date.','prth'),
            'id' => $prefix . 'order',
            'type' => 'text',
            'std' => ''
        ),
	),

);






/* Post EXTRAS */
$prth_meta_boxes[] = array(
	'id' => 'prth_portfolio_meta',
	'title' => __('Post Options','prth'),
	'pages' => array('portfolio'),

	'fields' => array(
		array(
            'name' => __('Post: Style', 'prth'),
            'id' => $prefix . 'portfolio_post_style',
			'desc' => __('Select the entry style for this post.', 'prth'),
			'default' => 'default',
            'type' => 'select',
            'options' => array(
				'default' => 'default',
				'full' => 'full'
			),
        ),
		array(
            'name' => __('Post: Featured Image', 'prth'),
            'id' => $prefix . 'portfolio_featured_image',
			'desc' => __('Select enable to show only your featured image and not a slider.', 'prth'),
			'default' => 'enable',
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			),
        ),
	array(
            'name' => __('Post: Slider', 'prth'),
            'id' => $prefix . 'portfolio_slider_image',
			'desc' => __('Select disable if you wish to disable the slider function on this post. Setup your slider below.', 'prth'),
			'default' => 'enable',
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			),
        ),
		array(
            'name' => __('Post: Related Items', 'prth'),
            'id' => $prefix . 'portfolio_related_posts',
			'desc' => __('Select to enable or disable the related posts region.', 'prth'),
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			)
        ),
		array(
            'name' => __('Post: Disable Meta', 'prth'),
            'id' => $prefix . 'portfolio_meta',
			'desc' => __('Select to enable or disable the porfolio meta area (date/category/etc).', 'prth'),
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			)
        ),
	)
);

/* Slides EXTRAS */
$prth_meta_boxes[] = array(
	'id' => 'prth_slides_meta',
	'title' => __('Slides','prth'),
	'pages' => array('slides', 'portfolio'),
	'fields' => array(
        array( 
        		'name' => __('Slides','prth'),
        		'desc' => __('Upload as many slides you want on this page, then drag and drop to arrange them.','prth'),
        		'id' => $prefix.'slides',
        		'type' => 'slider',
        		'std' => array (
        			1 => array (
        				'title' => 'Slide 1',
        				'image' => '',
        				'link' => '',
        				'desc' => ''
        			),
        		),
        ),
	)
);

/* Slider EXTRAS */
$prth_meta_boxes[] = array(
	'id' => 'prth_flexslider_meta',
	'title' => __('Slider Settings','prth'),
	'pages' => array('slides', 'portfolio'),
	'fields' => array(
		array(
			'name' => __('Animation','prth'),
			'desc' => __('Select your animation.','prth'),
			'id' => $prefix . 'slider_animation',
			'type' => 'select',
			'std' => 'fade',
			'options' => array(
				'fade' => 'fade',
				'slide' => 'slide'
				)
        	),
		array(
			'name' => __('Auto transition','prth'),
			'desc' => __('Select true if you want the slider to start the auto transition automatically.','prth'),
			'id' => $prefix . 'slider_transition',
			'type' => 'select',
			'std' => 'true',
			'options' => array(
				'true' => 'true',
				'false' => 'false'
				)
        	),
		array(
			'name' => __('Direction Navigation','prth'),
			'desc' => __('Select true to enable the next/previous arrows.','prth'),
			'id' => $prefix . 'slider_direction_nav',
			'type' => 'select',
			'std' => 'true',
			'options' => array(
				'true' => 'true',
				'false' => 'false'
				)
        	),	
		array(
			'name' => __('Control Navigation','prth'),
			'desc' => __('Select true to enable the control navigation.','prth'),
			'id' => $prefix . 'slider_control_nav',
			'type' => 'select',
			'std' => 'false',
			'options' => array(
				'false' => 'false',
				'true' => 'true'
				)
        	),
		array(
			'name' => __('Smooth Height Transition','prth'),
			'desc' => __('Select true to enable the smooth transition between slides of different heights. This new setting in FlexSlider 2 is a bit buggy so it\'s set to false by default.','prth'),
			'id' => $prefix . 'smooth_height',
			'type' => 'select',
			'std' => 'false',
			'options' => array(
				'false' => 'false',
				'true' => 'true',
				)
        	),
		array(
            'name' => __('Slideshow Speed','prth'),
            'desc' => __('Integer: Set the speed of the slideshow cycling, in milliseconds. Do NOT leave blank.','prth'),
            'id' => $prefix . 'slider_speed',
            'type' => 'text',
            'std' => '7000'
        ),
		array(
            'name' => __('Animation Duration','prth'),
            'desc' => __('Integer: Set the speed of animations, in milliseconds. Do NOT leave blank.','prth'),
            'id' => $prefix . 'slider_animation_duration',
            'type' => 'text',
            'std' => '600'
        ),
	)
);




/* Image Slides */
$prth_meta_boxes[] = array(
	'id' => 'prth_slides_shortcode',
	'title' => __('Slider Shortcode','prth'),
	'pages' => array('slides'),
	'priority' => 'low',
	'context' => 'side',

	'fields' => array(
		array(
            'name' => __('Slider Shortcode','prth'),
			'desc' => '',
			'id' => '',
            'type' => 'slider_shortcode',
        ),
	)
);



/* Tickets EXTRAS */
$prth_meta_boxes[] = array(
    'id' => 'prth_tickets_meta',
    'title' => __('Tickets Options','prth'),
    'pages' => array('tickets'),
	
	'fields' => array(
		array(
            'name' => __('Tickets Status','prth'),
            'desc' => __('Status of ticket','prth'),
            'id' => $prefix . 'ticket_status',
            'type' => 'select',
            'options' => array(
				'open' => 'open',
				'closed' => 'closed'
			),
		),
		array(
            'name' => __('Ticket Priority','prth'),
            'desc' => __('Priority Level of Ticket. Level 1 = low, Level 2 = medium, Level 3 = high','prth'),
            'id' => $prefix . 'ticket_priority',
            'type' => 'select',
            'options' => array(
				'low' => '1',
				'medium' => '2',
				'high' => '3',
			),
        ),
		array(
            'name' => __('Ticket Assignment','prth'),
            'desc' => __('The id of the person who is assigned this ticket','prth'),
            'id' => $prefix . 'ticket_assigned',
            'type' => 'text',
            'std' => ''
        ), 
		array(
            'name' => __('Ticket Requestor','prth'),
            'desc' => __('The id of the person who is requested this ticket','prth'),
            'id' => $prefix . 'ticket_requested',
            'type' => 'text',
            'std' => ''
        ), 

	)
);

/* Post EXTRAS */
$prth_meta_boxes[] = array(
	'id' => 'prth_post_meta',
	'title' => __('Post Options','prth'),
	'pages' => array('post'),
	'fields' => array(
		array(
            'name' => __('Featured Image', 'prth'),
            'id' => $prefix . 'single_featured_image',
			'desc' => __('Select to enable or disable your featured image', 'prth'),
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			),
        ),
		array(
            'name' => __('Tags', 'prth'),
            'id' => $prefix . 'single_tags',
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			),
            'desc' => __('Select to enable or disable the tags region.', 'prth'),
        ),
		array(
            'name' => __('Related Posts', 'prth'),
            'id' => $prefix . 'single_related_posts',
			'desc' => __('Select to enable or disable the related posts region.', 'prth'),
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			)
        ),
	)
);

/* Page EXTRAS */
$prth_meta_boxes[] = array(
	'id' => 'prth_meta_templates',
	'title' => __('Template Options','prth'),
	'pages' => array('page'),
	'fields' => array(
		array(
			'name' => __('Slider', 'prth'),
			'desc' => __('Select a slider if you want one at the top of this page full-screen.','prth'),
			'id' => $prefix . 'page_slider',
			'type' => 'slides',
		),
		array(
			'name' => __('Blog Category', 'prth'),
			'id' => $prefix . 'blog_parent',
			'type' => 'taxonomy',
			'taxonomy' => 'category',
			'desc' => __('Select a category for this blog page.','prth')
		),
		array(
            'name' => __('Ticket Status', 'prth'),
            'id' => $prefix . 'ticket_status_id',
			'desc' => __('On Ticket pages, show open or closed tickets', 'prth'),
            'type' => 'select',
            'options' => array(
				'open' => 'open',
				'closed' => 'closed'
			)
        ),
		array(
            'name' => __('Ticket Page Count', 'prth'),
            'id' => $prefix . 'ticket_page_count',
			'desc' => __('On Ticket page, how many posts to show per page (-1 for All)', 'prth'),
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => __('Footer Header Area', 'prth'),
            'id' => $prefix . 'show_hide_footer_header',
			'desc' => __('Select to enable or disable the footer header region above the footer. Ideal for pages like your sitemap, contact page, etc.', 'prth'),
            'type' => 'select',
            'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			)
        ),
	)
);

foreach ($prth_meta_boxes as $meta_box) {
	new prth_meta_box($meta_box);
}
?>