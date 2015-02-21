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

		.senadores{
			margin-top: 20px;
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
		    width: 51px;
		}

}


  	</style>
  	

	<?php if( empty($_GET) ) { ?>
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
					<div class="diputados">
						<h1> Diputados </h1>
						<div class="map-info-representante-mayoria"></div>
						<div class="map-info-representante-proporcional"></div>
					</div>
					<div class="senadores">
						<h1> Senadores </h1>
						<div class="map-info-representante-mayoria"></div>
						<div class="map-info-representante-minoria"></div>
					</div>
				</div>
				<div id="map"></div>
			</div>
		</div>
		<!-- fin mapa de representantes-->
	</div>
	<?php } ?>
	<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		<!-- titulo-->
		<div class="container top60">
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
		<div class="container top40">
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
													<span><?php echo $initiatives["count"];?></span> Iniciativas en Curul501
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
													<span><?php echo $initiatives["count"];?></span> Iniciativas en Curul501
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
		
		/* Buscador por nombre*/
		var rep_obj = {"Abreu Artiñano Rocío Adriana": "abreu-artinano-rocio-adriana", "Aceves del Olmo Carlos Humberto": "aceves-del-olmo-carlos-humberto", "Acosta Croda Rafael": "acosta-croda-rafael", "Acosta Islas Anabel": "acosta-islas-anabel", "Acosta Montoya Rubén": "acosta-montoya-ruben", "Acosta Peña Brasil Alberto": "acosta-pena-brasil-alberto", "Adame Alemán Juan Pablo": "adame-aleman-juan-pablo", "Aguayo López Miguel Ángel": "aguayo-lopez-miguel-angel", "Águila Torres Claudia Elena": "aguila-torres-claudia-elena", "Aguilar Gil Lilia": "aguilar-gil-lilia", "Aguilar Rodríguez Aurora de la Luz": "aguilar-rodriguez-aurora-de-la-luz", "Aguilar Vega Marcos": "aguilar-vega-marcos", "Aispuro Torres José Rosas": "aispuro-torres-jos-rosas-b", "Alavez Ruiz Aleida": "alavez-ruiz-aleida", "Albores Gleason Roberto Armando": "albores-gleason-roberto-armando", "Alcalá Padilla Leobardo": "alcala-padilla-leobardo", "Alcalá Ruiz Blanca María del Socorro": "alcala-ruiz-blanca-maria-del-socorro", "Alcalde Luján Luisa María": "alcalde-lujan-luisa-maria", "Aldana Prieto Luis Ricardo": "aldana-prieto-luis-ricardo", "Algredo Jaramillo Edilberto": "algredo-jaramillo-edilberto", "Allende Cano Ana Isabel": "allende-cano-ana-isabel", "Almaguer Torres Felipe de Jesús": "almaguer-torres-felipe-de-jesus", "Alonso Morelli Humberto": "alonso-morelli-humberto", "Alonso Raya Agustín Miguel": "alonso-raya-agustin-miguel", "Alvarado Sánchez Brenda María Izontli": "alvarado-sanchez-brenda-maria-izontli", "Álvarez Tovar Martha Berenice": "alvarez-tovar-martha-berenice", "Amador Gaxiola Daniel": "amador-gaxiola-daniel", "Amaya Reyes María de Lourdes": "amaya-reyes-maria-de-lourdes", "Anaya Gudiño Alfredo": "anaya-gudino-alfredo", "Anaya Gutiérrez Alberto": "anaya-gutierrez-alberto", "Anaya Llamas José Guillermo": "anaya-llamas-jose-guillermo", "Angulo Parra Carlos Fernando": "angulo-parra-carlos-fernando", "Añorve Baños Manuel": "anorve-banos-manuel", "Antonio Altamirano Carol": "antonio-altamirano-carol", "Aquino Calvo Juan Jesús": "aquino-calvo-juan-jesus", "Araujo de la Torre Elsa Patricia": "araujo-de-la-torre-elsa-patricia", "Araujo Lara Angélica del Rosario": "araujo-lara-angelica-del-rosario", "Aréchiga Ávila Jorge": "arechiga-avila-jorge", "Arellano Guzmán Salvador": "arellano-guzman-salvador", "Argüelles Loya Consuelo": "arguelles-loya-consuelo", "Arias Pallares Luis Manuel": "arias-pallares-luis-manuel", "Arriola Gordillo Mónica Tzasna": "arriola-gordillo-monica-tzasna", "Arroyo Ruiz Alma Jeanny": "arroyo-ruiz-alma-jeanny", "Arroyo Vieyra Francisco Agustín": "arroyo-vieyra-francisco-agustin", "Astiazarán Gutiérrez Antonio Francisco": "astiazaran-gutierrez-antonio-francisco", "Astudillo Suárez Ricardo": "astudillo-suarez-ricardo", "Athie Flores Kamel": "athie-flores-kamel", "Aubry de Castro Palomino Enrique": "aubry-de-castro-palomino-enrique", "Aureoles Conejo Silvano": "aureoles-conejo-silvano", "Ávila Pérez José Angel": "avila-perez-jose-angel", "Ávila Ruiz Daniel Gabriel": "avila-ruiz-daniel-gabriel", "Ávila Ruiz Daniel Gabriel": "avila-ruiz-daniel-gabriel", "Ayala Almeida Joel": "ayala-almeida-joel", "Ayala Almeida Joel": "ayala-almeida-joel", "Ayala Robles Linares Flor de Rosa": "ayala-robles-linares-flor-de-rosa", "Azuara Zúñiga Xavier": "azuara-zuniga-xavier", "Badillo Ramírez Darío": "badillo-ramirez-dario", "Barajas Del Toro Salvador": "barajas-del-toro-salvador", "Barba Mariscal Marco Antonio": "barba-mariscal-marco-antonio", "Barbosa Huerta Luis Miguel Gerónimo": "barbosa-huerta-luis-miguel-geronimo", "Barbosa Huerta Luis Miguel Gerónimo": "barbosa-huerta-luis-miguel-geronimo", "Barcenas Nieves Delvim Fabiola": "barcenas-nieves-delvim-fabiola", "Barrales Magdaleno María Alejandra": "barrales-magdaleno-maria-alejandra", "Barrera Barrera Petra": "barrera-barrera-petra", "Barrera Estrada Rodimiro": "barrera-estrada-rodimiro", "Barrera Fortoul Laura": "barrera-fortoul-laura", "Barrera Tapia María Elena": "barrera-tapia-maria-elena", "Barrios Gómez Segués Agustín": "barrios-gomez-segues-agustin", "Barrueta Barón Noé": "barrueta-baron-noe", "Bartlett Díaz Manuel": "bartlett-diaz-manuel", "Bautista Bravo Alliet Mariana": "bautista-bravo-alliet-mariana", "Bautista Cuevas Gloria": "bautista-cuevas-gloria", "Bautista López Víctor Manuel": "bautista-lopez-victor-manuel", "Bautista Villegas Óscar": "bautista-villegas-oscar", "Belaunzarán Méndez Fernando": "belaunzaran-mendez-fernando", "Beltrones Rivera Manlio Fabio": "beltrones-rivera-manlio-fabio", "Benavides Castañeda José Alberto": "benavides-castaneda-jose-alberto", "Beristain Navarrete Luz María": "beristain-navarrete-luz-maria", "Bernal Bolnik Sue Ellen": "bernal-bolnik-sue-ellen", "Bernal Gutiérrez Andrés Marco Antonio": "bernal-gutierrez-andres-marco-antonio", "Berzunza Novelo Landy Margarita": "berzunza-novelo-landy-margarita", "Blanco Deaquino Silvano": "blanco-deaquino-silvano", "Blásquez Salinas Marco Antonio": "blasquez-salinas-marco-antonio", "Bojórquez Javier Claudia Elizabeth": "bojorquez-javier-claudia-elizabeth", "Bonilla Gómez Adolfo": "bonilla-gomez-adolfo", "Bonilla Jaime Juana": "bonilla-jaime-juana", "Bonilla Valdez Jaime": "bonilla-valdez-jaime", "Borges Pasos Teresita de Jesús": "borges-pasos-teresita-de-jesus", "Botello Montes José Alfredo": "botello-montes-jose-alfredo", "Bribiesca Sahagún Fernando": "bribiesca-sahagun-fernando", "Brito Lara Tomás": "brito-lara-tomas", "Bueno Torio Juan": "bueno-torio-juan", "Burgos García Enrique": "burgos-garcia-enrique", "Búrquez Valenzuela Francisco de Paula": "burquez-valenzuela-francisco-de-paula", "Caamal Mena José Angelino": "caamal-mena-jose-angelino", "Caballero Garza Benito": "caballero-garza-benito", "Cabañas Aparicio María Elia": "cabanas-aparicio-maria-elia", "Cáceres de la Fuente Juan Francisco": "caceres-de-la-fuente-juan-francisco", "Calderón Hinojosa Luisa María de Guadalupe": "calderon-hinojosa-luisa-maria-de-guadalupe", "Calderón Ramírez Leticia": "calderon-ramirez-leticia", "Calzada Arroyo Marco Antonio": "calzada-arroyo-marco-antonio", "Camacho Solís Víctor Manuel": "camacho-solis-victor-manuel", "Camarena García Felipe Arturo": "camarena-garcia-felipe-arturo", "Camarillo Ortega Rubén": "camarillo-ortega-ruben", "Campos Córdova Lisandro Arístides": "campos-cordova-lisandro-aristides", "Cantú Garza Ricardo": "cantu-garza-ricardo", "Cantú Segovia Eloy": "cantu-segovia-eloy", "Carbajal González Alejandro": "carbajal-gonzalez-alejandro", "Carbajal Hernández Juan Manuel": "carbajal-hernandez-juan-manuel", "Cárdenas Cantú Miriam": "cardenas-cantu-miriam", "Cárdenas Del Avellano Enrique": "cardenas-del-avellano-enrique", "Cárdenas Guízar Gabriel de Jesús": "cardenas-guizar-gabriel-de-jesus", "Carpinteyro Calderón Purificación": "carpinteyro-calderon-purificacion", "Carreño Mijares Angelina": "carreno-mijares-angelina", "Carreño Muro Genaro": "carreno-muro-genaro", "Carreón Cervantes Verónica": "carreon-cervantes-veronica", "Carrillo Huerta Mario Miguel": "carrillo-huerta-mario-miguel", "Casillas Romero Jesús": "casillas-romero-jesus", "Castaños Valenzuela Carlos Humberto": "castanos-valenzuela-carlos-humberto", "Castellanos Mijares Carlos Octavio": "castellanos-mijares-carlos-octavio", "Castillo Rodríguez Minerva": "castillo-rodriguez-minerva", "Castillo Valdez Benjamín": "castillo-valdez-benjamin", "Cavazos Lerma Manuel": "cavazos-lerma-manuel", "Cedillo Hernández Ángel": "cedillo-hernandez-angel", "Cerda Franco María Sanjuana": "cerda-franco-maria-sanjuana", "Ceseña Burgoin Ángel Salvador": "cesena-burgoin-angel-salvador", "Ceseñas Chapa María del Socorro": "cesenas-chapa-maria-del-socorro", "Chan Lugo Sergio Augusto": "chan-lugo-sergio-augusto", "Charleston Hernández Fernando": "charleston-hernandez-fernando", "Chávez Contreras Rodrigo": "chavez-contreras-rodrigo", "Chávez Dávalos Sergio Armando": "chavez-davalos-sergio-armando", "Chico Herrera Miguel Ángel": "chico-herrera-miguel-angel", "Contreras Ceballos Armando": "contreras-ceballos-armando", "Copete Zapot Yazmin de los Ángeles": "copete-zapot-yazmin-de-los-angeles", "Cordero Arroyo Ernesto Javier": "cordero-arroyo-ernesto-javier", "Córdova Bernal Martha Beatriz": "cordova-bernal-martha-beatriz", "Córdova Díaz Luis Armando": "cordova-diaz-luis-armando", "Córdova Morán Frine Soraya": "cordova-moran-frine-soraya", "Corona Nakamura María del Rocío": "corona-nakamura-maria-del-rocio", "Coronado Quintanilla Alberto": "coronado-quintanilla-alberto", "Coronato Rodríguez José Francisco": "coronato-rodriguez-jose-francisco", "Corral Jurado Javier": "corral-jurado-javier", "Corrales Corrales Francisca Elena": "corrales-corrales-francisca-elena", "Correa Acevedo Abraham": "correa-acevedo-abraham", "Cortázar Lara Gerardo Maximiliano": "cortazar-lara-gerardo-maximiliano", "Cortés Berumen Isaías": "cortes-berumen-isaias", "Cota Jiménez Manuel Humberto": "cota-jimenez-manuel-humberto", "Cruz Mendoza Eufrosina": "cruz-mendoza-eufrosina", "Cruz Morales Maricruz": "cruz-morales-maricruz", "Cruz Ramírez Arturo": "cruz-ramirez-arturo", "Cuéllar Cisneros Lorena": "cuellar-cisneros-lorena", "Cuéllar Reyes Fernando": "cuellar-reyes-fernando", "Cuéllar Steffan Antonio": "cuellar-steffan-antonio", "Cuevas Barrón Gabriela": "cuevas-barron-gabriela", "Cuevas Mena Mario Alejandro": "cuevas-mena-mario-alejandro", "Curi Naime Alberto": "curi-naime-alberto", "Dávila Delgado Mario Alberto": "davila-delgado-mario-alberto", "Dávila Fernández Adriana": "davila-fernandez-adriana", "De Jesús Alejandro Carlos": "de-jesus-alejandro-carlos", "De la Cruz Requena Rosalba": "de-la-cruz-requena-rosalba", "De la Peña Gómez Angélica": "de-la-pena-gomez-angelica", "De la Rosa Anaya Andrés": "de-la-rosa-anaya-andres", "De la Rosa Escalante Arturo": "de-la-rosa-escalante-arturo", "De la Rosa Peláez Sebastián Alfonso": "de-la-rosa-pelaez-sebastian-alfonso", "De la Vega Membrillo Jorge Federico": "de-la-vega-membrillo-jorge-federico", "De las Fuentes Hernández Fernando Donato": "de-las-fuentes-hernandez-fernando-donato", "De León Pérez María Eugenia": "de-leon-perez-maria-eugenia", "Del Ángel Acosta Jorge": "del-angel-acosta-jorge", "Del Bosque Márquez Juan Isidro": "del-bosque-marquez-juan-isidro", "Del Moral Vela Paulina Alejandra": "del-moral-vela-paulina-alejandra", "Delgadillo González Claudia": "delgadillo-gonzalez-claudia", "Demédicis Hidalgo Fidel": "demedicis-hidalgo-fidel", "Díaz Athié Antonio de Jesús": "diaz-athie-antonio-de-jesus", "Díaz Lizama Rosa Adriana": "diaz-lizama-rosa-adriana", "Díaz Palacios Víctor Emanuel": "diaz-palacios-victor-emanuel", "Díaz Salazar María Cristina": "diaz-salazar-maria-cristina", "Díaz Trujillo Alberto": "diaz-trujillo-alberto", "Diego Cruz Eva": "diego-cruz-eva", "Doger Guerrero José Enrique": "doger-guerrero-jose-enrique", "Domínguez Servién Francisco": "dominguez-servien-francisco", "Domínguez Zepeda Pedro Ignacio": "dominguez-zepeda-pedro-ignacio", "Dorador Pérez Gavilán Rodolfo": "dorador-perez-gavilan-rodolfo", "Duarte Murillo José Ignacio": "duarte-murillo-jose-ignacio", "Duarte Ortuño Catalino": "duarte-ortuno-catalino", "Durazo Montaño Francisco Alfonso": "durazo-montano-francisco-alfonso", "Encinas Rodríguez Alejandro de Jesús": "encinas-rodriguez-alejandro-de-jesus", "Escajeda Jiménez José Rubén": "escajeda-jimenez-jose-ruben", "Escobar y Vega Arturo": "escobar-y-vega-arturo", "Escudero Morales Pablo": "escudero-morales-pablo", "Espinosa Cházaro Luis Ángel Xariel": "espinosa-chazaro-luis-angel-xariel", "Esquivel Zalpa José Luis": "esquivel-zalpa-jose-luis", "Fayad Meneses Omar": "fayad-meneses-omar", "Félix Chávez Faustino Francisco": "felix-chavez-faustino-francisco", "Félix Hays Rubén Benjamín": "felix-hays-ruben-benjamin", "Fernández Aguirre Braulio Manuel": "fernandez-aguirre-braulio-manuel", "Fernández Clamont Francisco Javier": "fernandez-clamont-francisco-javier", "Fernández Sánchez Navarro Juan Alejandro": "fernandez-sanchez-navarro-juan-alejandro", "Flemate Ramírez Julio César": "flemate-ramirez-julio-cesar", "Flores Aguayo Uriel": "flores-aguayo-uriel", "Flores Escalera Hilda Esthela": "flores-escalera-hilda-esthela", "Flores Flores Enrique Alejandro": "flores-flores-enrique-alejandro", "Flores Gómez José Luis Cruz": "flores-gomez-jose-luis-cruz", "Flores Méndez José Luis": "flores-mendez-jose-luis", "Flores Ramírez Juan Gerardo": "flores-ramirez-juan-gerardo", "Flores Salazar Guadalupe Socorro": "flores-salazar-guadalupe-socorro", "Flores Sánchez Margarita": "flores-sanchez-margarita", "Flores Sandoval Patricio": "flores-sandoval-patricio", "Flores Treviño María de Lourdes": "flores-trevino-maria-de-lourdes", "Fócil Pérez Juan Manuel": "focil-perez-juan-manuel", "Fuentes Solís Víctor Oswaldo": "fuentes-solis-victor-oswaldo", "Fuentes Téllez Adriana": "fuentes-tellez-adriana", "Fujiwara Montelongo René Ricardo": "fujiwara-montelongo-rene-ricardo", "Funes Velázquez Erika Yolanda": "funes-velazquez-erika-yolanda", "Galindo Delgado David Cuauhtémoc": "galindo-delgado-david-cuauhtemoc", "Galindo Quiñones Heriberto Manuel": "galindo-quinones-heriberto-manuel", "Galván Villanueva Raúl Santos": "galvan-villanueva-raul-santos", "Gamboa Patrón Emilio Antonio": "gamboa-patron-emilio-antonio", "Gamboa Song Lizbeth Loy": "gamboa-song-lizbeth-loy", "Gándara Camou Ernesto": "gandara-camou-ernesto", "Garay Cabada Marina": "garay-cabada-marina", "García Cabeza de Vaca Francisco Javier": "garcia-cabeza-de-vaca-francisco-javier", "García Conejo Antonio": "garcia-conejo-antonio", "García de la Cadena Romero María del Carmen": "garcia-de-la-cadena-romero-maria-del-carmen", "García de la Fuente Mónica": "garcia-de-la-fuente-monica", "García Fernández María de las Nieves": "garcia-fernandez-maria-de-las-nieves", "García García Héctor": "garcia-garcia-hector", "García Gómez Martha Elena": "garcia-gomez-martha-elena", "García González Carlos Alberto": "garcia-gonzalez-carlos-alberto", "García Hernández Josefina": "garcia-hernandez-josefina", "García Medina Amalia Dolores": "garcia-medina-amalia-dolores", "García Olmedo María del Rocío": "garcia-olmedo-maria-del-rocio", "García Ramírez José Guadalupe": "garcia-ramirez-jose-guadalupe", "García Reyes Verónica": "garcia-reyes-veronica", "García Rojas Mariana Dunyaska": "garcia-rojas-mariana-dunyaska", "Garfias Gutiérrez Lucila": "garfias-gutierrez-lucila", "Garza Cadena Ana Lilia": "garza-cadena-ana-lilia", "Garza Galván Silvia Guadalupe": "garza-galvan-silvia-guadalupe", "Garza Moreno María Esther": "garza-moreno-maria-esther", "Garza Ruvalcaba Marcelo": "garza-ruvalcaba-marcelo", "Gastélum Bajo Diva Hadamira": "gastelum-bajo-diva-hadamira", "Gastélum Buenrostro Juan Manuel": "gastelum-buenrostro-juan-manuel", "Gaudiano Rovirosa Gerardo": "gaudiano-rovirosa-gerardo", "Gauna Ruiz de León Celia Isabel": "gauna-ruiz-de-leon-celia-isabel", "Gil Zuarth Roberto": "gil-zuarth-roberto", "Gómez Carmona Blanca Estela": "gomez-carmona-blanca-estela", "Gómez del Campo Gurza Mariana": "gomez-del-campo-gurza-mariana", "Gómez Gómez Luis": "gomez-gomez-luis", "Gómez Gómez Pedro": "gomez-gomez-pedro", "Gómez González Arely": "gomez-gonzalez-arely", "Gómez Olguín Roy Argel": "gomez-olguin-roy-argel", "Gómez Pozos Merilyn": "gomez-pozos-merilyn", "Gómez Ramírez Raúl": "gomez-ramirez-raul", "Gómez Tueme Amira Gricelda": "gomez-tueme-amira-gricelda", "González Bautista Valentín": "gonzalez-bautista-valentin", "González Canto Félix Arturo": "gonzalez-canto-felix-arturo", "González Carrillo Adriana": "gonzalez-carrillo-adriana", "González Cruz Cristina": "gonzalez-cruz-cristina", "González Cuevas Isaías": "gonzalez-cuevas-isaias", "González Domínguez Isela": "gonzalez-dominguez-isela", "González Farías Eligio Cuitláhuac": "gonzalez-farias-eligio-cuitlahuac", "González Gómez Cecilia": "gonzalez-gomez-cecilia", "González Luna Bueno Federico José": "gonzalez-luna-bueno-federico-jose", "González Magallanes Alfa Eliana": "gonzalez-magallanes-alfa-eliana", "González Manríquez Víctor Rafael": "gonzalez-manriquez-victor-rafael", "González Martínez Olivares Irazema": "gonzalez-martinez-olivares-irazema", "González Morfín José": "gonzalez-morfin-jose", "González Reséndiz Rafael": "gonzalez-resendiz-rafael", "González Roldán Luis Antonio": "gonzalez-roldan-luis-antonio", "González Serna José Ángel": "gonzalez-serna-jose-angel", "González Valdez Marco Antonio": "gonzalez-valdez-marco-antonio", "González Vargas Francisco": "gonzalez-vargas-francisco", "Gordillo Castillo Néstor Octavio": "gordillo-castillo-nestor-octavio", "Gracia Guzmán Raúl": "gracia-guzman-raul", "Grajales Palacios Francisco": "grajales-palacios-francisco", "Gualito Castañeda Rosalba": "gualito-castaneda-rosalba", "Guerra Castillo Marcela": "guerra-castillo-marcela", "Guerra Garza Abel": "guerra-garza-abel", "Guerrero López Judit Magdalena": "guerrero-lopez-judit-magdalena", "Guevara Espinoza Ana Gabriela": "guevara-espinoza-ana-gabriela", "Guevara González Javier Filiberto": "guevara-gonzalez-javier-filiberto", "Guillén Guillén Mario Francisco": "guillen-guillen-mario-francisco", "Gurrión Matías Samuel": "gurrion-matias-samuel", "Gutiérrez Álvarez Harvey": "gutierrez-alvarez-harvey", "Gutiérrez de la Garza Héctor Humberto": "gutierrez-de-la-garza-hector-humberto", "Gutiérrez Manrique Martha": "gutierrez-manrique-martha", "Guzmán Cervantes Carlos Bernardo": "guzman-cervantes-carlos-bernardo", "Guzmán Díaz Delfina Elizabeth": "guzman-diaz-delfina-elizabeth", "Heredia Lizárraga Martín Alonso": "heredia-lizarraga-martin-alonso", "Hermosillo y Celada Víctor": "hermosillo-y-celada-victor", "Hernández Burgos Gaudencio": "hernandez-burgos-gaudencio", "Hernández Deras Ismael Alfredo": "hernandez-deras-ismael-alfredo", "Hernández González Noé": "hernandez-gonzalez-noe", "Hernández Íñiguez Adriana": "hernandez-iniguez-adriana", "Hernández Lecona Lisbeth": "hernandez-lecona-lisbeth", "Hernández Morales Mirna Esmeralda": "hernandez-morales-mirna-esmeralda", "Hernández Tapia Gerardo Xavier": "hernandez-tapia-gerardo-xavier", "Herrera Ale Juana Leticia": "herrera-ale-juana-leticia", "Herrera Anzaldo Ana Lilia": "herrera-anzaldo-ana-lilia", "Herrera Ávila Fernando": "herrera-avila-fernando", "Herrera Delgado Jorge": "herrera-delgado-jorge", "Huerta Ladrón de Guevara Manuel Rafael": "huerta-ladron-de-guevara-manuel-rafael", "Huerta Rea María de Jesús": "huerta-rea-maria-de-jesus", "Huidobro González Zuleyma": "huidobro-gonzalez-zuleyma", "Hurtado Gallegos José Antonio": "hurtado-gallegos-jose-antonio", "Inzunza Montoya Alfonso": "inzunza-montoya-alfonso", "Irízar López Aarón": "irizar-lopez-aaron", "Jardines Fraire Jhonatan": "jardines-fraire-jhonatan", "Jarquín Hugo": "jarquin-hugo", "Jiménez Castillo Blanca": "jimenez-castillo-blanca", "Jiménez Cerrillo Raquel": "jimenez-cerrillo-raquel", "Jiménez Esquivel María Teresa": "jimenez-esquivel-maria-teresa", "Jorrín Lozano Víctor Manuel": "jorrin-lozano-victor-manuel", "Juan Marcos Issa Salomón": "juan-marcos-issa-salomon", "Juárez Cisneros René": "juarez-cisneros-rene", "Juárez Piña Verónica Beatriz": "juarez-pina-veronica-beatriz", "King de la Rosa Raymundo": "king-de-la-rosa-raymundo", "Labastida Sotelo Karina": "labastida-sotelo-karina", "Larios Córdova Héctor": "larios-cordova-hector", "Larrazábal Bretón Fernando Alejandro": "larrazabal-breton-fernando-alejandro", "Lavalle Maury Jorge Luis": "lavalle-maury-jorge-luis", "León Mendívil José Antonio": "leon-mendivil-jose-antonio", "León Montero Saraí Larisa": "leon-montero-sarai-larisa", "Licea González Margarita": "licea-gonzalez-margarita", "Liceaga Arteaga Gerardo Francisco": "liceaga-arteaga-gerardo-francisco", "Llanas Alba José Alejandro": "llanas-alba-jose-alejandro", "López Alvarado Jaime Chris": "lopez-alvarado-jaime-chris", "López Birlain Ana Paola": "lopez-birlain-ana-paola", "López Brito Francisco Salvador": "lopez-brito-francisco-salvador", "López Candido José Arturo": "lopez-candido-jose-arturo", "López Cisneros José Martín": "lopez-cisneros-jose-martin", "López González Roberto": "lopez-gonzalez-roberto", "López Hernández Adán Augusto": "lopez-hernandez-adan-augusto", "López Landero Leticia": "lopez-landero-leticia", "López Landero Tomás": "lopez-landero-tomas", "López López Raudel": "lopez-lopez-raudel", "López Moreno Lourdes Adriana": "lopez-moreno-lourdes-adriana", "López Noriega Alejandra": "lopez-noriega-alejandra", "López Rosado Roberto": "lopez-rosado-roberto", "López Segura María Carmen": "lopez-segura-maria-carmen", "López Suárez Roberto": "lopez-suarez-roberto", "López Zavala Javier": "lopez-zavala-javier", "Lorenzini Rangel Julio César": "lorenzini-rangel-julio-cesar", "Lozano Alarcón Javier": "lozano-alarcon-javier", "Lugo Barriga Patricia": "lugo-barriga-patricia", "Luna Porquillo Roxana": "luna-porquillo-roxana", "Macías Sandoval Raúl": "macias-sandoval-raul", "Madrid Tovilla Areli": "madrid-tovilla-areli", "Magaña Zepeda María Angélica": "magana-zepeda-maria-angelica", "Maldonado Hernández Fernando Alfredo": "maldonado-hernandez-fernando-alfredo", "Maldonado Salgado José Valentín": "maldonado-salgado-jose-valentin", "Manríquez González Víctor Manuel": "manriquez-gonzalez-victor-manuel", "Márquez Martínez José Luis": "marquez-martinez-jose-luis", "Márquez Velasco Silvia": "marquez-velasco-silvia", "Martel Cantú Laura Ximena": "martel-cantu-laura-ximena", "Martínez Cárdenas Esther Angélica": "martinez-cardenas-esther-angelica", "Martínez García Patricio": "martinez-garcia-patricio", "Martínez Martínez José María": "martinez-martinez-jose-maria", "Martínez Martínez Juan Luis": "martinez-martinez-juan-luis", "Martínez Rojas Andrés Eloy": "martinez-rojas-andres-eloy", "Martínez Santillán María del Carmen": "martinez-santillan-maria-del-carmen", "Mayans Canabal Fernando Enrique": "mayans-canabal-fernando-enrique", "Medina Fierro Ricardo": "medina-fierro-ricardo", "Medina Filigrana Marcos Rosendo": "medina-filigrana-marcos-rosendo", "Medrano Galindo Gabriela": "medrano-galindo-gabriela", "Mejía Berdeja Ricardo Sóstenes": "mejia-berdeja-ricardo-sostenes", "Mejía García Leticia": "mejia-garcia-leticia", "Mejía Guardado Julisa": "mejia-guardado-julisa", "Melgar Bravo Luis Armando": "melgar-bravo-luis-armando", "Méndez Denis Lorena": "mendez-denis-lorena", "Méndez Martínez Mario Rafael": "mendez-martinez-mario-rafael", "Mendoza Curiel María Leticia": "mendoza-curiel-maria-leticia", "Mendoza Garza Jorge": "mendoza-garza-jorge", "Mendoza Mendoza Iris Vianey": "mendoza-mendoza-iris-vianey", "Mercado Gallegos Sonia Catalina": "mercado-gallegos-sonia-catalina", "Merlín García María del Rosario": "merlin-garcia-maria-del-rosario", "Merodio Reza Lilia Guadalupe": "merodio-reza-lilia-guadalupe", "Mestas Gallardo Ignacio": "mestas-gallardo-ignacio", "Micalco Méndez Rafael Alejandro": "micalco-mendez-rafael-alejandro", "Mícher Camarena Martha Lucía": "micher-camarena-martha-lucia", "Miranda Munive Emilse": "miranda-munive-emilse", "Miranda Salgado Marino": "miranda-salgado-marino", "Moctezuma Oviedo María Guadalupe": "moctezuma-oviedo-maria-guadalupe", "Mojica Morga Teresa de Jesús": "mojica-morga-teresa-de-jesus", "Mondragón González María Guadalupe": "mondragon-gonzalez-maria-guadalupe", "Monreal Ávila David": "monreal-avila-david", "Monreal Ávila Ricardo": "monreal-avila-ricardo", "Montalvo Hernández Ramón": "montalvo-hernandez-ramon", "Montano Guzmán José Alejandro": "montano-guzman-jose-alejandro", "Montes Alvarado Abraham": "montes-alvarado-abraham", "Montes Colunga Vianey": "montes-colunga-vianey", "Morales Flores Jesús": "morales-flores-jesus", "Morales López Carlos Augusto": "morales-lopez-carlos-augusto", "Morales Vargas Trinidad Secundino": "morales-vargas-trinidad-secundino", "Moreno Árcega José Isidro": "moreno-arcega-jose-isidro", "Moreno Cárdenas Rafael Alejandro": "moreno-cardenas-rafael-alejandro", "Moreno Montoya José Pilar": "moreno-montoya-jose-pilar", "Moreno Rivera Israel": "moreno-rivera-israel", "Moreno Rivera Julio César": "moreno-rivera-julio-cesar", "Morgan Navarrete Tania Margarita": "morgan-navarrete-tania-margarita", "Morón Orozco Raúl": "moron-orozco-raul", "Mota Ocampo Gisela Raquel": "mota-ocampo-gisela-raquel", "Muñiz Martínez Dulce María": "muniz-martinez-dulce-maria", "Muñoz Kapamas Felipe de Jesús": "munoz-kapamas-felipe-de-jesus", "Muñoz Márquez Juan Carlos": "munoz-marquez-juan-carlos", "Muñoz Soria José Luis": "munoz-soria-jose-luis", "Murguía Lardizabal Luis Alfredo": "murguia-lardizabal-luis-alfredo", "Nájera Medina Víctor Reymundo": "najera-medina-victor-reymundo", "Narcia Álvarez Héctor": "narcia-alvarez-hector", "Nava Gómez José Everardo": "nava-gomez-jose-everardo", "Navarrete Contreras Joaquina": "navarrete-contreras-joaquina", "Navarrete Vital Ma. Concepción": "navarrete-vital-ma-concepcion", "Navarro de Alba César Reynaldo": "navarro-de-alba-cesar-reynaldo", "Neblina Vega Heberto": "neblina-vega-heberto", "Neyra Chávez Armando": "neyra-chavez-armando", "Niaves López Ossiel Omar": "niaves-lopez-ossiel-omar", "Niño de Rivera Vela Homero Ricardo": "nino-de-rivera-vela-homero-ricardo", "Nolasco Ramírez Yesenia": "nolasco-ramirez-yesenia", "Núñez Aguilar Ernesto": "nunez-aguilar-ernesto", "Núñez Monreal Magdalena del Socorro": "nunez-monreal-magdalena-del-socorro", "Núñez Sánchez Gloria Elizabeth": "nunez-sanchez-gloria-elizabeth", "Ochoa Gallegos Williams Oswaldo": "ochoa-gallegos-williams-oswaldo", "Ochoa González Arnoldo": "ochoa-gonzalez-arnoldo", "Ochoa López Nabor": "ochoa-lopez-nabor", "Oliveros Usabiaga José Luis": "oliveros-usabiaga-jose-luis", "Olvera Barrios Cristina": "olvera-barrios-cristina", "Olvera Correa Luis": "olvera-correa-luis", "Oramas Vargas Arquímedes": "oramas-vargas-arquimedes", "Ordaz Martínez María del Carmen": "ordaz-martinez-maria-del-carmen", "Orihuela García Javier": "orihuela-garcia-javier", "Orive Bellinger Adolfo": "orive-bellinger-adolfo", "Orozco Gómez Javier": "orozco-gomez-javier", "Orozco Sandoval Martín": "orozco-sandoval-martin", "Orta Coronado Marcelina": "orta-coronado-marcelina", "Ortega Martínez Ma. del Pilar": "ortega-martinez-ma.-del-pilar", "Ortega Pacheco Guadalupe del Socorro": "ortega-pacheco-guadalupe-del-socorro", "Ortíz Ahlf Loretta": "ortiz-ahlf-loretta", "Ortiz Domínguez Maki Esther": "ortiz-dominguez-maki-esther", "Ortiz García Salvador": "ortiz-garcia-salvador", "Ortiz González Graciela": "ortiz-gonzalez-graciela", "Ortiz Mantilla María Isabel": "ortiz-mantilla-maria-isabel", "Othón Zayas Máximo": "othon-zayas-maximo", "Oviedo Herrera J. Jesús": "oviedo-herrera-j-jesus", "Pacheco Díaz Germán": "pacheco-diaz-german", "Pacheco Rodríguez Ricardo Fidel": "pacheco-rodriguez-ricardo-fidel", "Padierna Luna María de los Dolores": "padierna-luna-maria-de-los-dolores", "Padilla Fierro Román Alfredo": "padilla-fierro-roman-alfredo", "Padilla Navarro Cesario": "padilla-navarro-cesario", "Padilla Ramos Carla Alicia": "padilla-ramos-carla-alicia", "Palafox Gutiérrez Martha": "palafox-gutierrez-martha", "Pantoja Hernández Leslie": "pantoja-hernandez-leslie", "Pariente Gavito María del Rosario de Fátima": "pariente-gavito-maria-del-rosario-de-fatima", "Paz Alonzo Raúl": "paz-alonzo-raul", "Pazzi Maza Zita Beatriz": "pazzi-maza-zita-beatriz", "Pedraza Aguilera Flor de María": "pedraza-aguilera-flor-de-maria", "Pedraza Chávez Isidro": "pedraza-chavez-isidro", "Pedroza Gaitán César Octavio": "pedroza-gaitan-cesar-octavio", "Pelayo Covarrubias Francisco": "pelayo-covarrubias-francisco", "Peña Avilés Gerardo": "pena-aviles-gerardo", "Peña Recio Patricia Guadalupe": "pena-recio-patricia-guadalupe", "Penchyna Grub David": "penchyna-grub-david", "Pérez Anzueto Hugo Mauricio": "perez-anzueto-hugo-mauricio", "Pérez Camarena Carmen Lucía": "perez-camarena-carmen-lucia", "Pérez de Alba José Noel": "perez-de-alba-jose-noel", "Pérez Escalante Elvia María": "perez-escalante-elvia-maria", "Pérez Hernández Rosa Elba": "perez-hernandez-rosa-elba", "Pérez Magaña Eviel": "perez-magana-eviel", "Pérez Tejada Padilla David": "perez-tejada-padilla-david", "Pineda Gochi María del Rocío": "pineda-gochi-maria-del-rocio", "Ponce Orozco Norma": "ponce-orozco-norma", "Porras Pérez Pedro": "porras-perez-pedro", "Portillo Martínez Vicario": "portillo-martinez-vicario", "Posadas Hernández Domitilo": "posadas-hernandez-domitilo", "Pozos Lanz Raúl Aarón": "pozos-lanz-raul-aaron", "Prieto Herrera Humberto Armando": "prieto-herrera-humberto-armando", "Puente Salas Carlos Alberto": "puente-salas-carlos-alberto", "Quian Alcocer Eduardo Román": "quian-alcocer-eduardo-roman", "Quiñones Canales Lourdes Eulalia": "quinones-canales-lourdes-eulalia", "Quintana León Socorro de la Luz": "quintana-leon-socorro-de-la-luz", "Quintana Salinas Esther": "quintana-salinas-esther", "Quiroga Anguiano Karen": "quiroga-anguiano-karen", "Quiroga Tamez Mayela María de Lourdes": "quiroga-tamez-mayela-maria-de-lourdes", "Ramírez Diez Gutiérrez María Concepción": "ramirez-diez-gutierrez-maria-concepcion", "Ramírez Romero Luis Miguel": "ramirez-romero-luis-miguel", "Rangel Espinosa José": "rangel-espinosa-jose", "Rangel Segovia Alejandro": "rangel-segovia-alejandro", "Reina Lizárraga José Enrique": "reina-lizarraga-jose-enrique", "Rellstab Carreto Tanya": "rellstab-carreto-tanya", "Retamoza Vega Patricia Elena": "retamoza-vega-patricia-elena", "Reyes Gámiz Roberto Carlos": "reyes-gamiz-roberto-carlos", "Reyes Montiel Carla Guadalupe": "reyes-montiel-carla-guadalupe", "Reza Gallegos Rocío Esmeralda": "reza-gallegos-rocio-esmeralda", "Ricalde Magaña Alicia Concepción": "ricalde-magana-alicia-concepcion", "Rincón Chanona Sonia": "rincon-chanona-sonia", "Ríos de la Mora Itzel Sarahí": "rios-de-la-mora-itzel-sarahi", "Ríos Piter Armando": "rios-piter-armando", "Rivadeneyra Hernández Alfredo": "rivadeneyra-hernandez-alfredo", "Rivera Villanueva Erick Marte": "rivera-villanueva-erick-marte", "Robledo Aburto Zoe Alejandro": "robledo-aburto-zoe-alejandro", "Robledo Leal Ernesto Alfonso": "robledo-leal-ernesto-alfonso", "Roblero Gordillo Héctor Hugo": "roblero-gordillo-hector-hugo", "Robles Aguirre Mayra Karina": "robles-aguirre-mayra-karina", "Robles Montoya Ángel Benjamín": "robles-montoya-angel-benjamin", "Rocha Piedra Juan Manuel": "rocha-piedra-juan-manuel", "Rodríguez Calderón José Alberto": "rodriguez-calderon-jose-alberto", "Rodríguez Doval Fernando": "rodriguez-doval-fernando", "Rodríguez Montero Francisco Tomás": "rodriguez-montero-francisco-tomas", "Rodríguez Vallejo Diego Sinhue": "rodriguez-vallejo-diego-sinhue", "Rojas Hernández Laura Angélica": "rojas-hernandez-laura-angelica", "Rojo García de Alba José Antonio": "rojo-garcia-de-alba-jose-antonio", "Román Bojórquez Jesús Tolentino": "roman-bojorquez-jesus-tolentino", "Romero Celis Mely": "romero-celis-mely", "Romero Deschamps Carlos Antonio": "romero-deschamps-carlos-antonio", "Romero Guzmán Rosa Elia": "romero-guzman-rosa-elia", "Romero Hicks Juan Carlos": "romero-hicks-juan-carlos", "Romero Lainas Adolfo": "romero-lainas-adolfo", "Romero Lozano María Fernanda": "romero-lozano-maria-fernanda", "Romero Sevilla Leonor": "romero-sevilla-leonor", "Romero Valencia Salvador": "romero-valencia-salvador", "Romo Fonseca Bárbara Gabriela": "romo-fonseca-barbara-gabriela", "Romo Medina Miguel": "romo-medina-miguel", "Rosas González Óscar Román": "rosas-gonzalez-oscar-roman", "Rosas Montero Lizbeth Eugenia": "rosas-montero-lizbeth-eugenia", "Rosiñol Abreu Jorge": "rosinol-abreu-jorge", "Rubio Lara Blas Ramón": "rubio-lara-blas-ramon", "Ruffo Appel Ernesto": "ruffo-appel-ernesto", "Ruíz Arriaga Genaro": "ruiz-arriaga-genaro", "Ruíz Gutiérrez Adán David": "ruiz-gutierrez-adan-david", "Ruíz Moronatti Roberto": "ruiz-moronatti-roberto", "Ruíz Sandoval Cristina": "ruiz-sandoval-cristina", "Sada Pérez Verónica": "sada-perez-veronica", "Sahui Rivero Mauricio": "sahui-rivero-mauricio", "Salazar Fernández Luis Fernando": "salazar-fernandez-luis-fernando", "Salazar Solorio Rabindranath": "salazar-solorio-rabindranath", "Salazar Trejo Jessica": "salazar-trejo-jessica", "Saldaña Fraire Graciela": "saldana-fraire-graciela", "Saldaña Hernández Margarita": "saldana-hernandez-margarita", "Saldaña Pérez María Lucero": "saldana-perez-maria-lucero", "Salgado Delgado Fernando": "salgado-delgado-fernando", "Salgado Parra Jorge": "salgado-parra-jorge", "Salgado Peña Abel Octavio": "salgado-pena-abel-octavio", "Salinas Garza José Arturo": "salinas-garza-jose-arturo", "Salinas Mendiola Glafiro": "salinas-mendiola-glafiro", "Salinas Narváez Javier": "salinas-narvaez-javier", "Salinas Pérez Josefina": "salinas-perez-josefina", "Salinas Sada Ninfa Clara": "salinas-sada-ninfa-clara", "Sámano Peralta Miguel": "samano-peralta-miguel", "Sampayo Ortiz Ramón Antonio": "sampayo-ortiz-ramon-antonio", "Samperio Montaño Juan Ignacio": "samperio-montano-juan-ignacio", "Sánchez Camacho Alejandro": "sanchez-camacho-alejandro", "Sánchez Cruz Leopoldo": "sanchez-cruz-leopoldo", "Sánchez García Gerardo": "sanchez-garcia-gerardo", "Sánchez Jiménez Venancio Luis": "sanchez-jimenez-venancio-luis", "Sánchez Romero Carlos": "sanchez-romero-carlos", "Sánchez Ruiz Mario": "sanchez-ruiz-mario", "Sánchez Santiago María Guadalupe": "sanchez-santiago-maria-guadalupe", "Sánchez Torres Guillermo": "sanchez-torres-guillermo", "Sansores San Román Layda Elena": "sansores-san-roman-layda-elena", "Sansores Sastré Antonio": "sansores-sastre-antonio", "Schroeder Verdugo María Fernanda": "schroeder-verdugo-maria-fernanda", "Serralde Martínez Víctor": "serralde-martinez-victor", "Serrano Toledo Rosendo": "serrano-toledo-rosendo", "Sosa Altamira William Renan": "sosa-altamira-william-renan", "Sosa Govea Martha Leticia": "sosa-govea-martha-leticia", "Soto Martínez José": "soto-martinez-jose", "Sotomayor Chávez Jorge Francisco": "sotomayor-chavez-jorge-francisco", "Talamante Lemas Dora María Guadalupe": "talamante-lemas-dora-maria-guadalupe", "Tapia Fonllem Margarita Elena": "tapia-fonllem-margarita-elena", "Tello Cristerna Alejandro": "tello-cristerna-alejandro", "Terán Guevara María Rebeca": "teran-guevara-maria-rebeca", "Terán Juárez Jorge": "teran-juarez-jorge", "Torres Cofiño Marcelo de Jesús": "torres-cofino-marcelo-de-jesus", "Torres Corzo Teófilo": "torres-corzo-teofilo", "Torres Flores Araceli": "torres-flores-araceli", "Torres Graciano Fernando": "torres-graciano-fernando", "Torres Mercado Tomás": "torres-mercado-tomas", "Torres Peimbert María Marcela": "torres-peimbert-maria-marcela", "Tovar Aragón Crystal": "tovar-aragon-crystal", "Trejo Reyes José Isabel": "trejo-reyes-jose-isabel", "Treviño Cantú Javier": "trevino-cantu-javier", "Treviño Villarreal Pedro Pablo": "trevino-villarreal-pedro-pablo", "Trujillo Íñiguez Agustín": "trujillo-iniguez-agustin", "Ugalde Alegría Aurora Denisse": "ugalde-alegria-aurora-denisse", "Urciel Castañeda María Celia": "urciel-castaneda-maria-celia", "Uribe Padilla Juan Carlos": "uribe-padilla-juan-carlos", "Urzúa Rivera Ricardo": "urzua-rivera-ricardo", "Valanci Buzali Simón": "valanci-buzali-simon", "Valdés Palazuelos Jesús Antonio": "valdes-palazuelos-jesus-antonio", "Valencia Ramírez Aída Fabiola": "valencia-ramirez-aida-fabiola", "Valladares Couoh Cinthya Noemí": "valladares-couoh-cinthya-noemi", "Valle Magaña José Luis": "valle-magana-jose-luis", "Valles Sampedro Lorenia Iveth": "valles-sampedro-lorenia-iveth", "Vargas Martín del Campo Elizabeth": "vargas-martin-del-campo-elizabeth", "Vargas Pérez Nelly del Carmen": "vargas-perez-nelly-del-carmen", "Vargas Vargas Laura Guadalupe": "vargas-vargas-laura-guadalupe", "Vásquez Villanueva Martín de Jesús": "vasquez-villanueva-martin-de-jesus", "Vázquez Saut Regina": "vazquez-saut-regina", "Vega Casillas Salvador": "vega-casillas-salvador", "Vega Vázquez José Humberto": "vega-vazquez-jose-humberto", "Vela Reyes Marco Alonso": "vela-reyes-marco-alonso", "Velasco Orozco Víctor Hugo": "velasco-orozco-victor-hugo"}
		jQuery("input#nombre-representante").autocomplete({
		 	source: ["Abreu Artiñano Rocío Adriana","Aceves del Olmo Carlos Humberto","Acosta Croda Rafael","Acosta Islas Anabel","Acosta Montoya Rubén","Acosta Peña Brasil Alberto","Adame Alemán Juan Pablo","Aguayo López Miguel Ángel","Águila Torres Claudia Elena","Aguilar Gil Lilia","Aguilar Rodríguez Aurora de la Luz","Aguilar Vega Marcos","Aispuro Torres José Rosas","Alavez Ruiz Aleida","Albores Gleason Roberto Armando","Alcalá Padilla Leobardo","Alcalá Ruiz Blanca María del Socorro","Alcalde Luján Luisa María","Aldana Prieto Luis Ricardo","Algredo Jaramillo Edilberto","Allende Cano Ana Isabel","Almaguer Torres Felipe de Jesús","Alonso Morelli Humberto","Alonso Raya Agustín Miguel","Alvarado Sánchez Brenda María Izontli","Álvarez Tovar Martha Berenice","Amador Gaxiola Daniel","Amaya Reyes María de Lourdes","Anaya Gudiño Alfredo","Anaya Gutiérrez Alberto","Anaya Llamas José Guillermo","Angulo Parra Carlos Fernando","Añorve Baños Manuel","Antonio Altamirano Carol","Aquino Calvo Juan Jesús","Araujo de la Torre Elsa Patricia","Araujo Lara Angélica del Rosario","Aréchiga Ávila Jorge","Arellano Guzmán Salvador","Argüelles Loya Consuelo","Arias Pallares Luis Manuel","Arriola Gordillo Mónica Tzasna","Arroyo Ruiz Alma Jeanny","Arroyo Vieyra Francisco Agustín","Astiazarán Gutiérrez Antonio Francisco","Astudillo Suárez Ricardo","Athie Flores Kamel","Aubry de Castro Palomino Enrique","Aureoles Conejo Silvano","Ávila Pérez José Angel","Ávila Ruiz Daniel Gabriel","Ávila Ruiz Daniel Gabriel","Ayala Almeida Joel","Ayala Almeida Joel","Ayala Robles Linares Flor de Rosa","Azuara Zúñiga Xavier","Badillo Ramírez Darío","Barajas Del Toro Salvador","Barba Mariscal Marco Antonio","Barbosa Huerta Luis Miguel Gerónimo","Barbosa Huerta Luis Miguel Gerónimo","Barcenas Nieves Delvim Fabiola","Barrales Magdaleno María Alejandra","Barrera Barrera Petra","Barrera Estrada Rodimiro","Barrera Fortoul Laura","Barrera Tapia María Elena","Barrios Gómez Segués Agustín","Barrueta Barón Noé","Bartlett Díaz Manuel","Bautista Bravo Alliet Mariana","Bautista Cuevas Gloria","Bautista López Víctor Manuel","Bautista Villegas Óscar","Belaunzarán Méndez Fernando","Beltrones Rivera Manlio Fabio","Benavides Castañeda José Alberto","Beristain Navarrete Luz María","Bernal Bolnik Sue Ellen","Bernal Gutiérrez Andrés Marco Antonio","Berzunza Novelo Landy Margarita","Blanco Deaquino Silvano","Blásquez Salinas Marco Antonio","Bojórquez Javier Claudia Elizabeth","Bonilla Gómez Adolfo","Bonilla Jaime Juana","Bonilla Valdez Jaime","Borges Pasos Teresita de Jesús","Botello Montes José Alfredo","Bribiesca Sahagún Fernando","Brito Lara Tomás","Bueno Torio Juan","Burgos García Enrique","Búrquez Valenzuela Francisco de Paula","Caamal Mena José Angelino","Caballero Garza Benito","Cabañas Aparicio María Elia","Cáceres de la Fuente Juan Francisco","Calderón Hinojosa Luisa María de Guadalupe","Calderón Ramírez Leticia","Calzada Arroyo Marco Antonio","Camacho Solís Víctor Manuel","Camarena García Felipe Arturo","Camarillo Ortega Rubén","Campos Córdova Lisandro Arístides","Cantú Garza Ricardo","Cantú Segovia Eloy","Carbajal González Alejandro","Carbajal Hernández Juan Manuel","Cárdenas Cantú Miriam","Cárdenas Del Avellano Enrique","Cárdenas Guízar Gabriel de Jesús","Carpinteyro Calderón Purificación","Carreño Mijares Angelina","Carreño Muro Genaro","Carreón Cervantes Verónica","Carrillo Huerta Mario Miguel","Casillas Romero Jesús","Castaños Valenzuela Carlos Humberto","Castellanos Mijares Carlos Octavio","Castillo Rodríguez Minerva","Castillo Valdez Benjamín","Cavazos Lerma Manuel","Cedillo Hernández Ángel","Cerda Franco María Sanjuana","Ceseña Burgoin Ángel Salvador","Ceseñas Chapa María del Socorro","Chan Lugo Sergio Augusto","Charleston Hernández Fernando","Chávez Contreras Rodrigo","Chávez Dávalos Sergio Armando","Chico Herrera Miguel Ángel","Contreras Ceballos Armando","Copete Zapot Yazmin de los Ángeles","Cordero Arroyo Ernesto Javier","Córdova Bernal Martha Beatriz","Córdova Díaz Luis Armando","Córdova Morán Frine Soraya","Corona Nakamura María del Rocío","Coronado Quintanilla Alberto","Coronato Rodríguez José Francisco","Corral Jurado Javier","Corrales Corrales Francisca Elena","Correa Acevedo Abraham","Cortázar Lara Gerardo Maximiliano","Cortés Berumen Isaías","Cota Jiménez Manuel Humberto","Cruz Mendoza Eufrosina","Cruz Morales Maricruz","Cruz Ramírez Arturo","Cuéllar Cisneros Lorena","Cuéllar Reyes Fernando","Cuéllar Steffan Antonio","Cuevas Barrón Gabriela","Cuevas Mena Mario Alejandro","Curi Naime Alberto","Dávila Delgado Mario Alberto","Dávila Fernández Adriana","De Jesús Alejandro Carlos","De la Cruz Requena Rosalba","De la Peña Gómez Angélica","De la Rosa Anaya Andrés","De la Rosa Escalante Arturo","De la Rosa Peláez Sebastián Alfonso","De la Vega Membrillo Jorge Federico","De las Fuentes Hernández Fernando Donato","De León Pérez María Eugenia","Del Ángel Acosta Jorge","Del Bosque Márquez Juan Isidro","Del Moral Vela Paulina Alejandra","Delgadillo González Claudia","Demédicis Hidalgo Fidel","Díaz Athié Antonio de Jesús","Díaz Lizama Rosa Adriana","Díaz Palacios Víctor Emanuel","Díaz Salazar María Cristina","Díaz Trujillo Alberto","Diego Cruz Eva","Doger Guerrero José Enrique","Domínguez Servién Francisco","Domínguez Zepeda Pedro Ignacio","Dorador Pérez Gavilán Rodolfo","Duarte Murillo José Ignacio","Duarte Ortuño Catalino","Durazo Montaño Francisco Alfonso","Encinas Rodríguez Alejandro de Jesús","Escajeda Jiménez José Rubén","Escobar y Vega Arturo","Escudero Morales Pablo","Espinosa Cházaro Luis Ángel Xariel","Esquivel Zalpa José Luis","Fayad Meneses Omar","Félix Chávez Faustino Francisco","Félix Hays Rubén Benjamín","Fernández Aguirre Braulio Manuel","Fernández Clamont Francisco Javier","Fernández Sánchez Navarro Juan Alejandro","Flemate Ramírez Julio César","Flores Aguayo Uriel","Flores Escalera Hilda Esthela","Flores Flores Enrique Alejandro","Flores Gómez José Luis Cruz","Flores Méndez José Luis","Flores Ramírez Juan Gerardo","Flores Salazar Guadalupe Socorro","Flores Sánchez Margarita","Flores Sandoval Patricio","Flores Treviño María de Lourdes","Fócil Pérez Juan Manuel","Fuentes Solís Víctor Oswaldo","Fuentes Téllez Adriana","Fujiwara Montelongo René Ricardo","Funes Velázquez Erika Yolanda","Galindo Delgado David Cuauhtémoc","Galindo Quiñones Heriberto Manuel","Galván Villanueva Raúl Santos","Gamboa Patrón Emilio Antonio","Gamboa Song Lizbeth Loy","Gándara Camou Ernesto","Garay Cabada Marina","García Cabeza de Vaca Francisco Javier","García Conejo Antonio","García de la Cadena Romero María del Carmen","García de la Fuente Mónica","García Fernández María de las Nieves","García García Héctor","García Gómez Martha Elena","García González Carlos Alberto","García Hernández Josefina","García Medina Amalia Dolores","García Olmedo María del Rocío","García Ramírez José Guadalupe","García Reyes Verónica","García Rojas Mariana Dunyaska","Garfias Gutiérrez Lucila","Garza Cadena Ana Lilia","Garza Galván Silvia Guadalupe","Garza Moreno María Esther","Garza Ruvalcaba Marcelo","Gastélum Bajo Diva Hadamira","Gastélum Buenrostro Juan Manuel","Gaudiano Rovirosa Gerardo","Gauna Ruiz de León Celia Isabel","Gil Zuarth Roberto","Gómez Carmona Blanca Estela","Gómez del Campo Gurza Mariana","Gómez Gómez Luis","Gómez Gómez Pedro","Gómez González Arely","Gómez Olguín Roy Argel","Gómez Pozos Merilyn","Gómez Ramírez Raúl","Gómez Tueme Amira Gricelda","González Bautista Valentín","González Canto Félix Arturo","González Carrillo Adriana","González Cruz Cristina","González Cuevas Isaías","González Domínguez Isela","González Farías Eligio Cuitláhuac","González Gómez Cecilia","González Luna Bueno Federico José","González Magallanes Alfa Eliana","González Manríquez Víctor Rafael","González Martínez Olivares Irazema","González Morfín José","González Reséndiz Rafael","González Roldán Luis Antonio","González Serna José Ángel","González Valdez Marco Antonio","González Vargas Francisco","Gordillo Castillo Néstor Octavio","Gracia Guzmán Raúl","Grajales Palacios Francisco","Gualito Castañeda Rosalba","Guerra Castillo Marcela","Guerra Garza Abel","Guerrero López Judit Magdalena","Guevara Espinoza Ana Gabriela","Guevara González Javier Filiberto","Guillén Guillén Mario Francisco","Gurrión Matías Samuel","Gutiérrez Álvarez Harvey","Gutiérrez de la Garza Héctor Humberto","Gutiérrez Manrique Martha","Guzmán Cervantes Carlos Bernardo","Guzmán Díaz Delfina Elizabeth","Heredia Lizárraga Martín Alonso","Hermosillo y Celada Víctor","Hernández Burgos Gaudencio","Hernández Deras Ismael Alfredo","Hernández González Noé","Hernández Íñiguez Adriana","Hernández Lecona Lisbeth","Hernández Morales Mirna Esmeralda","Hernández Tapia Gerardo Xavier","Herrera Ale Juana Leticia","Herrera Anzaldo Ana Lilia","Herrera Ávila Fernando","Herrera Delgado Jorge","Huerta Ladrón de Guevara Manuel Rafael","Huerta Rea María de Jesús","Huidobro González Zuleyma","Hurtado Gallegos José Antonio","Inzunza Montoya Alfonso","Irízar López Aarón","Jardines Fraire Jhonatan","Jarquín Hugo","Jiménez Castillo Blanca","Jiménez Cerrillo Raquel","Jiménez Esquivel María Teresa","Jorrín Lozano Víctor Manuel","Juan Marcos Issa Salomón","Juárez Cisneros René","Juárez Piña Verónica Beatriz","King de la Rosa Raymundo","Labastida Sotelo Karina","Larios Córdova Héctor","Larrazábal Bretón Fernando Alejandro","Lavalle Maury Jorge Luis","León Mendívil José Antonio","León Montero Saraí Larisa","Licea González Margarita","Liceaga Arteaga Gerardo Francisco","Llanas Alba José Alejandro","López Alvarado Jaime Chris","López Birlain Ana Paola","López Brito Francisco Salvador","López Candido José Arturo","López Cisneros José Martín","López González Roberto","López Hernández Adán Augusto","López Landero Leticia","López Landero Tomás","López López Raudel","López Moreno Lourdes Adriana","López Noriega Alejandra","López Rosado Roberto","López Segura María Carmen","López Suárez Roberto","López Zavala Javier","Lorenzini Rangel Julio César","Lozano Alarcón Javier","Lugo Barriga Patricia","Luna Porquillo Roxana","Macías Sandoval Raúl","Madrid Tovilla Areli","Magaña Zepeda María Angélica","Maldonado Hernández Fernando Alfredo","Maldonado Salgado José Valentín","Manríquez González Víctor Manuel","Márquez Martínez José Luis","Márquez Velasco Silvia","Martel Cantú Laura Ximena","Martínez Cárdenas Esther Angélica","Martínez García Patricio","Martínez Martínez José María","Martínez Martínez Juan Luis","Martínez Rojas Andrés Eloy","Martínez Santillán María del Carmen","Mayans Canabal Fernando Enrique","Medina Fierro Ricardo","Medina Filigrana Marcos Rosendo","Medrano Galindo Gabriela","Mejía Berdeja Ricardo Sóstenes","Mejía García Leticia","Mejía Guardado Julisa","Melgar Bravo Luis Armando","Méndez Denis Lorena","Méndez Martínez Mario Rafael","Mendoza Curiel María Leticia","Mendoza Garza Jorge","Mendoza Mendoza Iris Vianey","Mercado Gallegos Sonia Catalina","Merlín García María del Rosario","Merodio Reza Lilia Guadalupe","Mestas Gallardo Ignacio","Micalco Méndez Rafael Alejandro","Mícher Camarena Martha Lucía","Miranda Munive Emilse","Miranda Salgado Marino","Moctezuma Oviedo María Guadalupe","Mojica Morga Teresa de Jesús","Mondragón González María Guadalupe","Monreal Ávila David","Monreal Ávila Ricardo","Montalvo Hernández Ramón","Montano Guzmán José Alejandro","Montes Alvarado Abraham","Montes Colunga Vianey","Morales Flores Jesús","Morales López Carlos Augusto","Morales Vargas Trinidad Secundino","Moreno Árcega José Isidro","Moreno Cárdenas Rafael Alejandro","Moreno Montoya José Pilar","Moreno Rivera Israel","Moreno Rivera Julio César","Morgan Navarrete Tania Margarita","Morón Orozco Raúl","Mota Ocampo Gisela Raquel","Muñiz Martínez Dulce María","Muñoz Kapamas Felipe de Jesús","Muñoz Márquez Juan Carlos","Muñoz Soria José Luis","Murguía Lardizabal Luis Alfredo","Nájera Medina Víctor Reymundo","Narcia Álvarez Héctor","Nava Gómez José Everardo","Navarrete Contreras Joaquina","Navarrete Vital Ma. Concepción","Navarro de Alba César Reynaldo","Neblina Vega Heberto","Neyra Chávez Armando","Niaves López Ossiel Omar","Niño de Rivera Vela Homero Ricardo","Nolasco Ramírez Yesenia","Núñez Aguilar Ernesto","Núñez Monreal Magdalena del Socorro","Núñez Sánchez Gloria Elizabeth","Ochoa Gallegos Williams Oswaldo","Ochoa González Arnoldo","Ochoa López Nabor","Oliveros Usabiaga José Luis","Olvera Barrios Cristina","Olvera Correa Luis","Oramas Vargas Arquímedes","Ordaz Martínez María del Carmen","Orihuela García Javier","Orive Bellinger Adolfo","Orozco Gómez Javier","Orozco Sandoval Martín","Orta Coronado Marcelina","Ortega Martínez Ma. del Pilar","Ortega Pacheco Guadalupe del Socorro","Ortíz Ahlf Loretta","Ortiz Domínguez Maki Esther","Ortiz García Salvador","Ortiz González Graciela","Ortiz Mantilla María Isabel","Othón Zayas Máximo","Oviedo Herrera J. Jesús","Pacheco Díaz Germán","Pacheco Rodríguez Ricardo Fidel","Padierna Luna María de los Dolores","Padilla Fierro Román Alfredo","Padilla Navarro Cesario","Padilla Ramos Carla Alicia","Palafox Gutiérrez Martha","Pantoja Hernández Leslie","Pariente Gavito María del Rosario de Fátima","Paz Alonzo Raúl","Pazzi Maza Zita Beatriz","Pedraza Aguilera Flor de María","Pedraza Chávez Isidro","Pedroza Gaitán César Octavio","Pelayo Covarrubias Francisco","Peña Avilés Gerardo","Peña Recio Patricia Guadalupe","Penchyna Grub David","Pérez Anzueto Hugo Mauricio","Pérez Camarena Carmen Lucía","Pérez de Alba José Noel","Pérez Escalante Elvia María","Pérez Hernández Rosa Elba","Pérez Magaña Eviel","Pérez Tejada Padilla David","Pineda Gochi María del Rocío","Ponce Orozco Norma","Porras Pérez Pedro","Portillo Martínez Vicario","Posadas Hernández Domitilo","Pozos Lanz Raúl Aarón","Prieto Herrera Humberto Armando","Puente Salas Carlos Alberto","Quian Alcocer Eduardo Román","Quiñones Canales Lourdes Eulalia","Quintana León Socorro de la Luz","Quintana Salinas Esther","Quiroga Anguiano Karen","Quiroga Tamez Mayela María de Lourdes","Ramírez Diez Gutiérrez María Concepción","Ramírez Romero Luis Miguel","Rangel Espinosa José","Rangel Segovia Alejandro","Reina Lizárraga José Enrique","Rellstab Carreto Tanya","Retamoza Vega Patricia Elena","Reyes Gámiz Roberto Carlos","Reyes Montiel Carla Guadalupe","Reza Gallegos Rocío Esmeralda","Ricalde Magaña Alicia Concepción","Rincón Chanona Sonia","Ríos de la Mora Itzel Sarahí","Ríos Piter Armando","Rivadeneyra Hernández Alfredo","Rivera Villanueva Erick Marte","Robledo Aburto Zoe Alejandro","Robledo Leal Ernesto Alfonso","Roblero Gordillo Héctor Hugo","Robles Aguirre Mayra Karina","Robles Montoya Ángel Benjamín","Rocha Piedra Juan Manuel","Rodríguez Calderón José Alberto","Rodríguez Doval Fernando","Rodríguez Montero Francisco Tomás","Rodríguez Vallejo Diego Sinhue","Rojas Hernández Laura Angélica","Rojo García de Alba José Antonio","Román Bojórquez Jesús Tolentino","Romero Celis Mely","Romero Deschamps Carlos Antonio","Romero Guzmán Rosa Elia","Romero Hicks Juan Carlos","Romero Lainas Adolfo","Romero Lozano María Fernanda","Romero Sevilla Leonor","Romero Valencia Salvador","Romo Fonseca Bárbara Gabriela","Romo Medina Miguel","Rosas González Óscar Román","Rosas Montero Lizbeth Eugenia","Rosiñol Abreu Jorge","Rubio Lara Blas Ramón","Ruffo Appel Ernesto","Ruíz Arriaga Genaro","Ruíz Gutiérrez Adán David","Ruíz Moronatti Roberto","Ruíz Sandoval Cristina","Sada Pérez Verónica","Sahui Rivero Mauricio","Salazar Fernández Luis Fernando","Salazar Solorio Rabindranath","Salazar Trejo Jessica","Saldaña Fraire Graciela","Saldaña Hernández Margarita","Saldaña Pérez María Lucero","Salgado Delgado Fernando","Salgado Parra Jorge","Salgado Peña Abel Octavio","Salinas Garza José Arturo","Salinas Mendiola Glafiro","Salinas Narváez Javier","Salinas Pérez Josefina","Salinas Sada Ninfa Clara","Sámano Peralta Miguel","Sampayo Ortiz Ramón Antonio","Samperio Montaño Juan Ignacio","Sánchez Camacho Alejandro","Sánchez Cruz Leopoldo","Sánchez García Gerardo","Sánchez Jiménez Venancio Luis","Sánchez Romero Carlos","Sánchez Ruiz Mario","Sánchez Santiago María Guadalupe","Sánchez Torres Guillermo","Sansores San Román Layda Elena","Sansores Sastré Antonio","Schroeder Verdugo María Fernanda","Serralde Martínez Víctor","Serrano Toledo Rosendo","Sosa Altamira William Renan","Sosa Govea Martha Leticia","Soto Martínez José","Sotomayor Chávez Jorge Francisco","Talamante Lemas Dora María Guadalupe","Tapia Fonllem Margarita Elena","Tello Cristerna Alejandro","Terán Guevara María Rebeca","Terán Juárez Jorge","Torres Cofiño Marcelo de Jesús","Torres Corzo Teófilo","Torres Flores Araceli","Torres Graciano Fernando","Torres Mercado Tomás","Torres Peimbert María Marcela","Tovar Aragón Crystal","Trejo Reyes José Isabel","Treviño Cantú Javier","Treviño Villarreal Pedro Pablo","Trujillo Íñiguez Agustín","Ugalde Alegría Aurora Denisse","Urciel Castañeda María Celia","Uribe Padilla Juan Carlos","Urzúa Rivera Ricardo","Valanci Buzali Simón","Valdés Palazuelos Jesús Antonio","Valencia Ramírez Aída Fabiola","Valladares Couoh Cinthya Noemí","Valle Magaña José Luis","Valles Sampedro Lorenia Iveth","Vargas Martín del Campo Elizabeth","Vargas Pérez Nelly del Carmen","Vargas Vargas Laura Guadalupe","Vásquez Villanueva Martín de Jesús","Vázquez Saut Regina","Vega Casillas Salvador","Vega Vázquez José Humberto","Vela Reyes Marco Alonso","Velasco Orozco Víctor Hugo"]
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
		var map  = setMap();

		// aparecer legenda del mapa
		setTimeout(function(){ 
			jQuery("#map-legend").toggle( "slide", { "direction": "left" });
		}, 1500);

		/*Hacer búsqueda en el mapa a partir del hash*/
  		hash_to_search(map);
		


		jQuery(".close-map-info").on("click", function(){
			jQuery("#map-info").toggle( "slide", { "direction": "right" });
		})
	});
</script>
