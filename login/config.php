<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();


define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', 'Um8UJjfJEy1CFayg2ZBM');
define('DB_DATABASE', 'login_system');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}

/* * ***** facebook related activities start ** */
require 'facebook_library/facebook.php';

define("APP_ID", "1559322730972585");
define("APP_SECRET", "7686064e428b7f94140d25816af3cd8c");
/* make sure the url end with a trailing slash */
define("SITE_URL", "http://curul501.org/login/");
/* the page where you will be redirected after login */
define("REDIRECT_URL", SITE_URL."facebook_login.php");
/* Email permission for fetching emails. */
define("PERMISSIONS", "email");


/*  If database connection is OK, then proceed with facebook * */
// create a facebook object
$facebook = new Facebook(array('appId' => APP_ID, 'secret' => APP_SECRET));
$userID = $facebook->getUser();

// Login or logout url will be needed depending on current user login state.
if ($userID) {
  $logoutURL = $facebook->getLogoutUrl(array('next' => SITE_URL . 'logout.php'));
} else {
  $loginURL = $facebook->getLoginUrl(array('scope' => PERMISSIONS, 'redirect_uri' => REDIRECT_URL));
}




//agregando twitter
define("CLIENT_ID", "X8EMJCMSLynZVnOEsDkFbmvxw");
define("SECRET_KEY", "jQNQYAcDcE5tc9z7QdWtS9yEv8oWDgrXc0o6MJhvZyHttWpTNv");
/* make sure the url end with a trailing slash, give your site URL */
/* the page where you will be redirected for authorization */
define("REDIRECT_URLtwitter", SITE_URL."twitter_login.php");



?>