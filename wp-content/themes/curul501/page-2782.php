<?php
global $avia_config;

	 get_header();
							
	 
 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
		
	?>
	<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
	<?php	 putRevSlider("carrusel-home","homepage") ?>
	   														

	   <div class='container'>
		<main class='template-page  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>              
			
			
				<div class="container_wrap container_wrap_first main_color sidebar_right">
					<div class="content  nine alpha units">
						<div class="post-entry-25">
						<h1 class="entry-title-yellow">Iniciativas <?php echo $tipo; ?></h1>
						<div class="line-amarilla"> </div>
						</div>
						<div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">
					                <?php if ( have_posts() ) : ?>
					                <?php
									$args = array( 'category_name' => 'preocupaciones', 'posts_per_page' => 5 );
									
														

								
						        $loop = new WP_Query( $args );
						        while ( $loop->have_posts() ) : $loop->the_post(); ?>
				 <!--Inicio iniciaiva-->
				
													
																
				 <!--Inicio iniciaiva-->
				 <article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small pleca-624070">
									<div class="entry-content-wrapper clearfix">
										<div class="entry-content-wrapper clearfix">
											<!--Inicio fecga y resumen-->
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first topTop">
												<div class="post_date">
													<span><?php echo $dia; ?></span>
													<?php echo $meses[$mes]; ?>, <?php echo $ano; ?>
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
													<div class="temporizador"> 
													<p><?php echo $elements[$status_final]; ?></p>
													</div>
													</div>													
												</div> 
												<?php
																								
												  if($votos != "") { ?>
												
												<div class="col-status-1">
													<div class="datos">
													Votaci&oacute;n final													
													</div>
													<div class="votos-oficiles">
														
													</div>
													<div class="hands-vote">
									                                <ul>
													        <li class="hand-up"><?php echo $decode[8]['favor']; ?></li>
													        <li class="hand-down"><?php echo $decode[8]['contra']; ?></li>
													</ul>
									
													</div>
												</div>
																					<?php } else {  ?>

																					<div class="col-status-1">
													<div class="datos">
													Votaci&oacute;n final													
													</div>
													<div class="votos-oficiles">
													<p class="estiloEstatusP">Sin Votaci&oacute;n</p>													
													</div>
													
												</div>											
																					<?php } ?>

																					

												
												<div class="col-status-2">
													<div class="datos">Propuesta por:</div>
													<p class="estiloEstatusP">	<?php
														if($presentada_dependencia != "") { echo $presentada_dependencia."";} 
														if($presentada_partido != "") { ?> <a href="<?php echo get_site_url() . '/iniciativas/?partido-politico=' . $partido_politico_slug; ?>"> <?php echo  $presentada_partido;}
														if($presentada_representante != "") { ?> <a href="http://www.curul501.org/representantes/<?php echo $presentada_representante_slug ?>"> <?php echo  str_replace('|', " ", $presentada_representante);} ?> </a>

													</p>
													
													
												</div>													
											</div>
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first">
												<div class="in-box-share">
												<?php avia_social_share_links(); ?>
												</div>
											</div>
											<div class="vta-curul">
												<span>
													Votos en Curul 501: 
													<b style="font-size: 1.2em; font-family: oswald; font-weight: normal; margin-left: 5px ">
														<?php echo ( get_post_meta($post->ID, 'wp_total_participaciones', true) )? get_post_meta($post->ID, 'wp_total_participaciones', true) : 0; ?> 
													</b>
												</span>
												<div class="box"><?php avia_social_share_links(); ?></div>
												
												
												
												
											</div>

											
										</div>
									</div>
							</article>
							<!--fin iniciativas-->
											<?php endwhile; ?>
							
						    </div>
					</div>
				</div>
					
		<!--end content-->			
		</main>				    
                <!--sidebar-->
		<div class="sidebar sidebar_right smartphones_sidebar_active alpha units" itemtype="https://schema.org/WPSideBar" itemscope="itemscope" role="complementary">
                <div class="inner_sidebar">
		<?php if ( !function_exists('dynamic_sidebar')|| !dynamic_sidebar('sidebar inicio') ) : ?>
		<?php endif; ?>
			
                </div>
		</div><!--end sidebar-->
				
	   </div><!--end container-->
	</div><!-- close default .container_wrap element -->

 
<?php endif; ?>	

<?php get_footer(); ?>	

