<?php
global $avia_config;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */
	 get_header();


 	 if( get_post_meta(get_the_ID(), 'header', true) != 'no') echo avia_title();
	 ?>
    <div id="" class="avia-fullscreen-slider main_color avia-builder-el-0 el_before_av_section avia-builder-el-first container_wrap fullsize">
		<!-- inicio mapa de representantes-->
		<div class="forcefullwidth_wrapper_tp_banner" style="position: relative; width: 100%; height: auto; margin-bottom: 0px;">
		   <div id="av_section_1" class="avia-section main_color avia-section-default avia-no-border-styling avia-bg-style-scroll avia-builder-el-0 avia-builder-el-no-sibling av-minimum-height av-minimum-height-100 container_wrap sidebar_right" style="background-color: #f4f4f4; ">
				<div id="map" style="width: 100%; height:500px;"></div>
				<div class="map-info-representante"></div>
			</div>
		</div>
		<!-- fin mapa de representantes-->
	</div>

<?php get_footer(); ?>

<script src="<?php echo get_stylesheet_directory_uri() ?>/js/estados.geojson.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/leaflet-pip.min.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/init-ubica.js" type="text/javascript"></script>
<script src="<?php echo get_stylesheet_directory_uri() ?>/js/representatives.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery(document).ready( function () {
		setMap();
	});
</script>
