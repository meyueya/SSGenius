<?php
session_start();
header('Content-Type: application/json');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once('../../model/UserModel.php');
require_once('../../model/FacebookModel.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();
//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
if (is_ajax()) {
  if (isset($_POST["id_adaccount"]) && !empty($_POST["id_adaccount"])) { //Checks if action value exists
    $id_adaccount = $_POST["id_adaccount"];
  }
}
$return = array();
if (isset($id_adaccount)){
  $updated_time = date("Y-m-d h:i:s");
  $state = "inactive"; 
  $FacebookModel->UpdateFacebookAdAccount($id_adaccount,$_POST['access_token'],$updated_time,$state);
  $return["id_adaccount"] = $id_adaccount;
  $return["access_token"] = $_POST['access_token'];
 // $FacebookModel->InsertFacebookAdAccount($id_adaccount,  $_POST['id_facebook'],  $_POST['adaccount_name'],  $_POST['adaccount_status'] ,  $_POST['id_business'],  $_POST['business'],  $_POST['access_token'], $created_time, $state);
} 
echo json_encode($return);
exit();