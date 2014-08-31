<?php
/**
 * IcarusThemes
 */

//global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//start post loop
if (have_posts()) : while (have_posts()) : the_post();

//get terms
$terms = get_the_terms( get_the_ID(), 'kb_cats' );

foreach ($terms as $term) {
	$termlist = $term->term_id;	
}


$terms_list = get_the_term_list( get_the_ID(), 'kb_cats', '', ', ', '');

?>

<header id="page-heading">
    <h1>
	<?php
	//show main title
	the_title();
	//show kb position if not blank
	if($terms_list) echo '<span class="staff-post-position">'. $terms_list.'</span>';
	?>
    
    </h1>
    	
	<nav id="post-navigation" class="clearfix"> 
        <?php next_post_link('<div id="post-navigation-left">%link</div>', '<i class="icon-chevron-left"></i>', false); ?>
        <?php previous_post_link('<div id="post-navigation-right">%link</div>', '<i class="icon-chevron-right"></i>', false); ?>
    </nav><!-- /post-navigation --> 
</header><!-- /post-meta -->

<div id="post" class="kb-post clearfix">

    <article id="kb-entry" class="entry clearfix">
		<?php			
        //featured image URL
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
		
		//image crop size
		$featured_image = aq_resize( $img_url, 740, 9999, false );
		
		//show featured image
        if($featured_image){
        ?>
        <div id="kb-post-thumbnail">
           <img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" />
        </div><!-- /kb-post-thumbnail -->
        <?php } //no featued image defined ?>
     
        <?php
		//show post content
        the_content(); ?>
    </article><!-- /entry -->
    
	<?php
	//show comments if not disabled
    if($itdata['show_hide_kb_comments'] !='disable') { comments_template(); } ?>
</div><!-- /post -->


<?php
//end post loop
endwhile; endif; 
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



	<div class="sidebar-box prth-tax-widget clearfix">

<?php  if($terms_list) { ?>
    <!-- kb Filter -->
    <h4 class="heading margintop0"><a href="#" rel="<?php $terms_list; ?>"><span class="paddingright0">More From <?php echo $terms_list; ?></span></a></h4>
        
        <ul id="kb-cats" class="prth-taxonomies-widget clearfix">

	        <?php 
	        $taxname = $terms_list;

                if($terms_list) {
                $tax_query = array(
                    array(
                          'taxonomy' => 'kb_cats',
                          'field' => 'id',
                          'terms' => $termlist
                          )
                    );
                } else { $tax_query = NULL; }
                
                $args = array(
                	'orderly' => 'title',
                	'order' => 'ASC',
                	'show posts' => '-1', 
                	'posts_per_page' => '-1', 
                    'tax_query' => $tax_query,
                	'post_type' => 'kb'
                	);
                
                $wp_query_articles = new WP_Query($args); 

                if ( $wp_query_articles->have_posts() ) :
			
                while ($wp_query_articles->have_posts()) : $wp_query_articles->the_post(); 
                          
                   ?>
                   <li><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
                   <?php 
                    
                endwhile; endif; wp_reset_query(); ?>
        
        
        </ul><!-- /kb-cats -->
                
    <?php }  ?>


	</div>




	<?php dynamic_sidebar('kb'); ?>


</div>

<!-- /sidebar -->
<?php

//get footer
get_footer(); ?>