<?php
// get global variables
global $itdata;

//homepage grid style
$home_grid_class = '';
if (isset($itdata['homepage_widgets_layout'])) $home_grid_style = $itdata['homepage_widgets_layout'];
if (isset($home_grid_style)) $home_grid_class = prth_grid($home_grid_style);

//homepage sidebar
register_sidebar(array(
	'name' => __( 'Home','prth'),
	'id' => 'homepage_sidebar',
	'description' => __( 'Homepage Sidebar Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//homepage
register_sidebar(array(
	'name' => __( 'Home Widget Area','prth'),
	'id' => 'homepage',
	'description' => __( 'Homepage Widget Area','prth' ),
	'before_widget' => '<div class="home-widget '.$home_grid_class.' %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));


//pages
register_sidebar(array(
	'name' => __( 'Pages','prth'),
	'id' => 'pages',
	'description' => __( 'Pages Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//blog
register_sidebar(array(
	'name' => __( 'Blog/Archives','prth'),
	'id' => 'sidebar',
	'description' => __( 'Blog Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//KnowledgeBase
register_sidebar(array(
	'name' => __( 'KnowledgeBase','prth'),
	'id' => 'kb',
	'description' => __( 'KnowledgeBase Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//faqs
register_sidebar(array(
	'name' => __( 'FAQs','prth'),
	'id' => 'faqs',
	'description' => __( 'FAQ Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//footer 1
register_sidebar(array(
	'name' => __( 'Footer 1','prth'),
	'id' => 'footer-one',
	'description' => __( 'Footer 1 Widget Area','prth' ),
	'before_widget' => '<div class="footer-widget %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));


//footer 2
register_sidebar(array(
	'name' => __( 'Footer 2','prth'),
	'id' => 'footer-two',
	'description' => __( 'Footer 2 Widget Area','prth' ),
	'before_widget' => '<div class="footer-widget %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>'
));


//footer 3
register_sidebar(array(
	'name' => __( 'Footer 3','prth'),
	'id' => 'footer-three',
	'description' => __( 'Footer 3 Widget Area','prth' ),
	'before_widget' => '<div class="footer-widget %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));


//footer 4
register_sidebar(array(
	'name' => __( 'Footer 4','prth'),
	'id' => 'footer-four',
	'description' => __( 'Footer 4 Widget Area','prth' ),
	'before_widget' => '<div class="footer-widget %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4>',
	'after_title' => '</h4>',
));


//chat
register_sidebar(array(
	'name' => __( 'Chat','prth'),
	'id' => 'chat',
	'description' => __( 'Chat Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//bbpress - Forum
register_sidebar(array(
	'name' => __( 'BBPress Forum Index','prth'),
	'id' => 'bbpress-index',
	'description' => __( 'bbPress Forum Index Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//bbpress - Forum
register_sidebar(array(
	'name' => __( 'BBPress Forum','prth'),
	'id' => 'bbpress-forum',
	'description' => __( 'bbPress Forum Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//bbpress - Topic
register_sidebar(array(
	'name' => __( 'BBPress Topic','prth'),
	'id' => 'bbpress-topic',
	'description' => __( 'bbPress Topic Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

//bbpress - Reply
register_sidebar(array(
	'name' => __( 'BBPress Reply','prth'),
	'id' => 'bbpress-reply',
	'description' => __( 'bbPress Reply Widget Area','prth' ),
	'before_widget' => '<div class="sidebar-box %2$s clearfix">',
	'after_widget' => '</div>',
	'before_title' => '<h4 class="heading"><span>',
	'after_title' => '</span></h4>',
));

?>