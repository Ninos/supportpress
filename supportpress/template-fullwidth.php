<?php
/**
 * IcarusThemes
 * Template Name: Full-Width
 */

//get header
get_header();
require_once ( 'includes/body-top.php' );

//loop
if (have_posts()) : while (have_posts()) : the_post();

//get slider meta
$page_slider = get_post_meta($post->ID, 'prth_page_slider', true);

//show page slider if enabled
if ($page_slider == 'enable') {

		?>
		<div id="full-slider" class="fullwidthslider">
			<?php echo do_shortcode("[slider id=".$page_slider."]"); ?>
		</div><!--/full-slider -->
		<?php

}
?>

<style>
#full-slider {
	margin-top:-25px;
	margin-bottom:25px;
	margin-right:-25px;
	margin-left:-25px;
}
</style>

<div id="page-heading">
    <h1><?php the_title(); ?></h1>	
</div><!-- /page-heading -->

<div id="full-width" class="clearfix">

	<article class="entry clearfix">
		<?php the_content(); ?>
	</article><!-- /entry --> 
    
	<?php
	//show comments if not disabled
	if($itdata['show_hide_page_comments'] !='disable') { comments_template(); } ?>
     
</div><!-- /full-width -->

<?php
//end post loop
endwhile; endif;

//get footer
get_footer(); ?>