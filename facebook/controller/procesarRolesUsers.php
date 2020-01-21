<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include_once('../../model/UserRolModel.php');
if (isset($_POST) && $_POST!=null) {
    $user_model = new UserRolModel;
    if (isset($_POST['rol_update']) && $_POST['rol_update']!='') {
        $infoAInsertar=array(
            'rol_update'=>$_POST['rol_update'],
            'id_user'=>$_POST['id_user']
        );
        $user_model->updateRol($infoAInsertar);
        echo json_encode($_POST);
    }

}
?>