<?php
	global $avia_config, $more;
	$selectedCommission = getParameterValueGET('comision');
	$selectedType = getParameterValueGET('tipo-eleccion');
	$selectedPolitical = getParameterValueGET('partido-politico');
	$selectedState = getParameterValueGET('estado');
	$selectedTipo = getParameterValueGET('tipo');

	$data = getDataRepresentatives();
	/*
	* get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	*/
	get_header();
	
	
	?>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src="<?php echo get_stylesheet_directory_uri() ?>/js/scripts/representantes_por_nombre.js" type="text/javascript"></script>

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
					<form name="filter-representanes" id="filter-representanes" action="/representantes">
						<div id="filter">
						   <input type="text" class="sorter-rep sort" name="nombre-representante" id="nombre-representante-filter">
					   </div>

						
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
										<?php echo utf8_encode($value["slug"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>
						
						
						<div>				
						   <input type="submit" value="Filtrar" id="submit-filter"/>
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
	});
</script>
