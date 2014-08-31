<?php
/**
 * IcarusThemes
 */

//get theme settings
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//start loop
if(have_posts()) : ?>

<header id="page-heading">
	<?php $term = $wp_query->queried_object; ?>
	<h1><?php echo $term->name; ?></h1>
</header><!-- /page-heading -->

<?php
$category_description = category_description();
if(!empty($category_description )) {
	echo apply_filters('category_archive_meta','<div id="docs-description" class="clearfix">' . $category_description . '</div>');
}
?>

<div id="docs-tax-page" class="clearfix">
        
	<div id="template-docs-section-tabs">
    
		<div id="template-docs-section-left">
			<ul id="service-tabs">
			<?php
            //start loop
			$count=0;
            while (have_posts()) : the_post();  
			$count++; 
			
			//meta
			$docs_icon = get_post_meta($post->ID, 'prth_docs_icon', TRUE);
            ?>
			<li>
                <a href="#docs-tab-<?php echo $count; ?>" title="<?php the_title(); ?>">
                    <?php if($docs_icon != 'Select') { ?>
                        <span class="prth-icon-<?php echo $docs_icon; ?>"></span>
                    <?php } ?>
                    <?php the_title(); ?>
                </a>
            </li>
            <?php endwhile; ?>
		</ul>
		<!-- /service tabs -->
		<div id="docs-sidebar">
			<?php get_sidebar('docs'); ?>
		</div><!-- /docs-sidebar -->
	</div><!-- /template-docs-section-left -->
        
	<div id="template-docs-section-right">
		<div id="service-content" class="entry">
			<?php
            //start loop
            $count=0;
            while (have_posts()) : the_post();   
            $count++;
            ?>
            <article id="docs-tab-<?php echo $count; ?>" class="service-tab-content">
				<?php
                //featured image
                $thumb = get_post_thumbnail_id();
                $img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
                $featured_image = aq_resize( $img_url, 680, 9999, false ); //resize & crop the image
                if($featured_image){
                ?>
                <div class="post-thumbnail">
                    <a href="<?php echo $featured_image; ?>" title="<?php the_title(); ?>" class="view"><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" /></a>
                </div><!-- /post-thumbnail -->
                <?php } ?>
                
                <?php the_content(); ?>
        	</article>
        	<!-- /tab -->
        <div class="clear"></div>
        <?php endwhile; ?>
		</div><!-- /docs-content -->
    </div><!-- /template-docs-section-right -->
	</div><!-- /service-template-tabs -->
</div><!-- /docs-wrap -->

<?php endif; ?>
<?php get_footer(); ?>