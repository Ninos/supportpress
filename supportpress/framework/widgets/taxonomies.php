<?php
/******************************************
/* Recent Posts Widget
******************************************/
class prth_taxonomies_widget extends WP_Widget {
	
    /** function */
	function __construct() {
		
		$widget_ops = array(
			'classname' => 'prth-tax-widget', 
			'description' => 'Show categories of a custom post type'
		);
		
		
        $this->WP_Widget('prth_taxonomies_widget', __('PressThemes - Post Type Categories', 'prth'), $widget_ops);
	}
	
			
	  function update($new_instance, $old_instance) {				
		  $instance = $old_instance;
		  $instance['title'] = strip_tags($new_instance['title']);
		  $instance['tax'] = strip_tags($new_instance['tax']);
		  $instance['show_count'] = strip_tags($new_instance['show_count']);
		  return $instance;
	  }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$taxonomy = apply_filters('widget_title', $instance['tax']);
		$show_count = apply_filters('widget_title', $instance['show_count']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title;
						if($taxonomy != 'no-cats') {
						?>
                        
							<ul class="prth-taxonomies-widget clearfix">
								<?php $args = array(
                                    'orderby' => 'name',
                                    'order' => 'ASC',
                                    'style' => 'list',
                                    'show_count' => $show_count,
                                    'hide_empty' => 1,
                                    'hierarchical' => true,
                                    'title_li' => '',
                                    'taxonomy' => $taxonomy,
									'offset' => null
                                  );
                                ?> 
                                 <?php wp_list_categories( $args ); ?> 
							</ul>
                            <!-- /widget-recent-post -->
              <?php } else { _e('Select a taxonomy in the dashboard','prth'); } echo $after_widget; ?>
        <?php
			}
		
			function form($instance) {
				$instance = wp_parse_args( (array) $instance, array( 'title' => __('Categories','prth'), 'id' => '', 'number' => $show_count, 'tax' => 'no-cats', 'show_count' => '1' ));			
				$title = esc_attr($instance['title']);
				$tax = esc_attr($instance['tax']);
				$show_count = esc_attr($instance['show_count']);
			?>
				 <p>
				  <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'prth'); ?></label> 
				  <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title','prth'); ?>" type="text" value="<?php echo $title; ?>" />
				</p>
				<p>
				<label for="<?php echo $this->get_field_id('tax'); ?>"><?php _e('Post Type:', 'prth'); ?></label> 
				<select class='prth-select' name="<?php echo $this->get_field_name('tax'); ?>" id="<?php echo $this->get_field_id('tax'); ?>">
					<option value="no-cats" <?php if($tax == 'no-cats') { ?>selected="selected"<?php } ?>><?php _e('None', 'prth'); ?></option>
					<?php
                    //get taxonomies
                    $args=array('public'   => true,'_builtin' => false); 
                    $output = 'names'; // or objects
                    $operator = 'and'; // 'and' or 'or'
                    $taxonomies = get_taxonomies($args,$output,$operator); 
                    foreach ($taxonomies as $taxonomy ) {
                    ?>
						<option value="<?php echo $taxonomy; ?>" id="<?php $taxonomy; ?>" <?php if($tax == $taxonomy) { ?>selected="selected"<?php } ?>><?php echo str_replace ('_cats','',$taxonomy); ?></option>
					<?php } ?>
				</select>
				</p>
                <p>
				<label for="<?php echo $this->get_field_id('show_count'); ?>"><?php _e('Show Count', 'prth'); ?></label> 
				<select class='prth-select' name="<?php echo $this->get_field_name('show_count'); ?>" id="<?php echo $this->get_field_id('show_count'); ?>">
					<option value="1" <?php if($show_count == '1') { ?>selected="selected"<?php } ?>><?php _e('Yes', 'prth'); ?></option>
 					<option value="0" id="0" <?php if($show_count == 0) { ?>selected="selected"<?php } ?>><?php _e('No','prth'); ?></option>
				</select>
				</p>
        <?php 
    }

} 

// initalize
add_action('widgets_init', create_function('', 'return register_widget("prth_taxonomies_widget");'));	
?>