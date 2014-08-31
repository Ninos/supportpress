<?php
/**
* Press Themes
 */

//get global variables
global $itdata;

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );



//translations
$leave_reply = $itdata['translation_leave_reply_text'] ? $itdata['translation_leave_reply_text'] : __('Leave a reply','prth');
$name = $itdata['translation_comments_name_text'] ? $itdata['translation_comments_name_text'] : __('Name','prth');
$email = $itdata['translation_comments_email_text'] ? $itdata['translation_comments_email_text'] : __('Email','prth');
$website = $itdata['translation_comments_website_text'] ? $itdata['translation_comments_website_text'] : __('Website','prth');
$comments_navigation = $itdata['translation_comments_menu_text'] ? $itdata['translation_comments_menu_text'] : __('Comment Navigation','prth');
$comments_older = $itdata['translation_comments_older_text'] ? $itdata['translation_comments_older_text'] : __('Older Comments','prth');
$comments_newer = $itdata['translation_comments_newer_text'] ? $itdata['translation_comments_newer_text'] : __('Newer Comments','prth');
$post_comment = $itdata['translation_post_comment_text'] ? $itdata['translation_post_comment_text'] : __('Submit Comment','prth');
$translation_comment_log_in_text = $itdata['translation_comment_log_in_text'] ? $itdata['translation_comment_log_in_text'] : __('Log In To Comment','prth');
?>
<div id="commentsbox">
	<div id="comments" class="comments-area clearfix">
    
        <?php if (post_password_required() ) : ?>
		</div><!-- /comments -->
		</div><!-- /commentsbox -->
        <?php return; endif; ?>
    
        <?php // You can start editing here -- including this comment! ?>
    
        <?php if ( have_comments() ) : ?>
            <h3 class="heading-border heading"><span><?php prth_translation('comments'); ?></span></h3>
    
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php echo $comments_navigation; ?></h1>
                <div class="nav-previous"><?php previous_comments_link( '&larr;'. $comments_older ); ?></div>
                <div class="nav-next"><?php next_comments_link($comments_newer .'&rarr;'); ?></div>
            </nav><!-- /coment-nav-above -->
            <?php endif; ?>
    
            <ol class="commentlist">
                <?php wp_list_comments( array( 'callback' => 'enhanced_comments' ) ); ?>
            </ol><!-- /commentlist -->
    
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
                <h1 class="assistive-text"><?php echo $comments_navigation; ?></h1>
                <div class="nav-previous"><?php previous_comments_link( '&larr;'. $comments_older ); ?></div>
                <div class="nav-next"><?php next_comments_link($comments_newer .'&rarr;'); ?></div>
            </nav><!-- /coment-nav-below -->
            <?php endif; ?>
    
        <?php endif; ?>
    
        <?php if (!comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
            <?php /* <p class="nocomments"><?php _e( 'Comments are closed.', 'prth' ); ?></p> */ ?>
        <?php endif; ?>
    
    	<?php
		//custom fields callback
		$fields =  array(
			'author' => '<p class="comment-form-author">' . '<label for="author">'. $name .' ' . ( $req ? '<span class="required">*</span></label>' : '' ) .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
			'email' => '<p class="comment-form-email"><label for="email">'. $email .' ' . ( $req ? '<span class="required">*</span></label>' : '' ) .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
			'url' => '<p class="comment-form-url"><label for="url">'. $website .'</label>' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);

		//custom comment form output
        $comments_args = array(
			'fields' => $fields,
			'title_reply'=>'<h4 class="heading"><span>'. $leave_reply .'</span></h4>',
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" rows="10" placeholder="'.$itdata['comment_notice'].'"></textarea></p>',
			'must_log_in' => '<p class="must-log-in"><a href="' . wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">'. $translation_comment_log_in_text .'</a></p>',
			'logged_in_as' => '',
			'comment_form_top' => '',
			'comment_notes_after' => '',
			'comment_notes_before' => '',
			'label_submit' => $post_comment
		);
		
		//show comment form
		comment_form($comments_args); ?>
    
    </div><!-- /comments -->
</div><!-- /commentsbox -->