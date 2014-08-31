<?php
/**
 * IcarusThemes
 */

//get the options
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//start loop
if (have_posts()) :

?>

<header id="page-heading">
	<h1>
	<?php
	
	if (isset($itdata['kb_post_type_replacement'])) {$kb_post_type_replacement = $itdata['kb_post_type_replacement']; } else { $kb_post_type_replacement = 'KnowledgeBase'; }

    $term = $wp_query->queried_object; ?>
	<h1><?php echo $kb_post_type_replacement; ?>: <?php echo $term->name; ?></h1>
	</h1>
</header><!-- /page-heading -->

<?php
//show category description if not empty
$category_description = category_description();
if(!empty($category_description )) {
	echo apply_filters('category_archive_meta','<div id="kb-description">' . $category_description . '</div>');
}
?>

<div id="post">

<div id="kb-template" class="clearfix">
	<div class="clearfix">
		<?php
        //start loop
        while (have_posts()) : the_post();
            //get the kb loop style
        get_template_part('includes/loop','kb'); endwhile; ?>
        
		<div class="clear"></div>
		<?php
        //page pagination
        pagination();
        
        //reset tax query
        wp_reset_query(); ?>
        
	</div><!-- /grid-container -->
</div><!-- /kb-wrap -->


</div><!-- /post -->

<?php
//end page loop
endif;


//get sidebar
//get_sidebar('kb');
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


	<?php dynamic_sidebar('kb'); ?>


</div>

<?php

//get footer
get_footer(); ?>