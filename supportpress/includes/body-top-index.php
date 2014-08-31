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


<?php
if($itdata['home_slider'] != 'Select') {
		?>
		<div id="full-slider"><?php echo do_shortcode("[slider id=".$itdata['home_slider']."]"); ?></div><!--/full-slider -->
		<?php
		}

?>


<div id="wrap" class="outer-container clearfix" <?php if($itdata['home_slider'] == 'Select'){ echo 'style="margin-top:70px;"'; } ?>>

	<div id="content-main" class="clearfix fitvids-container">

