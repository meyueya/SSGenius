<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include('../../model/PostConsultoriaSSGModel.php');
if (isset($_POST) && $_POST!=null) {
    $postConsultoria = new PostConsultoriaSSGModel;

    if(isset($_POST["page_id_create"]) && $_POST["page_id_create"]!=""){
        $page_id = $_POST['page_id_create'];
        $analisis_padre = $_POST['analisis_padre'];
        $id_consultoria = $_POST['id_consultoria'];
        $post_id = $_POST['post_id'];
        $maximo = $postConsultoria->getMaxIDPostAnalisis($id_consultoria,$page_id);
        $nroPost=$maximo[0]+1;
        $fecha=date("Y-m-d H:i:s"); 
        foreach($_POST["analisis"] as $key => $value) {
            foreach($value as $k) {
                $nuevo_registro = array(
                    'id_consultoria'=> $id_consultoria,
                    'post'=> $nroPost,
                    'analisis'=> $k,
                    'analisis_padre'=> $analisis_padre,
                    'fecha'=> $fecha,
                    'page_id'=> $page_id,
                    'post_id'=> $post_id
                );
                $postConsultoria->setPostConsultoria($nuevo_registro);
            }
            $nroPost++;
       }
       //header('Location:../reporteconsultoria.php?psid='.$_POST['page_id_create']);
    }
    
    if(isset($_POST["operacion"]) && $_POST["operacion"]=='asignar_post_actualizar_info_analisis'){
        $id_consultoria = $_POST['id_consultoria'];
        $analisis_padre = $_POST['analisis_padre'];
        $page_id = $_POST['page_id'];
        $post = $_POST['postConsultoria'];
        $postConsultoria->deletePostConsultoria($id_consultoria,$page_id,$post);
        $post_id = $_POST['post_id'];
        $fecha=date("Y-m-d H:i:s"); 
        foreach($_POST["analisis_post"] as $key => $value) {
                $nuevo_registro = array(
                    'id_consultoria'=> $id_consultoria,
                    'post'=> $post,
                    'analisis_padre'=> $analisis_padre,
                    'analisis'=> $value,
                    'fecha'=> $fecha,
                    'page_id'=> $page_id,
                    'post_id'=> $post_id
                );
                $postConsultoria->setPostConsultoria($nuevo_registro);
       }
    //se pasa la informacion del titulo de la consultoria para que este disponible al hacer el header
    $titulo_consultoria=$_POST['titulo']; 
    header('Location:../adminpost2.php?a='.$id_consultoria.'&t='.$titulo_consultoria.'&psid='.$page_id);
    }
        if(isset($_POST["post_id_delete"]) && $_POST["post_id_delete"]!=''){
            $postConsultoria->deletePostConsultoria($_POST['id_consultoria'],$_POST['page_id'],$_POST['post_id_delete']);
        }
}

?>