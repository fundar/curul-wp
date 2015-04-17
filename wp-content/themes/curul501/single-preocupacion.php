<?php 
get_header(); 
global $dposttitle;
$dposttitle = wp_title( '', false);
	global $avia_config, $more;
?>
<style type="text/css">		
		#top .header_color.av_header_transparency, #top .header_color.av_header_transparency .phone-info.with_nav span {
		    color: #f4f4f4;
		}
		.html_header_top.html_header_topbar_active.html_header_sticky #top #main {
                 padding-top: 100px;
                }
		.responsive .container {
		    max-width: 1030px !important;
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
			background: #fff;
			padding-bottom: 30px;
		}
		.reddit-voting, .logged-in-only{
			margin-top: 0px;
		}

		.popupContainer {
			color: #000 !important;
		}
		body {
		    background-image: url("chrome://global/skin/media/imagedoc-darknoise.png");
		    color: #eee;
		}
		#banner .num {
		    background: none repeat scroll 0 0 #50275f;
		    color: #fff;
		    display: block;
		    float: left;
		    font-family: oswald;
		    font-size: 15em;
		    line-height: 0.2em;
		    padding: 165px 98px 166px;
		    vertical-align: middle;
		    width: 100%;
		}
		.iniciativa-original {
		    background: none repeat scroll 0 0 #fff;
		    display: block;
		    float: left;
		    margin-top:0px;
		    padding: 40px 40px 0;
		    min-height: 123px;
		   width: 100%;
		}		
		.iniciativa-original h3 {
		    color: #502760;
		    display: block;
		    font-size: 2.1em;
		    line-height: 1.06em;
		    margin-bottom: 21px;
		}
		.iniciativa-original .texto p{
 			font-weight: lighter;
 			font-size: 1.4em;
 			font-family: "colaborate-thinregular";
 			color:#000;
		}
                 p{
 			font-weight: lighter;
 			font-size: 1.4em;
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
		
		h3.iconbox_content_title {
			color: rgba(89, 39, 95, 1);
			font: 19px "colaborate-regular" !important;
			text-rendering: optimizelegibility;
			text-transform: none;
		}		
	       
	       .texto > .reddit-voting {
		   display: none;
		   width: 83px;
	       }
	       div .av_two_third {
                   margin-left: 0;
                   width: 69.69%;
               }
	       #av_section {
                  background: none repeat scroll 0 0 #fff;
                }
		#av_section_2 {
                  background: none repeat scroll 0 0 rgba(229, 229, 229, 0.6);
                }
		.fijo{
		height:247px;
		}
		.texto {
		    margin-bottom: 70px;
		    margin-top: -102px;
		}
		#sin-votos > .reddit-voting {
		    bottom: 0;
		    margin-top: -29px;
		    position: absolute;
		    right: 0;
		}
		h3.iconbox_content_title {
		    color: rgba(89, 39, 95, 1);
		    font: 19px "colaborate-regular";
		    text-rendering: optimizelegibility;
		    text-transform: none;
		}
		.iconbox_content_title {
				text-transform:none !important;}
		.elbloque {
		    padding-bottom: 80px;
		    width: 100%;
		}
		#bajonum { margin-top: -36px;}
		#bajonum > .reddit-voting{
		      display: none;
		}
		#bajonum .reddit-voting, .iniciativa-original .reddit-voting{
		      display: none;
		}
		.votos {
		    border-bottom: 1px solid #999 !important;
			max-height: 0px;
			padding-top: 0px;
		}
		.iconbox_content_container p{
			margin-bottom: 40px;
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
		.logo-pie {
		    background: url("/wp-content/themes/curul501/images/fundar-pie-micrositio.png") no-repeat scroll right top #77607f;
		    width: 180px;
		    height: 72px;
		    background-color: #d6d3d6;
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
		.logo-pie > a {
		    display: inline-block;
		    width: 173px;
		    height: 40px;
		    text-indent: -10000px;
		}
		.lapreocupacion > .av_one_third {
                   margin-left: 6%;
		   width: 27.333% !important;
	        }
</style>

<?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
						
						
					<?php $id_preocupacion    = get_post_meta($post->ID, 'id_preocupacion', true);  ?>
				   <?php $id_tipo    = get_post_meta($post->ID, 'id_tipo', true);  ?>

<style type="text/css">
	
	#banner{
			min-height: 370px;
			height: 300px;
			background: url("http://curul501.org/wp-content/uploads/preocupaciones/<?php echo $id_preocupacion ?>.png");
			width: 100%;
		}
</style>

<body>
		<!-- cabecera micrositio -->
		<div class="container">
				<main class="template-page content  av-content-full alpha units" itemprop="mainContentOfPage" role="main">
						<header class="titulo">
							<h2 style="text-transform: uppercase;">
							
<?php if($id_tipo==1) { ?>  <span id="general"> LAS 8<small><b>+</b>1</small> </span> <br>Conoce los temas más preocupantes<br> de la nueva Ley General de Transparencia</h2><?php  }  else { ?> <span id="general"> Ya no son las 8 más <small><b>+</b>1</small> </span> <br>
								asd<br>asd</h2>     <?php } ?>
								
						</header>
				</main>
                </div>
		<!-- /cabecera micrositio -->
<!-- comienza banner -->
<div id="original">
		<div id="banner">
		                <div class="container">
				<!-- columna numero -->		
                                <div class="flex_column av_one_third first avia-builder-el-16 el_after_av_section el_before_av_two_third avia-builder-el-first">	
			                        <div class="num">
			                        <?php if($id_preocupacion==9){ ?> 8+1 <?php } else { ?> <?php echo $id_preocupacion; }?>
			                        </div>
                                </div>
				<!-- columna titulo -->	
                                <div class="flex_column av_two_third avia-builder-el-18 el_after_av_one_third el_before_av_one_fourth ">
						<div class="fijo"></div>						
			                        <section class="iniciativa-original">
				                            <h3 id="titulo">  <?php the_title(); ?></h3>
                                                           
						</section>
				</div>
				  
							    
				</div><!--/container -->
						
		</div><!--/#banner-->
</div>
<!-- final banner -->
<!-- contenido textos resumen-->
<div id="av_section" class="avia-section main_color avia-section-large avia-no-border-styling avia-bg-style-scroll avia-builder-el-2 el_after_av_section el_before_av_section container_wrap fullsize">
		                <div class="container">
				<!-- columna numero -->		
                                <div class="flex_column av_one_third first avia-builder-el-16 el_after_av_section el_before_av_two_third avia-builder-el-first ">	
			        <div class="textwidget" id="bajonum"><?php avia_social_share_links(); ?></div>
                                </div>
				<!-- columna titulo -->	
                                <div class="flex_column av_two_third avia-builder-el-18 el_after_av_one_third el_before_av_one_fourth ">
			                        <section class="iniciativa-original">
				                            
                                                            <div class="texto"><? the_content(); ?></div>
</section>
				</div>
				  
							    
				</div><!--/container -->
</div>
<?php endwhile; endif; ?>

<!-- /contenido textos resumen-->

<?php 	
	if ( have_posts() ) : 
		$args = array('post_type' => 'modificacion',
				'orderby' => 'date',
				'order' => 'ASC', 
			'meta_query' => array(
					'relation'=>'and',

			array (
				'key'     => 'id_preocupacion',
				'value'   => $id_preocupacion,
				'compare' => 'LIKE'
			),
			array (
				'key'     => 'id_tipo',
				'value'   => $id_tipo,
				'compare' => 'LIKE'
			)
			
		)
	);
	?>
	<!-- inicio iniciativas comparación -->
	<div id="av_section_2" class="avia-section main_color avia-section-large avia-no-border-styling avia-bg-style-scroll avia-builder-el-2 el_after_av_section el_before_av_section container_wrap fullsize">		
		<div class="container top40 lapreocupacion">
			
			<?php $loop  = new WP_Query($args);
				while ( $loop->have_posts() ) : $loop->the_post(); 
				$participaciones_totales = get_post_meta($post->ID, 'wp_total_participaciones', true); ?>
				<div class="flex_column av_one_third">
					<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" class="iconbox iconbox_left_content   avia-builder-el-10  avia-builder-el-no-sibling  elbloque">
						<header class="entry-content-header">
							<h3 itemprop="headline" class="iconbox_content_title" id="sin-votos"> <?php the_title(); ?> </h3>
						</header>
						<div itemprop="text" class="iconbox_content_container">
							<? the_content(); ?>
							<div class="votos"> 
								<label> <p>Total de participaciones: </label> <strong>  <?php echo ($participaciones_totales)? $participaciones_totales : 0 ?> </strong></p> 
							</div>								
	                    </div>
						<footer class="entry-footer"></footer>
					</article>
				</div>
				
			<?php endwhile; ?>

		</div>
	</div>	



	<?php endif; ?>	
	<section id="comentarios">
		<div class="container top60">
					<?php wp_reset_query(); ?>
			        <?php comments_template( '/includes/comments.php'); ?>
		</div>
	</section>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			/* Mover de lugar los votos */
			jQuery(".votos").each(function(){
			  var redit = jQuery(this).siblings(".reddit-voting")
			  var login = jQuery(this).siblings(".logged-in-only")
			  jQuery(this).prepend(redit)
			  jQuery(this).prepend(login)
			})
		})
	</script>
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
						
				</div>
				
		</div>

		
</div>	
   <?php get_footer(); ?>

</body>
