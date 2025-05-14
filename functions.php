<?php
//テーマサポート
add_theme_support('menus');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');

//タイトル出力
function wpbeg_title($title)
{
    if (is_front_page() && is_home()) { //トップページなら
        $title = get_bloginfo('name', 'display');
    } elseif (is_singular()) { //シングルページなら
        $title = single_post_title('', false);
    }
    return $title;
}
add_filter('pre_get_document_title', 'wpbeg_title');

function wpbeg_script()
{
    wp_enqueue_style('mplus1p', '//fonts.googleapis.com/earlyaccess/mplus1p.css', array());
    wp_enqueue_style('Sacramento', '//fonts.googleapis.com/css?family=Sacramento&amp;amp;subset=latin-ext', array());
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '4.5.0');
    wp_enqueue_style('wpbeg', get_template_directory_uri() . '/css/wpbeg.css', array(), '1.0.0');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'wpbeg_script');
