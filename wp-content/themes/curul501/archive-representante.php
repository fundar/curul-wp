<?php
	global $avia_config, $more;
	$selectedCommission = getParameterValueGET('comision');
	$selectedType = getParameterValueGET('tipo-eleccion');
	$selectedPolitical = getParameterValueGET('partido-politico');
	$selectedState = getParameterValueGET('estado');
	$data = getDataRepresentatives();
	$selectedTipo = getParameterValueGET('tipo-representante');	
	// getRepresentatives(true);
	/*
	* get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	*/
	get_header();
	

	?>
	<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
  	<style type="text/css">


  		#map{
  			height:500px;
  		}
  		/*
		#map .leaflet-overlay-pane path,
		#map .leaflet-marker-icon {
		  cursor: url("<?php echo get_stylesheet_directory_uri() ?>/images/marker-morado.png") crosshair;
		}
		*/
  		#map-legend{
			background: #271530;
  			margin:10px 0px 0px 50px;
  			padding: 0px 10px;
			position: absolute;
			left:0;
			z-index: 100;
			display:none;
			-webkit-box-shadow: 0px 0px 42px 1px rgba(255,255,255,1);
			-moz-box-shadow: 0px 0px 42px 1px rgba(255,255,255,1);
			box-shadow: 0px 0px 42px 1px rgba(255,255,255,1);
  		}

  		#map-legend p{
			color: #fff;
   			font-family: oswald;
   			font-weight: lighter;
   			padding: 10px;
   			font-size: 1.5em;
		}

  		#map-info{
			background: #F4F4F4;
  			display: none;
  			height:498px;
  			min-height:498px;
  			min-width:30%;
  			overflow-y: scroll;
			padding: 20px;
			position: absolute;
			right:0;
  			width:30%;
			z-index: 100;
  		}
  		
  		#map-info h2{
   			color:#46354f;
   			font-family: oswald;
   			font-size: 1.4em;
   			font-weight: lighter;
  		}

  		.map-info-representante-mayoria, .map-info-representante-proporcional{
  			max-height:48%;
  			margin-bottom: 35px;
  		}

  		#map-info .close-map-info{
  			cursor: pointer;
			float: right;
			margin-top: -25px;
			font-size: 1.8em;
			border: 0.3px solid #aaa;
			font-family: oswald;
			font-weight: lighter;
  		}

  		.representante-mapa{
  			margin-bottom:25px;
  		}
  		.representante-mapa .rep-data{
  			display: block;
			padding-bottom: 15px;
			border-bottom: dotted 2px #ccc;
			margin-bottom: 10px;
		}

  		.rep-data img.img-rep{
			width: 70px;
			height: 90px;
			float: left;
			margin: 0px 20px 5px 0px;
  		}

  		.rep-data a.name-rep{
  			color: #512a7b;
  			cursor: pointer;
   			font-family: oswald;
   			font-size: 1.4em;
   			font-weight: lighter;
  		}

  		.rep-data span{
  			color: #888a8a;
  			font-weight: bold;
			display: block;
  		}

  		.representante-mapa .part-data{
  			display: block;
			padding-bottom: 15px;
			border-bottom: solid 1px #eee;
		}

  		.part-data .img-partido{
  			float:left;
			margin-right: 15px;
  		}

  		.search-container{
  			background: #271530;
  			width: 100%;
  			height: auto;
  			margin: 0;
  			padding: 30px 0 10px;
  		}

  		.buscador-principal h1{
  			font-size:2.3em;
  		}
  		
  		.buscador-principal h1{
  			float:left; 
  			margin-right: 10px;
  			color:#fff;
  		}

  		.buscador-principal input#nombre-representante{
  			width: 69%;
			font-size:1.5em;
			float:left;
			height:50px;
			background: none repeat scroll 0 0 rgba(250, 250, 250, 0.8) !important;
			border:0px solid;
  		}
		.enviar-representante {
		    background: none repeat scroll 0 0 #a59aaa !important;
		    border: 0 solid;
		    color: rgba(41, 23, 50, 1) !important;
		    float: left;
		    font: 14px "colaborate-regular";
		    height: 50px;
		    left: 0;		
		    padding: 0 !important;
		    text-transform: uppercase;
		    width: 5%;
		}

}


  	</style>
  	<script type="text/javascript">
  		jQuery(document).ready(function(){
  			// aparecer legenda del mapa
  			setTimeout(function(){ 
  				jQuery("#map-legend").toggle( "slide", { "direction": "left" });
  			}, 1500);

  			jQuery(".close-map-info").on("click", function(){
				jQuery("#map-info").toggle( "slide", { "direction": "right" });
			})
  		})
  	</script>

	<div id="" class="avia-fullscreen-slider main_color avia-builder-el-0 el_before_av_section avia-builder-el-first container_wrap fullsize">
		<!-- inicio mapa de representantes-->
		<div class="forcefullwidth_wrapper_tp_banner" style="position: relative; width: 100%; height: auto; margin-bottom: 0px;">
		   <div id="av_section_1" class="avia-section main_color avia-section-default avia-no-border-styling avia-bg-style-scroll 
		   		avia-builder-el-0 avia-builder-el-no-sibling av-minimum-height av-minimum-height-100 container_wrap sidebar_right">
				<div id="map-legend">
					<p> Da click en el mapa para conocer a tus representantes </p>
				</div>

				<div id="map-info">
					<div class="close-map-info"> x </div>
					<div class="map-info-representante-mayoria"></div>
					<div class="map-info-representante-proporcional"></div>
				</div>
				<div id="map"></div>
			</div>
		</div>
		<!-- fin mapa de representantes-->
	</div>
	<div id="after_layer_slider_1" class="main_color container_wrap fullsize" style="background: none repeat scroll 0% 0% rgb(39, 21, 48);">
		<div class="container">
			<div class="search-container container box-menu">
				<div class="search-table">
					<div class="buscador-principal">
					   <h1>¡Busca tu Representante!</h1> 
					   <input type="text" name="slug" id="nombre-representante" placeholder="Nombre del representante">
					   <input type="submit" id="enviar-representante" type="submit" value="Enviar"></input>

				   	</div>
				</div>
			</div>
		</div>			
	</div>
	<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
	        <div class="container top60">
					<form name="filter-representanes" id="filter-representanes" action="/representantes">

					   <div id="filter">
						   <select class="sorter-rep sort" name="partido-politico" id="partido-politico-filter">
							   <option value="">Grupos parlamentarios</option>
							   <?php $politicalPartiesArray = getPoliticalParties(); ?>
							   <?php foreach($politicalPartiesArray as $value) { ?>
									<option value="<?php echo $value["slug"];?>" <?php if($selectedPolitical == $value["slug"]) echo 'selected="selected"'?>>
										<?php echo utf8_encode($value["name"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   
					   <div id="filter">				
						   <select class="sorter-rep sort" name="estado" id="estado-filter">
							   <option value="">Estados</option>
							   <?php $statesArray = getStates(); ?>
							   <?php foreach($statesArray as $value) { ?>
									<option value="<?php echo utf8_encode($value["name"]);?>" <?php if($selectedState == utf8_encode($value["name"])) echo 'selected="selected"'?>>
										<?php echo utf8_encode($value["name"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   
					   <div id="filter">				
						   <select class="sorter-rep sort" name="comision" id="comision-filter">
							   <option value="">Comisiones</option>
							    <?php $commissionsArray = getCommissions(); ?>
								<?php foreach($commissionsArray as $value) { ?>
									<option value="<?php echo $value->slug;?>" <?php if($selectedCommission == $value->slug) echo 'selected="selected"'?>>
										<?php echo $value->name;?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   
						<div id="filter">				
						   <select class="sorter-rep sort" name="tipo-eleccion" id="tipo-eleccion-filter">
							   <option value="">Tipo de elección</option>
								<option value="representacion-proporcional" <?php if($selectedType == "representacion-proporcional") echo 'selected="selected"'?>>
									Representación proporcional
								</option>
								<option value="mayoria-relativa" <?php if($selectedType == "mayoria-relativa") echo 'selected="selected"'?>>
									Mayoría relativa
								</option>
						   </select>
						</div>
						
						
						<div id="filter">				
						   <select class="sorter-rep sort" name="tipo-representante" id="tipo-representante-filter">
							 <option value="">Tipos de representante</option>
							   <?php $TiposArray = getTipos(); ?>
							   <?php foreach($TiposArray as $value) { ?>
									<option value="<?php echo $value["slug"];?>" <?php if($selectedTipo == $value["slug"]) echo 'selected="selected"'?>>
										<?php echo utf8_encode($value["name"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>
						
						
						<div>				
						   <input type="submit" value="Filtrar" id="submit-filter"/>
					   </div>
					</form>				
		</div>
	 
		<!-- titulo-->
		<div class="container top60">
			<h1 class="entry-title-yellow">Integrantes de la Camara</h1>
			<div class="line-amarilla"> </div>
	    </div>
		<!-- fin de titulo-->
	
		<!--Inicio filtros representantes -->
		<!-- Fin filtros representantes -->				
	<div class='container_wrap container_wrap_first main_color fullsize'>
		<div class='container'>
			<main class='template-page content  av-content-full alpha units'>
				<?php if($data) { ?>
					<?php if ($data->have_posts()) { ?>
						<?php while ($data->have_posts()) : $data->the_post(); ?>
							<!--Inicio representantes-->
							<article class="post type-post post-archive">
									<div class="post_foto">
										<?php $avatar_url = get_post_meta($post->ID, 'avatar_url', true); ?>
										<img src="<?php echo $avatar_url;?>" class="attachment-post-thumbnail wp-post-image" alt="Avatar representante">
									</div>										
										<a class="representantes-home" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
											<?php the_title(); ?>
										</a>
										<div id="nav-representantes">
											<ul>
												<li>
													<?php $politicalParty = getPoliticalParty(get_post_meta($post->ID, 'wp_id_political_party', true)); ?>
													<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/<?php echo $politicalParty["url_logo"];?>"> 
													<?php echo utf8_encode($politicalParty["name"]);?>
												</li>
												
												<li class="navrepr-left">
													<?php echo get_post_meta($post->ID, 'wp_election_type', true); ?>
												</li>
												
												<li class="navrepr-left">
																<?php 
																$puesto=get_post_meta($post->ID, 'wp_id_representative_type', true); 
																if($puesto==1)
																	echo "Cargo: Diputado";
																else
																	echo "Cargo: Senador";
																	?>												</li>
												
												<li class="navrepr-left">
													Entidad: <?php echo get_post_meta($post->ID, 'wp_zone_state', true); ?>
												</li>
												
												<li class="navrepr-left no-borde">
													<?php $initiatives = getInitativesByRepresentative(get_post_meta($post->ID, 'wp_slug', true)); ?>
													<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/icono-iniciativas.png">
													<span><?php echo $initiatives["count"];?></span> Iniciativas
												</li>
											</ul>
										</div>
									
								
							</article><!--fin representantes-->								
							<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first">
								<div class="share-social-representante ">
									<?php avia_social_share_links(); ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } else { ?>
						<p>No se encontraron representantes con esta busqueda</p>
					<?php } ?>
				<?php } else { ?>
					<?php query_posts($query_string.'&orderby=title&order=ASC'); ?>
					<?php if (have_posts()) { ?>
						<?php while (have_posts()) : the_post(); ?>
							<!--Inicio representantes-->
							<article class="post type-post post-archive">
									<div class="post_foto">
										<?php $avatar_url = get_post_meta($post->ID, 'avatar_url', true); ?>
										<img src="<?php echo $avatar_url;?>" class="attachment-post-thumbnail wp-post-image" alt="Avatar representante">
									</div>										
										<a class="representantes-home" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
											<?php the_title(); ?>
										</a>
										<div id="nav-representantes">
											<ul>
												<li>
													<?php $politicalParty = getPoliticalParty(get_post_meta($post->ID, 'wp_id_political_party', true)); ?>
													<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/<?php echo $politicalParty["url_logo"];?>"> 
													<?php echo utf8_encode($politicalParty["name"]);?>
												</li>
												
												<li class="navrepr-left">
													<?php echo get_post_meta($post->ID, 'wp_election_type', true); ?>
												</li>
												
												<li class="navrepr-left">
																<?php 
																$puesto=get_post_meta($post->ID, 'wp_id_representative_type', true); 
																if($puesto==1)
																	echo "Cargo: Diputado";
																else
																	echo "Cargo: Senador";
																?>												</li>
												
												<li class="navrepr-left">
													Entidad: <?php echo get_post_meta($post->ID, 'wp_zone_state', true); ?>
												</li>
												
												<li class="navrepr-left no-borde">
													<?php $initiatives = getInitativesByRepresentative(get_post_meta($post->ID, 'wp_slug', true)); ?>
													<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/icono-iniciativas.png">
													<span><?php echo $initiatives["count"];?></span> Iniciativas
												</li>
											</ul>
										</div>
									
								
							</article><!--fin representantes-->								
							<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first">
								<div class="share-social-representante ">
									<?php avia_social_share_links(); ?>
								</div>
							</div>
						<?php endwhile; ?>
					<?php } ?>
				<?php } ?>
				
				<?php
					if($data) {
						echo "<div class='{$blog_style}'>" . avia_pagination2('', 'nav', $data) . "</div>";
					} else {
						echo "<div class='{$blog_style}'>" . avia_pagination2('', 'nav') . "</div>";
					}
				?>
			</main>
		</div><!--end container-->
	</div><!-- close default .container_wrap element -->
<?php get_footer(); ?>

<script type="text/javascript">
	jQuery(document).ready( function () {
		jQuery("#submit-filter").click( function(event) {
			event.preventDefault();
			
			jQuery("#nombre-representante").remove();

			if(jQuery("#partido-politico-filter option:selected").val() == "") {
				jQuery("#partido-politico-filter").remove();
			}
			
			if(jQuery("#estado-filter option:selected").val() == "") {
				jQuery("#estado-filter").remove();
			}
			
			if(jQuery("#comision-filter option:selected").val() == "") {
				jQuery("#comision-filter").remove();
			}
			
			if(jQuery("#tipo-eleccion-filter option:selected").val() == "") {
				jQuery("#tipo-eleccion-filter").remove();
				
			}
			if(jQuery("#tipo-representante-filter option:selected").val() == "") {		
				jQuery("#tipo-representante-filter").remove();
			}
			
			jQuery("#filter-representanes").submit();
		});
		/* Buscador por nombre*/
		var rep_obj = {"Botello Montes José Alfredo": "botello-montes-jose-alfredo", "Pérez de Alba José Noel": "perez-de-alba-jose-noel", "Villalobos Seañez Jorge Iván": "villalobos-seanez-jorge-ivan", "Anaya Llamas José Guillermo": "anaya-llamas-jose-guillermo", "Ávila Pérez José Angel": "avila-perez-jose-angel", "Benavides Castañeda José Alberto": "benavides-castaneda-jose-alberto", "Doger Guerrero José Enrique": "doger-guerrero-jose-enrique", "Caamal Mena José Angelino": "caamal-mena-jose-angelino", "Coronato Rodríguez José Francisco": "coronato-rodriguez-jose-francisco", "Gastélum Buenrostro Juan Manuel": "gastelum-buenrostro-juan-manuel", "Escajeda Jiménez José Rubén": "escajeda-jimenez-jose-ruben", "López Cisneros José Martín": "lopez-cisneros-jose-martin", "Esquivel Zalpa José Luis": "esquivel-zalpa-jose-luis", "Llanas Alba José Alejandro": "llanas-alba-jose-alejandro", "Hurtado Gallegos José Antonio": "hurtado-gallegos-jose-antonio", "Moreno Árcega José Isidro": "moreno-arcega-jose-isidro", "Oliveros Usabiaga José Luis": "oliveros-usabiaga-jose-luis", "Maldonado Salgado José Valentín": "maldonado-salgado-jose-valentin", "Muñoz Soria José Luis": "munoz-soria-jose-luis", "Pérez de Alba José Noel": "perez-de-alba-jose-noel", "Rangel Espinosa José": "rangel-espinosa-jose", "Reina Lizárraga José Enrique": "reina-lizarraga-jose-enrique", "Rojo García de Alba José Antonio": "rojo-garcia-de-alba-jose-antonio", "Salinas Garza José Arturo": "salinas-garza-jose-arturo", "Mejía Guardado Julisa": "mejia-guardado-julisa", "Moreno Rivera Julio César": "moreno-rivera-julio-cesar", "Samperio Montaño Juan Ignacio": "samperio-montano-juan-ignacio", "Bonilla Jaime Juana": "bonilla-jaime-juana", "Uribe Padilla Juan Carlos": "uribe-padilla-juan-carlos", "Lorenzini Rangel Julio César": "lorenzini-rangel-julio-cesar", "Flemate Ramírez Julio César": "flemate-ramirez-julio-cesar", "Fócil Pérez Juan Manuel": "focil-perez-juan-manuel", "Guerrero López Judit Magdalena": "guerrero-lopez-judit-magdalena", "Del Bosque Márquez Juan Isidro": "del-bosque-marquez-juan-isidro", "Rocha Piedra Juan Manuel": "rocha-piedra-juan-manuel", "Muñoz Márquez Juan Carlos": "munoz-marquez-juan-carlos", "Flores Gómez José Luis Cruz": "flores-gomez-jose-luis-cruz", "Cáceres de la Fuente Juan Francisco": "caceres-de-la-fuente-juan-francisco", "Martínez Martínez Juan Luis": "martinez-martinez-juan-luis", "Bueno Torio Juan": "bueno-torio-juan", "Carbajal Hernández Juan Manuel": "carbajal-hernandez-juan-manuel", "Adame Alemán Juan Pablo": "adame-aleman-juan-pablo", "Soto Martínez José": "soto-martinez-jose", "Aquino Calvo Juan Jesús": "aquino-calvo-juan-jesus", "Salinas Pérez Josefina": "salinas-perez-josefina", "Labastida Sotelo Karina": "labastida-sotelo-karina", "Aguilar Gil Lilia": "aguilar-gil-lilia", "García Hernández Josefina": "garcia-hernandez-josefina", "Vega Vázquez José Humberto": "vega-vazquez-jose-humberto", "Valle Magaña José Luis": "valle-magana-jose-luis", "Trejo Reyes José Isabel": "trejo-reyes-jose-isabel", "Athie Flores Kamel": "athie-flores-kamel", "Alcalá Padilla Leobardo": "alcala-padilla-leobardo", "Quiroga Anguiano Karen": "quiroga-anguiano-karen", "Calderón Ramírez Leticia": "calderon-ramirez-leticia", "Berzunza Novelo Landy Margarita": "berzunza-novelo-landy-margarita", "Barrera Fortoul Laura": "barrera-fortoul-laura", "Martel Cantú Laura Ximena": "martel-cantu-laura-ximena", "Vargas Vargas Laura Guadalupe": "vargas-vargas-laura-guadalupe", "Pantoja Hernández Leslie": "pantoja-hernandez-leslie", "Gómez Gómez Luis": "gomez-gomez-luis", "Romero Sevilla Leonor": "romero-sevilla-leonor", "Sánchez Cruz Leopoldo": "sanchez-cruz-leopoldo", "Rosas Montero Lizbeth Eugenia": "rosas-montero-lizbeth-eugenia", "Mendoza Curiel María Leticia": "mendoza-curiel-maria-leticia", "Gamboa Song Lizbeth Loy": "gamboa-song-lizbeth-loy", "Campos Córdova Lisandro Arístides": "campos-cordova-lisandro-aristides", "López Landero Leticia": "lopez-landero-leticia", "Méndez Denis Lorena": "mendez-denis-lorena", "Valles Sampedro Lorenia Iveth": "valles-sampedro-lorenia-iveth", "Ortíz Ahlf Loretta": "ortiz-ahlf-loretta", "Ramírez Romero Luis Miguel": "ramirez-romero-luis-miguel", "Villarreal García Luis Alberto": "villarreal-garcia-luis-alberto", "Quiñones Canales Lourdes Eulalia": "quinones-canales-lourdes-eulalia", "Garfias Gutiérrez Lucila": "garfias-gutierrez-lucila", "Aldana Prieto Luis Ricardo": "aldana-prieto-luis-ricardo", "Arias Pallares Luis Manuel": "arias-pallares-luis-manuel", "Murguía Lardizabal Luis Alfredo": "murguia-lardizabal-luis-alfredo", "Córdova Díaz Luis Armando": "cordova-diaz-luis-armando", "Bernal Gutiérrez Andrés Marco Antonio": "bernal-gutierrez-andres-marco-antonio", "Espinosa Cházaro Luis Ángel Xariel": "espinosa-chazaro-luis-angel-xariel", "Olvera Correa Luis": "olvera-correa-luis", "Garza Ruvalcaba Marcelo": "garza-ruvalcaba-marcelo", "Alcalde Luján Luisa María": "alcalde-lujan-luisa-maria", "González Roldán Luis Antonio": "gonzalez-roldan-luis-antonio", "Núñez Monreal Magdalena del Socorro": "nunez-monreal-magdalena-del-socorro", "Mícher Camarena Martha Lucía": "micher-camarena-martha-lucia", "Añorve Baños Manuel": "anorve-banos-manuel", "Orta Coronado Marcelina": "orta-coronado-marcelina", "Beltrones Rivera Manlio Fabio": "beltrones-rivera-manlio-fabio", "Torres Cofiño Marcelo de Jesús": "torres-cofino-marcelo-de-jesus", "Huerta Ladrón de Guevara Manuel Rafael": "huerta-ladron-de-guevara-manuel-rafael", "Calzada Arroyo Marco Antonio": "calzada-arroyo-marco-antonio", "Licea González Margarita": "licea-gonzalez-margarita", "González Valdez Marco Antonio": "gonzalez-valdez-marco-antonio", "Barba Mariscal Marco Antonio": "barba-mariscal-marco-antonio", "Aguilar Vega Marcos": "aguilar-vega-marcos", "Vela Reyes Marco Alonso": "vela-reyes-marco-alonso", "Velázquez Díaz María Guadalupe": "velazquez-diaz-maria-guadalupe", "Medina Filigrana Marcos Rosendo": "medina-filigrana-marcos-rosendo", "Romero Lozano María Fernanda": "romero-lozano-maria-fernanda", "Ortiz Mantilla María Isabel": "ortiz-mantilla-maria-isabel", "Pariente Gavito María del Rosario de Fátima": "pariente-gavito-maria-del-rosario-de-fatima", "Schroeder Verdugo María Fernanda": "schroeder-verdugo-maria-fernanda", "Urciel Castañeda María Celia": "urciel-castaneda-maria-celia", "Corona Nakamura María del Rocío": "corona-nakamura-maria-del-rocio", "Sánchez Santiago María Guadalupe": "sanchez-santiago-maria-guadalupe", "Villaseñor Vargas María de la Paloma": "villasenor-vargas-maria-de-la-paloma", "Zavala Peniche María Beatriz": "zavala-peniche-maria-beatriz", "García Fernández María de las Nieves": "garcia-fernandez-maria-de-las-nieves", "García Olmedo María del Rocío": "garcia-olmedo-maria-del-rocio", "Magaña Zepeda María Angélica": "magana-zepeda-maria-angelica", "Moctezuma Oviedo María Guadalupe": "moctezuma-oviedo-maria-guadalupe", "Ordaz Martínez María del Carmen": "ordaz-martinez-maria-del-carmen", "García de la Cadena Romero María del Carmen": "garcia-de-la-cadena-romero-maria-del-carmen", "Merlín García María del Rosario": "merlin-garcia-maria-del-rosario", "Huerta Rea María de Jesús": "huerta-rea-maria-de-jesus", "Ceseñas Chapa María del Socorro": "cesenas-chapa-maria-del-socorro", "Garza Moreno María Esther": "garza-moreno-maria-esther", "Cerda Franco María Sanjuana": "cerda-franco-maria-sanjuana", "Cabañas Aparicio María Elia": "cabanas-aparicio-maria-elia", "Amaya Reyes María de Lourdes": "amaya-reyes-maria-de-lourdes", "Tapia Fonllem Margarita Elena": "tapia-fonllem-margarita-elena", "Saldaña Hernández Margarita": "saldana-hernandez-margarita", "Mejía García Leticia": "mejia-garcia-leticia", "Bautista Villegas Óscar": "bautista-villegas-oscar", "De León Pérez María Eugenia": "de-leon-perez-maria-eugenia", "Araujo de la Torre Elsa Patricia": "araujo-de-la-torre-elsa-patricia", "Peña Recio Patricia Guadalupe": "pena-recio-patricia-guadalupe", "Niaves López Ossiel Omar": "niaves-lopez-ossiel-omar", "Lugo Barriga Patricia": "lugo-barriga-patricia", "Retamoza Vega Patricia Elena": "retamoza-vega-patricia-elena", "Guzmán Cervantes Carlos Bernardo": "guzman-cervantes-carlos-bernardo", "González Domínguez Isela": "gonzalez-dominguez-isela", "Correa Acevedo Abraham": "correa-acevedo-abraham", "Flores Treviño María de Lourdes": "flores-trevino-maria-de-lourdes", "Velázquez López Mirna": "velazquez-lopez-mirna", "López Birlain Ana Paola": "lopez-birlain-ana-paola", "Ponce Orozco Norma": "ponce-orozco-norma", "Jiménez Esquivel María Teresa": "jimenez-esquivel-maria-teresa", "Barrueta Barón Noé": "barrueta-baron-noe", "Fujiwara Montelongo René Ricardo": "fujiwara-montelongo-rene-ricardo", "Hernández González Noé": "hernandez-gonzalez-noe", "Gordillo Castillo Néstor Octavio": "gordillo-castillo-nestor-octavio", "Moreno Cárdenas Rafael Alejandro": "moreno-cardenas-rafael-alejandro", "Ochoa López Nabor": "ochoa-lopez-nabor", "Vargas Pérez Nelly del Carmen": "vargas-perez-nelly-del-carmen", "Vázquez Saut Regina": "vazquez-saut-regina", "Monreal Ávila Ricardo": "monreal-avila-ricardo", "García de la Fuente Mónica": "garcia-de-la-fuente-monica", "Astudillo Suárez Ricardo": "astudillo-suarez-ricardo", "King de la Rosa Raymundo": "king-de-la-rosa-raymundo", "Terán Guevara María Rebeca": "teran-guevara-maria-rebeca", "Paz Alonzo Raúl": "paz-alonzo-raul", "Macías Sandoval Raúl": "macias-sandoval-raul", "López López Raudel": "lopez-lopez-raudel", "Gómez Ramírez Raúl": "gomez-ramirez-raul", "Galván Villanueva Raúl Santos": "galvan-villanueva-raul-santos", "Micalco Méndez Rafael Alejandro": "micalco-mendez-rafael-alejandro", "Sampayo Ortiz Ramón Antonio": "sampayo-ortiz-ramon-antonio", "Carpinteyro Calderón Purificación": "carpinteyro-calderon-purificacion", "Félix Hays Rubén Benjamín": "felix-hays-ruben-benjamin", "Montalvo Hernández Ramón": "montalvo-hernandez-ramon", "Acosta Montoya Rubén": "acosta-montoya-ruben", "González Reséndiz Rafael": "gonzalez-resendiz-rafael", "Barrera Barrera Petra": "barrera-barrera-petra", "Acosta Croda Rafael": "acosta-croda-rafael", "Moreno Montoya José Pilar": "moreno-montoya-jose-pilar", "Porras Pérez Pedro": "porras-perez-pedro", "Treviño Villarreal Pedro Pablo": "trevino-villarreal-pedro-pablo", "Camarillo Ortega Rubén": "camarillo-ortega-ruben", "Flores Sandoval Patricio": "flores-sandoval-patricio", "Gómez Gómez Pedro": "gomez-gomez-pedro", "Domínguez Zepeda Pedro Ignacio": "dominguez-zepeda-pedro-ignacio", "Luna Porquillo Roxana": "luna-porquillo-roxana", "Chávez Contreras Rodrigo": "chavez-contreras-rodrigo", "Ruíz Moronatti Roberto": "ruiz-moronatti-roberto", "Reyes Gámiz Roberto Carlos": "reyes-gamiz-roberto-carlos", "Gómez Olguín Roy Argel": "gomez-olguin-roy-argel", "Gualito Castañeda Rosalba": "gualito-castaneda-rosalba", "Serrano Toledo Rosendo": "serrano-toledo-rosendo", "De la Cruz Requena Rosalba": "de-la-cruz-requena-rosalba", "Pérez Hernández Rosa Elba": "perez-hernandez-rosa-elba", "Romero Guzmán Rosa Elia": "romero-guzman-rosa-elia", "Padilla Fierro Román Alfredo": "padilla-fierro-roman-alfredo", "Dorador Pérez Gavilán Rodolfo": "dorador-perez-gavilan-rodolfo", "Mejía Berdeja Ricardo Sóstenes": "mejia-berdeja-ricardo-sostenes", "Barrera Estrada Rodimiro": "barrera-estrada-rodimiro", "Reza Gallegos Rocío Esmeralda": "reza-gallegos-rocio-esmeralda", "Abreu Artiñano Rocío Adriana": "abreu-artinano-rocio-adriana", "López Suárez Roberto": "lopez-suarez-roberto", "López González Roberto": "lopez-gonzalez-roberto", "Brito Lara Tomás": "brito-lara-tomas", "Pacheco Rodríguez Ricardo Fidel": "pacheco-rodriguez-ricardo-fidel", "Villarreal García Ricardo": "villarreal-garcia-ricardo", "López Landero Tomás": "lopez-landero-tomas", "Medina Fierro Ricardo": "medina-fierro-ricardo", "Cantú Garza Ricardo": "cantu-garza-ricardo", "Torres Mercado Tomás": "torres-mercado-tomas", "Morgan Navarrete Tania Margarita": "morgan-navarrete-tania-margarita", "Rincón Chanona Sonia": "rincon-chanona-sonia", "Borges Pasos Teresita de Jesús": "borges-pasos-teresita-de-jesus", "Mojica Morga Teresa de Jesús": "mojica-morga-teresa-de-jesus", "Rellstab Carreto Tanya": "rellstab-carreto-tanya", "Bernal Bolnik Sue Ellen": "bernal-bolnik-sue-ellen", "Mercado Gallegos Sonia Catalina": "mercado-gallegos-sonia-catalina", "Quintana León Socorro de la Luz": "quintana-leon-socorro-de-la-luz", "Aureoles Conejo Silvano": "aureoles-conejo-silvano", "Márquez Velasco Silvia": "marquez-velasco-silvia", "Valanci Buzali Simón": "valanci-buzali-simon", "Chávez Dávalos Sergio Armando": "chavez-davalos-sergio-armando", "Blanco Deaquino Silvano": "blanco-deaquino-silvano", "De la Rosa Peláez Sebastián Alfonso": "de-la-rosa-pelaez-sebastian-alfonso", "Ortiz García Salvador": "ortiz-garcia-salvador", "Chan Lugo Sergio Augusto": "chan-lugo-sergio-augusto", "Arellano Guzmán Salvador": "arellano-guzman-salvador", "Juan Marcos Issa Salomón": "juan-marcos-issa-salomon", "Gurrión Matías Samuel": "gurrion-matias-samuel", "Barajas Del Toro Salvador": "barajas-del-toro-salvador", "Romero Valencia Salvador": "romero-valencia-salvador", "Carreón Cervantes Verónica": "carreon-cervantes-veronica", "Zavaleta Salgado Ruth": "zavaleta-salgado-ruth", "Juárez Piña Verónica Beatriz": "juarez-pina-veronica-beatriz", "González Bautista Valentín": "gonzalez-bautista-valentin", "Flores Aguayo Uriel": "flores-aguayo-uriel", "Morales Vargas Trinidad Secundino": "morales-vargas-trinidad-secundino", "García Reyes Verónica": "garcia-reyes-veronica", "Díaz Palacios Víctor Emanuel": "diaz-palacios-victor-emanuel", "Portillo Martínez Vicario": "portillo-martinez-vicario", "Sada Pérez Verónica": "sada-perez-veronica", "Fuentes Solís Víctor Oswaldo": "fuentes-solis-victor-oswaldo", "Bautista López Víctor Manuel": "bautista-lopez-victor-manuel", "González Manríquez Víctor Rafael": "gonzalez-manriquez-victor-rafael", "Jorrín Lozano Víctor Manuel": "jorrin-lozano-victor-manuel", "Manríquez González Víctor Manuel": "manriquez-gonzalez-victor-manuel", "Nájera Medina Víctor Reymundo": "najera-medina-victor-reymundo", "Serralde Martínez Víctor": "serralde-martinez-victor", "Velasco Orozco Víctor Hugo": "velasco-orozco-victor-hugo", "Sosa Altamira William Renan": "sosa-altamira-william-renan", "Ochoa Gallegos Williams Oswaldo": "ochoa-gallegos-williams-oswaldo", "Azuara Zúñiga Xavier": "azuara-zuniga-xavier", "Hernández Tapia Gerardo Xavier": "hernandez-tapia-gerardo-xavier", "Copete Zapot Yazmin de los Ángeles": "copete-zapot-yazmin-de-los-angeles", "Nolasco Ramírez Yesenia": "nolasco-ramirez-yesenia", "Pazzi Maza Zita Beatriz": "pazzi-maza-zita-beatriz", "Huidobro González Zuleyma": "huidobro-gonzalez"}
		jQuery("input#nombre-representante").autocomplete({
		 	source: ["Botello Montes José Alfredo","Pérez de Alba José Noel","Villalobos Seañez Jorge Iván","Anaya Llamas José Guillermo","Ávila Pérez José Angel","Benavides Castañeda José Alberto","Doger Guerrero José Enrique","Caamal Mena José Angelino","Coronato Rodríguez José Francisco","Gastélum Buenrostro Juan Manuel","Escajeda Jiménez José Rubén","López Cisneros José Martín","Esquivel Zalpa José Luis","Llanas Alba José Alejandro","Hurtado Gallegos José Antonio","Moreno Árcega José Isidro","Oliveros Usabiaga José Luis","Maldonado Salgado José Valentín","Muñoz Soria José Luis","Pérez de Alba José Noel","Rangel Espinosa José","Reina Lizárraga José Enrique","Rojo García de Alba José Antonio","Salinas Garza José Arturo","Mejía Guardado Julisa","Moreno Rivera Julio César","Samperio Montaño Juan Ignacio","Bonilla Jaime Juana","Uribe Padilla Juan Carlos","Lorenzini Rangel Julio César","Flemate Ramírez Julio César","Fócil Pérez Juan Manuel","Guerrero López Judit Magdalena","Del Bosque Márquez Juan Isidro","Rocha Piedra Juan Manuel","Muñoz Márquez Juan Carlos","Flores Gómez José Luis Cruz","Cáceres de la Fuente Juan Francisco","Martínez Martínez Juan Luis","Bueno Torio Juan","Carbajal Hernández Juan Manuel","Adame Alemán Juan Pablo","Soto Martínez José","Aquino Calvo Juan Jesús","Salinas Pérez Josefina","Labastida Sotelo Karina","Aguilar Gil Lilia","García Hernández Josefina","Vega Vázquez José Humberto","Valle Magaña José Luis","Trejo Reyes José Isabel","Athie Flores Kamel","Alcalá Padilla Leobardo","Quiroga Anguiano Karen","Calderón Ramírez Leticia","Berzunza Novelo Landy Margarita","Barrera Fortoul Laura","Martel Cantú Laura Ximena","Vargas Vargas Laura Guadalupe","Pantoja Hernández Leslie","Gómez Gómez Luis","Romero Sevilla Leonor","Sánchez Cruz Leopoldo","Rosas Montero Lizbeth Eugenia","Mendoza Curiel María Leticia","Gamboa Song Lizbeth Loy","Campos Córdova Lisandro Arístides","López Landero Leticia","Méndez Denis Lorena","Valles Sampedro Lorenia Iveth","Ortíz Ahlf Loretta","Ramírez Romero Luis Miguel","Villarreal García Luis Alberto","Quiñones Canales Lourdes Eulalia","Garfias Gutiérrez Lucila","Aldana Prieto Luis Ricardo","Arias Pallares Luis Manuel","Murguía Lardizabal Luis Alfredo","Córdova Díaz Luis Armando","Bernal Gutiérrez Andrés Marco Antonio","Espinosa Cházaro Luis Ángel Xariel","Olvera Correa Luis","Garza Ruvalcaba Marcelo","Alcalde Luján Luisa María","González Roldán Luis Antonio","Núñez Monreal Magdalena del Socorro","Mícher Camarena Martha Lucía","Añorve Baños Manuel","Orta Coronado Marcelina","Beltrones Rivera Manlio Fabio","Torres Cofiño Marcelo de Jesús","Huerta Ladrón de Guevara Manuel Rafael","Calzada Arroyo Marco Antonio","Licea González Margarita","González Valdez Marco Antonio","Barba Mariscal Marco Antonio","Aguilar Vega Marcos","Vela Reyes Marco Alonso","Velázquez Díaz María Guadalupe","Medina Filigrana Marcos Rosendo","Romero Lozano María Fernanda","Ortiz Mantilla María Isabel","Pariente Gavito María del Rosario de Fátima","Schroeder Verdugo María Fernanda","Urciel Castañeda María Celia","Corona Nakamura María del Rocío","Sánchez Santiago María Guadalupe","Villaseñor Vargas María de la Paloma","Zavala Peniche María Beatriz","García Fernández María de las Nieves","García Olmedo María del Rocío","Magaña Zepeda María Angélica","Moctezuma Oviedo María Guadalupe","Ordaz Martínez María del Carmen","García de la Cadena Romero María del Carmen","Merlín García María del Rosario","Huerta Rea María de Jesús","Ceseñas Chapa María del Socorro","Garza Moreno María Esther","Cerda Franco María Sanjuana","Cabañas Aparicio María Elia","Amaya Reyes María de Lourdes","Tapia Fonllem Margarita Elena","Saldaña Hernández Margarita","Mejía García Leticia","Bautista Villegas Óscar","De León Pérez María Eugenia","Araujo de la Torre Elsa Patricia","Peña Recio Patricia Guadalupe","Niaves López Ossiel Omar","Lugo Barriga Patricia","Retamoza Vega Patricia Elena","Guzmán Cervantes Carlos Bernardo","González Domínguez Isela","Correa Acevedo Abraham","Flores Treviño María de Lourdes","Velázquez López Mirna","López Birlain Ana Paola","Ponce Orozco Norma","Jiménez Esquivel María Teresa","Barrueta Barón Noé","Fujiwara Montelongo René Ricardo","Hernández González Noé","Gordillo Castillo Néstor Octavio","Moreno Cárdenas Rafael Alejandro","Ochoa López Nabor","Vargas Pérez Nelly del Carmen","Vázquez Saut Regina","Monreal Ávila Ricardo","García de la Fuente Mónica","Astudillo Suárez Ricardo","King de la Rosa Raymundo","Terán Guevara María Rebeca","Paz Alonzo Raúl","Macías Sandoval Raúl","López López Raudel","Gómez Ramírez Raúl","Galván Villanueva Raúl Santos","Micalco Méndez Rafael Alejandro","Sampayo Ortiz Ramón Antonio","Carpinteyro Calderón Purificación","Félix Hays Rubén Benjamín","Montalvo Hernández Ramón","Acosta Montoya Rubén","González Reséndiz Rafael","Barrera Barrera Petra","Acosta Croda Rafael","Moreno Montoya José Pilar","Porras Pérez Pedro","Treviño Villarreal Pedro Pablo","Camarillo Ortega Rubén","Flores Sandoval Patricio","Gómez Gómez Pedro","Domínguez Zepeda Pedro Ignacio","Luna Porquillo Roxana","Chávez Contreras Rodrigo","Ruíz Moronatti Roberto","Reyes Gámiz Roberto Carlos","Gómez Olguín Roy Argel","Gualito Castañeda Rosalba","Serrano Toledo Rosendo","De la Cruz Requena Rosalba","Pérez Hernández Rosa Elba","Romero Guzmán Rosa Elia","Padilla Fierro Román Alfredo","Dorador Pérez Gavilán Rodolfo","Mejía Berdeja Ricardo Sóstenes","Barrera Estrada Rodimiro","Reza Gallegos Rocío Esmeralda","Abreu Artiñano Rocío Adriana","López Suárez Roberto","López González Roberto","Brito Lara Tomás","Pacheco Rodríguez Ricardo Fidel","Villarreal García Ricardo","López Landero Tomás","Medina Fierro Ricardo","Cantú Garza Ricardo","Torres Mercado Tomás","Morgan Navarrete Tania Margarita","Rincón Chanona Sonia","Borges Pasos Teresita de Jesús","Mojica Morga Teresa de Jesús","Rellstab Carreto Tanya","Bernal Bolnik Sue Ellen","Mercado Gallegos Sonia Catalina","Quintana León Socorro de la Luz","Aureoles Conejo Silvano","Márquez Velasco Silvia","Valanci Buzali Simón","Chávez Dávalos Sergio Armando","Blanco Deaquino Silvano","De la Rosa Peláez Sebastián Alfonso","Ortiz García Salvador","Chan Lugo Sergio Augusto","Arellano Guzmán Salvador","Juan Marcos Issa Salomón","Gurrión Matías Samuel","Barajas Del Toro Salvador","Romero Valencia Salvador","Carreón Cervantes Verónica","Zavaleta Salgado Ruth","Juárez Piña Verónica Beatriz","González Bautista Valentín","Flores Aguayo Uriel","Morales Vargas Trinidad Secundino","García Reyes Verónica","Díaz Palacios Víctor Emanuel","Portillo Martínez Vicario","Sada Pérez Verónica","Fuentes Solís Víctor Oswaldo","Bautista López Víctor Manuel","González Manríquez Víctor Rafael","Jorrín Lozano Víctor Manuel","Manríquez González Víctor Manuel","Nájera Medina Víctor Reymundo","Serralde Martínez Víctor","Velasco Orozco Víctor Hugo","Sosa Altamira William Renan","Ochoa Gallegos Williams Oswaldo","Azuara Zúñiga Xavier","Hernández Tapia Gerardo Xavier","Copete Zapot Yazmin de los Ángeles","Nolasco Ramírez Yesenia","Pazzi Maza Zita Beatriz","Huidobro González Zuleyma"]
			
			, select: function( event, ui ) {
				var slug = rep_obj[ui.item.value]
				window.location.href = "/representantes/" + slug
			}
		});

	});
</script>


<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<style>
	#map {  border-top: 2px solid #48265C; border-bottom: 2px solid #48265C;}
	#loading-gif { z-index:100; position:fixed; top:30%; left:40%; }
</style>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/estados.geojson.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/leaflet-pip.min.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/init-ubica.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/representatives.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready( function () {
		setMap();
	});
</script>
