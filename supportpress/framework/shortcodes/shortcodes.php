<?php
//get shortcodes pop-up editor == in the dashboard only
if(defined('WP_ADMIN') && WP_ADMIN ) {
	require_once('forms.php');
}
/*--------------------------------------*/
/* Clean Up WordPress Shortcode Formatting
/* Important for nested shortcodes
/* Credit: http://donalmacarthur.com/articles/cleaning-up-wordpress-shortcode-formatting
/*--------------------------------------*/
function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
	$content = trim( do_shortcode( shortcode_unautop( $content ) ) );

	/* Remove '' from the start of the string. */
	if ( substr( $content, 0, 4 ) == '' )
		$content = substr( $content, 4 );

	/* Remove '' from the end of the string. */
	if ( substr( $content, -3, 3 ) == '' )
		$content = substr( $content, 0, -3 );

	/* Remove any instances of ''. */
	$content = str_replace( array( '<p></p>' ), '', $content );
	$content = str_replace( array( '<p>  </p>' ), '', $content );

	return $content;
}

/*--------------------------------------*/
/*	Slider
/*--------------------------------------*/
function slider_shortcode( $atts, $content = null ){
	extract( shortcode_atts( array(
		'id' => ''
      ), $atts ) );
	  
	$output = '';
	
	//get meta value
	$slides = get_post_meta($id, 'prth_slides', TRUE);
	$slider_animation = get_post_meta($id, 'prth_slider_animation', TRUE);
	$slider_transition = get_post_meta($id, 'prth_slider_transition', TRUE);
	$slider_direction_nav = get_post_meta($id, 'prth_slider_direction_nav', TRUE);
	$slider_control_nav = get_post_meta($id, 'prth_slider_control_nav', TRUE);
	$slider_speed = get_post_meta($id, 'prth_slider_speed', TRUE);
	$slider_animation_duration = get_post_meta($id, 'prth_slider_animation_duration', TRUE);
	$smooth_height = get_post_meta($id, 'prth_smooth_height', TRUE);
	
	//start slider loop
	if ($slides) :
		$output .= '<div class="flexslider-container"><div id="slider-'. $id .'" class="flexslider"><ul class="slides">';
		 foreach ($slides as $slide => $value) {
				if($value['video']){
					//video slide
					$output .= '<li class="slide">';
						$output .= '<div class="video-slide">';
							$output .= wp_oembed_get($value['video']);
						$output .='</div>';
				} else {
					if($value['image']){
						$output .= '<li class="slide">';
						//image style slide
						if($value['lightbox']){
							$output .='<a href="'. $value['lightbox'] .'" title="'. $value['title'] .'" class="prettyphoto-link"><img src="'. $value['image'] .'" alt="'. $value['title'] .'" /></a>';
						} elseif($value['link']){
							$img_class = '';
							$output .='<a href="'. $value['link'] .'" title="'. $value['title'] .'" '.$img_class.'><img src="'. $value['image'] .'" alt="'. $value['title'] .'" /></a>';
						} else {
							$output .='<img src="'. $value['image'] .'" alt="'. $value['title'] .'" />';
						}
						if($value['desc']){
							$output .='<div class="flex-caption-container"><div class="flex-caption"><h3>'.$value['title'].'</h3><br/>'.$value['desc'].'</div></div>';
						}
					}
				}
				$output .='</li>';
		 } //end foreach
		$output .= '</ul></div></div>';
	endif;
	$output .= '<script type="text/javascript">
				jQuery(function($){
					$(window).load(function() {
						$("#slider-'. $id .'").flexslider({
							animation: "'.$slider_animation.'",
							slideshow: '.$slider_transition.',
							slideshowSpeed: '.$slider_speed.',
							animationDuration: '.$slider_animation_duration.',
							directionNav: '.$slider_direction_nav.',
							controlNav: '.$slider_control_nav.',
							smoothHeight: '.$smooth_height.',
							easing: "swing",
							touch: true,
							video: true,
							slideDirection: "horizontal",
							pauseOnAction: true,
							pauseOnHover: true, 
							prevText: \'<i class="icon-chevron-left"></i>\',
							nextText: \'<i class="icon-chevron-right"></i>\',
							randomize: false
						}); //end flexslider
					}); //end window load
				}); //end function
				</script>';			
   	return $output;	  
}
add_shortcode('slider', 'slider_shortcode'); 


/*-----------------------------------------------------------------------------------*/
/* Google Maps
/*-----------------------------------------------------------------------------------*/
function prth_shortcode_googlemaps($atts, $content = null) {
	
	extract(shortcode_atts(array(
			"title" => '',
			"location" => '',
			"width" => '', //leave blank to fill space
			"height" => '300',
			"zoom" => 8,
			"align" => '',
	), $atts));
	
	wp_enqueue_script('googlemap');
	wp_enqueue_script('googlemap_api');
	
	
	$output = '<div id="map_canvas_'.rand(1, 100).'" class="googlemap" style="height:'.$height.'px;width:100%">';
		$output .= (!empty($title)) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
		$output .= '<input class="location" type="hidden" value="'.$location.'" />';
		$output .= '<input class="zoom" type="hidden" value="'.$zoom.'" />';
		$output .= '<div class="map_canvas"></div>';
	$output .= '</div>';
	
	return $output;
   
}

add_shortcode("googlemap", "prth_shortcode_googlemaps");


/*-----------------------------------------------------------------------------------*/
/*	Pricing Tables
/*-----------------------------------------------------------------------------------*/

/*main*/
function prth_pricing_table_shortcode( $atts, $content = null  ) {
   return '<ul class="pricing-table grid-container clearfix">' . do_shortcode($content) . '</ul><div class="clear"></div>';
}
add_shortcode( 'pricing_table', 'prth_pricing_table_shortcode' );


/*section*/
function prth_pricing_shortcode( $atts, $content = null  ) {
	
	extract( shortcode_atts( array(
		'column' => '4',
		'featured' => '',
		'title' => 'Column Title',
		'price' => '$19',
		'price_extra' => '',
		'button_url' => '',
		'button_color' => 'blue',
		'button_text' => 'Buy Now',
		'price' => '$19',
		'price_extra' => 'per month'
	), $atts ) );
	
	//start content  
	$pricing_content ='';
	$pricing_content .= '<li class="pricing grid-'.$column.'">';
	$pricing_content .= '<div class="pricing-header">';
	$pricing_content .= '<h4>'. $title. '</h4>';
	$pricing_content .= '<div class="pricing-cost"><span class="pricing-amount">'. $price .'</span>';
	if($price_extra) {
		$pricing_content .= '<span class="pricing-cost-extra">'.$price_extra.'</span>';
	}
	$pricing_content .= '</div>';
	$pricing_content .= '</div>';
	$pricing_content .= '<div class="pricing-content">';
	$pricing_content .= ''. $content. '';
	$pricing_content .= '</div>';
	if($button_text) {
		$pricing_content .= '<div class="pricing-button"><a href="'. $button_url .'" class="button '. $button_color .'"><span class="button-inner">'. $button_text .'</span></a></div>';
	}
	$pricing_content .= '</li>';
	  
   return $pricing_content;
}

add_shortcode( 'pricing', 'prth_pricing_shortcode' );


/*--------------------------------------*/
/*	testimony
/*--------------------------------------*/
function testimony_shortcode( $atts, $content = null  ) {

	extract( shortcode_atts( array(
		'by' => ''
      ), $atts ) );
	
	$testimony_content = '';
	$testimony_content .= '<article class="testimony"><div class="testimony-content">';
	$testimony_content .= $content;
    $testimony_content .= '</div><div class="testimony-author">';
	$testimony_content .= $by .'</div></article>';
		
	return $testimony_content;
}

add_shortcode( 'testimony', 'testimony_shortcode' );


/*--------------------------------------*/
/*	Togggle
/*--------------------------------------*/
function toggle_shortcode( $atts, $content = null ){
    extract( shortcode_atts(
    array(
      	'title' => 'Click To Open',
      	'color' => '',
	  	'open' => ''
      ),
      $atts ) );
	  
	  	($open == 'true') ? $open = 'active' : '';
        return '<div class="prth-toggle-wrap"><h3 class="trigger '.$open.'"><a href="#" class="trigger-link"><span class="prth-icon-plus-sign"></span>'. $title .'</a></h3><div class="toggle_container">' . do_shortcode($content) . '</div></div>';
}
add_shortcode('toggle', 'toggle_shortcode');

/*--------------------------------------*/
/*	Accordion
/*--------------------------------------*/
function accordion_shortcode( $atts, $content = null  ) {
   return '<div class="prth-accordion">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'accordion', 'accordion_shortcode' );

function accordion_section_shortcode( $atts, $content = null  ) {

    extract( shortcode_atts( array(
      'title' => 'Title',
    ), $atts ) );

   return '<h3 class="trigger">'. $title .'</h3><div>' . do_shortcode($content) . '</div>';
}

add_shortcode( 'accordion_section', 'accordion_section_shortcode' );

/*--------------------------------------*/
/*	Colored Buttons
/*--------------------------------------*/
function button_shortcode( $atts, $content = null ){
	extract( shortcode_atts( array(
		  'color' => 'default',
		  'url' => '',
		  'target' => 'self',
		  'size' => 'small',
		  'align' => ''
      ), $atts ) );
	  if($url) {
		return '<a href="' . $url . '" class="button ' . $color . ' '. $size . ' ' . $align .'" target="_'.$target.'"><span class="button-inner">' . do_shortcode($content) . '</span></a>';
	  } else {
		return '<div class="button ' . $color . ' '. $size . ' ' . $align .'"><span class="button-inner">' . do_shortcode($content) . '</span></div>';
	}
}
add_shortcode('button', 'button_shortcode');

/*--------------------------------------*/
/*	Tabs 
/*--------------------------------------*/
if (!function_exists('tabgroup')) {
	function tabgroup( $atts, $content = null ) {
		$defaults = array();
		extract( shortcode_atts( $defaults, $atts ) );
		
		// Extract the tab titles for use in the tab shortcode
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		if( count($tab_titles) ){
		    $output .= '<div id="tab-shortcode-'. rand(1, 100) .'" class="tab-shortcode">';
			$output .= '<ul class="ui-tabs-nav clearfix">';
			
			foreach( $tab_titles as $tab ){
				$output .= '<li><a href="#tab-'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
			}
		    
		    $output .= '</ul>';
		    $output .= do_shortcode( $content );
		    $output .= '</div>';
		} else {
			$output .= do_shortcode( $content );
		}
		
		return $output;
	}
	add_shortcode( 'tabgroup', 'tabgroup' );
}

if (!function_exists('tab')) {
	function tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		return '<div id="tab-'. sanitize_title( $title ) .'" class="tab-content">'. do_shortcode( $content ) .'</div>';
	}
	add_shortcode( 'tab', 'tab' );
}

/*--------------------------------------*/
/*	Alerts
/*--------------------------------------*/
function alert_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'color' => '',
		'title' => ''
      ), $atts ) );
	  
	  $alert_content = '';
	  $alert_content .= '<div class="alert-' . $color . '">';
	  	if($title) {
			$alert_content .='<h2 class="alert-title">'.$title.'</h2>';
		}
	  $alert_content .= ' '.do_shortcode($content) .'</div>';

      return $alert_content;

}
add_shortcode('alert', 'alert_shortcode');

/*--------------------------------------*/
/*	Columns
/*--------------------------------------*/
function column_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
	  	'offset' =>'',
      	'size' => '',
	  	'position' =>''
      ), $atts ) );


	  if($offset !='') { $column_offset = $offset; } else { $column_offset ='one'; }
		
      return '<div class="'.$column_offset.'-' . $size . ' column-'.$position.'">' . do_shortcode($content) . '</div>';

}
add_shortcode('column', 'column_shortcode');

/*--------------------------------------*/
/*	Gallery
/*--------------------------------------*/
function prth_gallery_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
	  	'columns' => '4',
      	'image_height' => '',
	  	'exclude' => '',
		'lightbox' => ''
      ), $atts ) );
	
	$output = '';
	global $post;

        //number of images
        $get_attachments = get_children( array( 'post_parent' => $post->ID ) );
		
		//get ID of featured image
        $featured_image_id = get_post_thumbnail_id( $post->ID );
		
		//generate random number for each gallery
		$rand_gallery = rand();
		
        //attachement loop
        $args = array(
            'orderby' => 'menu_order',
            'post_type' => 'attachment',
            'post_parent' => get_the_ID(),
            'post_mime_type' => 'image',
            'post_status' => null,
            'posts_per_page' => -1,
			'exclude' => $exclude
        );
        $attachments = get_posts($args);
		
		//show gallery only if attachments exist
        if ($attachments) {
			
		$output .= '<article class="gallery-wrap grid-container clearfix">';
		
		//start attachment loop
		foreach ($attachments as $attachment) :
		
		
		
		//featured image
		($image_height) ? $image_attach_height = 450 * str_replace('%', '', $image_height) / 100 : $image_attach_height = 450;
		$thumb = $attachment->ID;
		$img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
		$featured_image = aq_resize( $img_url, 450, $image_attach_height, true ); //resize & crop the image
	
		//output image
		$output .='<div class="gallery-photo grid-'.$columns.'">';
		$output .= '<a href="'. $img_url .'" class="single-gallery-thumb"';
		if($lightbox !='no'){
			$output .= 'rel="prettyPhoto['.$rand_gallery.']"';
		}
		$output .= 'title="'. apply_filters('the_title', $attachment->post_title) .'"><img src="'. $featured_image .'" alt="'. apply_filters('the_title', $attachment->post_title) .'" class="attachment-post-thumbnail" /></a>';
		$output .='</div>';
    
		//end loop
		endforeach;
		$output .='</article>';
    
	}
   	return $output;
   
}

add_shortcode( 'prth_gallery', 'prth_gallery_shortcode' );
?>