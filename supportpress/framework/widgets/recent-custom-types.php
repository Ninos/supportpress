<?php
/******************************************
/* Recent Posts Widget
******************************************/
class prth_recent_custom_types extends WP_Widget {
							
    /** function */
    function prth_recent_custom_types() {
        parent::WP_Widget(false, $name = 'PressThemes - Recent Custom Posts');
    }

    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $number = apply_filters('widget_title', $instance['number']);
		$post_type = apply_filters('widget_title', $instance['post_type']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
							<ul class="prth-recent-custom-types-widget">
								<?php
								global $post;
								$tmp_post = $post;
								$args = array(
									'post_type' => $post_type,
									'numberposts' => $number,
									'offset' => null
								);
								$myposts = get_posts( $args );
								foreach( $myposts as $post ) : setup_postdata($post);
								?>
								<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
								<?php
								//end loop
                                endforeach;
								//reset query
								$post = $tmp_post; ?>
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }

    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['number'] = strip_tags($new_instance['number']);
	$instance['post_type'] = strip_tags($new_instance['post_type']);
        return $instance;
    }

    function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Recent Posts', 'id' => '', 'number'=> $number, 'post_type' => 'all-cats'));			
        $title = esc_attr($instance['title']);
        $number = esc_attr($instance['number']);
		$post_type = esc_attr($instance['post_type']);
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'prth'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title','prth'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Posts to Show:', 'prth'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
		 <p>
        <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type:', 'prth'); ?></label> 
        <select class='prth-select' name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>">
            <option value="no-cats" <?php if($post_type == 'no-cats') { ?>selected="selected"<?php } ?>><?php _e('None', 'prth'); ?></option>
            <?php
            //get post_typeonomies
            $args=array('public' => true,'_builtin' => false, 'exclude_from_search' => false); 
            $output = 'names'; // or objects
            $operator = 'and'; // 'and' or 'or'
            $get_post_types = get_post_types($args,$output,$operator); 
            foreach ($get_post_types as $get_post_type ) {
				if($get_post_type !='options'){
            ?>
                <option value="<?php echo $get_post_type; ?>" id="<?php $get_post_type; ?>" <?php if($post_type == $get_post_type) { ?>selected="selected"<?php } ?>><?php echo $get_post_type; ?></option>
            <?php } } ?>
        </select>
        </p>

        <?php 
    }


}

// initalize
add_action('widgets_init', create_function('', 'return register_widget("prth_recent_custom_types");'));	
?>