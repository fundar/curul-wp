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
							$intiatives = getInitativesByRepresentative(get_post_meta($post->ID, 'wp_slug', true));
							die(var_dump($initiatives["loop"]->posts));
						?>
		
				        <header class="entry-content-header">
						<div class="post_foto">
							<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
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
							<p><?php echo get_post_meta($post->ID, 'wp_election_type', true); ?></p></li>
							<li class="bullet-arrow">Comisiones a las que pertenece
							<p><?php echo get_post_meta($post->ID, 'wp_commissions', true); ?></li>
							
							<li class="bullet-arrow">Iniciativas propuestas
								<?php if($intiatives["count"] == 0) { ?>
									<p>No se enceuntran iniciativas relacionadas</p>
								<?php } else { ?>
									<p>No se enceuntran iniciativas relacionadas</p>
								<?php } ?>
							</li>
							
							
							<li class="bullet-arrow">Curriculum</li>
								<ul class="avia-icon-list avia-icon-list-left avia_animate_when_almost_visible avia_start_animation" style="margin-top: 22px;">
									<li class="avia_start_animation">
										<div class="iconlist_icon avia-font-">
										         <div class="iconlist-char">
												<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/academica-icon.png">												
											 </div>
										</div>
										<article class="article-icon-entry">
											 <div class="iconlist_content_wrap">
												<header class="entry-content-header">
												         <p class="cpt-repre">Trayectoria acad&eacute;mica</h4>
												</header>
												<div class="iconlist_content " itemprop="text">
												         <p><?php echo get_post_meta($post->ID, 'wp_presentada', true); ?> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
												</div>
										         </div>
										         <footer class="entry-footer"></footer>
										</article>
										<div class="iconlist-timeline"></div>
									</li>

									<li class="avia_start_animation">
										<div class="iconlist_icon avia-font-">
										         <div class="iconlist-char">
												<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/legislativo-icon.png">
												
											 </div>
										</div>
										<article class="article-icon-entry">
											<div class="iconlist_content_wrap">
												<header class="entry-content-header">
												         <p class="cpt-repre">Trayectoria legislativa</p>
												</header>
												<div class="iconlist_content " itemprop="text">
												         <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
										<div class="iconlist-timeline"></div>
									</li>
									
									<li class="avia_start_animation">
										<div class="iconlist_icon avia-font-">
										         <div class="iconlist-char">
												<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/administrativa-icon.png">
												
											 </div>
										</div>
										<article class="article-icon-entry">
											<div class="iconlist_content_wrap">
												<header class="entry-content-header">
												         <p class="cpt-repre">Trayectoria administrativa</p>
												</header>
												<div class="iconlist_content " itemprop="text">
												         <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
										<div class="iconlist-timeline"></div>
									</li>
									
									<li class="avia_start_animation">
										<div class="iconlist_icon avia-font-">
										         <div class="iconlist-char">
												<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/empresarial-icon.png">
												
											 </div>
										</div>
										<article class="article-icon-entry">
											<div class="iconlist_content_wrap">
												<header class="entry-content-header">
												         <p class="cpt-repre">Trayectoria empresarial</p>
												</header>
												<div class="iconlist_content " itemprop="text">
												         <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
										<div class="iconlist-timeline"></div>
									</li>
									<li class="avia_start_animation">
										<div class="iconlist_icon avia-font-">
										         <div class="iconlist-char">
												<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/publicaciones-icon.png">
												
											 </div>
										</div>
										<article class="article-icon-entry">
											<div class="iconlist_content_wrap">
												<header class="entry-content-header">
												         <p class="cpt-repre">Publicaciones</p>
												</header>
												<div class="iconlist_content " itemprop="text">
												         <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
										<div class="iconlist-timeline"></div>
									</li>
									<li class="avia_start_animation">
										<div class="iconlist_icon avia-font-">
										         <div class="iconlist-char">
												<img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/rubros-icon.png">
												
											 </div>
										</div>
										<article class="article-icon-entry">
											<div class="iconlist_content_wrap">
												<header class="entry-content-header">
												         <p class="cpt-repre">Otros rubros</p>
												</header>
												<div class="iconlist_content " itemprop="text">
												         <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
												</div>
											</div>
											<footer class="entry-footer"></footer>
										</article>
										<div class="iconlist-timeline"></div>
									</li>									
								</ul>
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
			<li class="logo-partidoo-sb"><img class="icono-repre" src="<?php echo get_stylesheet_directory_uri() ?>/images/18px-PRI.png"> PRI <?php echo get_post_meta($post->ID, 'wp_id_political_party', true); ?> </li>	
			<li class="correo-sb"><a href=""><?php echo get_post_meta($post->ID, 'wp_email', true); ?></a></li>
			<li class="twitter-sb"><a href=""><?php echo get_post_meta($post->ID, 'wp_', true); ?>twiiter</a></li>
			<li class="no-borde ir-sb"><a href=""> elizabethyanez.mx</a></li>
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
