<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //header('Content-Type: application/json');
    date_default_timezone_set("America/Bogota");
    include('../../model/SsgModel.php'); 
    include('../../model/SsgTopReportModel.php'); 
    include('../../model/FacebookModel.php');
    //include('../controller/funcionesFormat.php');
    include('../../model/ReportePostConsultoriaModel.php');
    $reportePostConsultoria = new ReportePostConsultoriaModel;
    
    $SsgModel = new SsgModel;
    $ssgTopReportModel = new SsgTopReportModel;
    $FacebookModel = new FacebookModel;
    if (isset($_GET) && $_GET != null) {
        $pageId=$_GET['psid'];
        if (isset($_GET['operacion']) && $_GET['operacion']='obtener_rangos_defecto') {
            $dateMaxFull = $SsgModel->getMaxDateFromFacebook($pageId);
            $dateMinFull = $SsgModel->getMinDateFromFacebook($pageId);
            $dateMax =  date('Y-m-d', strtotime($dateMaxFull));
            $dateMin = date('Y-m-d', strtotime($dateMax.' - 30 days'));
            $rangos_defecto = [
                'dateMinFull'=>$dateMinFull,
                'dateMaxFull'=>$dateMaxFull,
                'dateMax' =>$dateMax."T23:59:59",
                'dateMin' =>$dateMin."T00:00:00",
                ];
        }else{$rangos_defecto=[];}
        if (isset($_GET['operacion']) && $_GET['operacion']='obtener_tipos') {
            $kpisFace = $reportePostConsultoria->getKPIs('ssg_facebook');
        }else{$kpisFace=[];}
        if (isset($_GET['operacion']) && $_GET['operacion']='obtener_tipos') {
            $tipos = $SsgModel->getOptionsSsg('tipo',$pageId);
        }else{$tipos=[];}
        if (isset($_GET['operacion']) && $_GET['operacion']='obtener_objetivos') {
            $objetivos = $SsgModel->getOptionsSsg('objetivo',$pageId);
        }else{$objetivos=[];}
        echo json_encode([
            'rangos_defecto'=>$rangos_defecto,
            'tipos'=>$tipos,
            'objetivos'=>$objetivos,
            'kpisFace'=>$kpisFace,
        ]);
    }
    if (isset($_POST) && $_POST != null) {
        if (isset($_POST['operacion']) && $_POST['operacion']='traer_post') {
            $infoForm = $_POST['infoForm'];
            $pageId=$infoForm['psid'];
            $postBtnRange = $infoForm['daterange-btn'];
            $dateRange = explode(' | ',$postBtnRange);
            $dateMax = $dateRange[1]."T23:59:59";
            $dateMin = $dateRange[0]."T00:00:00";
            $tipos_objetivos_IN = "";
            if (isset($infoForm['tipos'])){
                $tiposSelect = $infoForm['tipos'];
                foreach ($tiposSelect as $tipo){
                    $tipos_objetivos_IN .= $tipo.",";
                }
            }
            if (isset($infoForm['objetivos'])){
                $objetivosSelect = $infoForm['objetivos'];
                foreach ($objetivosSelect as $objetivo){
                    $tipos_objetivos_IN .= $objetivo.",";
                } 
            }
            
            if ($tipos_objetivos_IN != ""){
                $tipos_objetivos_IN = rtrim($tipos_objetivos_IN,',');
            }
            $getPostByKpi = getOrderByKPI($infoForm['getPostByKpi'],$infoForm['top_down']);
            $orderby = getOrderByKPI($infoForm['orderby']);
            $paidUnPaid = $infoForm['paidUnPaid'];
            $filtrosAllParameters =[
                'pageId'=>$pageId,
                'dateMin'=>$dateMin,
                'dateMax'=>$dateMax,
                'tipos_objetivos_IN'=>$tipos_objetivos_IN,
                'getPostByKpi'=>$getPostByKpi,
                'orderby'=>$orderby,
                'paidUnPaid'=>$paidUnPaid,
            ];
            $postsAllParameters = $ssgTopReportModel->getPostsByAllParameters($filtrosAllParameters);//lo que estoy buscando especificamente
            $arregloIdPosts =  getArraySimple($postsAllParameters,'id');
            $idpost_NOT_IN = stringForIN($arregloIdPosts);
            $filtrosKpiCatalogacion = $filtrosAllParameters;
            $filtrosKpiCatalogacion['idpost_NOT_IN'] = rtrim($idpost_NOT_IN,',');
            $filtrosKpiCatalogacion['LIMIT'] = 18-count($postsAllParameters);// posts de comparacion
            $postsByKpiCatalogacion = $ssgTopReportModel->getPostsByKpiCatalogacion($filtrosKpiCatalogacion);
            $arregloIdPosts =  getArraySimple($postsByKpiCatalogacion,'id');
            $idpost_NOT_IN = stringForIN($arregloIdPosts);
            $filtrosRelleno = $filtrosKpiCatalogacion;
            $filtrosRelleno['idpost_NOT_IN'] .= ",".rtrim($idpost_NOT_IN,',');
            if (count($postsAllParameters)+count($postsByKpiCatalogacion)<18) {
                $filtros['LIMIT'] = 18-(count($postsAllParameters)+count($postsByKpiCatalogacion));// posts de relleno
                $postsRelleno = $ssgTopReportModel->getPostsRelleno($filtrosRelleno);
            }else{$postsRelleno=[];}

            $postsUnidosOrdenados = $ssgTopReportModel->unirOrdenarPosts($filtrosAllParameters,$filtrosKpiCatalogacion,$filtrosRelleno);
            //echo $filtrosKpiCatalogacion['idpost_NOT_IN']."-".$filtrosRelleno['idpost_NOT_IN'];exit;
            $data = [
                'postsAllParameters'=>$postsAllParameters,
                'postsByKpiCatalogacion'=>$postsByKpiCatalogacion,
                'postsRelleno'=>$postsRelleno,
                'postsUnidosOrdenados'=>$postsUnidosOrdenados,
            ];
            echo json_encode(
                $data
            );
        }
    }

    function getOrderByKPI($id_kpi,$formacion = 'DESC'){
        switch ($id_kpi) {
            case "fecha":
                $kpi = "created_time";
                break;
            case "39":
                $kpi = "(`shares`+`comments`+`reactions`+`post_video_views_unique`+`link_clicks`)";
                break;
            case "40":
                $kpi = "reactions";
                break;
            case "41":
                $kpi = "shares";
                break;
            case "42":
               $kpi = "comments";
                break;
            case "43":
               $kpi = "post_video_views_unique";
                break;
            case "44":
                $kpi = "link_clicks";
                break;
            case "45":
                $kpi = "reach";
                break;
            case "46":
                $kpi = "reach_paid";
                break;
            case "47":
                $kpi = "reach_organic";
                break;
            case "48":
                $kpi = "indice_interaccion";
                break;
            case "49":
                $kpi = "indice_interalcance";
                break;
            case "50":
                $kpi = "ad_spend";
                break;
            case "52":
                $kpi = "indice_interaccion_inversion";
                break;
            case "53":
                $kpi = "indice_interalcance_inversion";
                break;
            default:
               return '';
        }
        return "ORDER BY ".$kpi." ".$formacion;
    }

    function stringForIN($arreglo){
        $stringForIN = "";
        foreach ($arreglo as $elemento){
            $stringForIN .= "'".$elemento."',";
        }
        return $stringForIN;
    }
    
    function getArraySimple($arreglo,$clave){
        $arregloSimple = [];
        foreach ($arreglo as  $value) {
            array_push($arregloSimple, $value[$clave]);
        }
        return $arregloSimple;
    }
    