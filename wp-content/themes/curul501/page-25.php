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
								
					                        <article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small ">
									<div  class="container av-content-full units">
										<div class="container template-blog">
												<div class="post_date">
												<span>03</span>
												Feb, 2014
												</div>
												<div class="entry-content">
												<p>
													Dar autonomía a los órganos garantes federal y estatales, dar facultad al IFAI para promover acciones de inconstitucionalidad y ampliar sujetos obligados (sindicatos, partidos políticos, fideicomisios públicos).
												</p>
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