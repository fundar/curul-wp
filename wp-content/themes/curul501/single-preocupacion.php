<?php get_header(); 
	
	global $avia_config, $more;
	$data = getDataIniciativas();
	$selectedPolitical = getParameterValueGET('partido-politico');
	$selectedCommission = getParameterValueGET('comision');
	$selectedTema = getParameterValueGET('tema');
	$selectedStatus = getParameterValueGET('status');
	$selectedPostulante = getParameterValueGET('postulante');

?>
 	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/libs/d3.v3.min.js" type="text/javascript"></script>
	<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js">  </script>
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/scripts/app.js" type="text/javascript"></script>

	<style type="text/css">

		.post-title{
		}

		#documento_lnk{
			margin-top:10px;
   			font-family: oswald;
   			font-weight: lighter;
   			font-size: 1.3em;
   			float:right;
   			color:#aaa;
		}

		#documento_lnk:hover{
   			color:#512B60;
			
		}


	</style>
		
		<div class="container top60">										     
						<h1 class="entry-title-yellow">Preocupaciones </h1>
						<div class="line-amarilla"> </div>
		</div>

		<!--Inicio filtros iniciativas -->
		

<!-- Fin filtros iniciativas -->		
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
						
			<div class='container template-blog template-single-blog '>

				<main class="content units av-content-small alpha cpt-iniciativa" role="main">
				        <header class="entry-content-header">
						<a href="#documento" id="documento_lnk"> Ir a cuadro comparativo </a>
						<h1 itemprop="headline" class="post-title entry-title">
							<?php the_title(); ?>
						</h1>
						<div class="linea-morado"></div>
						<h3 itemprop="headline" class="post-title entry-title">
							<?php echo get_post_meta($post->ID, 'wp_titulo_listado', true); ?>
						</h3>
					</header>
					
                                         <?php endwhile; endif; ?>
				</main>
					
		
					  <?php if ( have_posts() ) : ?>
					                <?php
									$args = array( 'post_type' => 'modificacion', 'posts_per_page' => 5 );
									
														

								
						        $loop = new WP_Query( $args );
						        while ( $loop->have_posts() ) : $loop->the_post();
							<?php echo get_post_meta($post->ID, 'wp_titulo_listado', true); ?>
							<?php the_title(); ?>


								<?php endwhile; endif; ?>

													
	  	
	  
			
		     

		

			
                <div class="container top60">
			<?php			    		    
		        comments_template( '/includes/comments.php');
		        ?>
			</div>
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>
