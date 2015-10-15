<?php
	/*
	Template Name: negociacion-7
	*/


	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */


	 global $avia_config, $more;
	 get_header();
	 echo avia_title();
	 ?>

      <script src="https://use.typekit.net/kkb6upl.js"></script>
      <script>try{Typekit.load({ async: true });}catch(e){}</script> 

      <style type="text/css">
		.main_color {
		    background: none repeat scroll 0 0 #fff;
		    border: 0 solid #f4f4f4;
		}
                #main, .html_stretched #wrap_all{
		    background: none repeat scroll 0 0 #fff;
		}
		.post-entry {
		background: transparent !important;
		box-shadow: none;
		margin: 0;
	        }
		.main_color2{
		background:#ecebed;
		}
		#top .header_color.av_header_transparency, #top .header_color.av_header_transparency .phone-info.with_nav span {
		    color: #f4f4f4;
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
              html { margin-top: 0 !important;}
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
		.responsive .container {
		    max-width: 1080px !important;
                    padding-top:0;
		}
                .html_header_transparency #top .avia-builder-el-0 .container, .html_header_transparency #top .avia-builder-el-0 .slideshow_inner_caption {
    padding-top:0;
}
		#header_meta{
		  display:none;
		}
		strong.logo {
                margin-left: 10px;
                }
                /** títulos **/
                h1 {font-family: "chaparral-pro";}
                .main_color h1 {
		    color: #000;
		    font-family: "chaparral-pro";
		    font-size: 66px;
		    font-weight: bold;
		    padding: 10px;
		    text-shadow: 2px 2px 1px #fff;
		    line-height: 0.5em;
		}
		h1#titulo-neg-1 {
		    color: #624A6E;
		    font-family: "chaparral-pro";
		    font-size: 66px;
		    font-weight: bold;
		    padding: 10px;
		    text-shadow: 2px 2px 1px #fff;
		    line-height: .5em;
		}

		h1#titulo-neg-2  {
		    color: #000;
		    font-family: "chaparral-pro";
		    font-size: 66px;
		    font-weight: bold;
		    padding: 10px;
		    text-shadow: 2px 2px 1px #fff;
		    line-height: .5em;
		}
		h3.titulo-art-nego {
		    color: #502760;
		    font-family: "chaparral-pro";
		    font-size: 40px;
		    font-weight: bold;
		    line-height: 1.1em;
		    margin-top: 10px;
		    }
                h3.sub-titulos-neg{
		    color: #000;
		    font-family: "chaparral-pro";
		    font-size: 38px;
		    font-weight: bold;
		}
		.sep{
			border-bottom: 1px solid #999;
			margin: 5px 0px 0px 0px;
		}

		/** footer **/
		#av_section_morado{
			background:#77607F;
			min-height:auto;
			padding:0;
			margin:0;
		}		
		#socket {
		display: none;
		}
		.E0E0E2color{
			background: #E0E0E2;
			height: 236px;
			
		}

		.twitter-share-button{
			float:right;
		}

</style>

<section id="cabecera-negociacion">
	<div class="container">
		<div class="flex_column av_three_fourth flex_column_div first main_color">
			<div class="content ten alpha units">
                              <h1 id="titulo-neg-1">Negociación</h1>
                              <h1 id="titulo-neg-2">presupuestaria</h1>
			</div>
			<div class="flex_column av_one_fourth">
			</div>			
		</div>
	</div>
</section>
<section id="cabecera-art">
	<div class="container">
		<div class="flex_column av_three_fourth flex_column_div first main_color">
                        <div class="post-img">
                           <img src="images/exige-num-7.png">
                        </div>
			<?php the_title( '<h3 class="titulo-art-nego">', '</h3>' ); ?>	
		</div>
	</div>
</section>
<section id="msj-tw">
	<div class="container">
                <p class="tit-hero">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam maximus ultrices arcu, eget luctus purus molestie quis #NegociacionPresupuestaria.</p>
		<div class="flex_column av_two_fifth first el_after_av_section el_before_av_three_fifth avia-builder-el-first">
                        <div class="tw-img">
			   <img src="http://curul501.org/wp-content/uploads/2015/10/th-negacion1.png">
                        </div>
		</div>

		<div class="flex_column av_three_fifth el_after_av_two_fifth avia-builder-el-last">
                        <img class="img-bird-cta" src="http://curul501.org/wp-content/uploads/2015/10/bird-tw.png">
                        <p class="tw-texto"></p>
		</div>  
	</div>
</section>
<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'> 

		<!--start container-->

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



		   <!--end container-->

		</div><!-- close default .container_wrap element -->


<div id="footer" class="container_wrap footer_color">
 	  <div class="container">
<div class="flex_column av_one_half  flex_column_div first el_after_av_hr  el_before_av_one_half">
              <span class="copyright">&copy; Copyright - Curul501</span>
              </div>
          
            <div class="flex_column av_one_half  flex_column_div  el_after_av_one_half  avia-builder-el-last">
                <a href="http://fundar.org.mx/" target="_blank"><img src="http://curul501.org/wp-content/uploads/2014/12/fundar.png"></a>              
              </div>
            </div>
     </div>
</div>

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js" ></script>


<script>
		$(document).ready(function(){
			var data = {}
			
			data.temas = [
				{
					'tema': 'Financiamientos de Organismos Financieros Internacionales',
					'texto': 'Información detallada sobre el financiamiento externo de organismos internacionales', 
					'comisiones': [
						{
							'nombre': 'Hacienda y Crédito Público',
							'presidente': { 'nombre': 'Gina Cruz Blackledge', 'twitter': '@diputadospan' }
						}
					]
				},
				{
					'tema': 'Salud sexual y reproductiva en adolescentes',
					'texto': 'Etiquetar recursos necesarios para salud sexual y reproductiva en adolescentes.', 
					'comisiones': [
						{
							'nombre': 'Salud',
							'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
						}
					]
				},
				{
					'tema': 'Salud materna',
					'texto': 'Asegurar recursos para reducir la mortalidad materna.', 
					'comisiones': [
						{
							'nombre': 'Salud',
							'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
						}
					]
				},
				{
					'tema': 'Seguro Popular',
					'texto': 'No a los recortes en el Ramo 12: Salud.', 
					'comisiones': [
						{
							'nombre': 'Salud',
							'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
						}
					]
				},
				{
					'tema': 'Mujeres con VIH',
					'texto': 'Transparentar y desglosar el presupuesto para VIH.', 
					'comisiones': [
						{
							'nombre': 'Salud',
							'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
						}
					]
				},
				{
					'tema': 'Planificación Familiar',
					'texto': 'Transparencia en las compras consolidadas de anticonceptivos.', 
					'comisiones': [
						{
							'nombre': 'Salud',
							'presidente': { 'nombre': 'Elias Iñiguez Mejía', 'twitter': '@DipEliass' }
						}
					]
				},
				/*
				{
					'tema': 'Mecanismo transnacional e investigación de delitos contra migrantes',
					'texto': 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ei', 
					'comisiones': [
						{
							'nombre': 'Asuntos Migratorios',
							'presidente': { 'nombre': 'Gonzalo Guizar Valladares', 'twitter': '@DiputadosPES'	 }
						}
					]
				},
				*/
				{
					'tema': 'Niñez migrantes',
					'texto': 'No a la disminución de los recursos para atención a la infancia.', 
					'comisiones': [
						{
							'nombre': 'Asuntos Migratorios',
							'presidente': { 'nombre': 'Gonzalo Guizar Valladares', 'twitter': '@DiputadosPES' }
						}
					]
				},
				{
					'tema': 'Asilo y refugio ',
					'texto': 'Ampliar el presupuesto para los refugios y asilos en México.', 
					'comisiones': [
						{
							'nombre': 'Asuntos Migratorios',
							'presidente': { 'nombre': 'Gonzalo Guizar Valladares', 'twitter': '@DiputadosPES' }
						}
					]
				},
				{
					'tema': 'Valor al campesino',
					'texto': 'Exigimos un presupuesto más justo para el campo mexicano.', 
					'comisiones': [
						{
							'nombre': 'Desarrollo Rural',
							'presidente': { 'nombre': 'José Erandi Bermúdez Méndez', 'twitter': '@erandibermudez' }
						},
						{
							'nombre': 'Agricultura y Riego',
							'presidente': { 'nombre': 'Germán Escobar Manjarrez', 'twitter': '@germanescobarmx' }
						}
					]
				},
				{
					'tema': 'Gasto excesivo en publicidad oficial',
					'texto': 'Regular #publicidadoficial y establecer límite de 10% al sobrejercicio del gasto', 
					'comisiones': [
						{
							'nombre': 'Gobernación',
							'presidente': { 'nombre': 'Mercedes Del Carmen Guillén Vicente', 'twitter': '@PalomaGuillen' }
						}
					]
				},
				{
					'tema': 'Radios comunitarias',
					'texto': 'Cumplir con 1% para radios comunitarias e indígenas y definir responsable de asignación', 
					'comisiones': [
						{
							'nombre': 'Comunicaciones',
							'presidente': { 'nombre': 'Ivonne Aracely Ortega Pacheco', 'twitter': '@ivonneop' }
						},
						{
							'nombre': 'Radio y Televisión',
							'presidente': { 'nombre': 'Lía Limón García', 'twitter': '@lialimo' }
						}
					]
				},
				{
					'tema': 'Fideicomisos y fondos',
					'texto': 'Mayor transparencia y claridad en los fideicomisos públicos.', 
					'comisiones': [
						{
							'nombre': 'Hacienda y Crédito Público',
							'presidente': { 'nombre': 'Gina Cruz Blackledge', 'twitter': '@diputadospan' }
						}
					]
				},
				/*
				{
					'tema': 'Presupuesto para capacitación de operadores en derechos humanos y de mujeres',
					'texto': 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do ei', 
					'comisiones': [
						{
							'nombre': 'Igualdad de género',
							'presidente': { 'nombre': 'Laura Nereida Plascencia Pacheco', 'twitter': '@LNPlascencia' }
						}
					]
				},
				*/
				{
					'tema': 'Implementación de reforma del Sistema de Justicia Penal',
					'texto': 'Justificación del ejercicio de los recursos del nuevo sistema de justicia penal.', 
					'comisiones': [
						{
							'nombre': 'Justicia',
							'presidente': { 'nombre': 'Álvaro Ibarra Hinojosa', 'twitter': '@DiputadosPRI' }
						}
					]
				}
			];

			data.diputados = {
				'presidente':  {'nombre': 'Baltazar Hinojosa Ochoa', 'twitter': '@BaltazarxTam' },
				'bancadas': [
						{ 
							'nombre': 'PRI',
							'presidente': { 'nombre': 'César Octavio Camacho Quiroz',	'twitter': '@ccq_pri' }
						},
						{ 
							'nombre': 'PAN',
							'presidente': { 'nombre': 'Marko Antonio Cortés Mendoza',	'twitter': '@markocortes' }
						},
						{ 
							'nombre': 'PRD',
							'presidente': { 'nombre': 'Francisco Martinez Neri',	'twitter': '@fmartinezneri' }
						},
						{ 
							'nombre': 'PVEM',
							'presidente': { 'nombre': 'Jesús Sesma Suárez',	'twitter': '@chuchosesma' }
						},
						{ 
							'nombre': 'MORENA',
							'presidente': { 'nombre': 'Norma Rocío Nahle García',	'twitter': '@rocionahle' }
						},
						{ 
							'nombre': 'MOVIMIENTO CIUDADANO',
							'presidente': { 'nombre': 'José Clemente Castañeda Hoeflich',	'twitter': '@clementech' }
						},
						{ 
							'nombre': 'NUEVA ALIANZA',
							'presidente': { 'nombre': 'Luis Alfredo Valles Mendoza',	'twitter': '@alfredvalles' }
						},
						{ 
							'nombre': 'ENCUENTRO SOCIAL',
							'presidente': { 'nombre': 'Alejandro González Murillo',	'twitter': '@AlejandroGonMu' }
						},
						{ 
							'nombre': 'ENCUENTRO SOCIAL',
							'presidente': { 'nombre': 'Alejandro González Murillo',	'twitter': '@AlejandroGonMu' },
						}
				] 
			};

			var CreateTweet = function(diputados, tema, hashtag){
				this.diputados = diputados;
				this.tema = tema;
				this.hashtag = hashtag;
			}

			CreateTweet.prototype.diputado_aleatorio = function(grupo){
				var getRandom = function (min, max) {
	    		return parseInt( Math.random() * (max - min) + min ); 
				}
				var max = grupo.length - 1;
				return grupo[ getRandom(0, max) ] 
			}

			CreateTweet.prototype.get_rep_twitters = function(){
				var twitters = [];
				twitters.push(this.diputados.presidente.twitter);
				twitters.push(this.diputado_aleatorio(this.diputados.comisiones).presidente.twitter);
				twitters.push(this.diputado_aleatorio(this.diputados.bancadas).presidente.twitter);

				return twitters.join(" ");
			}

			CreateTweet.prototype.run = function(){
				this.diputados.comisiones = this.tema.comisiones
				this.text = [ this.tema.texto, this.hashtag ].join(' ')
				this.tweet = [ this.tema.texto, this.get_rep_twitters(), this.hashtag ].join(' ')

				this.el = $('<a class="twitter-share-button"></a>')
				this.el.attr( "href", "https://twitter.com/intent/tweet?text=" + this.tweet )

				return { 'el': this.el, 'text': this.text, 'tweet': this.tweet } ;
			}

			/* Aquí se selecciona las comisiones que serán incluidas en el tuit */
			/* En cuanto se tengan todos los slugs de cada sección se podrán usar para seleccionar el tema correspondiente */
				var tidx = 0
			/************************************************/
			/************************************************/
			

			var create_tweet = new CreateTweet(data.diputados, data.temas[tidx], '#mejorPEF16')
			var tweet = create_tweet.run()

			$("#msj-tw .container").append( tweet.el )
			$(".tit-hero").text( tweet.text )
			$(".tw-texto").text( tweet.tweet )

			window.twttr = (function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0],
			    t = window.twttr || {};
			  if (d.getElementById(id)) return t;
			  js = d.createElement(s);
			  js.id = id;
			  js.src = "https://platform.twitter.com/widgets.js";
			  fjs.parentNode.insertBefore(js, fjs);
			 
			  t._e = [];
			  t.ready = function(f) {
			    t._e.push(f);
			  };
			 
			  return t;
			}(document, "script", "twitter-wjs"));
		})
	</script>
