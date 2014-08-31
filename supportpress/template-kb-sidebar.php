<?php
/**
 * IcarusThemes
 * Template Name: KnowledgeBase With Sidebar
 */

//get theme options
global $itdata;

//get template header
get_header();
require_once ( 'includes/body-top.php' );

//start page loop
if (have_posts()) : while (have_posts()) : the_post();

//posts per page
$template_posts_per_page = get_post_meta($post->ID, 'prth_template_posts_per_page', true);

//grid style
$kb_grid_style = get_post_meta($post->ID, 'prth_grid_style', true); //get grid style meta
$kb_grid_class = prth_grid($kb_grid_style); //set grid style

//grid image height
$kb_grid_image_height_meta = get_post_meta($post->ID, 'prth_grid_image_height', true); //set grid image height meta
($kb_grid_image_height_meta) ? $kb_grid_image_height = 450 * str_replace('%', '', $kb_grid_image_height_meta) / 100 : $kb_grid_image_height = 450;

?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>	
</header><!-- /page-heading -->

<div id="post">



    <?php
	//show page content if not empty
    $content = $post->post_content;
    if(!empty($content)) { ?>
        <div id="kb-description" class="clearfix">
            <?php the_content(); ?>
        </div><!-- kb-description -->
    <?php } ?>


<div class="grid-container">

	<?php 
    //get kb categories
    $cats_args = array(
        'hide_empty' => '1'
    );
    $cats = get_terms('kb_cats', $cats_args);


    
    //show filter if categories exist
    if($cats) { ?>
    <!-- kb Filter -->
        <?php
        $i = 0;
        foreach ($cats as $cat ) : ?>
        
        <div id="kb-category" <?php if ($i == 0) { echo 'class="marginright20"'; } else { echo 'class="grid-2"'; } ?>>

        
        <?php $catlink = get_term_link( $cat, $cat->taxonomy ); ?>
        
        <h2 class="margintop0"><a href="<?php echo $catlink; ?>" rel="<?php echo $cat->slug; ?>"><icon class="icon-briefcase margintop5"></icon> <span><?php echo $cat->name; ?></span></a></h2>
        
        <ul id="kb-cats" class="prth-taxonomies-widget clearfix">
	      

	        <?php 
	        	$cat_id= $cat->term_id;

                if($cat_id) {
                $tax_query = array(
                    array(
                          'taxonomy' => 'kb_cats',
                          'field' => 'id',
                          'terms' => $cat_id
                          )
                    );
                } else { $tax_query = NULL; }
                
                
                $args = array(
                	'orderly' => 'title',
                	'order' => 'ASC',
                	'show posts' => '3', 
                	'posts_per_page' => '3', 
                    'tax_query' => $tax_query,
                	'post_type' => 'kb'
                	);


                
                $wp_query_articles = new WP_Query($args); 

                if ( $wp_query_articles->have_posts() ) :
			
			
                while ($wp_query_articles->have_posts()) : $wp_query_articles->the_post(); 
                          
                   ?>
                   <li><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                   <?php
                    
                endwhile; ?>
                
                    <li><a href="<?php echo $catlink; ?>" rel="all" class=""><span><?php _e('See All', 'prth'); ?></span></a></li>
               
               <?php endif; wp_reset_query(); ?>
        
        
        </ul><!-- /kb-cats -->
        
        </div>
        <?php                    
        
        	$i++;

	        endforeach;?>
    <?php } ?>


</div><!-- /container -->

</div><!-- /post -->

<?php
//end page loop
endwhile; endif;

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

//get template footer
get_footer(); ?>