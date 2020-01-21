<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include_once('../../model/FacebookAiwModel.php');
// var_dump($_POST);die;
//$reporte_facebook = 0;
if (isset($_POST) && $_POST!=null) {
    $reporte_facebook = new FacebookAiwModel;
         $reporte_facebook->updateFacebookAiw($_POST);
        if (isset($_POST['config_page_super_admin']) && $_POST['config_page_super_admin']==true) {
            header('Location:../configFacebookAcounts.php?psid=');
        } else {
            header('Location:../configFacebookAcounts.php?psid=');
        }
        
    }
   // edit_configuracion_page_facebook_ssg.php

//echo json_encode($_POST);
?>
