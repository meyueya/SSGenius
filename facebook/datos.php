<?php

// Este es el archivo que saca los datos de la BD para graficosfacebook.php
header('Content-Type: application/json');
//$pdo=new PDO("mysql:dbname=ssgenius_app;host=localhost","ssgenius_55g","$?sqnuk,=;RT");
include 'conec.php';
require_once("model/Database.php");
$pdo = Database::getInstance();

$desdehasta = explode(" - ", $_POST['fecha']);
$id_page = $_POST['id_page'];
$desde = date("Y-m-d", strtotime($desdehasta[0]));
$hasta = date("Y-m-d", strtotime($desdehasta[1]));
if ($_POST['periodo'] == 'a') {
    $a = "month(`end_time`) as z, DAY(`end_time`) as d,";
    $b = "GROUP BY year(`end_time`), month(`end_time`),DAY(`end_time`) LIMIT 31";
    $b1 = "GROUP BY year(`end_time`), month(`end_time`),DAY(`end_time`) LIMIT 7";
    $c = "month(`created_time`) as z, DAY(`created_time`) as d,";
    $d = "GROUP BY year(`created_time`), month(`created_time`),DAY(`created_time`) LIMIT 31";
    $f = "DAY(`fecha_registro`) as d,";
    $g = "GROUP BY month(`fecha_registro`), DAY(`fecha_registro`) LIMIT 31";
    $h = "LIMIT 31";
    $i = "month(`date_start`) as z, DAY(`date_start`) as dd,";
    $j = "GROUP BY year(`date_start`), month(`date_start`),DAY(`date_start`) LIMIT 31";
}

if ($_POST['periodo'] == 'b') {
    $a = "YEAR(`end_time`) as z, WEEK(`end_time`) as d,";
    $b = "GROUP BY  YEAR(`end_time`),WEEK(`end_time`) LIMIT 12";
    $c = "YEAR(`created_time`) as z, WEEK(`created_time`) as d,";
    $d = "GROUP BY  YEAR(`created_time`),WEEK(`created_time`) LIMIT 12";
    $f = "WEEK(`fecha_registro`) as d,";
    $g = "GROUP BY week(fecha_registro) LIMIT 12";
    $h = "LIMIT 12";
    $i = "YEAR(`date_start`) as z, WEEK(`date_start`) as dd,";
    $j = "GROUP BY  YEAR(`date_start`),WEEK(`date_start`) LIMIT 12";
}

if ($_POST['periodo'] == 'c') {
    $a = "YEAR(`end_time`) as z, month(`end_time`) as d,";
    $b = "GROUP BY  YEAR(`end_time`),month(`end_time`) LIMIT 12";
    $c = "YEAR(`created_time`) as z, month(`created_time`) as d,";
    $d = "GROUP BY  YEAR(`created_time`),month(`created_time`) LIMIT 12";
    $f = "month(`fecha_registro`) as d,";
    $g = "GROUP BY month(`fecha_registro`) LIMIT 12";
    $h = "LIMIT 12";
    $i = "YEAR(`date_start`) as z, month(`date_start`) as dd,";
    $j = "GROUP BY  YEAR(`date_start`),month(`date_start`) LIMIT 12";
}

switch ($_POST['ordenby']) {
    case 39:
        $orderby = " ORDER BY (p.shares+p.comments+p.reactions+p.post_video_views_unique+p.link_clicks) DESC";
        break;
    case 40:
        $orderby = " ORDER BY p.reactions DESC";
        break;
    case 41:
        $orderby = " ORDER BY p.shares DESC";
        break;
    case 42:
        $orderby = " ORDER BY p.comments DESC";
        break;
    case 43:
        $orderby = " ORDER BY p.post_video_views_unique DESC";
        break;
    case 44:
        $orderby = " ORDER BY p.link_clicks DESC";
        break;
    case 45:
        $orderby = " ORDER BY p.reach DESC";
        break;
    case 46:
        $orderby = " ORDER BY p.reach_paid DESC";
        break;
    case 47:
        $orderby = " ORDER BY p.reach_organic DESC";
        break;
    case 48:
        $orderby = " ORDER BY p.indice_interaccion DESC";
        break;
    case 49:
        $orderby = " ORDER BY p.indice_interalcance DESC";
        break;
    case 50:
        $orderby = " ORDER BY p.inversion DESC";
        break;
    case 52:
        $orderby = " ORDER BY p.indice_interaccion_inversion DESC";
        break;
    case 53:
        $orderby = " ORDER BY p.indice_interalcance_inversion DESC";
        break;
    default:
        $orderby = " ORDER BY p.created_time ASC";
}


switch ($_POST['ACT']) {
    // Buscar ï¿½ltimo Dato

    case 0:
        $statement = $pdo->prepare("SELECT " . $a . " SUM(`page_fan_adds_unique`) AS x, SUM(`page_fan_removes_unique`) AS y FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);

        //falta
        $statement2 = $pdo->prepare("SELECT " . $i . " (SUM(`spend`)/0.55) as costo  FROM `aiw_facebook_data_ads` WHERE date_start BETWEEN '" . $desde . "' and '" . $hasta . "' " . $j . " ");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $arrayName = array('uno' => $results, 'dos' => $results2);
        $json = json_encode($arrayName);
        echo $json;

        break;



    case 1:
        $statement = $pdo->prepare("SELECT " . $a . " MAX(`page_fans`) as x, SUM(`page_fan_removes_unique`) as y FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;



    case 2:
        $statement = $pdo->prepare("SELECT " . $a . " MAX(`page_fans`) as x, SUM(`page_fan_adds_unique`) as y, ((SUM(`page_fan_adds_unique`)/MAX(`page_fans`))*100) as w FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;



    case 3:
        $statement = $pdo->prepare("SELECT " . $a . " SUM(`page_fan_adds_by_paid_unique`) as x, SUM(`page_fan_adds_by_non_paid_unique`) as y, SUM(`page_fan_adds_unique`) as w FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 4:
        $statement = $pdo->prepare("SELECT " . $a . " ((SUM(`page_fan_adds_by_paid_unique`)/SUM(`page_fan_adds_unique`))*100) as x, ((SUM(`page_fan_adds_by_non_paid_unique`)/SUM(`page_fan_adds_unique`))*100) as y FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 5:
        $statement = $pdo->prepare("SELECT " . $a . " SUM(`page_fan_adds_unique`) as x FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 6:
        $statement = $pdo->prepare("SELECT (SUM(if(`sexo_edad` LIKE '%F%', `fans`, 0))/SUM(`fans`))*100 as f, (SUM(if(`sexo_edad` LIKE '%M%', `fans`, 0))/SUM(`fans`))*100 as m, (SUM(if(`sexo_edad` LIKE '%U%', `fans`, 0))/SUM(`fans`))*100 as u FROM `ssg_page_fans_gender_age` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 7:
        $statement = $pdo->prepare("SELECT sexo_edad as s, sum(resta) as b FROM `ssg_page_fans_gender_age` WHERE id_page ='" . $id_page . "' AND `end_time` BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY `sexo_edad`");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 8:
        //aca el cuadro 10 llamado alcance organico
        $statement = $pdo->prepare("SELECT sum(page_impressions_organic_unique) as x FROM `ssg_facebook_page_impressions` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 9:
        $statement = $pdo->prepare("SELECT " . $c . " SUM(`comments`+`link_clicks`+`shares`+`reactions`) AS x FROM `ssg_post_page_facebook` WHERE page_id ='" . $id_page . "' AND created_time BETWEEN '" . $desde . "' and '" . $hasta . "'  AND (`comments`+`link_clicks`+`shares`+`reactions`)!='null' " . $d . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 10:
        $statement = $pdo->prepare("SELECT " . $a . "  (SUM(if(`sexo_edad` LIKE '%F%', `resta`, 0))/SUM(resta))*100 as f, (SUM(if(`sexo_edad` LIKE '%M%', `resta`, 0))/SUM(resta))*100 as m, (SUM(if(`sexo_edad` LIKE '%U%', `resta`, 0))/SUM(resta))*100 as u, (ELT(WEEKDAY(end_time) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS ds FROM `ssg_page_fans_gender_age` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 11:
        $statement = $pdo->prepare("SELECT hora as h, MAX(`fans`) AS f FROM `page_fans_online_facebook`  WHERE id_page ='" . $id_page . "' AND `end_time` BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY `hora`");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 12:
        // aca los cuadros 11(impresiones organica) , 12(clics organica), (ENGAGEMENT ESPECÍFICO)
        //$statement = $pdo->prepare("SELECT sum(page_impressions_organic) as x, sum(page_impressions_organic) as w, sum(page_impressions_organic) as page_impressions, sum(page_impressions_organic) as clics FROM `ssg_facebook_page_impressions` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'");
        $statement = $pdo->prepare(
                "SELECT i.*, 
                (SELECT SUM(c.page_consumptions) clics FROM ssg_facebook_page_engagement c WHERE c.end_time BETWEEN '" . $desde . "' and '" . $hasta . "' AND c.id_page='" . $id_page . "') clics,
                (SELECT sum(page_engaged_users)as engaged_uni FROM `ssg_facebook_page_engagement` WHERE end_time BETWEEN '" . $desde . "' and '" . $hasta . "' AND id_page ='" . $id_page . "') engaged_uni,
                (SELECT sum(page_engaged_users)as engaged_uni FROM `ssg_facebook_page_engagement` WHERE end_time BETWEEN '" . $desde . "' and '" . $hasta . "' AND id_page ='" . $id_page . "') page_post_engagements
                FROM (SELECT sum(page_impressions_organic) as x, sum(page_impressions_organic) as w, sum(page_impressions_organic) as page_impressions FROM `ssg_facebook_page_impressions`WHERE end_time BETWEEN  '" . $desde . "' and '" . $hasta . "' AND id_page='" . $id_page . "') i
                ");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement2 = $pdo->prepare("SELECT sum(page_engaged_users)as engaged_uni FROM `ssg_facebook_page_engagement` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);


        $statement3 = $pdo->prepare("SELECT SUM(c.page_total_actions) clic FROM ssg_facebook_page_cta_clicks c WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'");
        $statement3->execute();
        $results3 = $statement3->fetchAll(PDO::FETCH_ASSOC);


        $resultado = array_merge($results, $results2, $results3);
        //$arrayName = array($results,$results2,$results3);
        $json = json_encode($results);

        echo $json;

        break;



    case 13:
        $statement = $pdo->prepare("SELECT " . $a . " AVG(page_impressions_unique) as x, (page_post_engagements/page_impressions_unique)*100 as w FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 14:
        $statement = $pdo->prepare("SELECT " . $a . " SUM(if(`sexo_edad` LIKE '%F%', `resta`, 0)) as f, SUM(if(`sexo_edad` LIKE '%M%', `resta`, 0)) as m, SUM(if(`sexo_edad` LIKE '%U%', `resta`, 0)) as u, (ELT(WEEKDAY(end_time) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS ds FROM `ssg_page_fans_gender_age` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;

    case 15:

        $statement = $pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,(SUM(d.ad_spend*3.6)/0.55) as inversion, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `ssg_post_page_facebook` p LEFT JOIN ssg_facebook_adaccount_data d ON p.id=d.object_story_id WHERE p.page_id ='" . $id_page . "' AND p.`created_time` BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY p.id ORDER BY (p.shares+p.comments+p.reactions+p.post_video_views_unique+p.link_clicks) DESC " . $h . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);


        $statement2 = $pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $arrayName = array('uno' => $results, 'dos' => $results2);
        $json = json_encode($arrayName);
        echo $json;
        break;

    case 16:
        //ACA EL POST PUBLICADO
        $statement = $pdo->prepare("SELECT COUNT(id) nropost FROM `ssg_post_page_facebook` WHERE page_id ='" . $id_page . "' AND created_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 17:



        $statement = $pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,(SUM(d.ad_spend*3.6)/0.55) as inversion, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `ssg_post_page_facebook` p LEFT JOIN ssg_facebook_adaccount_data d ON p.id=d.object_story_id WHERE p.page_id ='" . $id_page . "' AND p.`created_time` BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY p.id ORDER BY p.reach DESC " . $h . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);


        $statement2 = $pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $arrayName = array('uno' => $results, 'dos' => $results2);
        $json = json_encode($arrayName);
        echo $json;
        break;

    case 18:


        $statement = $pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,(SUM(d.ad_spend*3.6)/0.55) as inversion, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `ssg_post_page_facebook` p LEFT JOIN ssg_facebook_adaccount_data d ON p.id=d.object_story_id WHERE p.page_id ='" . $id_page . "' AND p.`created_time` BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY p.id ORDER BY inversion DESC " . $h . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);


        $statement2 = $pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $arrayName = array('uno' => $results, 'dos' => $results2);
        $json = json_encode($arrayName);
        echo $json;
        break;

    case 19:
        // $statement=$pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,(SUM(d.ad_spend*3.6)/0.55) as inversion, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `ssg_post_page_facebook` p LEFT JOIN ssg_facebook_adaccount_data d ON p.id=d.object_story_id WHERE p.page_id ='".$id_page."' AND p.`created_time` BETWEEN '".$desde."' and '".$hasta."' GROUP BY p.id ORDER BY p.reach DESC ".$h."");
        $statement = $pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,(SUM(d.ad_spend*3.6)/0.55) as inversion, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `ssg_post_page_facebook` p LEFT JOIN ssg_facebook_adaccount_data d ON p.id=d.object_story_id WHERE p.page_id ='" . $id_page . "' AND p.`created_time` BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY p.id ORDER BY p.indice_interalcance_inversion DESC " . $h . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);


        $statement2 = $pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        $arrayName = array('uno' => $results, 'dos' => $results2);
        $json = json_encode($arrayName);
        echo $json;
        break;

    case 20:
        $statement = $pdo->prepare("SELECT " . $a . " sum(page_engaged_users) as x, (sum(page_post_engagements)/sum(page_impressions_unique))*100 as w, sum(page_impressions) as page_impressions, sum(page_post_engagements) as page_post_engagements, sum(clics) as clics FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;

    case 21:
        $statement = $pdo->prepare("SELECT " . $a . " sum(page_engaged_users) as x, (sum(page_post_engagements)/sum(page_impressions_unique))*100 as w, sum(page_impressions) as page_impressions, sum(page_post_engagements) as page_post_engagements, sum(clics) as clics FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;



    case 22:

        //identificando cuales son las cuentas publicitarias asociadas a estas paginas, hacemos un recorrido en ss_cuenta_por_pagina donde averiguamos cual es el id para identificar        
        $sql = "SELECT id_adaccount FROM ssg_cuenta_por_pagina WHERE page_id='" . $id_page . "' GROUP BY id_adaccount ";
        $resultt = mysqli_query($conn, $sql);
        $datas = array();
        if (mysqli_num_rows($resultt) > 0) {
            while ($row = mysqli_fetch_assoc($resultt)) {
                $datas[] = $row;
            }
        }
        $totalloop = sizeof($datas);
        $totalalcance = '0'; //seleccionamos cero para que una vez haga el recorrido de suma no sume el valor anterior
        $totalimp = '0';
        $totalc = '0';
        for ($x = 0; $x <= $totalloop - 1; $x++) {

            $id_cuenta = $datas[$x]['id_adaccount']; //este arreglo guarda el total de cuentas publicitarias encontradas
            //aca el cuadro 7 calculo del alcance de pauta
            $sqlAL = "select sum(reach)  AS alcancee FROM aiw_facebook_data_ads WHERE account_id='" . $id_cuenta . "' and `date_start` BETWEEN '" . $desde . "' and '" . $hasta . "'
";
            $resultAL = mysqli_query($conn, $sqlAL);
            while ($row = mysqli_fetch_array($resultAL)) {
                $totalalcance = $row[0] + $totalalcance;
            } //aca el cuadro 19 alcance pauta total
            $sqlALc = "select SUM(if(objective='POST_ENGAGEMENT' or objective='PAGE_LIKES' or objective='VIDEO_VIEWS', reach,0)) AS alcance FROM aiw_facebook_data_ads WHERE account_id='" . $id_cuenta . "' and `date_start` BETWEEN '" . $desde . "' and '" . $hasta . "'";
            $resultALc = mysqli_query($conn, $sqlALc);
            while ($row = mysqli_fetch_array($resultALc)) {
                $total = $row[0] + $total;
            }

// aca el cuadro 8 calculo de impresiones de pauta
            $sqlim = "select SUM(impressions) AS impp FROM aiw_facebook_data_ads WHERE account_id='" . $id_cuenta . "' and `date_start` BETWEEN '" . $desde . "' and '" . $hasta . "'";
            $resultIM = mysqli_query($conn, $sqlim);
            while ($row = mysqli_fetch_array($resultIM)) {
                $totalimp = $row[0] + $totalimp;
            } //aca el cuadro 20 impresiones pauta total
            $sqlimT = "select SUM(if(objective='POST_ENGAGEMENT' or objective='PAGE_LIKES' or objective='VIDEO_VIEWS', impressions,0)) AS imp FROM aiw_facebook_data_ads WHERE account_id='" . $id_cuenta . "' and `date_start` BETWEEN '" . $desde . "' and '" . $hasta . "'";
            $resultIMT = mysqli_query($conn, $sqlimT);
            while ($row = mysqli_fetch_array($resultIMT)) {
                $totalimpT = $row[0] + $totalimpT;
            }
//aca el cuadro 9 calculo de clics pauta
            $sqlc = "select SUM(clicks) AS clicss FROM aiw_facebook_data_ads WHERE account_id='" . $id_cuenta . "' and `date_start` BETWEEN '" . $desde . "' and '" . $hasta . "'";
            $resultCL = mysqli_query($conn, $sqlc);
            while ($row = mysqli_fetch_array($resultCL)) {
                $totalc = $row[0] + $totalc;
                //aca el cuadro 21 clics pauta total 
            } $sqlct = "select SUM(if(objective='POST_ENGAGEMENT' or objective='PAGE_LIKES' or objective='VIDEO_VIEWS', clicks,0)) AS clics FROM aiw_facebook_data_ads WHERE account_id='" . $id_cuenta . "' and `date_start` BETWEEN '" . $desde . "' and '" . $hasta . "'";
            $resultCLt = mysqli_query($conn, $sqlct);
            while ($row = mysqli_fetch_array($resultCLt)) {
                $totalct = $row[0] + $totalct;
            }
        }
        // se guarda el alcance, las impresiones y las pautas en una sola variable llamada results para llamarla
        $alcance = $totalalcance;
        $imp = $totalimp;
        $clics = $totalc;
        $alcancee = $total;
        $impp = $totalimpT;
        $clicss = $totalct;
        $results = array(array("alcance" => $alcance, "alcancee" => $alcancee, "impp" => $impp, "imp" => $imp, "clicss" => $clicss, "clics" => $clics)); // asignamos en un array los valores que sacamos de la base de datos.
        // aca el cuadro de comentarios          
        $statement2 = $pdo->prepare("SELECT (SELECT COUNT(DISTINCT(from_id))-1 FROM `ssg_facebook_comments` WHERE page_id='" . $id_page . "' and created_time BETWEEN '" . $desde . "' and '" . $hasta . "') as unicos,(SELECT COUNT(id) FROM `ssg_facebook_comments` WHERE page_id='" . $id_page . "' and created_time BETWEEN '" . $desde . "' and '" . $hasta . "') as comentarios,(SELECT COUNT(id) FROM `ssg_facebook_comments` WHERE from_id='" . $id_page . "' and created_time BETWEEN '" . $desde . "' and '" . $hasta . "') as respuestas FROM `ssg_facebook_comments` WHERE page_id='" . $id_page . "' and created_time BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY unicos");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        //aca la el cuadro de inbox
        $statement3 = $pdo->prepare("SELECT COUNT(DISTINCT(from_id))-1 as unicos, COUNT(id) as comentarios, (SELECT COUNT(id) FROM `ssg_facebook_conversations_messages` WHERE from_id='" . $id_page . "' and created_time BETWEEN '" . $desde . "' and '" . $hasta . "') as respuestas FROM `ssg_facebook_conversations_messages` WHERE created_time BETWEEN '" . $desde . "' and '" . $hasta . "'");
        $statement3->execute();
        $results3 = $statement3->fetchAll(PDO::FETCH_ASSOC);
        //aca hace la suma del total alcance, de impresiones total y clics total
        $statement4 = $pdo->prepare("SELECT SUM(`page_impressions_organic_unique`) as alcance, sum(page_impressions) as page_impressions, sum(page_post_engagements) as page_post_engagements, sum(clics) as clics FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement4->execute();
        $results4 = $statement4->fetchAll(PDO::FETCH_ASSOC);


        $arrayName = array('uno' => $results, 'dos' => $results2, 'tres' => $results3, 'cuatro' => $results4);
        $json = json_encode($arrayName);
        echo $json;
        break;


    case 23:
        $statement = $pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,(SUM(d.ad_spend*3.6)/0.55) as inversion, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `ssg_post_page_facebook` p LEFT JOIN ssg_facebook_adaccount_data d ON p.id=d.object_story_id WHERE p.page_id ='" . $id_page . "' AND p.`created_time` BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY p.id " . $orderby . " LIMIT 18");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);


        $statement2 = $pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' ");
        $statement2->execute();
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);

        $statement = $pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,(SUM(d.ad_spend*3.6)/0.55) as inversion, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `ssg_post_page_facebook` p LEFT JOIN ssg_facebook_adaccount_data d ON p.id=d.object_story_id WHERE p.page_id ='" . $id_page . "' AND p.`created_time` BETWEEN '" . $desde . "' and '" . $hasta . "' GROUP BY p.id " . $orderby . " LIMIT 12");
        $statement->execute();
        $results3 = $statement->fetchAll(PDO::FETCH_ASSOC);

        $arrayName = array('uno' => $results, 'dos' => $results2);
        $json = json_encode($arrayName);
        echo $json;
        break;


    case 24:
        $statement = $pdo->prepare("SELECT " . $a . "  (SUM(if(`sexo_edad` LIKE '%F%', `resta`, 0))/SUM(resta))*100 as f, (SUM(if(`sexo_edad` LIKE '%M%', `resta`, 0))/SUM(resta))*100 as m, (SUM(if(`sexo_edad` LIKE '%U%', `resta`, 0))/SUM(resta))*100 as u, (ELT(WEEKDAY(end_time) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS ds FROM `ssg_page_fans_gender_age` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "' " . $b1 . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;
    case 25:
        $statement = $pdo->prepare("SELECT sum(page_impressions_organic) as x, sum(page_impressions_organic) as w, sum(page_impressions_organic) as page_impressions, sum(page_impressions_organic) as clics FROM `ssg_facebook_page_impressions` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;

    case 99:
        $statement = $pdo->prepare("SELECT YEAR(`end_time`) as ano, month(`end_time`) as mes, SUM(`page_fan_adds_unique`) AS x, SUM(`page_fan_removes_unique`) AS y FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND YEAR(end_time)>='2018' GROUP BY YEAR(`end_time`), month(`end_time`)");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;


    case 100:
        //falta
        //$statement=$pdo->prepare("SELECT ".$f." COUNT(id) as f, DAY(fecha_registro) as d FROM `cliente` WHERE fecha_registro BETWEEN '".$desde."' and '".$hasta."' ".$g."");
        $statement = $pdo->prepare("SELECT " . $f . " COUNT(id) as f FROM `cliente` WHERE fecha_registro BETWEEN '" . $desde . "' and '" . $hasta . "' " . $g . "");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;

    case 101:
        //falta
        $statement = $pdo->prepare("SELECT week(`fecha_registro`) as d, COUNT(id) as f FROM `cliente` WHERE fecha_registro>='2018-01-01' GROUP BY week(fecha_registro)");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;




    // Buscar Todos los datos
    default:

        $statement = $pdo->prepare("SELECT YEAR(`end_time`) as ano, month(`end_time`) as mes, SUM(`page_fan_adds_unique`) AS x, SUM(`page_fan_removes_unique`) AS y FROM `ssg_page_fans_facebook` WHERE id_page ='" . $id_page . "' AND YEAR(`end_time`)>='2018' GROUP BY YEAR(`end_time`), month(`end_time`)");
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        echo $json;
        break;
}
?>