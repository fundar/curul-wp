<?php
global $avia_config;

	 get_header();

 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
	 ?>
	<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
	<?php putRevSlider("carrusel-home","homepage") ?>
	    <div class='container'>
		<main class='template-page  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>              
			
			<div class="flex_column av_one_full first  avia-builder-el-1  el_after_av_revolutionslider  avia-builder-el-no-sibling  ">
				<div class="container">
					<div class="content  nine alpha units">
					     <div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">							     
								<h1 class="entry-title-yellow">Iniciativas Recientes</h1>
								<div class="line-amarilla"> </div>
								<div class="container template-blog ">
									<div class="post_date">
										<div class="post_date">
										<span>03</span>
										Jul
										</div>
									</div>
								</div>								
							    
						    </div>
					     </div>
					</div><!--fin iniciativas-->					
				</div>	
			</div>		     
		</main>
		
               
		<?php

		//get the sidebar
		$avia_config['currently_viewing'] = 'page';
		get_sidebar();

		?>
			 </div></div>
						 
					
	   </div><!--end container-->
	</div><!-- close default .container_wrap element -->



<?php get_footer(); ?>	