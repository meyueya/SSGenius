<?php
session_start(['cookie_lifetime' => 86400]);
require_once '/vendor/autoload.php'; // sdk Graph
require_once 'instagram_api.php'; // 
require_once '/model/SsgInstagramModel.php'; // 


// -- Instancias
$SsgInstagramModel = new SsgInstagramModel();
$helper = new Helper_GraphAPI();
$appId = '177087713398265'; //Facebook App ID
$fb = new Facebook\Facebook([
    'app_id' => $appId,
    'app_secret' => "fa41517e01f08bb85f077270f3de3a01",
    'default_graph_version' => 'v5.0',
    'persistent_data_handler' => 'memory'
]);
/*$helper = $fb->getRedirectLoginHelper(); php way
try {
  $accessToken = $helper->getAccessToken();
  */

$accessToken = $_GET['accessToken'];
// use Facebook\Helpers\FacebookJavaScriptHelper;

// $jsHelper = $fb->getJavaScriptHelper();

// try {
//     $accessToken = $jsHelper->getAccessToken();
//     echo "Token: " . $accessToken;
// } catch (Facebook\Exceptions\FacebookResponseException $e) {
//     // When Graph returns an error
//     $error = 'Graph devolvio un error: ' . $e->getMessage();
//     $SsgHelper->sendMailer("info@mimirwell.com", "Hubo un error de logeo fb-callback ", " en " . __FILE__ . " \n ip: " . $ip . " Error: " . $error);
//     header('Location:  https://ssgenius.com/app/facebook/error.php');
//     exit;
// } catch (Facebook\Exceptions\FacebookSDKException $e) {
//     // When validation fails or other local issues
//     //header('Location: https://ssgenius.com/app/facebook/login/');
//     $error = 'Facebook SDK devolvio un error: ' . $e->getMessage();
//     $SsgHelper->sendMailer("info@mimirwell.com", "Hubo un error de logeo fb-callback ", " en " . __FILE__ . " \n ip: " . $ip . " Error: " . $error);
//     header('Location:  https://ssgenius.com/app/facebook/error.php');
//     exit;
// }

// die;
// if (!isset($accessToken)) {
//     if ($helper->getError()) {
//         //header('HTTP/1.0 401 Unauthorized');
//         $error = "Error: " . $helper->getError() . "\n";
//         $error .= "Error Code: " . $helper->getErrorCode() . "\n";
//         $error .= "Error Reason: " . $helper->getErrorReason() . "\n";
//         $error .= "Error Description: " . $helper->getErrorDescription() . "\n";
//         $SsgHelper->sendMailer("info@mimirwell.com", "Hubo un error de Unauthorized fb-callback helper->getError ", " en " . __FILE__ . " \n ip: " . $ip . " Error: " . $error);
//         header('Location:  https://ssgenius.com/app/facebook/error.php');
//         exit;
//     } else {
//         if (isset($_GET['error_code'])) {
//             $error_code = $_GET['error_code'];
//         }
//         if (isset($_GET['error_message'])) {
//             $error_message = $_GET['error_message'];
//         }
//         if (isset($_GET['state'])) {
//             $state = $_GET['state'];
//         }
//         header('HTTP/1.0 400 Bad Request');
//         echo 'Bad request';
//     }
//     exit;
// }
// Logged in
// echo '<h3>Access Token</h3>';
// print_r($accessToken);
// exit();
// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);


// echo '<h3>Metadata</h3>';
// print_r($tokenMetadata);
// echo "<pre>";
// die;
$ArrayMetadata = array();
$NewTokenMetaData = ((array) $tokenMetadata);
foreach ($NewTokenMetaData as $key => $value) {
    $ArrayMetadata = $value;
}

/* print_r($ArrayMetadata['scopes']); */

// $arrayPerms = ['public_profile', 'email', 'pages_show_list', 'manage_pages', 'read_insights', 'ads_read'];
// $. = $SsgHelper->in_array_all($arrayPerms, $ArrayMetadata['scopes']);
//echo "</pre>";
// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($appId);
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

// print_r($tokenMetadata);
// die;
if (!$accessToken->isLongLived()) {
    // Exchanges a short-lived access token for a long-lived one
    try {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        $error = "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
        /*  $SsgHelper->sendMailer("info@mimirwell.com", "Hubo un error de logeo fb-callback ", " en " . __FILE__ . " \n ip: " . $ip . " Error: " . $error);
        header('Location:  https://ssgenius.com/app/facebook/error.php'); */
        exit;
    }

    echo '<h3>Long-lived</h3>';
    var_dump($accessToken->getValue());
}

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.

// if ($. == false) {
//     $_SESSION = array();
//     session_destroy();
//     header('Location:  https://ssgenius.com/app/facebook/no-perms.html');
//     exit();
// } else {
//     $_SESSION['fb_access_token'] = (string) $accessToken; //guardamos la token de largo acceso en sesion para propagarla
//     header('Location: https://ssgenius.com/app/facebook/page.php');
//     exit();
// }
