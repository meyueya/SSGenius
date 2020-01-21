<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima'); 
if (isset($_POST) && $_POST!=null) {

    if (isset($_POST['registrar_cuentas']) && $_POST['registrar_cuentas']!='') {
        include_once('../../model/CuentasPorPaginasModel.php');
        $cuentasPorPaginas = new CuentasPorPaginasModel;
        $id_user = $_POST['id_user'];
        $info_cuentas = $_POST["info_cuentas"];
        $todas_las_cuentas = $_POST["todas_las_cuentas"];
        foreach ($todas_las_cuentas as $page_id => $cuentas) {
            $todas_esta_pagina = json_decode($cuentas);
            $cuentas_activadas = (isset($info_cuentas[$page_id])) ? $info_cuentas[$page_id] : [] ; //cuentas que se ckequearon en el formulario
            $cuentas_a_desactivar = array_diff($todas_esta_pagina,$cuentas_activadas);
            foreach ($cuentas_activadas as $id_adaccount) {
                $info=[
                    'id_adaccount'=>$id_adaccount,
                    'page_id'=>$page_id,
                    'id_user'=>$id_user,
                    'estado'=>'active',
                ];
                //verificar existencia en tabla 
                if($cuentasPorPaginas->registroexistente($info)){//activando
                    $cuentasPorPaginas->updateCuentasPorPagina($info);
                }else{//ingresando registro
                    $cuentasPorPaginas->setCuentasPorPagina($info);
                }
            }
            //cuentas a desactivar 
            foreach ($cuentas_a_desactivar as $cuentaADesactivar) {
                $info=[
                    'id_adaccount'=>$cuentaADesactivar,
                    'page_id'=>$page_id,
                    'id_user'=>$id_user,
                    'estado'=>'inactive',
                ];
                $cuentasPorPaginas->updateCuentasPorPagina($info);
            }
        }
        header('Location:' . getenv('HTTP_REFERER'));
    }
}
?>
