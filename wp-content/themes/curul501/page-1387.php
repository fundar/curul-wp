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

		.titulo_ninja{
			display: none;
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

	<section id="preocupaciones">
		<ul>
			<li class="preocupacion">
				<span class="num"> 1 </span>
				<div class="sep"></div>

				<a class="click_area" href="#">
					<div class="textos">
						<h1 class="titulo_ninja"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> 49 </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

			<li class="preocupacion">
				<span class="num"> 1 </span>
				<div class="sep"></div>

				<a class="click_area" href="#">
					<div class="textos">
						<h1 class="titulo_ninja"> Información sobre violaciones graves a derechos humanos y delitos de lesa humanidad </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> 49 </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

			<li class="preocupacion">
				<span class="num"> 1 </span>
				<div class="sep"></div>

				<a class="click_area" href="#">
					<div class="textos">
						<h1 class="titulo_ninja"> Sanciones que limitan el DAI </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> 49 </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

			<li class="preocupacion">
				<span class="num"> 1 </span>
				<div class="sep"></div>

				<a class="click_area" href="#">
					<div class="textos">
						<h1 class="titulo_ninja"> Reserva de información </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> 49 </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

			<li class="preocupacion">
				<span class="num"> 1 </span>
				<div class="sep"></div>

				<a class="click_area" href="#">
					<div class="textos">
						<h1 class="titulo_ninja"> Intervención de la Presidencia de la República </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> 49 </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

			<li class="preocupacion">
				<span class="num"> 1 </span>
				<div class="sep"></div>

				<a class="click_area" href="#">
					<div class="textos">
						<h1 class="titulo_ninja"> Desaparecen las obligaciones de transparencia sobre hidrocarburos. </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> 49 </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

			<li class="preocupacion">
				<span class="num"> 1 </span>
				<div class="sep"></div>

				<a class="click_area" href="#">
					<div class="textos">
						<h1 class="titulo_ninja"> Cancelaciones y condonaciones de impuestos </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> 49 </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

			<li class="preocupacion">
				<span class="num"> 1 </span>
				<div class="sep"></div>

				<a class="click_area" href="#">
					<div class="textos">
						<h1 class="titulo_ninja"> Información sobre violaciones graves a derechos humanos y delitos de lesa humanidad </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
				</a>

				<div class="votos"> 
					<label> Total de participaciones: </label>
					<strong> 49 </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>
			
		</ul>

		<div class="preocupacion-8mas1">
			<span class="num"> 8+<strong>1</strong> </span>

			<a class="click_area" href="#">
				<div class="textos">
					<h1 class="titulo_ninja"> Declaraciones patrimoniales </h1>
					<h1 class="titulo"></h1> 
				</div>
				<img class="ilustracion" src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
			</a>

			<!--div class="votos"> 
				<label> Total de participaciones: </label>
				<strong> 49 </strong> 
			</div>
			<div class="box"><?php avia_social_share_links(); ?> </div-->
		</div>
	</section>
	<br> <br> <br> <br>


	<section id="comentarios">
		
	</section>

	<style type="text/css">


		footer .three-columns {
			min-width: 100%;
			width: 100%;
			display: block;
		}

		.three-columns #recursos ul li{
			color: #60466B;
			list-style: disc;
		}

		.three-columns article{
			float:left;
			padding: 20px;			
			min-width: 33%;
		}

		footer .bottom{
			width: 100%;
			float: left;
			padding: 0px 150px;
		}

		footer .bottom #derechos{
			float:left;
		}

		footer .bottom #logo-fundar{
			float:right;
		}

	</style>

	<footer>
		<section class="three-columns">
			<article>
				a
			</article>

			<article id="recursos">
				<h1> RECURSOS ADICIONALES</h1>
				<ul>
					<li> <a href="#"> Lorem ipsum dolor sit amet consectetur adipiscing elit </a></li>
					<li> <a href="#"> Sed egestas metus ac euismod congue </a></li>
					<li> <a href="#"> Vestibulum pharetra ornare vestibulum </a></li>
					<li> <a href="#"> Nunc ac nulla non enim faucibus lobortis id sit amet risus </a></li>
					<li> <a href="#"> Etiam eget egestas felis </a></li>
					<li> <a href="#"> Curabitur est turpis </a></li>
				</ul>
			</article>

			<article id="logos">
				<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
			</article>
		</section>

		<section class="bottom">
			<p id="derechos"> Curul 501 l Todos los derechos reservados l Power by FundarLab </p>
			<img id="logo-fundar" alt="Fundar, Centro de Análisis e INvestigación A.C." src="http://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/VST_images_the_Lagoon_Nebula.jpg/800px-VST_images_the_Lagoon_Nebula.jpg">
		</section>
	</footer>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/typewritter.js" type="text/javascript"></script>

	<script type="text/javascript">
		jQuery("document").ready(function(){
			
			/* Cambiar el título por la ilustracion en cada preocupación*/
			 jQuery(".click_area").on("hover", function(){
			 	jQuery(this).children(".textos").children(".titulo_ninja").toggle()
			 	jQuery(this).children(".textos").children(".titulo").toggle()

			 	if( jQuery(this).children(".ilustracion").css("display") == "inline-block" ){
			 		jQuery(this).children(".ilustracion").toggle()
			 		jQuery(this).children(".textos").toggle()
			 	}
			 })
			/**/

			/* Cambiar de pocisión el área de votos*/
			var redits = jQuery(".reddit-voting")
			redits.each( function(index){ jQuery(this).parents("article").append(this) })
			/**/

			/* Efecto de máquina de escribir */
			jQuery(".click_area .titulo").each(function(){
				var texto = jQuery(this).siblings(".titulo_ninja").text() 
				jQuery(this).teletype({ 
					text: [ texto ]/*, 
					cb: function(){
						jQuery(this).text("")
					}*/
				});
			})
			/**/
		
		})
	</script>
</body>