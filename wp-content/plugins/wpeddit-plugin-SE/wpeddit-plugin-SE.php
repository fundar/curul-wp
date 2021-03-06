<?php
/*
Plugin Name: WPeddit: Standalone Edition
Plugin URI: http://reddit.epicplugins.com/
Description: Turn your WordPress website into a powerful post rating site.
Version: 1.6
Author: MYO
Author URI: http://www.epicplugins.com/
*/

    #} Hooks
   
    #} Install/uninstall
    register_activation_hook(__FILE__,'epicred__install');
    register_deactivation_hook(__FILE__,'epicred__uninstall');
    
    #} general
    add_action('init', 'epicred__init');
    add_action('admin_menu', 'epicred__admin_menu'); #} Initialise Admin menu
    
    

	#} Initial Vars
	global $epicred_db_version;
	$epicred_db_version             	   = "1.0";
	$epicred_version           		       = "2.5";
	$epicred_activation                    = '';


	#} Urls
    global $epicred_urls;
    $epicred_urls['home']   	   	 = 'http://wpeddit.com/';
    $epicred_urls['docs']     		 = plugins_url('/documentation/index.html',__FILE__);
	$epicred_urls['forum']      	 = 'http://forums.epicplugins.com/';
    $epicred_urls['updateCheck']	 = 'http://www.epicplugins.com/api/';
	$epicred_urls['regCheck']		 = 'http://www.epicplugins.com/registration/';
	$epicred_urls['subscribe'] 		 = "http://eepurl.com/tW_t9";
	
	#} Page slugs
    global $epicred_slugs;
    $epicred_slugs['config']           = "epicred-plugin-config";
    $epicred_slugs['settings']         = "epicred-plugin-settings";

	#} Install function
	function epicred__install(){

    #} Default Options

    add_option('epicred_ip','yes','','yes');

	epicred_install();
	add_option('wpedditshared','no','','yes'); 
		
	$current_user = wp_get_current_user();    //email the current user rather than admin info more likely to reach a human email 
	$userEmail = $current_user->user_email;
	$userName =  $current_user->user_firstname;
	$LastName =  $current_user->user_lastname;
	$plugin = 'WPeddit';
			
	if(get_option('wpedditshared') == 'no'){    //only send them an install email once
			wpeddit_sendReg($userEmail,$userName,$plugin);
		    update_option('wpedditshared','yes'); 
	}  
	
	
 
	}
	
	
	global $epicred_db_version;
	$epicred_db_version = "1.0";

   function epicred_install() {
   global $wpdb;
   global $epicred_db_version;

   $table_name = $wpdb->prefix . "epicred";
      
   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  epicred_id mediumint(9) NOT NULL,
	  epicred_option mediumint(9) NOT NULL,
	  epicred_ip text NOT NULL,
	  UNIQUE KEY id (id)
	    );";

	   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	   dbDelta($sql);
	 
      $table_name = $wpdb->prefix . "epicred_comment";
      
   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	  epicred_id mediumint(9) NOT NULL,
	  epicred_option mediumint(9) NOT NULL,
	  epicred_ip text NOT NULL,
	  UNIQUE KEY id (id)
	    );";

	   dbDelta($sql);
	 
	   add_option("epicred_db_version", $epicred_db_version);
	   


    }


#} Initialisation - enqueueing scripts/styles
function epicred__init(){
  
    global $epicred_slugs, $epicred_taxonomy; #} Req
    
    #} Admin & Public
    wp_enqueue_script("jquery");
    wp_enqueue_script( 'jquery-form',array('jquery')); 
    wp_enqueue_style('colorbox-css', plugins_url('/css/colorbox.css',__FILE__) );
    wp_enqueue_script('colorbox',plugins_url('/js/jquery.colorbox-min.js',__FILE__),array('jquery'));
    wp_enqueue_script('epicred-ajax',plugins_url('/js/epicred.js',__FILE__),array('jquery'));
    wp_localize_script( 'epicred-ajax', 'EpicAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	
	if(!is_admin()){
    wp_enqueue_style('epicred-css', plugins_url('/css/epicred.css',__FILE__) );
	}
    
    #} Admin only
    if (is_admin()) {
    wp_enqueue_style('myo-polling-admin-css', plugins_url('/css/epicadmin.css',__FILE__) );
    }


}

#} Add le admin menu
function epicred__admin_menu() {

    global $epicred_slugs,$epicred_menu; #} Req
    
    $epicred_menu = add_menu_page( 'wpeddit menu', 'WPeddit', 'manage_options', $epicred_slugs['config'], 'epicred_menu', plugins_url('i/wpedditicon.png',__FILE__));
     add_submenu_page( $epicred_slugs['config'], 'Settings', 'Settings', 'manage_options', $epicred_slugs['settings'] , 'epicred_pages_settings' );
	 
}


#}Settings
function epicred_pages_settings() {
    
    global $wpdb;    #} Req
    
    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    
    
?><div id="sgpBod">
          <div class='myslogo'><?php echo '<img src="' .plugins_url( 'i/logo.png' , __FILE__ ). '" > ';   ?></div>
        <div class='mysearch'>
        	
        <?php epicred_header(); ?>
            
                
         <?php
         	if(isset($_GET['save'])){ 
             if ($_GET['save'] == "1"){
                epicred_html_save_settings();
             }
		    }
            if(!isset($_GET['save'])){
                epicred_html_settings();
            }
    ?></div>
</div>
<?php
}



function epicred_html_settings(){
        
    global $wpdb, $epicred_slugs;  #} Req
    
    $myoConfig = array();
    $myoConfig['trans_id'] 		   =           get_option('epicred_trans_id');    
    $myoConfig['epicred_ip']   	   =           get_option('epicred_ip');    
	$myoConfig['pending']		   =		   get_option('wpedditnewpost')


    
    ?>
    

     <form action="?page=<?php echo $epicred_slugs['settings']; ?>&save=1" method="post">
     <div class="postbox">
     <h3><label>General settings</label></h3>
     
     <table class="form-table" width="100%" border="0" cellspacing="0" cellpadding="6">
         
        <tr valign="top">
            <td width="25%" align="left"><strong>item purchase code:</strong></td>
            <td align="left"><input id=pstrans_id name=epicred_trans_id type="text" placeholder="item purchase code" size="20" value = '<?php echo $myoConfig['trans_id']; ?>' /><br><i>This is the purchase code contained in your License Certificate on CodeCanyon</i></td>
        </tr>

        <tr valign="top">
                        <td width="25%" align="left"><strong>Lock votes by IP or Member:</strong></td>
                        <?php if($myoConfig['epicred_ip'] == 'yes'){ ?>
                        <td align="left">
                            <input type="radio" name="epicred_ip" value="yes" checked> IP
                            <input type="radio" name="epicred_ip" value="no"> Member
                            <br><i>Restrict the votes to one per IP address or one vote per member?</i>
                        </td>
                        <?php }else{ ?>
                         <td align="left">
                            <input type="radio" name="epicred_ip" value="yes"> IP
                            <input type="radio" name="epicred_ip" value="no" checked> Member
                            <br><i>Restrict the votes to one per IP address or one vote per member?</i>
                        </td>
                        <?php } ?>
         </tr>
         
      
    </table>
    <p id="footerSub"><input class = "button-primary" type="submit" value="Save settings" /></p>
    </form>
</div>

<?php }





#} Save options changes
function epicred_html_save_settings(){
    
    global $wpdb;  #} Req
    
    $myoConfig = array();
    $myoConfig['epicred_ip'] 		=       $_POST['epicred_ip'];
    $myoConfig['trans_id'] 			=       $_POST['epicred_trans_id'];
 

    
    #} Save down
    update_option("epicred_ip", $myoConfig['epicred_ip']);
    update_option("epicred_trans_id", $myoConfig['trans_id']);



    #} Msg
    epicred_html_msg(0,"Saved options");
    
    #} Run standard
    epicred_html_settings();
    
}






function epicred_checkForMessages(){
    
    global $epicred_urls;

    # First deal with legit purchases
    if (isset($_GET['legit'])){
        
        # Update
        update_option('epicred_myo_firstLoadMsg',1);
        
        #} Set this here
        $flFlag = 1;
        
    } else $flFlag = get_option('epicred_myo_firstLoadMsg');
    
    
    
    if (empty($flFlag)) {
        
        epicred_html_msg(2,'<div class="sgThanks">
            <h3>Thank you for installing WPeddit</h3>
            <p>This license entitles you to use the WPeddit on a single WordPress install.</br>
            </p>
                        
            <p>Its Easy to get started, you can work it out for yourself below or read the <a href="'.$epicred_urls['docs'].'" target="_blank">WPeddit Support Manual</a>.<br />To keep up to date with WPeddit follow us on <a href="http://codecanyon.net/user/mikemayhem3030/follow/" target="_blank">CodeCanyon</a></p>
        
            <div class="sgButtons">
                <a class="buttonG" href="?page=epicred-plugin-config&legit=true">I have a License</a>
                <a class="buttonBad" href="http://codecanyon.net/item/pics-mash-image-rating-tool/3256459">I need a License</a>
            </div>
                    
            <div class="clear"></div>
        </div>');
        
    }
    
}

#} Options page
function epicred_menu() {
    
    global $wpdb, $epicred_urls, $epicred_version,$epicred_slugs;    #} Req
    // add database pointer
    
    if (!current_user_can('manage_options'))  {
        wp_die( __('You do not have sufficient permissions to access this page.') );
    }
    ?>
    <div id="sgpBod">
       <div class='myslogo'><?php echo '<img src="' .plugins_url( 'i/logo.png' , __FILE__ ). '" > ';   ?></div>
        <div class='mysearch'>
            
            <?php epicred_header(); ?>
            
            <?php epicred_checkForMessages(); ?>

               <div class="postbox-container" id="main-container" style="width:75%;">
            <div class="postbox">
           <h3 style="text-align:center"><label>Welcome to WPeddit</label></h3>
                <div class="inside">
                    <p style="text-align:center"><strong>Welcome to WPeddit</strong>: the Ultimate WordPress Post Ranking Plugin If you want to vote on future features or discover more cool plugins, check out the <br/><a href="http://epicplugins.com" target="_blank">epic plugins site</a>!</p>
                    <div id="SocialGalleryOptions">
                        <div><a href="admin.php?page=<?php echo $epicred_slugs['settings']; ?>" class="SocialGalleryOB">Settings</a></div>
                        <div><a href="edit.php?post_type=iniciativa" class="SocialGalleryOB">Check out rankings</a></div>
                        <div><a href="<?php echo $epicred_urls['home']; ?>" class="SocialGalleryOB">Demo Site</a></div>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div>
           
            
            <div class="postbox">
                <h3 style="padding:8px;"><label><?php _e('Epic News'); ?></label></h3>
                <div class="inside">
                	<?php wpeddit_retrieveNews(); ?>
                </div>
            </div>  
   </div>

    <div class="postbox-container" id="side-container" style="width:24%;margin-left:1%">
            <div class="postbox">
                <h3 style="padding:8px;"><label><?php _e('Share the love'); ?></label></h3>
                <div class="inside">
                	<p>This plugin has been developed with love & effort, it's a work in progress and I really appreciate all of the contribution you guys make to it. Thank you!</p>
                	
                    <!-- <a href="codecanyon.net/item/social-gallery-wordpress-photo-viewer-plugin/2665332?ref=stormgate" target="_blank">Rate it 5 stars on Code Canyon</a><br /> -->
                  
                    <div  style="text-align:center;margin-top:12px"><strong>Share WPeddit:</strong></div>
                    <div class="socialGalleryShareBox">
	                    <a href="http://www.facebook.com/sharer.php?s= 100&amp;p[title]= WPeddit - The Ultimate WordPress Post Rating Plugin and Theem&amp;p[url]=http://reddit.epicplugins.com/&amp;p[summary]=Let your visitors vote up your posts. A Must Have plugin for all WordPress users."target="_blank"><img src="<?php echo plugins_url('/i/fbshare.png',__FILE__); ?>" alt="" title="Share on Facebook" /></a>
	        	     	<a href="http://twitter.com/home?status=I Recommend You WPeddit for WordPress!! http://reddit.epicplugins.com/" target="_blank"><img src="<?php echo plugins_url('/i/tweet.png',__FILE__); ?>" alt="" title="Share this on Twitter" /></a>
					 	<a href="http://www.linkedin.com/shareArticle?mini=true&url=http://reddit.epicplugins.com/&title=WPeddit for WordPress&source=PicsMash" target="_blank"><img src="<?php echo plugins_url('/i/linkedin.png',__FILE__); ?>" alt="" title="Share this on LinkedIn" /></a>
						<a href="https://plus.google.com/share?url=http://reddit.epicplugins.com/" target="_blank"><img src="<?php echo plugins_url('/i/gp.png',__FILE__); ?>" alt="" title="Share this on Google+1" /></a>
         			</div>
                </div>
            </div>
   </div>

   <div class="postbox-container" id="side-container" style="width:24%;margin-left:1%">
            <div class="postbox">
                <h3 style="padding:8px;"><label><?php _e('Other Plugins'); ?></label></h3>
                <div class="inside">
					<table>
						<tr>
							<td><a href = "http://codecanyon.net/item/wordpress-social-polling-plugin/3750798?ref=mikemayhem3030" target = "_blank"><img src = "http://0.s3.envato.com/files/47574285/WP-SocialPolling-Thumb.jpg"/></a></td>
							<td style = "padding:3px"><a href = "http://codecanyon.net/item/wordpress-social-polling-plugin/3750798?ref=mikemayhem3030?ref=mikemayhem3030" target = "blank">Social Polling Plugin</a> is the future of website polling. Once someone votes on a poll it posts out to the voters news feed to help bring in more voters!
								</td>
						</tr>
												<tr>
							<td><a href = "http://codecanyon.net/item/dilemma-wordpress-plugin/3377683?ref=mikemayhem3030" target = "_blank"><img src = "http://2.s3.envato.com/files/47583855/Dilemma-Thumb-1.jpg"/></a></td>
							<td style = "padding:3px"><a href = "http://codecanyon.net/item/dilemma-wordpress-plugin/3377683?ref=mikemayhem3030?ref=mikemayhem3030" target = "blank">Dilemma!</a> the Ultimate Yes/No Plugin for WordPress. Ask your visitors engaging Dilemmas!
								</td>
						</tr>
					</table>
                </div>
            </div>
	 
	 <div style = 'clear:both'></div>
	 
	 </div>            

     </div>


</div>
<?php
}

#} Retrieves updated news.
function wpeddit_retrieveNews(){

				global $tweety_urls;
                include_once(ABSPATH . WPINC . '/feed.php');
                add_filter( 'wp_feed_cache_transient_lifetime' , 'wpeddit_feed_cache' );
				$url = 'http://epicplugins.com/feed/';
                $rss = fetch_feed($url);
                remove_filter( 'wp_feed_cache_transient_lifetime' , 'wpeddit_feed_cache' );
                
                if (!is_wp_error( $rss ) ) {
					
					$maxitems = $rss->get_item_quantity(5); 
                    $rss_items = $rss->get_items(0, $maxitems); 
					
				} ?>
                
                <ul>
                    <?php 
					if ($maxitems == 0) 
						echo '<li>No News (is this good news?)</li>';
                    else 
						foreach ( $rss_items as $item ) : ?>
                    <li>
                        <a href='<?php echo esc_url( $item->get_permalink() ); ?>' target = '_blank'
                        title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
                        <?php echo  $item->get_title() ; ?></a><br/>
                        <?php echo  $item->get_description() ; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                
                <?php
	
}

function wpeddit_feed_cache( $seconds )
			{
			  // change the default feed cache recreation period to 2 hours
			  return 7200;
			}



add_action( 'wp_ajax_nopriv_epicred_vote', 'epicred_vote' );
add_action( 'wp_ajax_epicred_vote', 'epicred_vote' );

function epicred_vote(){
	global $wpdb, $current_user;
	
    get_currentuserinfo();
	
	$wpdb->myo_ip  = $wpdb->prefix . 'epicred';
		
    $option = (int)$_POST['option'];
	$current = (int)$_POST['current'];
    $fid = "";
	
	//if we are locked via IP set the fid variable to be the IP address, otherwise log the member ID
    if( $current_user->ID ){
		$fid = $current_user->ID;
    }elseif(get_option('epicred_ip') == 'yes'){
        $ipAddr = isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) ? $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
        $fid =  "'" . $ipAddr . "'" ; 
    }else{
        $ipAddr = isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) ? $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
        $fid =  "'" . $ipAddr . "'" ; 
    }

	$postid = (int)$_POST['poll'];	

    $query = "SELECT epicred_option FROM $wpdb->myo_ip WHERE epicred_ip = $fid AND epicred_id = $postid";
    
    $al = $wpdb->get_var($query);
    $test = ""; $location = '';

    //function guardar_participacion($previous_vote = NULL ){
        /* Modificacion para guardar el conteo del total de participaciones en los posts de tipo iniciativas */
    $total = intval( get_post_meta($postid, 'wp_total_participaciones', true) );
    $fav = get_post_meta($postid, 'wp_total_a_favor', true);
    $con = get_post_meta($postid, 'wp_total_en_contra', true);
    $vote = intval( get_post_meta($postid,'epicredvote',true) );

    if( empty($al) ) {
        /* Definir total de votos*/
        if( empty( $total ) ) add_post_meta($postid, 'wp_total_participaciones', 1, true ); 
        else update_post_meta ($postid, 'wp_total_participaciones', $total + 1);

        $test = "creando";
        if($option == 1){
            if( $fav && $fav == 0 ) update_post_meta($postid, 'wp_total_a_favor', 1 ); 
            else if( $fav && $fav > 0 ) update_post_meta($postid, 'wp_total_a_favor', $fav + 1 );
            else{
                add_post_meta($postid, 'wp_total_a_favor', 1, true ); 
                update_post_meta($postid, 'wp_total_a_favor', 1 ); 
            }

        }else if($option == -1){            
            if( $con && $con == 0 ) update_post_meta($postid, 'wp_total_en_contra', 1); 
            else if( $con && $con > 0 ) update_post_meta($postid, 'wp_total_en_contra', $con + 1 );
            else{
                add_post_meta($postid, 'wp_total_en_contra', 1, true ); 
                update_post_meta($postid, 'wp_total_en_contra', 1 ); 
            } 
        }

        // crear voto del usuario en la BD
        $query = "INSERT INTO $wpdb->myo_ip ( epicred_id , epicred_ip, epicred_option) VALUES ( $postid, $fid, $option)";
        $wpdb->query($query);
    }else{
        $previous_vote = intval($al);
        if($option == 1 && $al == -1){
            $test = "actualizando de negativo a positivo";
            // actualizar el voto del usuario
            $query = "UPDATE $wpdb->myo_ip SET epicred_option = $option WHERE epicred_id = $postid AND epicred_ip = $fid";
            $wpdb->query($query);
            
            if( $fav && $fav == 0 ) update_post_meta($postid, 'wp_total_a_favor', 1 ); 
            else if( $fav && $fav > 0 ) update_post_meta($postid, 'wp_total_a_favor', $fav + 1 );
            else{
                add_post_meta($postid, 'wp_total_a_favor', 1, true ); 
                update_post_meta($postid, 'wp_total_a_favor', 1 ); 
            }
            // dado que ya existia un voto de este usuario se elimina, de existir, el voto opuesto
            if( $con && $con > 0) update_post_meta ($postid, 'wp_total_en_contra', $con - 1 );
        
        }else if($option == -1 && $al == 1){
            $test = "actualizando de positivo a negativo";

            // actualizar el voto del usuario
            $query = "UPDATE $wpdb->myo_ip SET epicred_option = $option WHERE epicred_id = $postid AND epicred_ip = $fid";
            $wpdb->query($query);

            if( $con && $con == 0 ) update_post_meta($postid, 'wp_total_en_contra', 1); 
            else if( $con && $con > 0 ) update_post_meta($postid, 'wp_total_en_contra', $con + 1 );
            else{
                add_post_meta($postid, 'wp_total_en_contra', 1, true ); 
                update_post_meta($postid, 'wp_total_en_contra', 1 ); 
            }

            // dado que ya existia un voto de este usuario se elimina, de existir, el voto opuesto
            if( $fav && $fav > 0 ) update_post_meta ($postid, 'wp_total_a_favor', $fav - 1 );
        }

    }
 
    if($option == 1 && $al != 1){
        if($al == -1) $vote = $vote+2;    
        else $vote = $vote + 1;
    }
    
    if($option == -1){
        if($al == 1) $vote = $vote-2;
        else $vote = $vote-1;
    }

	update_post_meta($postid,'epicredvote',$vote);

	$response['poll'] = $postid;
    $response['vote'] = $vote;
    $response['test'] = $test;
    $response['fid'] = $fid;
    /* Agregar los datos a favor y en contra totales*/
    $response['favor'] =  intval( get_post_meta($postid, 'wp_total_a_favor', true) );
    $response['contra'] = intval( get_post_meta($postid, 'wp_total_en_contra', true) );
	$response['total'] = intval( get_post_meta($postid, 'wp_total_participaciones', true) );
    
    echo json_encode($response);
  
	// IMPORTANT: don't forget to "exit"
	exit;
}


  




function epicred_header(){

    global $epicred_urls;
    ?>
     
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=438275232886336";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <?php
    //build the twitter text tweet
        $URL = $epicred_urls['home'];
        $siteURL = get_site_url();
        $PicsM = "http://epicplugins.com/";
        $text = "I love " . $PicsM;
        $hash = "#epicred";
        $QP = "?url=".$URL."&text=".$text."&hashtags=".$hash;
    ?>
    
	
	
    <?php

        $img = "";
        echo "<a href='http://pinterest.com/pin/create/button/?url=$URL&media=$img&description=Description' class='pin-it-button' count-layout='horizontal'><img border'0' src='//assets.pinterest.com/images/PinExt.png' title='Pin It' /></a>";
    ?>

    <div class="fb-like" data-href="http://epicplugins.com/" data-send="true" data-width="360" data-show-faces="false" data-font="arial"></div>

    <?php
	$home = $epicred_urls['home'];
	$docs = $epicred_urls['docs'];
	$forum =$epicred_urls['forum'];
	$subs = $epicred_urls['subscribe'];
        echo "<div id = 'ps-links' style = 'padding-top:1%;padding-bottom:1%'><ul style = 'display:inline'>
        <li style = 'display:inline;padding-right:1%'><a href = '$home'>Demo Site</a></li>
        <li style = 'display:inline;padding-right:1%'><a href = '$docs'>Documentation</a></li>
        <li style = 'display:inline;padding-right:1%'><a href = '$forum'>Support Forum</a></li>
        <li style = 'display:inline;padding-right:1%'><a href = '$subs'>Subscribe to the EPIC mailing list</a></li>
        <li style = 'display:inline;padding-right:1%'><a href='mailto:mikemayhem3030@gmail.com?Subject=Hi%20Mike You Rock!'>Contact the developer</a></li>
        </ul></div>";

}


#} Outputs HTML message
function epicred_html_msg($flag,$msg,$includeExclaim=false){
    
    if ($includeExclaim){ $msg = '<div id="sgExclaim">!</div>'.$msg.''; }
    
    if ($flag == -1){
        echo '<div class="sgfail wrap">'.$msg.'</div>';
    }
    if ($flag == 0){ ?>
        <div id="message" class="updated fade below-h2"><p><strong>Settings saved!</strong></p></div>
    <?php }
    if ($flag == 1){
        echo '<div class="sgwarn wrap">'.$msg.'</div>';
    }
    if ($flag == 2){
        echo '<div class="sginfo wrap">'.$msg.'</div>';
    }
    if ($flag == 666){ ?>
        <div id="message" class="updated fade below-h2"><p><strong><?php echo $msg; ?>!</strong></p></div>
    <?php }
}




//new code for autoupdating and regCheck
#} Send registration info to my server
function wpeddit_sendReg($e='',$na='',$pl=''){

			global $epicred_urls;	
			if( function_exists('curl_init') ) { 
					$postData = array('ori'=>get_site_url());
					$postData['e'] = $e; //email
					$postData['na'] = $na;  //name
					$postData['pl'] = $pl;  //plugin

					
					$fields = ''; foreach($postData as $key => $value) $fields .= $key . '=' . $value . '&'; rtrim($fields, '&');
					$ch = curl_init($epicred_urls['regCheck']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_POST, count($postData));
					curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					$regDets = curl_exec($ch);
					
					curl_close($ch);
					return $regDets;
			} # else, cry?			
			return  $false;
}


//code for the warnings and auto updating
global $epicred_urls;
$api_url = $epicred_urls['updateCheck'];
$plugin_slug = basename(dirname(__FILE__));


// Take over the update check
add_filter('pre_set_site_transient_update_plugins', 'wpeddit_check_for_plugin_update');

function wpeddit_check_for_plugin_update($checked_data) {
	global $api_url, $plugin_slug;

	//Comment out these two lines during testing.
	if (empty($checked_data->checked))
		return $checked_data;

	$args = array(
		'slug' => $plugin_slug,
		'version' => $checked_data->checked[$plugin_slug .'/'. $plugin_slug .'.php'],
	);
	$request_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);

	// Start checking for an update
	$raw_response = wp_remote_post($api_url, $request_string);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);

	if (is_object($response) && !empty($response)) // Feed the update data into WP updater
		$checked_data->response[$plugin_slug .'/'. $plugin_slug .'.php'] = $response;

	return $checked_data;
}



add_filter('plugins_api', 'wpeddit_plugin_api_call', 10, 3);

function  wpeddit_plugin_api_call($def, $action, $args) {
	global $plugin_slug, $api_url;

	if ($args->slug != $plugin_slug)
		return false;

	// Get the current version
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[$plugin_slug .'/'. $plugin_slug .'.php'];
	$args->version = $current_version;

	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);

	$request = wp_remote_post($api_url, $request_string);

	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);

		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
	}

	return $res;
}

function wpeddit_hot($posts){
	global $wp, $wp_query,$post,$wpdb, $current_user,$query_string;
	wp_reset_query();
	
    $args = array(
        'meta_key' => 'epicredrank',
        'orderby' => 'meta_value_num',
        'post_type' => 'iniciativa',
        'order' => 'DESC',
        'posts_per_page' => $posts
    );
	
	query_posts($args);
	
	if ( have_posts() ) : ?>
 		<ul>	
		<?php while ( have_posts() ) : the_post(); ?> 
			
		<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
		<?php endwhile; ?>
		</ul>
	<?php else: ?> 

	<?php endif; 
}

function wpeddit_hot_comments($posts){
	global $wp, $wp_query,$post,$wpdb, $current_user,$query_string;
    $args = array(
        'meta_key' => 'wpeddit_comment_rank',
        'post_type' => 'iniciativa',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'number' => $posts
    );
	$comments_query = new WP_Comment_Query;
	$comments = $comments_query->query( $args );
	?>
	<ul>
	<?php
	// Comment Loop
	if ( $comments ) {
		foreach ( $comments as $comment ) {
			$ID = $comment->comment_post_ID;
			$permalink = get_comment_link( $comment );	
		?>
			<li><?php echo comment_excerpt($comment->comment_ID); ?> on <a href="<?php echo $permalink; ?>" title=" <?php echo get_the_title($ID); ?>"><?php echo get_the_title($ID); ?></a></li>
	<?php	} ?>
	</ul>
	<?php
	} else {
		echo 'No comments found.';
	}
}



add_filter( 'the_content', 'wpeddit_content_filter', 20 );
function wpeddit_content_filter( $content ) {
    
    if( is_singular('iniciativa') || is_post_type('iniciativa') || 
        is_post_type('modificacion') ||  is_post_type('preocupacion') ) {
		$newcontent = epic_reddit_voting();
    	$content = $newcontent . $content;
	}elseif(is_front_page() || is_home()) { 
		$newcontent = epic_reddit_voting();
    	$content = $newcontent . $content; 
	}
	
	
    // Returns the content.
    return $content;
}



function epic_reddit_voting(){
	global $wp_query,$post,$wpdb, $current_user,$query_string;
    get_currentuserinfo();
	$wpdb->myo_ip   = $wpdb->prefix . 'epicred';
			
	$postvote = get_post_meta($post->ID, 'epicredvote' ,true);
			if($postvote == NULL){
				$postvote = 0;
	}
			
			//again if IP locked set the fid variable to be the IP address.
	if(get_option('epicred_ip') == 'yes'){
		$ipAddr = isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) ? $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
		$fid = "'" . $ipAddr . "'";	
	}else{
		$fid = $current_user->ID;
	}
			
			$query = "SELECT epicred_option FROM $wpdb->myo_ip WHERE epicred_ip = $fid AND epicred_id = $post->ID";
			$al = $wpdb->get_var($query);
			if($al == NULL){
				$al = 0;
			}
			if($al == 1){
				$redclassu = 'upmod';
				$redclassd = 'down';
				$redscore = 'likes';
			}elseif($al == -1){
				$redclassd = 'downmod';
				$redclassu = 'up';
				$redscore = "dislikes";
			}else{
				$redclassu = "up";
				$redclassd = "down";
				$redscore = "unvoted";
			}
			
			 ?>
			
			
			<?php wpeddit_post_ranking($post->ID); ?>

			
			<?php if(!is_user_logged_in() && get_option('epicred_ip') == 'no') { ?>
			<div class = 'logged-in-only'>
			
			<?php } ?>
			

			<div class = 'reddit-voting'>
				<ul class="unstyled">
			<?php  if(!is_user_logged_in() && get_option('epicred_ip') == 'no')  { 
                    $fid_ = $current_user->ID;
                    $q = "SELECT epicred_option FROM wp_epicred WHERE epicred_ip = $fid_ AND epicred_id = $post->ID";
                    $al_ = $wpdb->get_var($q);
            ?>
                    <div class="arrow <?php echo $redclassu;?> arrow-up-<?php echo $post->ID;?>" data-red-current = <?php echo $al;?> data-red-like = "up" data-red-id = "<?php echo $post->ID;?>" role="button" aria-label="upvote" tabindex="0"></div>
                    <div class="arrow <?php echo $redclassd;?> arrow-down-<?php echo $post->ID;?>" data-red-current = <?php echo $al;?> data-red-like = "down" data-red-id = "<?php echo $post->ID;?>" role="button" aria-label="upvote" tabindex="0"></div>    
            <?php }else{ 
                    $fid_ = "'" . isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) ? $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'] . "'"; 
                    $q = "SELECT epicred_option FROM wp_epicred WHERE epicred_ip = $fid_ AND epicred_id = $post->ID";
                    $al_ = $wpdb->get_var($q);
            ?>
                    <div class="score score-<?php echo $post->ID;?>-favor"> <?php echo ( is_null($al_) )? intval( get_post_meta($post->ID, 'wp_total_a_favor', true) ) : '0' ; ?> </div>
                    <div class="arrow <?php echo $redclassu;?> arrow-up-<?php echo $post->ID;?>" data-red-current = <?php echo $al;?> data-red-like = "up" data-red-id = "<?php echo $post->ID;?>" role="button" aria-label="upvote" tabindex="0"></div>
                    <div class="arrow <?php echo $redclassd;?> arrow-down-<?php echo $post->ID;?>" data-red-current = <?php echo $al;?> data-red-like = "down" data-red-id = "<?php echo $post->ID;?>" role="button" aria-label="upvote" tabindex="0"></div>    
					<div class="score score-<?php echo $post->ID;?>-contra"> <?php echo ( is_null($al_) )? intval( get_post_meta($post->ID, 'wp_total_en_contra', true) ) : '0' ; ?> </div>
			<?php }  ?>
				</ul>
			</div>	
			<?php  if(!is_user_logged_in() && get_option('epicred_ip') == 'no') { ?>
			</div>
			<?php } 
	
}



function wpeddit_post_ranking($post_id){
	
	$x = get_post_meta($post_id, 'epicredvote', true );
	if($x == ""){
		$x = 0;
	}
	
	$ts = get_the_time("U",$post_id);
	
	if($x > 0){
		$y = 1;
	}elseif($x<0){
		$y = -1;
	}else{
		$y = 0;
	}
	
	$absx = abs($x);
	if($absx >= 1){
		$z = $absx;
	}else{
		$z = 1;
	}
	
	
	$rating = log10($z) + (($y * $ts)/45000);
	
	update_post_meta($post_id,'epicredrank',$rating);
	
	return $rating;
	
}




add_filter( 'manage_edit-post_columns', 'wpeddit_post_columns' ) ;

function wpeddit_post_columns( $columns ) {

    $new_columns = array(

		'rating' => __('Ranking', 'WPeddit'),

    );
	
	return array_merge($columns, $new_columns);

}

add_action( 'manage_post_posts_custom_column', 'wpeddit_post_columnsw', 10, 2 );

function wpeddit_post_columnsw( $column, $post_id ) {
    global $post;

    switch( $column ) {
        
        
        case 'rating' :

            /* Get the post meta. */
            echo number_format((double)get_post_meta( $post_id, 'epicredvote', true ),0);

            break;

        /* Just break out of the switch statement for everything else. */
default:
            break;
    }
}

add_filter( 'manage_edit-post_sortable_columns', 'wpeddit_sortable_columns' );

function wpeddit_sortable_columns( $columns ) {

    $columns['rating'] = 'rating';   
    return $columns;
}


/* Only run our customization on the 'edit.php' page in the admin. */
add_action( 'load-edit.php', 'wpeddit_post_load' );

function wpeddit_post_load() {
    add_filter( 'request', 'wpeddit_sort_post' );
}

/* Sorts the pics. */
function wpeddit_sort_post( $vars ) {

    if ( isset( $vars['post_type'] ) && 'iniciativa' == $vars['post_type'] ) {

        /* Check if 'orderby' is set to 'rating'. */
        if ( isset( $vars['orderby'] ) && 'rating' == $vars['orderby'] ) {

            /* Merge the query vars with our custom variables. */
            $vars = array_merge(
                $vars,
                array(
                    'meta_key' => 'epicredvote',
                    'orderby' => 'meta_value_num'
                )
            );
        }
        

    }

    return $vars;
}

#} Widgets
class weddit_hot_widget extends WP_Widget {
    function weddit_hot_widget() {
        parent::WP_Widget(false, $name = 'Hot Posts', array(
            'description' => 'WPeddit Widget: Show your sites hottest posts'
        ));
    }
    function widget($args, $instance) {
    	 global $wp_query,$paged,$post,$wp,$wpdb;
	
        extract($args);$mode = (is_numeric($instance['mode']) ? (int)$instance['mode'] : 5);if (!empty($instance['target'])) $targetStr = ' target="'.$instance['target'].'"'; else $targetStr = '';
		if (!empty($instance['title'])) $title = $instance['title']; else $title = '';		
		if (!empty($instance['item'])) $item = $instance['item']; else $item = '';		
		
		$title = apply_filters( 'widget_title', $instance['title'] );
	    
		echo $before_widget;
		
		echo "<h3 class = 'widget-title'>" . $title . "</h4>";
		
		wpeddit_hot($mode);		

		echo $after_widget;
		
    }
    function update($new_instance, $old_instance) {
        return $new_instance;
    }
	function form($instance) {
        if (isset($instance['mode'])) $mode = esc_attr($instance['mode']); else $mode = 1;
        if (isset($instance['target'])) $target = esc_attr($instance['target']); else $target = '';
        if (isset($instance['buttontext'])) $buttontext = esc_attr($instance['buttontext']); else $buttontext = ''; ?>
        	<p>

                <label for="<?php echo $this->get_field_id('mode'); ?>">
                    Title
                </label>
                <input type = 'text' id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" value = "<?php echo $instance['title']; ?>">
                
                
                <label for="<?php echo $this->get_field_id('mode'); ?>">
                    Posts to show
                </label>
                <input type = 'text' id="<?php echo $this->get_field_id('mode'); ?>" class="widefat" name="<?php echo $this->get_field_name('mode'); ?>" value = "<?php echo $instance['mode']; ?>">
                
            </p>
        	<?php
		
    }

}


#} Widgets
class weddit_hot_comment_widget extends WP_Widget {
    function weddit_hot_comment_widget() {
        parent::WP_Widget(false, $name = 'Hot Comments', array(
            'description' => 'WPeddit Widget: Show your sites hottest comments'
        ));
    }
    function widget($args, $instance) {
    	 global $wp_query,$paged,$post,$wp,$wpdb;
	
        extract($args);$mode = (is_numeric($instance['mode']) ? (int)$instance['mode'] : 5);if (!empty($instance['target'])) $targetStr = ' target="'.$instance['target'].'"'; else $targetStr = '';
		if (!empty($instance['title'])) $title = $instance['title']; else $title = '';		
		if (!empty($instance['item'])) $item = $instance['item']; else $item = '';		
		
		$title = apply_filters( 'widget_title', $instance['title'] );
	    
		echo $before_widget;
		
		echo "<h3 class = 'widget-title'>" . $title . "</h4>";
		
		wpeddit_hot_comments($mode);		

		echo $after_widget;
		
    }
    function update($new_instance, $old_instance) {
        return $new_instance;
    }
	function form($instance) {
        if (isset($instance['mode'])) $mode = esc_attr($instance['mode']); else $mode = 1;
        if (isset($instance['target'])) $target = esc_attr($instance['target']); else $target = '';
        if (isset($instance['buttontext'])) $buttontext = esc_attr($instance['buttontext']); else $buttontext = ''; ?>
        	<p>

                <label for="<?php echo $this->get_field_id('mode'); ?>">
                    Title
                </label>
                <input type = 'text' id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo $this->get_field_name('title'); ?>" value = "<?php echo $instance['title']; ?>">
                
                
                <label for="<?php echo $this->get_field_id('mode'); ?>">
                    Comments to show
                </label>
                <input type = 'text' id="<?php echo $this->get_field_id('mode'); ?>" class="widefat" name="<?php echo $this->get_field_name('mode'); ?>" value = "<?php echo $instance['mode']; ?>">
                
            </p>
        	<?php
		
    }

}



add_action('widgets_init', 'weddit_widgets');
function weddit_widgets() {
    register_widget('weddit_hot_widget');
	register_widget('weddit_hot_comment_widget');
}


function wpt_save_wpeddit() {

     global $wp, $wpdb, $post;  

    
    // unhook this function so it doesn't loop infinitely
	remove_action('save_post', 'wpt_save_wpeddit');

	
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
    return $post->ID;
    // OK, we're authenticated: we need to find and save the data. Make sure we don't add an image every time the post is
    // saved as a draft - so keep track of the external URL in a custom field.
    
    
    	$vote = get_post_meta($post->ID,'epicredvote',true);
		$rank = get_post_meta($post->ID,'epicredrank',true);
		
		if($vote == ""){
			$vote = 0;
		}
		if($rank == ""){
			$rank = 0;
		}

		update_post_meta($post->ID, 'epicredvote', $vote );
		update_post_meta($post->ID,'epicredrank',$rank);
		

    add_action('save_post', 'wpt_save_wpeddit');
   
}
add_action('save_post', 'wpt_save_wpeddit', 1, 2); // save the custom fields and set the image.

#} version 1.6 adding comments meta ranking work

function wpeddit_custom_comment_field( $comment_id ) {
	//add the comment meta for the ranking algorithm.
   add_comment_meta( $comment_id, 'wpeddit_comment_up', 0 );
   add_comment_meta( $comment_id, 'wpeddit_comment_down', 0 );
   add_comment_meta( $comment_id, 'wpeddit_comment_rank', 0 );
   add_comment_meta( $comment_id, 'wpeddit_comment_votes', 0 );
}
add_action( 'comment_post', 'wpeddit_custom_comment_field' );

function wpeddit_comment_ranking($comment_id){
	$ups 		=   get_comment_meta($comment_id,'wpeddit_comment_up',true);
	$downs 		= 	get_comment_meta($comment_id,'wpeddit_comment_down',true);
    $n = $ups + $downs;
    if($n == 0){
        return 0;
	}else{
    $z = 1.0;
    $phat = $ups / $n;
    $rating = sqrt($phat+$z*$z/(2*$n)-$z*(($phat*(1-$phat)+$z*$z/(4*$n))/$n))/(1+$z*$z/$n);
	}	
	update_comment_meta($comment_id,'wpeddit_comment_rank',$rating);
	return $rating;
}

add_action( 'wp_ajax_nopriv_epicred_vote_comment', 'epicred_vote_comment' );
add_action( 'wp_ajax_epicred_vote_comment', 'epicred_vote_comment' );

function epicred_vote_comment(){
	global $wpdb, $current_user;
	
    get_currentuserinfo();
	
	$wpdb->myo_ip   = $wpdb->prefix . 'epicred_comment';
		
    $option = (int)$_POST['option'];
	$current = (int)$_POST['current'];
	$postid = (int)$_POST['poll'];	
		
	//if we are locked via IP set the fid variable to be the IP address, otherwise log the member ID
	if(get_option('epicred_ip') == 'yes'){
		$ipAddr = isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) ? $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
		$fid = "'" . $ipAddr . "'";	
	}else{
		$fid = $current_user->ID;
	}
	
	$query = "SELECT epicred_option FROM $wpdb->myo_ip WHERE epicred_ip = $fid AND epicred_id = $postid";
	
	$al = $wpdb->get_var($query);
    
	
	if($al == NULL){
		$query = "INSERT INTO $wpdb->myo_ip ( epicred_id , epicred_ip, epicred_option) VALUES ( $postid, $fid, $option)";
		$wpdb->query($query);
	}else{
		$query = "UPDATE $wpdb->myo_ip SET epicred_option = $option WHERE epicred_ip = $fid AND epicred_id = $postid";
		$wpdb->query($query);
	}
	
	$ups 		=   get_comment_meta($postid,'wpeddit_comment_up',true);
	$downs 		= 	get_comment_meta($postid,'wpeddit_comment_down',true);
	$vote		=   get_comment_meta($postid,'wpeddit_comment_votes',true);
	
		if($option == 1){
			if($al != 1){
				if($al == -1){
				$vote = $vote+2;	
				$downs = $downs - 1;
				$ups = $ups + 1;
				}else{
				$vote = $vote+1;
				$ups = $ups+1;
				}
			}
		}
		
		
		if($option == -1){
			
			if($al != -1){
				if($al == 1){
					$vote = $vote-2;
					$ups = $ups -1;
					$downs = $downs + 1;
				}else{
				$vote = $vote-1;
				$downs = $downs + 1;
				}	
			}	
		}
		update_comment_meta($postid,'wpeddit_comment_votes',$vote);
		update_comment_meta($postid,'wpeddit_comment_up',$ups);
		update_comment_meta($postid,'wpeddit_comment_down',$downs);

	
		$response['poll'] = $postid;
		$response['vote'] = $vote;
    
    echo json_encode($response);
  
	// IMPORTANT: don't forget to "exit"
	exit;
}

function epic_reddit_voting_comment($ID){
	global $wp_query,$post,$wpdb, $current_user,$query_string;
    get_currentuserinfo();
	$wpdb->myo_ip   = $wpdb->prefix . 'epicred_comment';
			
	$postvote = get_comment_meta($ID, 'wpeddit_comment_votes' ,true);
	
	if($postvote == NULL){
				$postvote = 0;
	}
			
			//again if IP locked set the fid variable to be the IP address.
	if(get_option('epicred_ip') == 'yes'){
		$ipAddr = isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) ? $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'] : $_SERVER['REMOTE_ADDR'];
		$fid = "'" . $ipAddr . "'";	
	}else{
		$fid = $current_user->ID;
	}
			
			$query = "SELECT epicred_option FROM $wpdb->myo_ip WHERE epicred_ip = $fid AND epicred_id = $ID";
			$al = $wpdb->get_var($query);
			if($al == NULL){
				$al = 0;
			}
			if($al == 1){
				$redclassu = 'upmod';
				$redclassd = 'down';
				$redscore = 'likes';
			}elseif($al == -1){
				$redclassd = 'downmod';
				$redclassu = 'up';
				$redscore = "dislikes";
			}else{
				$redclassu = "up";
				$redclassd = "down";
				$redscore = "unvoted";
			}
			
			 ?>
			
			
			<?php wpeddit_comment_ranking($ID); ?>

			
			<?php if(!is_user_logged_in() && get_option('epicred_ip') == 'no') { ?>
			<div class = 'logged-in-only'>
			
			<?php } ?>
			

			<div class = 'reddit-voting'>
				<ul class="unstyled">
			<?php  if(!is_user_logged_in() && get_option('epicred_ip') == 'no') { ?>
					<div class="arrowc <?php echo $redclassu;?> arrowc-up-<?php echo $ID;?>" data-red-current = <?php echo $al;?> data-red-like = "up" data-red-id = "<?php echo $ID;?>" role="button" aria-label="upvote" tabindex="0"></div>
					<div class="score <?php echo $redscore;?> scorec-<?php echo $ID;?>" data-red-current = <?php echo $al;?>><?php echo $postvote; ?></div>
					<div class="arrowc <?php echo $redclassd;?> arrowc-down-<?php echo $ID;?>" data-red-current = <?php echo $al;?> data-red-like = "down" data-red-id = "<?php echo $ID;?>" role="button" aria-label="upvote" tabindex="0"></div>
			<?php }else{ ?>
					<div class="arrowc <?php echo $redclassu;?> arrowc-up-<?php echo $ID;?>" data-red-current = <?php echo $al;?> data-red-like = "up" data-red-id = "<?php echo $ID;?>" role="button" aria-label="upvote" tabindex="0"></div>
					<div class="score <?php echo $redscore;?> scorec-<?php echo $ID;?>" data-red-current = <?php echo $al;?>><?php echo $postvote; ?></div>
					<div class="arrowc <?php echo $redclassd;?> arrowc-down-<?php echo $ID;?>" data-red-current = <?php echo $al;?> data-red-like = "down" data-red-id = "<?php echo $ID;?>" role="button" aria-label="upvote" tabindex="0"></div>	
					<?php }  ?>
				</ul>
			</div>	
			<?php  if(!is_user_logged_in() && get_option('epicred_ip') == 'no') { ?>
			</div>
			<?php } 
	
}

/* Retreve The Value */
function wpeddit_vote($comment) {
	$ID = get_comment_ID();
	$comm = get_comment($ID);
	if ($comm->comment_parent == 0) {
	echo "<div style = 'float:right'>";
	epic_reddit_voting_comment($ID);
	echo "</div>";
	}
return $comment;
 
}
add_filter( 'comment_text', 'wpeddit_vote' );
