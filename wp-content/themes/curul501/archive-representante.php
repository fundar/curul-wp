<?php
	global $avia_config, $more;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();

	?>
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		    <!-- inicio mapa de representantes-->
		   <div class="forcefullwidth_wrapper_tp_banner" style="position: relative; width: 100%; height: auto; margin-bottom: 0px;">
		       <div id="av_section_1" class="avia-section main_color avia-section-default avia-no-border-styling avia-bg-style-scroll avia-builder-el-0 avia-builder-el-no-sibling av-minimum-height av-minimum-height-100 container_wrap sidebar_right" style="background-color: #f4f4f4; ">
					<div class="container">Mapa</div>
                </div>
		   </div>
            <!-- fin mapa de representantes-->
			
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
							   <option value="0">Partidos pol&iacute;ticos</option>
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
							   <option value="0">Estado</option>
							   <?php $statesArray = geStates(); ?>
							   <?php foreach($statesArray as $value) { ?>
									<option value="<?php echo $value["slug"];?>">
										<?php echo utf8_encode($value["name"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   <div id="filter">				
						   <select class="sorter-rep sort" name="comision" id="comision-filter">
							   <option value="1">Comisiones</option>
							   <option value="2">Seguridad P&uacute;blica</option>
						   </select>
					   </div>
					</form>				
				</div>
			</div>
			<!-- Fin filtros representantes -->		
		
		<div class='container_wrap container_wrap_first main_color fullsize'>
			<div class='container'>
				<main class='template-page content  av-content-full alpha units'>
					<?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
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
								
								<div class="flex_column av_one_fifth vota-rep"></div>
							</article><!--fin representantes-->
							
							<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first">
								<div class="share-social-representante ">
									<?php avia_social_share_links(); ?>
								</div>
							</div>
							<?php 	endwhile; else: ?>
							<?php							
								endif;
								if(empty($avia_config['remove_pagination'] ))
								{
									echo "<div class='{$blog_style}'>".avia_pagination('', 'nav')."</div>";
								}
							?>
				</main>
			</div><!--end container-->
		</div><!-- close default .container_wrap element -->
<?php get_footer(); ?>

<script type="text/javascript">
	jQuery(document).ready( function () {
		jQuery("#partido-politico-filter").change( function() {
			jQuery("#filter-representanes").submit();
		});
	});
</script>
