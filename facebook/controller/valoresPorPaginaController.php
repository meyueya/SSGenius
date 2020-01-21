<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
date_default_timezone_set('America/Lima');
include_once('../../model/ValoresPorPaginaModel.php');
if (isset($_POST) && $_POST!=null) { 
    $ValoresPorPaginaModel = new ValoresPorPaginaModel;
    if (isset($_POST['id_value_page_delete']) && $_POST['id_value_page_delete']!='') {
        $ValoresPorPaginaModel->deleteValorPage($_POST['id_value_page_delete']);
    }
    if (isset($_POST['page_id_create']) && $_POST['page_id_create']!='') {
        $nuevo_registro = array(
            'page_id'=> $_POST['page_id_create'],
            'valor'=> $_POST['cantidad'],
            'fecha_inicio'=> $_POST['fecha_inicio'],
            'fecha_fin'=> $_POST['fecha_fin'],
        );
        $ValoresPorPaginaModel->setValoresByPage($nuevo_registro);
        header('Location:' . getenv('HTTP_REFERER'));
    }
    if (isset($_POST['id_update']) && $_POST['id_update']!='') {
        $update_registro = array(
            'id'=> $_POST['id_update'],
            'valor'=> $_POST['cantidad'],
            'fecha_inicio'=> $_POST['fecha_inicio'],
            'fecha_fin'=> $_POST['fecha_fin'],
        );
        $ValoresPorPaginaModel->updateValoresByPage($update_registro);
        header('Location:' . getenv('HTTP_REFERER'));
    }
}
?>