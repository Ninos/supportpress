<?php
/*--------------------------------------*/
/*	Theme Options Front End
/*--------------------------------------*/

add_action('init','of_options');
if (!function_exists('of_options')) {
	function of_options() {

	//select options
	$show_hide = array(
		'enable' => 'enable',
		'disable' => 'disable'
	); 
	$disable_enable = array(
		'disable' => 'disable',
		'enable' => 'enable'
	); 
	$true_false = array(
		'true' => 'true',
		'false' => 'false'
	); 
	$fixed_static  = array(
		'fixed' => 'fixed',
		'static' => 'static'
	);

	$link_target = array(
		'_self' => 'Self',
		'_blank' => 'Blank'
	);
	$prettyphoto_themes = array(
		'pp_default' => 'Default',
		'light_rounded' => 'Light Rounded',
		'dark_rounded' => 'Dark Rounded',
		'light_square' => 'Light Square',
		'dark_square' => 'Dark Square',
		'facebook' => 'Facebook'
	);
	$bg_style = array(
		'repeat' => 'repeat',
		'repeat-x' => 'repeat-x',
		'repeat-y' => 'repeat-y',
		'full' => 'full'
	);
	
	//home modules
	$of_options_homepage_blocks = array(
		"enabled" => array (
			"placebo" => "placebo", //REQUIRED!
			"homepage_blog" => "Blog Posts",
			"homepage_tagline" => "Tagline",
			"homepage_widgets" => "Widgets",
		),
		"disabled" => array (
			"placebo" => "placebo", //REQUIRED!
			"homepage_search" => "Search",
			"homepage_topboxes" => "Top Boxes",

		),
	);


		
	//Get WordPress Categories
	$of_categories = array();  
	$of_categories_obj = get_categories('hide_empty=0');
	$of_categories = array( __("Select", 'prth') => __("Select", 'prth') ); 
	foreach ($of_categories_obj as $of_cat) {
	$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;} 
		   
	//Get WordPress Pages
	$of_pages = array();
	$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
	$of_pages = array( __("Select", 'prth') => __("Select", 'prth') ); 
	foreach ($of_pages_obj as $of_page) {
	$of_pages[$of_page->ID] = $of_page->post_title; }
	
	//Get Sliders
	$sliders = array();
	$sliders_obj = get_posts('post_type=slides&sort_column=post_parent,menu_order');   
	$sliders = array( __("Select", 'prth') => __("Select", 'prth') ); 
	foreach ($sliders_obj as $slider) {
	 $sliders[$slider->ID] = $slider->post_title; }
		
	//Background Images
	$background_images_path = get_stylesheet_directory() . '/images/backgrounds/';
	$background_images_url = get_template_directory_uri().'/images/backgrounds/';
	$background_images = array();
	
	if ( is_dir($background_images_path) ) {
		if ($background_images_dir = opendir($background_images_path) ) { 
			while ( ($background_images_file = readdir($background_images_dir)) !== false ) {
				if(stristr($background_images_file, ".png") !== false || stristr($background_images_file, ".jpg") !== false) {
					$background_images[] = $background_images_url . $background_images_file;
				}
			}    
		}
	}
	
	//location of admin images
	$url =  ADMIN_DIR . 'assets/images/';

	/*-----------------------------------------------------------------------------------*/
	/* The Options Array */
	/*-----------------------------------------------------------------------------------*/
	
	// Set the Options Array
	global $of_options;
	$of_options = array();
	
	/* !GENERAL */						
	$of_options[] = array( "name" => __('General Settings', 'prth'),
					"type" => "heading");

	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "general_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Logos and Branding','prth')."</h3>",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => __('Custom Logo (Main)', 'prth'),
						"desc" => __('You can upload your main site logo here or paste the URL here.', 'prth'),
						"id" => "custom_logo",
						"std" => "",
						"type" => "media");
						
	$of_options[] = array( "name" => __('Custom Logo (Login)', 'prth'),
						"desc" => __('You can upload a custom logo for the Wordpress Login Page here or paste the URL here.', 'prth'),
						"id" => "custom_login_logo",
						"std" => "",
						"type" => "media");
						
	$of_options[] = array( "name" => __('Custom Height - Login Logo', 'prth'),
						"desc" => __('You can customize the height of the login logo if need be (the width should not be changed)', 'prth'),
						"id" => "custom_login_logo_height",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Responsive Menu Text', 'prth'),
					"desc" => __('Custom Responsive text for menu.', 'prth'),
					"id" => "responsive_menu_text",
					"std" => "Go to...",
					"type" => "text");
												
	$of_options[] = array( "name" => __('Favicon', 'prth'),
						"desc" => __('Upload or paste the URL here for your favicon.', 'prth'),
						"id" => "custom_fav",
						"std" => "",
						"type" => "upload");

	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "topbar_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Theme Top Bar','prth')."</h3>",
						"icon" => false,
						"type" => "info");
											
	$of_options[] = array( "name" => __('Top Bar', 'prth'),
						"desc" => __('You have the option to disable the top bar completely.', 'prth'),
						"id" => "disable_topbar",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
						
	$of_options[] = array( "name" => __('Static/Fixed', 'prth'),
						"desc" => __('If Fixed, the top bar will always show at the top of the screen.', 'prth'),
						"id" => "topbar_position",
						"std" => "fixed",
						"type" => "select",
						"options" => $fixed_static);

						
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "header_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Header','prth')."</h3>",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => __('Header Margin - Left Side', 'prth'),
						"desc" => __('Margin above the left side of the header.', 'prth'),
						"id" => "header_logo_topmargin",
						"std" => "0px",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Header Margin - Right Side', 'prth'),
						"desc" => __('Margin above the right side of the header.', 'prth'),
						"id" => "header_right_topmargin",
						"std" => "0px",
						"type" => "text");



	
	$of_options[] = array( "name" => __('Twitter Settings', 'prth'),
					"type" => "heading");

	$of_options[] = array( "name" => __('Twitter Search Term', 'prth'),
						"desc" => __('What term would you like Twitter to Search for?', 'prth'),
						"id" => "twitter_search_term",
						"std" => "@support",
						"type" => "text");

	$of_options[] = array( "name" => __('Twitter - Consumer Key', 'prth'),
						"desc" => __('Your consumer key from twitter', 'prth'),
						"id" => "twitter_consumer_key",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Twitter - Consumer Secret', 'prth'),
						"desc" => __('Your consumer secret from twitter', 'prth'),
						"id" => "twitter_consumer_secret",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Twitter - Oauth Key', 'prth'),
						"desc" => __('Your access key from twitter', 'prth'),
						"id" => "twitter_oauth_key",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Twitter - Oauth Secret', 'prth'),
						"desc" => __('Your access secret from twitter', 'prth'),
						"id" => "twitter_oauth_secret",
						"std" => "",
						"type" => "text");
		
								
						




	/* 210 - ADD 40- !PAGES */					
	$of_options[] = array( "name" => __('Page Links', 'prth'),
					"type" => "heading");


	$of_options[] = array( "name" => __('Page - Login', 'prth'),
						"desc" => __('Paste the URL here.', 'prth'),
						"id" => "login_page",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Page - Admin Options', 'prth'),
						"desc" => __('Paste the URL here.', 'prth'),
						"id" => "admin_options_link",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Page - Add Ticket', 'prth'),
						"desc" => __('Paste the URL here.', 'prth'),
						"id" => "add_tickets_link",
						"std" => "",
						"type" => "text");



						
										
	/* !STYLING */					
	$of_options[] = array( "name" => __('Styling', 'prth'),
						"type" => "heading");
	
	$skin_images_url = get_template_directory_uri() .'/images/admin/skins/';					
	$of_options[] = array( "name" => __('Color Scheme', 'prth'),
						"desc" => __('Choose the basic color skin color for your site.', 'prth'),
						"id" => "color_option",
						"std" => "black",
						"type" => "images",
						"options" => array(
							'black' => $skin_images_url . 'skin-black.png',
							'blue' => $skin_images_url . 'skin-blue.png',
							'red' => $skin_images_url . 'skin-red.png',
							'orange' => $skin_images_url . 'skin-orange.png',
							'dark-blue' => $skin_images_url . 'skin-dark-blue.png',
							'gray' => $skin_images_url . 'skin-gray.png',
							'green' => $skin_images_url . 'skin-green.png',
							'light-green' => $skin_images_url . 'skin-light-green.png',
							'purple' => $skin_images_url . 'skin-purple.png',
							'burgundy' => $skin_images_url . 'skin-burgundy.png')
						);
							
	$of_options[] = array( "name" => __('Sidebar Layout', 'prth'),
						"desc" => __('Choose the sidebar position - left or right.', 'prth'),
						"id" => "sidebar_position",
						"std" => "right",
						"type" => "images",
						"options" => array(
							'right' => $url . '2cr.png',
							'left' => $url . '2cl.png')
						);
					
	$of_options[] = array( "name" => __('Custom CSS', 'prth'),
						"desc" => __('Place any Custom CSS you may have need of here.', 'prth'),
						"id" => "custom_css",
						"std" => "",
						"type" => "textarea");					




	/* !Backgrounds */					
	$of_options[] = array( "name" => __('Backgrounds', 'prth'),
						"type" => "heading");
						
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "backgrounds_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Main','prth')."</h3>",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => "Main Background Image",
						"desc" => "Choose a background or add your own by placing the images in your images/backgrounds folder in theme directory.",
						"id" => "main_background",
						"std" => $background_images_url."default_bg.png",
						"type" => "tiles",
						"options" => $background_images);
						
	$of_options[] = array( "name" => __('Main Custom Image', 'prth'),
						"desc" => __('Upload or paste the image URL here', 'prth'),
						"id" => "main_background_image",
						"std" => "",
						"type" => "media");
						
	$of_options[] = array( "name" => "Main Background Style",
						"desc" => "Select background style.",
						"id" => "main_background_style",
						"std" => "repeat",
						"type" => "select",
						"options" => $bg_style);
	
	$of_options[] = array( "name" => __('Main Background Color', 'prth'),
						"desc" => __('Select background color.', 'prth'),
						"id" => "main_background_color",
						"std" => "",
						"type" => "color");
						





	/* !HOME PAGE */					
	$of_options[] = array( "name" => __('Home Page', 'prth'),
						"type" => "heading");
					
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "home_layout",
						"std" => "<h3 style=\"margin: 0;\">".__('Homepage Layout','prth')."</h3>",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => "",
						"desc" => __('Drag and drop the blocks to organize the layout of your homepage.', 'prth'),
						"id" => "homepage_blocks",
						"std" => $of_options_homepage_blocks,
						"type" => "sorter");
						
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "home_slider_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Homepage Slider','prth')."</h3>",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => __('Homepage Slider', 'prth'),
						"desc" => __('Choose a homepage slider. Choose "Select" to show none.', 'prth'),
						"id" => "home_slider",
						"std" => "Select",
						"type" => "select",
						"options" => $sliders);

	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "homepage_boxes_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Homepage Boxes','prth')."</h3>",
						"icon" => false,
						"type" => "info");
					
	$of_options[] = array( "name" => __('Box 1 Link', 'prth'),
						"desc" => __('Url Box 1 goes to.', 'prth'),
						"id" => "homepage_box1_link",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 1 Title', 'prth'),
						"desc" => __('H2 Title for Box 1', 'prth'),
						"id" => "homepage_box1_title",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 1 Text', 'prth'),
						"desc" => __('Leave blank in order to not show Box 1 title.', 'prth'),
						"id" => "homepage_box1_text",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 1 Icon', 'prth'),
						"desc" => __('Select icon for Box 1. Flat icons care of pixden and viewable in the images/icons folder.', 'prth'),
						"id" => "homepage_box1_icon",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Box 2 Link', 'prth'),
						"desc" => __('Url Box 2 goes to.', 'prth'),
						"id" => "homepage_box2_link",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 2 Title', 'prth'),
						"desc" => __('H2 Title for Box 2', 'prth'),
						"id" => "homepage_box2_title",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 2 Text', 'prth'),
						"desc" => __('Leave blank in order to not show Box 2 title.', 'prth'),
						"id" => "homepage_box2_text",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 2 Icon', 'prth'),
						"desc" => __('Select icon for Box 2. Flat icons care of pixden and viewable in the images/icons folder.', 'prth'),
						"id" => "homepage_box2_icon",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Box 3 Link', 'prth'),
						"desc" => __('Url Box 3 goes to.', 'prth'),
						"id" => "homepage_box3_link",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 3 Title', 'prth'),
						"desc" => __('H2 Title for Box 3', 'prth'),
						"id" => "homepage_box3_title",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 3 Text', 'prth'),
						"desc" => __('Leave blank in order to not show Box 3 title.', 'prth'),
						"id" => "homepage_box3_text",
						"std" => "",
						"type" => "text");
	$of_options[] = array( "name" => __('Box 3 Icon', 'prth'),
						"desc" => __('Select icon for Box 3. Flat icons care of pixden and viewable in the images/icons folder.', 'prth'),
						"id" => "homepage_box3_icon",
						"std" => "",
						"type" => "text");

	
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "homepage_tagline_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Homepage Tagline','prth')."</h3>",
						"icon" => false,
						"type" => "info");
					
	$of_options[] = array( "name" => __('Tagline Title', 'prth'),
						"desc" => __('Leave blank in order to not show tagline title.', 'prth'),
						"id" => "homepage_tagline_title",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Tagline URL', 'prth'),
						"desc" => __('Leave blank for no link when tagline is clicked.', 'prth'),
						"id" => "homepage_tagline_title_url",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Tagline', 'prth'),
						"desc" => __('Enter content here - HTML and shortcodes allowed.', 'prth'),
						"id" => "homepage_tagline",
						"std" => 'Praesent commodo cursus magna, vel scelerisque.<br /> Nullam quis risus eget urna mollis ornare vel ullamcorper nulla non metus auctor fringilla.',
						"type" => "textarea");	
						
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "homepage_blog_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Blog','prth')."</h3>",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => __('Blog Title', 'prth'),
						"desc" => __('Leave blank in order to not show blog title.', 'prth'),
						"id" => "homepage_blog_title",
						"std" => "From The Blog",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Blog Title URL', 'prth'),
						"desc" => __('Leave blank for no link when blog title is clicked.', 'prth'),
						"id" => "homepage_blog_title_url",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Blog Category', 'prth'),
						"desc" => __('Which category to show of blog. Default is "All Categories".', 'prth'),
						"id" => "homepage_blog_cat",
						"std" => "",
						"type" => "select",
						"options" => $of_categories);
						
	$of_options[] = array( "name" => __('Blog Count', 'prth'),
						"desc" => __('How many to show?', 'prth'),
						"id" => "homepage_blog_count",
						"std" => "3",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Blog Layout', 'prth'),
						"desc" => __('Choose the layout for blog posts.', 'prth'),
						"id" => "homepage_blog_grid",
						"std" => "3 Column",
						"type" => "images",
						"options" => array(
							'3 Column' => $url . '3column.png',
							'4 Column' => $url . '4column.png')
						);

	$of_options[] = array( "name" => __('Blog - Image Height', 'prth'),
						"desc" => __('Default is 100% - you may increase or decrease it as you see fit.', 'prth'),
						"id" => "homepage_blog_height",
						"std" => "100%",
						"type" => "text");
												
	$of_options[] = array( "name" => __('Blog Excerption Show/Hide', 'prth'),
						"desc" => __('Choose to show or hide the blog excerpt', 'prth'),
						"id" => "homepage_blog_excerpt",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
												
	$of_options[] = array( "name" => __('Blog Excerpt Length', 'prth'),
						"desc" => __('Define a custom excerpt length.', 'prth'),
						"id" => "homepage_blog_excerpt_length",
						"std" => "20",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Blog Read More Button', 'prth'),
						"desc" => __('Choose to show or hide the read more button on posts on the homepage.', 'prth'),
						"id" => "homepage_blog_read_more",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
																					
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "homepage_widgets_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Widgets','prth')."</h3>",
						"icon" => false,
						"type" => "info");
								
	$of_options[] = array( "name" => __('Widgets Title', 'prth'),
						"desc" => __('Leave blank in order to not show widgets title.', 'prth'),
						"id" => "homepage_widgets_title",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Widgets Title URL', 'prth'),
						"desc" => __('Leave blank for no link when widgets title is clicked.', 'prth'),
						"id" => "homepage_widgets_title_url",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Widgets Layout', 'prth'),
						"desc" => __('Choose the layout for widgets.', 'prth'),
						"id" => "homepage_widgets_layout",
						"std" => "3 Column",
						"type" => "images",
						"options" => array(
							'2 Column' => $url . '2column.png',
							'3 Column' => $url . '3column.png',
							'4 Column' => $url . '4column.png')
						);







	/* !Blog */					
	$of_options[] = array( "name" => __('Blog', 'prth'),
						"type" => "heading");
						
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "blog_entries_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Main Blog','prth')."</h3>",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => __('Show Full Content', 'prth'),
						"desc" => __('Enable to show full post content.', 'prth'),
						"id" => "enable_full_blog",
						"std" => "disable",
						"type" => "select",
						"options" => $disable_enable);	
						
	$of_options[] = array( "name" => __('Post Excerpt Length', 'prth'),
						"desc" => __('Enter a custom length for blog excerpts.', 'prth'),
						"id" => "blog_excerpt",
						"std" => "23",
						"type" => "text");

	$of_options[] = array( "name" => __('Main Blog - Read More Button', 'prth'),
						"desc" => __('Choose to show or hide the read more button on your blog pages.', 'prth'),
						"id" => "blog_read_more",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
						
	$of_options[] = array( "name" => __('Image Hover Color', 'prth'),
						"desc" => __('Choose your hover color when mousing over blog entries.', 'prth'),
						"id" => "blog_overlay_color",
						"std" => "",
						"type" => "color");
						
	$of_options[] = array( "name" => __('Image Hover Opacity', 'prth'),
						"desc" => __('Choose the opacity at which the above color is rendered. Choose from 0 - 1 (ex. .01, .02, .03, etc)', 'prth'),
						"id" => "blog_overlay_opacity",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Main Blog - Featured Image Height', 'prth'),
						"desc" => __('Default is 100% - you may increase or decrease it as you see fit.', 'prth'),
						"id" => "staff_img_height",
						"std" => "100%",
						"type" => "text");
						
																		
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "blog_posts_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Single Posts','prth')."</h3>",
						"icon" => false,
						"type" => "info");

	$of_options[] = array( "name" => __('Post - Show Featured Image', 'prth'),
						"desc" => __('Choose to show/hide the featured image', 'prth'),
						"id" => "show_hide_post_image",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
						
	$of_options[] = array( "name" => __('Post - Crop Featured Images', 'prth'),
						"desc" => __('Enable to crop featured images, disabled to show full width.', 'prth'),
						"id" => "show_hide_single_post_image_crop",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);

	$of_options[] = array( "name" => __('Post - Featured Image Height', 'prth'),
						"desc" => __('Default is 100% - you may increase or decrease it as you see fit.', 'prth'),
						"id" => "post_image_height",
						"std" => "100%",
						"type" => "text");
												
	$of_options[] = array( "name" => __('Post - Meta', 'prth'),
						"desc" => __('Choose to show or hide meta information on single blog posts. ', 'prth'),
						"id" => "show_hide_single_meta",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
						
	$of_options[] = array( "name" => __('Post - Tags', 'prth'),
						"desc" => __('Choose to show or hide post tags on single blog posts. ', 'prth'),
						"id" => "show_hide_single_tags",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
												
	$of_options[] = array( "name" => __('Post - Related Posts', 'prth'),
						"desc" => __('Choose to show or hide related posts on single blog posts. ', 'prth'),
						"id" => "show_hide_single_related_posts",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
						










	/* !Discussion */					
	$of_options[] = array( "name" => __('Discussion', 'prth'),
							"type" => "heading");
							
	$of_options[] = array( "name" => __('Comment Placeholder', 'prth'),
						"desc" => __('Comment placeholder text', 'prth'),
						"id" => "comment_notice",
						"std" => "You can leave a reply here.",
						"type" => "textarea");
						
	$of_options[] = array( "name" => __('Show/Hide Comments On Blogs', 'prth'),
						"desc" => __('Select to enable/disable comments on blog posts.', 'prth'),
						"id" => "show_hide_blog_comments",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
															
	$of_options[] = array( "name" => __('Show/Hide Comments On Pages', 'prth'),
						"desc" => __('Select to enable/disable comments on regular pages.', 'prth'),
						"id" => "show_hide_page_comments",
						"std" => "disable",
						"type" => "select",
						"options" => $disable_enable);

	$of_options[] = array( "name" => __('Show/Hide Comments On KnowledgeBase', 'prth'),
						"desc" => __('Select to enable/disable comments on knowledgebase posts.', 'prth'),
						"id" => "show_hide_kb_comments",
						"std" => "disable",
						"type" => "select",
						"options" => $disable_enable);
						
	$of_options[] = array( "name" => __('Show/Hide Comments On FAQs', 'prth'),
						"desc" => __('Select to enable/disable comments on faq posts.', 'prth'),
						"id" => "show_hide_faqs_comments",
						"std" => "disable",
						"type" => "select",
						"options" => $disable_enable);






	/* !Footer */					
	$of_options[] = array( "name" => __('Footer', 'prth'),
						"type" => "heading");
						
	$of_options[] = array( "name" => __('Footer Header Text', 'prth'),
						"desc" => __('Enter your text for the footer header region.', 'prth'),
						"id" => "footer_footer_header_text",
						"std" => __('Edit your tagline in the Theme Panel "Footer" tab.','prth'),
						"type" => "text");
						
	$of_options[] = array( "name" => __('Show/Hide Widgetized Footer', 'prth'),
						"desc" => __('Show or hide widget spaces in the footer.', 'prth'),
						"id" => "disable_widgetized_footer",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
						
	$of_options[] = array( "name" => __('Footer Layout', 'prth'),
						"desc" => __('Select footer widget layout.', 'prth'),
						"id" => "footer_layout",
						"std" => "3 Column",
						"type" => "images",
						"options" => array(
							'3 Column' => $url . '3column.png',
							'4 Column' => $url . '4column.png')
						);
						
	$of_options[] = array( "name" => __('Copyright', 'prth'),
						"desc" => __('Your text/HTML for copyright goes here.', 'prth'),
						"id" => "custom_copyright",
						"std" => "",
						"type" => "textarea");

						
	
	
	


	/* !Lightbox */						
	$of_options[] = array( "name" => __('PrettyPhoto Lightbox', 'prth'),
						"type" => "heading");
						
	$of_options[] = array( "name" => __('Show/Hide', 'prth'),
						"desc" => __('Show/hide the lighbox.', 'prth'),
						"id" => "prettyphoto_show_hide",
						"std" => "enable",
						"type" => "select",
						"options" => $show_hide);
						
	$of_options[] = array( "name" => __('Theme', 'prth'),
						"desc" => __('Pick a theme for your lightboxes.', 'prth'),
						"id" => "prettyphoto_theme",
						"std" => "pp_default",
						"type" => "select",
						"options" => $prettyphoto_themes);
						
	$of_options[] = array( "name" => __('Background Overlay', 'prth'),
					"desc" => __('Choose the opacity at which the lightbox background is rendered. Choose from 0 - 1 (ex. .01, .02, .03, etc)', 'prth'),
					"id" => "prettyphoto_opacity",
					"std" => "0.8",
					"type" => "text");
						
	$of_options[] = array( "name" => __('Use Resize?', 'prth'),
						"desc" => __('If selected, photos may be resized to be bigger than window viewport.', 'prth'),
						"id" => "prettyphoto_resize",
						"std" => "true",
						"type" => "select",
						"options" => $true_false);
						
	$of_options[] = array( "name" => __('Show/Hide Title', 'prth'),
						"desc" => __('Show/hide the title in the lightbox.', 'prth'),
						"id" => "prettyphoto_title",
						"std" => "true",
						"type" => "select",
						"options" => $true_false);
					
	$of_options[] = array( "name" => __('Default Width', 'prth'),
					"desc" => __('Unless otherwise specified, this is used as default width (good for videos).', 'prth'),
					"id" => "prettyphoto_width",
					"std" => "600",
					"type" => "text");
						
	$of_options[] = array( "name" => __('Default Height', 'prth'),
					"desc" => __('Unless otherwise specified, this is used as default height (good for videos).', 'prth'),
					"id" => "prettyphoto_height",
					"std" => "400",
					"type" => "text");
									
	$of_options[] = array( "name" => __('Slideshow Speed', 'prth'),
						"desc" => __('In milliseconds - the speed for lightbox galleries. Also takes "false" to disable.', 'prth'),
						"id" => "prettyphoto_slideshow",
						"std" => "5000",
						"type" => "text");






	/* !Ticket Cusomizations 				
	$of_options[] = array( "name" => __('Ticket Level Customizations', 'prth'),
					"type" => "heading");				
						
	$of_options[] = array( "name" => __('Level: 3', 'prth'),
					"desc" => __('Enter a name to replace "High" on front end.', 'prth'),
					"id" => "ticket_replacement_high",
					"std" => "",
					"type" => "text");
					
	$of_options[] = array( "name" => __('Level: 2', 'prth'),
					"desc" => __('Enter a name to replace "Medium" on front end.', 'prth'),
						"id" => "ticket_replacement_medium",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Level: 1', 'prth'),
					"desc" => __('Enter a name to replace "Low" on front end.', 'prth'),
						"id" => "ticket_replacement_low",
						"std" => "",
						"type" => "text");
						
	*/	
	
	
	
	
	




	/* !Translations */					
	$of_options[] = array( "name" => __('Translations', 'prth'),
						"type" => "heading");

						
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "types_heading",
						"std" => "<p style=\"margin: 0;\">".__('Thanks to early ProjectPress users who helped me identify some of the gaps in Wordpress Translation for these.','prth')."</p>",
						"icon" => false,
						"type" => "info");

	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "backgrounds_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('User Role Translations','prth')."</h3>",
						"icon" => false,
						"type" => "info");

	$of_options[] = array( "name" => __('Administrator', 'prth'),
						"desc" => __('Custom text for administrator user role.', 'prth'),
						"id" => "translation_administrator",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Editor', 'prth'),
						"desc" => __('Custom text for editor user role.', 'prth'),
						"id" => "translation_editor",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Subscriber', 'prth'),
						"desc" => __('Custom text for subscriber user role.', 'prth'),
						"id" => "translation_subscriber",
						"std" => "",
						"type" => "text");


	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "backgrounds_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Other Translations','prth')."</h3>",
						"icon" => false,
						"type" => "info");

























//825 - add 35
	$of_options[] = array( "name" => __('Related Items', 'prth'),
						"desc" => __('Custom related items text.', 'prth'),
						"id" => "translation_related_items_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Related Blog Posts', 'prth'),
						"desc" => __('Custom related blog posts text.', 'prth'),
						"id" => "translation_related_articles_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Read More Text', 'prth'),
						"desc" => __('Custom read more text.', 'prth'),
						"id" => "translation_read_more_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Meta Information - "Tags"', 'prth'),
						"desc" => __('Custom "tags" text.', 'prth'),
						"id" => "translation_tags_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Meta Information - "Post By"', 'prth'),
						"desc" => __('Custom "post by" text.', 'prth'),
						"id" => "translation_post_by_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Comments', 'prth'),
						"desc" => __('Custom comments text.', 'prth'),
						"id" => "translation_comments_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Comments Disabled', 'prth'),
						"desc" => __('Custom comments disabled text.', 'prth'),
						"id" => "translation_comments_disabled_text",
						"std" => "",
						"type" => "text");

	$of_options[] = array( "name" => __('Leave a reply', 'prth'),
						"desc" => __('Custom leave a reply text.', 'prth'),
						"id" => "translation_leave_reply_text",
						"std" => "",
						"type" => "text");	
						
	$of_options[] = array( "name" => __('Name', 'prth'),
						"desc" => __('Custom "name" text.', 'prth'),
						"id" => "translation_comments_name_text",
						"std" => "",
						"type" => "text");	
						
	$of_options[] = array( "name" => __('Email', 'prth'),
						"desc" => __('Custom "email" text.', 'prth'),
						"id" => "translation_comments_email_text",
						"std" => "",
						"type" => "text");	
						
	$of_options[] = array( "name" => __('Website', 'prth'),
						"desc" => __('Custom "website" text.', 'prth'),
						"id" => "translation_comments_website_text",
						"std" => "",
						"type" => "text");	
																	
	$of_options[] = array( "name" => __('Comment Navigation', 'prth'),
						"desc" => __('Custom "navigation" text.', 'prth'),
						"id" => "translation_comments_menu_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Older Comments', 'prth'),
						"desc" => __('Custom "older comments" text.', 'prth'),
						"id" => "translation_comments_older_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Newer Comments', 'prth'),
						"desc" => __('Custom "newer comments" text.', 'prth'),
						"id" => "translation_comments_newer_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Reply To Comment', 'prth'),
						"desc" => __('Custom "reply to comment" text.', 'prth'),
						"id" => "translation_reply_to_text",
						"std" => "",
						"type" => "text");	
						
	$of_options[] = array( "name" => __('Post Comment', 'prth'),
						"desc" => __('Custom "post comment" text.', 'prth'),
						"id" => "translation_post_comment_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Log In To Post Comment', 'prth'),
						"desc" => __('Custom "Log in to Post Comment" text.', 'prth'),
						"id" => "translation_comment_log_in_text",
						"std" => "",
						"type" => "text");	
								
	$of_options[] = array( "name" => __('Search Results - Entries Found', 'prth'),
						"desc" => __('Custom search results text - entries found.', 'prth'),
						"id" => "translation_search_results_text",
						"std" => "",
						"type" => "text");
						
	$of_options[] = array( "name" => __('Search Results - Nothing Found', 'prth'),
						"desc" => __('Enter search results text - nothing found.', 'prth'),
						"id" => "translation_no_search_results_text",
						"std" => "",
						"type" => "text");	
										
	$of_options[] = array( "name" => __('404 Error', 'prth'),
						"desc" => __('Custom 404 text.', 'prth'),
						"id" => "custom_404_text",
						"std" => "",
						"type" => "textarea");		
					
						





	/* !Analytics */					
	$of_options[] = array( "name" => __('Analytics', 'prth'),
						"type" => "heading");
						
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "tracking_heading",
						"std" => "",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => __('Analytics Code (Header)', 'prth'),
						"desc" => __('Input your Google Analytics (or similiar) code here. Anything placed here will be added into header.php.', 'prth'),
						"id" => "analytics_header",
						"std" => "",
						"type" => "textarea");    
						
	$of_options[] = array( "name" => __('Analytics Code (Footer)', 'prth'),
						"desc" => __('Input your Google Analytics (or similiar) code here. Anything placed here will be added into footer.php.', 'prth'),
						"id" => "analytics_footer",
						"std" => "",
						"type" => "textarea");





	/* !ThemeForest Notifications*/
	$of_options[] = array( "name" => __('Theme Updates', 'prth'),
						"type" => "heading");

	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "updates_main_heading",
						"std" => "<h3 style=\"margin: 0;\">".__('Theme Updates','prth')."</h3>",
						"icon" => false,
						"type" => "info");
						
	$of_options[] = array( "name" => __('ThemeForest Username', 'prth'),
						"desc" => __('Your ThemeForest Username', 'prth'),
						"id" => "tf_username",
						"std" => __('Your Username','prth'),
						"type" => "text");
						
	$of_options[] = array( "name" => __('Themeforest API Key', 'prth'),
						"desc" => __('Enter your API Key.', 'prth'),
						"id" => "tf_api_key",
						"std" => __('Your API Key','prth'),
						"type" => "text");
		
	$of_options[] = array( "name" => "", "desc" => "", "id" => "support_badge", "std" => "<p style=\"margin: 0;\">".__('For support of this theme, please visit www.icaruscreative.org/pressthemes/support','prth')."</p>", "icon" => false, "type" => "info");
		
		
	/* !Credit */		
	$of_options[] = array( "name" => __('Menu Options Credit', 'prth'),
						"type" => "heading");
						
	$of_options[] = array(
						"name" => "",
						"desc" => "",
						"id" => "types_heading",
						"std" => "<p style=\"margin: 0;\">".__('This theme uses the Options Framework with a bit of customization added for extra functionality.','prth')."</p>",
						"icon" => false,
						"type" => "info");
											
		}
}
?>
