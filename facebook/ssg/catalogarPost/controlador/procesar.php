<?php
include_once('../../model/OperacionesTabla.php');
$conectar= new OperacionesTabla();
    foreach ($_POST as $key => $value) {
        if($key != 0){
        $arrayCamposCatalogo=array('valores_catalogacion','id_post');
            $infoAInsertar=array(
                'valores_catalogacion'=> $value,
                'id_post'=> $_POST["id_post"]
            );
            $conectar->crearRegistro('catalogacion_post_facebook',$arrayCamposCatalogo,$infoAInsertar);
        }
    }
/*     $camposABuscar=array('id');
    $infoDeCamposABuscar=array($_POST['id_post']);
    $camposDelRegistro=array('catalogado');
    $infoAInsertar=array('catalogado'=>1);
    $conectar->updateRegistro('post_page_facebook',$camposABuscar,$infoDeCamposABuscar,$camposDelRegistro,$infoAInsertar);  */
    $_POST=NULL;
?>