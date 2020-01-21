<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include_once('../../model/FacebookPageSSGModel.php');
if (isset($_POST) && $_POST!=null) {
    $reporte_facebook_post = new FacebookPageSSGModel;

    if (isset($_POST['id_unico_reporte_delete']) && $_POST['id_unico_reporte_delete']!='') {
        $reporte_facebook_post->deleteReporteFacebookPage($_POST['id_unico_reporte_delete']);
    }
    if (isset($_POST['titulo_reporte_create']) && $_POST['titulo_reporte_create']!='') {
        $page_id=array_pop($_POST);
        /* post trae en su ultimo elemento trae el id_unico_reporte del reporte,este será separado*/
        $id_unico_reporte=array_pop($_POST);
        /* ahora post trae en su ultimo elemento trae el titulo del reporte,este será separado*/
        $titulo_reporte=array_pop($_POST);
        /* ahora post trae en su ultimo elemento trae los filtros usados en la consulta, estos seran separados para usarlos en la informacion 
        que esta fuera de la tabla */
        $arrayFiltros=array_pop($_POST);
        $contenido_reporte= json_encode($_POST);
        //$fecha = new DateTime();
        //$fecha_creacion =$fecha->getTimestamp();
        $fecha_creacion =date('Y-m-d H:i:s');
        $nuevo_registro = array(
            'id_unico_reporte'=> $id_unico_reporte,
            'page_id'=> $page_id,
            'filtros'=> $arrayFiltros,
            'titulo_reporte'=> $titulo_reporte,
            'contenido_reporte'=> $contenido_reporte,
            'fecha_creacion'=> $fecha_creacion
        );
        $reporte_facebook_post->setReporteFacebookPage($nuevo_registro);
    }
    if (isset($_POST['coment_create_update']) && $_POST['coment_create_update']!='') {
    }
}

//echo json_encode($_POST);
?>