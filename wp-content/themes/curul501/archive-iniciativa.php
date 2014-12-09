<?php
	global $avia_config, $more;
	$selectedOption = getParameterValueGET();
	$data = getDataIniciativas();

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();
	
		
		$showheader = true;
		if(avia_get_option('frontpage') && $blogpage_id = avia_get_option('blogpage'))
		{
			if(get_post_meta($blogpage_id, 'header', true) == 'no') $showheader = false;
		}
		
	 	
	?>
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

		<div class='container_wrap container_wrap_first main_color fullsize'>

			<div class='container'>

				<main class='template-page content  av-content-full alpha units'>
			<?php if($data) { ?>
						<?php if ($data->have_posts()) { ?>
							<?php while ($data->have_posts()) : $data->the_post(); ?>
							
							<?php										
														$presentada_representante	    = get_post_meta($post->ID, 'wp_presentada', true);
														$presentada_partido	            = get_post_meta($post->ID, 'wp_presentada_partidos', true);
														$presentada_dependencia	        = get_post_meta($post->ID, 'wp_presentada_dependencias', true);
														$votos 	= get_post_meta($post->ID, 'wp_votos', true);
													    $WorkingArray = json_decode(json_encode($votos),true);
												        $decode = json_decode($WorkingArray, true);
														$status_iniciativa             	        = get_post_meta($post->ID, 'wp_status', true);
														$elements = explode("|", $status_iniciativa);
														$status_final=count($elements)-1;
													    $presentada_representante_slug	    = get_post_meta($post->ID, 'wp_presentada_slug', true);
														$presentada_representante_slug = str_replace('|', "-", $presentada_representante_slug);			
														$fecha_listado=get_post_meta($post->ID, 'wp_fecha_listado_tm', true);
														$explode_listado = explode(" ", $fecha_listado);
														$fecha_sin_hora=$explode_listado[0];
														$explode2 = explode("-", $fecha_sin_hora);
														$ano = $explode2[0];
														$mes = $explode2[1];
														$dia = $explode2[2];
													    $meses=array('01'=>'En','02'=>'Febr','03'=>'Mzo','04'=>'Abr','05'=>'My','06'=>'Jun','07'=>'Jul','08'=>'Agt','09'=>'Sept','10'=>'Oct','11'=>'Nov','12'=>'Dic');
														$partido_politico_slug	    = get_post_meta($post->ID, 'wp_presentada_partidos_slug', true);
														$presentadas = explode('|', get_post_meta($post->ID, 'wp_presentada', true));
														$presentadas_slug = explode('|', get_post_meta($post->ID, 'wp_presentada_slug', true));
														$htmlpresentadas = "";
														$link_representante = get_site_url() . "/representantes/";
													
														if($presentadas) {
															foreach($presentadas as $key => $presentada) {
																$htmlpresentadas .= "<a href='" . $link_representante . $presentadas_slug[$key] . "' title='" . $presentada . "'>" . $presentada . "</a></br>";
																}
															} else {
														$htmlpresentadas = "<p>No se encuentran comisiones relacionadas</p>";
																	}
																				?>
								
																
				 <!--Inicio iniciaiva-->
				 <article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small pleca-624070">
									<div class="entry-content-wrapper clearfix">
										<div class="entry-content-wrapper clearfix">
											<!--Inicio fecga y resumen-->
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first topTop">
												<div class="post_date">
													<span><?php echo $dia; ?></span>
													<?php echo $meses[$mes]; ?>, <?php echo $ano; ?>
												</div>
												<div class="entry-content no-voto">
													 <p class="resemen-recientes-iniciativas titulo-<?php the_ID(); ?>">
			                                                                                 <a class="iniciativas-home" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
												         </p>
													 <?php the_excerpt(); ?> 
                          
												</div>
											</div><!--fin fecha y resumen-->
											<div class="flex_column av_one_third avia-builder-el-2 el_after_av_two_third avia-builder-el-last topTop leftRI top12">
												<div class="col-status">
													<div class="datos">
													Status													
													<div class="temporizador"> 
													<p><?php echo $elements[$status_final]; ?></p>
													</div>
													</div>													
												</div> 
												<?php
																								
												  if($votos != "") { ?>
												
												<div class="col-status-1">
													<div class="datos">
													Votaci&oacute;n final													
													</div>
													<div class="votos-oficiles">
													</div>
													<div class="hands-vote-inic">
									                                <ul>
													        <li class="hand-up"><?php echo $decode[8]['favor']; ?></li>
													        <li class="hand-down"><?php echo $decode[8]['contra']; ?></li>
													</ul>
									
													</div>
												</div>
																					<?php } else {  ?>

																					<div class="col-status-1">
													<div class="datos">
													Votaci&oacute;n final													
													</div>
													<div class="votos-oficiles">
													<p class="estiloEstatusP">Sin Votaci&oacute;n</p>													
													</div>
													
												</div>											
																					<?php } ?>

																					

												
												<div class="col-status-2">
													<div class="datos">Propuesta por:</div>
													<p class="estiloEstatusP">	<?php
														if($presentada_dependencia != "") { echo $presentada_dependencia."";} 
														if($presentada_partido != "") { ?> <a href="<?php echo get_site_url() . '/iniciativas/?partido-politico=' . $partido_politico_slug; ?>"> <?php echo  $presentada_partido."</br>";}
														 echo $htmlpresentadas; ?>
														
													</p>
													
												</div>													
											</div>
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first">
												<div class="in-box-share no-voto">
												<?php avia_social_share_links(); ?>
												</div>
											</div>
											<div class="vta-curul">
												<span>Votaci&oacute;n en Curul 501</span>
												<div class="in-box-share"></div>
												
												
												
												
												
											</div>

											
										</div>
									</div>
							</article><!--fin iniciativas-->

							<?php endwhile; ?>
								<?php } else { ?>
							<p>No se encontraron iniciativas con esta busqueda</p>
						<?php } ?>
					<?php } else { ?>




			<?php if (have_posts()) { ?>
                                <?php while (have_posts()) : the_post(); ?>
														<?php										
														$presentada_representante	    = get_post_meta($post->ID, 'wp_presentada', true);
														$presentada_partido	            = get_post_meta($post->ID, 'wp_presentada_partidos', true);
														$presentada_dependencia	        = get_post_meta($post->ID, 'wp_presentada_dependencias', true);
														$votos 	= get_post_meta($post->ID, 'wp_votos', true);
													    $WorkingArray = json_decode(json_encode($votos),true);
												        $decode = json_decode($WorkingArray, true);
														$status_iniciativa             	        = get_post_meta($post->ID, 'wp_status', true);
														$elements = explode("|", $status_iniciativa);
														$status_final=count($elements)-1;
													    $presentada_representante_slug	    = get_post_meta($post->ID, 'wp_presentada_slug', true);
														//$presentada_representante_slug = str_replace('|', "-", $presentada_representante_slug);
														$fecha_listado=get_post_meta($post->ID, 'wp_fecha_listado_tm', true);
														$explode_listado = explode(" ", $fecha_listado);
														$fecha_sin_hora=$explode_listado[0];
														$explode2 = explode("-", $fecha_sin_hora);
														$ano = $explode2[0];
														$mes = $explode2[1];
														$dia = $explode2[2];
													    $meses=array('01'=>'En','02'=>'Febr','03'=>'Mzo','04'=>'Abr','05'=>'My','06'=>'Jun','07'=>'Jul','08'=>'Agt','09'=>'Sept','10'=>'Oct','11'=>'Nov','12'=>'Dic');
														$partido_politico_slug	    = get_post_meta($post->ID, 'wp_presentada_partidos_slug', true);
														$presentadas = explode('|', get_post_meta($post->ID, 'wp_presentada', true));
														$presentadas_slug = explode('|', get_post_meta($post->ID, 'wp_presentada_slug', true));
														$htmlpresentadas = "";
														$link_representante = get_site_url() . "/representantes/";
													
														if($presentadas) {
															foreach($presentadas as $key => $presentada) {
																$htmlpresentadas .= "<a href='" . $link_representante . $presentadas_slug[$key] . "' title='" . $presentada . "'>" . $presentada . "</a></br>";
																}
															} else {
														$htmlpresentadas = "<p>No se encuentran comisiones relacionadas</p>";
																	}

														?>
								
																
				 <!--Inicio iniciaiva-->
				 <article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small pleca-624070">
									<div class="entry-content-wrapper clearfix">
										<div class="entry-content-wrapper clearfix">
											<!--Inicio fecga y resumen-->
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first topTop">
												<div class="post_date">
														<span><?php echo $dia; ?></span>
													<?php echo $meses[$mes]; ?>, <?php echo $ano; ?>
												</div>
												<div class="entry-content">
													 <p class="resemen-recientes-iniciativas titulo-<?php the_ID(); ?>">
			                                                                                 <a class="iniciativas-home" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
												         </p>
													 <?php the_excerpt(); ?> 
                          
												</div>
											</div><!--fin fecha y resumen-->
											<div class="flex_column av_one_third avia-builder-el-2 el_after_av_two_third avia-builder-el-last topTop leftRI top12">
												<div class="col-status">
													<div class="datos">
													Status													
													<div class="temporizador"> 
													<p><?php echo $elements[$status_final]; ?></p>
													</div>
													</div>													
												</div> 
												<?php
																								
												  if($votos != "") { ?>
												
												<div class="col-status-1">
													<div class="datos">
													Votaci&oacute;n final													
													</div>
													<div class="votos-oficiles">
													</div>
													<div class="hands-vote">
									                                <ul>
													        <li class="hand-up"><?php echo $decode[8]['favor']; ?></li>
													        <li class="hand-down"><?php echo $decode[8]['contra']; ?></li>
													</ul>
									
													</div>
												</div>
																					<?php } else {  ?>

																					<div class="col-status-1">
													<div class="datos">
													Votaci&oacute;n final													
													</div>
													<div class="votos-oficiles">
													<p class="estiloEstatusP">Sin Votaci&oacute;n</p>													
													</div>
													
												</div>											
																					<?php } ?>

																					

												
												<div class="col-status-2">
													<div class="datos">Propuesta por:</div>
													<p class="estiloEstatusP">	<?php
														if($presentada_dependencia != "") { echo $presentada_dependencia."";} 
														if($presentada_partido != "") { ?> <a href="<?php echo get_site_url() . '/iniciativas/?partido-politico=' . $partido_politico_slug; ?>"> <?php echo  $presentada_partido."</br>";}
														echo $htmlpresentadas; ?>
														
													</p>
													
													
												</div>													
											</div>
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first">
												<div class="in-box-share">
												<?php avia_social_share_links(); ?>
												</div>
											</div>
											<div class="vta-curul">
												<span>Votaci&oacute;n en Curul 501</span>
												
												
												
												
												
											</div>

											
										</div>
									</div>
							</article><!--fin iniciativas-->
							<?php endwhile; ?>
						<?php } ?>
					<?php } ?>
							
				</main>
				<?php
						if($data) {
							echo "<div class='{$blog_style}'>" . avia_pagination2('', 'nav', $data) . "</div>";
						} else {
							echo "<div class='{$blog_style}'>" . avia_pagination2('', 'nav') . "</div>";
						}
					?>
			</div><!--end container-->
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>

<script type="text/javascript">
	jQuery(document).ready( function () {
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
			
			if(jQuery("#tipo-eleccion-filter option:selected").val() == "") {
				jQuery("#tipo-eleccion-filter").remove();
			}
			
			jQuery("#filter-representanes").submit();
		});
	});
</script>

