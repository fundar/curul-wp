<?php
global $avia_config;

	 get_header();

 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
	 ?>
	<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
	<?php putRevSlider("carrusel-home","homepage") ?>
	    <div class='container'>
		<main class='template-page  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>              
			
			
				<div class="container_wrap container_wrap_first main_color sidebar_right">
					<div class="content  nine alpha units">
						<div class="post-entry-25">
						<h1 class="entry-title-yellow">Iniciativas Recientes</h1>
						<div class="line-amarilla"> </div>
						</div>
						<div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">
					                <?php if ( have_posts() ) : ?>
					                <?php
						        //$args = array( 'post_type' => 'iniciativa', 'posts_per_page' => 10 );
								
								$args = array(
	'posts_per_page' => '10',
    'post_type' => 'iniciativa',
    'order' => 'DESC',
    'meta_key' => 'post_views_count',
    'orderby' => 'meta_value_num');
								
						        $loop = new WP_Query( $args );
						        while ( $loop->have_posts() ) : $loop->the_post(); ?>
				 <!--Inicio iniciaiva-->
				
				
				<?php										
														$presentada_representante	    = get_post_meta($post->ID, 'wp_presentada', true);
														$presentada_partido	            = get_post_meta($post->ID, 'wp_presentada_partidos', true);
														$presentada_dependencia	        = get_post_meta($post->ID, 'wp_presentada_dependencias', true);
														$votos 	= get_post_meta($post->ID, 'wp_votos', true);
													    $WorkingArray = json_decode(json_encode($votos),true);
												        $decode = json_decode($WorkingArray, true);
														$status_iniciativa             	        = get_post_meta($post->ID, 'wp_status', true);
														$elements = explode("|", $status_iniciativa);
														$status_final=count($elements)-1;
													    $presentada_representante_slug	    = get_post_meta($post->ID, 'wp_presentada_slug', true);
														$presentada_representante_slug = str_replace('|', "-", $presentada_representante_slug);

														?>
								
																
				 <!--Inicio iniciaiva-->
				 <article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small pleca-624070">
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
														<?php	echo $decode[8]['total']; ?>
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
														if($presentada_dependencia != "") { echo $presentada_dependencia.", ";} 
														if($presentada_partido != "") { echo $presentada_partido.", ";} 
														if($presentada_representante != "") { echo str_replace('|', ", ", $presentada_representante);} 
														?>
													</p>
													
													
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