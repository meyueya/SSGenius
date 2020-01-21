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
    if (isset($_POST["id_facebook"]) && !empty($_POST["id_facebook"])) { //Checks if action value exists
    $id_facebook = $_POST["id_facebook"];
  }
   if (isset($_POST["page_token"]) && !empty($_POST["page_token"])) { //Checks if action value exists
    $page_token = $_POST["page_token"];
  }
}
$return = Array();
if (isset($id_facebook_page) && (isset($id_facebook))){
  
  $return["id_facebook_page"] = $id_facebook_page;
  $return["id_facebook"] = $id_facebook;
  
  $state = "inactive";
  
  $created_time = date("Y-m-d h:i:s");
  $updated_time = date("Y-m-d h:i:s");
  
  $FacebookModel->UpdateStateFacebookUserPage($id_facebook_page,$id_facebook,$state);
  $checkIfFacebookPageUserExists =  $FacebookModel->checkIfFacebookPageUserExists($id_facebook_page);
    if ($checkIfFacebookPageUserExists == false){
      $FacebookModel->UpdateFacebookPostPageJob($id_facebook_page,$_SESSION['fb_access_token'], $page_token, $state);  
    }
} 


 $return["access_token"] = $_SESSION['fb_access_token'];
 $return["id_facebook_page"] = $_POST["id_facebook_page"];
 $return["page_token"] = $_POST['page_token'];
 $key = uniqid(mt_rand(), true);

echo json_encode($return);
exit();
