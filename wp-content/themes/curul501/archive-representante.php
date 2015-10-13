<?php
getRepresentatives(true);

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
	<?php } ?>
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

		/* Buscador de representantes por nombre*/
			var rep_obj = {}
			var names = []

			for(var i in representatives) {
				var rep = representatives[i];
				rep_obj[rep.name] = rep.slug;
				names.push(rep.name);
			}

			jQuery("input#nombre-representante").autocomplete({
			 	source: names
				, select: function( event, ui ) {
					var slug = rep_obj[ui.item.value]
					window.location.href = "/representantes/" + slug
				}
			});

		/**/
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
