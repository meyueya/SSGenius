<?php
header('Content-Type: application/json');
$pdo=new PDO("mysql:dbname=aiwroi_moviltours;host=localhost","aiwroi_moviltour","~m6^}h~x@7.X");



switch($_POST['ACT']){
		// Buscar Último Dato
		
		
		
		case 0:
		    $statement=$pdo->prepare("SELECT * FROM `catalogacion`");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
		
		
		
		case 1:
		    $statement=$pdo->prepare("SELECT * FROM `catalogacion`");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;
	
	
		default:
			
			$statement=$pdo->prepare("SELECT YEAR(`end_time`) as ano, month(`end_time`) as mes, SUM(`page_fan_adds_unique`) AS x, SUM(`page_fan_removes_unique`) AS y FROM `page_fans_facebook` WHERE YEAR(`end_time`)>='2018' GROUP BY YEAR(`end_time`), month(`end_time`)");
			$statement->execute();
			$results=$statement->fetchAll(PDO::FETCH_ASSOC);
			$json=json_encode($results);
			echo $json;
		break;

}
?>