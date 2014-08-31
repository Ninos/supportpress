<?php
/**
 * IcarusThemes
 * Template Name: Forum
 */

//get global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//loop
if (have_posts()) : while (have_posts()) : the_post();

?>
<header id="page-heading">
	<h1><?php the_title(); ?></h1>	
</header><!-- /page-heading -->

<div id="post">
    <?php
    //show page content if not empty
    $content = $post->post_content;
    if(!empty($content)) { ?>
        <div id="staff-description">
            <?php //the_content(); ?>
            
            <?php
            echo do_shortcode('[bbp-forum-index]');

            ?>
            
        </div><!-- /staff-description -->
    <?php }?>
    
   
</div><!-- /post -->
<?php
//end page loop
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


	
	dynamic_sidebar('bbpress-forum-index');


?>

</div>
<!-- /sidebar -->

<?php
//get footer
get_footer(); ?>