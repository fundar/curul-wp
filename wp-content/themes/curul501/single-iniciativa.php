<?php get_header(); ?>
		<div class="container top60">										     
						<h1 class="entry-title-yellow">Iniciativas</h1>
						<div class="line-amarilla"> </div>
		</div>

		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		
			<div class='container template-blog template-single-blog '>

				<main class='content units <?php avia_layout_class( 'content' ); ?> <?php echo avia_blog_class_string(); ?>' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>
				        <header class="iniciativa entry-content-header">
						<h1 itemprop="headline" class="post-title entry-title">
							Phasellus viverra eros vel sem blandit, quis scelerisque neque malesuada
						</h1>
						<h2 itemprop="headline" class="post-title entry-title">
							Con proyecto de decreto, que reforma y adiciona los articulos 6o., 73, 76, 78, 89, 105, 108, 110, 111, 116 y 122 
						</h2>
					</header>
					<div class="entry-content" itemprop="text">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ultrices aliquet condimentum. Aenean id tristique ligula. Nunc sed varius turpis, nec malesuada risus. Donec convallis tellus vitae ligula sagittis malesuada. Proin vitae quam hendrerit, pretium erat id, semper dolor. Nam ornare eget turpis eget rutrum. Morbi ante sem, aliquet vel laoreet et, molestie ut metus. Cras tincidunt convallis nibh, a egestas purus egestas quis. Maecenas non placerat dui, vel iaculis tellus. Etiam tempor lorem elit, a lobortis velit viverra sed. Pellentesque volutpat pretium nisl ac interdum. Sed accumsan, odio vitae convallis fringilla, elit ligula imperdiet augue, ut ullamcorper nulla sapien a dolor. Etiam aliquet enim eget tristique rutrum. Nulla non augue libero. Cras rutrum enim mi, in vehicula diam suscipit eget. Aenean elementum metus nec velit ultrices imperdiet.</p>
					</div>

				</main>
					
				<!--end content-->
				

			<aside class="sidebar sidebar_right three alpha units" role="complementary">
			<?php avia_social_share_links(); ?> 	
			</aside>


			</div><!--end container-->
                        <div class="container top60">					<?php			    
					    //show related posts based on tags if there are any
					    get_template_part( 'includes/related-posts');
		    
					    //wordpress function that loads the comments template "comments.php"
					    comments_template( '/includes/comments.php');
		    
					?>
			</div>
		</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>