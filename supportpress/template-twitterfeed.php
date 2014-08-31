<?php
/**
 * IcarusThemes
 * Template Name: Twitter Feed
 */
ob_start();

//get header
get_header();
require_once ( 'includes/body-top.php' );

$demo = true;
$replyform = false;
$messageform = false;
$ticketform = false;
$replysent = false;
$messagesent = false;
$ticketsent = false;
$error = false;

//get twitter
	//search term
	$twitter_search_term = $itdata['twitter_search_term'];

	//credentials
	$twitter_consumer_key = $itdata['twitter_consumer_key'];
	$twitter_consumer_secret = $itdata['twitter_consumer_secret'];
	$twitter_oauth_token = $itdata['twitter_oauth_key'];
	$twitter_oauth_secret = $itdata['twitter_oauth_secret'];

	//new connection
	$connection = new TwitterOAuth($twitter_consumer_key, $twitter_consumer_secret, $twitter_oauth_token, $twitter_oauth_secret);
	$content = $connection->get('account/verify_credentials');
 
 
if ($demo == true){ } else {

	if(isset($_POST['tweetreply'])){ 
	
		$replyform = true; 

		//get tweet id
		if(trim($_POST['tweetid']) === '') {
			$error = true;
		} else {
			$tweetid = $_POST['tweetid'];
		}

		//get twitter name
		if(trim($_POST['username']) === '') {
			$error = true;
		} else {
			$username = $_POST['username'];
		}

	
	} // END REPLY FORM
		
	if(isset($_POST['message'])){ 
	
		$messageform = true; 

		//get twitter name
		if(trim($_POST['username']) === '') {
			$error = true;
		} else {
			$username = $_POST['username'];
		}
		
	} // END MESSAGE FORM
	
	if(isset($_POST['ticket'])){ 
	
		$ticketform = true; 

		//get tweet id
		if(trim($_POST['tweetid']) === '') {
			$error = true;
		} else {
			$tweetid = $_POST['tweetid'];
		}

		//get twitter name
		if(trim($_POST['username']) === '') {
			$error = true;
		} else {
			$username = $_POST['username'];
		}

		//get tweettext
		if(trim($_POST['tweettext']) === '') {
			$error = true;
		} else {
			$tweettext = $_POST['tweettext'];
		}
		
	} // END TICKET FORM


		if(isset($_POST['tweetreply_send'])){ 
		
			//get tweet id
			if(trim($_POST['tweetid']) === '') {
				$error = true;
			} else {
				$tweetid = $_POST['tweetid'];
			}
	
			//get reply text
			if(trim($_POST['tweetreply_text']) === '') {
				$error = true;
			} else {
				$tweetreply_text = stripslashes($_POST['tweetreply_text']);
			}
		
			if ($tweetid && $tweetreply_text) {
				
				$replysent = true;
				$connection->post('statuses/update', array('status' => $tweetreply_text, 'in_reply_to_status_id' => $tweetid));
				
			} // END ERROR CHECK ON VARIABLES
			
		} // END REPLY SEND

		if(isset($_POST['tweetmessage_send'])){ 
		
			//get tweet id
			if(trim($_POST['username']) === '') {
				$error = true;
			} else {
				$username = $_POST['username'];
			}
	
			//get reply text
			if(trim($_POST['tweetmessage_text']) === '') {
				$error = true;
			} else {
				$tweetmessage_text = stripslashes($_POST['tweetmessage_text']);
			}
		
			if ($username && $tweetmessage_text) {
								
				$messagesent = true;
				$connection->post('direct_messages/new', array('text' => $tweetmessage_text, 'screen_name' => $username));
				
			} // END ERROR CHECK ON VARIABLES
			
		} // END REPLY SEND
	


		if(isset($_POST['tweetticket_send'])){ 
		
			if(trim($_POST['postTitle']) === '') {
				$error = true;
			} else {
				$postTitle = stripslashes($_POST['postTitle']);
			}
		
		
			if($_POST['postContent'] === '') {
			} else {
				$postContent = stripslashes($_POST['postContent']);
			}
		
		
			if(trim($_POST['cat']) === '') {
			} else {
				$cat = $_POST['cat'];
			}
		
			$requestedid = $current_user_id;
		
			if (isset($error) && ($error == true)){ } else {
		
			$post_information = array(
				'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
				'post_content' => $_POST['postContent'],
				'post_type' => 'tickets',
				'post_status' => 'publish'
			);
		
			$post_id = wp_insert_post($post_information);
					
			if ($post_id)
			{
		
				// Update Custom Meta
				update_post_meta($post_id, 'prth_ticket_requested', $requestedid);
				update_post_meta($post_id, 'prth_ticket_priority', '1');
				update_post_meta($post_id, 'prth_ticket_status', 'open');
		
				//add categories
				wp_set_post_terms($post_id, $cat, 'tickets_cats' );
			
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

			
			
			
			
			
		} // END REPLY SEND
	
	



}


//start post loop
if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header id="page-heading">
        <h1><?php the_title(); ?></h1>		
    </header><!-- /page-heading -->
    
    <article id="post" class="clearfix">
        <div class="entry clearfix">	
            <?php the_content(); 
	        
	       //check if forms sent:
	       
	       if ($replysent == true)  {

			echo '<div class="alert-green">
			<h2 class="alert-title">Success!</h2>
			<p>You have sent a reply</p>
			</div>
		    ';

	       } elseif ($messagesent == true) {
		       
			echo '<div class="alert-green">
			<h2 class="alert-title">Success!</h2>
			<p>You have sent a message</p>
			</div>
		    ';
		       
	       }
	            
	            
	       //check if forms submitted     
	       if ($replyform == true)  {

		       ?>
		       	<form action="" name="tweetreply_send" method="POST">
				<div class="alert-yellow">
					<h2 class="alert-title">Reply to <?php echo $username; ?>:</h2>
					<p><textarea class="textarea twittertextreply" name="tweetreply_text" id="tweetreply_text" maxlength="140" rows="8" cols="30">@<?php echo $username; ?> </textarea>
					<span>140 Character Limit</span></p>
			        <input type="hidden" name="tweetid" value="<?php echo $tweetid; ?>"/>
			        <input name="tweetreply_send" type="submit" id="tweetreply_send" class="twittertextbtn" value="Reply">
				</div>
		       	</form>
		       <?php
		       
	       }

	            
	       //check if forms submitted     
	       if ($messageform == true)  {
		       
		       	?>
		       	<form action="" name="tweetmessage_send" method="POST">
				<div class="alert-yellow">
					<h2 class="alert-title">Message <?php echo $username; ?>:</h2>
					<p><textarea class="textarea twittertextreply" name="tweetmessage_text" id="tweetmessage_text" maxlength="140" rows="8" cols="30"></textarea>
					<span>140 Character Limit</span></p>
			        <input type="hidden" name="username" value="<?php echo $username; ?>"/>
			        <input name="tweetmessage_send" type="submit" id="tweetmessage_send" class="twittertextbtn" value="Send Message">
				</div>
		       	</form>
		       <?php
	       }
	            
	       //check if forms submitted     
	       if ($ticketform == true)  {
		       
		       	?>
		       	<form action="" name="tweetticket_send" method="POST">
				<div class="alert-yellow">
					<h2 class="alert-title">Make Ticket Out of <?php echo $username; ?>'s Tweet:</h2>
					
					<br/>

					<!-- TITLE -->
					<fieldset>
						<span>Subject - A short subject line regarding the issue.</span><br/>
						<input type="text" name="postTitle" id="postTitle" class="width40p" value="Twitter Request - <?php echo $username; ?>" class="required" />
					</fieldset>
					

					
					<!-- CATEGORY -->
					<span>Category - Which category best describes the type of problem?</span>
				
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

					
				<span>Issue - Explain the problem the user is experiencing</span>
					<p><textarea class="textarea twittertextreply" name="postContent" id="postContent" rows="8" cols="30">Tweet: <?php echo $tweettext; ?></textarea></p>
			        <input type="hidden" name="tweetid" value="<?php echo $tweetid; ?>"/>
			        <input name="tweetticket_send" type="submit" id="tweetticket_send"  class="twittertextbtn" value="Submit Ticket">
				</div>
		       	</form>
		       <?php
		       
	       }
	            
	            
			//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
			
			if (!$connection) { } else {
			
			$parameters = array('q' => $twitter_search_term, 'count' => 30);
			$results = $connection->get('search/tweets', $parameters);
			
			//$resultsuser = $results->statuses[0]->user;

			/*
				?><pre><?php
					print_r($results->statuses)
					?></pre><?php
			*/
			
			?>

				<h1>Your Search Term: <?php echo $twitter_search_term; ?></h1>


		<div id="portfolio-wrap clearfix">
    	<table class="table table-bordered clearfix">
    	<thead>
    	<!-- TABLE HEAD -->
	    	<tr>
	    	<th>Message</th>
	    	<th colspan="3" class="textaligncenter">Actions</th>
	    	</tr>
	    </thead>
	    <tbody>
			                
                    
	    	<?php
			
			$i = 0;
			foreach ($results->statuses as $data) {
			    
			 	$user_screen_name = $data->user->screen_name;
			 	$user_name = $data->user->name;
			 	$user_profile_image_url = $data->user->profile_image_url;
			 	$user_text = $data->text;
			 	$created_at = $data->created_at;
			 	$tweet_id = $data->id;
			
			?>
			 <tr>
			        <td>
			        <div class=" floatleft marginright8">
				       <a href="https://twitter.com/#!/<?php echo $user_screen_name; ?>" target="_blank"/><img width="48px" height="48px" src="<?php echo $user_profile_image_url; ?>"/></a>
				    </div>
				    <div class=" floatleft width85p">
			           <a href="https://twitter.com/#!/<?php echo $user_screen_name; ?>" target="_blank"/><?php echo $user_screen_name; ?></a><br/>
			           <?php echo $user_text; ?><br/><span class="fontstyleitalic">
			           <?php echo $created_at; ?></span></div></td>
			        
			        <td class="vertalignmid"><icon class="icon-share-alt"></icon> <form id="<?php echo $tweet_id; ?>" name="tweetreply" class="marginbottom0" action="" method="POST">
			        <input type="hidden" name="tweetreply" id="tweetreply" value="true" />
			        <input type="hidden" name="tweetid" value="<?php echo $tweet_id; ?>"/>
			        <input type="hidden" name="username" value="<?php echo $user_screen_name; ?>"/>
			        <input name="tweetreply" type="submit" id="tweetreply" class="twitterbtn" value="Reply"></form></td>
			        			        
			        <td class="vertalignmid"><icon class="icon-envelope"></icon> <form id="<?php echo $tweet_id; ?>" name="message" class="marginbottom0" action="" method="POST">
			        <input type="hidden" name="username" value="<?php echo $user_screen_name; ?>"/>
			        <input name="message" type="submit" id="message" class="twitterbtn" value="Message"></form></td>
			       
			       <td class="vertalignmid"><icon class="icon-thumbs-up"></icon> <form id="<?php echo $tweet_id; ?>" name="ticket" class="marginbottom0" action="" method="POST">
			        <input type="hidden" name="tweetid" value="<?php echo $tweet_id; ?>"/>
			        <input type="hidden" name="username" value="<?php echo $user_screen_name; ?>"/>
			        <input type="hidden" name="tweettext" value="<?php echo $user_text; ?>"/>
			       <input name="ticket" type="submit" id="ticket" class="twitterbtn" value="Make Ticket"></form></td>
			 </tr>
			<?php
			$i++;
			}
			
			
			} // if good connection
			
			?>
               
                </tbody>
            </table>
        </div><!-- /projects-wrap -->
 
 
 

        </div><!-- /entry -->       
    </article><!-- /post -->
    
	<?php
	//show comments if not disabled
	if($itdata['show_hide_page_comments'] !='disable') { comments_template(); } ?>
    
<?php
//end post loop
endwhile; endif;

?>

<div id="sidebar">

	<div class="sidebar-box widget_search clearfix">
		<div class="well">
			<div class="well-title">
			
			<?php
			
				if ( ( is_single() || is_front_page() || is_page() ) && !is_page('login') && !is_user_logged_in()){  ?>
				      
				    <p>You are not logged in &middot; <a href="<?php echo $loginpage ?>">Log In</a></p>
				      
				<?php } else { ?>

			
					<h2><?php echo $current_user_displayname; ?></h2>
					<p><?php echo $current_user_email; ?><br/><a href="<?php echo wp_logout_url( home_url() ); ?>">Log Out</a></p>					
					

				<?php } ?>
				
			</div>
			
			<div class="well-pic">
				
				<?php echo $avatar; ?>
				
			</div>
			
			
		</div>
	</div>


	<?php dynamic_sidebar('pages'); ?>


</div>
<!-- /sidebar -->
<?php

//get template
get_footer(); 

ob_flush();

?>