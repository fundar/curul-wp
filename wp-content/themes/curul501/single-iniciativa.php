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
		
			<div class='container template-blog template-single-blog '>

				<main class="content units av-content-small alpha" role="main">
				        <header class="entry-content-header">
						<h1 itemprop="headline" class="post-title entry-title">
							Phasellus viverra eros vel sem blandit, quis scelerisque neque malesuada
						</h1>
						<div class="linea-morado"></div>
						<h3 itemprop="headline" class="post-title entry-title">
							Con proyecto de decreto, que reforma y adiciona los articulos 6o., 73, 76, 78, 89, 105, 108, 110, 111, 116 y 122 
						</h3>
					</header>
					<div class="entry-content" itemprop="text">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ultrices aliquet condimentum. Aenean id tristique ligula. Nunc sed varius turpis, nec malesuada risus. Donec convallis tellus vitae ligula sagittis malesuada. Proin vitae quam hendrerit, pretium erat id, semper dolor. Nam ornare eget turpis eget rutrum. Morbi ante sem, aliquet vel laoreet et, molestie ut metus. Cras tincidunt convallis nibh, a egestas purus egestas quis. Maecenas non placerat dui, vel iaculis tellus. Etiam tempor lorem elit, a lobortis velit viverra sed. Pellentesque volutpat pretium nisl ac interdum. Sed accumsan, odio vitae convallis fringilla, elit ligula imperdiet augue, ut ullamcorper nulla sapien a dolor. Etiam aliquet enim eget tristique rutrum. Nulla non augue libero. Cras rutrum enim mi, in vehicula diam suscipit eget. Aenean elementum metus nec velit ultrices imperdiet.</p>
					</div>

				</main>
					
				<!--end content-->
				

			<aside class="sidebar sidebar_right three alpha units" role="complementary">
			<div class="sidebar-votos">
				<p class="vota">Vota</p>
				<p class="encurul"> en curul</p>
			</div>
			<?php avia_social_share_links(); ?> 	
			</aside>


			</div><!--end container-->
                        <div class="container top60">
			<?php			    		    
		        comments_template( '/includes/comments.php');
		        ?>
			</div>
		</div><!-- close default .container_wrap element -->


<?php get_footer(); ?>