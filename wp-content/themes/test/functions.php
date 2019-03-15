<?php

include_once (__DIR__ . '/inc/test-recent-posts.php');

add_action('wp_head', function () {
    echo 'Добавить что то в HEADER';
    $vars = array(
        'ajax_url' => admin_url('admin-ajax.php')
    );

    echo "<script>window.wp = " . json_encode($vars) . "</script>";
});

add_action('wp_ajax_flatapp', 'ajax');
add_action('wp_ajax_nopriv', 'ajax');

function ajax() {
    echo 1;
    wp_die();
}

add_action('wp_enqueue_scripts', function () { // регистрация скриптов и стилей
    wp_enqueue_style('test-main-css', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('test-own-min-css', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
    wp_enqueue_style('test-own-def-css', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css');

    wp_enqueue_script('test-script-jquery', get_template_directory_uri() . '/assets/js/jquery-3.2.0.min.js');
    wp_enqueue_script('test-main-js', get_template_directory_uri() . '/assets/js/script.js', ['test-script-jquery']);
    wp_enqueue_script('test-script-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js');

});

/*function test_media() {
    wp_enqueue_style('test-main', get_stylesheet_uri());
}*/

add_action('after_setup_theme', function () { // регистрация меню
    register_nav_menu('top', 'Для шапки');
    register_nav_menu('footer', 'Для подвала');

    add_theme_support( 'post-thumbnails' );  // миниатюры к постам
    add_theme_support( 'title-tag' );  // авто тайтл страниц

    add_theme_support('post-formats', array('aside', 'quote'));

    add_image_size('flats-thumb', 400, 300, true);
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

    register_widget('Test_Recent_Posts');
});
add_filter('widget_text', 'do_shortcode'); // выполнение шорткода в сайтбаре


add_shortcode('test_short', function () {
        return 'Выполнился шорт код';
});


add_shortcode('test_recent', function ($attr) {
    $attr = shortcode_atts( array(
        'count' => 5
    ), $attr);
    $str = '';

    $args = array(
        'numberposts' => $attr['count'],
        'orderby'     => 'date',
        'order'       => 'DESC',
        'post_type'   => 'post',
    );
    $posts = get_posts($args);
    global $post;

    foreach($posts as $post ){
        setup_postdata($post);
        $str .= '<div>' . get_the_title() . '</div>';
    }
    wp_reset_postdata();
    return $str;
});

add_action('init', function (){
    register_post_type('reviews', [
        'labels' => [
            'name'               => 'Отзывы', // основное название для типа записи
            'singular_name'      => 'Отзыв', // название для одной записи этого типа
            'add_new'            => 'Добавить новый', // для добавления новой записи
            'add_new_item'       => 'Добавление отзыва', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование отзыва', // для редактирования типа записи
            'new_item'           => 'Новый отзыв', // текст новой записи
            'view_item'          => 'Смотреть отзыв', // для просмотра записи этого типа.
            'search_items'       => 'Искать отзывы', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Отзывы', // название меню
        ],
        'public'              => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-format-quote',
        'hierarchical'        => false,
        'supports'            => array('title', 'editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    ]);
    register_post_type('flats', [
        'labels' => array(
            'name'               => 'Квартиры', // основное название для типа записи
            'singular_name'      => 'Квартира', // название для одной записи этого типа
            'add_new'            => 'Добавить новую', // для добавления новой записи
            'add_new_item'       => 'Добавление квартиры', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование квартиры', // для редактирования типа записи
            'new_item'           => 'Новая квартира', // текст новой записи
            'view_item'          => 'Смотреть квартиру', // для просмотра записи этого типа.
            'search_items'       => 'Искать квартиры', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Квартиры', // название меню
        ),
        'public'              => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-category',
        'hierarchical'        => false,
        'supports'            => array('title', 'editor', 'thumbnail'),
        'has_archive'         => true
    ]);

    register_taxonomy('city', array('flats'), array(
        'labels'                => array(
            'name'              => 'Города',
            'singular_name'     => 'Город',
            'search_items'      => 'Найти город',
            'all_items'         => 'Все города',
            'view_item '        => 'Посмотреть город',
            'edit_item'         => 'Редактировать город',
            'update_item'       => 'Обновить город',
            'add_new_item'      => 'Добавить новый город',
            'new_item_name'     => 'Добавить новый',
            'menu_name'         => 'Города',
        ),
        'description'           => '', // описание таксономии
        'public'                => true,
        'hierarchical'          => false
    ));

    register_taxonomy('rooms', array('flats'), array(
        'labels'                => array(
            'name'              => 'Количество комнат',
            'singular_name'     => 'Количество комнат',
            'search_items'      => 'Количество комнат',
            'all_items'         => 'Все варианты',
            'view_item '        => 'Посмотреть к',
            'edit_item'         => 'Редактировать к',
            'update_item'       => 'Обновить к',
            'add_new_item'      => 'Добавить новый к',
            'new_item_name'     => 'Добавить новый',
            'menu_name'         => 'Количество комнат'
        ),
        'description'           => '', // описание таксономии
        'public'                => true,
        'hierarchical'          => false
    ));

    function test_show_reviews(){
        $args = [
            'orderby'   => 'date',
            'order'     => 'DESC',
            'post_type' => 'reviews'
        ];

        return get_posts($args);
    }
});