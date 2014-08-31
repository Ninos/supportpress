<?php
/**
 * IcarusThemes
 */
 
//get global variables
global $itdata;

//grid style
$features_grid_style = $itdata['home_features_grid']; //get grid style meta
$features_grid_class = prth_grid($features_grid_style); //set grid style

//column number - used for clearing floats
$column_count = str_replace(' Column', '', $itdata['home_features_grid']);

//get post type ==> hp features
global $post;
$args = array(
	'post_type' =>'hp_features',
	'numberposts' => '-1'
);
$hp_feature_posts = get_posts($args);

//start loop if features actually exist
if($hp_feature_posts) { ?>        

<div id="home-features">
    
	<?php
	//show heading
    if(!empty($itdata['homepage_features_title'])) { ?>
				<?php				
                if(!empty($itdata['homepage_features_title_url'])) { ?> 
                	<h2 class="heading"><a href="<?php echo $itdata['homepage_features_title_url']; ?>" title="<?php echo $itdata['homepage_features_title']; ?>"><span><?php echo $itdata['homepage_features_title']; ?></span></a></h2>
                <?php } else { ?>
                	<h2 class="heading"><span><?php echo $itdata['homepage_features_title']; ?></span></h2>
				<?php } ?>
	

	<?php } ?>
    
    <div class="grid-container clearfix">
    
		<?php
		$count=0; //set counter var
        foreach($hp_feature_posts as $post) : setup_postdata($post); //start loop
		$count++; //increase counter var with each post in loop
        
        //meta
        $hp_features_url = get_post_meta($post->ID, 'prth_hp_features_url', TRUE);


		//featured image
		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image	
		
		//set image width
		($features_grid_class == 'grid-2') ? $features_grid_image_width = 450 : $features_grid_image_width = 390;

		//image height
		($itdata['homepage_features_height']) ? $features_grid_image_height = 450 * str_replace('%', '', $itdata['homepage_features_height']) / 100 : $features_grid_image_height = 450;

		
		//resize & crop image
		$featured_image = aq_resize( $img_url, $features_grid_image_width, $features_grid_image_height, true );


        ?>


        <div class="hp-feature <?php echo $features_grid_class; echo ' '. $post->ID; ?>">
   
       <?php if($featured_image) { ?>
	<div class="textaligncenter">
	   <?php if(!empty($hp_features_url)) { ?><a href="<?php echo $hp_features_url; ?>" title="<?php the_title(); ?>">
				<?php } ?>
	        <img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" class="features-img" />
	   <?php if(!empty($hp_features_url)) { ?> </a> <?php } ?>
	</div>
    <?php } ?>
        
            
            <h3>
				<?php
				//show the feature title as a link
				if(!empty($hp_features_url)) { ?><a href="<?php echo $hp_features_url; ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				<?php }
				//show plain title because link option is blank
				else { the_title(); } ?>
            </h3>
            <?php
			//show the post content
            the_content(); ?>
        </div>
        <!-- /hp-feature -->
		<?php
        //clear floats
		if($count == $column_count) { echo '<div class="clear"></div>'; $count = 0; }
		//end loop
		endforeach; ?>
	 </div><!-- /grid-container -->
     
</div><!-- /home-features -->      	
<?php
} //no features found
wp_reset_postdata(); ?>