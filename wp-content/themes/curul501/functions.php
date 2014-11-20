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
                'add_new_item' => __('A�adir una iniciativa nueva'),
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


function redirect_xmlrpc_to_custom_post_type ($data, $postarr) {
	error_log(print_r($data["custom_fields"],true));
	error_log(print_r($postarr["custom_fields"],true));
	
	foreach($data["custom_fields"] as $key => $value) {
		if($data["custom_fields"][$key]["key"] == "wp_post_type") {
			$p2_custom_post_type = $data["custom_fields"][$key]["value"];
			break;
		}
	}
	
    //$p2_custom_post_type = 'iniciativa'; //Change this to the custom post type you are using for your blog
    
    if (defined('XMLRPC_REQUEST') || defined('APP_REQUEST')) {
        $data['post_type'] = $p2_custom_post_type;
        return $data;
    }
    return $data;
}

add_filter('wp_insert_post_data', 'redirect_xmlrpc_to_custom_post_type', 99, 2);
