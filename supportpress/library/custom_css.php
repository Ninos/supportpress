<?php
/**
 * Custom CSS For wp_head Hook = prth_custom_css()
*/

//it would be silly to run this large function in the admin.
if (! is_admin()) {
	
	//hook function
	add_action('wp_head', 'prth_custom_css');
	
	//begin function
	function prth_custom_css() {
	
		//get global vars for use in this function
		global $itdata, $post;
		
		$custom_css ='';
		
		/**custom css field**/
		if($itdata['custom_css']) {
			$custom_css .= $itdata['custom_css'];
		}
	
			/* body backgrounds */
			$custom_background_options = array('main');
			$custom_background_classes = 'body';
			
			//loop through each background option
			foreach($custom_background_options as $custom_background_option) {
									
					//background option
					if($itdata[''.$custom_background_option.'_background'] || $itdata[''.$custom_background_option.'_background_custom']) {
						
					//if pattern is not set to none or if custom background option isnt empty
					if($itdata[''.$custom_background_option.'_background'] !=''.get_template_directory_uri().'/images/background/none.png' || $itdata[''.$custom_background_option.'_background_image'] !='') {
						
						//set default background
						$custom_background_image = ($itdata[''.$custom_background_option.'_background_image']) ? $itdata[''.$custom_background_option.'_background_image'] : $itdata[''.$custom_background_option.'_background'];
						
						//full style background
						if($itdata[''.$custom_background_option.'_background_style'] == 'full') {
							$custom_css .= $custom_background_classes.'{background: url('.$custom_background_image.') no-repeat center center fixed;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size: cover;background-size: cover}';
						
						} else {
							
							//regular background
							$custom_css .= $custom_background_classes.'{background-image: url('.$custom_background_image.'); background-repeat: '.$itdata[''.$custom_background_option.'_background_style'].'; -webkit-background-size: auto;-moz-background-size: auto;-o-background-size: auto;background-size: auto;}';
						}
					} else {
						//no background
						$custom_css .= $custom_background_classes.'{background-image: none}';
						}
					}
					
					//color options
					if($itdata[''.$custom_background_option.'_background_color']) {
						$custom_css .= $custom_background_classes .'{background-color: '.$itdata[''.$custom_background_option.'_background_color'].'}';
					}
								
			} //end loop
			
			
		/*container background colors*/
		
		
		//array of areas that have background color options
		$custom_bg_containers = array();
		
		//loop through containers and apply background from admin option
		foreach($custom_bg_containers as $custom_bg_container) {
			
			//retrieve background option for containers (in the admin set the option with an id such as header_bg)
			$custom_bg = $itdata[''.$custom_bg_container.'_bg'];
			
			//output css
			if($custom_bg){
				$custom_css .= '.'. $custom_bg_container .'{background-color: '.$custom_bg.'}';
			}
		
		}
		
		
		/* main */
		
		//header
		if($itdata['header_logo_topmargin'] && $itdata['header_logo_topmargin']!='0px') {
			$custom_css .= '#logo{margin-top: '.$itdata['header_logo_topmargin'].';}';
		}
		if($itdata['header_right_topmargin'] && $itdata['header_right_topmargin']!='0px') {
			$custom_css .= '#header-right{margin-top: '.$itdata['header_right_topmargin'].';}';
		}
		
		//sidebar location
		if($itdata['sidebar_position'] == 'left') {
			$custom_css .= '#sidebar {float: left} #post{float: right}';
		}
		
		
		/* hovers */
		
		//containers with hovers
		$custom_overlay_containers = array('blog');
		
		
		//loop through containers and apply background from admin option
		foreach($custom_overlay_containers as $custom_overlay_container) {
			
			//retrieve background option for containers (in the admin set the option with an id such as header_bg)
			$custom_overlay_color = $itdata[''.$custom_overlay_container.'_overlay_color'];
			$custom_overlay_opacity = $itdata[''.$custom_overlay_container.'_overlay_opacity'];
			
			//output color css
			if($custom_overlay_color){
				$custom_css .= 'body .'. $custom_overlay_container .'-entry-img-link:hover{background: '.$custom_overlay_color.'}';
			}
			
			//output opacity css
			if($custom_overlay_opacity){
				$custom_css .= 'body .'. $custom_overlay_container .'-entry-img:hover{opacity: '.$custom_overlay_opacity.'; -webkit-opacity: '.$custom_overlay_opacity.'; -moz-opacity: '.$custom_overlay_opacity.'}';
			}
			
		
		}
		
		
		/**echo all css**/
		$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $custom_css . "\n</style>";
		
		if(!empty($custom_css)) {
			echo $css_output;
		}
		
	} //end prth_custom_css()

} //is admin
?>