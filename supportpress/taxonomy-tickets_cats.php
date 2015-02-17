<?php
/**
 * IcarusThemes
 */
 
//get global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//start tax loop only if taxonomies exist
if (have_posts()) :

?>

<header id="page-heading">
	<h1>
    <!-------- CHECK FOR LOGGED IN OR NOT ----------->
        
    <?php 
			
	if ( ( is_single() || is_front_page() || is_page() ) 
		&& !is_page('login') && !is_user_logged_in()){  ?>


			
	<?php  } else //if logged in
	 
	{  ?>
				       
	<?php
		$term =	$wp_query->queried_object;
		echo $term->name;
		$tickets_filter_parent = $term->slug;
	?>

	<?php } // end if logged in ?>

	</h1>
</header><!-- /page-heading -->

<?php
//show category description if not empty
if(category_description()) { ?>
<div id="tickets-description">
	 <?php echo category_description( ); ?>
</div><!-- /tickets-description -->
<?php } ?>

<div id="full-width" class="clearfix">
    <div id="tickets-wrap" class="grid-container clearfix">
    
        <?php /*
		//start tickets entry loop
        while (have_posts()) : the_post();
			//get the tickets loop style
			get_template_part('includes/loop','tickets');
        endwhile; */?>
        
        
        
        
        <div class="clear"></div>
		
		     <!-------- CHECK FOR LOGGED IN OR NOT ----------->
        
        <?php 
			
			if ( ( is_single() || is_front_page() || is_page() ) 
			       && !is_page('login') && !is_user_logged_in()){ 
			
				//user is not logged in
				//wp_redirect(''.$loginpage.'');
				//exit;
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
					<input type="text" name="user_login" value="" id="user_login" size="20" class="input width300" /></label>
				</p>
				
				<p>
					<label>Email Address<br />
					<input type="text" name="user_email" value="" id="user_email" class="input width300"  /></label> 
				
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
		
		<div id="portfolio-wrap clearfix">
    	<table class="portfolio-content table table-bordered table-striped clearfix">
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
							  'field' => 'slug',
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
					        array(
					            'key' => 'prth_ticket_status',
					            'value' => 'open',
					            'compare' => 'LIKE',			        
					        ),
               	),
				);
				
				$wp_query = new WP_Query( $args );
				
                //start loop
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    //get the projects loop style
                    get_template_part('includes/loop','tickets');
                endwhile; ?>
                
       
                
                
                </tbody>
            </table>
        </div><!-- /projects-wrap -->
        
        <?php




			}

		    /* -------- IF EDITOR - SEE EDITOR TICKET VIEW - BY CATEGORY OF ASSIGNMENT ----------- */
			
			elseif ($user_role == "editor") {
				$iseditor = false;	
				$userrole = 'Editor';

					//echo $userrole;
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
							  'field' => 'slug',
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
					        array(
					            'key' => 'prth_ticket_status',
					            'value' => 'open',
					            'compare' => 'LIKE',			        
					        ),
               	),
				);
				
				$wp_query = new WP_Query( $args );
				
                //start loop
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    //get the projects loop style
                    get_template_part('includes/loop','tickets');
                endwhile; ?>
                
       
                
                
                </tbody>
            </table>
        </div><!-- /projects-wrap -->
        
        <?php


			}
			
			/* -------- IF SUBSCRIBER - SEE SUBSCRIBER TICKET VIEW ----------- */
			
			elseif ($user_role == "subscriber") {
				
				$issubscriber = true;
				$userrole = 'Subscriber';

					//echo $userrole;
				    //echo '<br/>';
				    //echo $current_user_displayname;

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
					            'value' => 'open',
					            'compare' => 'LIKE',			        
					        ),
               	),
				);
				
				$wp_query = new WP_Query( $args );
				
                //start loop
                while ($wp_query->have_posts()) : $wp_query->the_post();
                    //get the projects loop style
                    get_template_part('includes/loop','tickets');
                endwhile; ?>
                
       
                
                
                </tbody>
            </table>
        </div><!-- /projects-wrap -->
        

        <?php

			}
		 
		 
		 } // END OF LOGGED IN CHECK
  
  
        //page pagination
        pagination();
        
        //reset tax query
        wp_reset_query(); ?>
          
    </div><!-- /tickets-wrap -->
    
</div><!-- /tickets-template --->


<?php
//end page loop
endif;

//get footer
get_footer(); ?>