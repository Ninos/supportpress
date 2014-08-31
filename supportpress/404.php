<?php
/**
 * IcarusThemes
 */

//get global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' ); ?>

<div id="404-page">	
	<h1 id="404-page-title">404</h1>			
	<p id="404-page-text">
	<?php if($itdata['custom_404_text']) { echo stripslashes($itdata['custom_404_text']); } else {  _e('Sorry, the page you are trying to access does not exist. You can go back to the homepage: ','prth'); ?> <a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php _e('homepage','prth'); ?></a>.<?php } ?>
    </p>
</div><!-- END 404-page -->

<?php get_footer(); ?>