<?php 

get_header();
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

		section#preocupaciones{
			padding-top: 60px;
			background: #fff;
			width: 100%;
			min-height: 1200px;
		}

		section#preocupaciones ul{
			min-width: 100%;
		}

		li.preocupacion{
			width: 20%;
			margin: 30px 30px 140px 30px; 
			float:left;
			height: 420px;
		}

		.num{
			background: #ccc;
			padding: 0px 25px;
 			font-family: oswald;
			max-height: 60px;
			width: 100px;
			font-size: 3em;
		}

		.sep{
			border-bottom: 1px solid #999;
			margin: 5px 0px 0px 0px;
		}


		a.click_area{
			text-decoration: none;
		}

		.click_area:hover{
			cursor: pointer;
		}

		.click_area .textos{
			margin-top: 20px;
			min-height: 380px;
			color: #60466B;
		}
		
		.click_area .titulo, .titulo_ninja{
			font-size: 3.5em;
			margin-top: 0px;
		}

		.click_area .titulo, .ilustracion{
			z-index: -1;
		}

		.titulo_ninja{
			display: none;
			z-index: 3;
		}

		.click_area .titulo, .click_area .titulo-ninja{
			float: left;
		}

		.ilustracion{
			display: none;
			height: 380px;
			margin-bottom: 14px;
			width: 100%;
		}

		.votos{
			border-bottom: 1px solid #999;
			height: 30px;
		}

		.votos label{
			float: left;
			color: #444;
		}

		.votos strong{
			float: right;
		    color: #502760;
		    font-size: 1.5em;
		}

		.reddit-voting{
		    background-color: #502760;
		    float: right;
			width: 130px;
			height: 45px;
	    	padding: 10px 20px ;
		}

		/* Preocupación 8 + 1*/
		.preocupacion-8mas1{
			width: 100%;
			float:left;
			min-height: auto;
			height: auto;
			background: #fff;
			margin-top: -40px;
		}

		.preocupacion-8mas1 .click_area, 
		.preocupacion-8mas1 .num, 
		.preocupacion-8mas1 .votos{
			float: left;
		}

		.preocupacion-8mas1 .num{
			background: #fff;
			font-size: 24em;
			width: auto;
			color: #60466B;
			margin-top:150px; 
			min-height: 250px;
		}

		.preocupacion-8mas1 .num strong{
			color: #BEB1C4;
		}

		.preocupacion-8mas1 .textos{
			width: 800px;
		}

		

		.preocupacion-8mas1 .click_area{
			border-top: 1px solid #999;
			border-bottom: 1px solid #999;
		}

		.preocupacion-8mas1 .textos{
			margin-top: 20px;
			min-height: 250px;
			color: #60466B;
		}

		.preocupacion-8mas1 .titulo, .preocupacion-8mas1 .cursor{
			font-size: 3.5em;
			margin-top: 0px;
		}

		.preocupacion-8mas1 .titulo,{
			float: left;
		}

		.preocupacion-8mas1 .ilustracion{
			display: none;
			height: 380px;
			margin-bottom: 14px;
			width: 800px;
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

									<?php if ( have_posts() ) : 
					              
									$args = array( 'post_type' => 'preocupacion', 'order' => 'ASC', 'posts_per_page' => 9 );
									$loop = new WP_Query( $args );
									while ( $loop->have_posts() ) : $loop->the_post(); 
									
									$numero_preocupacion=get_post_meta($post->ID, 'id_preocupacion', true);
									$avatar_url = 'http://curul501.org/wp-content/uploads/preocupaciones/'.$numero_preocupacion.'.png';

												if($numero_preocupacion==9){
													$class="preocupacion-8mas1";
												} else {
														$class="preocupacion";
													}
														
												
												
									?>
									
								

	<section id="preocupaciones">
		<ul>
		
		
			<li class="<?php echo $class; ?>">
		<?php if($numero_preocupacion==9){ ?> <span class="num">8+<strong>1</strong> </span> <?php } else { ?> <span class="num"> <?php echo $numero_preocupacion; }?> </span>
			
			<div class="sep"></div>

				<a class="click_area" href="<?php the_permalink() ?>">
					<div class="textos">
						<h1 class="titulo_ninja"> <?php the_title(); ?> </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="<?php echo $avatar_url;?>">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> <?php echo ( get_post_meta($post->ID, 'wp_total_participaciones', true) )? get_post_meta($post->ID, 'wp_total_participaciones', true) : 0; ?>  </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

		</ul>
													<?php endwhile; ?>

		<?php endif; ?>	

			

			
	</section>
	<br> <br> <br> <br>

	<section id="comentarios">
		
	</section>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/typewritter.js" type="text/javascript"></script>
  <?php comments_template( '/includes/comments.php'); ?>
	<?php get_footer(); ?>
	<script type="text/javascript">
		jQuery("document").ready(function(){
			

			/* Cambiar de pocisión el área de votos*/
			var redits = jQuery(".reddit-voting")
			redits.each( function(index){ jQuery(this).parents("article").append(this) })
			/**/

			/* Efecto de máquina de escribir */
			jQuery(".click_area .titulo").each(function(){
				var texto = jQuery(this).siblings(".titulo_ninja").text() 
				jQuery(this).teletype({  text: [ texto ] });
			})
			/**/
		
		
			/* Cambiar el título por la ilustracion en cada preocupación*/
			 jQuery(".click_area")
			 .on("mouseenter", function(){
			 	jQuery(this).children(".textos").children(".titulo_ninja").css("display", "inline-block")

			 	jQuery(this).children(".textos").children(".titulo").css("display", "none")


			 	if( jQuery(this).children(".ilustracion").css("display") == "inline-block" ){
			 		jQuery(this).children(".ilustracion").css("display", "none")
			 		jQuery(this).children(".textos").css("display", "inline-block")
			 	}

			 	jQuery(this).children(".textos").children(".titulo").remove()
			 })
			 .on("mouseleave", function(){
			 	var textos = jQuery(this).children(".textos")
			 	textos.append("<h1 class='titulo'></h1>")

			 	var titulo = textos.children(".titulo")
			 	var titulo_ninja = jQuery(this).children(".textos").children(".titulo_ninja")
			 	var texto = titulo_ninja.text() 

			 	titulo_ninja.css("display", "none")
				titulo.teletype({  text: [ texto ] });

			 })
		})
	</script>
</body>