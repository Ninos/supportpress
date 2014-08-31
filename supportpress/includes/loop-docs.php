<?php
/**
 * IcarusThemes
 */
 
//get global variables
global $itdata, $prth_counter, $docs_grid_class, $docs_grid_image_height;

//counter
$prth_counter++;

//featured image
$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_url($thumb,'full'); //get full URL to image

//set image width
($docs_grid_class == 'grid-3') ? $docs_grid_image_width = 450 : $docs_grid_image_width = 390;

//crop image
$featured_image = aq_resize( $img_url, $docs_grid_image_width, $docs_grid_image_height, true ); //resize & crop the image

//get terms
$terms = get_the_terms( get_the_ID(), 'docs_cats' );
$terms_list = get_the_term_list( get_the_ID(), 'docs_cats' );

//get meta
$docs_entry_style = get_post_meta($post->ID, 'prth_docs_entry_style', true);
$docs_entry_lightbox = get_post_meta($post->ID, 'prth_docs_entry_lightbox', true);
$docs_entry_custom_url = get_post_meta($post->ID, 'prth_docs_entry_custom_url', true);
$docs_entry_custom_url_target = get_post_meta($post->ID, 'prth_docs_entry_custom_url_target', true);


//set entry url to lightbox
if($docs_entry_style == 'lightbox') { $docs_entry_url = $docs_entry_lightbox;
	//set entry url to custom url
	} elseif ($docs_entry_style == 'url') { $docs_entry_url = $docs_entry_custom_url;
	//set entry url to default permalink
	} else { $docs_entry_url = get_permalink($post->ID); }


//show entry only if it has a featured image
if($featured_image) {  ?>
<li data-id="id-<?php echo $prth_counter; ?>" data-type="<?php if($terms) { foreach ($terms as $term) { echo $term->slug .' '; } } else { echo 'none'; } ?>" class="docs-post <?php echo $docs_grid_class; ?>">
	<a href="<?php echo $docs_entry_url; ?>" title="<?php the_title(); ?>" class="docs-post-img-link <?php if($docs_entry_style == 'lightbox') { echo 'prettyphoto-link'; } ?>" <?php if($docs_entry_custom_url) { echo 'target="_'.$docs_entry_custom_url_target.'"'; } ?>><img src="<?php echo $featured_image; ?>" alt="<?php the_title(); ?>" class="docs-post-img" /></a>
	<?php if($itdata['show_hide_docs_title'] == 'enable' || $itdata['show_hide_docs_excerpt'] == 'enable') { ?>
    <div class="docs-post-description">
        <?php
        //item title
        if($itdata['show_hide_docs_title'] != 'disable') { ?>
        	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        <?php }
        //item excerpt
        if($itdata['show_hide_docs_excerpt'] != 'disable') { ?>
        	<div class="docs-post-excerpt">
				<?php
                !empty($post->post_excerpt) ? $excerpt = get_the_excerpt() : $excerpt = wp_trim_words(get_the_content(), $itdata['docs_entry_excerpt_length']);
                echo $excerpt; ?>
            </div><!-- .docs-post-excerpt -->
        <?php } ?>
		<?php
		//show read more buttn if not disabled
		if($itdata['docs_read_more'] != 'disable') { ?>
		<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo prth_translation('readmore'); ?> &rarr;</a>
		<?php } ?>
    </div><!-- .docs-post-description -->
    <?php } ?>
</li><!-- /docs-post -->
<?php } //end loop ?>