<?php
// Pass session data over. Only needed if not already passed by another script like WordPress.
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../../model/UserModel.php');
require_once('../../model/FacebookModel.php');
$UserModel = new UserModel();
$FacebookModel = new FacebookModel();
//$_SESSION = array();
//print_r($_SESSION);
if (isset($_SESSION['id_user'])){
    $checkUser = $UserModel->checkUser($_SESSION['id_user']);
    if ($checkUser == true){
        $user = $UserModel->getUser($_SESSION['id_user']);
       //echo "Usuario Logeado";
        //header('Location: https://ssgenius.com/app/facebook/');
    } else { 
        header('Location: https://ssgenius.com/app/facebook/login');
    }
} else { 
        header('Location: https://ssgenius.com/app/facebook/login');
    }
    
    $pages = $FacebookModel->listPages($user->id_facebook);
    //print_r($pages);
    //echo $pages['0']['id_facebook_page'];
    //exit();
    if (isset($pages['0']['id_facebook_page'])){
    $firstPageSsg = $pages['0']['id_facebook_page'];
    } else {$firstPageSsg = "";}

?>