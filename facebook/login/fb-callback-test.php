<?php
session_start();
require_once( '../php-sdk-5/vendor/autoload.php' );
$appId         = '1930491627191257'; //Facebook App ID
$appSecret     = getenv('FACEBOOK_APP_SECRET'); //Facebook App Secret
$fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v3.2',
]);
use Facebook\Helpers\FacebookJavaScriptHelper;
/*$helper = $fb->getRedirectLoginHelper(); php way
try {
  $accessToken = $helper->getAccessToken();
  */
$jsHelper = $fb->getJavaScriptHelper();
try {
   $accessToken = $jsHelper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  //header('Location: https://ssgenius.com/app/facebook/login/');
  //echo 'Graph devolvio un error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  //header('Location: https://ssgenius.com/app/facebook/login/');
  //echo 'Facebook SDK devolvio un error: ' . $e->getMessage();
  exit;
}
if (!isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
      if (isset($_GET['error_code'])){ $error_code = $_GET['error_code'];}
      if (isset($_GET['error_message'])){ $error_message = $_GET['error_message'];}
      if (isset($_GET['state'])){ $state = $_GET['state'];}
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}
// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);


//echo '<h3>Metadata</h3>';
//print_r($tokenMetadata);
//echo "<pre>";
$ArrayMetadata = Array();
$NewTokenMetaData = ((array) $tokenMetadata);
foreach ($NewTokenMetaData as $key => $value){
   $ArrayMetadata = $value;
}

function in_array_all($needles, $haystack) {
   return empty(array_diff($needles, $haystack));
}
$arrayPerms = ['public_profile','email','pages_show_list','manage_pages','read_insights','ads_read'];

$PermsOk = in_array_all( $arrayPerms, $ArrayMetadata['scopes'] ); 

//echo "</pre>";
// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($appId);
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

 // echo '<h3>Long-lived</h3>';
  //var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken; //guardamos la token de largo acceso en sesi贸n para propagarla

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
 header('Location:  https://ssgenius.com/app/facebook/cuenta-de-anuncios.php');
if ($PermsOk == false){
  // header('Location:  https://ssgenius.com/app/facebook/no-perms.html');
   // exit();
} else {
    //header('Location:  https://ssgenius.com/app/facebook/cuenta-de-anuncios.php');
 //header('Location: https://ssgenius.com/app/facebook/page.php');
}
