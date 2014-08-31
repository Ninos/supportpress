<?php
/**
 * IcarusThemes
 */
 
//get global variables
global $itdata;

//get header
get_header(); 
require_once ( 'includes/body-top-index.php' );


?>


<div id="post" class="clearfix">

<?php
//<div id="home-wrap" class="clearfix">

//get homepage module blocks
$layout = $itdata['homepage_blocks']['enabled'];
if ($layout):
foreach ($layout as $key=>$value) {
	
    switch($key) {		


		//boxes
		case 'homepage_topboxes':
		?>

		<div class="grid-container homeboxes marginbottom30">

			<div class="home-post-entry grid-3 bs-callout bs-callout-info margintop0">
                <a href="<?php if(!empty($itdata['homepage_box1_link'])) { echo $itdata['homepage_box1_link']; } else { echo '#'; } ?>">
                <h2><icon class="icon flat-<?php if(!empty($itdata['homepage_box1_icon'])) { echo $itdata['homepage_box1_icon']; } else { echo 'check'; } ?> small"></icon><?php if(!empty($itdata['homepage_box1_title'])) { echo $itdata['homepage_box1_title']; } else { echo 'HomeBox1 Title'; } ?>
                	<br><span><?php if(!empty($itdata['homepage_box1_text'])) { echo $itdata['homepage_box1_text']; } else { echo 'Read Articles!'; } ?></span>
                </h2></a>
			</div>
            
			<div class="home-post-entry grid-3 bs-callout bs-callout-danger margintop0">
                <a href="<?php if(!empty($itdata['homepage_box2_link'])) { echo $itdata['homepage_box2_link']; } else { echo '#'; } ?>">
                <h2><icon class="icon flat-<?php if(!empty($itdata['homepage_box2_icon'])) { echo $itdata['homepage_box2_icon']; } else { echo 'book'; } ?> small"></icon><?php if(!empty($itdata['homepage_box2_title'])) { echo $itdata['homepage_box2_title']; } else { echo 'HomeBox2 Title'; } ?>
                	<br><span><?php if(!empty($itdata['homepage_box2_text'])) { echo $itdata['homepage_box2_text']; } else { echo 'Dig Deeper!'; } ?></span>
                </h2></a>
			</div>

			<div class="home-post-entry grid-3 bs-callout bs-callout-warning margintop0">
                <a href="<?php if(!empty($itdata['homepage_box3_link'])) { echo $itdata['homepage_box3_link']; } else { echo '#'; } ?>">
                <h2><icon class="icon flat-<?php if(!empty($itdata['homepage_box3_icon'])) { echo $itdata['homepage_box3_icon']; } else { echo 'comment'; } ?> small"></icon><?php if(!empty($itdata['homepage_box3_title'])) { echo $itdata['homepage_box3_title']; } else { echo 'HomeBox3 Title'; } ?>
                	<br><span><?php if(!empty($itdata['homepage_box3_text'])) { echo $itdata['homepage_box3_text']; } else { echo 'Ask Questions!'; } ?></span>
                </h2></a>
			</div>
                    
		</div>


		<?php
	

		//tagline
		break;
		case 'homepage_tagline':
		
		if($itdata['homepage_tagline']) { ?>
		<?php if(!empty($itdata['homepage_tagline_title'])) { 
			if(!empty($itdata['homepage_tagline_title_url'])) { ?>
				<h2 class="heading"><a href="<?php echo $itdata['homepage_tagline_title_url']; ?>" title="<?php echo $itdata['homepage_tagline_title']; ?>"><span><?php echo $itdata['homepage_tagline_title']; ?></span></a></h2>
			<?php } else { ?>
				<h2 class="heading"><span><?php echo $itdata['homepage_tagline_title']; ?></span></h2>
			<?php } } ?>
		<div id="home-tagline" class="well clearfix">
			<?php echo stripslashes(do_shortcode($itdata['homepage_tagline'])); ?>
		</div>
		<!-- /home-tagline -->
		<?php }
		
		
		//blog
		break;
		case 'homepage_blog':
		require_once('includes/homepage-blogsection.php');
		

		//search
		break;
		case 'homepage_search':
		require_once('includes/homepage-search.php');

		
		//widgets
		break;
		case 'homepage_widgets':
		if(!empty($itdata['homepage_widgets_title'])) {
			if(!empty($itdata['homepage_widgets_title_url'])) { ?>
			<h2 class="heading"><a href="<?php echo $itdata['homepage_widgets_title_url']; ?>" title="<?php echo $itdata['homepage_widgets_title']; ?>"><span><?php echo $itdata['homepage_widgets_title']; ?></span></a></h2>
			<?php } else { ?>
				<h2 class="heading"><span><?php echo $itdata['homepage_widgets_title']; ?></span></h2>
			<?php } }
		echo '<div id="home-widgets" class="clearfix"><div class="grid-container">';
		dynamic_sidebar('homepage');
		echo '</div></div>';
		
	
    }
	
}
endif;
?>


</div>
<!-- END home-wrap -->   

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


	<?php dynamic_sidebar('homepage_sidebar'); ?>


</div>
<!-- /sidebar -->


<?php
//get footer
get_footer(); ?>