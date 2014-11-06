<?php

global $avia_config;



/**
 * Custom Post Type "Iniciativas"
 */

add_action( 'init', 'create_post_type_iniciativas' );
function create_post_type_iniciativas() {
    register_post_type( 'iniciativa',
        array(
            'labels' => array(
                'name' => __( 'Iniciativas' ),
                'singular_name' => __( 'Iniciativa' ),
                'singular_label' => __( 'Iniciativa' ),		
                'all_items' => __('Iniciativas'),
                'add_new_item' => __('Añadir una iniciativa nueva'),
                'edit_item' => __('Editar iniciativa'),
		'search_items'       => __( 'Buscar Iniciativas' ),
		'not_found'          => __( 'No iniciativas encontradas' ),
		'not_found_in_trash' => __( 'No iniciativas encontradas en basura' ),
		'menu_name'          => 'Iniciativas'
            ),
        'public' => true,
        'has_archive' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'query_var' => true,
        'menu_position' => 5,
        'menu_icon' => get_stylesheet_directory_uri() . '/images/iniciativa_icon.png',
        'rewrite' => array('slug' => 'iniciativas'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments' )	
        )
    );
    
}

function my_taxonomies_iniciativa() {
  $labels = array(
    'name'              => _x( 'Iniciativa Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Iniciativa Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Iniciativa Categories' ),
    'all_items'         => __( 'All Iniciativa Categories' ),
    'parent_item'       => __( 'Parent Iniciativa Category' ),
    'parent_item_colon' => __( 'Parent Iniciativa Category:' ),
    'edit_item'         => __( 'Edit Iniciativa Category' ), 
    'update_item'       => __( 'Update Iniciativa Category' ),
    'add_new_item'      => __( 'Add New Iniciativa Category' ),
    'new_item_name'     => __( 'New Iniciativa Category' ),
    'menu_name'         => __( 'Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'iniciativa_category', 'iniciativa', $args );
}
add_action( 'init', 'my_taxonomies_iniciativa', 0 );

