<?php

/* --------------------------------------------------------- */
/* !Setup the settings - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_rss_initialize_settings() {

	$fields = array();
	$fields['cache_time'] = array(
		'title' => __( 'Cache Time', 'ditty-rss-ticker' ),
		'type' => 'number',
		'default' => 60,
		'after' => __( 'Minutes', 'ditty-rss-ticker' ),
		'description' => __( 'Set the amount of time your feeds should stay cached.', 'ditty-rss-ticker' )
	);

	if( false == get_option('mtphr_dnt_rss_settings') ) {
		add_option( 'mtphr_dnt_rss_settings' );
	}

	/* Register the general options */
	add_settings_section(
		'mtphr_dnt_rss_settings_section',				// ID used to identify this section and with which to register options
		'',																			// Title to be displayed on the administration page
		'mtphr_dnt_rss_settings_callback',			// Callback used to render the description of the section
		'mtphr_dnt_rss_settings'								// Page on which to add this section of options
	);

	if( is_array($fields) ) {
		foreach( $fields as $id => $setting ) {
			$setting['option'] = 'mtphr_dnt_rss_settings';
			$setting['option_id'] = $id;
			$setting['id'] = 'mtphr_dnt_rss_settings['.$id.']';
			add_settings_field( $setting['id'], $setting['title'], 'mtphr_dnt_settings_callback', 'mtphr_dnt_rss_settings', 'mtphr_dnt_rss_settings_section', $setting);
		}
	}
	register_setting( 'mtphr_dnt_rss_settings', 'mtphr_dnt_rss_settings' );
}
add_action( 'admin_init', 'mtphr_dnt_rss_initialize_settings' );



/* --------------------------------------------------------- */
/* !RSS settings callback - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_rss_settings_callback() {
}

