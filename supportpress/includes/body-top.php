<?php 
//get global variables

global $itdata;


    wp_get_current_user();

    global $current_user_username;
    global $current_user_email;
    global $current_user_firstname;
    global $current_user_lastname;
    global $current_user_displayname;
    global $current_user_id;
    global $myprofile;
 
    $current_user_username = $current_user->user_login;
    $current_user_email = $current_user->user_email;
   	$current_user_firstname = $current_user->user_firstname;
    $current_user_lastname = $current_user->user_lastname;
    $current_user_displayname = $current_user->display_name;
    $current_user_id = $current_user->ID;
    
    $user_role = get_user_role();
	     
	    if ( current_user_can( 'manage_options' ) ) {
	    	$isadmin = true;
		} else {
	    	//$isadmin = false;
	    			// for demo
			$isadmin = true;
	
		}

  if (isset($itdata['translation_administrator']) && ($itdata['translation_administrator'] !== '')) { $adminword = $itdata['translation_administrator']; global $adminword; } else { $adminword = 'administrator'; global $adminword; }
if (isset($itdata['translation_editor']) && ($itdata['translation_editor'] !== '')) { $editorword = $itdata['translation_editor']; global $editorword; } else { $editorword = 'editor'; global $editorword; }
if (isset($itdata['translation_subscriber']) && ($itdata['translation_subscriber'] !== '')) { $subword = $itdata['translation_subscriber']; global $subword; } else { $subword = 'subscriber'; global $subword; }

		
	$loginpage = $itdata['login_page'];		
	
	$avatar	= get_avatar( $current_user_email, 74 );

	$today = date(get_option('date_format'));

?>
         
              <div id="responsive-login">
        
       
				<!-- INSERT LOGGED IN INFO HERE - RESPONSIVE, PHONE -->	            
				<span>
				<?php echo $avatar; ?>
				<a href="<?php echo wp_logout_url( home_url() ); ?>">Log Out</a>
				</span>
       
       
            </div><!-- /res[onsivelogin -->


        </div><!-- /topbar-inner -->
    </div><!-- /topbar -->

<div id="wrap" class="outer-container insidepages clearfix">

	<div id="content-main" class="clearfix fitvids-container">

	<?php
	//run this on pages only
	if(is_page() && !is_attachment()) {
		
		//show large featured images on pages
		$full_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
		if($full_img) { echo '<div id="featured-image"><img src="'. $full_img[0] .'" alt="'. get_the_title() .'" /></div>'; }
		
		//show sliders if selected
		global $post;
		$page_slider = get_post_meta($post->ID, 'prth_page_slider', TRUE); //get slider meta
		
		if($page_slider != 'no_slider' && $page_slider != '') { ?>
			<div id="full-slider"><?php echo do_shortcode("[slider id=".$page_slider."]"); ?></div><!--/full-slider -->
		<?php }
	}
	?>
 