<?php
/**
 * IcarusThemes
 * Template Name: Chat
 */

//get header
get_header();
require_once ( 'includes/body-top.php' );

//start post loop
if (have_posts()) : while (have_posts()) : the_post(); ?>

<style>
/* !Chat CSS
	.quick-chat-users-container-left { display:none; }
================================================== */
	.quick-chat-history-links { display:none; }
	.quick-chat-to-delete-boxes { display:none; }
	.quick-chat-history-message-alias-container { border-bottom: 1px solid #ececec;padding-bottom: 8px; }
	.quick-chat-admin .quick-chat-history-alias { color: #3175c9; }
	.quick-chat-ban-link { display:none; }
	.quick-chat-right-link { display:none; float:left; }
	.quick-chat-alias-container { display:none; }
	.quick-chat-smilies-container { display:none; }
	.quick-chat-users-container	{ color: #3175c9; }

</style>

    <header id="page-heading">
        <h1><?php the_title(); ?></h1>		
    </header><!-- /page-heading -->
    
    <article id="post" class="clearfix">
        <div class="entry clearfix">	
            <?php the_content(); ?>
        </div><!-- /entry -->       
    </article><!-- /post -->
    

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


<?php
	
	dynamic_sidebar('chat');

?>

</div>
<!-- /sidebar -->
<?php
//get footer template
get_footer(); ?>