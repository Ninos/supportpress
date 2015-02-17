<?php
/**
 * IcarusThemes
 * Template Name: Admin Options
*/

//get global variables
global $itdata;

//get template heade <= careful don't delete me
get_header();
require_once ( 'includes/body-top.php' );



$demo = true;
$updated = false;

if ($demo == true){ } else {


if(isset($_POST['assign'])){


	if(trim($_POST['userid']) === '') {
	} else {
		$userid = trim($_POST['userid']);
	}

	if(trim($_POST['cats']) === '') {
	} else {
		$cat = $_POST['cats'];
	}
	
	if($userid)
	{
		
		// Update Custom Meta
		update_user_meta( $userid, 'hd_category', $cat );
		
		//wp_redirect($_SERVER['REQUEST_URI']);
		//exit;	
		$updated = true;
		$output = $userid;
		
	}

}





} // end if demo




//loop
if (have_posts()) : while (have_posts()) : the_post();

$loginpage = $itdata['login_page'];

//posts per page
$template_posts_per_page = get_post_meta($post->ID, 'prth_template_posts_per_page', true);

//grid style
$staff_grid_style = get_post_meta($post->ID, 'prth_grid_style', true); //get grid style meta
$staff_grid_class = prth_grid($staff_grid_style); //set grid style

//grid image height
$staff_grid_image_height_meta = get_post_meta($post->ID, 'prth_grid_image_height', true);
($staff_grid_image_height_meta) ? $staff_grid_image_height = 450 * str_replace('%', '', $staff_grid_image_height_meta) / 100 : $staff_grid_image_height = 450;

?>
<style>
.table-avatar img { border-radius: 50%; -webkit-border-radius: 50%; }
select { margin-bottom:0px;margin-right:20px;float:left; }
</style>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>	
</header><!-- /page-heading -->

	
    <?php
	//show page content if not empty
    $content = $post->post_content;
    if(!empty($content)) { ?>
        <div id="tickets-description" class="clearfix">
            <?php the_content(); ?>
        </div><!-- tickets-description -->
        
     <?php } ?>

       
        
        <!-------- CHECK FOR LOGGED IN OR NOT ----------->
        
        <?php 
			
			if ( ( is_single() || is_front_page() || is_page() ) 
			       && !is_page('login') && !is_user_logged_in()){ 
			
				//user is not logged in
			    //auth_redirect(); 

			    ?>
			    <div id="full-width" class="clearfix">
			    
			    
			    <div class="alert-yellow">
			    	<h2 class="alert-title">User is not logged in</h2> 
			    	You can log in below or sign up for our support site below.
			    </div>
			    
			    	<div class="one-half column-first adminoptionhalfleft">

				    	<div class="title">  
					    	<h1>Sign-in to your Account</h1>  
					    </div>  
				
					<form name="log inform" id="log inform" action="<?php echo wp_login_url(); ?>" method="post">
					<p>
						<label>Username<br />
						<input type="text" name="log" id="user_login" class="input width300" value="" size="20" tabindex="10" /></label>
					</p>

					<p>
						<label>Password<br />
						<input type="password" name="pwd" id="user_pass" class="input width300" value="" size="20" tabindex="20" /></label>
					</p>

					<p class="submit">
						<input type="submit" name="wp-submit" id="wp-submit" class="btn btn-large btn-success textalignleft marginbottom20" value="Log In" tabindex="100" />
						<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>" />
				
						<input type="hidden" name="test cookie" value="1" />
					</p>
					</form>
			
					<p id="nav">
					<label class="marginbottom0 inlineblock">
						<input name="remember me" type="checkbox" id="remember me" value="forever" tabindex="90" /> Remember Me</label><br/>
						<span class="margintop10up">
						<a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" title="Password Lost and Found">Lost password?</a>
						</span>
					</p>
				
				
					</div>


					<div class="one-half column-last">
						
<div> <!-- Registration -->  
        <div id="register-form">  
        <div class="title">  
            <h1>Register your Account</h1>  
        </div>  
            <form action="<?php echo wp_registration_url(); ?>" method="post">  
				
				<p>
					<label>Username<br />
					<input type="text" name="user_login" value="" id="user_login" class="input" /></label>
				</p>
				
				<p>
					<label>Email Address<br />
					<input type="text" name="user_email" value="" id="user_email" class="input"  /></label> 
				
				</p>
                
                <?php do_action('register_form'); ?>  
				
				<p class="submit">
                	<input type="submit" value="Register" id="register" />  
				</p>
            
            <hr />  
            <p class="statement">A password will be e-mailed to you.</p>  
              
              
            </form>  
        </div>  
</div><!-- /Registration -->  

					</div>

		<?php
			
			} else {


		    /* -------- IF ADMIN - SEE ADMIN TICKET VIEW ----------- */
                
			if ($user_role == "administrator") {	
				$isadmin = true;
				$userrole = 'Admin';

					//echo $userrole;
				    //echo '<br/>';
				    //echo $current_user_displayname;

		?>
		<div id="post" class="clearfix">

	<?php 
	
		if ($updated == true) { 
			$single = true;
			$updated_user = get_userdata($output);
			$updated_user2 = $updated_user->display_name;
			
			?>
			
			<div class="alert-green">
				<h2 class="alert-title">Success</h2> 
				You have updated <?php echo $updated_user2;?>!
			</div>
			<br/>
		<?php }
	
	?>

		
		<h2 class="margintop0">Assign Editor Categories</h2>
		
		<div id="portfolio-wrap clearfix">
		    <div class="adminoptionscat">
		    	<div class="adminoptionsuser">User</div>
	    		<div class="adminoptionssel">Assigned Category</div>
	    	</div>
	    <?php
         
         	$sublist = '';
         	$hdlist = '';
         	$ticket_cat = '';
         	$ownerid = '';
         
			//GET THE TICKET CATEGORY
			//$term_list = wp_get_post_terms($post->ID, 'tickets_cats', array("fields" => "ids"));
			//$ticket_cat = $term_list[0];

			$args1 = array(
				'role'         => 'Editor',
				'include'      => array(),
				'exclude'      => array(),
				'orderby'      => 'login',
				'order'        => 'ASC',
				'offset'       => '',
				'search'       => '',
				'number'       => '',
				'count_total'  => false,
				'fields'       => 'all',
				'who'          => ''
			 );
			
			 $blogusers = get_users( $args1 ); 

				    foreach ($blogusers as $user) {
				    $sublist .= '' . $user->ID . ', ';
				    
				    }
						
									$args2 = array(
											'meta_query'   => array(
											array(
												'key'     => 'hd_category',
												'value'   => ''.$ticket_cat.'',
												'compare' => '=',
											),
										),
									);
									
									 //$blogusers2 = get_users( $args2 ); 
									 $blogusers2 = new WP_User_Query( $args2 );
										    foreach ($blogusers2->results as $user2) {
										    $hdlist .= '' . $user2->ID . ', ';
										    
										    }
						
				    				
			$args = array(
			    'show_option_all'         => null, // string
			    'show_option_none'        => null, // string
			    'hide_if_only_one_author' => null, // string
			    'orderly'                 => 'display_name',
			    'order'                   => 'ASC',
			    //'include'                 => ''.$hdlist.'', // string
			    'exclude'                 => ''.$sublist.'', // string
			    'multi'                   => false,
			    'show'                    => 'display_name',
			    'echo'                    => true,
			    'selected'                => ''.$ownerid.'',
			    'include_selected'        => false,
			    'name'                    => 'assignee', // string
			    //'id'                      => null, // integer
			    'class'                   => 'assignee', // string 
		    ); 
		    
		    $userlist = '';
		    
		    $blogusers2 = new WP_User_Query( $args1 );
		    	foreach ($blogusers2->results as $user2) {
		    		$useremail = $user2->user_email;
		    		$usercat = $user2->hd_category;
		    		$userID = $user2->ID;
		    		$avatar	= get_avatar( $useremail, 50 );
			    	$userlist .= '<form action="" method="POST" name="assign" id="assign-'.$userID.'">';
			    	$userlist .= '<div class="userlistouter">';
			    	$userlist .= '<div class="floatleft width40p">';
			    		$userlist .= '<div class="table-avatar floatright marginright20">'.$avatar.'</div>';
			    		$userlist .= '<div class="userlist">' . $user2->display_name . '</div>';
			    	$userlist .= '</div>';
			    	$userlist .= '<div class="userlist2">';			    		
				    	$userlist .= '<div><div>';
				    	
				    			$args3 = array(
	                                    'orderby' => 'name',
	                                    'order' => 'ASC',
	                                    'style' => 'list',
	                                    'show_count' => true,
	                                    'hide_empty' => false,
	                                    'hierarchical' => true,
	                                    'title_li' => '',
	                                    'selected' => $usercat,
	                                    'echo' => false,
	                                    'id' => $userID,
	                                    'taxonomy' => 'tickets_cats',
										'offset' => null
	                                  );
	                               
	                               
	                             $userlist .= wp_dropdown_categories( $args3 );
	
		                 $userlist .= '</div>';
		                 $userlist .= '<p class="form-submit marginbottom0">';
		                 $userlist .= '<input name="assign" type="submit" id="assign" class="assigninput" value="Assign">';
		                 $userlist .= '<input type="hidden" name="assign" id="assign" value="true" />';
		                 $userlist .= '<input type="hidden" name="userid" id="userid" value="'.$userID.'">';
		                 $userlist .= '</p>';
		                 $userlist .= '</div>';
			    	$userlist .= '</div></div></form>';
			    	}
		    
		    echo $userlist;
		    
		    ?>
		
		
		    <?php //wp_dropdown_users( $args ); ?>
                
                
                
        </div><!-- /projects-wrap -->
        
        <?php




			} else {
				
				?>
			<div class="alert-error">
				<h2 class="alert-title">Sorry</h2> 
				You are not able to view this page.
			</div>
			<br/>
			<?php
				
				
			} // END OF ADMIN CHECK
  
  } // if logged in
       
		 //show pagination
		 pagination();


	//reset query
	wp_reset_query(); 


	?>

</div><!-- /post -->

<?php
//end page loop
endwhile; endif;

//get tmeplate footer
get_footer(); ?>