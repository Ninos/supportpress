<?php
/**
 * IcarusThemes
 * Template Name: Login
*/

//get global variables
global $itdata;

//get template heade <= careful don't delete me
get_header();
require_once ( 'includes/body-top.php' );

//loop
if (have_posts()) : while (have_posts()) : the_post();



//grid style
$tickets_grid_style = get_post_meta($post->ID, 'prth_grid_style', true); //get grid style meta
$tickets_grid_class = prth_grid($tickets_grid_style); //set grid style

//grid image height
$tickets_grid_image_height_meta = get_post_meta($post->ID, 'prth_grid_image_height', true);
($tickets_grid_image_height_meta) ? $tickets_grid_image_height = 450 * str_replace('%', '', $tickets_grid_image_height_meta) / 100 : $tickets_grid_image_height = 450;

//set parent taxonomy
$tickets_parent = get_post_meta($post->ID, 'prth_tickets_parent', true);
$tickets_filter_parent = '';
($tickets_parent != 'select_tickets_cats_parent') ? $tickets_filter_parent = $tickets_parent : $tickets_filter_parent = NULL;
?>
<style>
	.table th,
	.table td {
	  line-height: 13px;
	}
	.table th {
		padding:20px 20px 20px 7px;
	}

</style>
<header id="page-heading">
	<h1><?php the_title(); ?></h1>	
</header><!-- /page-heading -->

<div id="full-width" class="clearfix">
	
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
			       && !is_user_logged_in()){ 
			
				//user is not logged in
			    //auth_redirect(); 

			    ?>
			    
			    
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
			
			}
       
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