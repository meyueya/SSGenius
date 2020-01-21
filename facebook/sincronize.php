<?php
session_start();
header('Content-Type: application/json');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once('../model/UserModel.php');
require_once('../model/FacebookModel.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();
//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if (is_ajax()) {
  if (isset($_POST["id_facebook_page"]) && !empty($_POST["id_facebook_page"])) { //Checks if action value exists
    $id_facebook_page = $_POST["id_facebook_page"];
  }
}
$return = Array();
if (isset($id_facebook_page)){
  
  $return["id_facebook_page"] = $id_facebook_page;
  $state = "active";
  $created_time = date("Y-m-d h:i:s");
  $updated_time = date("Y-m-d h:i:s");
  $checkIfFacebookPostPageJobExists =  $FacebookModel->checkIfFacebookPostPageJobExists($id_facebook_page);
  if ($checkIfFacebookPostPageJobExists == false){
      $keyJob = $FacebookModel->InsertFacebookPostPageJob($_SESSION['fb_access_token'],  $_POST['page_token'], $id_facebook_page, $_POST['id_facebook'], $created_time, $updated_time, $state);
  } else {
      $FacebookModel->UpdateFacebookPostPageJob($id_facebook_page,$_SESSION['fb_access_token'], $_POST['page_token'], $state);
      $keyJob = $FacebookModel->getIdFacebookPostPageJob($id_facebook_page);
  }
  $FacebookModel->UpdateStateFacebookUserPage($id_facebook_page,$_POST["id_facebook"],"active");
} 


 $return["access_token"] = $_SESSION['fb_access_token'];
 $return["id_facebook_page"] = $_POST["id_facebook_page"];
 $return["page_token"] = $_POST['page_token'];
 $key = uniqid(mt_rand(), true);

 if (isset($keyJob)){
     //ralentiza el servidor
/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://ssgenius.com/app/facebook/ssgFacebookPostPageJob.php?t=".$keyJob);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
curl_close($ch);*/

//echo "<pre>$output</pre>";
}
$return["keyjob"] = $keyJob;
echo var_dump($return);
exit();
