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
						<h1 class="entry-title-yellow">Iniciativas</h1>
						<div class="line-amarilla"> </div>
		</div>

		<!--Inicio filtros iniciativas -->
		<div class="container box-menu">
			<div class="search-table">
								<form name="filter-iniciativas" id="filter-iniciativas" action="/iniciativas">
				   <div id="filter">
						   <select class="sorter-rep sort" name="partido-politico" id="partido-politico-filter">
							   <option value="">Partidos pol&iacute;ticos</option>
							   <?php $politicalPartiesArray = getPoliticalParties(); ?>
							   <?php foreach($politicalPartiesArray as $value) { ?>
									<option value="<?php echo $value["slug"];?>" <?php if($selectedPolitical == $value["slug"]) echo 'selected="selected"'?>>
										<?php echo utf8_encode($value["name"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>	

					<div id="filter">				
						   <select class="sorter-rep sort" name="comision" id="comision-filter">
							   <option value="">Comisiones</option>
							    <?php $commissionsArray = getCommissions(); ?>
								<?php foreach($commissionsArray as $value) { ?>
									<option value="<?php echo $value->slug;?>" <?php if($selectedCommission == $value->slug) echo 'selected="selected"'?>>
										<?php echo $value->name;?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   <div id="filter">				
						   <select class="sorter-rep sort" name="tema" id="tema-filter">
							   <option value="">Temas</option>
							   <?php $temasArray = getTemas(); ?>
							   <?php foreach($temasArray as $value) { ?>
									<option value="<?php echo utf8_encode($value["slug"]);?>" <?php if($selectedTema == utf8_encode($value["slug"])) echo 'selected="selected"'?>>
										<?php echo utf8_encode($value["name"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   
					 	<div id="filter">				
						   <select class="sorter-rep sort" name="status" id="status-filter">
							   <option value="">Status</option>
							   <?php $statusArray = getStatus(); ?>
							   <?php foreach($statusArray as $value) { ?>
									<option value="<?php echo utf8_encode($value["slug"]);?>" <?php if($selectedStatus == utf8_encode($value["slug"])) echo 'selected="selected"'?>>
										<?php echo utf8_encode($value["name"]);?>
									</option>
								<?php } ?>
						   </select>
					   </div>  
					   
					   <div id="filter">				
						   <select class="sorter-rep sort" name="postulante" id="postulante-filter">
							   <option value="">Representante</option>
							    <?php $RepresentanteArray = getIniciativasbyRepresentantes(); ?>
								<?php foreach($RepresentanteArray as $value) { ?>
									<option value="<?php echo $value->slug;?>" <?php if($selectedPostulante == $value->slug) echo 'selected="selected"'?>>
										<?php echo $value->full_name;?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   
					   	<div>				
						   <input type="submit" value="Filtrar" id="submit-filter"/>
					   </div>   
			       		
					</form>				
				   
			</div>
		</div>

<!-- Fin filtros iniciativas -->		
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
						<?php
							$presentada_partido	            = get_post_meta($post->ID, 'wp_presentada_partidos', true);
							$presentada_dependencia	        = get_post_meta($post->ID, 'wp_presentada_dependencias', true);
							$status_iniciativa             	        = get_post_meta($post->ID, 'wp_status', true);
							$elements = explode("|", $status_iniciativa);
   						    $status_final=count($elements)-1;
							$voto 	= json_decode(get_post_meta($post->ID, 'wp_votos', true));
							$representantes 	= json_decode(get_post_meta($post->ID, 'wp_votos_representantes', true));
							$votos 	= get_post_meta($post->ID, 'wp_votos', true);
							//$votos_decode =	json_decode($votos,true);
							$WorkingArray = json_decode(json_encode($votos),true);
							$decode = json_decode($WorkingArray, true);
							$fecha_votacion=get_post_meta($post->ID, 'wp_fecha_votacion_tm', true);
							$explode = explode(" ", $fecha_votacion);
							$fecha = $explode[0];
							$id=$wp_query->post->ID;
							setPostViews($id); 
							$fecha_listado=get_post_meta($post->ID, 'wp_fecha_listado_tm', true);
							$explode_listado = explode(" ", $fecha_listado);
							$fecha_sin_hora=$explode_listado[0];
							$explode2 = explode("-", $fecha_sin_hora);
							$ano = $explode2[0];
							$mes = $explode2[1];
							$dia = $explode2[2];
							$commissions = explode('|', get_post_meta($post->ID, 'wp_commissions', true));
							$commissions_slug = explode('|', get_post_meta($post->ID, 'wp_commissions_slug', true));
							$last_status_slug = explode('|', get_post_meta($post->ID, 'wp_last_status_slug', true));
							$htmlcommis = "";
							$link = get_site_url() . "/iniciativas/?comision=";
							$tipo_iniciativa = get_post_meta($post->ID, 'wp_tipo_camara', true);

							if($commissions) {
								foreach($commissions as $key => $commission) {
									$htmlcommis .= "<p><a href='" . $link . $commissions_slug[$key] . "' title='" . $commission . "'>" . $commission . "</a></p>";
								}
							} else {
								$htmlcommis = "<p>No se encuentran comisiones relacionadas</p>";
							}
						$partido_politico_slug	    = get_post_meta($post->ID, 'wp_presentada_partidos_slug', true);
						
								$presentadas = explode('|', get_post_meta($post->ID, 'wp_presentada', true));
							$presentadas_slug = explode('|', get_post_meta($post->ID, 'wp_presentada_slug', true));
							$htmlpresentadas = "";
							$link_representante = get_site_url() . "/representantes/";
							
							if($presentadas) {
								foreach($presentadas as $key => $presentada) {
									$htmlpresentadas .= "<p><a href='" . $link_representante . $presentadas_slug[$key] . "' title='" . $presentada . "'>" . $presentada . "</a></p>";
								}
							} else {
								$htmlpresentadas = "<p>No se encuentran representantes</p>";
							}

					
												
						?>
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
					<div class="entry-content no-voto" itemprop="text">
						<ul class="lista-iniciativas">
							<li class="bullet-arrow">Comisiones
								<p><?php echo $htmlcommis; ?></p>
							</li>
							<li class="bullet-arrow">Propuesta por
							<p><?php if($presentada_dependencia != "") { echo $presentada_dependencia."</br></br>";} ?>
							<?php if($presentada_partido != "") { ?> <a href="<?php echo get_site_url() . '/iniciativas/?partido-politico=' . $partido_politico_slug; ?>"> <?php echo  $presentada_partido."</br></br>"; } ?>
							<p><?php echo $htmlpresentadas; ?></p> </li>
							<li class="bullet-arrow">En la C&aacute;mara de: <span><?php  if($tipo_iniciativa==1) echo "Diputados"; else	echo "Senadores";?></span></li>
						</ul>
						<? the_content(); ?>					
						<div class="pleca-sub-info"></div>
						<ul class="sub-info">
							<li class="sub-info-li">Fecha de Votaci&oacute;n:<?php echo $dia."-".$mes."-".$ano; ?></li>
							<li class="sub-info-li">LXII Legislatura</li>
						</ul>
					</div>
                                         <?php endwhile; endif; ?>
				</main>
					
				<!--end content-->
				
                <!-- inicio barra leteral derecha -->
		<aside class="sidebar sidebar_right three alpha units" role="complementary">
			<div class="sidebar-votos">
				<p class="vota">Vota</p>
				<p class="encurul"> en curul</p>
				<p class="total-participaciones"> 
					Total de participaciones <br> 
					<?php 
						if (get_post_meta($post->ID, 'wp_total_participaciones', true)){
							echo get_post_meta($post->ID, 'wp_total_participaciones', true);
						}else echo 0;
					?> 
				</p>
			</div>  
			<div class="textwidget share-sidebar-vota">
			    <?php avia_social_share_links(); ?>
			</div>
			<!-- empieza sidebar-->
			<div class="textwidget sb">
				<div class="linea-morado"></div>
				<div class="tab-item-temas">
			        <p class="tema-img"> Temas:</p>
				<p class="parrafo-temas"><?php echo str_replace('|', ", ", get_post_meta($post->ID, 'wp_topics', true)); ?>
				</p>
				</div>
				
			</div>
			
			<div class="textwidget sb-1">
						
			</div>
			<div class="textwidget sb-2">			
				<div class="linea-morado"></div>
				<a href="<?php echo get_post_meta($post->ID, 'wp_enlace_gaceta', true); ?>" target="_blank"> <p class="gaceta-img">Gaceta parlamentaria</p></a>
			</div>
		</aside>
		<!-- votaciones en pleno -->
										<?php if($voto != "") {
										foreach($voto as $value) {
											$resArray = explode(":", $value->total);
											}
											?>
										
		<div class="container votyacion-pleno" itemtype="https://schema.org/WPFooter" itemscope="itemscope" role="contentinfo">			
			<div id="av-layout-grid-1" class="av-layout-grid-container av-flex-cells avia-builder-el-0 avia-builder-el-no-sibling container_wrap fullsize">	
					<div class="flex_cell no_margin av_one_fifth avia-builder-el-1 el_before_av_cell_three_fifth avia-builder-el-first pleno">
						<div class="flex_cell_inner">
						<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
						<div class="avia_textblock " itemprop="text">
						<p class="titulos-voto">Votaci&oacute;n <span>en pleno</span> </p>
						</div>
						</section>
						</div>
					</div>				
					<div class="flex_cell no_margin av_three_fifth avia-builder-el-3 el_after_av_cell_one_fifth el_before_av_cell_one_fifth " style="vertical-align:top;padding:0 10px 0 10px ;">
						<div class="flex_cell_inner">
						<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
						<div class="avia_textblock " itemprop="text">
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pri-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up"><?php echo $decode[7]['favor'];?>
										</li >										
										<li class="hand-down"><?php echo $decode[7]['contra'];?>
										</li >
									</ul>
								</div>
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pan-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up"><?php echo $decode[6]['favor'];?>
										</li >										
										<li class="hand-down"><?php echo $decode[6]['contra'];?>
										</li >
									</ul>
								</div>																
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/prd-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up"><?php echo $decode[5]['favor'];?>
										</li >										
										<li class="hand-down"><?php echo $decode[5]['contra'];?>
										</li >
									</ul>
								</div>								
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pvem-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up"><?php echo $decode[4]['favor'];?>
										</li >										
										<li class="hand-down"><?php echo $decode[4]['contra'];?>
										</li >
									</ul>
								</div>								
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pt-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up"><?php echo $decode[3]['favor'];?>
										</li >										
										<li class="hand-down"><?php echo $decode[3]['contra'];?>
										</li >
									</ul>
								</div>								
							</div>							
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/panal-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up"><?php echo $decode[2]['favor'];?>
										</li >										
										<li class="hand-down"><?php echo $decode[2]['contra'];?>
										</li >
									</ul>
								</div>								
							</div>
							<div class="logo-pp">
								<img src="<?php echo get_stylesheet_directory_uri() ?>/images/pmc-54px.png">
								<div class="hands-vote">
									<ul>
										<li class="hand-up"><?php echo $decode[1]['favor'];?>
										</li >										
										<li class="hand-down"><?php echo $decode[1]['contra'];?>
										</li >
									</ul>
								</div>								
							</div>			
						</div>
						</section>
						</div>
					</div>				
					<div class="flex_cell no_margin av_one_fifth avia-builder-el-5 el_after_av_cell_three_fifth avia-builder-el-last " style="vertical-align:top;padding:0 0 0 10px ;">
						<div class="flex_cell_inner">
						<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
						<div class="avia_textblock " itemprop="text">
						<p class="num-votos-pleno"><?php echo $decode[8]['total'] - $decode[8]['ausente'] ;?></p>
						<p class="total-votos-pleno">Votos totales</p>			
						</div>
						</section>
						</div>
					</div>
			</div>
			
		<div class="container griss">
			<a class="grafikas" href="">Ver gr&aacute;ficas de las votaciones en pleno</a>                         

		</div>
		<style type="text/css">
			#bartitle{
				display: block;
				font-family: oswald;
				font-weight: lighter;
				font-size: 3em;
				padding-top:50px;
			}

			#graficas_info{
				padding-top:50px;
	   			font-family: oswald;
	   			font-weight: lighter;
			}

			#graficas_info h1{
				margin-bottom: 25px;
			}

			#graficas_info span{
				margin-right: 20px;
			}


			ul#acotaciones li{
				font-size: 1.4em;
				margin-bottom: 20px;
			}

			ul#acotaciones li span{
				margin-left: 30px;
				min-width: 30px;
				min-height: 30px;
			}

			li#favor span{
				background: #A264B9;
				color: #A264B9;
			}
			
			li#contra span{
				background: #CCC1CE;
				color: #CCC1CE; 
			}

			li#abstenciones span{
				background: #F0D0B9;
				color: #F0D0B9; 
			}

			li#inasistencias span{
				background: #686F7F;
				color: #686F7F; 
			}

		</style>
		<div id="graficas_content" >
			<div id="pie_chart"></div>

			<div id="bartitle">
			    <span id="bartitle_text"> </span> 
			    <span id="bartitle_count"> </span> 
			</div>

			<div id="bar_chart">
				<div id="graficas_info">
					<h1> 
						<span class="quorum"> Quorum: <?php echo $decode[8]['total'] - $decode[8]['ausente'] ;?> </span>
						<span class="inasistencias"> Inasistencias: <?php echo $decode[8]['ausente'] ;?></span>
					</h1>
					<ul id="acotaciones">
						<li id="favor"> <span>| | | | |</span> A favor </li>
						<li id="contra"> <span>| | | | |</span> En contra </li>
						<li id="abstenciones"> <span>| | | | |</span> Abstenciones </li>
						<li id="inasistencias"> <span>| | | | |</span> Inasistencias </li>
					</ul>
				</div>
			</div>


			<div id="tooltip" class="hidden">
			  <p><span id="value">100</span> </p>
			</div>


			<table id="table_id" class="display">
			      <thead>
			          <tr>
			            <th class="nombre" >Nombre</th>
			            <th class="partido" >Partido</th>
			            <th class="tipo" >Tipo</th>
			            <th class="zone_state" >Zona</th>
			          </tr>
			      </thead>
			      <tbody>
			         
			      </tbody>
			</table>

			  <script type="text/javascript">

			      jQuery(document).ready( function () {
			        for(var i in representantes){
			          var row  = "<td> <a class='representante_lnk' href='<?php echo get_bloginfo('url'); ?>/representates/" + representantes[i].slug + "'>" +  representantes[i].nombre + "</a> </td>"
			              row  += "<td>" + representantes[i].partido + "</td>"
			              row  += "<td>" + representantes[i].tipo + "</td>"
			              row  += "<td>" +  (representantes[i].zone_state || "No conocido" ) + "</td>"
			          
			          jQuery("#table_id tbody").append("<tr>" + row + "</tr>")
			        }

			        jQuery('#table_id').DataTable({
			        	"language": {
						    "sProcessing":     "Procesando...",
						    "sLengthMenu":     "Mostrar _MENU_ registros",
						    "sZeroRecords":    "No se encontraron resultados",
						    "sEmptyTable":     "Ningún dato disponible en esta tabla",
						    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
						    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
						    "sInfoPostFix":    "",
						    "sSearch":         "Buscar:",
						    "sUrl":            "",
						    "sInfoThousands":  ",",
						    "sLoadingRecords": "Cargando...",
						    "oPaginate": {
						        "sFirst":    "Primero",
						        "sLast":     "Último",
						        "sNext":     "Siguiente",
						        "sPrevious": "Anterior"
						    },
						    "oAria": {
						        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
						    }
						}
			        });
			      } );
			  </script>
		</div>
		
		<script>
			var votos = <?php echo json_encode( array_values($voto) ); ?>;
			
			var representantes = <?php echo json_encode( array_values($representantes) ); ?>;
			var last_status_slug =  <?php echo $last_status_slug ; ?>;
			console.log(last_status_slug)
		    run.pieChart(votos, "<?php echo get_stylesheet_directory_uri() ?>")
		    run.representantes_load(representantes)

		    jQuery(".grafikas").on("click", function(e){
		    	jQuery("#graficas_content").slideToggle();
				return false;		    	
		    })

		   

		
	  	</script>	
		<?php } ?>
	  	
	  
			<div class="flex_column av_one_half first avia-builder-el-0 el_before_av_one_half avia-builder-el-first">
				<div class="flex_column av_one_half first avia-builder-el-0 el_before_av_one_half avia-builder-el-first status-i">				
				<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
				<div class="avia_textblock " itemprop="text">
				<p class="titulos-voto">Status <span>de la</span></p><p class="titulos-voto-2"><span>iniciativa</span></p>
				</div>
				</section>
				</div>
				
				<div class="flex_column av_one_half avia-builder-el-2 el_after_av_one_half avia-builder-el-last ">
				<section class="av_textblock_section" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
				<div class="avia_textblock " itemprop="text">
				<p class="resultado">
				<?php 
													if($elements[$status_final]=="Presentada"){
													   $status_final="Pleno";
													 }elseif($elements[$status_final]=="Turnada") {
													   $status_final="Comisiones";
													} elseif($elements[$status_final]=="Dictaminada y Aprobada") {
													   $status_final="Pleno";
													} elseif($elements[$status_final] =="Dicataminada en sentido negativo") {
													   $status_final="Comisiones";
													} elseif($elements[$status_final] == "Prórroga") {
													   $status_final="Comisiones";
													} elseif($elements[$status_final] == "Publicado") {
													   $status_final="Publicación";
													} elseif($elements[$status_final] == "Se le dispensaron todos los tramites") {
													   $status_final="Pleno";
													} elseif($elements[$status_final] == "Aprobada") {
													   $status_final="Minuta";
													} elseif($elements[$status_final] == "Dictaminada") {
													   $status_final="Comisiones";
													} else {
														$status_final="Otro";
													}
														
				
																echo $status_final; 
				
				?>
				
				</p>
				</div>
				</section>
                         </div>
			</div>
		
		        <div class="flex_column av_one_half avia-builder-el-2 el_after_av_one_half avia-builder-el-last ">
					<div  itemprop="text">
						<a class="avia_textblock boton-proceso" href="#proceso_legislativo" name="proceso_legislativo" id="ver_proceso_legislativo">Clic para ver proceso legislativo</a>
					</div>

                </div>


			<div class="" id="proceso_legislativo" style="display:none; width: 100%;" > 
		  		<img src="<?php echo 'http://curul501.org/wp-content/themes/curul501/images/' . $last_status_slug[0] . '.jpg'; ?>" >
		  	</div>
	                
		</div>

		</div><!--end container fin de iniciativa-->
		<!--div class="container tabla">
			Aqu&iacute; va la tabla
		</div-->			
                <div class="container top60">
			<?php			    		    
		        comments_template( '/includes/comments.php');
		        ?>
			</div>
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready( function () {
		jQuery("#ver_proceso_legislativo").on("click", function(e){
		    	jQuery("#proceso_legislativo").slideToggle();
				return false;		    	
		    })

		jQuery("#submit-filter").click( function(event) {
			event.preventDefault();
			
			if(jQuery("#partido-politico-filter option:selected").val() == "") {
				jQuery("#partido-politico-filter").remove();
			}
			
			if(jQuery("#estado-filter option:selected").val() == "") {
				jQuery("#estado-filter").remove();
			}
			
			if(jQuery("#comision-filter option:selected").val() == "") {
				jQuery("#comision-filter").remove();
			}
			
			if(jQuery("#tema-filter option:selected").val() == "") {
				jQuery("#tema-filter").remove();
			}
			
			if(jQuery("#status-filter option:selected").val() == "") {
				jQuery("#status-filter").remove();
			}
			
			if(jQuery("#postulante-filter option:selected").val() == "") {
				jQuery("#postulante-filter").remove();
			}
			
			
			
			jQuery("#filter-iniciativas").submit();
		});
	});
</script>
