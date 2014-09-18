<?php get_header(); ?>

		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>

			<div class='container template-blog template-single-blog '>

				<main class="content units">
					
					<?php if(have_posts()): the_post(); ?>
		                        <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php the_content(); ?>
					<p class="postmetadata"><?php _e( 'Posted in' ); ?> <?php the_category( ', ' ); ?></p>
					 <?php endwhile; else : ?>
					  <?php endif; ?>

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