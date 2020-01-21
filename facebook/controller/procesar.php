<?php
// Este archivo "procesarinformefb.php es el archivo que empieza el proceso de jalar los datos de la BD de acuerdo
// a los parámetros enviados en el formulario, este archivo solo envía los requisitos,
// luego va a main.js y a "ReporteFacebookModel.php" 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include_once('../../model/ReporteConsulta.php'); // ReporteFacebookModel.php es el archivo con las funciones para conectarse a la BD y extraer los datos 
if (isset($_POST) && $_POST!=null) {
    $informe_fb = new ReporteFacebookModel;

    if (isset($_POST['id_informe_fb_delete']) && $_POST['id_informe_fb_delete']!='') {
        $informe_fb->deleteInformeFB($_POST['id_informe_fb_delete']);
    }
    //  Esta función es la que invoca "gráficosfacebook.php", esto invoca al archivo "ReporteFacebookModel.php y le envía los datos que provienen de graficosfacebook.php"
    if (isset($_POST['id_page_create']) && $_POST['id_page_create']!='') {
        $max_informe_fb_id= $informe_fb->getMaxIDInformeFB($_POST['id_page_create']);
        $id_inf=++$max_informe_fb_id[0]["maximo"];
        $fecha_informe =date('d-m-Y H:i:s');
        $nuevo_registro = array(
            'id_inf'=> $id_inf,
            'titulo_reporte'=> $_POST['titulo_reporte'],
            'id_page'=> $_POST['id_page_create'],
            'fecha'=> $_POST['fecha'],
            'fecha_comparacion'=> $_POST['fecha_comparacion'],
            'periodo'=> $_POST['pdo']
        );
        $informe_fb->setReporteFB($nuevo_registro);
		$_SESSION['id_inf'] = $id_inf;
		$_SESSION['titulo_reporte'] = $_POST['titulo_reporte'];
		$_SESSION['id_page'] = $_POST['id_page_create'];
		$_SESSION['fecha'] = $_POST['fecha'];
		$_SESSION['fecha_comparacion'] = $_POST['fecha_comparacion'];
		$_SESSION['fecha_informe'] = $fecha_informe;
		$_SESSION['periodo'] = $_POST['pdo'];
        header('Location:../informefb.php?psid='.$_POST['id_page_create']);
    }
    if (isset($_POST['coment_create_update']) && $_POST['coment_create_update']!='') {

        $comentarios_existentes=$informe_fb->getInformeFB($_POST['id_page'],$_POST['id_inf']);
        foreach($comentarios_existentes as $value)
        { 
          if($_POST['idcom'] == $value['id_com']){$action="Update";break;}else{$action="Create";}
        }

        if ($action == "Create") {
            $nuevo_registro = array(
                'id_inf'=> $_POST['id_inf'],
                'titulo_reporte'=> $_POST['titulo_reporte'],
                'id_page'=> $_POST['id_page'],
                'id_com'=> $_POST['idcom'],
                'comentario'=> $_POST['coment_create_update'],
                'fecha'=> $_POST['fecha'],
                'fecha_comparacion'=> $_POST['fecha_comparacion'],
                'periodo'=> $_POST['periodo']
            );
            //echo json_encode($nuevo_registro);
            $informe_fb->setComentsInformeFB($nuevo_registro);
            echo '{"clase":"success","action":"Creado"}';
        }elseif ($action == "Update") {
            $actualizar_comentario = array(
                'id_inf'=> $_POST['id_inf'],
                'id_com'=> $_POST['idcom'],
                'comentario'=> $_POST['coment_create_update']
            );
            $informe_fb->updateComentsInformeFB($actualizar_comentario);
            echo '{"clase":"warning","action":"Actualizado"}';
        }
    }
}

?>