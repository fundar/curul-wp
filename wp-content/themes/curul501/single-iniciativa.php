<?php get_header(); ?>
		<div class="container top60">										     
						<h1 class="entry-title-yellow">Iniciativas</h1>
						<div class="line-amarilla"> </div>
		</div>

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
			       <div id="filter">										
				       <select class="sorter-comision sort" name="category">
					       <option value="1">Comisi&oacute;n dictaminadora</option>
					       <option value="2">Opcion 1</option>
					       <option value="2">Opcion 2</option>	
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-turno sort" name="category">
					       <option value="1">Fecha de elecci&oacute;n</option>
					       <option value="2">Opcion 1</option>
					       <option value="2">Opcion 2 reytruytrui7yigfhgfjhgj ghjkuyki ujyki</option>	
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-votacion sort" name="category">
					       <option value="1">Fecha de votaci&oacute;n</option>
					       <option value="2">Opcion 1</option>
					       <option value="2">Opcion 2 fgbhfgh</option>	
				       </select>
			       </div>
			       <div id="filter">										
				       <select class="sorter-estado sort" name="category">
					       <option value="1">Estado actual</option>
					       <option value="2">Opcion 1</option>
					       <option value="2">Opcion 2 htrujytiuyoyuitpotuiy´'o0+'+8+</option>	
				       </select>
			       </div>					
			</div>
		</div>
<!-- Fin filtros iniciativas -->		
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
						<?php
							$presentada_representante	    = get_post_meta($post->ID, 'wp_presentada', true);
							$presentada_partido	            = get_post_meta($post->ID, 'wp_presentada_partidos', true);
							$presentada_dependencia	        = get_post_meta($post->ID, 'wp_presentada_dependencias', true);
							$status_iniciativa             	        = get_post_meta($post->ID, 'wp_status', true);
							$elements = explode("|", $status_iniciativa);
   						    $status_final=count($elements)-1;
							$voto 	= json_decode(get_post_meta($post->ID, 'wp_votos', true));
							echo "el voto es".$voto[1]['favor'];



						?>
			<div class='container template-blog template-single-blog '>

				<main class="content units av-content-small alpha cpt-iniciativa" role="main">
				        <header class="entry-content-header">
						<h1 itemprop="headline" class="post-title entry-title">
							<?php the_title(); ?>
						</h1>
						<div class="linea-morado"></div>
						<h3 itemprop="headline" class="post-title entry-title">
							<?php echo get_post_meta($post->ID, 'wp_titulo_listado', true); ?>
						</h3>
					</header>
					<div class="entry-content no-voto" itemprop="text">
						<ul class="lista-iniciativas">
							<li class="bullet-arrow">Comisiones
							<p><?php echo str_replace('|', ", ", get_post_meta($post->ID, 'wp_commissions', true)); ?></p>
							</li>
							<li class="bullet-arrow">Propuesta por
							<p><?php if($presentada_dependencia != "") { echo $presentada_dependencia.", ";} ?>
							<?php if($presentada_partido != "") { echo $presentada_partido.", ";} ?>
							<?php if($presentada_representante != "") { echo $presentada_representante;} ?></p></li>
						</ul>
						<? the_content(); ?>					
						<div class="pleca-sub-info"></div>
						<ul class="sub-info">
							<li class="sub-info-li"><?php echo get_post_meta($post->ID, 'wp_fecha_votacion_tm', true); ?></li>
							<li class="sub-info-li"><?php echo get_post_meta($post->ID, 'wp_presentada', true); ?> Legislatura</li>
						</ul>
					</div>
                                         <?php endwhile; endif; ?>
				</main>
					
				<!--end content-->
				
                <!-- inicio barra leteral derecha -->
		<aside class="sidebar sidebar_right three alpha units" role="complementary">
			<div class="sidebar-votos">
				<p class="vota">Vota</p>
				<p class="encurul"> en curul</p>
			</div>
			<div class="textwidget share-sidebar-vota">
			         <?php avia_social_share_links(); ?>
			</div>
			<!-- empieza sidebar-->
			<div class="textwidget sb">
				<div class="linea-morado"></div>
				<div class="tab-item-temas">
			        <p class="tema-img"> Temas:</p>
				<p class="parrafo-temas"><?php echo str_replace('|', ", ", get_post_meta($post->ID, 'wp_topics', true)); ?>
				</p>
				</div>
				
			</div>
			
			<div class="textwidget sb-1">
				<div class="linea-morado"></div>
				<div class="tab-item-temas">
				<p class="texto-img">Texto integro</p>
				</div>			
			</div>
			<div class="textwidget sb-2">			
				<div class="linea-morado"></div>
				<a href="<?php echo get_post_meta($post->ID, 'wp_enlace_gaceta', true); ?>"> <p class="gaceta-img">Gaceta parlamentaria</p></a>
			</div>
		</aside>
		<!-- votaciones en pleno -->
										<?php if($voto != "") {
										foreach($voto as $value) {
											$resArray = explode(":", $value->total);
											}
											?>
										
		<div class="container votyacion-pleno" itemtype="https://schema.org/WPFooter" itemscope="itemscope" role="contentinfo">			
			<div id="av-layout-grid-1" class="av-layout-grid-container av-flex-cells avia-builder-el-0 avia-builder-el-no-sibling container_wrap fullsize">	
					<div class="flex_cell no_margin av_one_fifth avia-builder-el-1 el_before_av_cell_three_fifth avia-builder-el-first pleno">
						<div class="flex_cell_inner">
						<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
						<div class="avia_textblock " itemprop="text">
						<p class="titulos-voto">Votaci&oacute;n <span>en pleno</span> </p>
						</div>
						</section>
						</div>
					</div>				
					<div class="flex_cell no_margin av_three_fifth avia-builder-el-3 el_after_av_cell_one_fifth el_before_av_cell_one_fifth " style="vertical-align:top;padding:0 10px 0 10px ;">
						<div class="flex_cell_inner">
						<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
						<div class="avia_textblock " itemprop="text">
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pri-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up">5000
										</li >										
										<li class="hand-down">2000
										</li >
									</ul>
								</div>
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pan-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up">5000
										</li >										
										<li class="hand-down">2000
										</li >
									</ul>
								</div>																
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/prd-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up">5000
										</li >										
										<li class="hand-down">2000
										</li >
									</ul>
								</div>								
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pvem-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up">5000
										</li >										
										<li class="hand-down">2000
										</li >
									</ul>
								</div>								
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/panal-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up">5000
										</li >										
										<li class="hand-down">20000
										</li >
									</ul>
								</div>								
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pmc-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up">50000
										</li >										
										<li class="hand-down">2000
										</li >
									</ul>
								</div>								
							</div>			
						</div>
						</section>
						</div>
					</div>				
					<div class="flex_cell no_margin av_one_fifth avia-builder-el-5 el_after_av_cell_three_fifth avia-builder-el-last " style="vertical-align:top;padding:0 0 0 10px ;">
						<div class="flex_cell_inner">
						<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
						<div class="avia_textblock " itemprop="text">
						<p class="num-votos-pleno"><?php echo$resArray[0];?></p>
						<p class="total-votos-pleno">Votos totales</p>			
						</div>
						</section>
						</div>
					</div>
			</div>
			
			
			
		<div class="container griss">
			<a class="grafikas" href="">Ver gr&aacute;ficas de las votaciones en pleno</a>                         
		</div>
									<?php } ?>
			<div class="flex_column av_one_half first avia-builder-el-0 el_before_av_one_half avia-builder-el-first">
				<div class="flex_column av_one_half first avia-builder-el-0 el_before_av_one_half avia-builder-el-first status-i">				
				<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
				<div class="avia_textblock " itemprop="text">
				<p class="titulos-voto">Status <span>de la</span></p><p class="titulos-voto-2"><span">iniciativa</span></p>
				</div>
				</section>
				</div>
				
				<div class="flex_column av_one_half avia-builder-el-2 el_after_av_one_half avia-builder-el-last ">
				<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
				<div class="avia_textblock " itemprop="text">
				<p class="resultado"><?php echo $elements[$status_final]; ?></p>
				</div>
				</section>
                         </div>
			</div>
		
		        <div class="flex_column av_one_half avia-builder-el-2 el_after_av_one_half avia-builder-el-last ">
				<div  itemprop="text">
				<a class="avia_textblock boton-proceso" href="">Clic para ver proceso legislativo</a>
				</div>
                         </div>

		</div>
                

		</div><!--end container fin de iniciativa-->
		<div class="container tabla">
			Aqu&iacute; va la tabla
		</div>			
                <div class="container top60">
			<?php			    		    
		        comments_template( '/includes/comments.php');
		        ?>
			</div>
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>