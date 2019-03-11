<?php


add_action('wp_head', function () {
    echo 'Добавить что то в HEADER';
});

add_action('wp_enqueue_scripts', function () { // регистрация скриптов и стилей
    wp_enqueue_style('test-main-css', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('test-main-js', get_template_directory_uri() . '/assets/js/script.js');
});

/*function test_media() {
    wp_enqueue_style('test-main', get_stylesheet_uri());
}*/

add_action('after_setup_theme', function () { // регистрация меню
    register_nav_menu('top', 'Для шапки');
    register_nav_menu('footer', 'Для подвала');

    add_theme_support( 'post-thumbnails' );  // миниатюры к постам
    add_theme_support( 'title-tag' );  // авто тайтл страниц
});

add_action('widgets_init', function () { // регистрация сайт бара
    register_sidebar([
        'name'        => 'Sidebar-Right',
        'id'          => 'sidebar-right',
        'description' => 'Правая колонка',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => "</div>\n"
    ]);

    register_sidebar([
        'name'        => 'Sidebar-Top',
        'id'          => 'sidebar-top',
        'description' => 'область под меню',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => "</div>\n"
    ]);


});
