<?php
	global $avia_config, $more;

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
<!--Inicio filtros iniciativas -->
		<div class="container box-menu">
			<div class="search-table">
				<div id="filter">
				       <select class="sorter-rep sort" name="category">
					       <option value="1">Partidos pol&iacute;ticos</option>
					       <option value="2">Tema 2</option>							
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-rep sort" name="category">
					       <option value="1">Estado</option>
					       <option value="2">Estado</option>														
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-rep sort" name="category">
					       <option value="1">Comisiones</option>
					       <option value="2">Seguridad P&uacute;blica</option>														
				       </select>
			       </div>				
			</div>
		</div>
<!-- Fin filtros iniciativas -->
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
						?>
		
				        <header class="entry-content-header">
						
						<div class="post_foto">
							<img width="125" height="169" src="<?php echo $avatar_url;?>" class="attachment-post-thumbnail wp-post-image" alt="Avatar representante">
						</div>
						
						<div class="cabecera-representante ">
							<h1 itemprop="headline" class="post-title entry-title">
								<?php the_title(); ?>
							</h1>
						
							<div class="linea-morado"></div>
							<h3 itemprop="headline" class="post-title entry-title">
								Representante de <?php echo get_post_meta($post->ID, 'wp_zone_state', true); ?>
							</h3>
						</div>
					</header>
					<div class="entry-content no-voto" itemprop="text">
						<ul class="lista-iniciativas">
							<li class="bullet-arrow">Tipo de elecci&oacute;n
								<p><?php echo get_post_meta($post->ID, 'wp_election_type', true); ?></p>
							</li>
							
							<li class="bullet-arrow">Comisiones a las que pertenece
								<p><?php echo str_replace('|', ", ", get_post_meta($post->ID, 'wp_commissions', true)); ?></p>
							</li>
							
							<li class="bullet-arrow">Iniciativas propuestas
								<?php if($initiatives["count"] == 0) { ?>
									<p>No se enceuntran iniciativas relacionadas</p>
								<?php } else { ?>
									<?php foreach($initiatives["loop"]->posts as $initiative) { ?>
										<p>
											<a class="" href="<?php echo get_permalink($initiative->ID); ?>" title="<?php echo $initiative->post_title;?>">
												<?php echo $initiative->post_title;?>
											</a>
										</p>
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
											} elseif($resArray[0] == "Trayectoria empresarial") {
												$icon = "empresarial-icon.png";
											} elseif($resArray[0] == "Trayectoria política") {
												$icon = "politica-icon.png";
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
															<p>
																<?php foreach($elements as $element) { ?>
																	<?php echo $element;?><br/>
																<?php } ?>
															</p>
														</div>
													</div>
													
													<footer class="entry-footer"></footer>
												</article>
												
												<div class="iconlist-timeline"></div>
											</li>
										<?php } ?>
									</ul>
								<?php } ?>
						</ul>
					<? the_content(); ?>
					</div>
				<?php endwhile; endif; ?>
		</article>
	</main>
	
	<!--sidebar-->
	<div class="sidebar sidebar_right smartphones_sidebar_active alpha units sidebar-cpt-representantes" itemtype="https://schema.org/WPSideBar" itemscope="itemscope" role="complementary">
		<div class="sidebar-representantes">
			<ul>
				<li class="logo-partidoo-sb">
					<?php $politicalParty = getPoliticalParty(get_post_meta($post->ID, 'wp_id_political_party', true)); ?>
					
					<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/<?php echo $politicalParty["url_logo"];?>"><?php echo $politicalParty["short_name"];?>
					<br/><br/>
					
					<?php if($district == "") { ?>
						Circunscripción: <?php echo $circum;?>
					<?php } else { ?>
						Distrito: <?php echo $district;?>
					<?php } ?>
				</li>	
				
				<li class="correo-sb">
					<a href="mailto:<?php echo get_post_meta($post->ID, 'wp_email', true); ?>">
						<?php echo get_post_meta($post->ID, 'wp_email', true); ?>
					</a>
				</li>
				
				<?php if(get_post_meta($post->ID, 'wp_twitter', true) != "") { ?>
					<li class="twitter-sb">
						<a href="https://twitter.com/<?php echo get_post_meta($post->ID, 'wp_twitter', true); ?>" title="<?php echo get_post_meta($post->ID, 'wp_twitter', true); ?>">
							<?php echo get_post_meta($post->ID, 'wp_twitter', true); ?>
						</a>
					</li>
				<?php } ?>
				
				<?php if(get_post_meta($post->ID, 'wp_website', true) != "") { ?>
					<li class="no-borde ir-sb">
						<a href="<?php echo get_post_meta($post->ID, 'wp_website', true); ?>" title="<?php echo get_post_meta($post->ID, 'wp_website', true); ?>">
							<?php echo get_post_meta($post->ID, 'wp_website', true); ?>
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
		
		<!-- Mapa representantes -->
		<?php if($district == "") { ?>
			<script src="<?php echo get_stylesheet_directory_uri() ?>/js/estados.geojson.js" type="text/javascript"></script>
			<script src="<?php echo get_stylesheet_directory_uri() ?>/js/init-map.js" type="text/javascript"></script>
			<script type="text/javascript"> jQuery(document).ready( function () { setMap("<?php echo $circum;?>"); }); </script>
		<?php } else { ?>
			<script src="<?php echo get_stylesheet_directory_uri() ?>/js/estado-<?php echo $state;?>.geojson.js" type="text/javascript"></script>
			<script src="<?php echo get_stylesheet_directory_uri() ?>/js/init-map-dist.js" type="text/javascript"></script>
			<script type="text/javascript"> jQuery(document).ready( function () { setMap("<?php echo $state;?>", "<?php echo $district;?>"); }); </script>
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
