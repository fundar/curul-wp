<?php
global $avia_config;

	 get_header();

 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
	 ?>
	<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
	    <div class='container'>
		<main class='template-page content  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>              
			
			<div class="flex_column av_one_full first  avia-builder-el-1  el_after_av_revolutionslider  avia-builder-el-no-sibling  ">
				<div class="container">
					<div class="template-page content nine alpha units">
					     <div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">
							     <div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first ">
								    INICIATIVAS
							     </div>
						    </div>
					     </div>
					</div><!--fin iniciativas-->	
					<aside class="sidebar sidebar_right three alpha units" role="complementary">
					<div class="inner_sidebar extralight-border">
					<?php get_sidebar(); ?>	
					4t456y547y
					</div>
					</aside>
				</div>	
			</div>		     
		</main> 
	   </div><!--end container-->
	</div><!-- close default .container_wrap element -->



<?php get_footer(); ?>	