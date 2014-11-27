<?php

global $avia_config;


add_theme_support( 'post-thumbnails' );

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

/**
 * Custom Post Type "representante"
 */
function create_post_type_representantes() {
    register_post_type( 'representante',
        array(
            'labels' => array(
                'name' => __( 'Representantes' ),
                'singular_name' => __( 'Representante' ),
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
			'menu_position' => 6,
			'menu_icon' => get_stylesheet_directory_uri() . '/images/iniciativa_icon.png',
			'rewrite' => array('slug' => 'representantes'),
			'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'post-formats', 'page-attributes' )	
        )
    );
    
}
add_action( 'init', 'create_post_type_representantes' );


/*Custom type post xmlrpc  API*/
function redirect_xmlrpc_to_custom_post_type ($data, $postarr) {
	$p2_custom_post_type = "representante"; //iniciativa|representante
    
    if (defined('XMLRPC_REQUEST') || defined('APP_REQUEST')) {
        $data['post_type'] = $p2_custom_post_type;
        return $data;
    }
    return $data;
}

add_filter('wp_insert_post_data', 'redirect_xmlrpc_to_custom_post_type', 99, 2);

/*Get representatives by commission*/
function getRepresentativesByCommission($commission) {
	$args = array('post_type' => 'representante',
		'meta_query' => array(
			array (
				'key'     => 'wp_commissions_slug',
				'value'   => $commission,
				'compare' => 'LIKE' 
			)
		)
	);

	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	return array("loop" => $loop, "count" => $count);
}

/*Get representatives by state (clave_estado)[int]*/
function getRepresentativesByState($state) {
	$args = array('post_type' => 'representante',
		'meta_query' => array(
			array (
				'key'     => 'wp_clave_estado',
				'value'   => $state
			)
		)
	);

	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	return array("loop" => $loop, "count" => $count);
}

/*Get representatives by political party*/
function getRepresentativesByPoliticalParty($idPoliticalParty) {
	$args = array('post_type' => 'representante',
		'meta_query' => array(
			array (
				'key'     => 'wp_id_political_party',
				'value'   => $idPoliticalParty
			)
		)
	);

	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	return array("loop" => $loop, "count" => $count);
}

/*Get initiatives by representative (wp_slug) */
function getInitativesByRepresentative($slug) {
	$args = array('post_type' => 'iniciativa',
		'meta_query' => array(
			array (
				'key'     => 'wp_presentada_slug',
				'value'   => $slug,
				'compare' => 'LIKE'
			)
		)
	);

	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	return array("loop" => $loop, "count" => $count);
}

/*Get political party array*/
function getPoliticalParty($idPoliticalParty) {
	if($idPoliticalParty == 1) {
		$array["name"]       = "Partido Revolucionario Institucional";
		$array["short_name"] = "PRI";
		$array["url_logo"]   = "18px-PRI.png";
	} elseif($idPoliticalParty == 2) {
		$array["name"]       = "Partido de la Revolución Democrática";
		$array["short_name"] = "PRD";
		$array["url_logo"]   = "18px-PRD.png";
	} elseif($idPoliticalParty == 3) {
		$array["name"]       = "Partido Verde Ecologista de México";
		$array["short_name"] = "PVEM";
		$array["url_logo"]   = "18px-PVE.png";
	} elseif($idPoliticalParty == 4) {
		$array["name"]       = "Partido Acción Nacional";
		$array["short_name"] = "PAN";
		$array["url_logo"]   = "18px-PAN.png";
	} elseif($idPoliticalParty == 5) {
		$array["name"]       = "Partido del Trabajo";
		$array["short_name"] = "PT";
		$array["url_logo"]   = "18px-PT.png";
	} elseif($idPoliticalParty == 6) {
		$array["name"]       = "Movimiento Ciudadano";
		$array["short_name"] = "Movimiento Ciudadano";
		$array["url_logo"]   = "18px-PMC.png";
	} elseif($idPoliticalParty == 7) {
		$array["name"]       = "Partido Nueva Alianza";
		$array["short_name"] = "PRD";
		$array["url_logo"]   = "18px-PNA.png";
	} else {
		$array["name"]       = "Sin partido";
		$array["short_name"] = "SP";
		$array["url_logo"]   = "18px-SP.png";
	}
	
	return $array;
}
