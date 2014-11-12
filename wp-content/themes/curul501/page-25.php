<?php
global $avia_config;

	 get_header();

 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
	 ?>
	<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
	<?php putRevSlider("carrusel-home","homepage") ?>
	    <div class='container'>
		<main class='template-page  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>              
			
			
				<div class="container_wrap container_wrap_first main_color sidebar_right ">
				
					<div class="content  nine alpha units">
					     <div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">
								<h1 class="entry-title-yellow">Iniciativas Recientes</h1>
								<div class="line-amarilla"> </div>
								
				 <!--Inicio iniciaiva--><article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small pleca-29193E">
									<div class="entry-content-wrapper clearfix">
										<div class="entry-content-wrapper clearfix">
											<!--Inicio fecga y resumen-->
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first topTop">
												<div class="post_date">
													<span>03</span>
													Feb, 2014
												</div>
												<div class="entry-content">
													<p class="resemen-recientes-iniciativas">
														Dar autonomia a los organos garantes federal y estatales, dar facultad al IFAI para promover acciones
														de inconstitucionalidad y ampliar sujetos obligados (sindicatos, partidos politicos, fideicomisios publicos).
													</p>
												</div>
											</div><!--fin fecha y resumen-->
											<div class="flex_column av_one_third avia-builder-el-2 el_after_av_two_third avia-builder-el-last topTop leftRI">
												<div class="flex_column av_one_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first ">
													<div class="datos">
													Status
													</div>
												</div> 
												<div class="flex_column av_one_third avia-builder-el-1 el_after_av_one_third el_before_av_one_third ">
														 <div class="datos">
												                 Votaci&oacute;n final
														 </div>
												</div>
												<div class="flex_column av_one_third avia-builder-el-2 el_after_av_one_third avia-builder-el-last ">
													<div class="datos">
												         Propuesta por:
													</div>
												</div>
													
											</div>
											
										</div>
									</div>
							</article>
							
						    </div>
					     </div>
					</div><!--fin iniciativas-->					
				</div>
				
					     
		</main>
		
               
		<?php

		//get the sidebar
		$avia_config['currently_viewing'] = 'page';
		get_sidebar();

		?>
			 
						 
					
	   </div><!--end container-->
	</div><!-- close default .container_wrap element -->



<?php get_footer(); ?>	