<?php get_header(); 
	
	global $avia_config, $more;
	$selectedOption = getParameterValueGET();
	$data = getDataRepresentatives();


?>
 	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/libs/d3.v3.min.js" type="text/javascript"></script>
	<script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js">  </script>
	
	<script src="<?php echo get_stylesheet_directory_uri() ?>/js/scripts/app.js" type="text/javascript"></script>

  
 	
		<div class="container top60">										     
						<h1 class="entry-title-yellow">Iniciativas</h1>
						<div class="line-amarilla"> </div>
		</div>

<!--Inicio filtros iniciativas -->
		<!--Inicio filtros iniciativas -->
		<div class="container box-menu">
			<div class="search-table">
								<form name="filter-iniciativas" id="filter-iniciativas" action="/iniciativas">
				   <div id="filter">
						   <select class="sorter-rep sort" name="partido-politico" id="partido-politico-filter">
							   <option value="">Partidos pol&iacute;ticos</option>
							   <?php $politicalPartiesArray = getPoliticalParties(); ?>
							   <?php foreach($politicalPartiesArray as $value) { ?>
									<option value="<?php echo $value["slug"];?>" <?php if($selectedOption == $value["slug"]) echo 'selected="selected"'?>>
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
									<option value="<?php echo $value->slug;?>" <?php if($selectedOption == $value->slug) echo 'selected="selected"'?>>
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
									<option value="<?php echo utf8_encode($value["slug"]);?>" <?php if($selectedOption == utf8_encode($value["slug"])) echo 'selected="selected"'?>>
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
									<option value="<?php echo utf8_encode($value["slug"]);?>" <?php if($selectedOption == utf8_encode($value["slug"])) echo 'selected="selected"'?>>
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
									<option value="<?php echo $value->slug;?>" <?php if($selectedOption == $value->slug) echo 'selected="selected"'?>>
										<?php echo $value->full_name;?>
									</option>
								<?php } ?>
						   </select>
					   </div>
					   
					   		   
			       		
					</form>				
				   
			</div>
		</div>
<!-- Fin filtros iniciativas -->		

<!-- Fin filtros iniciativas -->		
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
						<?php
							$presentada_representante	    = get_post_meta($post->ID, 'wp_presentada', true);
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




												
						?>
			<div class='container template-blog template-single-blog '>

				<main class="content units av-content-small alpha cpt-iniciativa" role="main">
				        <header class="entry-content-header">
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
							<p><?php echo str_replace('|', ", ", get_post_meta($post->ID, 'wp_commissions', true)); ?></p>
							</li>
							<li class="bullet-arrow">Propuesta por
							<p><?php if($presentada_dependencia != "") { echo $presentada_dependencia.", ";} ?>
							<?php if($presentada_partido != "") { echo $presentada_partido.", ";} ?>
							<?php if($presentada_representante != "") { echo $presentada_representante;} ?></p></li>
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
						<p class="num-votos-pleno"><?php echo $decode[8]['total'];?></p>
						<p class="total-votos-pleno">Votos totales</p>			
						</div>
						</section>
						</div>
					</div>
			</div>
			
		<div class="container griss">
			<a class="grafikas" href="">Ver gr&aacute;ficas de las votaciones en pleno</a>                         

		</div>
		
		<div id="graficas_content">
			<div id="pie_chart"></div>

			<div id="bartitle">
			    <span id="bartitle_text"> </span> 
			    <span id="bartitle_count"> </span> 
			</div>

			<div id="bar_chart"></div>

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
			          var row  = "<td>" + representantes[i].nombre + "</td>"
			              row  += "<td>" + representantes[i].partido + "</td>"
			              row  += "<td>" + representantes[i].tipo + "</td>"
			              row  += "<td>" +  (representantes[i].zone_state || "No conocido" ) + "</td>"
			          
			          jQuery("#table_id tbody").append("<tr>" + row + "</tr>")
			        }
			        jQuery('#table_id').DataTable();
			      } );
			  </script>
		</div>
		
		<script>
			var votos = <?php echo json_encode( array_values($voto) ); ?>;
			var representantes = <?php echo json_encode( array_values($representantes) ); ?>;

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
				<p class="resultado"><?php echo $elements[$status_final]; ?></p>
				</div>
				</section>
                         </div>
			</div>
		
		        <div class="flex_column av_one_half avia-builder-el-2 el_after_av_one_half avia-builder-el-last ">
				<div  itemprop="text">
				<a class="avia_textblock boton-proceso" href="">Clic para ver proceso legislativo</a>
				</div>
                         </div>

		</div>
                

		</div><!--end container fin de iniciativa-->
		<div class="container tabla">
			Aqu&iacute; va la tabla
		</div>			
                <div class="container top60">
			<?php			    		    
		        comments_template( '/includes/comments.php');
		        ?>
			</div>
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>
<script type="text/javascript">
	jQuery(document).ready( function () {
		jQuery("#loading-gif").hide();
		
		jQuery("#partido-politico-filter").change( function() {
			if(jQuery("#partido-politico-filter option:selected").val() != "") {
				jQuery("#tema-filter").remove();
				jQuery("#comision-filter").remove();
				jQuery("#status-filter").remove();
				jQuery("#postulante-filter").remove();
				jQuery("#filter-iniciativas").submit();
			}
		});
		
		jQuery("#tema-filter").change( function() {
			if(jQuery("#tema-filter option:selected").val() != "") {
				jQuery("#partido-politico-filter").remove();
				jQuery("#comision-filter").remove();
				jQuery("#status-filter").remove();
				jQuery("#postulante-filter").remove();
				jQuery("#filter-iniciativas").submit();
			}
		});
		
		jQuery("#comision-filter").change( function() {
			if(jQuery("#comision-filter option:selected").val() != "") {
				jQuery("#tema-filter").remove();
				jQuery("#partido-politico-filter").remove();
				jQuery("#status-filter").remove();
				jQuery("#postulante-filter").remove();
				jQuery("#filter-iniciativas").submit();
			}
		});
				
		jQuery("#status-filter").change( function() {
			if(jQuery("#status-filter option:selected").val() != "") {
				jQuery("#tema-filter").remove();
				jQuery("#partido-politico-filter").remove();
				jQuery("#comision-filter").remove();
				jQuery("#postulante-filter").remove();
				jQuery("#filter-iniciativas").submit();
			}
		});
		
		
		jQuery("#postulante-filter").change( function() {
			if(jQuery("#postulante-filter option:selected").val() != "") {
				jQuery("#tema-filter").remove();
				jQuery("#status-filter").remove();
				jQuery("#partido-politico-filter").remove();
				jQuery("#comision-filter").remove();
				jQuery("#filter-iniciativas").submit();
			}
		});
		
		
		
		setMap();
	});
	
</script>
