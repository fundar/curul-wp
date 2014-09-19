<?php
	global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();



	

?>

		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		

			<div class='container template-blog template-single-blog '>
				<div class="container">
					<div class="content  nine alpha units">
					     <div class="post-entry post-entry-type-page post-entry-25">
						    <div class="entry-content-wrapper clearfix">							     
								<h1 class="entry-title-yellow">Iniciativas Recientes</h1>
								<div class="line-amarilla"> </div>
							    
						    </div>
					     </div>
					</div>
				</div>

				<main class='content units <?php avia_layout_class( 'content' ); ?> <?php echo avia_blog_class_string(); ?>' <?php avia_markup_helper(array('context' => 'content','post_type'=>'post'));?>>

                    <?php
                    /* Run the loop to output the posts.
                    * If you want to overload this in a child theme then include a file
                    * called loop-index.php and that will be used instead.
                    *
                    */

                        get_template_part( 'includes/loop', 'index' );
						
                        //show related posts based on tags if there are any
                        get_template_part( 'includes/related-posts');

                        //wordpress function that loads the comments template "comments.php"
                        comments_template( '/includes/comments.php');

                    ?>

				<!--end content-->
				</main>

				<?php
				$avia_config['currently_viewing'] = "blog";
				//get the sidebar
				get_sidebar();


				?>


			</div><!--end container-->

		</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>