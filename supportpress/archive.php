<?php
/**
 * IcarusThemes
 */
?>
<?php get_header(); 
	require_once ( 'includes/body-top.php' );
?>
<?php if(have_posts()) : ?>

<header id="page-heading">
	<?php $post = $posts[0]; ?>
	<?php if (is_category()) { ?>
	<h1><?php single_cat_title(); ?></h1>
	<?php } elseif( is_tag() ) { ?>
	<h1>Posts Tagged &quot;<?php single_tag_title(); ?>&quot;</h1>
	<?php  } elseif (is_day()) { ?>
	<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
	<?php  } elseif (is_month()) { ?>
	<h1>Archive for <?php the_time('F, Y'); ?></h1>
	<?php  } elseif (is_year()) { ?>
	<h1>Archive for <?php the_time('Y'); ?></h1>
	<?php  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1>Blog Archives</h1>
	<?php } ?>
</header><!-- /page-heading -->

<div id="post" class="post clearfix">   
	<?php get_template_part( 'includes/loop' , 'entry'); ?>                	     
	<?php pagination(); ?>
</div><!-- /post -->

<?php endif; ?>
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