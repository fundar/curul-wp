<?php get_header(); 
	
	global $avia_config, $more;
	$data = getDataIniciativas();
	$selectedPolitical = getParameterValueGET('partido-politico');
	$selectedCommission = getParameterValueGET('comision');
	$selectedTema = getParameterValueGET('tema');
	$selectedStatus = getParameterValueGET('status');
	$selectedPostulante = getParameterValueGET('postulante');

?>
 	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/libs/d3.v3.min.js" type="text/javascript"></script>
	<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js">  </script>
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/scripts/app.js" type="text/javascript"></script>

	<style type="text/css">

		.post-title{
		}

		#documento_lnk{
			margin-top:10px;
   			font-family: oswald;
   			font-weight: lighter;
   			font-size: 1.3em;
   			float:right;
   			color:#aaa;
		}

		#documento_lnk:hover{
   			color:#512B60;
			
		}


	</style>
		
		<div class="container top60">										     
						<h1 class="entry-title-yellow">Preocupaciones </h1>
						<div class="line-amarilla"> </div>
		</div>

		<!--Inicio filtros iniciativas -->
		

<!-- Fin filtros iniciativas -->		
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
						
			<div class='container template-blog template-single-blog '>

				<main class="content units av-content-small alpha cpt-iniciativa" role="main">
				        <header class="entry-content-header">
						<a href="#documento" id="documento_lnk"> Ir a cuadro comparativo </a>
						<h1 itemprop="headline" class="post-title entry-title">
							<?php the_title(); ?>
						</h1>
						<div class="linea-morado"></div>
						<h3 itemprop="headline" class="post-title entry-title">
													<? the_content(); ?>					

						</h3>
					</header>
					
                                         <?php endwhile; endif; ?>
				</main>
					
				
										
	

				</div>
		
				
				
				<div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">
					                <?php if ( have_posts() ) : ?>
					                <?php
									$args = array( 'post_type' => 'modificacion', 'posts_per_page' => 5 );
								   $loop = new WP_Query( $args );
						           while ( $loop->have_posts() ) : $loop->the_post(); ?>
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
			                                                                                 <a class="iniciativas-home" href= "<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
												         </p>
													 <?php the_excerpt(); ?> 
                          
												</div>
											</div><!--fin fecha y resumen-->
											
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
							<?php endif; ?>	

						    </div>
					</div>

				
				
				
				
		
		
		
		


        
		
		
		
		
		
		
		
		<div class="container top60">
			<?php			    		    
		        comments_template( '/includes/comments.php');
		        ?>
			</div>
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>
