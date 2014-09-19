<?php get_header(); ?>
		<div class="container top60">										     
						<h1 class="entry-title-yellow">Iniciativas</h1>
						<div class="line-amarilla"> </div>
		</div>

		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		
			<div class='container template-blog template-single-blog '>

				<main class='content units <?php avia_layout_class( 'content' ); ?> <?php echo avia_blog_class_string(); ?>' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>

					        <?php
						
						if (have_posts()) :
						
							while (have_posts()) : the_post();
						?>
						
								<article class='post-entry post-entry-type-page <?php echo $post_class; ?>' <?php avia_markup_helper(array('context' => 'entry')); ?>>
						
									<div class="entry-content-wrapper clearfix">
								<?php
								echo '<header class="entry-content-header">';
								    $thumb = get_the_post_thumbnail(get_the_ID(), $avia_config['size']);
						
								    if($thumb) echo "<div class='page-thumb'>{$thumb}</div>";
								echo '</header>';
						
								//display the actual post content
								echo '<div class="entry-content" '.avia_markup_helper(array('context' => 'entry_content','echo'=>false)).'>';
								    the_content(__('Read more','avia_framework').'<span class="more-link-arrow">  &rarr;</span>');
								echo '</div>';
						
								echo '<footer class="entry-footer">';
								wp_link_pages(array('before' =>'<div class="pagination_split_post">',
											'after'  =>'</div>',
											'pagelink' => '<span>%</span>'
											));
								echo '</footer>';
								
								do_action('ava_after_content', get_the_ID(), 'page');
								?>
									</div>
						
								</article><!--end post-entry-->
						
						
						<?php
							$post_loop_count++;
							endwhile;
							else:
						?>
						
						    <article class="entry">
							<header class="entry-content-header">
							    <h1 class='post-title entry-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
							</header>
						
							<?php get_template_part('includes/error404'); ?>
						
							<footer class="entry-footer"></footer>
						    </article>
						
						<?php
						
							endif;
						?>
				</main>
					
				<!--end content-->
				

			<aside class="sidebar sidebar_right three alpha units" role="complementary">
				
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