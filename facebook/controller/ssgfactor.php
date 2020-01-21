<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once('../model/VariablesGlobalesSSGModel.php');
    if (isset($_GET['psid'])){
        $variablesGlobalesSSG = new VariablesGlobalesSSGModel;
        $arreglo=[];
        $arreglo['page_id'] = $_GET['psid'];
        $arreglo['hoy'] = date("Y-m-d");
        $ssg_factor = $variablesGlobalesSSG->getSSGFactor($arreglo);
        if (count($ssg_factor)>0) {
            define('SSG_FACTOR',$ssg_factor[0]['valor']);
        }else{
            define('SSG_FACTOR',1);
        }
    } else {
        define('SSG_FACTOR',1);
    }
?>