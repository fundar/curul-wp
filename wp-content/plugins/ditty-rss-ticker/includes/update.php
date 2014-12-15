<?php

/* --------------------------------------------------------- */
/* !Auto updater script - 1.0.2 */
/* --------------------------------------------------------- */

require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = new PluginUpdateChecker(
	'http://www.metaphorcreations.com/envato/plugins/ditty-rss-ticker/auto-update.json',
	'ditty-rss-ticker/ditty-rss-ticker.php',
	'ditty-rss-ticker'
);
//$MyUpdateChecker->checkForUpdates();