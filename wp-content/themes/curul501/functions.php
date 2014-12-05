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

/*********** Representantes ***************/
/*Get representatives by commission*/
function getRepresentativesByCommission($commission) {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'representante',
		'posts_per_page' => 10,
		'paged' => $paged,
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

/*Get representatives by state*/
function getRepresentativesByState($state) {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'representante',
		'posts_per_page' => 10,
		'paged' => $paged,
		'meta_query' => array(
			array (
				'key'     => 'wp_zone_state',
				'value'   => $state
			)
		)
	);

	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	return array("loop" => $loop, "count" => $count);
}

/*Get representatives by political party*/
function getRepresentativesByPoliticalParty($slug) {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'representante',
		'posts_per_page' => 10,
		'paged' => $paged,
		'meta_query' => array(
			array (
				'key'     => 'wp_political_party_slug',
				'value'   => $slug
			)
		)
	);
	
	
	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	$wp_query = NULL;
	$wp_query = $temp_query;
	
	return array("loop" => $loop, "count" => $count);
}

/*Get representatives*/
function getRepresentatives($json = false) {
	$args  = array('post_type' => 'representante', 'posts_per_page' => 600);
	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	while($loop->have_posts()) {
		$loop->the_post();
		$data[] = array(
			"permalink" => get_permalink($loop->post->ID),
			"avatar_url" => get_post_meta($loop->post->ID, 'avatar_url', true),
			"politicalParty" => array_map('utf8_encode', getPoliticalParty(get_post_meta($loop->post->ID, 'wp_id_political_party', true))),
			"zone_state" => get_post_meta($loop->post->ID, 'wp_zone_state', true),
			"clave_estado" => get_post_meta($loop->post->ID, 'wp_clave_estado', true),
			"district" => get_post_meta($loop->post->ID, 'wp_district_clean', true),
			"circum" => get_post_meta($loop->post->ID, 'wp_circumscription', true),
			"election_type" => get_post_meta($loop->post->ID, 'wp_election_type', true),
			"name" => get_the_title($loop->post->ID)
		);
	}
	
	if($json) {
		echo json_encode($data, JSON_NUMERIC_CHECK);
		exit;
	} else {
		return array("data" => $data, "count" => $count);
	}
}
/*********** Representantes ***************/




/*********** Iniciativas ***************/
/*Get iniciativas by commission*/
function getIniciativasByCommission($commission) {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'iniciativa',
		'posts_per_page' => 10,
		'paged' => $paged,
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

/*Get iniciativas by political party*/
function getIniciativasByPoliticalParty($slug) {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'iniciativa',
		'posts_per_page' => 10,
		'paged' => $paged,
		'meta_query' => array(
			array (
				'key'     => 'wp_presentada_partidos_slug',
				'value'   => $slug
			)
		)
	);
	
	
	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	$wp_query = NULL;
	$wp_query = $temp_query;
	
	return array("loop" => $loop, "count" => $count);
}

/*Get iniciativas by temas party*/
function getIniciativasByTemas($slug) {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'iniciativa',
		'posts_per_page' => 10,
		'paged' => $paged,
		'meta_query' => array(
			array (
				'key'     => 'wp_topics_slug',
				'value'   => $slug
			)
		)
	);
	
	
	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	$wp_query = NULL;
	$wp_query = $temp_query;
	
	return array("loop" => $loop, "count" => $count);
}

/*Get iniciativas by status party*/
function getIniciativasByStatus($slug) {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args  = array(
		'post_type' => 'iniciativa',
		'posts_per_page' => 10,
		'paged' => $paged,
		'meta_query' => array(
			array (
				'key'     => 'wp_status_slug',
				'value'   => $slug
			)
		)
	);
	
	
	$loop  = new WP_Query($args);
	$count = $loop->post_count;
	
	$wp_query = NULL;
	$wp_query = $temp_query;
	
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







/*********** Iniciativas ***************/

/*Get political party array*/
function getPoliticalParty($idPoliticalParty) {
	if($idPoliticalParty == 1) {
		$array["id_political_party"] = 1;
		$array["name"]       = "Partido Revolucionario Institucional";
		$array["short_name"] = "PRI";
		$array["url_logo"]   = "18px-PRI.png";
	} elseif($idPoliticalParty == 2) {
		$array["id_political_party"] = 2;
		$array["name"]       = "Partido de la Revolución Democrática";
		$array["short_name"] = "PRD";
		$array["url_logo"]   = "18px-PRD.png";
	} elseif($idPoliticalParty == 3) {
		$array["id_political_party"] = 3;
		$array["name"]       = "Partido Verde Ecologista de México";
		$array["short_name"] = "PVEM";
		$array["url_logo"]   = "18px-PVE.png";
	} elseif($idPoliticalParty == 4) {
		$array["id_political_party"] = 4;
		$array["name"]       = "Partido Acción Nacional";
		$array["short_name"] = "PAN";
		$array["url_logo"]   = "18px-PAN.png";
	} elseif($idPoliticalParty == 5) {
		$array["id_political_party"] = 5;
		$array["name"]       = "Partido del Trabajo";
		$array["short_name"] = "PT";
		$array["url_logo"]   = "18px-PT.png";
	} elseif($idPoliticalParty == 6) {
		$array["id_political_party"] = 6;
		$array["name"]       = "Movimiento Ciudadano";
		$array["short_name"] = "Movimiento Ciudadano";
		$array["url_logo"]   = "18px-PMC.png";
	} elseif($idPoliticalParty == 7) {
		$array["id_political_party"] = 7;
		$array["name"]       = "Partido Nueva Alianza";
		$array["short_name"] = "PRD";
		$array["url_logo"]   = "18px-PNA.png";
	} else {
		$array["id_political_party"] = 0;
		$array["name"]       = "Sin partido";
		$array["short_name"] = "SP";
		$array["url_logo"]   = "18px-SP.png";
	}
	
	return $array;
}

/*Get political parties array*/
function getPoliticalParties() {
	$politicalParties = array();
	
	$array["id_political_party"] = "1";
	$array["name"]       = "Partido Revolucionario Institucional";
	$array["short_name"] = "PRI";
	$array["slug"]		 = "partido-revolucionario-institucional";
	$array["url_logo"]   = "18px-PRI.png";
	array_push($politicalParties, $array);
	
	$array["id_political_party"] = 2;
	$array["name"]       = "Partido de la Revolución Democrática";
	$array["short_name"] = "PRD";
	$array["slug"]		 = "partido-de-la-revolucion-democratica";
	$array["url_logo"]   = "18px-PRD.png";
	array_push($politicalParties, $array);
	
	$array["id_political_party"] = 3;
	$array["name"]       = "Partido Verde Ecologista de México";
	$array["short_name"] = "PVEM";
	$array["slug"]		 = "partido-verde-ecologista-de-mexico";
	$array["url_logo"]   = "18px-PVE.png";
	array_push($politicalParties, $array);

	$array["id_political_party"] = 4;
	$array["name"]       = "Partido Acción Nacional";
	$array["short_name"] = "PAN";
	$array["slug"]		 = "partido-accion-nacional";
	$array["url_logo"]   = "18px-PAN.png";
	array_push($politicalParties, $array);

	$array["id_political_party"] = 5;
	$array["name"]       = "Partido del Trabajo";
	$array["short_name"] = "PT";
	$array["slug"]		 = "partido-del-trabajo";
	$array["url_logo"]   = "18px-PT.png";
	array_push($politicalParties, $array);

	$array["id_political_party"] = 6;
	$array["name"]       = "Movimiento Ciudadano";
	$array["short_name"] = "Movimiento Ciudadano";
	$array["slug"]		 = "movimiento-ciudadano";
	$array["url_logo"]   = "18px-PMC.png";
	array_push($politicalParties, $array);

	$array["id_political_party"] = 7;
	$array["name"]       = "Partido Nueva Alianza";
	$array["short_name"] = "PRD";
	$array["slug"]		 = "partido-nueva-alianza";
	$array["url_logo"]   = "18px-PNA.png";
	array_push($politicalParties, $array);
	
	return $politicalParties;
}

/*Get states array*/
function getStates() {
	$states = array(
		array("name" => "Aguascalientes", "cve" => "1", "slug" => "slug"),
		array("name" => "Baja California", "cve" => "2", "slug" => "slug"),
		array("name" => "Baja California Sur", "cve" => "3", "slug" => "slug"),
		array("name" => "Campeche", "cve" => "4", "slug" => "slug"),
		array("name" => "Coahuila", "cve" => "5", "slug" => "slug"),
		array("name" => "Colima", "cve" => "6", "slug" => "slug"),
		array("name" => "Chiapas", "cve" => "7", "slug" => "slug"),
		array("name" => "Chihuahua", "cve" => "8", "slug" => "slug"),
		array("name" => "Distrito Federal", "cve" => "9", "slug" => "slug"),
		array("name" => "Durango", "cve" => "10", "slug" => "slug"),
		array("name" => "Guanajuato", "cve" => "11", "slug" => "slug"),
		array("name" => "Guerrero", "cve" => "12", "slug" => "slug"),
		array("name" => "Hidalgo", "cve" => "13", "slug" => "slug"),
		array("name" => "Jalisco", "cve" => "14", "slug" => "slug"),
		array("name" => "México", "cve" => "15", "slug" => "slug"),
		array("name" => "Michoacán", "cve" => "16", "slug" => "slug"),
		array("name" => "Morelos", "cve" => "17", "slug" => "slug"),
		array("name" => "Nayarit", "cve" => "18", "slug" => "slug"),
		array("name" => "Nuevo León", "cve" => "19", "slug" => "slug"),
		array("name" => "Oaxaca", "cve" => "20", "slug" => "slug"),
		array("name" => "Puebla", "cve" => "21", "slug" => "slug"),
		array("name" => "Querétaro", "cve" => "22", "slug" => "slug"),
		array("name" => "Quintana Roo", "cve" => "23", "slug" => "slug"),
		array("name" => "San Luis Potosí", "cve" => "24", "slug" => "slug"),
		array("name" => "Sinaloa", "cve" => "25", "slug" => "slug"),
		array("name" => "Sonora", "cve" => "26", "slug" => "slug"),
		array("name" => "Tabasco", "cve" => "27", "slug" => "slug"),
		array("name" => "Tamaulipas", "cve" => "28", "slug" => "slug"),
		array("name" => "Tlaxcala", "cve" => "29", "slug" => "slug"),
		array("name" => "Veracruz", "cve" => "30", "slug" => "slug"),
		array("name" => "Yucatán", "cve" => "31", "slug" => "slug"),
		array("name" => "Zacatecas", "cve" => "32", "slug" => "slug")
	);
	
	return $states;
}

/*get commisions*/
function getCommissions() {
	return json_decode('[{"id_commission":"1","name":"Mesa de Decanos","slug":"mesa-de-decanos"},{"id_commission":"2","name":"Mesa Directiva","slug":"mesa-directiva"},{"id_commission":"3","name":"Junta de Coordinaci\u00f3n Pol\u00edtica","slug":"junta-de-coordinacion-politica"},{"id_commission":"4","name":"Conferencia para la Direcci\u00f3n y Programaci\u00f3n de los Trabajos Legislativos","slug":"conferencia-para-la-direccion-y-programacion-de-los-trabajos-legislativos"},{"id_commission":"5","name":"Administraci\u00f3n","slug":"administracion"},{"id_commission":"6","name":"Trabajo y Previsi\u00f3n Social","slug":"trabajo-y-prevision-social"},{"id_commission":"7","name":"Agricultura y Sistemas de Riego","slug":"agricultura-y-sistemas-de-riego"},{"id_commission":"8","name":"Agua potable y Saneamiento","slug":"agua-potable-y-saneamiento"},{"id_commission":"9","name":"Asuntos Frontera Norte","slug":"asuntos-frontera-norte"},{"id_commission":"10","name":"Asuntos Frontera Sur-Sureste","slug":"asuntos-frontera-sur-sureste"},{"id_commission":"11","name":"Asuntos Ind\u00edgenas","slug":"asuntos-indigenas"},{"id_commission":"12","name":"Asuntos Migratorios","slug":"asuntos-migratorios"},{"id_commission":"13","name":"Atenci\u00f3n a Grupos Vulnerables","slug":"atencion-a-grupos-vulnerables"},{"id_commission":"14","name":"Cambio Clim\u00e1tico","slug":"cambio-climatico"},{"id_commission":"15","name":"Ciencia y Tecnolog\u00eda","slug":"ciencia-y-tecnologia"},{"id_commission":"16","name":"Competitividad","slug":"competitividad"},{"id_commission":"17","name":"Comunicaciones","slug":"comunicaciones"},{"id_commission":"18","name":"Cultura y Cinematograf\u00eda","slug":"cultura-y-cinematografia"},{"id_commission":"19","name":"Defensa Nacional","slug":"defensa-nacional"},{"id_commission":"20","name":"Deporte","slug":"deporte"},{"id_commission":"21","name":"Derechos de la Ni\u00f1ez","slug":"derechos-de-la-ninez"},{"id_commission":"22","name":"Derechos Humanos","slug":"derechos-humanos"},{"id_commission":"23","name":"Desarrollo Metropolitano","slug":"desarrollo-metropolitano"},{"id_commission":"24","name":"Desarrollo Rural","slug":"desarrollo-rural"},{"id_commission":"25","name":"Desarrollo Social","slug":"desarrollo-social"},{"id_commission":"26","name":"Econom\u00eda","slug":"economia"},{"id_commission":"27","name":"Educaci\u00f3n P\u00fablica y Servicios Educativos","slug":"educacion-publica-y-servicios-educativos"},{"id_commission":"28","name":"Energ\u00eda","slug":"energia"},{"id_commission":"29","name":"Igualdad de G\u00e9nero","slug":"igualdad-de-genero"},{"id_commission":"30","name":"Fomento Cooperativo y Econom\u00eda Social","slug":"fomento-cooperativo-y-economia-social"},{"id_commission":"31","name":"Fortalecimiento al Federalismo","slug":"fortalecimiento-al-federalismo"},{"id_commission":"32","name":"Transparencia y Anticorrupci\u00f3n","slug":"transparencia-y-anticorrupcion"},{"id_commission":"33","name":"Ganader\u00eda","slug":"ganaderia"},{"id_commission":"34","name":"Gobernaci\u00f3n","slug":"gobernacion"},{"id_commission":"35","name":"Hacienda y Cr\u00e9dito P\u00fablico","slug":"hacienda-y-credito-publico"},{"id_commission":"36","name":"Infraestructura","slug":"infraestructura"},{"id_commission":"37","name":"Justicia","slug":"justicia"},{"id_commission":"38","name":"Juventud","slug":"juventud"},{"id_commission":"39","name":"Marina","slug":"marina"},{"id_commission":"40","name":"Medio Ambiente y Recursos Naturales","slug":"medio-ambiente-y-recursos-naturales"},{"id_commission":"41","name":"Desarrollo Urbano y Ordenamiento Territorial","slug":"desarrollo-urbano-y-ordenamiento-territorial"},{"id_commission":"42","name":"Pesca","slug":"pesca"},{"id_commission":"43","name":"Poblaci\u00f3n","slug":"poblacion"},{"id_commission":"44","name":"Presupuesto y Cuenta P\u00fablica","slug":"presupuesto-y-cuenta-publica"},{"id_commission":"45","name":"Protecci\u00f3n Civil","slug":"proteccion-civil"},{"id_commission":"46","name":"Puntos Constitucionales","slug":"puntos-constitucionales"},{"id_commission":"47","name":"Radio y Televisi\u00f3n","slug":"radio-y-television"},{"id_commission":"48","name":"Recursos Hidr\u00e1ulicos","slug":"recursos-hidraulicos"},{"id_commission":"49","name":"Reforma Agraria","slug":"reforma-agraria"},{"id_commission":"50","name":"Relaciones Exteriores","slug":"relaciones-exteriores"},{"id_commission":"51","name":"Salud","slug":"salud"},{"id_commission":"52","name":"Seguridad P\u00fablica","slug":"seguridad-publica"},{"id_commission":"53","name":"Seguridad Social","slug":"seguridad-social"},{"id_commission":"54","name":"Transportes","slug":"transportes"},{"id_commission":"55","name":"Turismo","slug":"turismo"},{"id_commission":"56","name":"Vivienda","slug":"vivienda"},{"id_commission":"58","name":"Desarrollo Municipal","slug":"desarrollo-municipal"},{"id_commission":"59","name":"Distrito Federal","slug":"distrito-federal"},{"id_commission":"60","name":"Jurisdiccional","slug":"jurisdiccional"},{"id_commission":"61","name":"R\u00e9gimen Reglamentos y Pr\u00e1cticas Parlamentarias","slug":"regimen-reglamentos-y-practicas-parlamentarias"},{"id_commission":"62","name":"Vigilancia de la Auditor\u00eda Superior de la Federaci\u00f3n","slug":"vigilancia-de-la-auditoria-superior-de-la-federacion"},{"id_commission":"63","name":"Continuidad al Di\u00e1logo y la Concertaci\u00f3n entre los alumnos de las Escuelas Normales Rurales de Michoac\u00e1n y los Gobiernos Estatal y Federal","slug":"continuidad-al-dialogo-y-la-concertacion-entre-los-alumnos-de-las-escuelas-normales-rurales-de-michoacan-y-los-gobiernos-estatal-y-federal"},{"id_commission":"64","name":"Revisi\u00f3n del Funcionamiento de la Comisi\u00f3n Nacional para la Protecci\u00f3n y Defensa de los Usuarios de Servicios Financieros en t\u00e9rminos de lo dispuesto en el art\u00edculo 93 de la CPEUM","slug":"revision-del-funcionamiento-de-la-comision-nacional-para-la-proteccion-y-defensa-de-los-usuarios-de-servicios-financieros-en-terminos-de-lo-dispuesto-en-el-articulo-93-de-la-cpeum"},{"id_commission":"193","name":"Rep\u00fablica \u00c1rabe Saharaui","slug":"republica-arabe-saharaui"},{"id_commission":"65","name":"Bicamaral del Canal de Televisi\u00f3n del Congreso de la Uni\u00f3n","slug":"bicamaral-del-canal-de-television-del-congreso-de-la-union"},{"id_commission":"66","name":"Bicamaral del Sistema de Bibliotecas del Congreso de la Uni\u00f3n","slug":"bicamaral-del-sistema-de-bibliotecas-del-congreso-de-la-union"},{"id_commission":"67","name":"Bicamaral de Seguridad Nacional","slug":"bicamaral-de-seguridad-nacional"},{"id_commission":"68","name":"Parlamento Latinoamericano (PARLATINO)","slug":"parlamento-latinoamericano-(parlatino)"},{"id_commission":"69","name":"Confederaci\u00f3n Parlamentaria de las Am\u00e9ricas (COPA)","slug":"confederacion-parlamentaria-de-las-americas-(copa)"},{"id_commission":"70","name":"Parlamento Centroamericano (PARLACEN)","slug":"parlamento-centroamericano-(parlacen)"},{"id_commission":"71","name":"Comisi\u00f3n Parlamentaria Mixta Estados Unidos Mexicanos\/Uni\u00f3n Europea","slug":"comision-parlamentaria-mixta-estados-unidos-mexicanos\/union-europea"},{"id_commission":"72","name":"Parlamentarios por las Am\u00e9ricas (ParlAm\u00e9ricas)","slug":"parlamentarios-por-las-americas-(parlamericas)"},{"id_commission":"73","name":"Uni\u00f3n Interparlamentaria Mundial (UIP)","slug":"union-interparlamentaria-mundial-(uip)"},{"id_commission":"74","name":"Foro Parlamentario Asia-Pacifico (APPF)","slug":"foro-parlamentario-asia-pacifico-(appf)"},{"id_commission":"75","name":"Asamblea Parlamentaria del Consejo de Europa","slug":"asamblea-parlamentaria-del-consejo-de-europa"},{"id_commission":"76","name":"Consejo Editorial","slug":"consejo-editorial"},{"id_commission":"81","name":"Industria Automotriz y del Acero","slug":"industria-automotriz-y-del-acero"},{"id_commission":"82","name":"Cuenca Lerma-Chapala Santiago","slug":"cuenca-lerma-chapala-santiago"},{"id_commission":"83","name":"Puertos y Marina Mercante","slug":"puertos-y-marina-mercante"},{"id_commission":"84","name":"Industria Manufacturera y Maquiladora de Exportaci\u00f3n","slug":"industria-manufacturera-y-maquiladora-de-exportacion"},{"id_commission":"85","name":"An\u00e1lisis de la Agroindustria Azucarera","slug":"analisis-de-la-agroindustria-azucarera"},{"id_commission":"86","name":"Prevenci\u00f3n Conservaci\u00f3n y en su caso Restauraci\u00f3n del Medio Ambiente en las Entidades Federativas donde se ubican las Instalaciones de PEMEX","slug":"prevencion-conservacion-y-en-su-caso-restauracion-del-medio-ambiente-en-las-entidades-federativas-donde-se-ubican-las-instalaciones-de-pemex"},{"id_commission":"87","name":"Cuenca de Burgos","slug":"cuenca-de-burgos"},{"id_commission":"88","name":"Conmemoraci\u00f3n del Bicentenario del Congreso de An\u00e1huac y de los Sentimientos de la Naci\u00f3n","slug":"conmemoracion-del-bicentenario-del-congreso-de-anahuac-y-de-los-sentimientos-de-la-nacion"},{"id_commission":"89","name":"Cuenca del Sistema Cutzamala","slug":"cuenca-del-sistema-cutzamala"},{"id_commission":"90","name":"Participaci\u00f3n Ciudadana","slug":"participacion-ciudadana"},{"id_commission":"91","name":"Agenda Digital y Tecnolog\u00edas de la Informaci\u00f3n","slug":"agenda-digital-y-tecnologias-de-la-informacion"},{"id_commission":"92","name":"Energ\u00edas Renovables","slug":"energias-renovables"},{"id_commission":"93","name":"Lucha Contra la Trata de Personas","slug":"lucha-contra-la-trata-de-personas"},{"id_commission":"94","name":"Seguimiento a la Regularizaci\u00f3n de los Solares Urbanos de las Zonas Metropolitanas del Pa\u00eds","slug":"seguimiento-a-la-regularizacion-de-los-solares-urbanos-de-las-zonas-metropolitanas-del-pais"},{"id_commission":"95","name":"Seguimiento al Cumplimiento de los Objetivos de Desarrollo del Milenio","slug":"seguimiento-al-cumplimiento-de-los-objetivos-de-desarrollo-del-milenio"},{"id_commission":"96","name":"Miner\u00eda","slug":"mineria"},{"id_commission":"97","name":"Conocer y Dar Seguimiento Puntual y Exhaustivo a las Acciones que han Emprendido las Autoridades Competentes en relaci\u00f3n a los Feminicidios registrados en M\u00e9xico","slug":"conocer-y-dar-seguimiento-puntual-y-exhaustivo-a-las-acciones-que-han-emprendido-las-autoridades-competentes-en-relacion-a-los-feminicidios-registrados-en-mexico"},{"id_commission":"98","name":"Ciudades Patrimonio de la Humanidad","slug":"ciudades-patrimonio-de-la-humanidad"},{"id_commission":"99","name":"Impulsar la Agroindustria de la Palma de Coco y productos derivados","slug":"impulsar-la-agroindustria-de-la-palma-de-coco-y-productos-derivados"},{"id_commission":"100","name":"Seguimiento a las Evaluaciones del Programa Especial Concurrente","slug":"seguimiento-a-las-evaluaciones-del-programa-especial-concurrente"},{"id_commission":"101","name":"Seguimiento a las Pr\u00e1cticas Monop\u00f3licas y Regulaci\u00f3n de Mercados","slug":"seguimiento-a-las-practicas-monopolicas-y-regulacion-de-mercados"},{"id_commission":"102","name":"Asuntos Alimentarios","slug":"asuntos-alimentarios"},{"id_commission":"103","name":"Tecnolog\u00edas de la Informaci\u00f3n y Comunicaci\u00f3n","slug":"tecnologias-de-la-informacion-y-comunicacion"},{"id_commission":"104","name":"Del Caf\u00e9","slug":"del-cafe"},{"id_commission":"105","name":"Programas Sociales","slug":"programas-sociales"},{"id_commission":"106","name":"De la Alimentaci\u00f3n","slug":"de-la-alimentacion"},{"id_commission":"107","name":"Desarrollo Sustentable","slug":"desarrollo-sustentable"},{"id_commission":"108","name":"Indagar el funcionamiento de las instancias del Gobierno Federal relacionadas con el otorgamiento de permisos para Juegos y Sorteos","slug":"indagar-el-funcionamiento-de-las-instancias-del-gobierno-federal-relacionadas-con-el-otorgamiento-de-permisos-para-juegos-y-sorteos"},{"id_commission":"109","name":"Di\u00e1logo y la Conciliaci\u00f3n para el Estado de Chiapas","slug":"dialogo-y-la-conciliacion-para-el-estado-de-chiapas"},{"id_commission":"110","name":"Centro de Estudios de las Finanzas P\u00fablicas","slug":"centro-de-estudios-de-las-finanzas-publicas"},{"id_commission":"111","name":"Centro de Estudios de Derecho e Investigaciones Parlamentarias","slug":"centro-de-estudios-de-derecho-e-investigaciones-parlamentarias"},{"id_commission":"112","name":"Centro de Estudios Sociales y de Opini\u00f3n P\u00fablica","slug":"centro-de-estudios-sociales-y-de-opinion-publica"},{"id_commission":"194","name":"Rep\u00fablica Checa","slug":"republica-checa"},{"id_commission":"113","name":"Centro de Estudios para el Desarrollo Rural Sustentable y la Soberan\u00eda Alimentaria","slug":"centro-de-estudios-para-el-desarrollo-rural-sustentable-y-la-soberania-alimentaria"},{"id_commission":"114","name":"Centro de Estudios para el Adelanto de las Mujeres y la Equidad de G\u00e9nero","slug":"centro-de-estudios-para-el-adelanto-de-las-mujeres-y-la-equidad-de-genero"},{"id_commission":"115","name":"Informaci\u00f3n Gestor\u00eda y Quejas","slug":"informacion-gestoria-y-quejas"},{"id_commission":"116","name":"Fortalecimiento a la Educaci\u00f3n Superior y la Capacitaci\u00f3n para Impulsar el Desarrollo y la Competitividad","slug":"fortalecimiento-a-la-educacion-superior-y-la-capacitacion-para-impulsar-el-desarrollo-y-la-competitividad"},{"id_commission":"117","name":"Cuenca del Bajo P\u00e1nuco","slug":"cuenca-del-bajo-panuco"},{"id_commission":"118","name":"Promoci\u00f3n del Desarrollo Regional","slug":"promocion-del-desarrollo-regional"},{"id_commission":"122","name":"Evaluaci\u00f3n de la Gesti\u00f3n y Operaci\u00f3n del Centro de Desarrollo Infantil (CENDI) Antonia Nava de Catal\u00e1n","slug":"evaluacion-de-la-gestion-y-operacion-del-centro-de-desarrollo-infantil-(cendi)-antonia-nava-de-catalan"},{"id_commission":"123","name":"Alemania","slug":"alemania"},{"id_commission":"124","name":"Angola","slug":"angola"},{"id_commission":"125","name":"Arabia Saudita","slug":"arabia-saudita"},{"id_commission":"126","name":"Argelia","slug":"argelia"},{"id_commission":"127","name":"Argentina","slug":"argentina"},{"id_commission":"128","name":"Australia","slug":"australia"},{"id_commission":"129","name":"Austria","slug":"austria"},{"id_commission":"130","name":"Azerbaiy\u00e1n","slug":"azerbaiyan"},{"id_commission":"131","name":"B\u00e9lgica","slug":"belgica"},{"id_commission":"132","name":"Belice","slug":"belice"},{"id_commission":"133","name":"Bielorrusia","slug":"bielorrusia"},{"id_commission":"134","name":"Bolivia","slug":"bolivia"},{"id_commission":"135","name":"Brasil","slug":"brasil"},{"id_commission":"136","name":"Bulgaria","slug":"bulgaria"},{"id_commission":"137","name":"Canad\u00e1","slug":"canada"},{"id_commission":"138","name":"Chile","slug":"chile"},{"id_commission":"139","name":"China","slug":"china"},{"id_commission":"140","name":"Chipre","slug":"chipre"},{"id_commission":"141","name":"Colombia","slug":"colombia"},{"id_commission":"142","name":"Corea del Norte","slug":"corea-del-norte"},{"id_commission":"143","name":"Corea del Sur","slug":"corea-del-sur"},{"id_commission":"144","name":"Costa de Marfil","slug":"costa-de-marfil"},{"id_commission":"145","name":"Costa Rica","slug":"costa-rica"},{"id_commission":"146","name":"Croacia","slug":"croacia"},{"id_commission":"147","name":"Cuba","slug":"cuba"},{"id_commission":"148","name":"Dinamarca","slug":"dinamarca"},{"id_commission":"149","name":"Ecuador","slug":"ecuador"},{"id_commission":"150","name":"Egipto","slug":"egipto"},{"id_commission":"151","name":"El Salvador","slug":"el-salvador"},{"id_commission":"152","name":"Eslovaquia","slug":"eslovaquia"},{"id_commission":"153","name":"Espa\u00f1a","slug":"espana"},{"id_commission":"154","name":"Estados Unidos de Am\u00e9rica","slug":"estados-unidos-de-america"},{"id_commission":"155","name":"Etiopia","slug":"etiopia"},{"id_commission":"156","name":"Filipinas","slug":"filipinas"},{"id_commission":"157","name":"Finlandia","slug":"finlandia"},{"id_commission":"158","name":"Francia","slug":"francia"},{"id_commission":"159","name":"Georgia","slug":"georgia"},{"id_commission":"160","name":"Grecia","slug":"grecia"},{"id_commission":"161","name":"Guatemala","slug":"guatemala"},{"id_commission":"162","name":"Hait\u00ed","slug":"haiti"},{"id_commission":"163","name":"Holanda","slug":"holanda"},{"id_commission":"164","name":"Honduras","slug":"honduras"},{"id_commission":"165","name":"Hungr\u00eda","slug":"hungria"},{"id_commission":"166","name":"India","slug":"india"},{"id_commission":"167","name":"Indonesia","slug":"indonesia"},{"id_commission":"168","name":"Irak","slug":"irak"},{"id_commission":"169","name":"Ir\u00e1n","slug":"iran"},{"id_commission":"170","name":"Irlanda","slug":"irlanda"},{"id_commission":"171","name":"Israel","slug":"israel"},{"id_commission":"172","name":"Italia","slug":"italia"},{"id_commission":"173","name":"Jamaica","slug":"jamaica"},{"id_commission":"174","name":"Jap\u00f3n","slug":"japon"},{"id_commission":"175","name":"L\u00edbano","slug":"libano"},{"id_commission":"176","name":"Libia","slug":"libia"},{"id_commission":"177","name":"Lituania","slug":"lituania"},{"id_commission":"178","name":"Malasia","slug":"malasia"},{"id_commission":"179","name":"Marruecos","slug":"marruecos"},{"id_commission":"180","name":"Mongolia","slug":"mongolia"},{"id_commission":"181","name":"Montenegro","slug":"montenegro"},{"id_commission":"182","name":"Nicaragua","slug":"nicaragua"},{"id_commission":"183","name":"Noruega","slug":"noruega"},{"id_commission":"184","name":"Nueva Zelanda","slug":"nueva-zelanda"},{"id_commission":"185","name":"Pakist\u00e1n","slug":"pakistan"},{"id_commission":"186","name":"Palestina","slug":"palestina"},{"id_commission":"187","name":"Panam\u00e1","slug":"panama"},{"id_commission":"188","name":"Paraguay","slug":"paraguay"},{"id_commission":"189","name":"Per\u00fa","slug":"peru"},{"id_commission":"190","name":"Polonia","slug":"polonia"},{"id_commission":"191","name":"Portugal","slug":"portugal"},{"id_commission":"192","name":"Reino Unido","slug":"reino-unido"},{"id_commission":"195","name":"Republica Dominicana","slug":"republica-dominicana"},{"id_commission":"196","name":"Rumania","slug":"rumania"},{"id_commission":"197","name":"Rusia","slug":"rusia"},{"id_commission":"198","name":"Santa Lucia y Pa\u00edses del Caricom","slug":"santa-lucia-y-paises-del-caricom"},{"id_commission":"199","name":"Serbia","slug":"serbia"},{"id_commission":"200","name":"Singapur","slug":"singapur"},{"id_commission":"201","name":"Sud\u00e1frica","slug":"sudafrica"},{"id_commission":"202","name":"Suecia","slug":"suecia"},{"id_commission":"203","name":"Suiza","slug":"suiza"},{"id_commission":"204","name":"Tailandia","slug":"tailandia"},{"id_commission":"205","name":"Trinidad y Tobago","slug":"trinidad-y-tobago"},{"id_commission":"206","name":"Turqu\u00eda","slug":"turquia"},{"id_commission":"207","name":"Ucrania","slug":"ucrania"},{"id_commission":"208","name":"Uruguay","slug":"uruguay"},{"id_commission":"209","name":"Venezuela","slug":"venezuela"},{"id_commission":"210","name":"Vietnam","slug":"vietnam"},{"id_commission":"211","name":"Organizador del Foro de Consulta sobre el Tema de la Pol\u00edtica de Drogas","slug":"organizador-del-foro-de-consulta-sobre-el-tema-de-la-politica-de-drogas"},{"id_commission":"214","name":"Nigeria","slug":"nigeria"},{"id_commission":"216","name":"Para Conmemorar el Centenario del Natalicio de Octavio Paz","slug":"para-conmemorar-el-centenario-del-natalicio-de-octavio-paz"},{"id_commission":"219","name":"Seguimiento de los Programas Sociales Destinados a los Adultos Mayores","slug":"seguimiento-de-los-programas-sociales-destinados-a-los-adultos-mayores"},{"id_commission":"221","name":"Seguimiento a las investigaciones realizadas sobre el incendio de la Guarderia ABC de Hermosillo Sonora ocurrida el 5 de junio de 2009 as\u00ed como de las causas que lo ocasionaron y la identificaci\u00f3n de los probables responsables de la tragedia","slug":"seguimiento-a-las-investigaciones-realizadas-sobre-el-incendio-de-la-guarderia-abc-de-hermosillo-sonora-ocurrida-el-5-de-junio-de-2009-asi-como-de-las-causas-que-lo-ocasionaron-y-la-identificacion-de-los-probables-responsables-de-la-tragedia"},{"id_commission":"222","name":"Seguimiento al ejercicio de los Recursos Federales que se Destinen o se Hayan Destinado a la L\u00ednea 12 del Metro","slug":"seguimiento-al-ejercicio-de-los-recursos-federales-que-se-destinen-o-se-hayan-destinado-a-la-linea-12-del-metro"},{"id_commission":"223","name":"Contratos Celebrados por Petr\u00f3leos Mexicanos sus Empresas Subsidiarias y Filiales de 2006 a la Fecha.","slug":"contratos-celebrados-por-petroleos-mexicanos-sus-empresas-subsidiarias-y-filiales-de-2006-a-la-fecha."},{"id_commission":"224","name":"Plural de Observaci\u00f3n Electoral para dar Seguimiento al Proceso Electoral del Estado de Nayarit a celebrarse el pr\u00f3ximo 6 de julio de 2014","slug":"plural-de-observacion-electoral-para-dar-seguimiento-al-proceso-electoral-del-estado-de-nayarit-a-celebrarse-el-proximo-6-de-julio-de-2014"},{"id_commission":"225","name":"Seguimiento a la problem\u00e1tica generada por el derrame de diversas sustancias contaminantes en el r\u00edo Sonora","slug":"seguimiento-a-la-problematica-generada-por-el-derrame-de-diversas-sustancias-contaminantes-en-el-rio-sonora"},{"id_commission":"226","name":"XIV Reuni\u00f3n Interparlamentaria M\u00e9xico-Espa\u00f1a por celebrarse en San Miguel de Allende Guanajuato los d\u00edas 18 y 19 de septiembre de 2014","slug":"xiv-reunion-interparlamentaria-mexico-espana-por-celebrarse-en-san-miguel-de-allende-guanajuato-los-dias-18-y-19-de-septiembre-de-2014"},{"id_commission":"227","name":"Seguimiento a las Investigaciones relacionadas con los hechos ocurridos en Iguala Guerrero a alumnos de la Escuela Normal Rural de Ayotzinapa Ra\u00fal Isidro Burgos.","slug":"Seguimiento-a-las-investigaciones-relacionadas-con-los-hechos-ocurridos-en-iguala-guerrero-a-alumnos-de-la-escuela-normal-rural-de-ayotzinapa-raul-isidro-burgos"}]');
}

	   /*Get temas array*/
function getTemas() {
	$temas = array(
		array("name" => "transparencia", "slug" => "transparencia"),
		array("name" => "rendición de cuentas",  "slug" => "rendicion-de-cuentas"),
		array("name" => "anticorrupción", "slug" => "anticorrupcion"),
		array("name" => "publicidad oficial", "slug" => "publicidad-oficial"),
		array("name" => "parlamento abierto", "slug" => "parlamento-abierto"),
		array("name" => "participación ciudadana", "slug" => "participacion-ciudadana"),
		array("name" => "presupuesto", "cve" => "7", "slug" => "presupuesto"),
		array("name" => "migración", "cve" => "8", "slug" => "migracion"),
		array("name" => "salud", "cve" => "9", "slug" => "salud"),
		array("name" => "industrias extractivas", "slug" => "industrias-extractivas"),
		array("name" => "minería",  "slug" => "mineria"),
		array("name" => "derechos humanos",  "slug" => "derechos-humanos"),
		array("name" => "seguridad ciudadana",  "slug" => "seguridad-ciudadana"),
		array("name" => "derechos de las víctimas", "slug" => "derechos-de-las-victimas"),
		array("name" => "derecho a la consulta", "slug" => " derecho-a-la-consulta")
		
	);
	
	return $temas;
}



/*get data by parameter $_GET */
function getDataRepresentatives() {
	if(isset($_GET["partido-politico"])) {
		$result = getRepresentativesByPoliticalParty($_GET["partido-politico"]);
		$data = $result["loop"];
	} elseif(isset($_GET["estado"])) {
		$result = getRepresentativesByState($_GET["estado"]);
		$data = $result["loop"];
	} elseif(isset($_GET["comision"])) {
		$result = getRepresentativesByCommission($_GET["comision"]);
		$data = $result["loop"];
	} else {
		return false;
	}
	
	return $data;
}

/*get data by parameter $_GET */
function getDataIniciativas() {
	if(isset($_GET["partido-politico"])) {
		$result = getIniciativasByPoliticalParty($_GET["partido-politico"]);
		$data = $result["loop"];
	} elseif(isset($_GET["estado"])) {
		$result = getIniciativasByTemas($_GET["estado"]);
		$data = $result["loop"];
	} elseif(isset($_GET["comision"])) {
		$result = getIniciativasByCommission($_GET["comision"]);
		$data = $result["loop"];
	} elseif(isset($_GET["tema"])) {
		$result = getIniciativasByCommission($_GET["tema"]);
		$data = $result["loop"];
	} elseif(isset($_GET["status"])) {
		$result = getIniciativasByCommission($_GET["status"]);
		$data = $result["loop"];
		
		
	} else {
		return false;
	}
	
	return $data;
}

/*get data by parameter $_GET */
function getParameterValueGET() {
	if(isset($_GET["partido-politico"])) {
		return $_GET["partido-politico"];
	} elseif(isset($_GET["estado"])) {
		return $_GET["estado"];
	} elseif(isset($_GET["comision"])) {
		return $_GET["comision"];
	} elseif(isset($_GET["tema"])) {
		return $_GET["tema"];
	} elseif(isset($_GET["status"])) {
		return $_GET["status"];
	} else {
		return "";
	}
}

add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
        ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li>'. $loginoutlink .'</li>';
    return $items;
}


function avia_pagination2($pages = '', $wrapper = 'div', $custom = false) {
	global $paged;

	if(get_query_var('paged')) {
	     $paged = get_query_var('paged');
	} elseif(get_query_var('page')) {
	     $paged = get_query_var('page');
	} else {
	     $paged = 1;
	}

	$output = "";
	$prev = $paged - 1;
	$next = $paged + 1;
	$range = 2; // only edit this if you want to show more page-links
	$showitems = ($range * 2)+1;



	if($pages == '') {
		if($custom) {
			$pages = $custom->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		} else {
			global $wp_query;
			//$pages = ceil(wp_count_posts($post_type)->publish / $per_page);
			$pages = $wp_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		}
		
	}

	$method = "get_pagenum_link";

	if(1 != $pages) {
		$output .= "<$wrapper class='pagination'>";
		$output .= "<span class='pagination-meta'>".sprintf(__("Page %d of %d", 'avia_framework'), $paged, $pages)."</span>";
		$output .= ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".$method(1)."'>&laquo;</a>":"";
		$output .= ($paged > 1 && $showitems < $pages)? "<a href='".$method($prev)."'>&lsaquo;</a>":"";


		for($i=1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				$output .= ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".$method($i)."' class='inactive' >".$i."</a>";
			}
		}

		$output .= ($paged < $pages && $showitems < $pages) ? "<a href='".$method($next)."'>&rsaquo;</a>" :"";
		$output .= ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".$method($pages)."'>&raquo;</a>":"";
		$output .= "</$wrapper>\n";
	}

	return $output;
}
