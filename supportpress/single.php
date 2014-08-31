<?php
/**
 * Press Themes
 */
 
//get global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//start post loop
if (have_posts()) : while (have_posts()) : the_post();

//get meta options
$single_featured_image = get_post_meta($post->ID, 'prth_single_featured_image', TRUE);
$single_single_tags = get_post_meta($post->ID, 'prth_single_tags', TRUE);
$single_related_posts = get_post_meta($post->ID, 'prth_single_related_posts', TRUE);

//image height
($itdata['post_image_height']) ? $post_image_height = 400 * str_replace('%', '', $itdata['post_image_height']) / 100 : $post_image_height = 400;
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
	<nav id="post-navigation" class="clearfix"> 
        <?php next_post_link('<div id="post-navigation-left">%link</div>', '<span class="inner"><i class="icon-chevron-left"></i></span>', false); ?>
        <?php previous_post_link('<div id="post-navigation-right">%link</div>', '<span class="inner"><i class="icon-chevron-right"></i></span>', false); ?>
    </nav><!-- /post-navigation --> 
</header><!-- /post-meta -->

<div id="post" class="clearfix">
      
        <?php
        //show post meta if not disabled
		if($itdata['show_hide_single_meta'] !='disable') { ?>
            <section class="meta clearfix" id="single-meta">
                <ul>
                    <li>Posted: <?php the_date(); ?></li>    
                    <li>In: <?php the_category(' / '); ?></li>
                    <li class="comment-scroll"><?php prth_translation('comments'); ?></li>
                    <li>By: <?php the_author_posts_link(); ?></li>
               </ul>
            </section><!--/meta -->
        <?php } ?>
        
        <?php
		//show if not disabled in admin
		if($single_featured_image != 'disable') {
			
		//featured image
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
		($itdata['show_hide_single_post_image_crop'] == 'enable') ? $featured_image = aq_resize( $img_url, 740, $post_image_height, true ) : $featured_image = $img_url;
		
		if($itdata['show_hide_post_image'] !='disable' && $featured_image) {
		?>
		<div id="post-thumbnail">
			<a href="<?php echo $img_url; ?>" title="<?php the_title(); ?>" class="prettyphoto-link">
            	<img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" />
            </a>
		</div><!-- /post-thumbnail -->
        <?php } } ?>
        
       
		<article id="single-post" class="entry clearfix">
			<?php the_content(); // *** this is your main post content output *** ?>
        </article><!-- /entry -->
        
        
        <?php wp_link_pages(' '); ?>
        
		<?php
		//show tags unless disabled
        if($single_single_tags !='disable' && $itdata['show_hide_single_tags'] !='disable') {
			the_tags('<div class="post-tags clearfix"><h4 class="heading"><span>'. prth_translation('tags').'</span></h4>','','</div>');
		}
		?>
        
        
		<?php
        //show related posts unless disabled
        if($single_related_posts != 'disable' && $itdata['show_hide_single_related_posts'] !='disable') {
    
        //start related posts section
        $category = get_the_category(); //get first current category ID
        $this_post = $post->ID; // get ID of current post
        
        $args = array(
            'numberposts' => '3',
            'orderby' => 'rand',
            'category' =>  $category[0]->cat_ID,
            'exclude' => $this_post,
            'offset' => null
        );
        $posts = get_posts($args);
        if($posts) { ?>
		<div id="single-portfolio-related" class="clearfix">
                <h3 class="heading"><span><?php echo $itdata['translation_related_articles_text'] ? $itdata['translation_related_articles_text'] : __('Related Articles','prth'); ?></span></h3>
			<div class="grid-container">
                <?php
                foreach($posts as $post) : setup_postdata($post);
			  	//featured img
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
				$featured_image = aq_resize( $img_url, 450, 300, true ); //resize & crop the image
                ?>
                <div class="portfolio-post grid-3">
                    <?php if($featured_image) { ?>
                         <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="portfolio-post-img-link">
                         	<img class="portfolio-post-img" src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" />
                         </a>
                    <?php } ?>
                    <div class="portfolio-post-description">
                      <h2><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h2>
                      <div class="portfolio-post-excerpt">
                        <?php echo wp_trim_words( get_the_content(), 25, '...' ); ?><a href="<?php the_permalink(); ?>" class="read-more"><?php _e('read more','prth'); ?> &rarr;</a>
                      </div><!-- /related-entry-excerpt -->
                    </div>
                    <!-- /related-entry-content -->
                </div>
                <!-- /related-entry -->
                <?php endforeach; wp_reset_postdata(); ?>
			</div>
            </div> 
            <!-- /end related-posts --> 
            <?php } } ?>
            
        
        <?php
        //show comments if not disabled
        if($itdata['show_hide_blog_comments'] !='disable') { comments_template(); } ?>
        
</div><!-- /post -->

<?php
//end post loop
endwhile; endif;

//get sidebar
//get_sidebar(); ?>
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


	<?php dynamic_sidebar('sidebar'); ?>


</div>
<?php
//get footer
get_footer(); ?>