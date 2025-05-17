<?php
//テーマサポート
register_nav_menus();
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('align-wide');

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
    wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.6.1/css/all.css', array(), '5.6.1');
    wp_enqueue_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '4.5.0');
    wp_enqueue_style('wpbeg', get_template_directory_uri() . '/css/wpbeg.css', array(), '1.0.0');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'wpbeg_script');

function wpbeg_theme_setup()
{
    load_theme_textdomain('wpbeg', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'wpbeg_theme_setup');

function wpbeg_widgets_init()
{
    register_sidebar(
        array(
            'name'          => 'カテゴリーウィジェット',
            'id'            => 'category_widget',
            'description'   => 'カテゴリー用ウィジェットです',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2><i class="fa fa-folder-open" aria-hidden="true"></i>',
            'after_title'   => "</h2>\n",
        )
    );
}
add_action('widgets_init', 'wpbeg_widgets_init');


register_sidebar(
    array(
        'name'          => 'タグウィジェット',
        'id'            => 'tag_widget',
        'description'   => 'タグ用ウィジェットです',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2><i class="fa fa-tags" aria-hidden="true"></i>',
        'after_title'   => "</h2>\n",
    )
);
register_sidebar(
    array(
        'name'          => 'アーカイブウィジェット',
        'id'            => 'archive_widget',
        'description'   => 'アーカイブ用ウィジェットです',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2><i class="fa fa-archive" aria-hidden="true"></i>',
        'after_title'   => "</h2>\n",
    )
);
function wpbeg_theme_add_editor_styles()
{
    add_editor_style(get_template_directory_uri() . "/css/editor-style.css");
}
add_action('admin_init', 'wpbeg_theme_add_editor_styles');
add_theme_support('automatic-feed-links');

// ブロックスタイルを登録する関数
function mytheme_register_block_styles()
{
    // 段落ブロック用のカスタムスタイルを登録
    register_block_style(
        'core/paragraph', // 対象のブロック名
        array(
            'name'  => 'my-custom-style', // カスタムスタイルの名前
            'label' => __('My Custom Style', 'wpbeg'), // カスタムスタイルのラベル
        )
    );
}
// アクションフックに関数をフック
add_action('init', 'mytheme_register_block_styles');

// カスタムブロックパターンを登録する関数
function mytheme_register_block_patterns()
{
    // ブロックパターンを定義
    $patterns = [
        [
            'name'        => 'mytheme/custom-pattern', // パターン名
            'title'       => __('Custom Pattern', 'wpbeg'), // 表示名
            'description' => __('A custom pattern for your theme.', 'wpbeg'), // 説明
            'content'     => '<!-- wp:paragraph --><p>' . __('Hello, World!', 'wpbeg') . '</p><!-- /wp:paragraph -->', // ブロックの内容
        ],
    ];

    // 各パターンを登録
    foreach ($patterns as $pattern) {
        register_block_pattern($pattern['name'], $pattern);
    }
}

// アクションフックに関数をフック
add_action('init', 'mytheme_register_block_patterns');

function mytheme_setup()
{
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('custom-header', array(
        'default-image' => '',
        'width'         => 1000,
        'height'        => 250,
        'flex-width'    => true,
        'flex-height'   => true,
    ));
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ));
}
add_action('after_setup_theme', 'mytheme_setup');
add_theme_support('site-icon');

function wpbeg_enqueue_comment_reply()
{
    // 単一投稿・固定ページでコメントが開いている場合のみ読み込む
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wpbeg_enqueue_comment_reply');
