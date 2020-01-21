<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //header('Content-Type: application/json');
    date_default_timezone_set("America/Bogota");
    include('../../model/AiwFacebookDemograficoModel.php'); 
    
    $aiwFacebookDemograficoModel = new AiwFacebookDemograficoModel;
    if (isset($_GET) && $_GET != null) {
        $pageId=$_GET['psid']; 
        if (isset($_GET['operacion']) && $_GET['operacion']='obtener_rangos_defecto') {
            $dateMax =  date("Y-m-d");
            $dateMin = date('Y-m-d', strtotime($dateMax.' - 30 days'));
            $rangos_defecto = [
                'dateMax' =>$dateMax."T23:59:59",
                'dateMin' =>$dateMin."T00:00:00",
                ];
        }else{$rangos_defecto=[];}
        echo json_encode([
            'rangos_defecto'=>$rangos_defecto,
        ]);
    }
    
    if (isset($_POST) && $_POST != null) {
        if (isset($_POST['operacion']) && $_POST['operacion']='traer_info_demografico_face') {
            $infoForm = $_POST['infoForm'];
            $pageId=$infoForm['psid'];
            $postBtnRange = $infoForm['daterange-btn'];
            $dateRange = explode(' | ',$postBtnRange);
            $dateMax = $dateRange[1];
            $dateMin = $dateRange[0];
            $filtros =[
                'anuncio'=>$infoForm['anuncio'],
                'camp'=>$infoForm['camp'],
                'dateMin'=>$dateMin,
                'dateMax'=>$dateMax,
                'psid'=>$pageId,
            ];
            $infoFaceDemografico = $aiwFacebookDemograficoModel->getInfoFaceDEmografico($filtros);
            $data = [
                'infoFaceDemografico'=>$infoFaceDemografico,
            ];
            echo json_encode($data);

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
    