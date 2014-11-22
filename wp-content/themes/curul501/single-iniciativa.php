<?php get_header(); ?>
		<div class="container top60">										     
						<h1 class="entry-title-yellow">Iniciativas</h1>
						<div class="line-amarilla"> </div>
		</div>

<!--Inicio filtros iniciativas -->
		<div class="container box-menu">
			<div class="search-table">
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
				       <select class="sorter-partido sort" name="category">
					       <option value="1">Partido</option>
					       <option value="2">PRI</option>														
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
					       <option value="2">Opcion 2 htrujytiuyoyuitpotuiy´'o0+'+8+</option>	
				       </select>
			       </div>					
			</div>
		</div>
<!-- Fin filtros iniciativas -->		
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
		        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
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
					<div class="entry-content" itemprop="text">
						<ul class="lista-iniciativas">
							<li class="bullet-arrow"><?php echo get_post_meta($post->ID, 'wp_commissions', true); ?></li>
							<li class="bullet-arrow">Propuesta por: <?php echo get_post_meta($post->ID, 'wp_presentada', true); ?></li></li>
						</ul>
						<? the_content(); ?>					
						<div class="pleca-sub-info"></div>
						<ul class="sub-info">
							<li class="sub-info-li"><?php echo get_post_meta($post->ID, 'wp_fecha_votacion_tm', true); ?></li>
							<li class="sub-info-li"><?php echo get_post_meta($post->ID, 'wp_presentada', true); ?> Legislatura</li>
						</ul>
					</div>
                                         <?php endwhile; endif; ?>
				</main>
					
				<!--end content-->
				

			<aside class="sidebar sidebar_right three alpha units" role="complementary">
			<div class="sidebar-votos">
				<p class="vota">Vota</p>
				<p class="encurul"> en curul</p>
				
			</div>			
			<div class="textwidget share-sidebar-vota">
			         <?php avia_social_share_links(); ?>
			</div>
			<div class="textwidget">
				<div class="linea-morado"></div>
				<div class="tab-item-temas">
			           <img src="<?php echo get_stylesheet_directory_uri() ?>/images/barra-temporizador.png" />
				</div>
				<?php echo get_post_meta($post->ID, 'wp_topics', true); ?>
			</div>
			<div class="textwidget">
				<div class="linea-morado"></div>
				<div class="tab-item-temas">
					<img src="<?php echo get_stylesheet_directory_uri() ?>/images/barra-temporizador.png" />
				</div>
				<?php echo get_post_meta($post->ID, 'wp_gaceta', true); ?>Texto integro
				</div>
			<div class="textwidget">			
				<div class="linea-morado"></div>
				Gaceta parlamentaria<?php echo get_post_meta($post->ID, 'wp_gaceta', true); ?>
			</div>
			
			</div>
			</aside>


			</div><!--end container-->
                        <div class="container top60">
			<?php			    		    
		        comments_template( '/includes/comments.php');
		        ?>
			</div>
		</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>