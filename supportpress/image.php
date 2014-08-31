<?php
/**
 * IcarusThemes
 */

//get header
get_header(); 
require_once ( 'includes/body-top.php' );?>

<div id="page-heading">
	<h1><?php the_title(); ?></h1>	
</div><!-- /page-heading -->
<div id="img-attch-page">
    <a href="<?php echo wp_get_attachment_url($post->ID, 'full-size'); ?>" class="prettyphoto-link"><?php $portimg = wp_get_attachment_image( $post->ID, 'full' ); echo preg_replace('#(width|height)="\d+"#','',$portimg);?></a>
    <div id="img-attach-page-content">
        <?php the_content(); ?>
    </div><!-- /img-attach-page-content -->
</div><!-- /img-attch-page -->  
<?php
//get footer
get_footer(); ?>