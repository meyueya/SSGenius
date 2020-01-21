<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include_once('../../model/InversioncuentamesesModel.php');
if (isset($_POST) && $_POST!=null) { 
    $inversioncuentamesesModel = new InversioncuentamesesModel;
    if (isset($_POST['id_value_inversion_delete']) && $_POST['id_value_inversion_delete']!='') {
        $inversioncuentamesesModel->deleteValorInversion($_POST['id_value_inversion_delete']);
    }
    if (isset($_POST['page_id_create']) && $_POST['page_id_create']!='') {
        $anio=$_POST['anio'];
        $mes=$_POST['mes'];
        $nuevo_registro = array(
            'id_adaccount'=> $_POST['id_adaccount'],
            'id_page'=> $_POST['page_id_create'],
            'fecha'=> "$anio-$mes-01",
            'cantidad'=> $_POST['cantidad'],
        );
        $inversioncuentamesesModel->setValoresInversion($nuevo_registro);
        header('Location:' . getenv('HTTP_REFERER'));
    }
    if (isset($_POST['id_update']) && $_POST['id_update']!='') {
        $anio=$_POST['anio'];
        $mes=$_POST['mes'];
        $update_registro = array(
            'id'=> $_POST['id_update'],
            'fecha'=> "$anio-$mes-01",
            'cantidad'=> $_POST['cantidad'],
        );
        $inversioncuentamesesModel->updateValoresInversion($update_registro);
        header('Location:' . getenv('HTTP_REFERER'));
        
    }
}
//echo json_encode($_POST);
?>