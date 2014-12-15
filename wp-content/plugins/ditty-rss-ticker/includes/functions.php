<?php

/* --------------------------------------------------------- */
/* !Add the ticker type button - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_rss_type( $types ) {
	$types['rss'] = array(
		'button' => __('RSS', 'ditty-rss-ticker'),
		'metaboxes' => array( 'mtphr_dnt_rss_data' )
	);
	return $types;
}
add_filter( 'mtphr_dnt_types', 'mtphr_dnt_rss_type' );



/* --------------------------------------------------------- */
/* !Add the settings to the ticker - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_rss_settings( $settings ) {
	$settings['RSS'] = 'mtphr_dnt_rss_settings';
	return $settings;
}
add_filter( 'mtphr_dnt_settings', 'mtphr_dnt_rss_settings' );



/* --------------------------------------------------------- */
/* !Modify the ticks - 1.0.3 */
/* --------------------------------------------------------- */

function mtphr_dnt_rss_ticks( $ticks, $id, $meta_data ) {

	// Extract the meta
	extract( $meta_data );

	$type = $_mtphr_dnt_type;

	if( $type == 'rss' ) {

		// Create a new ticks array
		$new_ticks = array();

		if( is_array($_mtphr_dnt_rss_feeds) ) {

			// Get the urls
			$urls = array();
			foreach( $_mtphr_dnt_rss_feeds as $i => $feed ) {
				if( esc_url($feed['url']) != '' ) {
					$urls[] = esc_url($feed['url']);
				}
			}

			// Set the link target
			$target = ( isset($_mtphr_dnt_rss_target) && $_mtphr_dnt_rss_target ) ? ' target="_blank"' : '';

			include_once( ABSPATH.WPINC.'/class-simplepie.php' );
			$feed = new SimplePie();
			$feed->set_cache_location( MTPHR_DNT_RSS_DIR.'assets/cache' );
			$feed->set_feed_url( $urls );
			$feed->set_item_limit( intval($_mtphr_dnt_rss_limit) );

			$settings = get_option('mtphr_dnt_rss_settings');
			$cachetime = isset($settings['cache_time']) ? intval($settings['cache_time'])*60 : 600;
			if( $cachetime < 60 ) {
				$cachetime = 60;
			}
			$cachetime = 3600;

			$feed->set_cache_duration( $cachetime );
			$feed->init();
			$items = $feed->get_items();

			foreach ( $items as $item ) {

				$tick = '';
				foreach( $_mtphr_dnt_rss_display_order as $key ) {

					switch( $key ) {
						case 'title':
							if( isset($_mtphr_dnt_rss_title) && $_mtphr_dnt_rss_title ) {

								$title = apply_filters( 'mtphr_dnt_rss_title', $item->get_title(), $meta_data );
								$tick_title = '<h4 class="mtphr-dnt-rss-title">'.$title.'</h4>';

								// Check for a link
								if( isset($_mtphr_dnt_rss_title_link) ) {
									if( $_mtphr_dnt_rss_title_link ) {
										$tick_title = '<h4 class="mtphr-dnt-rss-title"><a href="'.$item->get_permalink().'"'.$target.'>'.$title.'</a></h4>';
									}
								}

								$tick .= $tick_title;
							}
							break;
						case 'date':
							if( isset($_mtphr_dnt_rss_date) && $_mtphr_dnt_rss_date ) {
								$before = ( $_mtphr_dnt_rss_date_before != '' ) ? '<span class="mtphr-dnt-rss-before">'.sanitize_text_field($_mtphr_dnt_rss_date_before).'</span> ' : '';
								$after = ( $_mtphr_dnt_rss_date_after != '' ) ? ' <span class="mtphr-dnt-rss-after">'.sanitize_text_field($_mtphr_dnt_rss_date_after).'</span>' : '';
								$date = $before.$item->get_date( $_mtphr_dnt_rss_date_format ).$after;
								$date = apply_filters( 'mtphr_dnt_rss_date', $date, $before, $after, $meta_data );
								$tick .= '<small class="mtphr-dnt-rss-date">'.$date.'</small>';
							}
							break;
						case 'author':
							if( isset($_mtphr_dnt_rss_author) && $_mtphr_dnt_rss_author && $item->get_author() ) {
								$before = ( $_mtphr_dnt_rss_author_before != '' ) ? '<span class="mtphr-dnt-rss-before">'.sanitize_text_field($_mtphr_dnt_rss_author_before).'</span> ' : '';
								$after = ( $_mtphr_dnt_rss_author_after != '' ) ? ' <span class="mtphr-dnt-rss-after">'.sanitize_text_field($_mtphr_dnt_rss_author_after).'</span>' : '';
								$author = $before.$item->get_author()->get_name().$after;
								$author = apply_filters( 'mtphr_dnt_rss_author', $author, $before, $after, $meta_data );
								$tick .= '<small class="mtphr-dnt-rss-author">'.$author.'</small>';
							}
							break;
						case 'excerpt':
							if( isset($_mtphr_dnt_rss_excerpt) && $_mtphr_dnt_rss_excerpt ) {
								$excerpt = $item->get_description();
								if( $_mtphr_dnt_rss_excerpt_length != 0 && $_mtphr_dnt_rss_excerpt_length != -1 ) {
									$excerpt = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $excerpt, ENT_QUOTES, get_option('blog_charset') ) ) ) );
									$excerpt = wp_html_excerpt( $excerpt, intval($_mtphr_dnt_rss_excerpt_length) );
									$excerpt = esc_html( $excerpt );

									// Check for excerpt more
									$more = ( isset($_mtphr_dnt_rss_excerpt_more) ) ? sanitize_text_field($_mtphr_dnt_rss_excerpt_more) : '&hellip;';
									$links = array();
									preg_match('/{(.*?)\}/s', $more, $links);
									if( isset($links[0]) ) {
										$more_link = '<a href="'.$item->get_permalink().'"'.$target.'>'.$links[1].'</a>';
										$more = preg_replace('/{(.*?)\}/s', $more_link, $more);
									}
									$excerpt .= '<span class="mtphr-dnt-rss-more">'.$more.'</span>';
								}
								$excerpt = apply_filters( 'mtphr_dnt_rss_excerpt', $excerpt, $meta_data );
								$tick .= '<p class="mtphr-dnt-rss-excerpt">'.$excerpt.'</p>';
							}
							break;
					}
				}

				$tick = apply_filters( 'mtphr_dnt_rss_tick', $tick, get_the_id(), $meta_data );
				$new_ticks[] = $tick;
			}
		}

		// Return the new ticks
		return $new_ticks;
	}

	return $ticks;
}
add_filter( 'mtphr_dnt_tick_array', 'mtphr_dnt_rss_ticks', 10, 3 );



/* --------------------------------------------------------- */
/* !Set the localization path - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_rss_localization() {
  load_plugin_textdomain( 'ditty-rss-ticker', false, 'ditty-rss-ticker/languages/' );
}
add_action( 'plugins_loaded', 'mtphr_dnt_rss_localization' );



