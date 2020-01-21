<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Lima');
include_once('../../model/ConsultoriaModel.php');
if (isset($_POST) && $_POST!=null) {
    $consultoria = new ConsultoriaModel;

    //consultoria
    if (isset($_POST['page_id_delete']) && $_POST['page_id_delete']!='') {
        $consultoria->deleteConsultoria($_POST['id_consultoria'],$_POST['page_id_delete']);
        echo "borrado";
    }
    if (isset($_POST["op"]) && $_POST["op"]==1 && $_POST['id_edit']==null) {
        $titulo_consultoria = $_POST["titulo_consultoria"];
        $page_id = $_POST['page_id'];
        $fecha=date("Y-m-d H:i:s");
        $maximo = $consultoria->getMaxIDConsultoria($page_id);
        $id_consultoria=$maximo[0]+1;
        foreach($_POST["kpi"] as $key => $value) {
            foreach($value as $k) {
                $nuevo_registro = array(
                    'id_consultoria'=> $id_consultoria,
                    'id_analisis'=> $key,
                    'tipo'=> $_POST["tipo"][$key],
                    'obj'=> $_POST["obj"][$key],
                    'titulo'=> $_POST["titulo"][$key],
                    'kpi'=> $k,
                    'principal'=> $_POST["principal"][$key],
                    'fecha'=> $fecha,
                    'titulo_consultoria'=> $titulo_consultoria,
                    'page_id'=> $page_id
                );
                $consultoria->setConsultoria($nuevo_registro);
            }
        }
        echo "hecho";
    }
    if (isset($_POST["op"]) && $_POST["op"]==1 && $_POST['id_edit']!=null) {
        $consultoria->deleteConsultoria($_POST['id_edit'],$_POST['page_id']);
        $titulo_consultoria = $_POST["titulo_consultoria"];
        $page_id = $_POST['page_id'];
        $fecha=date("Y-m-d H:i:s");
        $id_consultoria=$_POST['id_edit'];
        foreach($_POST["kpi"] as $key => $value) {
            foreach($value as $k) { 
                $nuevo_registro = array(
                    'id_consultoria'=> $id_consultoria,
                    'id_analisis'=> $key,
                    'tipo'=> $_POST["tipo"][$key],
                    'obj'=> $_POST["obj"][$key],
                    'titulo'=> $_POST["titulo"][$key],
                    'kpi'=> $k,
                    'principal'=> $_POST["principal"][$key],
                    'fecha'=> $fecha,
                    'titulo_consultoria'=> $titulo_consultoria,
                    'page_id'=> $page_id
                );
                $consultoria->setConsultoria($nuevo_registro);
            }
        }
        echo "hecho";
    }
    //reporte kpis
    if(isset($_POST["op"]) && $_POST["op"]==2){
        $jsonConsultoria=$consultoria->getValoresrepotekpis($_POST['id'],$_POST['page_id']);
        $jsonKpiAnalisis=$consultoria->getKpisAnalisisConsultoria($_POST['anl'],$_POST['id'],$_POST['page_id']);
        $json = array('consultoria' => $jsonConsultoria, 'kpiAnalisis' => $jsonKpiAnalisis);
        echo json_encode($json);
    }

    //analisis consultoria 

    if(isset($_POST["op"]) && $_POST["op"]=='3'){
        $id_consultoria = $_POST['id_consultoria']; 
        $page_id = $_POST['page_id'];  
        $nanalisis = $_POST['nanalisis'];  
       
       foreach($_POST["titulo"] as $key => $value) {
        if ($_POST["titulo"][$key]!=""){
            $nuevo_registro = array(
                'id_consultoria'=> $id_consultoria,
                'titulo'=> $_POST["titulo"][$key],
                'obs'=> $_POST["obs"][$key],
                'hip'=> $_POST["hip"][$key],
                'tipoa'=> $_POST["tipoa"][$key],
                'nanalisis'=> $nanalisis,
                'page_id'=> $page_id
            );
        
           $consultoria->setAnalisisConsultoria($nuevo_registro);
        }
       }
    }

    //tipo de analisis
    if (isset($_POST['operacion']) && $_POST['operacion']=='get_tipo_analisis') {
        $tanalais = $consultoria->traerConsultoriaTAnalisis($_POST['page_id']);
        echo json_encode($tanalais);
    }
}

//echo json_encode($_POST);
//echo json_encode($nuevo_registro);
?>