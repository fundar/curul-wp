<?php
global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();


 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
	 ?>

		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

			<div class='container'>
                                   
				<main class='template-page content  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>        
				<!--end content-->
				               <div id="after_layer_slider_1" class="main_color container_wrap fullsize">
					<div class="container">
						jhgkll
					</div>
		</div>	
				</main>
			</div><!--end container-->
		</div><!-- close default .container_wrap element -->

		
				
				<!--fin iniciativas-->

<?php get_footer(); ?>