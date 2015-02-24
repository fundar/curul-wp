<?php get_header(); ?>

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

		#banner{
			min-height: 300px;
			height: 300px;
			background: none repeat scroll 0 0 rgba(250, 124, 0, 1) !important;
			width: 100%;
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
			<div class="num"> 1 </div>
			<section class="iniciativa-original">
				<h3 id="titulo">  
					Información sobre violaciones graves a derechos humanos y delitos de lesa humanidad
				</h3>

				<div class="texto">
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nisi dolor, malesuada ut diam id, congue
						consectetur ligula. Praesent ut sapien lobortis, blandit ipsum ac, dapibus justo. Curabitur nec orci
						fermentum, commodo massa sed, dignissim sapien. Cras pretium ante sapien, ut ultrices nunc blandit
						in. Duis ac efficitur tortor. Nunc consequat ut erat vel elementum. Cras commodo mauris augue, sit
						amet sagittis risus tincidunt quis. Donec volutpat odio vel ornare luctus. Cras posuere non enim ut
						consectetur. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
						Curabitur efficitur consectetur sem vitae sollicitudin. Praesent rutrum justo eu sem sodales rutrum.
						Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce arcu velit, placerat id libero nec,
						euismod scelerisque magna. Donec consequat orci ac maximus euismod. In eget accumsan lectus.
					</p>

					<p>
						Fusce volutpat eu purus eget pretium. Duis auctor, felis ac semper lobortis, enim lacus cursus eros, eu
						euismod neque augue vitae lacus. Etiam sodales nulla at felis pretium lacinia at placerat dui. Nunc id mi
						dolor. Aliquam luctus massa sit amet magna iaculis, et pretium ante commodo. Fusce vitae euismod
						mauris. Quisque tempor lobortis lorem eget sollicitudin.
					</p>			
				</div>
			</section>
		</div>
	</div>

	<div class="compartir">
		<!--div class="box"><?php avia_social_share_links(); ?></div-->
	</div>


	<section id="modificaciones">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php $total = get_post_meta($post->ID, 'wp_total_participaciones', true); ?>
			<article>
				<h3 class="responsable"> <?php the_title(); ?> </h3>
				<div class="texto"> <?php the_content(); ?>	</div>
				<div class="sep"></div>
				<span>  Total de Participaciones: <strong> <?php echo ($total || $total != '')? $total : 0; ?> </strong> </span>
			</article>
				
		<?php endwhile; endif; ?>
	</section>

	<section id="comentarios">
		
	</section>

	<script type="text/javascript">
		jQuery("document").ready(function(){
			
			/* Cambiar de pocisión el área de votos*/
			var redits = jQuery(".reddit-voting")
			redits.each( function(index){ jQuery(this).parents("article").append(this) })
		
		})
	</script>
</body>