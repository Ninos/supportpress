<?php
/*--------------------------------------*/
/*	Custom Login Logo
/*--------------------------------------*/
function prth_custom_login_logo() {
    global $itdata;
    if($itdata['custom_login_logo'] !='') {
        $custom_login_logo_css = '';
        $custom_login_logo_css .= '<style type="text/css">';
        $custom_login_logo_css .= '.login h1 a {';
        $custom_login_logo_css .= 'background-image:url('. $itdata['custom_login_logo'] .') !important;width: auto !important;background-size: auto !important;';
        if($itdata['custom_login_logo_height']) {
            $custom_login_logo_css .= 'height: '.$itdata['custom_login_logo_height'].' !important;';
        }
        $custom_login_logo_css .= '}</style>';

        echo $custom_login_logo_css;
    }
}
add_action('login_head', 'prth_custom_login_logo');
?>