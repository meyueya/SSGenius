<?php
/* error_reporting(E_ALL);
ini_set('display_errors', 1); */
date_default_timezone_set('America/Lima');
include_once('../../model/CatalogarModel.php');
if (isset($_POST) && $_POST!=null) {
    $catalogacion = new CatalogarModel;
    if (isset($_POST['idPost_delete']) && $_POST['idPost_delete']!='') {
        $catalogacion->deleteCatalogacion($_POST['idPost_delete']);
    }
    if (isset($_POST['id_post']) && $_POST['id_post']!='') {
            $id_post=$_POST['id_post'];
            $page_id=$_POST['page_id'];
            $fecha =date('d-m-Y H:i:s');
            if (count($_POST['valores_catalogacion']>0)) {
                foreach ($_POST['valores_catalogacion'] as $value) {
                    $nuevo_registro = array(
                        'valores_catalogacion'=> $value,
                        'id_post'=> $id_post,
                        'page_id'=> $page_id,
                        'fecha'=> $fecha
                    );
                    $catalogacion->setCatalogacion($nuevo_registro);
                }
            }
    }
    if (isset($_POST['id_post_update']) && $_POST['id_post_update']!='') {
        $catalogacion->deleteCatalogacion($_POST['id_post_update']);
        $id_post=$_POST['id_post_update'];
        $page_id=$_POST['page_id_update'];
        $fecha =date('d-m-Y H:i:s');
        if (count($_POST['valores_catalogacion']>0)) {
            foreach ($_POST['valores_catalogacion'] as $value) {
                $nuevo_registro = array(
                    'valores_catalogacion'=> $value,
                    'id_post'=> $id_post,
                    'page_id'=> $page_id,
                    'fecha'=> $fecha
                );
                $catalogacion->setCatalogacion($nuevo_registro);
            }
        }
    }
}
//echo json_encode($_POST);
?>