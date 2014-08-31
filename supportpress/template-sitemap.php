<?php
/**
 * IcarusThemes
 * Template Name: Sitemap
 */
 
global $itdata; //get theme panel data

//get header
get_header();
require_once ( 'includes/body-top.php' );

//loop
if (have_posts()) : while (have_posts()) : the_post();

//set default post type titles
$portfolio_name =($itdata['portfolio_post_type_replacement']) ? $itdata['portfolio_post_type_replacement'] : __('Portfolio','prth');
$services_name = ($itdata['services_post_type_replacement']) ? $itdata['services_post_type_replacement'] : __('Services','prth');
$staff_name = ($itdata['staff_post_type_replacement']) ? $itdata['staff_post_type_replacement'] : __('Staff','prth');
$faqs_name = ($itdata['faqs_post_type_replacement']) ? $itdata['faqs_post_type_replacement'] : __('FAQs','prth');
?>
    
<header id="page-heading">
	<h1><?php the_title(); ?></h1>
</header>
<!-- END page-heading -->
    
    
<div id="template-sitemap" class="clearfix">

    <?php the_content(); ?>
    
    <div id="sitemap-wrap" class="clearfix">
    
    	<div class="sitemap-container one-third">

			<?php
            /*--------------------------------*/
            // Feeds
            /*--------------------------------*/
            ?>
            <h2><?php _e('Feeds','prth'); ?></h2>
                <ul>  
                    <li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>  
                    <li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>  
                </ul>
                
			<?php
            /*--------------------------------*/
            // Blog Categories
            /*--------------------------------*/
            ?>
            <h2><?php _e('Blog Categories','prth'); ?></h2>    	
            <?php $args = array(
                      'orderby' => 'name',
                      'order' => 'ASC',
                      'style' => 'list',
                      'show_count' => 0,
                      'hide_empty' => 1,
                      'use_desc_for_title' => 1,
                      'child_of' => 0,
                      'hierarchical' => true,
                      'title_li' => '',
                      'number' => NULL
                    );
                ?> 
                <ul>
                <?php wp_list_categories( $args ); ?>
                </ul>
                
                
            <?php
            /*--------------------------------*/
            // Tags
            /*--------------------------------*/
            ?>
            <h2><?php _e('Tags','prth'); ?></h2>
            <?php wp_tag_cloud(array(
                'format' => 'list',
                'smallest' => 12,
                'largest' => 12,
                'unit' => 'px',
                'number' => 20,
                'orderby'  => 'name',
                'order' => 'ASC',
                'taxonomy' => 'post_tag'
                ));
            ?>
            
            
            <?php
            /*--------------------------------*/
            // Archives
            /*--------------------------------*/
            ?>
            <h2><?php _e('Archives by Month','prth'); ?></h2>
            <ul>
                <?php wp_get_archives('type=monthly&limit=10'); ?>
            </ul>
            
		</div>
		<!-- /sitemap-container one-third -->
		
        <div class="sitemap-container one-third">
            
            
            <?php
            /*--------------------------------*/
            // Portfolio Categories
            /*--------------------------------*/
            ?>
            <h2><?php echo $portfolio_name; _e(' Categories','prth'); ?></h2>
            <?php $port_args = array(
                'taxonomy' => 'portfolio_cats',
                'orderby' => 'name',
                'order' => 'ASC',
                'style' => 'list',
                'show_count' => 0,
                'hide_empty' => 1,
                'use_desc_for_title' => 1,
                'child_of' => 0,
                'hierarchical' => true,
                'title_li' => '',
                'number' => NULL
              );
            ?> 
            <ul>
                <?php wp_list_categories( $port_args ); ?>
            </ul>
            
            
            <?php
            /*--------------------------------*/
            // Services Categories
            /*--------------------------------*/
            ?>
             <h2><?php echo $services_name; _e(' Categories','prth'); ?></h2>
            <?php $port_args = array(
                'taxonomy' => 'services_cats',
                'orderby' => 'name',
                'order' => 'ASC',
                'style' => 'list',
                'show_count' => 0,
                'hide_empty' => 1,
                'use_desc_for_title' => 1,
                'child_of' => 0,
                'hierarchical' => true,
                'title_li' => '',
                'number' => NULL
              );
            ?> 
            <ul>
                <?php wp_list_categories( $port_args ); ?>
            </ul>
            
            
			<?php
            /*--------------------------------*/
            // Staff Categories
            /*--------------------------------*/
            ?>
             <h2><?php echo $staff_name; _e(' Categories','prth'); ?></h2>
            <?php $port_args = array(
                'taxonomy' => 'staff_cats',
                'orderby' => 'name',
                'order' => 'ASC',
                'style' => 'list',
                'show_count' => 0,
                'hide_empty' => 1,
                'use_desc_for_title' => 1,
                'child_of' => 0,
                'hierarchical' => true,
                'title_li' => '',
                'number' => NULL
              );
            ?> 
            <ul>
                <?php wp_list_categories( $port_args ); ?>
            </ul>
            
			<?php
            /*--------------------------------*/
            // FAQ Categories
            /*--------------------------------*/
            ?>
            <h2><?php echo $faqs_name; _e(' Categories','prth'); ?></h2>
            <?php $port_args = array(
                'taxonomy' => 'faqs_cats',
                'orderby' => 'name',
                'order' => 'ASC',
                'style' => 'list',
                'show_count' => 0,
                'hide_empty' => 1,
                'use_desc_for_title' => 1,
                'child_of' => 0,
                'hierarchical' => true,
                'title_li' => '',
                'number' => NULL
              );
            ?> 
            <ul>
                <?php wp_list_categories( $port_args ); ?>
            </ul>
      
      
		</div>
		<!-- /sitemap-container one-third -->
        
		
        
		
		<?php
        /*--------------------------------*/
        // Pages
        /*--------------------------------*/
        ?>
        <div class="sitemap-container one-third column-last">
		<h2><?php _e('Pages','prth'); ?></h2>
		<ul><?php wp_list_pages("title_li=" ); ?></ul> 
		</div>
        <!-- /sitemap-container one-third -->
    
    
	</div>
    <!-- /sitemap-wrap -->
  
  </div>
	<!-- /post -->
  
<?php
//reset the query just incase
wp_reset_query();

//end page loop
endwhile; endif;

//get footer
get_footer(); ?>