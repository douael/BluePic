<?php
//session_start();
require 'php-graph-sdk/src/Facebook/autoload.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
  <title></title>
</head>
<body>
  <?php
if(isset($POST['msg'])){
  $linkData = ['message'=>$_POST['msg']];
  $fb->post('/me/feed',$message);
}
?>
<!--form method="POST">
  <input type="text" placeholder="" name="msg" />
  <input type="submit" value="envoyer" />
</form-->
  <!-- /
Verifier que le token existe et qu'il soit valide
Si ce n'est pas le cas affichez le bouton de connexion
Sinon affichez l'email de l'internaute
  */ -->
  <?php
//   $fb = new Facebook\Facebook([
//   'app_id' => '153602711910635', // Replace {app-id} with your app id
//   'app_secret' => '4e247d8aea6b756f050003e9687b14a9',
//   'default_graph_version' => 'v2.2',
//   ]);
//
//
// //echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
// if(checkToken() == '1' ){
//   $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
//   $response = $fb->get('/me?fields=albums{photos{picture},name}');
//   $albums = $response->getDecodedBody();
//   echo '<pre>';
//   foreach($albums['albums']['data'] as $toto){
//     echo $toto["name"];
//     foreach ($toto['photos']['data'] as  $photo) {
//       echo "<img src='".$photo['picture']."'>";
//     }
//   }
// }else{
//   $helper = $fb->getRedirectLoginHelper();
//   $permissions = ['email','user_photos'];
//
//   $loginUrl = $helper->getLoginUrl('http://www.elomaridouae.com/callback', $permissions);
//
//   echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
// }
// function checkToken()
// {
//   if(empty($_SESSION['fb_access_token'])){
//     return false;
//   }
//   $url = "https://graph.facebook.com/debug_token?input_token=".$_SESSION['fb_access_token'].
//   "&access_token=153602711910635|4e247d8aea6b756f050003e9687b14a9";
//   $page = json_decode(file_get_contents($url));
//   $result = $page->data->is_valid;
//   if( !$result) unset($_SESSION['fb_access_token']);
//
//   return $result;
// }


 ?>
 <section>

 <div id="particles-js"></div>
 <div class="account-wall">
     <img class="profile-img" src="/assets/img/logo.png"
         alt="">
         <br /><br / /><br />
         <div class="fb-login-button" style ="margin-left: 21%;" data-max-rows="1" data-size="large" data-scope="public_profile,email,user_photos" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
 </div>

</section>

 <?php

 	/* Vérifier que le token existe et qu'il soit valide
 	* Si ce n'est pas le cas affichez le bouton de connexion
 	* Sinon affichez l'email de l'internaute
 	*/

//  	$fb = new Facebook\Facebook([
//  	  'app_id' => '898222853688349', // Replace {app-id} with your app id
//  	  'app_secret' => 'b734edbc9736d316fc93591288165122',
//  	  'default_graph_version' => 'v2.2',
//  	  ]);
//
//  	if(!checkToken()){
//  	$helper = $fb->getRedirectLoginHelper();
//
//  	$permissions = ['email','user_photos']; // Optional permissions
//  	$loginUrl = $helper->getLoginUrl('http://elomaridouae.com/Index/fbcallback', $permissions);
//
//  	echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
//  	}else{
//  		$fb->setDefaultAccessToken($_SESSION['fb_access_token']);
//
//  		//$result = $fb->get("/me?fields=email");
//
//  		$result = $fb->get("/me?fields=albums{photos{picture},name}");
//  		$albums = $result->getDecodedBody();
//
//  		//$user = $result->getGraphUser();
//
//  		//echo $user->getEmail();
//  		foreach($albums['albums']['data'] as $album){
//  			echo "<h2>".$album['name']."<h2/>";
//  			foreach ($album['photos']['data'] as $photo) {
//  				echo "<img src='".$photo['picture']."'>";
//  			}
//  		}
//
//  		echo "<pre>";
//  		var_dump($albums);
//  	}
//
//  	function checkToken(){
//  		if (empty($_SESSION['fb_access_token'])) {
//  			return false;
//  		}
//  		$url = "https://graph.facebook.com/me?access_token=0f996f6a5388a792dc52ce3d8020489f&fields=albums{photos{picture},name}";
//
//  		$page = json_decode((file_get_contents($url)));
//
//  		$result = $page->data->is_valid;
//
//  		if (!$result) {
//  			unset($_SESSION['fb_access_token']);
//  		}
//
//  		return $result;
//  	}
// var_dump($_SESSION);die;
 ?>
 <script>
   window.fbAsyncInit = function() {
     FB.init({
       appId      : '898222853688349',
       cookie     : true,
       xfbml      : true,
       version    : 'v2.10'
     });

     FB.AppEvents.logPageView();

   };

   (function(d, s, id){
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {return;}
      js = d.createElement(s); js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
});


function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}
</script>
</body>
</html>
