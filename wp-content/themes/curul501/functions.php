<?php

global $avia_config;



/**
 * Custom Post Type "Iniciativas"
 */
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
  register_taxonomy( 'iniciativa_category', 'post', $args );
}
add_action( 'init', 'my_taxonomies_iniciativa', 0 );


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
			'taxonomies' => array("iniciativa_category"),
			'menu_icon' => get_stylesheet_directory_uri() . '/images/iniciativa_icon.png',
			'rewrite' => array('slug' => 'iniciativas'),
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats', 'page-attributes' )	
        )
    );
    
}
add_action( 'init', 'create_post_type_iniciativas' );

function create_post_type_representantes() {
    register_post_type( 'representante',
        array(
            'labels' => array(
                'name' => __( 'Representantes' ),
                'singular_name' => __( 'Representantes' ),
                'singular_label' => __( 'Representante' ),		
                'all_items' => __('Representantes'),
                'add_new_item' => __('Añadir un Representante'),
                'edit_item' => __('Editar Representante'),
				'search_items'       => __( 'Buscar Representantes' ),
				'not_found'          => __( 'No representantes encontradas' ),
				'not_found_in_trash' => __( 'No representantes encontradas en basura' ),
				'menu_name'          => 'Representantes'
			),
			'public' => true,
			'has_archive' => true,
			'capability_type' => 'post',
			'hierarchical' => true,
			'query_var' => true,
			'menu_position' => 5,
			'menu_icon' => get_stylesheet_directory_uri() . '/images/iniciativa_icon.png',
			'rewrite' => array('slug' => 'representantes'),
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats', 'page-attributes' )	
        )
    );
    
}
add_action( 'init', 'create_post_type_representantes' );


function redirect_xmlrpc_to_custom_post_type ($data, $postarr) {
	$p2_custom_post_type = "iniciativa"; //representante
    
    if (defined('XMLRPC_REQUEST') || defined('APP_REQUEST')) {
        $data['post_type'] = $p2_custom_post_type;
        return $data;
    }
    return $data;
}

add_filter('wp_insert_post_data', 'redirect_xmlrpc_to_custom_post_type', 99, 2);
