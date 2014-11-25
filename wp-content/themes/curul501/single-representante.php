<?php
	global $avia_config, $more;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();

	?>
		<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
			 <!-- titulo-->
			<div class="container top60">
			<h1 class="entry-title-yellow">Integrantes de la Camara</h1>
			<div class="line-amarilla"> </div>
		        </div>
			<!-- fin de titulo-->
<!--Inicio filtros iniciativas -->
		<div class="container box-menu">
			<div class="search-table">
				<div id="filter">
				       <select class="sorter-rep sort" name="category">
					       <option value="1">Partidos pol&iacute;ticos</option>
					       <option value="2">Tema 2</option>							
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-rep sort" name="category">
					       <option value="1">Estado</option>
					       <option value="2">Estado</option>														
				       </select>
			       </div>
			       <div id="filter">				
				       <select class="sorter-rep sort" name="category">
					       <option value="1">Comisiones</option>
					       <option value="2">Seguridad P&uacute;blica</option>														
				       </select>
			       </div>				
			</div>
		</div>
<!-- Fin filtros iniciativas -->
<div class='container_wrap container_wrap_first main_color <?php avia_layout_class( 'main' ); ?>'>
<div class='container'>
	<main class="content av-content-small alpha units" itemtype="https://schema.org/Blog" itemscope="itemscope" itemprop="mainContentOfPage" role="main">
                <article class="post-1 post type-post status-publish format-standard hentry category-uncategorized post-entry post-entry-type-standard post-entry-1 post-loop-1 post-parity-odd post-entry-last single-small " itemprop="blogPost" itemtype="https://schema.org/BlogPosting" itemscope="itemscope">
			
		        <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
				
				        <header class="entry-content-header">
						<h1 itemprop="headline" class="post-title entry-title">
							<?php the_title(); ?>
						</h1>
						<div class="linea-morado"></div>
						<h3 itemprop="headline" class="post-title entry-title">
							<?php echo get_post_meta($post->ID, 'wp_titulo_listado', true); ?>
						</h3>
					</header>
                                          <? the_content(); ?>
                                         <?php endwhile; endif; ?>
				
			
		
		</article>
	</main>
	<!--sidebar-->
	<div class="sidebar sidebar_right smartphones_sidebar_active alpha units" itemtype="https://schema.org/WPSideBar" itemscope="itemscope" role="complementary">
	<div class="inner_sidebar">
	gseyryu
	</div>
	</div><!--end sidebar-->
				
   </div><!--end container-->
</div><!-- close default .container_wrap element -->
<?php get_footer(); ?>