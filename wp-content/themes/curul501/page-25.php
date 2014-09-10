<?php
global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();


 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
	 ?>

		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		        <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullscreen-container" style="background-color: rgb(233, 233, 233); padding: 0px; position: absolute; max-height: none; overflow: visible; left: 0px; width: 1642px; height: 534px;">
			<?php putRevSlider("carrusel-home","homepage") ?>
			</div>


			<div class='container'>

			

                
				<!--end content-->
				
				</main>

				

			</div><!--end container-->

		</div><!-- close default .container_wrap element -->
		



<?php get_footer(); ?>