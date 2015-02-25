<?php 
get_header(); 
global $dposttitle;
$dposttitle = wp_title( '', false);
	global $avia_config, $more;

?>
<style type="text/css">
		#wrap_all #header{
			display:none;
		}
		.titulo h2{
			color: #000;
 			font-family: oswald;

 			font-weight: normal;
 			padding: 10px;
 			font-size: 4em;
		}

		.titulo h2 #general{
			color: #502760;
		}

		.titulo h2 #general small{
			color: #60466B;
 			padding: 10px;
 			font-size: 1em;
		}

		.titulo h2 #general small b{
 			font-size: 1.5em;
		}

		#original{
			height: 600px;
			min-height: 600px;
			background: #fff;
		}

		

		#banner .num{
			background: #ccc;
 			font-family: oswald;
			min-height: 340px;
			max-width: 340px;
			font-size: 15em;
			padding: 130px;
			margin-left: 20px;
			float:left;

		}

		.iniciativa-original{
			background: #fff;
			padding: 40px 20px 20px 20px;
			float:left;
			max-width: 66%;
			margin-top: 140px;

		}
		
		.iniciativa-original h3{
 			font-size: 2.5em;
 			color:#502760;
		}
		.iniciativa-original .texto p{
 			font-weight: lighter;
 			font-size: 1.6em;
 			font-family: "colaborate-thinregular";
 			color:#000;
		}

		section#modificaciones{
			margin: 30px;
			padding-top:40px; 

		}

		#modificaciones article{
			max-width: 30%;
			float:left;
			margin-right: 40px;
		}

		#modificaciones article h3{
			color:#593A57;
			padding-bottom: 10px;
			border-bottom: 1px solid #593A57;
			font-size: 1.9em;
		}

		#modificaciones article .texto p{
 			font-family: "colaborate-thinregular";
 			color:#000;
 			font-size: 1.6em;

		}
		
		#modificaciones article span {
 			font-size: 1.3em;
		}
		#modificaciones article span strong {
			color: #502760;
 			font-size: 1.2em;
		}

		.sep{
			border-bottom: 1px solid #502760;
			margin-top: 40px;
		}

		.reddit-voting{
	    background-color: #502760;
	    float: right;
			width: 130px;
			height: 45px;
	    padding: 10px 20px ;
		}
		
		
		
</style>

<?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
						
						
					<?php $id_preocupacion    = get_post_meta($post->ID, 'id_preocupacion', true);  ?>
<style type="text/css">
	
	#banner{
			min-height: 300px;
			height: 300px;
			background: url("http://curul501.org/wp-content/uploads/preocupaciones/<?php echo $id_preocupacion ?>.png");
			width: 100%;
		}

</style>

<body>
	<header class="titulo">
		<h2> 
			<span id="general"> LAS 8<small><b>+</b>1</small> </span> <br>
			CONOCE LOS RETROCESOS QUE PODRÍAN <br>
			APROBARSE EN LA NUEVA LEY DE TRANSPARENCIA
		</h2>
	</header>

	<div id="original">
		<div id="banner">
			<div class="num"> <?php if($id_preocupacion==9){ ?> 8+1 <?php } else { ?> <?php echo $id_preocupacion; }?>  </div>
			
			<section class="iniciativa-original">
				<h3 id="titulo">  
							<?php the_title(); ?>
				</h3>

				<div class="texto">
																	<? the_content(); ?>					

				
				</div>
			</section>
		</div>
		<div class="compartir">
	<?php avia_social_share_links(); ?>	
	</div>
	</div>
	<section id="modificaciones">
					                                    <?php endwhile; endif; ?>

	

																	<?php 	if ( have_posts() ) : 
																		   $args = array('post_type' => 'modificacion',
																						'meta_query' => array(
																			array (
																						'key'     => 'id_preocupacion',
																						'value'   => $id_preocupacion,
																						'compare' => 'LIKE'
																									)
																								)
																							);

																			$loop  = new WP_Query($args);
																		   while ( $loop->have_posts() ) : $loop->the_post(); ?>
	
	
		
		<article>
			<h3 class="responsable"> <?php the_title(); ?> </h3>
			<div class="texto"> <?php the_content(); ?>	</div>
			<span> Votos en curul501.org: <?php echo ( get_post_meta($post->ID, 'wp_total_participaciones', true) )? get_post_meta($post->ID, 'wp_total_participaciones', true) : 0; ?>  </span>
		</article>
				
						<?php endwhile; ?>
							<?php endif; ?>	
	</section>

	<section id="comentarios">
		<div class="container top60">
					<?php wp_reset_query(); ?>
			        <?php comments_template( '/includes/comments.php'); ?>
		        <?php get_footer(); ?>

			</div>
	</section>


</body>