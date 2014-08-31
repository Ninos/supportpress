<?php
/**
 * IcarusThemes
 */

ob_start();
 
//get global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

$demo = true;

if ($demo == true){ } else {

$updated = '';
$assigned = '';

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	$hasError = false;

	if($_POST['postid'] === '') {
		$hasError = true;
	} else {
		$postid = $_POST['postid'];
	}

	if($_POST['assignedid'] === '') {
		$hasError = true;
	} else {
		$assigned = $_POST['assignedid'];
	}

	if($_POST['ticket_title'] === '') {
		$hasError = true;
	} else {
		$ticket_title = $_POST['ticket_title'];
	}

	if (isset($hasError) && ($hasError == true)){  } else {

		// Update Custom Meta
		update_post_meta($postid, 'prth_ticket_assigned', $assigned);

		$url = get_permalink( $postid );

		// GET ASSIGNED USER'S EMAIL (& EMAIL THEM)
	
		if (isset($assigned)){
			
		//get blog title	
		$blog_title = get_bloginfo('name');	
		$blog_email = get_bloginfo('admin_email');	
			
		$headers = 'From: '.$blog_title.' <'.$blog_email.'>';
			
			$requested_email = get_the_author_meta( 'user_email', $assigned );
			$requested_subject = 'Ticket Assigned: '.$ticket_title.'';
			$requested_message = 'A ticket has been assigned to you. You can view it here: '.$url.'';
			wp_mail($requested_email, $requested_subject, $requested_message, $headers);
		}


//		wp_redirect($url);
//		exit;

	
	} // end if no error

} // end if post



if(isset($_POST['metachange'])){


	if(trim($_POST['postid']) === '') {
	} else {
		$postid = trim($_POST['postid']);
	}
	
	if(trim($_POST['status']) === '') {
	} else {
		$status_change = trim($_POST['status']);
	}
	
	if(trim($_POST['priority']) === '') {
	} else {
		$priority_change = trim($_POST['priority']);
	}
	
	if($postid)
	{
		
		// Update Custom Meta
		update_post_meta($postid, 'prth_ticket_status', $status_change);
		update_post_meta($postid, 'prth_ticket_priority', $priority_change);

		//wp_redirect($_SERVER['REQUEST_URI']);
		//exit;	
		$updated = true;	
		
	}

}



if(isset($_POST['assignto'])){


	if(trim($_POST['postid']) === '') {
	} else {
		$postid = trim($_POST['postid']);
	}
	
	if(trim($_POST['assignee']) === '') {
	} else {
		$assignee = trim($_POST['assignee']);
	}
	
	if($postid)
	{
		
		// Update Custom Meta
		update_post_meta($postid, 'prth_ticket_assigned', $assignee);

		//wp_redirect($_SERVER['REQUEST_URI']);
		//exit;	
		$updated = true;	
		
	}

}





} // end if demo




//start post loop
if (have_posts()) : while (have_posts()) : the_post();

$postid = $post->ID;
$ticket_title = get_the_title();

//get meta
$tickets_meta = get_post_meta($post->ID, 'prth_tickets_meta', TRUE);

//get terms
$terms = get_the_term_list( get_the_ID(), 'tickets_cats' );

//get the ticket owner
$ownerid = get_post_meta($post->ID, 'prth_ticket_assigned', true);
if ( $ownerid != '') { $assignedname = get_the_author_meta( 'display_name', $ownerid ); } else { $assignedname = '-'; }

//get the ticket requestor
$requestedid = get_post_meta($post->ID, 'prth_ticket_requested', true);
if ( $requestedid != '') { $requestedname = get_the_author_meta( 'display_name', $requestedid ); $requestedemail = get_the_author_meta( 'user_email', $requestedid ); } else { $requestedname = '-'; }

//get ticket meta
$status = '';
$status = get_post_meta($post->ID, 'prth_ticket_status', true);
if ($status == 'open'){ $status = 'Open'; } if ($status == 'closed'){ $status = 'Closed'; }

$priority = '';
$priority = get_post_meta($post->ID, 'prth_ticket_priority', true);
if ($priority == '1'){ $priority = 'Low'; } if ($priority == '2'){ $priority = 'Medium'; } if ($priority == '3'){ $priority = 'High'; }
	
$avatar	= get_avatar( $requestedemail, 50 );
	
?>

<header id="page-heading">

    <!-------- CHECK FOR LOGGED IN OR NOT ----------->
        
    <?php 
			
	if ( ( is_single() || is_front_page() || is_page() ) 
		&& !is_page('login') && !is_user_logged_in()){  ?>


			
	<?php  } else //if logged in
	 
	{  ?>
				       
	<div id="sub-header-pic" class="floatleft marginright20">
		<?php echo $avatar; ?>
	</div>
	<h1 class="margintop10"><?php the_title(); ?></h1>

	<?php } // end if logged in ?>

</header><!-- /page-heading -->




      
        <!-------- CHECK FOR LOGGED IN OR NOT ----------->
        
        <?php 
			
			if ( ( is_single() || is_front_page() || is_page() ) 
			       && !is_page('login') && !is_user_logged_in()){ 
			
				//user is not logged in
				//wp_redirect(''.$loginpage.'');
				//exit;
			    ?>

<article id="full-width" class="single-tickets clearfix"> 
			    
			    <div class="alert-yellow">
			    	<h2 class="alert-title">User is not logged in</h2> 
			    	You can log in below or sign up for our support site below.
			    </div>
			    
			     
			    	<div class="one-half column-first ticketstop">

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
					<label class="ticketslabel">
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
					<input type="text" name="user_login" value="" id="user_login width300" size="20" class="input" /></label>
				</p>
				
				<p>
					<label>Email Address<br />
					<input type="text" name="user_email" value="" id="user_email width300" class="input"  /></label> 
				
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
			
			} else // if logged in 
			
			{


   ?>
   
   <article id="post" class="single-tickets clearfix"> 
	   
	<?php 
	
		if ($updated == true) { ?>
			
			<div class="alert-green">
				<h2 class="alert-title">Success</h2> 
				You have updated this ticket!
			</div>
			<br/>
		<?php }
	
	?>
	   
	   
	<?php

	//show tickets meta if not disabled
	if($tickets_meta !='disable') { ?>
	<section id="single-meta" class="meta clearfix" >
        <ul>
           <li><icon class="icon-calendar margintop1up"></icon> Opened: <?php the_date(); ?></li>
           <?php if($terms) { ?><li><icon class="icon-tags margintop1up"></icon> Categories: <?php echo get_the_term_list( get_the_ID(), 'tickets_cats', '', ', ', ' ') ?></li><?php } ?>
           <li><icon class="icon-user margintop1up"></icon> Requested by: <?php echo $requestedname;  ?></li>
           <li><icon class="icon-flag margintop1up"></icon> Assigned to: <?php echo $assignedname;  ?></li>
        </ul>
	</section><!-- /meta -->
    <?php } ?>
    
           

    <article id="single-tickets-info" class="entry clearfix">
	    <?php the_content(); ?>
    </article><!-- /single-tickets-info -->
  
<style>
#ticket-comment, #commentsbox {
	margin-top:0px;
}
</style>
  
         <div id="single-tickets-media" class="width40p">
        
            <?php
            //get featured image url
            $thumb = get_post_thumbnail_id();
            $img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
                
            $featured_image = aq_resize( $img_url, 740, 9999, false );
            
            if($featured_image) {
            ?>
    	<h4>Attached File:</h4>
                <div class="post-thumbnail marginbottom40">
                    <a href="<?php echo $img_url; ?>" title="<?php the_title(); ?>" class="prettyphoto-link">
                        <img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" />
                    </a>
                </div><!-- /post-thumbnail -->
            <?php
                } //no featured image
            ?>
 
         </div>
    

    <div id="tab-shortcode ticket-comment" class="tab-shortcode margintop40">
    	<ul class="ui-tabs-nav clearfix">
    		<li><a href="#tab-tab-1">Comments</a></li>
    		<li><a href="#tab-tab-2">Quick Chat</a></li>
    	</ul>
    	
    	<div id="tab-tab-1" class="tab-content">
	    	<?php comments_template(); //show comments ?>
    	</div>
    	<div id="tab-tab-2" class="tab-content">
	    	<?php echo do_shortcode('[quick-chat height="200" room="'.$postid.'" userlist="1" userlist_position="left" smilies="0" send_button="1" loggedin_visible="0" guests_visible="1" avatars="1" counter="1"]'); ?>
    	</div>
    	
    </div>
    
    

    
    
    <?php } // end if not logged in ?>
    
</article><!-- /post -->

<?php  
//end post loop
endwhile; endif;

//get template sidebar
?>
<div id="sidebar">

	<?php if (($user_role == "$adminword") || ($user_role == "$editorword")) { ?>

	<div class="textwidget">
		<div class="alert-blue">
		<h2 class="alert-title">Ticket Meta</h2>
		<div class="ticketdiv">
			<span class="marginright20">Ticket Status:</span>
			<form action="" method="POST" name="metachange" id="metachange" class="ticketform">
				<select name="status" class="ticketselect">
					<option <?php if ($status == 'Open') { echo 'selected="selected" '; } ?>value="open">Open</option>
					<option <?php if ($status == 'Closed') { echo 'selected="selected" '; } ?>value="closed">Closed</option>
				</select>
			
		</div>
		<div class="heightauto overflowauto">
	
			<span class="marginright20">Ticket Priority:</span>
			<div class="floatright">
				<select name="priority" class="ticketselect">
					<option <?php if ($priority == 'Low') { echo 'selected="selected" '; } ?>value="1">Low</option>
					<option <?php if ($priority == 'Medium') { echo 'selected="selected" '; } ?>value="2">Medium</option>
					<option <?php if ($priority == 'High') { echo 'selected="selected" '; } ?>value="3">High</option>
				</select>
				<p class="form-submit">
					<input name="metachange" type="submit" id="metachange" class="ticketinput" value="Update Meta">
					<input type="hidden" name="metachange" id="metachange" value="true" />
					<input type="hidden" name="postid" id="postid" value="<?php echo $postid; ?>">
					<input type="hidden" name="assignedid" id="assignedid" value="<?php echo $current_user_id; ?>">
					<input type="hidden" name="ticket_title" id="ticket_title" value="<?php echo $ticket_title; ?>">
					
				</p>
			</div>
			</form>
		
		</div>

			
		</div>

	</div>

	<hr/>
	
	<?php } // end if able to change meta ?>


	<?php if ($user_role == "$subword") { ?>

	<div class="textwidget">
		<div class="alert-blue">
		<h2 class="alert-title">Ticket Meta</h2>
			<span class="marginright20">Ticket Status: <?php echo $status; ?></span><br/>
			<span class="marginright20">Ticket Priority: <?php echo $priority; ?></span>
		</div>
	</div>

	<hr/>
	
	<?php } // end if subscriber ?>


	<?php if ($ownerid == $current_user_id) { ?>
	<div class="textwidget">
		<div class="alert-green">
		<h2 class="alert-title">This Ticket Is Assigned To You</h2>
		</div>
	</div>
	<?php } // end if my ticket ?>


	<?php if ($user_role == "$editorword") { ?>

	<?php if ($assignedname == '-') { ?>
	<div class="textwidget">
		<div class="alert-red">
		<h2 class="alert-title">This Ticket Is Not Yet Assigned</h2>
			<form action="" id="primaryPostForm" method="POST" enctype="multipart/form-data" class="marginbottom0 margintop20">
				<p class="form-submit">
					<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>
					<input name="submitassign" type="submit" class="button orange ticketsubmit" id="submitassign" value="Assign to Me">
					<input type="hidden" name="submitted" id="submitted" value="true" />
					<input type="hidden" name="postid" id="postid" value="<?php echo $postid; ?>">
					<input type="hidden" name="assignedid" id="assignedid" value="<?php echo $current_user_id; ?>">
					<input type="hidden" name="ticket_title" id="ticket_title" value="<?php echo $ticket_title; ?>">
					
				</p>
			</form>
		</div>
	</div>
	<?php } // end if no assigned name ?>
	
	<?php } // end if editor ?>


<style>
.assignee { width: 125px;height: 25px;margin-top: -2px; }
</style>

	<?php if ($user_role == "$adminword") { ?>

	<div class="textwidget">
		<div class="alert-red overflowauto">
		<h2 class="alert-title">This Ticket Is Not Yet Assigned</h2>
			<icon class="icon-flag"></icon><span class="marginright20"> Assign To:</span>
			<form action="" method="POST" name="assignto" id="assignto" class="ticketform1">
			
			
			
			<?php 

			//GET THE TICKET CATEGORY
			$term_list = wp_get_post_terms($post->ID, 'tickets_cats', array("fields" => "ids"));
			$ticket_cat = $term_list[0];

			$args1 = array(
				'role'         => 'Subscriber',
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

			 $hdlist = '';
			 $sublist = '';

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
			    'include'                 => ''.$hdlist.'', // string
			    //'exclude'                 => ''.$sublist.'', // string
			    'multi'                   => false,
			    'show'                    => 'display_name',
			    'echo'                    => true,
			    'selected'                => ''.$ownerid.'',
			    'include_selected'        => false,
			    'name'                    => 'assignee', // string
			    //'id'                      => null, // integer
			    'class'                   => 'assignee', // string 
		    ); ?>
		
		
		    <?php wp_dropdown_users( $args ); ?>

				<p class="form-submit">
					<input name="assignto" type="submit" id="assignto" class="ticketassign" value="Assign Task">
					<input type="hidden" name="prioritychange" id="prioritychange" value="true" />
					<input type="hidden" name="postid" id="postid" value="<?php echo $postid; ?>">
					<input type="hidden" name="assignedid" id="assignedid" value="<?php echo $current_user_id; ?>">
					<input type="hidden" name="ticket_title" id="ticket_title" value="<?php echo $ticket_title; ?>">
					
				</p>
			</form>
		</div>
	</div>
	
	<?php } // end if admin ?>



		
	<?php dynamic_sidebar('tickets'); ?>
</div>
<!-- /sidebar -->

<?php
//get footer
get_footer(); 

ob_flush();
?>