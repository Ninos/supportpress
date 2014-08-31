<?php
/**
 * IcarusThemes
 */
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

<?php

$post_type = get_post_type();

if($post_type == 'forum') {

	dynamic_sidebar('bbpress-forum');

} elseif ($post_type == 'topic') {

	dynamic_sidebar('bbpress-topic');

} elseif ($post_type == 'reply') {

	dynamic_sidebar('bbpress-reply');

} else { 
	
	dynamic_sidebar('pages');
} 

?>

</div>
<!-- /sidebar -->