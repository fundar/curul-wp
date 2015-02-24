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
						
						<div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">
					                <?php if ( have_posts() ) : ?>
					                <?php
									$args = array( 'post_type' => 'preocupacion', 'posts_per_page' => 5 );
									
														

								
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
			                                                                                 <a class="iniciativas-home" href="<?php echo $link ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
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
							
						    </div>
					</div>
				</div>
					
		<!--end content-->			
		</main>				    
                <!--sidebar-->
	
		</div><!--end sidebar-->
				
	   </div><!--end container-->
	</div><!-- close default .container_wrap element -->

 
<?php endif; ?>	

<?php get_footer(); ?>	

