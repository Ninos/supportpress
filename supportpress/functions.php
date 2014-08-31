<?php
/**
 * IcarusThemes
*/









//URI Shortcuts
define( 'it_FRAMEWORK_DIR', get_template_directory_uri().'/framework' );
define( 'it_JS_DIR', get_template_directory_uri().'/js' );
define( 'it_CSS_DIR', get_template_directory_uri().'/css' );




/*--------------------------------------*/
/* Include required framework files
/*--------------------------------------*/

require_once('library/post_types.php');
require_once('library/taxonomies.php');
require_once('framework/prth_framework.php');
require_once('library/admin_options.php');

if(is_admin() && basename($_SERVER['PHP_SELF']) != 'update-core.php'){
require('update-notifier.php');
}

//load css and js
require_once('library/scripts.php');
require_once('library/custom_css.php');

//load widgets
require_once('library/widget_areas.php');

//load only on admin
if(defined('WP_ADMIN') && WP_ADMIN ) {
	
	//main functions
	require_once('library/custom_post_menus.php');
	require_once('library/custom_sidebar_menus.php');	
	
}








/*--------------------------------------*/
/* Menu Setup
/*--------------------------------------*/

//menu walker
require_once('library/menu_walker.php');

//register navigation menus
register_nav_menus(
	array(
		'top_menu' => __('Top','prth'),
		'main_menu' => __('Main','prth'),
		'footer_menu' => __('Footer','prth'),
		'sub_menu' => __('Subscriber','prth')
	)
);
		
		


/*--------------------------------------*/
/* Misc Functions
/*--------------------------------------*/

//content width
$content_width = 1200; // Default width of primary content area
		
//add image sizes
if(function_exists('add_image_size')) {
	add_image_size('full-size',  9999, 9999, false);
	add_image_size('small-thumb',  90, 90, true);
}
		
//localization support - this is for changing the language
load_theme_textdomain( 'prth', get_template_directory() .'/lang' );

//posts per page
require_once('library/pagination.php');

//for theme checks
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'custom-header' );
add_editor_style();
posts_nav_link();

 		
		


/*--------------------------------------*/
/* Check Image Function - This comes in handy!
/*--------------------------------------*/

function has_image_attachment($post_id) {
	$args = array(
    	'post_type' => 'attachment',
    	'post_mime_type' => '',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => $post_id
    ); 

    $attachments = get_posts($args);
	
    if(is_array($attachments) && count($attachments) > 0) {
       	//Has image attachments
    	    return true;
    			} else {
	    	return false;
    }
			
}






/*--------------------------------------*/
/* Blog/Excerpt Functions
/*--------------------------------------*/

//post excerpt length
function new_excerpt_length($length) {
	global $itdata;
	return $itdata['blog_excerpt'];
}
add_filter('excerpt_length', 'new_excerpt_length');

//replace excerpt link
function new_excerpt_more($more) {
	global $post;
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');







/*--------------------------------------*/
/* Add Log For Debug Function
/*--------------------------------------*/

if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}





/*--------------------------------------*/
/* Theme Specific Functions
/*--------------------------------------*/

  


/* Insert Attachment to post */

function insert_attachment($file_handler,$post_id,$setthumb='false') {
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();

	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id = media_handle_upload( $file_handler, $post_id );

	if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
	return $attach_id;

}




/* Find out User Role */

function get_user_role() {
    global $current_user;

    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);

    return $user_role;
}

/* MODIFICATIONS TO THE USER FIELDS */
add_action( 'show_user_profile', 'add_help_desk_category' );
add_action( 'edit_user_profile', 'add_help_desk_category' );

function add_help_desk_category( $user ) { ?>

	<h3>Help Desk Category</h3>

	<table class="form-table">

		<tr>
			<th><label for="hd_category">Category</label></th>

			<td>
				<input type="text" name="hd_category" id="hd_category" value="<?php echo esc_attr( get_the_author_meta( 'hd_category', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">ID of the category.</span>
			</td>
		</tr>

	</table>
<?php }


add_action( 'personal_options_update', 'save_help_desk_category' );
add_action( 'edit_user_profile_update', 'save_help_desk_category' );

function save_help_desk_category( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'hd_category', $_POST['hd_category'] );
}



/* MODIFICATIONS TO THE REGISTRATION FORM */
// output the form field
add_action('register_form', 'ad_register_fields');
function ad_register_fields() {
?>
    <p>
        <label for="firstname">First Name<br/>
        <input type="text" style="width:300px;" name="firstname" id="firstname" class="input" value="<?php if (isset($_POST['firstname'])) { echo esc_attr($_POST['firstname']); } ?>" size="25" />
        </label>
    </p>
    <p>
        <label for="lastname">Last Name<br/>
        <input type="text" style="width:300px;" name="lastname" id="lastname" class="input" value="<?php if (isset($_POST['lastname'])) { echo esc_attr($_POST['lastname']); } ?>" size="25" />
        </label>
    </p>
<?php
}

// save new first name
add_filter('pre_user_first_name', 'ad_user_firstname');
function ad_user_firstname($firstname) {
    if (isset($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    }
    return $firstname;
}

// save new first name
add_filter('pre_user_last_name', 'ad_user_lastname');
function ad_user_lastname($lastname) {
    if (isset($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
    }
    return $lastname;
}



/* Disable the admin bar from showing */

if (!function_exists('disableAdminBar')) {  
    function disableAdminBar(){  
    remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 ); // for the admin page  
    remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); // for the front end  
    function remove_admin_bar_style_backend() {  // css override for the admin page  
      echo '<style>body.admin-bar #wpcontent, body.admin-bar #adminmenu { padding-top: 0px !important; }</style>';  
    }  
    add_filter('admin_head','remove_admin_bar_style_backend');  
    function remove_admin_bar_style_frontend() { // css override for the frontend  
      echo '<style type="text/css" media="screen"> 
      html { margin-top: 0px !important; } 
      * html body { margin-top: 0px !important; } 
      </style>';  
    }  
    add_filter('wp_head','remove_admin_bar_style_frontend', 99);  
  }  
}  
// add_filter('admin_head','remove_admin_bar_style_backend'); // Original version  
add_action('init','disableAdminBar'); // New version 




/* RESTRICT ADMIN AREA BY USER ROLE */

function wpse_11244_restrict_admin() {
    if ( ! current_user_can( 'manage_options' )  && $_SERVER['PHP_SELF'] != '/wp-admin/admin-ajax.php' ) {
        wp_redirect( home_url() );
    }
}
add_action( 'admin_init', 'wpse_11244_restrict_admin', 1 );



/* CUSTOM EXCERPT AMOUNT */
function prth_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'prth_excerpt_length' );



add_filter('user_can_richedit', '__return_true');









?>