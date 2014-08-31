<?php
/**
 * IcarusThemes
 */

//get header
get_header();
require_once ( 'includes/body-top.php' );

//start the loop
if(have_posts()) :

($itdata['translation_post_by_text']) ? $author_page_title = $itdata['translation_post_by_text'] : $author_page_title = __('Posts by','prth');
?>

<header id="page-heading">
		<?php
        if(isset($_GET['author_name'])) :
        $curauth = get_userdatabylogin($author_name);
        else :
        $curauth = get_userdata(intval($author));
        endif;
        ?>
        <h1><?php echo $author_page_title; ?>: <?php echo $curauth->display_name; ?></h1>
</header><!-- /page-heading -->

<div id="post" class="post clearfix">  
	<?php
	//get loop - normal entry
    get_template_part('includes/loop', 'entry'); 
	
	//pagination
	pagination(); ?>
</div><!--/post -->

<?php
//end post loop
endif;

//get sidebar
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


	<?php dynamic_sidebar('sidebar'); ?>


</div>
<?php

//get footer
get_footer(); ?>