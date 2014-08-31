<?php
/**
 * IcarusThemes
 * Template Name: Blog
 */

//get global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//loop
if (have_posts()) : while (have_posts()) : the_post();

//posts per page
$template_posts_per_page = get_post_meta($post->ID, 'prth_template_posts_per_page', true);

//get meta to set parent category
$blog_filter_parent = '';
$blog_parent = get_post_meta($post->ID, 'prth_blog_parent', true);
if($blog_parent != 'select_category_parent') { $blog_filter_parent = $blog_parent; } else { $blog_filter_parent = NULL; }	
?>

<header id="page-heading">
	<h1><?php the_title(); ?></h1>
</header><!-- /page-heading -->

<div id="post" class="blog-template clearfix">
	<?php
	//tax query
	if($blog_filter_parent) {
		$tax_query = array(
			array(
				  'taxonomy' => 'category',
				  'field' => 'id',
				  'terms' => $blog_filter_parent,
				  )
			);
	} else { $tax_query = NULL; }
	
    //query posts
        query_posts(
            array(
				'post_type'=> 'post',
				'posts_per_page' => $template_posts_per_page,
				'paged'=>$paged,
				'tax_query' => $tax_query
       		)
		);

	//loop
    if (have_posts()) :
		//get entry template
		get_template_part( 'includes/loop', 'entry');            	
    endif;
	
	//show pagination
	pagination();
	
	//reset query
	wp_reset_query(); ?>

</div><!-- /post -->

<?php endwhile; endif; ?>
<?php //get_sidebar(); ?>
<div id="sidebar">


	<div class="sidebar-box widget_search clearfix">
		<div class="well">
			<div class="well-title">
			
			<?php
			
				if ( ( is_single() || is_front_page() || is_page() ) && !is_page('login') && !is_user_logged_in()){  ?>
				      
				    <p>You are not logged in &middot; <a href="<?php echo $loginpage ?>">Log In</a></p>
				      
				<?php } else { ?>

			
					<h2><?php echo $current_user_displayname; ?></h2>
					<p><?php echo $current_user_email; ?><br/><a href="<?php echo wp_logout_url( home_url() ); ?>">Log Out</a></p>					
					

				<?php } ?>
				
			</div>
			
			<div class="well-pic">
				
				<?php echo $avatar; ?>
				
			</div>
			
			
		</div>
	</div>


	<?php dynamic_sidebar('sidebar'); ?>


</div>
<?php get_footer(); ?>