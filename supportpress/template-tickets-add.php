<?php
/**
 * IcarusThemes
 * Template Name: Add Ticket Page
*/
ob_start();

//get global variables
global $itdata;

//get template heade <= careful don't delete me
get_header();
require_once ( 'includes/body-top.php' );

	
$demo = true;

if ($demo == true){ } else {

$assigned = '';
$postTitleError = '';

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	$hasError = false;

	if(trim($_POST['postTitle']) === '') {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	} else {
		$postTitle = trim($_POST['postTitle']);
	}


	if($_POST['postContent'] === '') {
	} else {
		$postContent = $_POST['postContent'];
	}


	if(trim($_POST['cat']) === '') {
	} else {
		$cat = $_POST['cat'];
	}


	$requestedid = $current_user_id;


	if (isset($hasError) && ($hasError == true)){ } else {

	$post_information = array(
		//'ID' => esc_attr(strip_tags($_POST['postid'])),
		'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
		'post_content' => $_POST['postContent'],
		'post_type' => 'tickets',
		'post_status' => 'publish'
	);

	$post_id = wp_insert_post($post_information);


	if ($_FILES) {
		foreach ($_FILES as $file => $array) {
		$newupload = insert_attachment($file,$post_id, true);
		// $newupload returns the attachment id of the file that
		// was just uploaded. Do whatever you want with that now.
		}
	} 


	if ($post_id)
	{
		

		// Update Custom Meta
		update_post_meta($post_id, 'prth_ticket_requested', $requestedid);
		update_post_meta($post_id, 'prth_ticket_priority', '1');
		update_post_meta($post_id, 'prth_ticket_status', 'open');

		//add categories
		wp_set_post_terms($post_id, $cat, 'tickets_cats' );
	
		//set_post_thumbnail( $post_id, $newupload );

		$url = get_permalink( $post_id );

		// GET ASSIGNED USER'S EMAIL (& EMAIL THEM)
	
		if (isset($requestedid)){
			
		//get blog title	
		$blog_title = get_bloginfo('name');	
		$blog_email = get_bloginfo('admin_email');	
			
		$headers = 'From: '.$blog_title.' <'.$blog_email.'>';
			
			$requested_email = get_the_author_meta( 'user_email', $requestedid );
			$requested_subject = 'Ticket Submitted: '.$_POST['postTitle'].'';
			$requested_message = 'You ticket has been submitted and will be responded to as soon as possible. You can view it here: '.$url.'';
			wp_mail($requested_email, $requested_subject, $requested_message, $headers);
		}

		wp_redirect($url);
		exit;

	} // end if post
	
	} // end if no error

} // end if post

} // end if demo

//loop
if (have_posts()) : while (have_posts()) : the_post();

?>
<header id="page-heading">
   <!-------- CHECK FOR LOGGED IN OR NOT ----------->
        
    <?php 
			
	if ( ( is_single() || is_front_page() || is_page() ) 
		&& !is_page('login') && !is_user_logged_in()){  ?>


			
	<?php  } else //if logged in
	 
	{  ?>
				       
	<h1><?php the_title(); ?></h1>

	<?php } // end if logged in ?>
</header><!-- /page-heading -->

<div id="post" class="clearfix">
	
    <?php
	//show page content if not empty
    $content = $post->post_content;
    if(!empty($content)) { ?>
        <div id="tickets-add" class="clearfix">
            <?php the_content(); ?>
        </div><!-- tickets-add -->
        
     <?php } ?>

       
        
        <!-------- CHECK FOR LOGGED IN OR NOT ----------->
        
        <?php 
			
			if ( ( is_single() || is_front_page() || is_page() ) 
			       && !is_page('login') && !is_user_logged_in()){ 
			
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
				
					<form name="log inform" id="log inform" action="<?php echo home_url(); ?>/wp-login.php" method="post">
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
            <form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">  
				
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
				
?>

				
        <div id="contact-form">		
		<form action="" id="primaryPostForm" method="POST" enctype="multipart/form-data">

			<!-- TITLE -->
			<fieldset>
				<h3 class="margintop0" class="heading"><span>Subject</span></h3>
				<span>A short subject line regarding your issue.</span><br/>
				<input type="text" name="postTitle" id="postTitle" class="width40p" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="required" />
			</fieldset>
			



			<!-- CATEGORY -->
			<h2 class="heading margintop40"><span>Category</span></h2>
			<span>Which category best describes the type of problem you are having?</span>
		
			<div class="form-section">
				<fieldset>
		
								<?php $args = array(
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'style' => 'list',
                                    'hide_empty' => 1,
                                    'hierarchical' => true,
                                    'title_li' => '',
                                    'taxonomy' => 'tickets_cats',
									'offset' => null
                                  );
                                ?> 
                                 <?php wp_dropdown_categories( $args ); ?> 
               </fieldset>
           </div>




			<!-- DESCRIPTION -->
			<?php if(isset($postTitleError) && ($postTitleError != '')) { ?>
				<div class="alert alert-danger"><?php echo $postTitleError; ?></div>
				<div class="clearfix"></div>
			<?php } ?>

			<fieldset>
				<h3 class="heading margintop40"><span>Issue</span></h3>
				<span>Explain the problem you are experiencing</span>
			
			<?php 
			/*
			<textarea style="display:none;" class="textarea" name="postContent" id="postContent" rows="8" cols="30"><?php if(isset($_POST['postContent'])) echo $_POST['postContent'];?></textarea>
			*/
			
			$args = array(
				'media_buttons'			=> false,
			    'textarea_rows'         => 20 // integer
			); 

			$postCont = '';
			if(isset($_POST['postContent'])) { $postCont = $_POST['postContent']; }
			wp_editor( $postCont, 'postContent', $args ); ?> 
 			</fieldset>



			<!-- COVER ART -->
			<fieldset class="images">
				<h3 class="heading margintop40"><span>Additional Files</span></h3>
				<span>Screenshots or any additional file which will help us identify the problem.</span><br/>
				<input type="file" name="ticket_img" id="ticket_img" size="50" class="addticketimg">
			</fieldset>

 		

  	  	<div class="clearfix"></div>
		<br/>


		<div class="form-actions margintop40">
			<fieldset>
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit" class="button giant blue height50"><span class="button-inner bordertop0"><?php _e('Add Ticket', 'framework') ?></span></button>
			</fieldset>
		</div>

		</form>
	</div>       
            
				
				
				
<?php				
				
				
			} // end if not logged in
       

	//reset query
	wp_reset_query(); 

?>

</div><!-- /post -->

<?php
//end page loop
endwhile; endif;

//get tmeplate footer
get_footer(); 

ob_flush();
?>