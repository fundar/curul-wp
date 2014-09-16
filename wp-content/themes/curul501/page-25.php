<?php
global $avia_config;

	 get_header();

 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
	 ?>
	<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
	    <div class='container'>
		<main class='template-page  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>              
		<?php
		/* Run the loop to output the posts.
		* If you want to overload this in a child theme then include a file
		* called loop-page.php and that will be used instead.
		*/
		$avia_config['size'] = avia_layout_class( 'main' , false) == 'entry_without_sidebar' ? '' : 'entry_with_sidebar';
		get_template_part( 'includes/loop', 'page' );
		?>			
			<div class="flex_column av_one_full first  avia-builder-el-1  el_after_av_revolutionslider  avia-builder-el-no-sibling  ">
				<div class="container">
					<div class="content  nine alpha units">
					     <div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">							     
								<h1 class="entry-title">INICIATIVAS</h1>
								<div class="line-amarilla"> </div>
							    
						    </div>
					     </div>
					</div><!--fin iniciativas-->	
					<aside class="sidebar sidebar_right three alpha units" itemtype="https://schema.org/WPSideBar" itemscope="itemscope" role="complementary">
                                                 <div class="inner_sidebar extralight-border">
				                  
						 </div>
						 
					</aside>
					
				</div>	
			</div>		     
		</main> 
	   </div><!--end container-->
	</div><!-- close default .container_wrap element -->



<?php get_footer(); ?>	