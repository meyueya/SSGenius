<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
date_default_timezone_set('America/Lima');
include_once('../../model/ProductosModel.php');
if (isset($_POST) && $_POST!=null) { 
    $ProductosModel = new ProductosModel;
    if (isset($_POST['id_producto_delete']) && $_POST['id_producto_delete']!='') {
        $ProductosModel->deleteProduct($_POST['id_producto_delete']);
        $ProductosModel->deleteAllRelacionsProduct($_POST['id_producto_delete']);
    }
    if (isset($_POST['create_product']) && $_POST['create_product']=='crear') {
       
        $nuevo_registro = array(
            'name'=> $_POST['name'],
            'description'=> $_POST['description'],
        );
        $product_id = $ProductosModel->setValoresProducto($nuevo_registro);
        //para agregar las relaciones del producto creado recientemente
        $_POST['product_id'] = $product_id;
       
    }
    if (isset($_POST['id_update']) && $_POST['id_update']!='') {
        $update_registro = array(
            'id'=> $_POST['id_update'],
            'name'=> $_POST['name'],
            'description'=> $_POST['description'],
        );
        $ProductosModel->updateProducto($update_registro);
       
    }
    if (isset($_POST['guardar_relaciones']) && $_POST['guardar_relaciones']!='') {
        $info_campanias = (isset($_POST["info_campanias"])) ? $_POST["info_campanias"] : [];
        $todas_las_campanias = (isset($_POST["todas_las_campanias"])) ? $_POST["todas_las_campanias"] : [] ;
        foreach ($todas_las_campanias as $page_id => $cuentas) {
            foreach ($cuentas as $cuenta_id => $campanias) {
                $todas_en_esta_cuenta = json_decode($campanias);
                $campanias_activadas = (isset($info_campanias[$page_id][$cuenta_id])) ? $info_campanias[$page_id][$cuenta_id] : [] ; //cuentas que se ckequearon en el formulario
                $campanias_a_eliminar = array_diff($todas_en_esta_cuenta,$campanias_activadas);
                foreach ($campanias_activadas as $campania_id) {
                    $info=[
                        'page_id'=>$page_id,
                        'adaccount_id'=>$cuenta_id,
                        'product_id'=>$_POST['product_id'],
                        'campaign_id'=>$campania_id,
                    ];
                    //verificar existencia en tabla 
                    if(!$ProductosModel->registroexistente($info)){//agregando
                        $ProductosModel->setRelacionProductoCAmpania($info);
                    }
                }
                //relaciones a eliminar
                foreach ($campanias_a_eliminar as $campania_a_eliminar_id) {
                    $info=[
                        'page_id'=>$page_id,
                        'adaccount_id'=>$cuenta_id,
                        'product_id'=>$_POST['product_id'],
                        'campaign_id'=>$campania_a_eliminar_id,
                    ];
                    $ProductosModel->deleteRelacionProductoCAmpania($info);
                }
            }
        }
       
    }
    header('Location:' . getenv('HTTP_REFERER'));
}
?>