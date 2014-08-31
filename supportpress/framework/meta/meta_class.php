<?php
/**
 * Create meta box for editing pages in WordPress
 *
 * Compatible with custom post types since WordPress 3.0
 * Support input types: text, textarea, checkbox, checkbox list, radio box, select, wysiwyg, file, image, date, time, color
 *
 * @author Rilwis <rilwis@gmail.com>
 * @link http://www.deluxeblogtips.com/p/meta-box-script-for-wordpress.html
 * @example meta-box-usage.php Sample declaration and usage of meta boxes
 * @version: 3.2
 * @license GNU General Public License v3.0
 *
 *
 * Press Themes
 *
 */
 
class prth_meta_box {

	protected $_meta_box;
	protected $_fields;

	// Create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;

		// assign meta box values to local variables and add it's missed values
		$this->_meta_box = $meta_box;
		$this->_fields = &$this->_meta_box['fields'];
		$this->add_missed_values();

		add_action('add_meta_boxes', array(&$this, 'add'));	// add meta box, using 'add_meta_boxes' for WP 3.0+
		add_action('save_post', array(&$this, 'save'));		// save meta box's data
		


		// load common css files
		add_action('admin_print_styles', array(&$this, 'js_css'));
		
		// slides ajax filter
		add_action('wp_ajax_add_new_meta_slide', array(&$this, 'add_slide'));
	}

	//load css
	function js_css() {
		
		$bas_dir = it_FRAMEWORK_DIR .'/meta/scripts';

		//enqueue js
		wp_enqueue_script('media-upload');
		add_thickbox();
		wp_enqueue_script('farbtastic'); //colorpicker
		wp_enqueue_script('prth-metabox-js', $bas_dir .'/metabox.js');
			
		//enqueue style
		wp_enqueue_style('farbtastic');
		wp_enqueue_style('prth-metabox-css', $bas_dir .'/metabox.css');
		
	}
	

	/******************** BEGIN META BOX PAGE **********************/

	// Add meta box for multiple post types
	function add() {
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}

	// Callback function to show fields in meta box
	function show() {
		global $post;

		wp_nonce_field(basename(__FILE__), 'prth_meta_box_nonce');
		echo '<table class="form-table">';

		foreach ($this->_fields as $field) {
			$meta = get_post_meta($post->ID, $field['id'], !$field['multiple']);
			$meta = ($meta !== '') ? $meta : $field['std'];

			$meta = is_array($meta) ? $this->array_map_r('esc_attr', $meta) : esc_attr($meta);

			echo '<tr>';
			// call separated methods for displaying each type of field
			call_user_func(array(&$this, 'show_field_' . $field['type']), $field, $meta);
			echo '</tr>';
		}
		echo '</table>';
	}
	

	/******************** BEGIN META BOX FIELDS **********************/

	function show_field_begin($field, $meta) {
		echo "<th class='prth-label-td'><label class='prth-label' for='{$field['id']}'>{$field['name']}</label><br /><small>{$field['desc']}</small></th><td class='prth-field' style='position: relative;'>";
	}

	function show_field_end($field, $meta) {
		echo "</td>";
	}
	
	//color
	function show_field_color($field, $meta) {
		if (empty($meta)) $meta = '#';
		$this->show_field_begin($field, $meta);
		echo "<input class='prth-color' type='text' name='{$field['id']}' id='{$field['id']}' value='$meta' size='8' />
			  <a href='#' class='prth-color-select' rel='{$field['id']}'>" . __('Select a color','prth') . "</a>
			  <a href='#' class='prth-color-select' style='display: none;'>" . __('Hide Picker','prth') . "</a>
			  <div style='display:none; position: absolute; background: #f0f0f0; border: 1px solid #ccc; z-index: 100;' class='prth-color-picker' rel='{$field['id']}'></div>";
		$this->show_field_end($field, $meta);
	}
	
	//text
	function show_field_text($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<input type='text' class='prth-text' name='{$field['id']}' id='{$field['id']}' value='$meta' size='30' /><br />";
		$this->show_field_end($field, $meta);
	}
	
	//textarea
	function show_field_textarea($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<textarea class='prth-textarea large-text' name='{$field['id']}' id='{$field['id']}' cols='60' rows='5'>$meta</textarea>";
		$this->show_field_end($field, $meta);
	}
	
	//select
	function show_field_select($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		$this->show_field_begin($field, $meta);
		echo "<select class='prth-select' name='{$field['id']}" . ($field['multiple'] ? "[]' id='{$field['id']}' multiple='multiple'" : "'") . ">";
		foreach ($field['options'] as $key => $value) {
			echo "<option value='$value'" . selected(in_array($value, $meta), true, false) . ">$value</option>";
		}
		echo "</select><br />";
		$this->show_field_end($field, $meta);
	}
	
	//plaintext
	function show_field_plaintext($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "$meta";
		$this->show_field_end($field, $meta);
	}
	
	
	//slider shortcode
	function show_field_slider_shortcode($field, $meta) {
		echo "<th class='prth-label-td'>";
			global $post;
			echo '[slider id='.$post->ID.']';
		echo "</td>";
	}
	
	//slides
	function show_field_slides($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		echo '<div class="prth_slides_select">';
		$this->show_field_begin($field, $meta);
		
			echo "<select class='prth-select'name='{$field['id']}" . ($field['multiple'] ? "[]' id='{$field['id']}' multiple='multiple'" : "'") . ">";
			echo "<option value='no_slider'>". __('None','prth') ."</option>";
					
				//get posts
				$args = array( 'post_type' => 'slides', 'posts_per_page' => '-1' );
				$slides = get_posts($args);
		
				//show select
				foreach ( $slides as $slide) {
					echo "<option value='".$slide->ID."'" . selected(in_array($slide->ID, $meta), true, false) . ">". $slide->post_title ."</option>";
				}
				
		echo "</select><br />";
		$this->show_field_end($field, $meta);
		echo '</div>';
	}
	
	//taxonomy
	function show_field_taxonomy($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		echo '<div class="prth_tax_meta_wrap">';
		$this->show_field_begin($field, $meta);
		
			echo "<select class='prth-select'name='{$field['id']}" . ($field['multiple'] ? "[]' id='{$field['id']}' multiple='multiple'" : "'") . ">";
			echo "<option value='select_".$field['taxonomy']."_parent'>". __('All','prth') ."</option>";
					
				//get terms
				$cat_args = array( 'hide_empty' => '1' );
				$cat_terms = get_terms($field['taxonomy'], $cat_args);
		
				foreach ( $cat_terms as $cat_term) {
					echo "<option value='$cat_term->term_id'" . selected(in_array($cat_term->term_id, $meta), true, false) . ">".$cat_term->name."</option>";
				}
		echo "</select><br />";
		$this->show_field_end($field, $meta);
		echo '</div>';
	}
	
	//slider
	function show_field_slider($field, $meta) {
		echo '<tr style="border-top:1px solid #eeeeee;">',
			'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:20px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
			'<td>';
			
		echo '<ul id="'.$field['id'].'" class="meta-slides">',
				'<input type="hidden" id="'. wp_create_nonce('meta_slides_nonce') .'" class="ms_nonce" />';
		
		$i = 0;
		
		$id = $field['id'];
		$slides = $meta;
		
		foreach ($slides as $key => $slide) {
			if($slide) {
			
			$i++;
				
				echo $this->get_meta_slider( $id, $slide, $i );
			
			}
		}
		
		echo '</ul>',
		'<a href="#" class="prth-ms-add-new">Add New Slide</a>';
	}

	/******************** BEGIN META BOX SAVE **********************/

	// Save data from meta box
	function save($post_id) {
		global $post_type;
		$post_type_object = get_post_type_object($post_type);

		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)						// check autosave
		|| (!isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])			// check revision
		|| (!in_array($post_type, $this->_meta_box['pages']))					// check if current post type is supported
		|| (!check_admin_referer(basename(__FILE__), 'prth_meta_box_nonce'))		// verify nonce
		|| (!current_user_can($post_type_object->cap->edit_post, $post_id))) {	// check permission
			return $post_id;
		}

		foreach ($this->_fields as $field) {
			$name = $field['id'];
			$type = $field['type'];
			$old = get_post_meta($post_id, $name, !$field['multiple']);
			$new = isset($_POST[$name]) ? $_POST[$name] : ($field['multiple'] ? array() : '');

			// validate meta value
			if (class_exists('prth_meta_box_Validate') && method_exists('prth_meta_box_Validate', $field['validate_func'])) {
				$new = call_user_func(array('prth_meta_box_Validate', $field['validate_func']), $new);
			}

			// call defined method to save meta value, if there's no methods, call common one
			$save_func = 'save_field_' . $type;
			if (method_exists($this, $save_func)) {
				call_user_func(array(&$this, 'save_field_' . $type), $post_id, $field, $old, $new);
			} else {
				$this->save_field($post_id, $field, $old, $new);
			}
		}
	}

	// Common functions for saving
	function save_field($post_id, $field, $old, $new) {
		$name = $field['id'];
		delete_post_meta($post_id, $name);
		
		if ($new === '' || $new === array()) return;
		
		update_post_meta($post_id, $name, $new);

	}	

	/******************** BEGIN HELPER FUNCTIONS **********************/

	// Add missed values for meta box
	function add_missed_values() {
		
		// default values for meta box
		$this->_meta_box = array_merge(array(
			'context' => 'normal',
			'priority' => 'high',
			'pages' => array('post')
		), $this->_meta_box);

		// default values for fields
		foreach ($this->_fields as &$field) {
			$multiple = in_array($field['type'], array('checkbox_list', 'file', 'image'));
			$std = $multiple ? array() : '';
			$field = array_merge(array(
				'multiple' => $multiple,
				'std' => $std,
				'desc' => '',
				'validate_func' => ''
			), $field);
		}
	}
	
	/******************** CUSTOM FUNCTIONS **********************/
	function array_map_r($func, $meta) {
		$newArr = array();
		foreach($meta as $key => $value){
			$newArr[$key] = ( is_array( $value ) ? $this->array_map_r( $func, $value ) : $func( $value ) );
		}
		return $newArr;
	}
	
	function add_slide() {
		$nonce=$_POST['security'];	
		if (! wp_verify_nonce($nonce, 'meta_slides_nonce') ) die('-1');
		
		$id = $_POST['id'];
		$i = $_POST['num'];
		
		$response = $this->get_meta_slider($id, '', $i);
		
		echo $response;
		
		die();
	}
	
	function get_meta_slider( $id, $slide = array(), $i ) {
		
		//run the loop to get & save slides 
		$image = isset($slide['image']) ? $slide['image'] : '';
		$title = isset($slide['title']) ? $slide['title'] : 'Slide ' . $i;
		$link = isset($slide['link']) ? $slide['link'] : '';
		$lightbox = isset($slide['lightbox']) ? $slide['lightbox'] : '';
		$desc = isset($slide['desc']) ? $slide['desc'] : '';
		$video = isset($slide['video']) ? $slide['video'] : '';
		
		$return = '';
		
		$return .= '<li id="'. $image .'_0'. $i .'" class="prth-ms-container">';
		
		$return .= '<div class="prth-ms-head">'. $title .'<a href="#" class="prth-ms-toggle">expand/close</a></div>';
		
		$return .= '<div class="prth-ms-body">';
			
		$return .= '<p>
					<label for="'. $id .'-'. $i .'-title">'. __('Slide title *', 'prth') .'</label>
					<input type="text" class="prth-ms-input" id="'. $id .'-'. $i .'-title" name="'. $id .'['.$i.'][title]" value="'. $title .'" />
				</p>';
			
		$return .= '<p>
					<label for="'. $id .'-'. $i .'-title">'. __('Image', 'prth') .'<br /><small>'.__('MUST be uploaded to your WordPress install for security reasons', 'prth') .'</small></label>
					<input type="text" class="prth-ms-input" id="'. $id .'-'. $i .'-image" name="'. $id.'['.$i.'][image]" value="'. $image .'" />
					<input type="button" class="ms-upload-button button" id="'. $id .' "value="'. __('Upload', 'prth') .'" />
				</p>';
					
		$return .= '<p>
					<label for="'. $id .'-'. $i .'-link">'. __('Link:', 'prth') .'</label>
					<input type="text" class="prth-ms-input" id="'. $id .'-'. $i .'-link" name="'. $id.'['.$i.'][link]" value="'. $link .'" />
				</p>';
				
		$return .= '<p>
					<label for="'. $id .'-'. $i .'-lightbox">'. __('Lightbox Link:', 'prth') .'<br /><small>'. __('this will override the link field above.', 'prth') .'</small></label>
					<input type="text" class="prth-ms-input" id="'. $id .'-'. $i .'-lightbox" name="'. $id.'['.$i.'][lightbox]" value="'. $lightbox .'" />
				</p>';
				
		$return .= '<p>
					<label for="'. $id .'-'. $i .'-desc">'. __('Description (Optional) ', 'prth') .'</label>
					<textarea class="prth-ms-textarea" rows="6" cols="20" id="'. $id .'-'. $i .'-desc" name="'. $id.'['.$i.'][desc]">'. $desc .'</textarea>
				</p>';
				
		$return .= '<p>
					<label for="'. $id .'-'. $i .'-video">'. __('Video URL:', 'prth') .'<br /><small>'. __('Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature.', 'prth') .' <a href="http://codex.wordpress.org/Embeds" target="_blank">'. __('Learn More', 'prth') .'</small></a></label>
					<input type="text" class="prth-ms-input" id="'. $id .'-'. $i .'-video" name="'. $id.'['.$i.'][video]" value="'. $video .'" />
				</p>';
			
		$return .= '<a href="#" class="prth-ms-delete">Delete</a>
			</div>
			
		</li>';
		
		return $return;
	}
	
} //end class
?>