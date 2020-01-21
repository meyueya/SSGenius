<?php
//header('Content-Type: application/json');
date_default_timezone_set("America/Bogota");
include('model/SsgModel.php');
include('controller/funcionesFormat.php');
$SsgModel = new SsgModel;
$pageId = htmlspecialchars($_GET['psid']);
$checkPage = $SsgModel->checkPage($pageId);
$checkInfoPage = $SsgModel->checkInfoPage($pageId);
if (!$checkPage && !$checkInfoPage){
    echo "<div class='message-ssg-alert text-center'>";
    echo "<h3 class='card-title  ssg-wait-title'>A&ntilde;ada una p&aacute;gina y disfrute las ventajas de usar el SSG</h3>";
    //echo '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>';
    echo "</div>";
    exit();
}
$page = $SsgModel->getPage($pageId);
$dateMaxFull = $SsgModel->getMaxDateFromFacebook($pageId);
$dateMinFull = $SsgModel->getMinDateFromFacebook($pageId);
$tipos = $SsgModel->getOptionsSsg('tipo');
$objetivos = $SsgModel->getOptionsSsg('objetivo');
$nivelesLibertad = $SsgModel->getOptionsSsg('nivelLibertad');
$postTypes = $SsgModel->getTypesPosts();
$subquery = "";
if ($_POST)
{
    $postBtnRange = $_POST['daterange-btn'];
    $dateRange = explode(' | ',$postBtnRange);
    $dateMax = $dateRange[1];
    $dateMax = $dateMax."T23:59:59";
    $dateMin = $dateRange[0];
    $dateMin = $dateMin."T00:00:00";
    if (isset($_POST['tipos'])){
        $tiposSelect = $_POST['tipos'];
         foreach ($tiposSelect as $selectedOption){
            $subquery .= $selectedOption.",";
        }
    }
    if (isset($_POST['objetivos'])){
        $objetivosSelect = $_POST['objetivos'];
    foreach ($objetivosSelect as $selectedOption0){
        $subquery .= $selectedOption0.",";
        } 
    }
        if (isset($_POST['NivelesLibertad'])){
        $nivelesLibertadSelect = $_POST['NivelesLibertad'];
    foreach ($nivelesLibertadSelect as $selectedOptionN){
        $subquery .= $selectedOptionN.",";
        } 
    }
        if ($subquery != ""){
        $subquery = rtrim($subquery,',');
        }
} else {
    $dateMax = $SsgModel->getMaxDateFromFacebook($pageId);
    $dateMax =  date('Y-m-d', strtotime($dateMax));
    $dateMax = $dateMax."T23:59:59";
    $dateMin = date('Y-m-d', strtotime($dateMax.' - 30 days'));
    $dateMin = $dateMin."T00:00:00";
    //echo $dateMax;
}














$filtro = "";
$orderby = "";
 if (isset($_POST['orderby'])){
        $orderby = $_POST['orderby'];
        



         switch ($orderby) {
                    case "totalInteracciones":
                        $filtro = "totalInteracciones";
                        $nombrekpi =" totalInteracciones";
                        $key_arrayPost="totalInteracciones";
                        break;
                    case "reacciones":
                        $filtro = "reactions";
                        $nombrekpi =" Reacciones";
                        $key_arrayPost="reacciones";
                        break;
                    case "compartir":
                        $filtro = "shares";
                        $nombrekpi =" Compartir";
                        $key_arrayPost="compartir";
                        break;
                    case "comentario":
                        $filtro = "comments";
                        $nombrekpi =" Comentario";
                        $key_arrayPost="comentarios";
                        break;
                    case "vistasVideo":
                        $filtro = "post_video_views_unique";
                        $nombrekpi =" Reacciones";
                        $key_arrayPost="post_video_views_unique";
                        break;
                    case "clickLinks":
                        $filtro = "link_clicks";
                        $nombrekpi ="Click a Link";
                        $key_arrayPost="link_clicks";
                        break;
                    case "alcancetotal":
                        $filtro = "reach";
                        $nombrekpi =" Alcance Total";
                        $key_arrayPost="alcance";
                        break;
                    case "alcancepagado":
                        $filtro = "reach_paid";
                        $nombrekpi =" Alcance Pagado";
                        $key_arrayPost="alcance_pagado";
                        break;
                    case "alcanceorganico":
                        $filtro = "reach_organic";
                        $nombrekpi =" Alcance Organico";
                        $key_arrayPost="alcance_organico";
                        break;
                        
                    default:
                       $filtro = "";
                       $nombrekpi= "";
                       $key_arrayPost="";
                }



    }
    
$paidUnPaid = "";
 if (isset($_POST['paidUnPaid'])){
        $paidUnPaid = $_POST['paidUnPaid'];
    }
    
    $queryTypePost = "";
   if (isset($_POST['typePost'])){
        $typePost = $_POST['typePost'];
    foreach ($typePost as $tipoPost){
        $queryTypePost .= "'".$tipoPost."',";
        } 
    }
 if ($queryTypePost != ""){
        $queryTypePost = rtrim($queryTypePost,',');
        }
        //echo $queryTypePost;
        //exit();
/*$postOfFacebookPage = $SsgModel->getPostsOfFacebookPageAndTypes($pageId,$dateMin,$dateMax,$subquery);  
echo $postOfFacebookPage;
exit();*/
//echo $subquery;
if ($subquery != ""){
    $postOfFacebookPage = $SsgModel->getPostsOfFacebookPageAndTypes($pageId,$dateMin,$dateMax,$paidUnPaid,$queryTypePost,$subquery,$orderby);  

} else {
 $postOfFacebookPage = $SsgModel->getPostsOfFacebookPage($pageId,$dateMin,$dateMax,$paidUnPaid,$queryTypePost,$orderby);   
}
 // print_r($postOfFacebookPage);
//exit();
$indiceInteraccionData = "";
$indiceInteraccionDataRound = "";
$indiceInteraccionRound = "";
$indiceInteralcanceData = "";
$indiceInteralcanceDataRound = "";
$indiceInteralcanceRound = "";
$indiceInteraccionInversionData = "";
$indiceInteraccionInversionDataRound = "";
$indiceInteraccionInversionRound = "";
$indice_interalcance_inversionData = "";
$indice_interalcance_inversionDataRound = "";
$indice_interalcance_inversionRound = "";
$indice_kpi_inversionRound = "";
$indice_kpi = "";
$reaccionesData = "";
$sharesData = "";
$commentsData = "";
$post_video_views_uniqueData = "";
$link_clicksData = "";
$alcanceData = "";
$inversionData = "";
$count = "";
$kpiData = "";
$kpi= "";
$arrayPost = Array();
$c = 0;

$indice_kpi_inversion = "";

$indice_kpi = "";
$indice_kpi_Round = "";
$indice_kpi_alcance_Round = "";
$indice_kpi_inversion_Round = "";
 /*echo"<pre>";
var_dump($postOfFacebookPage);
echo"</pre>"; */
if (count($postOfFacebookPage) == 0) {
    //echo count ($postOfFacebookPage);
    echo "<div class='message-ssg-alert text-center'>";
    echo "<center><h3 class='card-title ssg-wait-title'>Estamos sincronizando su informaci&oacute;n </h3></center>";
    echo '<center><div class="lds-ring"><div></div><div></div><div></div><div></div></div></center>';
    echo "</div>";
    exit(); 
}
foreach ($postOfFacebookPage as $post)
    {
        $c++;
        $inversion = 0;
        $reach_paid = 0;
        $ad_ids = $SsgModel->getIdAdFacebook($post['id']);
        if (count($ad_ids) > 0){
       /* foreach ($ad_ids as $ad_id)
            {
                $inversion += $SsgModel->getTotalSpendFacebookAd($ad_id['ad_id']);
            }*/
        foreach ($ad_ids as $ad_id)
            {
                $reach_paid += $SsgModel->getTotalReachFacebookAd($ad_id['ad_id']);
            }
        }

        if($filtro=='interacciones_totales'){
           $kpi = $post['shares']+$post['comments']+$post['reactions']+$post['post_video_views_unique']+$post['link_clicks'];
        }
        else if($filtro!='interacciones' && $filtro!=''){
             $kpi = $post[$filtro];

        }
        else{ $kpi = '';}
        //$inversion = round($inversion/0.55, 2);
        $inversion = $post['inversion'];
        //$inversion  == "0" ? $inversion = 0 : $inversion = $inversion->inversion;
        //echo '<span style="color:red;>'.$inversion->inversion.'</span><br>';
        $reacciones = $post['reactions'];
        $shares = $post['shares']; 
        $post['shares'] == "" ? $shares = 0 : $shares = $post['shares'];
        $comments = $post['comments'];
        $post_video_views_unique = $post['post_video_views_unique'];
        $post['link_clicks'] == "" ? $link_clicks = 0 : $link_clicks = $post['link_clicks'];
        $alcance = $post['reach'];
         if (($reach_paid != "") && ($reach_paid > 0)){
        $alcance_pagado = $reach_paid;
        } else {
            $alcance_pagado = $post['reach_paid'];
        }
        $alcance_organico = $post['reach_organic'];
        $interacciones_totales = $reacciones + $shares + $comments + $post_video_views_unique + $link_clicks;
        $fecha = explode('T',$post['created_time']);
        $postsDay = $SsgModel->getCountPostsBetweenDates($pageId,$fecha[0]."T00:00:00",$fecha[0]."T23:59:59");
        $picture = $post['picture'];
        $message = $post['message'];
        //$fansPage = $SsgModel->getFansOfFacebookFanPage($post['page_id'],$fecha[0]);
        if ($post['page_fans'] > 0){

        $indice_kpi = number_format((float)(($kpi/$post['page_fans']) * 1000), 2, '.', '');
        $fanstotales = $post['page_fans'];

        } else { $fanstotales = 0; $indice_kpi =0;}
        $indiceInteraccion = $post['indice_interaccion'];
        if ($alcance > 0){
        //$indiceInteralcance = number_format((float)(($indiceInteraccion/$alcance) * 10000), 2, '.', '');
            $indice_kpi_alcance = number_format((float)(($indice_kpi/$post['page_fans']) * 10000), 2, '.', '');
        } else { $indiceInteralcance = 0; $indice_kpi_alcance=0;}
        $indiceInteralcance = $post['indice_interalcance'];
        if ($inversion > 0){
        $indiceInteraccionInversion = number_format((float)(($indiceInteraccion / $inversion) * 100), 2, '.', '');
         $indice_kpi_inversion = number_format((float)(($indice_kpi / $inversion) * 100), 2, '.', '');
        } else {$indiceInteraccionInversion = 0; $indice_kpi_inversion=0;}
         if ($inversion > 0){
        $indice_interalcance_inversion = number_format((float)(($indiceInteralcance / $inversion)* 100), 2, '.', '');
         } else {$indice_interalcance_inversion = 0;}
        $tipo = $SsgModel->getTypeFromFacebookPost($post['id'],'tipo');
        if ($tipo){
            $nombreTipo = "";
                foreach ($tipo as $types){
                    $nombreTipo .= $types['nombre'].", ";
                    }
            $arrayPost[$c]['tipo'] = rtrim($nombreTipo,', ');        
               }
        $objetivo = $SsgModel->getTypeFromFacebookPost($post['id'],'objetivo');
        if ($objetivo){
            $nombreObjetivo = "";
                foreach ($objetivo as $typesO){
                    $nombreObjetivo .= $typesO['nombre'].", ";
                    }
            $arrayPost[$c]['objetivo'] = rtrim($nombreObjetivo,', ');             
               }    
        $nivelLibertad = $SsgModel->getTypeFromFacebookPost($post['id'],'nivelLibertad');
        if ($nivelLibertad){
            $nombreNivelLibertad = "";
                foreach ($nivelLibertad as $typesL){
                    $nombreNivelLibertad .= $typesL['nombre'].", ";
                    }
            $arrayPost[$c]['nivelLibertad'] = rtrim($nombreNivelLibertad,', ');        
               }       
        $indiceInteraccionData .= $indiceInteraccion .",";
        if ($indiceInteraccion >= 100){ $indiceInteraccionRound = ($indiceInteraccion / 100);} else if($indiceInteraccion >= 10){ $indiceInteraccionRound = ($indiceInteraccion / 10); } else {$indiceInteraccionRound = $indiceInteraccion; }
        $indiceInteraccionDataRound .= $indiceInteraccionRound .",";
        $indiceInteralcanceData .= $indiceInteralcance .",";
        if ($indiceInteralcance >= 100){ $indiceInteralcanceRound = ($indiceInteralcance / 100);} else if($indiceInteralcance >= 10){ $indiceInteralcanceRound = ($indiceInteralcance / 10); } else {$indiceInteralcanceRound = $indiceInteralcance; }
        $indiceInteralcanceDataRound .= $indiceInteralcanceRound .",";
        $indiceInteraccionInversionData .= $indiceInteraccionInversion .",";
        if ($indiceInteraccionInversion >= 100){ $indiceInteraccionInversionRound = ($indiceInteraccionInversion / 100);} else if($indiceInteraccionInversion >= 10){ $indiceInteraccionInversionRound = ($indiceInteraccionInversion / 10); } else {$indiceInteraccionInversionRound = $indiceInteraccionInversion; }
        $indiceInteraccionInversionDataRound .= $indiceInteraccionInversionRound .",";
        $indice_interalcance_inversionData .= $indice_interalcance_inversion .",";
        if ($indice_interalcance_inversion >= 100){ $indice_interalcance_inversionRound = ($indice_interalcance_inversion / 100);} else if($indice_interalcance_inversion >= 10){ $indice_interalcance_inversionRound = ($indice_interalcance_inversion / 10); } else { $indice_interalcance_inversionRound = $indice_interalcance_inversion; }
        $indice_interalcance_inversionDataRound .= $indice_interalcance_inversionRound .",";
        $reaccionesData .= "{
            date: '".$fecha[0]."',
            y: ".$reacciones.",
            img: '".$picture."'
        },";

        
        
        

        if ($indice_kpi >= 100){ $indice_kpi = ($indice_kpi / 100);} else if($indice_kpi >= 10){ $indice_kpi = ($indice_kpi / 10); } else {$indice_kpi = $indice_kpi; }
        $indice_kpi_Round .= $indice_kpi.",";

        if ($indice_kpi_alcance >= 100){ $indice_kpi_alcance = ($indice_kpi_alcance / 100);} else if($indice_kpi_alcance >= 10){ $indice_kpi_alcance = ($indice_kpi_alcance / 10); } else {$indice_kpi_alcance = $indice_kpi_alcance; }
        $indice_kpi_alcance_Round .= $indice_kpi_alcance.",";

        if ($indice_kpi_inversion >= 100){ $indice_kpi_inversion = ($indice_kpi_inversion / 100);} else if($indice_kpi_inversion >= 10){ $indice_kpi_inversion = ($indice_kpi_inversion / 10); } else {$indice_kpi_inversion = $indice_kpi_inversion; }
        $indice_kpi_inversion_Round .= $indice_kpi_inversion.","; 


        $kpiData .= $kpi .",";
        $sharesData .= $shares .",";
        $commentsData .= $comments .",";
        $post_video_views_uniqueData .= $post_video_views_unique .",";
        $link_clicksData .= $link_clicks .",";
        $alcanceData .= $alcance .",";
        $inversionData .= $inversion .",";
        $count .= $c .",";
        $fechaPost = "";
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fechaPost =  date('d', formatZonaHoraria($post['created_time']))." de ".$meses[date('n', formatZonaHoraria($post['created_time']))-1]. " del ".date('Y', formatZonaHoraria($post['created_time']))." a las " . date("H:i", formatZonaHoraria($post['created_time']));
        
        $arrayPost[$c]['id'] = $post['id'];
        $arrayPost[$c]['page_name'] = $page->name;
        $arrayPost[$c]['page_picture'] = "https://graph.facebook.com/".$page->id_facebook_page."/picture";
        $arrayPost[$c]['fecha_post'] =$fechaPost;
        $arrayPost[$c]['fecha'] = date("Y-m-d", formatZonaHoraria($post['created_time']));
        $arrayPost[$c]['hora'] = date("H:i", formatZonaHoraria($post['created_time']));
        $arrayPost[$c]['dia_semana'] =diaSpanish(date("w",formatZonaHoraria($post['created_time'])));
        $arrayPost[$c]['link'] = $post['permalink_url'];
        $arrayPost[$c]['picture'] = $picture;
        $arrayPost[$c]['message'] = $message;
        $arrayPost[$c]['postsDay'] = $postsDay->count;
        $arrayPost[$c]['fanspage'] = $fanstotales;
        $arrayPost[$c]['alcance'] = $alcance;
        $arrayPost[$c]['alcance_pagado'] = $alcance_pagado;
        $arrayPost[$c]['alcance_organico'] = $alcance_organico;
        $arrayPost[$c]['comentarios'] = $comments;
        $arrayPost[$c]['reacciones'] = $reacciones;
        $arrayPost[$c]['compartir'] = $shares;
        $arrayPost[$c]['link_clicks'] = $link_clicks;
        $arrayPost[$c]['post_video_views_unique'] = $post['post_video_views_unique'];
        $arrayPost[$c]['interacciones_totales'] = $post['post_video_views_unique']+$link_clicks+$shares+$reacciones+$comments;
        $arrayPost[$c]['inversion'] = $inversion;
        $arrayPost[$c]['indice_interaccion'] = $indiceInteraccion;
        $arrayPost[$c]['indice_inter_alcance'] = $indiceInteralcance;
        $arrayPost[$c]['indice_interaccion_inversion'] = $indiceInteraccionInversion;
        $arrayPost[$c]['indice_inter_alcance_inversion'] = $indice_interalcance_inversion;
        $arrayPost[$c]['filtro'] = $key_arrayPost;
        $arrayPost[$c]['nombrekpi'] = $nombrekpi;
        $arrayPost[$c]['indice_kpi'] = $indice_kpi;
        $arrayPost[$c]['indice_kpi_alcance'] = $indice_kpi_alcance;
        $arrayPost[$c]['indice_kpi_inversion'] = $indice_kpi_inversion; 
        $arrayPost[$c]['costo_interacciones_totales'] = round($inversion/($post['post_video_views_unique']+$link_clicks+$shares+$reacciones+$comments),6);
        $arrayPost[$c]['costo_reacciones'] = round($inversion/$reacciones,6); 
        $arrayPost[$c]['costo_compartir'] = round($inversion/$shares,6); 
        $arrayPost[$c]['costo_comentarios'] = round($inversion/$comments,6); 
        $arrayPost[$c]['costo_post_video_views_unique'] = round($inversion/$post['post_video_views_unique'],6); 
        $arrayPost[$c]['costo_link_clicks'] = round($inversion/$link_clicks,6); 
        $arrayPost[$c]['costo_alcance'] = round($inversion/$alcance,6); 
        $arrayPost[$c]['costo_alcance_pagado'] = round($inversion/$alcance_pagado,6); 
        $arrayPost[$c]['costo_alcance_organico'] = round($inversion/$alcance_organico,6); 
    }
    $arrayDataIds = json_encode($arrayPost);
    //echo $arrayDataIds;