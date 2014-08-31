<?php
/**
 * IcarusThemes
 */

//get global variables
global $itdata;

//get header
get_header();
require_once ( 'includes/body-top.php' );

//loop
if (have_posts()) : while (have_posts()) : the_post(); ?>

<header id="page-heading">
	<h1><?php _e('FAQ', 'prth'); ?>: <?php the_title(); ?></h1>
</header><!-- /post-heading -->

<div id="post" class="clearfix">
    <article id="faqs-entry" class="entry clearfix">
		<?php
		//main page content
        the_content(); ?>
	</article><!-- /entry -->   
	<?php
	//show comments if not disabled
    if($itdata['show_hide_faqs_comments'] !='disable') {
		comments_template();
	}
	?> 
</div><!-- /post -->

<?php
//enn loop
endwhile; endif;

//get sidebar
get_sidebar();

//get footer
get_footer(); ?>