<?php
/*
Plugin Name: Mi Plugin Proyectos
Description: Registra el CPT Proyecto con ACF y REST API
Version: 1.0
Author: Fernando 
*/

// 1. REGISTRAR EL CUSTOM POST TYPE "proyecto"
function registrar_cpt_proyecto() {
    register_post_type('proyecto', [
        'labels' => [
            'name'          => 'Proyectos',
            'singular_name' => 'Proyecto',
            'add_new_item'  => 'Añadir nuevo proyecto',
            'edit_item'     => 'Editar proyecto',
        ],
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'supports'     => ['title', 'editor', 'thumbnail'],
        'menu_icon'    => 'dashicons-portfolio',
    ]);
}
add_action('init', 'registrar_cpt_proyecto');


// 2. EXPONER EL CAMPO ACF EN LA REST API
function agregar_acf_a_rest_api() {
    register_rest_field('proyecto', 'descripcion_corta', [
        'get_callback' => function($post) {
            if (function_exists('get_field')) {
                return get_field('descripcion_corta', $post['id']);
            }
            return '';
        },
        'schema' => ['type' => 'string'],
    ]);
}
add_action('rest_api_init', 'agregar_acf_a_rest_api');


// 3. ENDPOINT PERSONALIZADO (Reto opcional)
function registrar_endpoint_proyectos() {
    register_rest_route('mi-plugin/v1', '/titulos-proyectos', [
        'methods'             => 'GET',
        'callback'            => 'obtener_titulos_proyectos',
        'permission_callback' => '__return_true',
    ]);
}
add_action('rest_api_init', 'registrar_endpoint_proyectos');

function obtener_titulos_proyectos() {
    $proyectos = get_posts([
        'post_type'      => 'proyecto',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    ]);

    $titulos = array_map(function($p) {
        return ['id' => $p->ID, 'titulo' => $p->post_title];
    }, $proyectos);

    return rest_ensure_response($titulos);
}
