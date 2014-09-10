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

                    <?php
                    /* Run the loop to output the posts.
                    * If you want to overload this in a child theme then include a file
                    * called loop-page.php and that will be used instead.
                    */

                    $avia_config['size'] = avia_layout_class( 'main' , false) == 'entry_without_sidebar' ? '' : 'entry_with_sidebar';
                    get_template_part( 'includes/loop', 'page' );
                    ?>
                     <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullscreen-container" style="background-color: rgb(233, 233, 233); padding: 0px; position: absolute; max-height: none; overflow: visible; left: 0px; width: 1642px; height: 534px;">
			<?php putRevSlider("carrusel-home","homepage") ?>
		    </div>
<div class="main_color container_wrap fullsize" id="after_layer_slider_1"><div class="container"><div class="template-page content  twelve alpha units"><div class="post-entry post-entry-type-page post-entry-25"><div class="entry-content-wrapper clearfix">
<div class="flex_column av_one_full first  avia-builder-el-1  el_after_av_revolutionslider  avia-builder-el-no-sibling  ">
<p></p><section itemtype="http://schema.org/CreativeWork" itemscope="itemscope" class="av_textblock_section"><div itemprop="text" class="avia_textblock "><p>Click here to add your own text</p>
</div></section>
</div>
</div></div></div></div></div><!--fin iniciativas-->
				<!--end content-->
				</main>

				<?php

				//get the sidebar
				$avia_config['currently_viewing'] = 'page';
				get_sidebar();

				?>

			</div><!--end container-->

		</div><!-- close default .container_wrap element -->



<?php get_footer(); ?>	