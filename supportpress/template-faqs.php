<?php
/**
 * IcarusThemes
 * Template Name: FAQs
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
$faqs_filter_parent = '';
$faqs_parent = get_post_meta($post->ID, 'prth_faqs_parent', true);
if($faqs_parent != 'select_faqs_cats_parent') { $faqs_filter_parent = $faqs_parent; } else { $faqs_filter_parent = NULL; }
?>

<header id="page-heading">
    <h1><?php the_title(); ?></h1>
</header><!-- END page-heading -->

<div id="post" class="template-faqs-section clearfix">

	<?php
	//show page content if not empty
    $content = $post->post_content;
    if(!empty($content)) { ?>
        <div id="faqs-description">
            <?php the_content(); ?>
        </div><!-- /faqs-description -->
    <?php }?>
    
    <ul class="template-faqs-ul">
		<?php
        //tax query
        if($faqs_filter_parent) {
            $tax_query = array(
                array(
                      'taxonomy' => 'faqs_cats',
                      'field' => 'id',
                      'terms' => $faqs_filter_parent
                      )
                );
        } else { $tax_query = NULL; }
        
        //start main loop
        global $post;
        $args = array(
            'post_type' =>'faqs',
            'numberposts' => '-1',
            'order' => 'DESC',
            'tax_query' => $tax_query
        );
        $faqs = get_posts($args);
        
        //start loop
        foreach($faqs as $post) : setup_postdata($post);
        
        //get meta
        $faqs_icon = get_post_meta($post->ID, 'prth_faqs_icon', TRUE);
        ?>
        <li class="faqs-container-li">       
            <div class="faq-li-div">
                <h2 class="faq-title clearfix"><a href="#"><span class="prth-icon-<?php echo $faqs_icon; ?>"></span><?php the_title(); ?></a></h2>
                <div class="faq-content entry">
                    <?php the_content(); ?>
                </div><!-- /faq -->
            </div><!-- /faq-li-div -->
        </li><!-- /faqs-container-li -->
        <?php endforeach; wp_reset_postdata(); ?>
    </ul><!-- /template-faqs-ul -->
    
</div><!-- /faqs-wrap -->

<?php
//end page loop
endwhile; endif;

//get faqs sidebar
//get_sidebar('faqs');
?>
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


	<?php dynamic_sidebar('faqs'); ?>


</div>
<?php
//get footer
get_footer(); ?>