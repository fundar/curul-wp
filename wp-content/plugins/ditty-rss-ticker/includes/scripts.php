<?php

/* --------------------------------------------------------- */
/* !Load the front-end scripts - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_rss_scripts() {
	wp_register_style( 'ditty-rss-ticker', MTPHR_DNT_RSS_URL.'/assets/css/style.css', false, MTPHR_DNT_RSS_VERSION );
	wp_enqueue_style( 'ditty-rss-ticker' );
}
add_action( 'wp_enqueue_scripts', 'mtphr_dnt_rss_scripts' );

