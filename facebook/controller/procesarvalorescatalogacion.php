<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include_once('../../model/CatalogarModel.php');
if (isset($_POST) && $_POST!=null) {
    $valores_catalogacion = new CatalogarModel;
    if (isset($_POST['id_value_catalogacion_delete']) && $_POST['id_value_catalogacion_delete']!='') {
        $valores_catalogacion->deleteValoresCatalogacion($_POST['id_value_catalogacion_delete']);
    }
    if (isset($_POST['page_id_create']) && $_POST['page_id_create']!='') {
        $grupo = ($_POST['grupo'] != 'categoria')?$_POST['grupo']:'tipo';
        $nuevo_registro = array(
            'nombre'=> $_POST['nombre'],
            'grupo'=> $grupo,
            'status'=> $_POST['status'],
            'page_id'=> $_POST['page_id_create']
        );
        $valores_catalogacion->setValoresCatalogacion($nuevo_registro);
        //header('Location:../tipos-objetivos.php?psid='.$_POST['page_id_create']);
        header('Location:' . getenv('HTTP_REFERER'));
    }
    if (isset($_POST['id_update']) && $_POST['id_update']!='') {
        $update_registro = array(
            'id'=> $_POST['id_update'],
            'nombre'=> $_POST['nombre'],
            'grupo'=> $_POST['grupo'],
            'status'=> $_POST['status'],
            'page_id'=> $_POST['page_id']
        );
        $valores_catalogacion->updateValoresCatalogacion($update_registro);
        if (isset($_POST['config_page_super_admin']) && $_POST['config_page_super_admin']==true) {
            header('Location:../edit_configuracion_page_facebook_ssg.php?psid='.$_POST['page_id']);
        } else {
            header('Location:../tipos-objetivos.php?psid='.$_POST['page_id']);
        }
        
    }
}
//echo json_encode($_POST);
?>