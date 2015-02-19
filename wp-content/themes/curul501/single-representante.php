<?php
	global $avia_config, $more;
	$data = getDataRepresentatives();

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();

	?>
	
	<!-- Mapa representantes -->
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
	<style> #map {  border-top: 2px solid #48265C; border-bottom: 2px solid #48265C;} </style>
	<!-- Fin Mapa representantes -->
	
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
						   <select class="sorter-rep sort" name="partido-politico" id="partido-politico-filter">
							   <option value="">Grupos parlamentarios</option>
							   <?php $politicalPartiesArray = getPoliticalParties(); ?>
							   <?php foreach($politicalPartiesArray as $value) { ?>
									<option value="<?php echo $value["slug"];?>">
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
									<option value="<?php echo utf8_encode($value["name"]);?>">
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
									<option value="<?php echo $value->slug;?>">
										<?php echo $value->name;?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   
						<div id="filter">				
						   <select class="sorter-rep sort" name="tipo-eleccion" id="tipo-eleccion-filter">
							   <option value="">Tipo de elección</option>
								<option value="representacion-proporcional">
									Representación proporcional
								</option>
								<option value="mayoria-relativa">
									Mayoría relativa
								</option>
						   </select>
						</div>
						
						<div>				
						   <input type="submit" value="Filtrar" id="submit-filter"/>
					   </div>
					</form>				
				</div>
			</div>
			<!-- Fin filtros representantes -->	
		
<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
<div class='container'>
	<main class="content av-content-small alpha units" itemtype="https://schema.org/Blog" itemscope="itemscope" itemprop="mainContentOfPage" role="main">
                <article class="post-representante post-entry-last single-small" itemprop="blogPost" itemtype="https://schema.org/BlogPosting" itemscope="itemscope">
		        <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
						
						<?php
							$state	    = get_post_meta($post->ID, 'wp_clave_estado', true);
							$district   = get_post_meta($post->ID, 'wp_district_clean', true);
							$circum     = get_post_meta($post->ID, 'wp_circumscription', true);
							$avatar_url = get_post_meta($post->ID, 'avatar_url', true);
							$resume 	= json_decode(get_post_meta($post->ID, 'wp_resume', true));
							$initiatives = getInitativesByRepresentative(get_post_meta($post->ID, 'wp_slug', true));
							$puesto=get_post_meta($post->ID, 'wp_id_representative_type', true); 
							$estado  =   get_post_meta($post->ID, 'wp_zone_state', true);
							
							$commissions = explode('|', get_post_meta($post->ID, 'wp_commissions', true));
							$commissions_slug = explode('|', get_post_meta($post->ID, 'wp_commissions_slug', true));
							$htmlcommis = "<p>";
							$link = get_site_url() . "/representantes/?comision=";
							
							if($commissions) {
								foreach($commissions as $key => $commission) {
									$htmlcommis .= "<a href='" . $link . $commissions_slug[$key] . "' title='" . $commission . "'>" . $commission . "</a>, ";
								}
							} else {
								$htmlcommis .= "No se encuentran comisiones relacionadas";
							}
							
							$htmlcommis = rtrim($htmlcommis, ", ");
							$htmlcommis .= "</p>";
						?>
		
				        <header class="entry-content-header">
						
						<div class="post_foto-In">
							<img width="125" height="169" src="<?php echo $avatar_url;?>" class="attachment-post-thumbnail wp-post-image" alt="Avatar representante">
						</div>
						
						<div class="cabecera-representante ">
							<h1 itemprop="headline" class="post-title entry-title">
								<?php the_title(); ?>
							</h1>
						
							<div class="linea-morado"></div>
							
							<?php  if($estado !== "N/A") { ?>
							<h3 itemprop="headline" class="post-title entry-title">
								Representante de 
								<a class="entidad-del-representante" href="<?php echo get_site_url() . '/representantes/?estado=' . get_post_meta($post->ID, 'wp_zone_state', true); ?>" title="Filtro por estado">
									<?php echo get_post_meta($post->ID, 'wp_zone_state', true); ?>
								</a>
							</h3>
						<?php }else {     ?>
						<h3 itemprop="headline" class="post-title entry-title">
								Sin representación de estado								
							</h3>
						
												<?php }?>

						

							
						</div>
					</header>
					<div class="entry-content no-voto" itemprop="text">
						<ul class="lista-iniciativas">
							<li class="bullet-arrow">Comisiones a las que pertenece
								<p><?php echo $htmlcommis; ?></p>
							</li>
							
							<li class="bullet-arrow">Iniciativas propuestas
								<?php if($initiatives["count"] == 0) { ?>
									<p>No se encuentran iniciativas relacionadas</p>
								<?php } else { ?>
									<?php foreach($initiatives["loop"]->posts as $key => $initiative) { ?>
										<p>
											<a class="" href="<?php echo get_permalink($initiative->ID); ?>" title="<?php echo $initiative->post_title;?>">
												<?php echo $initiative->post_title;?>
											</a>
										</p>
										<?php if($key == 4) break; ?>
									<?php } ?>
									
									<?php if($initiatives["count"] > 5) { ?>
										<p class="more-initiatives">Mostrando 5 iniciativas de <?php echo $initiatives["count"];?></p>
									<?php } ?>
								<?php } ?>
							</li>
							
							<li class="bullet-arrow">Curriculum</li>
								<?php if($resume != "") { ?>
									<ul class="avia-icon-list avia-icon-list-left avia_animate_when_almost_visible avia_start_animation" style="margin-top: 22px;">
										<?php 
											foreach($resume as $value) {
										
											$resArray = explode("_____", $value->trayectoria);
											
											if($resArray[0] == "Trayectoria administrativa") {
												$icon = "administrativa-icon.png";
											} elseif($resArray[0] == "Trayectoria académica") {
												$icon = "academica-icon.png";
											} elseif($resArray[0] == "Otros rubros") {
												$icon = "rubros-icon.png";
											} elseif($resArray[0] == "Trayectoria legislativa") {
												$icon = "legislativo-icon.png";
											} elseif($resArray[0] == "Trayectoria empresarial/iniciativa privada") {
												$icon = "empresarial-icon.png";
											} elseif($resArray[0] == "Trayectoria política") {
												$icon = "politico-icon.png";
											} else {
												$icon = "default-icon.png";
											}
											
											$elements = explode("|", $resArray[1]);
										?>
											<li class="avia_start_animation">
												<div class="iconlist_icon avia-font-">
													<div class="iconlist-char">
														<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/<?php echo $icon;?>">
													</div>
												</div>
												
												<article class="article-icon-entry">
													<div class="iconlist_content_wrap">
														<header class="entry-content-header">
															<p class="cpt-repre"><?php echo $resArray[0];?></h4>
														</header>
														
														<div class="iconlist_content " itemprop="text">
															<?php foreach($elements as $element) { ?>
																<p><?php echo $element;?></p>
															<?php } ?>
														</div>
													</div>
													
													<footer class="entry-footer"></footer>
												</article>
												
												<div class="iconlist-timeline"></div>
											</li>
										<?php } ?>
									</ul>
								<?php } else { ?>
									<p>No hay información disponible</p>
								<?php } ?>
						</ul>
					<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>
		</article>
	</main>


	<div class="graficos">
		
	</div>
	
	<!--sidebar-->
	<div class="sidebar sidebar_right smartphones_sidebar_active alpha units sidebar-cpt-representantes" itemtype="https://schema.org/WPSideBar" itemscope="itemscope" role="complementary">
		<div class="sidebar-representantes">
			<ul>
				<li class="logo-partidoo-sb bullet-arrow">Grupo parlamentario
					<p>
						<?php $politicalParty = getPoliticalParty(get_post_meta($post->ID, 'wp_id_political_party', true)); ?>
						<a href="<?php echo get_site_url() . '/representantes/?partido-politico=' . $politicalParty["slug"] ;?>" title="<?php echo $politicalParty["short_name"];?>">
							<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/<?php echo $politicalParty["url_logo"];?>">
							<?php echo $politicalParty["short_name"];?>
						</a>
					</p>
				</li>
				
				<li class="bullet-arrow">Tipo de elecci&oacute;n
					<p>
						<?php if(get_post_meta($post->ID, 'wp_election_type', true) == "Mayoría Relativa") { ?>
							<a href="<?php echo get_site_url() . '/representantes/?tipo-eleccion=mayoria-relativa';?>" title="<?php echo get_post_meta($post->ID, 'wp_election_type', true);?>">
								<?php echo get_post_meta($post->ID, 'wp_election_type', true); ?>
							</a>
						<?php } else { ?>
							<a href="<?php echo get_site_url() . '/representantes/?tipo-eleccion=representacion-proporcional';?>" title="<?php echo get_post_meta($post->ID, 'wp_election_type', true);?>">
								<?php echo get_post_meta($post->ID, 'wp_election_type', true); ?>
							</a>
						<?php } ?>
					</p>
				</li>
							
				<li class="bullet-arrow">
				<?php if($puesto == 1) { ?>
					<?php if($district == "") { ?>
						Circunscripción<p><?php echo $circum;?></p>
					<?php } else { ?>
						Distrito<p><?php echo $district;?></p>
					<?php } ?>
					</li>
					<?php }else { if($state!==""){ ?>
								<li class="bullet-arrow">
											Estado<p><?php echo get_post_meta($post->ID, 'wp_zone_state', true); }?></p>
								</li>

								<?php } ?>

				
				<li class="bullet-arrow">Correo
					<p>
						<a href="mailto:<?php echo get_post_meta($post->ID, 'wp_email', true); ?>">
							<?php echo get_post_meta($post->ID, 'wp_email', true); ?>
						</a>
					</p>
				</li>
				
				<?php if(get_post_meta($post->ID, 'wp_twitter', true) != "") { ?>
					<li class="bullet-arrow twitter-sb">Twitter
						<p>
							<a href="https://twitter.com/<?php echo get_post_meta($post->ID, 'wp_twitter', true); ?>" title="<?php echo get_post_meta($post->ID, 'wp_twitter', true); ?>">
								@<?php echo get_post_meta($post->ID, 'wp_twitter', true); ?>
							</a>
						</p>
					</li>
				<?php } ?>
				
				<?php if(get_post_meta($post->ID, 'wp_website', true) != "") { ?>
					<li class="bullet-arrow no-borde ir-sb">Website
						<p>
							<a href="<?php echo get_post_meta($post->ID, 'wp_website', true); ?>" title="<?php echo get_post_meta($post->ID, 'wp_website', true); ?>">
								<a href="<?php echo get_post_meta($post->ID, 'wp_website', true); ?>" title="website" target="_blank">
									<?php echo get_post_meta($post->ID, 'wp_website', true); ?>
								</a>
							</a>
						</p>
					</li>
				<?php } ?>
			</ul>
		</div>
		
		<!-- Mapa representantes -->
		<?php if($puesto==1) {           ?>
		
		<?php if($district == "") { ?>
			<script src="<?php echo get_stylesheet_directory_uri() ?>/js/estados.geojson.js" type="text/javascript"></script>
			<script src="<?php echo get_stylesheet_directory_uri() ?>/js/init-map.js" type="text/javascript"></script>
			<script type="text/javascript"> jQuery(document).ready( function () { setMap("<?php echo $circum;?>"); }); </script>
		<?php } else { ?>
			<script src="<?php echo get_stylesheet_directory_uri() ?>/js/estado-<?php echo $state;?>.geojson.js" type="text/javascript"></script>
			<script src="<?php echo get_stylesheet_directory_uri() ?>/js/init-map-dist.js" type="text/javascript"></script>
			<script type="text/javascript"> jQuery(document).ready( function () { setMap("<?php echo $state;?>", "<?php echo $district;?>"); }); </script>
		<?php } ?>
		<?php }  else { ?>
		<script src="<?php echo get_stylesheet_directory_uri() ?>/js/estado-<?php echo $state;?>.geojson.js" type="text/javascript"></script>
		<script src="<?php echo get_stylesheet_directory_uri() ?>/js/init-map.js" type="text/javascript"></script>
		<script type="text/javascript"> jQuery(document).ready( function () { setMap("<?php echo $state;?>"); }); </script>
		<?php } ?>

				

		<div id="map" style="width: 235px; height:323px;"></div>
		<!-- Fin Mapa representantes -->
		
		<div class="textwidget share-sidebar-vota">
			 <?php avia_social_share_links(); ?>
		</div>
	</div><!--end sidebar-->
				
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
			
			jQuery("#filter-representanes").submit();
		});
	});
</script>
