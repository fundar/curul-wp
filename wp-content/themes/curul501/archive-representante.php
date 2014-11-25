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
					       <option value="1">Partidos pol&iacute;ticos</option>
					       <option value="2">Tema 2</option>							
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-proponente sort" name="category">
					       <option value="2">Estado</option>
					       <option value="2">Aguascalientes</option>														
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-partido sort" name="category">
					       <option value="1">Comisiones</option>
					       <option value="2">Seguridad P&uacute;blica</option>														
				       </select>
			       </div>				
			</div>
		</div>
<!-- Fin filtros iniciativas -->		
<!-- Fin filtros iniciativas -->		

		<div class='container_wrap container_wrap_first main_color fullsize'>

			<div class='container'>

				<main class='template-page content  av-content-full alpha units'>
				<?php if (have_posts()) : ?>
                                <?php while (have_posts()) : the_post(); ?>
				 <!--Inicio iniciaiva--><article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small">
									
										
											<!--Inicio fecga y resumen-->
											<div class="flex_column av_four_fifth  first ">
												<div class="post_foto">
													<?php echo get_the_post_thumbnail( $page->ID, 'thumbnail' ); ?>
												</div>
												<div class="entry-content">
													 
			                                                                                 <a class="iniciativas-home" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
												      
													
                          
												</div>
											</div><!--fin fecha y resumen-->
											<div class="flex_column av_one_fifth vota-rep">
												
																								
											</div>											
										
									
							</article><!--fin iniciativas-->
							<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first">
												<div class="share-social-representante ">
												<?php avia_social_share_links(); ?>
												</div>
							</div>
							<?php endwhile; endif; ?>
				</main>
			</div><!--end container-->
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>