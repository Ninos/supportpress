
<?php
/**
 * @package WordPress
 * @subpackage PressThemes
 */
 
global $itdata; //get global variables

//get grid style
$blog_grid_style = $itdata['homepage_blog_grid'];
$blog_grid_class = prth_grid($blog_grid_style);

//get column number
$column_count = str_replace(' Column', '', $itdata['homepage_blog_grid']);

//get blog count
$blog_count = $itdata['homepage_blog_count'];

//get image height
$itdata['homepage_blog_height'] ? $blog_grid_image_height = 450 * str_replace('%', '', $itdata['homepage_blog_height']) / 100 : $blog_grid_image_height = 450;

//get category
($itdata['homepage_blog_cat'] != 'Select') ? $homepage_blog_cat = $itdata['homepage_blog_cat'] : $homepage_blog_cat = NULL;

//get category posts
if($homepage_blog_cat) {
	$blog_tax_query = array(
		array(
			  'taxonomy' => 'category',
			  'field' => 'id',
			  'terms' => $homepage_blog_cat
			  )
		);
} else { $blog_tax_query = NULL; }

//get posts
global $post;
$args = array(
	'post_type' =>'post',
	'numberposts' => $blog_count,
	'tax_query' => $blog_tax_query
);
$blog_posts = get_posts($args);
?>


<?php
if($blog_posts) { ?>
<div id="home-blog">

	<?php
	
				//show heading
				if(!empty($itdata['homepage_blog_title'])) { ?>
					<?php				
						if(!empty($itdata['homepage_blog_title_url'])) { ?> 
						<h2 class="heading margintop0"><a href="<?php echo $itdata['homepage_blog_title_url']; ?>" title="<?php echo $itdata['homepage_blog_title']; ?>"><span><?php echo $itdata['homepage_blog_title']; ?></span></a></h2>
						<?php } else { ?>
						<h2 class="heading margintop0"><span><?php echo $itdata['homepage_blog_title']; ?></span></h2>
						<?php } // end if empty blog url 
				
	
				} // end if empty blog title
	
?>
	
		
	
	
    <div class="clearfix grid-container">
		<?php
		$count=0;
        //start loop
        foreach($blog_posts as $post) : setup_postdata($post);
		$count++;
        
        //cropped image
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
		
		//image width
		($blog_grid_class == 'grid-2') ? $blog_grid_image_width = 450 : $blog_grid_image_width = 390;
		
        $featured_image = aq_resize( $img_url, $blog_grid_image_width, $blog_grid_image_height, true ); //resize & crop the image
        ?>
        
        <div class="home-post-entry <?php echo $blog_grid_class; ?>">
            <?php
			//featured image
            if($featured_image) { ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-entry-img-link">
                    <img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" class="post-entry-img" />
                </a>
            <?php } ?>

	           

                <h2><span class="home-post-date-span"><?php echo get_the_date(); ?></span><br/><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

            <?php if($itdata['homepage_blog_excerpt'] != 'disable') { ?>
            <div class="home-post-entry-excerpt">
                <?php echo wp_trim_words(get_the_content(), $itdata['homepage_blog_excerpt_length']); ?>
            </div>
            <!-- /home-post-excerpt -->
            <?php } ?>
            <?php 
			//show read more link if not disabled
			if($itdata['homepage_blog_read_more'] != 'disable') { ?>
				<span class="paddingleft10"><a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo prth_translation('readmore'); ?> &rarr;</a></span>
            <?php } ?>
        </div>
        <!-- /home-post -->
        <?php
        //clear floats
		if($count == $column_count) { echo '<div class="clear"></div>'; $count = 0; }
		//end loop
		endforeach; ?>
		
	
		
		
	</div><!-- /grid-container -->
</div>
<!-- /home-blog -->      	
<?php
} //no posts found
wp_reset_postdata(); //reset post data 
?>