		<?php
		global $avia_config;
		$blank = isset($avia_config['template']) ? $avia_config['template'] : "";

		//reset wordpress query in case we modified it
		wp_reset_query();


		//get footer display settings
		$the_id 				= avia_get_the_id(); //use avia get the id instead of default get id. prevents notice on 404 pages
		$footer 				= get_post_meta($the_id, 'footer', true);
		$footer_widget_setting 	= !empty($footer) ? $footer : avia_get_option('display_widgets_socket');


		//check if we should display a footer
		if(!$blank && $footer_widget_setting != 'nofooterarea' )
		{
			if( $footer_widget_setting != 'nofooterwidgets' )
			{
				//get columns
				$columns = avia_get_option('footer_columns');
		?>
				<div class='container_wrap footer_color' id='footer'>

					<div class='container'>

						<?php
						do_action('avia_before_footer_columns');

						//create the footer columns by iterating

						
				        switch($columns)
				        {
				        	case 1: $class = ''; break;
				        	case 2: $class = 'av_one_half'; break;
				        	case 3: $class = 'av_one_third'; break;
				        	case 4: $class = 'av_one_fourth'; break;
				        	case 5: $class = 'av_one_fifth'; break;
				        	case 6: $class = 'av_one_sixth'; break;
				        }
				        
				        $firstCol = "first el_before_{$class}";

						//display the footer widget that was defined at appearenace->widgets in the wordpress backend
						//if no widget is defined display a dummy widget, located at the bottom of includes/register-widget-area.php
						for ($i = 1; $i <= $columns; $i++)
						{
							if($i != 1) $class .= " el_after_{$class}  el_before_{$class}";
							echo "<div class='flex_column {$class} {$firstCol}'>";
							if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) ) : else : avia_dummy_widget($i); endif;
							echo "</div>";
							$firstCol = "";
						}

						do_action('avia_after_footer_columns');

						?>


					</div>


				<!-- ####### END FOOTER CONTAINER ####### -->
				</div>

	<?php   } //endif nofooterwidgets ?>



			<!-- end main -->
			</div>

			<?php

			//copyright
			$copyright = do_shortcode( avia_get_option('copyright', "&copy; ".__('Copyright','avia_framework')."  - <a href='".home_url('/')."'>".get_bloginfo('name')."</a>") );

			// you can filter and remove the backlink with an add_filter function
			// from your themes (or child themes) functions.php file if you dont want to edit this file
			// you can also just keep that link. I really do appreciate it ;)
			


			//you can also remove the kriesi.at backlink by adding [nolink] to your custom copyright field in the admin area
			if($copyright && strpos($copyright, '[nolink]') !== false)
			{
				$kriesi_at_backlink = "";
				$copyright = str_replace("[nolink]","",$copyright);
			}

			if( $footer_widget_setting != 'nosocket' )
			{

			?>

				<footer class='container_wrap socket_color' id='socket' <?php avia_markup_helper(array('context' => 'footer')); ?>>
                    <div class='container'>

                        <span class='copyright'><?php echo $copyright . $kriesi_at_backlink; ?></span>

                        <?php
                            echo "<nav class='sub_menu_socket' ".avia_markup_helper(array('context' => 'nav', 'echo' => false)).">";
                                $avia_theme_location = 'avia3';
                                $avia_menu_class = $avia_theme_location . '-menu';

                                $args = array(
                                    'theme_location'=>$avia_theme_location,
                                    'menu_id' =>$avia_menu_class,
                                    'container_class' =>$avia_menu_class,
                                    'fallback_cb' => '',
                                    'depth'=>1
                                );

                                wp_nav_menu($args);
                            echo "</nav>";
                        ?>

                    </div>

	            <!-- ####### END SOCKET CONTAINER ####### -->
				</footer>


			<?php
			} //end nosocket check


		}
		else
		{
			echo "<!-- end main --></div>";
		} //end blank & nofooterarea check

		//display link to previeous and next portfolio entry
		echo avia_post_nav();

		echo "<!-- end wrap_all --></div>";


		if(isset($avia_config['fullscreen_image']))
		{ ?>
			<!--[if lte IE 8]>
			<style type="text/css">
			.bg_container {
			-ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $avia_config['fullscreen_image']; ?>', sizingMethod='scale')";
			filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $avia_config['fullscreen_image']; ?>', sizingMethod='scale');
			}
			</style>
			<![endif]-->
		<?php
			echo "<div class='bg_container' style='background-image:url(".$avia_config['fullscreen_image'].");'></div>";
		}
	?>
<!-- <aside id="buscador" class="desktop" data-no-touch="" data-track-id="" style="">
	ijij
</aside>-->

<?php wp_footer(); ?>

<a href='#top' title='<?php _e('Scroll to top','avia_framework'); ?>' id='scroll-top-link' <?php echo av_icon_string( 'scrolltop' ); ?>><span class="avia_hidden_link_text"><?php _e('Scroll to top','avia_framework'); ?></span></a>
<div id="fb-root"></div>

	<!-- Login -->
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/style-modal.css" />
		<div id="modal" class="popupContainer" style="display:none;">
			<header class="popupHeader">
				<span class="header_title">Acceder</span>
				<span class="modal_close"><i class="fa fa-times"></i></span>
			</header>
			
			<section class="popupBody">
				<!-- Social Login -->
				<div class="social_login">
					<div class="wp-social-login-widget">
						<div id="wp-social-login-connect-with" class="wp-social-login-connect-with">Conectate con:</div>
						<div id="wp-social-login-connect-options" class="wp-social-login-provider-list">
							<a rel="nofollow" href="javascript:void(0);" title="Connect with Facebook" class="wsl_connect_with_provider wp-social-login-provider wp-social-login-provider-facebook" data-provider="Facebook"> 
								<img alt="Facebook" title="Connect with Facebook" src="http://curul501.org/wp-content/plugins/wordpress-social-login/assets/img/32x32/wpzoom/facebook.png" />	
							</a>
							<a rel="nofollow" href="javascript:void(0);" title="Connect with Google" class="wsl_connect_with_provider wp-social-login-provider wp-social-login-provider-google" data-provider="Google"> 
								<img alt="Google" title="Connect with Google" src="http://curul501.org/wp-content/plugins/wordpress-social-login/assets/img/32x32/wpzoom/google.png" />	
							</a>
							<a rel="nofollow" href="javascript:void(0);" title="Connect with Twitter" class="wsl_connect_with_provider wp-social-login-provider wp-social-login-provider-twitter" data-provider="Twitter"> 
								<img alt="Twitter" title="Connect with Twitter" src="http://curul501.org/wp-content/plugins/wordpress-social-login/assets/img/32x32/wpzoom/twitter.png" />	
							</a>
							<a rel="nofollow" href="javascript:void(0);" title="Connect with LinkedIn" class="wsl_connect_with_provider wp-social-login-provider wp-social-login-provider-linkedin" data-provider="LinkedIn"> 
								<img alt="LinkedIn" title="Connect with LinkedIn" src="http://curul501.org/wp-content/plugins/wordpress-social-login/assets/img/32x32/wpzoom/linkedin.png" />	
							</a>
							<input id="wsl_popup_base_url" type="hidden" value="http://curul501.org/wp-login.php?action=wordpress_social_authenticate&#038;" />
							<input type="hidden" id="wsl_login_form_uri" value="http://curul501.org/wp-login.php" />
						</div> 
						<div class="wp-social-login-widget-clearing"></div>
					</div>
				</div>
			</section>
		</div>
		<script type='text/javascript' src='http://curul501.org/wp-content/plugins/wordpress-social-login/assets/js/script.js?ver=4.0.1'></script>
		<script src="<?php echo get_stylesheet_directory_uri() ?>/js/jquery.leanModal.min.js" type="text/javascript"></script>
		<script type="text/javascript">
			jQuery("#modal_trigger_login").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });

			jQuery(function(){
				// Calling Login Form
				jQuery("#login_form").click(function(){
					jQuery(".social_login").hide();
					jQuery(".user_login").show();
					return false;
				});
			})
		</script>
	<!-- Login -->
</body>
</html>
