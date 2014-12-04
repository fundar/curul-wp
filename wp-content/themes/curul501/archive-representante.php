<?php
	global $avia_config, $more;
	$selectedOption = getParameterValueGET();
	$data = getDataRepresentatives();
	/*
	* get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	*/
	get_header();
	
	
	?>
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	<style>
		#map {  border-top: 2px solid #48265C; border-bottom: 2px solid #48265C;}
		#loading-gif { z-index:100; position:fixed; top:30%; left:40%; }
	</style>
	
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
			<!-- titulo-->
			<div class="container top60">
				<h1 class="entry-title-yellow">Integrantes de la Camara</h1>
				<div class="line-amarilla"> </div>
		    </div>
			<!-- fin de titulo-->
		
			<!--Inicio filtros representantes -->
			<div class="container box-menu">
				<div class="search-table">
					<form name="filter-representanes" id="filter-representanes">
						<div id="filter">
						   <select class="sorter-rep sort" name="partido-politico" id="partido-politico-filter">
							   <option value="">Partidos pol&iacute;ticos</option>
							   <?php $politicalPartiesArray = getPoliticalParties(); ?>
							   <?php foreach($politicalPartiesArray as $value) { ?>
									<option value="<?php echo $value["slug"];?>" <?php if($selectedOption == $value["slug"]) echo 'selected="selected"'?>>
										<?php echo utf8_encode($value["name"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   
					   <div id="filter">				
						   <select class="sorter-rep sort" name="estado" id="estado-filter">
							   <option value="">Estado</option>
							   <?php $statesArray = getStates(); ?>
							   <?php foreach($statesArray as $value) { ?>
									<option value="<?php echo utf8_encode($value["name"]);?>" <?php if($selectedOption == utf8_encode($value["name"])) echo 'selected="selected"'?>>
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
									<option value="<?php echo $value->slug;?>" <?php if($selectedOption == $value->slug) echo 'selected="selected"'?>>
										<?php echo $value->name;?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					</form>				
				</div>
			</div>
			<!-- Fin filtros representantes -->		
		
		<div class='container_wrap container_wrap_first main_color fullsize'>
			<div class='container'>
				<main class='template-page content  av-content-full alpha units'>
					<?php if($data) { ?>
						<?php if ($data->have_posts()) { ?>
							<?php while ($data->have_posts()) : $data->the_post(); ?>
								<!--Inicio representantes-->
								<article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small">
									<!--Inicio fecga y resumen-->
									<div class="flex_column av_four_fifth  first ">
										<div class="post_foto">
											<?php $avatar_url = get_post_meta($post->ID, 'avatar_url', true); ?>
											<img width="100" height="144" src="<?php echo $avatar_url;?>" class="attachment-post-thumbnail wp-post-image" alt="Avatar representante">
										</div>
										
										<div class="entry-content"> 
											<a class="iniciativas-home" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
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
														Cargo: Diputado
													</li>
													
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
										</div>
									</div><!--fin fecha y resumen-->
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
														Cargo: Diputado
													</li>
													
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
							wp_pagenavi(array('query' => $data ));
						} else {
							if(empty($avia_config['remove_pagination'] )) {
								echo "<div class='{$blog_style}'>" . avia_pagination2('', 'nav') . "</div>";
							}
						}
					?>
				</main>
				
				<!-- inicio mapa de representantes-->
				<div class="forcefullwidth_wrapper_tp_banner" style="position: relative; width: 100%; height: auto; margin-bottom: 0px;">
				   <div id="av_section_1" class="avia-section main_color avia-section-default avia-no-border-styling avia-bg-style-scroll avia-builder-el-0 avia-builder-el-no-sibling av-minimum-height av-minimum-height-100 container_wrap sidebar_right" style="background-color: #f4f4f4; ">
						<div id="map" style="width: 100%; height:500px;"></div>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/images/loading.gif" id="loading-gif">
					</div>
				</div>
				<!-- fin mapa de representantes-->
            
			</div><!--end container-->
		</div><!-- close default .container_wrap element -->
<?php get_footer(); ?>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/estados.geojson.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/leaflet-pip.min.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/init-ubica.js" type="text/javascript"></script>
	
<script type="text/javascript">
	jQuery(document).ready( function () {
		jQuery("#loading-gif").hide();
		
		jQuery("#partido-politico-filter").change( function() {
			if(jQuery("#partido-politico-filter option:selected").val() != "") {
				jQuery("#estado-filter").remove();
				jQuery("#comision-filter").remove();
				jQuery("#filter-representanes").submit();
			}
		});
		
		jQuery("#estado-filter").change( function() {
			if(jQuery("#estado-filter option:selected").val() != "") {
				jQuery("#partido-politico-filter").remove();
				jQuery("#comision-filter").remove();
				jQuery("#filter-representanes").submit();
			}
		});
		
		jQuery("#comision-filter").change( function() {
			if(jQuery("#comision-filter option:selected").val() != "") {
				jQuery("#estado-filter").remove();
				jQuery("#partido-politico-filter").remove();
				jQuery("#filter-representanes").submit();
			}
		});
		
		setMap();
	});
	
</script>
