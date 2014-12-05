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
								<form name="filter-representanes" id="filter-representanes" action="/iniciativas">
				<div id="filter">
				       <select class="sorter-tema sort" name="category">
					       <option value="1">Tema</option>
					       <option value="2">Tema 2</option>							
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-proponente sort" name="category">
					       <option value="2">Proponente(s)</option>
					       <option value="2">Opcion 2</option>														
				       </select>
			       </div>			       	   			   
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
				       <select class="sorter-comision sort" name="category">
					       <option value="1">Comisi&oacute;n dictaminadora</option>
					       <option value="2">Opcion 1</option>
					       <option value="2">Opcion 2</option>	
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-turno sort" name="category">
					       <option value="1">Fecha de elecci&oacute;n</option>
					       <option value="2">Opcion 1</option>
					       <option value="2">Opcion 2 reytruytrui7yigfhgfjhgj ghjkuyki ujyki</option>	
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-votacion sort" name="category">
					       <option value="1">Fecha de votaci&oacute;n</option>
					       <option value="2">Opcion 1</option>
					       <option value="2">Opcion 2 fgbhfgh</option>	
				       </select>
			       </div>
			       <div id="filter">										
				       <select class="sorter-estado sort" name="category">
					       <option value="1">Estado actual</option>
					       <option value="2">Opcion 1</option>
					       <option value="2">Opcion 2 htrujytiuyoyuitpotuiy�'o0+'+8+</option>	
				       </select>
			       </div>		
					</form>				
				   
			</div>
		</div>
<!-- Fin filtros iniciativas -->		

		<div class='container_wrap container_wrap_first main_color fullsize'>

			<div class='container'>

				<main class='template-page content  av-content-full alpha units'>
				<?php if (have_posts()) : ?>
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
														$presentada_representante_slug = str_replace('|', "-", $presentada_representante_slug);

														?>
								
																
				 <!--Inicio iniciaiva--><article class="post type-post status-publish format-standard hentry post-entry post-entry-type-standard post-parity-odd single-small pleca-624070">
									<div class="entry-content-wrapper clearfix">
										<div class="entry-content-wrapper clearfix">
											<!--Inicio fecga y resumen-->
											<div class="flex_column av_two_third first avia-builder-el-0 el_before_av_one_third avia-builder-el-first topTop">
												<div class="post_date">
													<span>13</span>
													Feb, 2014
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
														<?php	echo $decode[8]['total']; ?>
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
														if($presentada_dependencia != "") { echo $presentada_dependencia.", ";} 
														if($presentada_partido != "") { echo $presentada_partido.", ";} 
														if($presentada_representante != "") { echo str_replace('|', ", ", $presentada_representante);} 
														?>
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
							<?php 	endwhile; else: ?>
							<?php							
								endif;
								if(empty($avia_config['remove_pagination'] ))
								{
									echo "<div class='{$blog_style}'>".avia_pagination('', 'nav')."</div>";
								}
							?>							
				</main>
			</div><!--end container-->
		</div><!-- close default .container_wrap element -->

<?php get_footer(); ?>

<script type="text/javascript">
	jQuery(document).ready( function () {
		jQuery("#loading-gif").hide();
		
		jQuery("#partido-politico-filter").change( function() {
			if(jQuery("#partido-politico-filter option:selected").val() != "") {
				jQuery("#estado-filter").remove();
				jQuery("#comision-filter").remove();
				jQuery("#filter-representanes").submit();
			}
		});
		
		jQuery("#estado-filter").change( function() {
			if(jQuery("#estado-filter option:selected").val() != "") {
				jQuery("#partido-politico-filter").remove();
				jQuery("#comision-filter").remove();
				jQuery("#filter-representanes").submit();
			}
		});
		
		jQuery("#comision-filter").change( function() {
			if(jQuery("#comision-filter option:selected").val() != "") {
				jQuery("#estado-filter").remove();
				jQuery("#partido-politico-filter").remove();
				jQuery("#filter-representanes").submit();
			}
		});
		
		setMap();
	});
	
</script>

