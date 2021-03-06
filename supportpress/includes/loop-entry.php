<?php
/**
 * IcarusThemes
 */
global $itdata;
while (have_posts()) : the_post(); ?>  

<article <?php post_class('loop-entry clearfix'); ?>>  
    <section class="entry-content">
		<?php
        //cropped image
        $thumb = get_post_thumbnail_id();
        $img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image
        
        //image height - set width the same as max responsive size
        $itdata['staff_img_height'] ? $img_height = 300 * str_replace('%', '', $itdata['staff_img_height']) / 100 : $img_height = 390;
            
        //crop image
        $featured_image = aq_resize( $img_url, 740, $img_height, true ); //resize & crop the image
?>
    	    <header>
    	        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    	    </header>

<?php
        if($featured_image) {  ?>
	    <div class="post-img">
            <div class="loop-entry-thumbnail">
				<?php if($featured_image) { ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-entry-img-link">
                    	<img src="<?php echo $featured_image; ?>" alt="<?php echo the_title(); ?>" class="post-entry-img" />
               		</a>
                <?php } ?>
            </div><!-- /loop-entry-thumbnail -->
	    </div><!-- /post-img -->
        <?php } ?>
	
	    <div class="post-content <?php if(!$featured_image) { echo 'full-width'; } ?>">

            <ul class="meta clearfix">
                <li>Posted: <?php the_time('jS F Y'); ?></li>    
                <li><?php prth_translation('comments'); ?></li>
                <li>By: <?php the_author_posts_link(); ?></li>
           </ul> 
	        <div class="entry-text">
	            <?php
				//show excerpt or content depending on theme setting
                if($itdata['enable_full_blog'] == 'enable') {
					the_content(); } else {
						echo wp_trim_words(get_the_content(), $itdata['blog_excerpt'] ); }
				?>
	        </div><!-- /entry-text -->
			<?php
			//show read more buttn if not disabled
            if($itdata['blog_read_more'] != 'disable') { ?>
				<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo prth_translation('readmore'); ?> &rarr;</a>
            <?php } ?>
	    </div><!-- /post-content -->
	</section><!-- entry-content -->   
</article><!-- /entry -->
<?php endwhile; ?>