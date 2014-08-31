<?php
/**
 * Press Themes
 */
global $itdata, $prth_kb_counter, $kb_grid_class, $kb_grid_image_height; //global variables

//setup counter to use for clearing floats
$kb_column_number = str_replace('grid-','',$kb_grid_class);

//start counting
$prth_kb_counter++;

//get meta
$kb_position = get_post_meta($post->ID, 'prth_kb_position', TRUE);

//set image width
($kb_grid_class == 'grid-2') ? $kb_grid_image_width = 450 : $kb_grid_image_width = 390;

?>
<div class="kb-entry <?php echo $kb_grid_class; ?>">

	<div class="kb-entry-description">
    	<div class="kb-entry-header">
            <h3><icon class="icon-list-alt margintop3"></icon> <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
        </div><!-- /kb-entry-header -->

            <div class="kb-entry-excerpt">
                <?php echo wp_trim_words(get_the_content(), 75 ); ?>
            </div><!-- /kb-entry-excerpt -->
			<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo prth_translation('readmore'); ?> &rarr;</a>
	</div><!-- /kb-entry-description -->
</div><!-- /kb-entry -->
<?php if($prth_kb_counter == $kb_column_number) { echo '<div class="clear"></div>'; $prth_kb_counter=0; } ?>