<?php

require_once './config.php';
if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
  // user already logged in the site
  header("location:".SITE_URL . "home.php");
}
include './header.php';
?>
<div class="container">
  <div class="margin10"></div>
  <div class="col-sm-3 col-sm-offset-4">
    <a class="btn btn-block btn-social btn-facebook" href="<?php echo $loginURL; ?>">
      <i class="fa fa-facebook"></i> Login con el facebook
    </a>
  </div>
  
   <div class="col-sm-3 col-sm-offset-4">
    <a class="btn btn-block btn-social btn-twitter" href="twitter_login.php">
            <i class="fa fa-twitter"></i> Login with twitter
          </a>
  </div>
</div>