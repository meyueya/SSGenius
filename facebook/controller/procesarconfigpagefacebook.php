<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
if (isset($_POST) && $_POST!=null) {

    if (isset($_POST['page_id_delete']) && $_POST['page_id_delete']!='') {
        include_once('../../model/CatalogarModel.php');
        $config_page_facebook = new CatalogarModel;
        $config_page_facebook->deleteTodosLosValoresCatalogacion($_POST['page_id_delete']);
    }
    if (isset($_POST['page_id_create']) && $_POST['page_id_create']!='') {
        $values_catalogacion_page_active = (isset($_POST['values_catalogacion_page_active']))? explode(',',$_POST['values_catalogacion_page_active']):[];
        $values_catalogacion_page_inactive = (isset($_POST['values_catalogacion_page_inactive']))? explode(',',$_POST['values_catalogacion_page_inactive']):[];
        $valores_config = (isset($_POST['valores_config']))? explode(',',$_POST['valores_config']):[];
        $valores_enviados = [];
        include_once('../../model/CatalogarModel.php');
        $config_page_facebook = new CatalogarModel;
        $values_catalogacion_page = (isset($_POST['values_catalogacion_page']))? explode(',',$_POST['values_catalogacion_page']):[];
        /* echo "<pre>";
        var_dump($_POST);
        echo "<pre>";
        die; */
        foreach ($_POST['config'] as $grupo => $subgrupos) {
            foreach ($subgrupos as $subgrupo => $config) {
                foreach ($config as $key => $nombre) {
                    //internamente las categorias se van a manejar como tipos
                    $grupo = ($grupo =='categoria') ? 'tipo' : $grupo ;
                        $info = array(
                            'nombre'=> $nombre,
                            'grupo'=> $grupo,
                            'subgrupo'=> $subgrupo,
                            'page_id'=> $_POST['page_id_create'],
                            'status'=> 'active',
                        );
                    if (in_array($nombre,$values_catalogacion_page_active)) {
                        //sin accione
                        //echo " </br> sin acciones para ".$nombre;
                    }elseif(in_array($nombre,$values_catalogacion_page_inactive)){
                        //activar
                        $config_page_facebook->updateStatusCatalogacion($info); 
                        //echo " </br> se activo ".$nombre;
                    }else{
                        //registrar
                        $config_page_facebook->setValoresCatalogacion($info); 
                        //echo " </br> se registro ".$nombre;
                    }
                    array_push($valores_enviados,$nombre);
                }
            }
        }
        $valores_desactivar = array_diff($values_catalogacion_page_active,$valores_enviados);
        foreach ($valores_desactivar as $nombre) {
            $info = array(
                'nombre'=> $nombre,
                'page_id'=> $_POST['page_id_create'],
                'status'=> 'inactive',
            );
            $config_page_facebook->updateStatusCatalogacion($info);
            //echo "</br>se desactivo ".$nombre;
        }
        //header('Location:../index.php?psid='.$_POST['page_id_create']);
        header('Location:' . getenv('HTTP_REFERER'));
    }
    if (isset($_POST['config_create']) && $_POST['config_create']!='') {
        include_once('../../model/ConfigurarPageFacebookSSGModel.php');
        $config_page_facebook = new ConfigurarPageFacebookSSGModel;
        $config_page_facebook->setConfigPage($_POST);
        header('Location:../configuracion_page_facebook_ssg.php'); 
    }
}
//echo json_encode($_POST);
?>