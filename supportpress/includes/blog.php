<?php
/**
 * IcarusThemes
 */
 
//show slider
global $itdata;
if($itdata['home_slider'] != 'Select') {
?>
	<div id="full-slider"><?php echo do_shortcode("[slider id=".$itdata['home_slider']."]"); ?></div><!--/full-slider -->
<?php } ?>

<div id="post" class="clearfix">
	<?php
		//show posts
    	if (have_posts()) : 
			//get entry loop       
			get_template_part( 'includes/loop', 'entry'); 
		//end loop
    	endif;
	
		//page pagination
		pagination(); ?>
</div><!-- /post -->

<?php
//get sidebar
get_sidebar(); ?>