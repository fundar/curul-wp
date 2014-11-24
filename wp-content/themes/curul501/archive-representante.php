<?php
	global $avia_config, $more;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();

	?>
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		        <!-- inicio mapa de representantes-->
		       <div id="av_section_1" class="avia-section main_color avia-section-default avia-no-border-styling avia-bg-style-scroll avia-builder-el-0 avia-builder-el-no-sibling av-minimum-height av-minimum-height-100 container_wrap sidebar_right" style="background-color: #f4f4f4; ">
				<div class="container">
					Mapa
				</div>
                        </div>
                        <!-- fin mapa de representantes-->
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
				       <select class="sorter-tema sort" name="category">
					       <option value="1">Tema</option>
					       <option value="2">Tema 2</option>							
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-proponente sort" name="category">
					       <option value="2">Proponente(s)</option>
					       <option value="2">Opcion 2</option>														
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-partido sort" name="category">
					       <option value="1">Partido</option>
					       <option value="2">PRI</option>														
				       </select>
			       </div>				
			</div>
		</div>
<!-- Fin filtros iniciativas -->		

		<div class='container_wrap container_wrap_first main_color fullsize'>

			<div class='container'>

				<main class='template-page content  av-content-full alpha units'>
				<?php if (have_posts()) : ?>
                                <?php while (have_posts()) : the_post(); ?>
				 <!--Inicio iniciaiva--><article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small pleca-624070">
									<div class="entry-content-wrapper clearfix">
										<div class="entry-content-wrapper clearfix">
											<!--Inicio fecga y resumen-->
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first topTop">
												<div class="post_date">
													<span>13</span>
													Feb, 2014
												</div>
												<div class="entry-content">
													 <p class="resemen-recientes-iniciativas titulo-<?php the_ID(); ?>">
			                                                                                 <a class="iniciativas-home" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
												         </p>
													 <?php the_excerpt(); ?> 
                          
												</div>
											</div><!--fin fecha y resumen-->
											<div class="flex_column av_one_third avia-builder-el-2 el_after_av_two_third avia-builder-el-last topTop leftRI top12">
												<div class="col-status">
													<div class="datos">
													Status													
													<div class="temporizador"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/barra-temporizador.png" /></div>
													</div>													
												</div> 
												<div class="col-status-1">
													<div class="datos">
													Votaci&oacute;n final													
													</div>
													<div class="votos-oficiles">
														130
													</div>
												</div>
												<div class="col-status-2">
													<div class="datos">Propuesta por:</div>
													<div class="photo-avatar"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/avatar-m-42x42.png"></div>
													<div class="logo-partido"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/18px-PRI.png">
															<span>PRI</span>
													
													</div>
												</div>													
											</div>
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first">
												<div class="in-box-share">
												<?php avia_social_share_links(); ?>
												</div>
											</div>
											<div class="vta-curul">
												<span>Votaci&oacute;n en Curul 501</span>
												
												
												
												
												
											</div>

											
										</div>
									</div>
							</article><!--fin iniciativas-->
							<?php endwhile; endif; ?>
				</main>
			</div><!--end container-->
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>
