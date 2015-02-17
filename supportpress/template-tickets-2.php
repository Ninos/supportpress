<?php
/**
 * IcarusThemes
 * Template Name: Tickets - Prioritized
*/

//get global variables
global $itdata;

//get template heade <= careful don't delete me
get_header();
require_once ( 'includes/body-top.php' );

//loop
if (have_posts()) : while (have_posts()) : the_post();

$loginpage = $itdata['login_page'];
$addticket = $itdata['add_tickets_link'];

//grid style
$tickets_grid_style = get_post_meta($post->ID, 'prth_grid_style', true); //get grid style meta
$tickets_grid_class = prth_grid($tickets_grid_style); //set grid style

//stasus of tickets
$tickets_status_id = get_post_meta($post->ID, 'prth_ticket_status_id', TRUE);

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
	  padding: 14px 8px 5px 8px;
	}
	.table th {
		padding:20px 20px 20px 7px;
	}

</style>
<header id="page-heading">
    <!-------- CHECK FOR LOGGED IN OR NOT ----------->
        
    <?php 
			
	if ( ( is_single() || is_front_page() || is_page() ) 
		&& !is_page('login') && !is_user_logged_in()){  ?>


			
	<?php  } else //if logged in
	 
	{  ?>
				       
	<h1><?php the_title(); ?></h1>
	<?php if ($user_role == "subscriber"){ ?>
		
		<nav id="post-navigation" class="clearfix"> 
	        <?php echo '<span class="floatright"><a class="addticket" href="'.$addticket.'">Submit Ticket</a></span>'; ?>
        </nav><!-- /post-navigation --> 

	<?php } ?>


	<?php } // end if logged in ?>
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
				
					<form name="log inform" id="log inform" action="<?php echo wp_login_url(); ?>" method="post">
					<p>
						<label>Username<br />
						<input type="text" name="log" id="user_login" class="input width300" value="" size="20" tabindex="10" /></label>
					</p>

					<p>
						<label>Password<br />
						<input type="password" name="pwd" id="user_pass" class="inputwidth300" value="" size="20" tabindex="20" /></label>
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
                
			if ($user_role == "$adminword") {	
				$isadmin = true;
				$userrole = 'Admin';

					//echo $userrole;
				    //echo '<br/>';
				    //echo $current_user_displayname;

		?>
		
		<div id="portfolio-wrap clearfix">
    	<table class="table table-bordered clearfix">
    	<thead>
    	<!-- TABLE HEAD -->
	    	<tr>
	    	<th>Ticket Subject</th>
	    	<th>Ticket Requestor</th>
	    	<th>Assignee</th>
	    	<th>Ticket Updated</th>
	    	<th>Category</th>
	    	</tr>
	    </thead>
	    <tbody>
	    
	    
	    		<tr class="seperator">
	    		<td class="tickettdspan"><span class="text-error">Priority Level: High</span></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		</tr>

                <?php		
                //tax query
                if($tickets_filter_parent) {
					$tax_query = array(
						array(
							  'taxonomy' => 'tickets_cats',
							  'field' => 'id',
							  'terms' => $tickets_filter_parent
							  )
						);
                }
				else {
					$tax_query = NULL;
				}
    

                //get post type ==> tickets
                $args = array(
						'post_type'=>'tickets',
						'posts_per_page' => -1,
						'paged'=>$paged,
						'tax_query' => $tax_query,
						'orderby' => 'modified',
						'order' => 'DESC',
 					    'meta_query' => array(
 					    'relation' => 'AND',
					    	array(
					            'key' => 'prth_ticket_priority',
					            'value' => '3',
					            'type' => 'numeric',
					            'compare' => '=',
					        ),
					        array(
					            'key' => 'prth_ticket_status',
					            'value' => ''.$tickets_status_id.'',
					            'compare' => 'LIKE'				        
					        ),
               	),
				);
				
				$wp_query = new WP_Query( $args );
				
				if ( $wp_query->have_posts() ) {
				
                //start loop
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    //get the projects loop style
                    get_template_part('includes/loop','tickets_2');
                endwhile; 
                
              
                } else {
	                
					echo '<tr>
						<td class="tickettdspan"><span class="text-success">Great! You have no tickets in this category!</span></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
					</tr>';
              
  	                
	                
                } // end if no posts
                
                ?>
                
 
 
 	    		<tr class="seperator">
	    		<td class="tickettdspan"><span class="text-warning">Priority Level: Medium</span></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		</tr>

                <?php		
                //tax query
                if($tickets_filter_parent) {
					$tax_query = array(
						array(
							  'taxonomy' => 'tickets_cats',
							  'field' => 'id',
							  'terms' => $tickets_filter_parent
							  )
						);
                }
				else {
					$tax_query = NULL;
				}
    

                //get post type ==> tickets
                $args = array(
						'post_type'=>'tickets',
						'posts_per_page' => -1,
						'paged'=>$paged,
						'tax_query' => $tax_query,
						'orderby' => 'modified',
						'order' => 'DESC',
 					    'meta_query' => array(
 					    'relation' => 'AND',
 					    	array(
					            'key' => 'prth_ticket_priority',
					            'value' => '2',
					            'type' => 'numeric',
					            'compare' => '=',
					       ),
					        array(
					            'key' => 'prth_ticket_status',
					            'value' => ''.$tickets_status_id.'',
					            'compare' => 'LIKE'					        
					        ),
               	),
				);
				
				$wp_query = new WP_Query( $args );
				
				if ( $wp_query->have_posts() ) {
				
                //start loop
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    //get the projects loop style
                    get_template_part('includes/loop','tickets_2');
                endwhile; 
                
              
                } else {
	                
					echo '<tr>
						<td class="tickettdspan"><span class="text-success">Great! You have no tickets in this category!</span></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
					</tr>';
              
  	                
	                
                } // end if no posts

                ?>
                
  	    		<tr class="seperator">
	    		<td class="tickettdspan"><span class="text-success">Priority Level: Low</span></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		<td class="borderleftnone"></td>
	    		</tr>

                <?php		
                //tax query
                if($tickets_filter_parent) {
					$tax_query = array(
						array(
							  'taxonomy' => 'tickets_cats',
							  'field' => 'id',
							  'terms' => $tickets_filter_parent
							  )
						);
                }
				else {
					$tax_query = NULL;
				}
    

                //get post type ==> tickets
                $args = array(
						'post_type'=>'tickets',
						'posts_per_page' => -1,
						'paged'=>$paged,
						'tax_query' => $tax_query,
						'orderby' => 'modified',
						'order' => 'DESC',
 					    'meta_query' => array(
 					    'relation' => 'AND',
 					    	array(
					            'key' => 'prth_ticket_priority',
					            'value' => '1',
					            'type' => 'numeric',
					            'compare' => '=',
					        ),
					        array(
					            'key' => 'prth_ticket_status',
					            'value' => ''.$tickets_status_id.'',
					            'compare' => 'LIKE',			        
					        ),
               	),
				);
				
				$wp_query = new WP_Query( $args );
				
				if ( $wp_query->have_posts() ) {
				
                //start loop
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    //get the projects loop style
                    get_template_part('includes/loop','tickets_2');
                endwhile; 
                
              
                } else {
	                
					echo '<tr>
						<td class="tickettdspan"><span class="text-success">Great! You have no tickets in this category!</span></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
					</tr>';
              
  	                
	                
                } // end if no posts



                ?>
             
                
                </tbody>
            </table>
        </div><!-- /projects-wrap -->
 
<?php

			}


		    /* -------- IF EDITOR - SEE EDITOR TICKET VIEW - BY CATEGORY OF ASSIGNMENT ----------- */
			
			elseif ($user_role == "$editorword") {
				
					$iseditor = true;	
					$userrole = 'Editor';

				    //echo '<br/>';
				    //echo $current_user_displayname;

				    //GET THE USERS CATEGORY
				    $tickets_filter_parent = get_the_author_meta( 'hd_category', $current_user_id );

		?>
		
		<div id="portfolio-wrap clearfix">
    	<table class="portfolio-content table table-bordered clearfix">
    	<thead>
    	<!-- TABLE HEAD -->
	    	<tr>
	    	<th class="textaligncenter">Priority</th>
	    	<th>Ticket Subject</th>
	    	<th>Ticket Requestor</th>
	    	<th>Assignee</th>
	    	<th>Ticket Updated</th>
	    	<th>Category</th>
	    	</tr>
	    </thead>
	    <tbody>
	    
	     <?php		
	     	     
                //tax query
                if($tickets_filter_parent) {
					$tax_query = array(
						array(
							  'taxonomy' => 'tickets_cats',
							  'field' => 'id',
							  'terms' => $tickets_filter_parent
							  )
						);
                }
				else {
					$tax_query = NULL;
				}
    

                //get post type ==> tickets
                $args = array(
						'post_type'=>'tickets',
						'posts_per_page' => -1,
						'paged'=>$paged,
						'tax_query' => $tax_query,
						'meta_key' => 'prth_ticket_priority',
						'orderby' => 'meta_value',
						'order' => 'DESC',
 					    'meta_query' => array(
 					   // 'relation' => 'AND',
					   //    array(
					   //         'key' => 'prth_ticket_status',
					   //         'value' => 'open',
					   //         'compare' => 'LIKE',			        
					   //     ),
					        					        array(
					            'key' => 'prth_ticket_status',
					            'value' => ''.$tickets_status_id.'',
					            'compare' => 'LIKE',			        
					        ),
               	),
				);
				
				$wp_query = new WP_Query( $args );
				
				if ( $wp_query->have_posts() ) {
				
                //start loop
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    //get the projects loop style
                    get_template_part('includes/loop','tickets');
                endwhile; 
                
              
                } else {
	                
					echo '<tr>
						<td class="tickettdspan"><span class="text-success">Great! You have no tickets in this category!</span></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
					</tr>';
              
  	                
	                
                } // end if no posts


				?>                
       
                
                
                </tbody>
            </table>
        </div><!-- /projects-wrap -->
        
        <?php


			}
			
			/* -------- IF SUBSCRIBER - SEE SUBSCRIBER TICKET VIEW ----------- */
			
			elseif ($user_role == "$subword") {
				$issubscriber = true;
				$userrole = 'Subscriber';

				//	echo $user_role;
				//   echo '<br/>';
				//    echo $current_user_displayname;

	?>
		
		<div id="portfolio-wrap clearfix">
    	<table class="portfolio-content table table-bordered clearfix">
    	<thead>
    	<!-- TABLE HEAD -->
	    	<tr>
	    	<th class="textaligncenter">Priority</th>
	    	<th>Ticket Subject</th>
	    	<th>Ticket Requestor</th>
	    	<th>Assignee</th>
	    	<th>Ticket Updated</th>
	    	<th>Category</th>
	    	</tr>
	    </thead>
	    <tbody>
	    
	     <?php		
    

                //get post type ==> tickets
                $args = array(
						'post_type'=>'tickets',
						'posts_per_page' => -1,
						'paged'=>$paged,
						//'tax_query' => $tax_query,
						'meta_key' => 'prth_ticket_priority',
						'orderby' => 'meta_value',
						'order' => 'DESC',
 					    'meta_query' => array(
 					    'relation' => 'AND',
					        array(
					            'key' => 'prth_ticket_requested',
					            'value' => ''.$current_user_id.'',
					            'compare' => '=',			        
					        ),
					        array(
					            'key' => 'prth_ticket_status',
					            'value' => ''.$tickets_status_id.'',
					            'compare' => 'LIKE',			        
					        ),
               	),
				);
				
				$wp_query = new WP_Query( $args );

				if ( $wp_query->have_posts() ) {
				
                //start loop
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    //get the projects loop style
                    get_template_part('includes/loop','tickets');
                endwhile; 
                
              
                } else {
	                
					echo '<tr>
						<td class="tickettdspan"><span class="text-success">Great! You have no tickets in this category!</span></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
						<td class="borderleftnone"></td>
					</tr>';
              
  	                
	                
                } // end if no posts


				?>                
       
                
                
                </tbody>
            </table>
        </div><!-- /projects-wrap -->
        

        <?php

			}
		 
		 
		 } // END OF LOGGED IN CHECK
  
  
       
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