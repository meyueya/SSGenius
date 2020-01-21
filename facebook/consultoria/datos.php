<?php
/*header('Content-Type: application/json');
$pdo=new PDO("mysql:dbname=aiwroi_moviltours;host=localhost","aiwroi_moviltour","~m6^}h~x@7.X");

$desdehasta= explode(" - ", $_POST['fecha']);
$desde=date("Y-m-d",strtotime($desdehasta[0]));
$hasta=date("Y-m-d",strtotime($desdehasta[1]));
if($_POST['periodo']=='a'){
	$a="month(`end_time`) as z, DAY(`end_time`) as d,";
	$b="GROUP BY year(`end_time`), month(`end_time`),DAY(`end_time`) LIMIT 31";
	$b1="GROUP BY year(`end_time`), month(`end_time`),DAY(`end_time`) LIMIT 7";
	$c="month(`created_time`) as z, DAY(`created_time`) as d,";
	$d="GROUP BY year(`created_time`), month(`created_time`),DAY(`created_time`) LIMIT 31";
	$f="DAY(`fecha_registro`) as d,";
	$g="GROUP BY month(`fecha_registro`), DAY(`fecha_registro`) LIMIT 31";
	$h="LIMIT 31";
}

if($_POST['periodo']=='b'){
	$a="YEAR(`end_time`) as z, WEEK(`end_time`) as d,";
	$b="GROUP BY  YEAR(`end_time`),WEEK(`end_time`) LIMIT 12";
	$c="YEAR(`created_time`) as z, WEEK(`created_time`) as d,";
	$d="GROUP BY  YEAR(`created_time`),WEEK(`created_time`) LIMIT 12";
	$f="WEEK(`fecha_registro`) as d,";
	$g="GROUP BY week(fecha_registro) LIMIT 12";
	$h="LIMIT 12";
}

if($_POST['periodo']=='c'){
	$a="YEAR(`end_time`) as z, month(`end_time`) as d,";
	$b="GROUP BY  YEAR(`end_time`),month(`end_time`) LIMIT 12";
	$c="YEAR(`created_time`) as z, month(`created_time`) as d,";
	$d="GROUP BY  YEAR(`created_time`),month(`created_time`) LIMIT 12";
	$f="month(`fecha_registro`) as d,";
	$g="GROUP BY month(`fecha_registro`) LIMIT 12";
	$h="LIMIT 12";
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


switch($_POST['ACT']){
		// Buscar �ltimo Dato
		
		
		
		case 0:
		    $statement=$pdo->prepare("SELECT ".$a." SUM(`page_fan_adds_unique`) AS x, SUM(`page_fan_removes_unique`) AS y FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
		
	
		
		case 1:
		    $statement=$pdo->prepare("SELECT ".$a." MAX(`page_fans`) as x, SUM(`page_fan_removes_unique`) as y FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break; 
		
		
		
        case 2:
		    $statement=$pdo->prepare("SELECT ".$a." MAX(`page_fans`) as x, SUM(`page_fan_adds_unique`) as y, ((SUM(`page_fan_adds_unique`)/MAX(`page_fans`))*100) as w FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
		
		
		
		case 3:
		    $statement=$pdo->prepare("SELECT ".$a." SUM(`page_fan_adds_by_paid_unique`) as x, SUM(`page_fan_adds_by_non_paid_unique`) as y, SUM(`page_fan_adds_unique`) as w FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
		

        case 4:
		    $statement=$pdo->prepare("SELECT ".$a." ((SUM(`page_fan_adds_by_paid_unique`)/SUM(`page_fan_adds_unique`))*100) as x, ((SUM(`page_fan_adds_by_non_paid_unique`)/SUM(`page_fan_adds_unique`))*100) as y FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
		
		
		case 5:
		    $statement=$pdo->prepare("SELECT ".$a." SUM(`page_fan_adds_unique`) as x FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 6:
		    $statement=$pdo->prepare("SELECT (SUM(if(`sexo_edad` LIKE '%F%', `fans`, 0))/SUM(`fans`))*100 as f, (SUM(if(`sexo_edad` LIKE '%M%', `fans`, 0))/SUM(`fans`))*100 as m, (SUM(if(`sexo_edad` LIKE '%U%', `fans`, 0))/SUM(`fans`))*100 as u FROM `page_fans_gender_age` WHERE end_time BETWEEN '".$desde."' and '".$hasta."'");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 7:
		    $statement=$pdo->prepare("SELECT sexo_edad as s, sum(resta) as b FROM `page_fans_gender_age` WHERE `end_time` BETWEEN '".$desde."' and '".$hasta."' GROUP BY `sexo_edad`");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 8:
		    $statement=$pdo->prepare("SELECT ".$a." SUM(`page_impressions_unique`) as x FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 9:
		    $statement=$pdo->prepare("SELECT ".$c." SUM(`comments`+`link_clicks`+`shares`+`reactions`) AS x FROM `post_page_facebook` WHERE created_time BETWEEN '".$desde."' and '".$hasta."'  AND (`comments`+`link_clicks`+`shares`+`reactions`)!='null' ".$d."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 10:
		    $statement=$pdo->prepare("SELECT ".$a."  (SUM(if(`sexo_edad` LIKE '%F%', `resta`, 0))/SUM(resta))*100 as f, (SUM(if(`sexo_edad` LIKE '%M%', `resta`, 0))/SUM(resta))*100 as m, (SUM(if(`sexo_edad` LIKE '%U%', `resta`, 0))/SUM(resta))*100 as u, (ELT(WEEKDAY(end_time) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS ds FROM `page_fans_gender_age` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 11:
		    $statement=$pdo->prepare("SELECT hora as h, MAX(`fans`) AS f FROM `page_fans_online_facebook`  WHERE `end_time` BETWEEN '".$desde."' and '".$hasta."' GROUP BY `hora`");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 12:
		    $statement=$pdo->prepare("SELECT ".$a." sum(page_engaged_users) as x, (sum(page_post_engagements)/sum(page_impressions_unique))*100 as w, sum(page_impressions) as page_impressions, sum(page_post_engagements) as page_post_engagements, sum(clics) as clics FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 13:
		    $statement=$pdo->prepare("SELECT ".$a." AVG(page_impressions_unique) as x, (page_post_engagements/page_impressions_unique)*100 as w FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		case 14:
		    $statement=$pdo->prepare("SELECT ".$a." SUM(if(`sexo_edad` LIKE '%F%', `resta`, 0)) as f, SUM(if(`sexo_edad` LIKE '%M%', `resta`, 0)) as m, SUM(if(`sexo_edad` LIKE '%U%', `resta`, 0)) as u, (ELT(WEEKDAY(end_time) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS ds FROM `page_fans_gender_age` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;

		case 15:
		    $statement=$pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,p.`inversion`, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `post_page_facebook` p WHERE p.`created_time` BETWEEN '".$desde."' and '".$hasta."' ORDER BY (p.shares+p.comments+p.reactions+p.post_video_views_unique+p.link_clicks) DESC ".$h."");
			$statement->execute();	
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			

			$statement2=$pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ");
			$statement2->execute();
			$results2=$statement2->fetchAll(PDO::FETCH_ASSOC);
			$arrayName = array('uno' => $results, 'dos' => $results2);
			$json=json_encode($arrayName);
			echo $json;
		break;

		case 16:
		    $statement=$pdo->prepare("SELECT COUNT(id) nropost FROM `post_page_facebook` WHERE created_time BETWEEN '".$desde."' and '".$hasta."' ");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;

		
		case 17:
		    $statement=$pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,p.`inversion`, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `post_page_facebook` p WHERE p.`created_time` BETWEEN '".$desde."' and '".$hasta."' ORDER BY p.reach DESC ".$h."");
			$statement->execute();	
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			

			$statement2=$pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ");
			$statement2->execute();
			$results2=$statement2->fetchAll(PDO::FETCH_ASSOC);
			$arrayName = array('uno' => $results, 'dos' => $results2);
			$json=json_encode($arrayName);
			echo $json;
		break;

		case 18:
		    $statement=$pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,p.`inversion`, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `post_page_facebook` p WHERE p.`created_time` BETWEEN '".$desde."' and '".$hasta."' ORDER BY p.inversion DESC ".$h."");
			$statement->execute();	
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			

			$statement2=$pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ");
			$statement2->execute();
			$results2=$statement2->fetchAll(PDO::FETCH_ASSOC);
			$arrayName = array('uno' => $results, 'dos' => $results2);
			$json=json_encode($arrayName);
			echo $json;
		break;

		case 19:
		    $statement=$pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,p.`inversion`, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `post_page_facebook` p WHERE p.`created_time` BETWEEN '".$desde."' and '".$hasta."' ORDER BY p.indice_interalcance_inversion DESC ".$h."");
			$statement->execute();	
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			

			$statement2=$pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ");
			$statement2->execute();
			$results2=$statement2->fetchAll(PDO::FETCH_ASSOC);
			$arrayName = array('uno' => $results, 'dos' => $results2);
			$json=json_encode($arrayName);
			echo $json;
		break;

		case 20:
		    $statement=$pdo->prepare("SELECT ".$a." sum(page_engaged_users) as x, (sum(page_post_engagements)/sum(page_impressions_unique))*100 as w, sum(page_impressions) as page_impressions, sum(page_post_engagements) as page_post_engagements, sum(clics) as clics FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
		
		case 21:
		    $statement=$pdo->prepare("SELECT ".$a." sum(page_engaged_users) as x, (sum(page_post_engagements)/sum(page_impressions_unique))*100 as w, sum(page_impressions) as page_impressions, sum(page_post_engagements) as page_post_engagements, sum(clics) as clics FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;



		case 22:
		    $statement=$pdo->prepare("SELECT sum(reach) as alcance, SUM(impressions) as imp, SUM(clicks) as clics FROM `aiw_facebook_data_ads` WHERE `date_start` BETWEEN '".$desde."' and '".$hasta."'");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			


			$statement2=$pdo->prepare("SELECT COUNT(DISTINCT(from_id))-1 as unicos, COUNT(id) as comentarios, (SELECT COUNT(id) FROM `facebook_comments` WHERE from_id='192597304105183' and created_time BETWEEN '".$desde."' and '".$hasta."') as respuestas FROM `facebook_comments` WHERE created_time BETWEEN '".$desde."' and '".$hasta."' ");
			$statement2->execute();
			$results2=$statement2->fetchAll(PDO::FETCH_ASSOC);

			$statement3=$pdo->prepare("SELECT COUNT(DISTINCT(from_id))-1 as unicos, COUNT(id) as comentarios, (SELECT COUNT(id) FROM `facebook_conversations_messages` WHERE from_id='192597304105183' and created_time BETWEEN '".$desde."' and '".$hasta."') as respuestas FROM `facebook_conversations_messages` WHERE created_time BETWEEN '".$desde."' and '".$hasta."'");
			$statement3->execute();
			$results3=$statement3->fetchAll(PDO::FETCH_ASSOC);

			 $statement4=$pdo->prepare("SELECT SUM(`page_impressions_unique`) as alcance, sum(page_impressions) as page_impressions, sum(page_post_engagements) as page_post_engagements, sum(clics) as clics FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ");
			$statement4->execute();
			$results4=$statement4->fetchAll(PDO::FETCH_ASSOC);

			$arrayName = array('uno' => $results, 'dos' => $results2, 'tres' => $results3, 'cuatro' => $results4);
			$json=json_encode($arrayName);
			echo $json;
		break;


		case 23:
		    $statement=$pdo->prepare("SELECT p.`id`,p.`page_id`,p.`created_time`,LEFT(p.`message`,175) as message,p.`picture`,p.`shares`,p.`reach`,p.`reach_paid`,p.`reach_organic`,p.`comments`,p.`reactions`,p.`post_video_views_unique`,p.`link_clicks`,p.`permalink_url`,p.`page_fans`,p.`indice_interaccion`,p.`indice_interalcance`,p.`inversion`, p.`indice_interaccion_inversion`,p.`indice_interalcance_inversion` FROM `post_page_facebook` p WHERE p.`created_time` BETWEEN '".$desde."' and '".$hasta."' ".$orderby." LIMIT 12");
			$statement->execute();	
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			

			$statement2=$pdo->prepare("SELECT sum(page_fan_adds_unique) as fans FROM `page_fans_facebook` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ");
			$statement2->execute();
			$results2=$statement2->fetchAll(PDO::FETCH_ASSOC);
			$arrayName = array('uno' => $results, 'dos' => $results2);
			$json=json_encode($arrayName);
			echo $json;
		break;


		case 24:
		    $statement=$pdo->prepare("SELECT ".$a."  (SUM(if(`sexo_edad` LIKE '%F%', `resta`, 0))/SUM(resta))*100 as f, (SUM(if(`sexo_edad` LIKE '%M%', `resta`, 0))/SUM(resta))*100 as m, (SUM(if(`sexo_edad` LIKE '%U%', `resta`, 0))/SUM(resta))*100 as u, (ELT(WEEKDAY(end_time) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')) AS ds FROM `page_fans_gender_age` WHERE end_time BETWEEN '".$desde."' and '".$hasta."' ".$b1."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
		

		case 99:
		    $statement=$pdo->prepare("SELECT YEAR(`end_time`) as ano, month(`end_time`) as mes, SUM(`page_fan_adds_unique`) AS x, SUM(`page_fan_removes_unique`) AS y FROM `page_fans_facebook` WHERE YEAR(end_time)>='2018' GROUP BY YEAR(`end_time`), month(`end_time`)");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
		

		case 100:
		    //$statement=$pdo->prepare("SELECT ".$f." COUNT(id) as f, DAY(fecha_registro) as d FROM `cliente` WHERE fecha_registro BETWEEN '".$desde."' and '".$hasta."' ".$g."");
		    $statement=$pdo->prepare("SELECT ".$f." COUNT(id) as f FROM `cliente` WHERE fecha_registro BETWEEN '".$desde."' and '".$hasta."' ".$g."");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;

		case 101:
		    $statement=$pdo->prepare("SELECT week(`fecha_registro`) as d, COUNT(id) as f FROM `cliente` WHERE fecha_registro>='2018-01-01' GROUP BY week(fecha_registro)");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;


		
		
		// Buscar Todos los datos
		default:
			
			$statement=$pdo->prepare("SELECT YEAR(`end_time`) as ano, month(`end_time`) as mes, SUM(`page_fan_adds_unique`) AS x, SUM(`page_fan_removes_unique`) AS y FROM `page_fans_facebook` WHERE YEAR(`end_time`)>='2018' GROUP BY YEAR(`end_time`), month(`end_time`)");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;

}
?>