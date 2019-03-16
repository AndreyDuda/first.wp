<?php

/*
Plugin Name: Заявки на квартиры
*/

register_activation_hook(__FILE__, 'flatsapp_install');
register_deactivation_hook(__FILE__, 'flatsapp_uninstall');
register_uninstall_hook(__FILE__, 'flatsapp_ondelete');

add_action('init', 'flatsapp_data');
add_action('wp_head', 'flatsapp_js_vars');
add_action('admin_menu', 'flatsapp_menu');

add_action('wp_ajax_flatapp', 'flatsapp_ajax');
add_action('wp_ajax_nopriv_flatapp', 'flatsapp_ajax');

function flatsapp_install(){

}

function flatsapp_uninstall(){

}

function flatsapp_ondelete(){

}

function flatsapp_js_vars(){
    $vars = array(
        'ajax_url' => admin_url('admin-ajax.php')
    );

    echo "<script>window.wp = " . json_encode($vars) . "</script>";
}

function flatsapp_ajax(){
    /* проверки */

    $id_flat = (int)$_POST['flat_id'];
    $phone = htmlspecialchars($_POST['phone']);

    $data = [
        'post_type' => 'flatsapp',
        'post_status' => 'publish',
        'post_title' => $phone
    ];

    $id_post = wp_insert_post($data);

    add_post_meta($id_post, 'id_flat', $id_flat);
    add_post_meta($id_post, 'is_new', '1');

    $res = array(
        'success' => true
    );

    echo json_encode($res);

    wp_die();
}

function flatsapp_data(){
    register_post_type('flatsapp', [
        'labels' => array(
            'name'               => 'Заявки на квартиры',
            'menu_name'          => 'Заявки на квартиры',
        ),
        'public'              => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-category',
        'hierarchical'        => false,
        'supports'            => array('title', 'custom-fields')
    ]);
}

function flatsapp_menu(){
    add_menu_page('Заявки', 'Заявки', 8, 'flatsapp', 'flatsapp_list');
}

function flatsapp_list(){
    echo "<h1>Список заявок</h1>";

    $str = '';

    $args = array(
        'orderby'     => 'date',
        'order'       => 'DESC',
        'post_type'   => 'flatsapp'
    );

    $posts = get_posts($args);
    global $post;

    $str .= "<table>";

    foreach($posts as $post){
        setup_postdata($post);

        $title = get_the_title();
        $dt = get_the_date();

        $meta = get_post_custom($post->ID);

        $str .= "<tr>
					<td><em>$dt</em></td>
					<td><strong>$title</strong></td>
					<td><strong>{$meta['id_flat'][0]}</strong></td>
					<td><strong>{$meta['is_new'][0]}</strong></td>
				</tr>";
    }

    $str .= "</table>";

    wp_reset_postdata();

    echo $str;
}