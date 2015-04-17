<?php 

get_header();
global $avia_config, $more;


 ?>

<style type="text/css">
		.main_color {
		    background: none repeat scroll 0 0 #fff;
		    border: 0 solid #f4f4f4;
		}
		.post-entry {
		background: transparent !important;
		box-shadow: none;
		margin: 0 20px;
	        }
		.main_color2{
		background:#ecebed;
		}
		#top .header_color.av_header_transparency, #top .header_color.av_header_transparency .phone-info.with_nav span {
		    color: #f4f4f4;
		}
		.responsive .container {
		    max-width: 1310px !important;
		}
		.av_header_transparency > #header_main {
		    background-color: #f4f4f4 !
		;
		    background-image: none !important;
		}
		.html_header_top.html_header_sticky #header {
		    background-image:none !important;
		    background-color:#f4f4f4;
		    position: relative;
		}
		.main_menu {
		    background-image:none;
		    background-color: #f4f4f4;
		}
		
		#top #wrap_all .av_header_transparency .main_menu ul:first-child > li > a, #top #wrap_all .av_header_transparency .sub_menu > ul > li > a, #top .av_header_transparency #header_main_alternate, .av_header_transparency #header_main .social_bookmarks li a {
		    background: #f4f4f4;
		}
		#header_main nav .social_bookmarks {
		    background: none repeat scroll 0 0 #f4f4f4 !important;
		}
		#header_meta{
		  display:none;
		}
		strong.logo {
                margin-left: 10px;
                }
		.titulo h2 {
		    color: #000;
		    font-family: oswald;
		    font-size: 4em;
		    font-weight: normal;
		    padding: 10px;
		    text-shadow: 2px 2px 1px #fff;
		    line-height: 1.41em;
		}
		.titulo h2 #general {
		    color: #502760;
		    display: block;
		}
                #top h2 a{
		    color: #000;
		    font-family: oswald;
		    font-size: 1.2em;
		    font-weight: normal;
		    padding: 10px;
		    text-shadow: 2px 2px 1px #fff;
		    line-height:1.03em;
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
			min-height: 800px;
		}

		section#preocupaciones ul{
			min-width: 100%;
		}

		li.preocupacion{
			width: 28.7%;
			margin: 30px 30px 140px 30px; 
			float:left;
			height: 420px;
		}

		.num {
		    background: none repeat scroll 0 0 #502B60;
		    font-family: oswald;
		    font-size: 3em;
		    max-height: 60px;
		    padding: 0 25px;
		    width: 100px;
		    color: #fff;
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
			min-height: 297px;
			color: #60466B;
		}
		
		.click_area .titulo, .titulo_ninja{
			font-size: 30px;
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
			height: auto;
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


		.preocupacion-8mas1 .num {
		    background: none repeat scroll 0 0 #fff;
		    color: #60466b;
		    font-size: 26.5em;
		    margin-top: 137px;
		    min-height: 250px;
		    width: auto;
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
			min-height: 297px;
			color: #60466B;
		}
		.preocupacion-8mas1 .titulo, .preocupacion-8mas1 .cursor{
			font-size: 30px;
			margin-top: 0px;
		}

		.preocupacion-8mas1 .titulo,{
			float: left;
		}

		.preocupacion-8mas1 .ilustracion{
			display: none;
			min-height: 297px;
			margin-bottom: 14px;
			width: 800px;
		}
		#av_section_a{
				background:#f4f4f4;
		}
		#av_section_2{
				background:#fff;
		}
		#pad60{
		     padding:60px 0;
		}
 
		/** footer **/
		#footer {
		   display:none !important;
		}
		#av_section_morado{
			background:#77607F;
			min-height:auto;
			padding:0;
			margin:0;
		}		
		#socket {
		display: none;
		}
		.morado_plus {
		    background:url("/wp-content/themes/curul501/images/mas_recursos.png") no-repeat scroll right top  #77607f;
		    height: 236px;
		}

		.logo-pie > a, .logo-pie-ct > a, 
		.logo-pie-mi > a, .logo-pie-a19 > a{
		    display: inline-block;
		    width: 173px;
		    height: 40px;
		    text-indent: -10000px;
		}
		
		.logo-pie {
		    background: url("/wp-content/themes/curul501/images/fundar-pie-micrositio.png") no-repeat scroll right top #77607f;
		    width: 180px;
		    height: 72px;
		    background-color: #d6d3d6;
		    margin-top: -5px;
		}
	
		.logo-pie-ct{
		    background: url("/wp-content/themes/curul501/images/colectivo-pie-micrositio.jpeg") no-repeat scroll right top #77607f;
		    background-color: #d6d3d6;
		    width: 140px;
			margin-top: -15px;
			height: 46px;
		}
	
		.logo-pie-mi{
		    background: url("/wp-content/themes/curul501/images/mexicoinf-pie-micrositio.jpeg") no-repeat scroll right top #77607f;
		    background-color: #d6d3d6;
		    width: 128px;
		    margin: 8px 0px 5px 0px ;
		}
	
	
		.logo-pie-a19{
		    background: url("/wp-content/themes/curul501/images/article19-pie-micrositio.png") no-repeat scroll right top #77607f;
		    background-color: #d6d3d6;
		    width: 86px;
		}
		.E0E0E2color{
			background: #E0E0E2;
			height: 236px;
			
		}
		div .av_two_third {
		    margin: 0;
		    width: 70.667%;
		    padding: 0 ;
		}
		div .av_dos_third {
		    margin: 0;
                    width: 63.7%;
                 padding: 42px 10px 0 50px;
		}
		h3.recursos {
                   font-family: oswald;
		   color: #77607F;
	           font-size:28px;
		   text-shadow: 1px 1px 1px #fff;
    
                    }
		a.plus {
				color:#62496E;
		}
#trescol {
    padding: 42px 10px 40px 50px;
    background: #d6d3d6;
    margin: 0 ;
    height: 236px;
}
		
li.adicionales {
    list-style: disc;
    color: #77607f !important;
    padding: 0px 2px 0 4px;
    font-family: 14px;
    text-shadow: 1px 1px 1px solid;
}


</style>


<body>	
		<div class="container">
				<main class="template-page content  av-content-full alpha units" itemprop="mainContentOfPage" role="main">
						<header class="titulo" style="margin: 0px 10px;">
							<h2 style="text-transform: uppercase;">
								<a><span id="general">Ley General</span>
								de deaparación forzada</a>
							</h2>
								
						</header>
				</main>
                </div>
		<div class='container_wrap container_wrap_first main_color2'>
			<div class='container'>

				<main class='template-page content  <?php avia_layout_class( 'content' ); ?> units' <?php avia_markup_helper(array('context' => 'content','post_type'=>'page'));?>>

                    <?php
                    /* Run the loop to output the posts.
                    * If you want to overload this in a child theme then include a file
                    * called loop-page.php and that will be used instead.
                    */

                    $avia_config['size'] = avia_layout_class( 'main' , false) == 'entry_without_sidebar' ? '' : 'entry_with_sidebar';
                    get_template_part( 'includes/loop', 'page' );
                    ?>

				<!--end content-->
				</main>

				<?php

				//get the sidebar
				$avia_config['currently_viewing'] = 'page';
				get_sidebar();

				?>

			</div><!--end container-->

		</div><!-- close default .container_wrap element -->

<div class="container_wrap fullsize" id="av_section_2">		
		<div class="container">
		<section id="preocupaciones">
			<ul>

				<?php if ( have_posts() ) : 
              
				//$args = array( 'post_type' => 'preocupacion', 'order' => 'ASC', 'posts_per_page' => 9 );
				$args = array('post_type' => 'preocupacion','order' => 'ASC', 'posts_per_page' => 9 , 'meta_query' => array( array ( 'key' => 'id_tipo', 'value' => 2, 'compare' => 'LIKE' )));

				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); 
				
				$numero_preocupacion=get_post_meta($post->ID, 'id_preocupacion', true);
				/*
				$total = $wpdb->get_var($wpdb->prepare("
					SELECT SUM($wpdb->postmeta.wp_total_participaciones)
					FROM $wpdb->postmeta, $wpdb->posts
					WHERE $wpdb->postmeta.id_preocupacion = %s
					AND $wpdb->postmeta.post_id = $wpdb->posts.id", $numero_preocupacion )
				);
				*/
				$avatar_url = 'http://curul501.org/wp-content/uploads/preocupaciones/'.$numero_preocupacion.'.png';

							if($numero_preocupacion==9){
								$class="preocupacion-8mas1";
							} else {
									$class="preocupacion";
								}
					/* Obtener el total de los totales de las participaciones de las modificaciones*/		 
					$args = array('post_type' => 'modificacion',
						'meta_query' => array( array ( 'key' => 'id_preocupacion', 'value' => $numero_preocupacion, 'compare' => 'LIKE' ))
					);

					$total = 0;
					
					$mod_loop  = new WP_Query($args);
					while ( $mod_loop->have_posts() ) : $mod_loop->the_post(); 
						$total += intval( get_post_meta($post->ID, 'wp_total_participaciones', true) );
					endwhile; $loop->reset_postdata();
					
				?>
									
								

		
		
			<li class="<?php echo $class; ?>">
		<?php if($numero_preocupacion==9){ ?> <span class="num">8+<strong>1</strong> </span> <?php } else { ?> <span class="num"> <?php echo $numero_preocupacion; }?> </span>
			
			

				<a class="click_area" href="<?php the_permalink() ?>">
					<div class="textos">
						<h1 class="titulo_ninja"> <?php the_title(); ?> </h1>
						<h1 class="titulo"></h1> 
					</div>
					<img class="ilustracion" src="<?php echo $avatar_url;?>">
				</a>

				<div class="votos" style="margin-top: 9px;">
					<label> Total de participaciones: </label>
					<strong> <?php echo ( $total )? $total : 0; ?>  </strong> 
				</div>
				<div class="box"><?php avia_social_share_links(); ?> </div>
			</li>

													<?php endwhile; ?>

		<?php endif; ?>	

		</ul>
			

			
	</section>
	<br> <br> <br> <br>
		</div></div>
	<section id="comentarios">
		<div class="container" id="pad60">
							<?php wp_reset_query(); ?>

		  <?php comments_template( '/includes/comments.php'); ?>
		</div>
	</section>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/typewritter.js" type="text/javascript"></script>
<div class="container_wrap fullsize" id="av_section_morado">
		<div class="flex_column av_one_third first morado_plus">

		</div>
		<div class="flex_column av_two_third  E0E0E2color">
				<div class="flex_column av_dos_third first">
						<h3 class="recursos">Recursos adicionales</h3>
					<ul style="margin-left: 13px; margin-top: 5px;">
						<li class="adicionales"><a class="plus" target="blank_" href="http://fundar.org.mx/ocho-preocupaciones-fundamentales-de-la-ley-general-de-transparencia/">M&aacute;s de 300 ONGs comparten ocho preocupaciones sobre la Ley General de Transparencia</a></li>
						<li class="adicionales"><a class="plus" target="blank_" href="https://readymag.com/Articulo19/55041/">Traici&oacute;n en el Senado (Art&iacute;culo XIX) </a></li>
						<li class="adicionales"><a class="plus" target="blank_" href="http://www.senado.gob.mx/comisiones/anticorrupcion/transparencia.php">Proceso legislativo en el Senado</a></li>
						<li class="adicionales"><a class="plus" target="blank_" href="http://fundar.org.mx/wp-content/uploads/2015/02/CoalSTTFeb15.pdf">Comunicado de OSC al Secretariado T&eacute;cnico en la Alianza para el Gobierno Abierto en M&eacute;xico</a></li>
						<li class="adicionales"><a class="plus" target="blank_" href="http://www.explica.la/ley/ley-transparencia">Todos los art&iacute;culos de la Ley General de Transparencia </a></li>						
					</ul>
		                </div>
				
				<div class="flex_column av_one_third" id="trescol">
						<div class="logo-pie">
								<a href="http://fundar.org.mx/" target="blank_">fundar</a>
						</div>

						<div class="logo-pie-ct">
								<a href="http://colectivoporlatransparencia.org/" target="blank_">colectivo por la transparencia</a>
						</div>

						<div class="logo-pie-mi">
								<a href="http://mexicoinformate.org/" target="blank_">méxico informate</a>
						</div>

						<div class="logo-pie-a19">
								<a href="http://www.articulo19.org/" target="blank_">articulo 19</a>
						</div>
				</div>
				
		</div>

		
</div>


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
			 	jQuery(this).removeClass("ilustracion")
			 	jQuery(this).children("img").addClass("ilustracion")
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