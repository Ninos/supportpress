<?php
/**
 * IcarusThemes
 */

//get global variables
global $itdata, $post;

//footer style
$footer_grid_style = $itdata['footer_layout'];
$footer_grid_class = prth_grid($footer_grid_style);

$user_role = get_user_role();
$admin_options_link = $itdata['admin_options_link'];


//footer header options
if (isset($itdata['footer_footer_header_text'])) $footer_footer_header_text = $itdata['footer_footer_header_text'];
?>
<div class="clear"></div>

<?php
if(!is_404()) {
	//footer-header meta
	$show_hide_footer_header = '';
	if(is_single() || is_page()) { $show_hide_footer_header = get_post_meta($post->ID, 'prth_show_hide_footer_header', TRUE); }

	if (isset($footer_footer_header_text)) {
		if($show_hide_footer_header !='disable') { 
		?>
		<div id="footer-header" class="clearfix">
			<div id="footer-header-text"><?php echo $footer_footer_header_text; ?></div><!-- /footer-header-text -->
		</div><!-- /footer-footer-header -->
<?php
		} 
	} 
} 
?>

</div><!-- /content-main -->
    <footer id="footer">
    	<?php if($itdata['disable_widgetized_footer'] !='disable') { ?>
        <div id="footer-widgets" class="grid-container clearfix">
            <div class="footer-box <?php echo $footer_grid_class; ?>">
            	<?php dynamic_sidebar('footer-one'); ?>
            </div>
            <!-- /footer-left -->
            <div class="footer-box <?php echo $footer_grid_class; ?>">
            	<?php dynamic_sidebar('footer-two'); ?>
            </div>
            <!-- /footer-middle -->
            <div class="footer-box <?php echo $footer_grid_class; ?>">
            	<?php dynamic_sidebar('footer-three'); ?>
            </div>
            <!-- /footer-right -->
			<div class="footer-box <?php echo $footer_grid_class; ?>">
            	<?php dynamic_sidebar('footer-four'); ?>
            </div>
            <!-- /footer-right -->
        </div>
        <!-- /footer-widgets -->
        <?php } ?>
    </footer>
    <!-- /footer -->
    <div id="footer-bottom">
    	<div class="grid-container clearfix">
            <div id="footer-menu" class="grid-2 no-btm-margin">
                <?php wp_nav_menu( array(
                    'theme_location' => 'footer_menu',
                    'sort_column' => 'menu_order',
                    'fallback_cb' => ''
                )); ?>
                <?php if ($user_role == "administrator") {	 
                	if (isset($admin_options_link)) { ?>
                <li><a href="<?php echo $admin_options_link; ?>">Admin Options</a></li>
                <?php } } ?>
            </div><!-- /footer-menu -->
            <div id="copyright" class="grid-2 no-btm-margin">
                <?php if(!empty($itdata['custom_copyright'])) { echo $itdata['custom_copyright']; } else { ?>
                &copy; <?php _e('Copyright', 'prth'); ?> <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a>
                <?php } ?>
            </div><!-- /copyright notice -->
    	</div><!-- /grid-container -->
    </div><!-- /footer-bottom --> 
</div><!-- /wrap -->
    
<?php 
//show analytics - tracking code - footer 
echo stripslashes($itdata['analytics_footer']); 
?>
<?php 
//get footer
wp_footer(); ?>
</body>
</html>