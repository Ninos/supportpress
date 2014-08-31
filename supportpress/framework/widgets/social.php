<?php
class prth_social_widget extends WP_Widget {
	var $services = array();
	var $before_list = '<ul class="prth-clearfix">';
	var $after_list = '</ul>';
	var $before_item = '<li class="prth-social-%s">';
	var $after_item = '</li>';
	
	function prth_social_widget() {
		return self::__construct();
	}
	
	function __construct() {
		$default_services = array( 
			'twitter' => __( 'Twitter', 'prth'), 
			'facebook' => __( 'Facebook', 'prth' ),
			'tumblr' => __( 'Tumblr', 'prth' ), 
			'youtube' => __( 'YouTube', 'prth' ),
			'vimeo' => __( 'Vimeo', 'prth' ), 
			'linkedin' => __( 'LinkedIn', 'prth' ), 
			'pinterest' => __( 'Pinterest', 'prth' ),
			'github' => __( 'Github', 'prth' ),
			'flickr' => __( 'Flickr', 'prth' ), 
			'rss' => __( 'RSS', 'prth' )
		);
		$this->services = apply_filters( 'prth-social-icons-services', $default_services );
		$this->before_list = apply_filters( 'prth-social-icons-before-list', $this->before_list );
		$this->after_list = apply_filters( 'prth-social-icons-after-list', $this->after_list );
		$this->before_item = apply_filters( 'prth-social-icons-before-item', $this->before_item );
		$this->after_item = apply_filters( 'prth-social-icons-after-item', $this->after_item );
		$this->WP_Widget( 'prth-social-icons-widget', __( 'PressThemes - Social Icons', 'prth' ), array( 'classname' => 'prth-social-widget', 'description' => 'AutWidget used to show social icons.', 'prth' ) );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		
		$title	= apply_filters( 'widget_title', $instance['title'] );
		$links 	= array();
		foreach( $this->services as $s=>$n ) {
			$links[$s] = esc_url( $instance[$s] );
		}
		$links = array_filter( $links );
		if( empty( $links ) )
			return false;
		
		echo $before_widget;
		if( isset( $title ) && !empty( $title ) )
			echo $before_title . $title . $after_title;
		
		echo $this->before_list;
		foreach( $links as $s=>$link ) {
			printf( $this->before_item, esc_attr( $s ) );
			echo '<a href="' . $link . '" title="' . strtolower($this->services[$s]) . '"><img src="'. get_template_directory_uri() .'/images/social/'.  strtolower($this->services[$s]) .'.png'.'" alt="' . $this->services[$s] . '" /></a>';
			echo $this->after_item;
		}
		echo $this->after_list;
		
		echo $after_widget;
	}
	
	function update( $new, $old ) {
		$instance = $old;
		$instance['title'] = !empty( $new['title'] ) ? strip_tags( $new['title'] ) : null;
		foreach( $this->services as $s=>$n ) {
			$instance[$s] = !empty( $new[$s] ) ? esc_url( $new[$s] ) : null;
		}
		
		return $instance;
	}
	
	function form( $instance ) {
		$defaults = array_fill_keys( array_merge( array_keys( $this->services ), array( 'title' ) ), null );
		$instance = wp_parse_args( (array)$instance, $defaults );
?>
	<p><label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php _e( 'Widget Title', 'prth' ) ?></label>
    	<input type="text" class="widefat" name="<?php echo $this->get_field_name( 'title' ) ?>" id="<?php echo $this->get_field_id( 'title' ) ?>" value="<?php echo $instance['title'] ?>"/></p>
<?php
		foreach( $this->services as $s=>$n ) {
?>
	<p><label for="<?php echo $this->get_field_id( $s ) ?>"><?php echo $n ?></label>
    	<input type="url" class="widefat" name="<?php echo $this->get_field_name( $s ) ?>" id="<?php echo $this->get_field_id( $s ) ?>" value="<?php echo esc_attr( $instance[$s] ) ?>"/></p>
<?php
		}
	}
}
add_action( 'widgets_init', create_function( '', "return register_widget( 'prth_social_widget' );" ) );
?>