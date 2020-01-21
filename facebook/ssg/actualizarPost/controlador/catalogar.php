<?php

include_once('../../model/OperacionesTabla.php');
include_once('formatValoresCatalogo.php');

$conectar= new OperacionesTabla();

$arrayCampos=array('catalogado');
$infoABuscar=array('catalogado' => 0);

$sinCatalogar=$conectar->getSomeUpdateRegistrosJoin();
//$sinCatalogar=$conectar->getSomeRegistros('post_page_facebook',$arrayCampos,$infoABuscar,'id, permalink_url','LIMIT 5');
$catalogacion=$conectar-> getAllTabla('catalogacion');
/*echo "<pre>";
print_r($sinCatalogar);
echo "</pre>";
*/
include('../vistas/catalogarV.php');
?>