<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //header('Content-Type: application/json'); 
    date_default_timezone_set("America/Bogota"); 
    include('../../model/ReportImpactInvestmentPageModel.php'); 

    define('LIMITADOR_DIAS',31);
    define('LIMITADOR_SEMANAS',31);
    define('LIMITADOR_MESES',24);
    $reportImpactInvestmentPageModel = new ReportImpactInvestmentPageModel;
    if (isset($_POST) && $_POST !=null){
      $infoForm = $_POST['infoForm'];
      define('INDICADOR',$infoForm['indicador']);
      $desdehasta= explode(" - ", $infoForm['daterange_fecha']);
      $page_id=$infoForm['page_id'];
      $account_id=$infoForm['account_id'];
      $array_objective=(isset($infoForm['objective']))?$infoForm['objective']:[];
      $indicador=get_string_select_indicador(INDICADOR);
      $desde=date("Y-m-d",strtotime($desdehasta[0]));
      $hasta=date("Y-m-d",strtotime($desdehasta[1]));
      $filtros=[
          'page_id'=>$page_id,
          'account_id'=>$account_id,
          'desde'=>$desde,
          'hasta'=>$hasta,
          'indicador'=>$indicador,
      ];

      $infoPautaPage = get_info_pauta_page($array_objective,$filtros,$infoForm['agrupar_por']);
      $array_fecha_menor=[];
      foreach ($infoPautaPage as $key => $value) {
        if (isset($value[0])) {
          array_push($array_fecha_menor,$value[0]);
        }
      }

      if (in_array(INDICADOR,['page_impressions_unique','clics','page_impressions','page_fans','comments'])) {
        $column = 'end_time';
        $filtros['agrupar_por']=get_agrupar_por($infoForm['agrupar_por'],$column);
        $infoPage=$reportImpactInvestmentPageModel->getInfoPage_ssg_page_fans_facebook($filtros);
      }
      if (in_array(INDICADOR,['post_video_views_unique'])) {
        $column = 'created_time';
        $filtros['agrupar_por']=get_agrupar_por($infoForm['agrupar_por'],$column);
        $infoPage=$reportImpactInvestmentPageModel->getInfoPage_ssg_post_page_facebook($filtros);
        $infoPage=$reportImpactInvestmentPageModel->getInfoPage_ssg_post_page_facebook($filtros);
      }
      if (in_array(INDICADOR,['interactions','link_clicks','reactions'])) {
        $column = 'fecha_historico';
        $filtros['agrupar_por']=get_agrupar_por($infoForm['agrupar_por'],$column);
        $infoPage=$reportImpactInvestmentPageModel->getInfoPage_ssg_historico_post_page_facebook($filtros);
      }
      array_push($array_fecha_menor,$infoPage[0]);
      $menor_fecha =get_menor_dia_semana_mes($array_fecha_menor);
      $infoPageCompleto=rellenar_espacios_vacios($infoForm['agrupar_por'],$infoForm["cantidad_escogida"],$menor_fecha,$infoPage,INDICADOR);
      //echo json_encode($infoPageCompleto[0][INDICADOR]);exit;
      if (in_array(INDICADOR,['interactions','link_clicks','reactions'])) {
        $arrayValores=[];
        foreach ($infoPageCompleto as $key => $value) {
          $totalAccionHastaLaActualidad = ($value[INDICADOR])?floatval($value[INDICADOR]):floatval(0);
          $totalAccionHastaUndiaAntes = ($key == 0)?floatval(0):($infoPageCompleto[$key-1][INDICADOR])?floatval($infoPageCompleto[$key-1][INDICADOR]):floatval(0);
          $accionesUnDia = ($totalAccionHastaLaActualidad>$totalAccionHastaUndiaAntes)?$totalAccionHastaLaActualidad-$totalAccionHastaUndiaAntes:floatval(0);
          array_push($arrayValores,
          [
            INDICADOR=>$accionesUnDia,
            'anio'=>$value['anio'],
            'mes'=>$value['mes'],
            'semana'=>$value['semana'],
            'dia'=>$value['dia'],
          ]
          );
        }
        $infoPageCompleto=$arrayValores;
      }
      $infoPautaPageCompleto=[];
      foreach ($infoPautaPage as $key => $value) {
        $infoPautaPageCompleto[$key]=rellenar_espacios_vacios($infoForm['agrupar_por'],$infoForm["cantidad_escogida"],$menor_fecha,$value);
      }
      $kpiPagadoCompleto=[];
      $kpiOrganicoCompleto=[];
      if (in_array(INDICADOR,['page_impressions_unique','clics','link_clicks','page_impressions','post_video_views_unique'])) {//indicadores con informacion de pauta
        //kpi pagado
        $filtros['agrupar_por']=get_agrupar_por($infoForm['agrupar_por'],'date_stop');
        $filtros['indicador']=get_string_select_indicador_pagado(INDICADOR);
        $filtros['objective']=get_string_for_IN($array_objective);
        $kpiPagado=$reportImpactInvestmentPageModel->getInfoPage_aiw_facebook_data_ads_indicador($filtros);
        $kpiPagadoCompleto=rellenar_espacios_vacios($infoForm['agrupar_por'],$infoForm["cantidad_escogida"],$menor_fecha,$kpiPagado,INDICADOR);

        //kpi organico pagado menos total
        $kpiOrganicoCompleto = array_map(function($total,$pagado){
          $organico=$total[INDICADOR]-$pagado[INDICADOR];
          return[
            INDICADOR=>$organico,
            'anio'=>$total['anio'],
            'mes'=>$total['mes'],
            'semana'=>$total['semana'],
            'dia'=>$total['dia'],
          ];
        },$infoPageCompleto,$kpiPagadoCompleto);
      }

      echo json_encode([
          'infoPage'=>$infoPageCompleto,
          'infoPautaPage'=>$infoPautaPageCompleto,
          'kpiPagado'=>$kpiPagadoCompleto,
          'kpiorganico'=>$kpiOrganicoCompleto,
      ]);
    }
    
    function get_agrupar_por($agrupar_por,$column){
        switch($agrupar_por){
            case'dias':
              $query="month(`$column`),DAY(`$column`) LIMIT ".LIMITADOR_DIAS;
                break;
            case'semanas':
              $query="WEEK(`$column`) LIMIT ".LIMITADOR_SEMANAS;  
                break;
            case'meses':
              $query="month(`$column`) LIMIT ".LIMITADOR_MESES;  
                break;
            default:
                return "";
        }
        return "GROUP BY  YEAR(`$column`),".$query;
    }
    
    function get_string_select_indicador($indicador){
        switch($indicador){
            case'page_impressions':
              $query="SUM(page_impressions) as page_impressions";
                break;
            case'clics':
              $query="SUM(clics) as clics";  
                break;
            case'page_fans':
              $query="MAX(`page_fans`) as page_fans";  
                break;
            case'comments':
              $query="MAX(`comments`) as comments";  
                break;
            case'page_impressions_unique':
              $query="SUM(`page_impressions_unique`) as page_impressions_unique";  
                break;
            case'interactions':
              $query="SUM(`comments`+`link_clicks`+`shares`+`reactions`) AS interactions ---- MAX(`comments`) AS comments,MAX(`link_clicks`) AS link_clicks,MAX(`shares`) AS shares,MAX(`reactions`) AS reactions";  
                break;
            case'reactions':
              $query="SUM(`reactions`) AS reactions ---- MAX(`reactions`) AS reactions";  
                break;
            case'link_clicks':
              $query="SUM(`link_clicks`) AS link_clicks ---- MAX(`link_clicks`) AS link_clicks";
                break;
            case'post_video_views_unique':
              $query="SUM(`post_video_views_unique`) AS post_video_views_unique";  
                break;
            case'':
              $query="";  
                break;
            default:
                return "";
        }
        return $query;
    }

    function get_string_select_indicador_pagado($indicador){
        switch($indicador){
            case'page_impressions':
              $query="SUM(impressions) as page_impressions";
                break;
            case'clics':
              $query="SUM(clicks) as clics";  
                break;
            case'page_fans':
              $query="SUM(clicks) as page_fans";//"MAX(`page_fans`) as page_fans";  //falta page_fans
                break;
            case'comments':
              $query="SUM(clicks) as comments";//"MAX(`comments`) as comments";  //falta comments
                break;
            case'page_impressions_unique':
              $query="SUM(`reach`) as page_impressions_unique";  
                break;
            case'interactions':
              $query="SUM(clicks) as interactions";//"SUM(`inline_link_clicks`+`shares`+`reactions`) AS interactions";  //falta comments,shares,reactions
                break;
            case'reactions':
              $query="SUM(clicks) as reactions";;//"SUM(`reactions`) AS reactions";  //falta reactions
                break;
            case'link_clicks':
              $query="SUM(`inline_link_clicks`) AS link_clicks";  
                break;
            case'post_video_views_unique':
              $query="SUM(`video_p25_watched_video_view`) AS post_video_views_unique";  
                break;
            case'':
              $query="";  
                break;
            default:
                return "";
        }
        return $query;
    }

    function rellenar_espacios_vacios($agrupar_por,$cant_max,$menor_fecha,$arreglo,$indicador=null){
      //se hace para que los meses semanas dias coincidan al presentar en las graficas
      switch($agrupar_por){
        case'dias':
          $arreglo_completo = rellenar_espacios_vacios_dias($cant_max,$menor_fecha,$arreglo,$indicador);
            break;
        case'semanas':
          $arreglo_completo = rellenar_espacios_vacios_semanas($cant_max,$menor_fecha,$arreglo,$indicador);
            break;
        case'meses':
          $arreglo_completo = rellenar_espacios_vacios_meses($cant_max,$menor_fecha,$arreglo,$indicador);
            break;
      }
      return $arreglo_completo;
    }
    
    function rellenar_espacios_vacios_meses($cant_max,$menor_fecha,$arreglo,$indicador=null){
      $cant_max = ($cant_max>=LIMITADOR_MESES)? LIMITADOR_MESES:$cant_max;
      $tamanio_array= obtener_tamanio_arreglo_mes($cant_max,$menor_fecha['mes']);
      $indicador=($indicador)?$indicador:'spend';
      $arreglo_completo=[];
      foreach ($tamanio_array as $key => $mes) {
        $tiene = false;
        foreach ($arreglo as  $info_arreglo) {
          if ($info_arreglo["anio"]==$menor_fecha['anio'] && $info_arreglo['mes']==$mes) {
            array_push($arreglo_completo,$info_arreglo);
            $tiene = true;
            break;
          }
        }
        if(!$tiene){
          array_push($arreglo_completo,[
          "$indicador"=>0,
          "anio"=>$menor_fecha['anio'],
          "mes"=>$mes,
          "semana"=>null,
          "dia"=>null,
          ]);
        }
        if($mes==12){
          $menor_fecha['anio']++;
        }
      }
      return $arreglo_completo;
    }

    function rellenar_espacios_vacios_semanas($cant_max,$menor_fecha,$arreglo,$indicador=null){
      $cant_max = ($cant_max>=LIMITADOR_SEMANAS)? LIMITADOR_SEMANAS:$cant_max;
      $tamanio_array= obtener_tamanio_arreglo_semana($cant_max,$menor_fecha['semana']);
      $indicador=($indicador)?$indicador:'spend';
      $arreglo_completo=[];
      foreach ($tamanio_array as $key => $semana) {
        $tiene = false;
        foreach ($arreglo as  $info_arreglo) {
          if ($info_arreglo["anio"]==$menor_fecha['anio'] && $info_arreglo['semana']==$semana) {
            array_push($arreglo_completo,$info_arreglo);
            $tiene = true;
            break;
          }
        }
        if(!$tiene){
          array_push($arreglo_completo,[
          "$indicador"=>0,
          "anio"=>$menor_fecha['anio'],
          "mes"=>null,
          "semana"=>$semana,
          "dia"=>null,
          ]);
        }
        if($semana==52){
          $menor_fecha['anio']++;
        }
      }
      return $arreglo_completo;
    }

    function rellenar_espacios_vacios_dias($cant_max,$menor_fecha,$arreglo,$indicador=null){
      $cambioMes=1;
      $dias_en_el_mes = cal_days_in_month(CAL_GREGORIAN, $menor_fecha['mes'], $menor_fecha['anio']);
      $cant_max = ($cant_max>=LIMITADOR_DIAS)? LIMITADOR_DIAS:$cant_max;
      $tamanio_array= obtener_tamanio_arreglo_dia($cant_max,$menor_fecha);
      $indicador=($indicador)?$indicador:'spend';
      $arreglo_completo=[];
      foreach ($tamanio_array as $key => $dia) {
        $tiene = false;
        foreach ($arreglo as  $info_arreglo) {
          if ($info_arreglo["anio"]==$menor_fecha['anio'] && $info_arreglo["mes"]==$menor_fecha['mes'] && $info_arreglo['dia']==$dia) {
            array_push($arreglo_completo,$info_arreglo);
            $tiene = true;
            break;
          }
        }
        if(!$tiene){
          array_push($arreglo_completo,[
          "$indicador"=>0,
          "anio"=>$menor_fecha['anio'],
          "mes"=>$menor_fecha['mes'],
          "semana"=>null,
          "dia"=>$dia,
          ]);
        }
        if ($dia==$dias_en_el_mes && $menor_fecha['mes']!=12){
          $menor_fecha['mes']++;
          $dias_en_el_mes = cal_days_in_month(CAL_GREGORIAN, $menor_fecha['mes'], $menor_fecha['anio']);
        }elseif ($dia==$dias_en_el_mes && $menor_fecha['mes']==12) {
          $menor_fecha['anio']++;
          $dias_en_el_mes = cal_days_in_month(CAL_GREGORIAN, $cambioMes, $menor_fecha['anio']);
          $cambioMes++;
        }
      }
      return $arreglo_completo;
    }

    function get_menor_dia_semana_mes($arreglo){
      $anio=$arreglo[0]['anio'];
      $mes=$arreglo[0]['mes'];
      $semana=$arreglo[0]['semana'];
      $dia=$arreglo[0]['dia'];
      foreach ($arreglo as $key => $value) {
        if($value['anio']<$anio){
          $anio = $value['anio'];
        }
        if($value['anio']==$anio && $value['mes']<$mes){
          $mes = $value['mes'];
          $dia = $value['dia'];
        }
        if($value['anio']==$anio && $value['semana']<$semana){
          $semana = $value['semana'];
        }
      }
      return [
        'anio'=>$anio,
        'mes'=>$mes,
        'semana'=>$semana,
        'dia'=>$dia,
      ];
    }

    function obtener_tamanio_arreglo_mes($cant_max,$mes_inicial){
      $nuevoArreglo=[];
      $contador=1;
      $contador2=1;
      for ($i=0; $i < $cant_max ; $i++) { 
        if ($mes_inicial+$i<=12) {
          array_push($nuevoArreglo,$mes_inicial+$i);
        } else {
          if ($contador<=12) {
            array_push($nuevoArreglo,$contador);
          }else {
            array_push($nuevoArreglo,$contador2);
            $contador2++;
          }
          $contador++;
        }
      }
      return $nuevoArreglo;
    }

    function obtener_tamanio_arreglo_semana($cant_max,$semana_inicial){
      $nuevoArreglo=[];
      $contador=0;
      for ($i=0; $i < $cant_max ; $i++) { 
        if ($semana_inicial+$i<=52) {
          array_push($nuevoArreglo,$semana_inicial+$i);
        } else {
            array_push($nuevoArreglo,$contador);
          $contador++;
        }
      }
      return $nuevoArreglo;
    }

    function obtener_tamanio_arreglo_dia($cant_max,$menor_fecha){
      $nuevoArreglo=[];
      $primerMEs=1;
      $contador=1;
      $contador2=1;
      $dias_en_el_mes = cal_days_in_month(CAL_GREGORIAN, $menor_fecha['mes'], $menor_fecha['anio']);
      for ($i=0; $i < $cant_max ; $i++) {
        $dia_a_agregar=$menor_fecha['dia']+$i;
        if ($dia_a_agregar<=$dias_en_el_mes) {
          array_push($nuevoArreglo,$dia_a_agregar);
        } else {
          if ($contador<=$dias_en_el_mes) {
            array_push($nuevoArreglo,$contador);
          }else {
            array_push($nuevoArreglo,$contador2);
            $contador2++;
          }
          $contador++;
        }
        if ($dia_a_agregar==$dias_en_el_mes && $menor_fecha['mes']!=12){
          $dias_en_el_mes = cal_days_in_month(CAL_GREGORIAN, $menor_fecha['mes']+1, $menor_fecha['anio']);
        }elseif ($dia_a_agregar==$dias_en_el_mes && $menor_fecha['mes']==12) {
          $dias_en_el_mes = cal_days_in_month(CAL_GREGORIAN, $primerMEs, $menor_fecha['anio']+1);
          $primerMEs++;
        }
      }
      return $nuevoArreglo;
    }

    function get_info_pauta_page($array_objective,$array_filtros,$agrupar_por){
      $infoPautaPage=[];
      foreach ($array_objective as $key => $objective) {
        $reportImpactInvestmentPageModel = new ReportImpactInvestmentPageModel;
        $info=$reportImpactInvestmentPageModel->getInfoPage_aiw_facebook_data_ads([
          'account_id'=>$array_filtros['account_id'],
          'desde'=>$array_filtros['desde'],
          'hasta'=>$array_filtros['hasta'],
          'objective'=>$objective,
          'agrupar_por'=>get_agrupar_por($agrupar_por,'date_stop'),
        ]);
        $infoPautaPage[$objective]=$info;
      }
      return $infoPautaPage;
    }

    function get_string_for_IN($arreglo){
      $stringForIN = "";
      foreach ($arreglo as $elemento){
          $stringForIN .= "'".$elemento."',";
      }
      $stringForIN = rtrim($stringForIN,',');
      return $stringForIN;
  }