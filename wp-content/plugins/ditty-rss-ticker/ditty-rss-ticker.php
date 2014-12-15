<?php
/*
Plugin Name: Ditty RSS Ticker (shared on wplocker.com)
Plugin URI: http://dittynewsticker.com/ditty-rss-ticker/
Description: Add an RSS ticker type to your <a href="http://wordpress.org/extend/plugins/ditty-news-ticker/">Ditty News Tickers</a>
Version: 1.0.3
Author: Metaphor Creations
Author URI: http://www.metaphorcreations.com
License: GPL2
*/

/*
Copyright 2012 Metaphor Creations  (email : joe@metaphorcreations.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



/* --------------------------------------------------------- */
/* !Define constants - 1.0.3 */
/* --------------------------------------------------------- */

if ( WP_DEBUG ) {
	define ( 'MTPHR_DNT_RSS_VERSION', '1.0.3-'.time() );
} else {
	define ( 'MTPHR_DNT_RSS_VERSION', '1.0.3' );
}
define ( 'MTPHR_DNT_RSS_DIR', plugin_dir_path(__FILE__) );
define ( 'MTPHR_DNT_RSS_URL', plugins_url().'/ditty-rss-ticker' );



/* --------------------------------------------------------- */
/* !Include files - 1.0.2 */
/* --------------------------------------------------------- */

if( is_admin() ) {
	if( function_exists('mtphr_dnt_metaboxer_container') ) {
		require_once( MTPHR_DNT_RSS_DIR.'includes/meta-boxes.php' );
	}
	require_once( MTPHR_DNT_RSS_DIR.'includes/activate.php' );
	require_once( MTPHR_DNT_RSS_DIR.'includes/settings.php' );
}

// Load the general functions
require_once( MTPHR_DNT_RSS_DIR.'includes/update.php' );
require_once( MTPHR_DNT_RSS_DIR.'includes/scripts.php' );
require_once( MTPHR_DNT_RSS_DIR.'includes/functions.php' );

