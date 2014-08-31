<?php
/**
 * IcarusThemes
 */

//get global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//loop
if (have_posts()) : while (have_posts()) : the_post();

//get terms
$terms = get_the_terms( get_the_ID(), 'docs_cats' );

foreach ($terms as $term) {
	$termlist = $term->term_id;	
}


$terms_list = get_the_term_list( get_the_ID(), 'docs_cats', '', ', ', '');

?>



<header id="page-heading">
	<h1><?php the_title(); 
			//show kb position if not blank
	if($terms_list) echo '<span class="staff-post-position">'. $terms_list.'</span>';

	?></h1>

</header><!-- /page-heading -->


     
<div id="template-docs-section full-width" class="clearfix">
	<?php 
    
    //get kb categories
    $cats_args = array(
        'hide_empty' => '1',
        'orderby' => 'slug',
        'order' => 'ASC',
    );
    $cats = get_terms('docs_cats', $cats_args);

    ?>
    <div id="template-docs-section-tabs">
        <div id="template-docs-section-left">
                    <?php
   //show filter if categories exist
    if($cats) { ?>
    <!-- kb Filter -->
        <?php
        $i = 0;
        foreach ($cats as $cat ) :

        $catlink = get_term_link( $cat, $cat->taxonomy ); ?>
        <div class="template-docs-section-nav">
        <h4 class="margin0"><a href="<?php echo $catlink; ?>" rel="<?php echo $cat->slug; ?>"><icon class="icon-book margintop2"></icon> <span><?php echo $cat->name; ?></span></a></h4>
        
                <ul id="docs-tabs" class="ui-tabs-nav">
	
	            <?php 
				//meta
				$docs_icon = get_post_meta($post->ID, 'prth_docs_icon', TRUE);

	        	$cat_id= $cat->term_id;

                if($cat_id) {
                $tax_query = array(
                    array(
                          'taxonomy' => 'docs_cats',
                          'field' => 'id',
                          'terms' => $cat_id
                          )
                    );
                } else { $tax_query = NULL; }
                
                
                $args = array(
                	'orderly' => 'title',
                	'order' => 'ASC',
                	'show posts' => '-1', 
                	'posts_per_page' => '-1', 
                    'tax_query' => $tax_query,
                	'post_type' => 'docs'
                	);
                
                $wp_query_articles = new WP_Query($args); 

                if ( $wp_query_articles->have_posts() ) :
			
               while ($wp_query_articles->have_posts()) : $wp_query_articles->the_post(); ?>
               
                   <li><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><icon class="icon-file opacity6"></icon> <?php the_title(); ?></a></li>
               
               <?php endwhile; ?>
                               
               <?php endif; wp_reset_query(); ?>

                </ul>
        </div>
                    <?php endforeach; ?> 
                    <?php } ?>
                <!-- /service tabs -->
  
  

        </div><!-- /template-docs-section-left -->
       
</div>

   
    	<div id="template-docs-section-right">
            
            	<ul class="meta clearfix">
            	<?php
            	$term_list = wp_get_post_terms($post->ID, 'docs_cats', array("fields" => "names"));
            	$doc_cat = $term_list[0];
            	
            	// show breadcrumbs
                echo '<li>Section: '; echo $doc_cat; echo '</li>'; 
                echo '<li>Last Updated: '; echo the_modified_date(); echo '</li>';  
                echo '<li>By: '; echo get_the_author(); echo '</li>';  
            	?>
            	</ul>
            
	            <div id="service-content" class="entry">
            	
                <article id="docs-tab" class="service-tab-content">
                   <?php
					//show post content
                    the_content(); ?>
                </article><!-- /service-tab -->
                <div class="clear"></div>
            </div><!-- /docs-content -->
		</div><!-- /template-docs-section-right -->  
	</div><!-- /service-template-tabs -->

<?php
//reset custom query
wp_reset_postdata();

//end loop
endwhile; endif;

//get footer
get_footer(); ?>