<?php
	/*
	Template Name: home-negociacion
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
		.content, .sidebar {
		box-sizing: content-box;
		min-height: 1px;
		padding-bottom: 15px;
		padding-top: 50px;
		z-index: 1;
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

</style>

<section id="cabecera-negociacion">
	<div class="container">
		<div class="content ten alpha units">
			<div class="flex_column av_three_fourth flex_column_div first main_color">
                              <h1 id="titulo-neg-1">Exige mejor</h1>
                              <h1 id="titulo-neg-2">presupuesto</h1>
			</div>
			<div class="flex_column av_one_fourth videoneg">
				<a><img class="ver-video-neg" src="<?php echo get_home_url(); ?>/wp-content/themes/curul501/images/clic-video-neg.png"></a>
			</div>			
		</div>
	</div>
</section>
<section>
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

</section>
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