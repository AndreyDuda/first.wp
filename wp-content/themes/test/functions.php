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
});
