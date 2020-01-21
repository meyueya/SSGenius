<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include_once('../../model/ConsultoriaModel.php');

echo json_encode($_POST);
//echo json_encode($nuevo_registro);
?>