<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
$pdo=new PDO("mysql:dbname=aiwroi_moviltours;host=localhost","aiwroi_moviltour","~m6^}h~x@7.X");

$periodo = $_POST["fecha"];

if($_POST['op']==1){
		$statement=$pdo->prepare("SELECT max(`id_consultoria`) as max FROM `consultoria`");
		$statement->execute();
		$results=$statement->fetch();	
		$fecha=date("Y-m-d");
if ($_POST['id_edit']==null) {
	    $id_consultoria=$results[0]+1;
} else {
	    $id_consultoria=$_POST['id_edit'];
	    $statement=$pdo->prepare("DELETE FROM `consultoria` WHERE `id_consultoria`='".$id_consultoria."'");
	    $statement->execute();
}

foreach($_POST["kpi"] as $key => $value) {
    foreach($value as $k) { 
        try {

        $kpi = $k;
        $id_analisis = $key;
        $tipo = $_POST["tipo"][$key];
        $obj = $_POST["obj"][$key];
        
        $principal = $_POST["principal"][$key];
            
        $statement = $pdo->prepare("INSERT INTO `consultoria` (`id`, `id_consultoria`, `id_analisis`, `tipo`, `objetivo`, `kpi`, `kpi_principal`, `fecha`, `periodo`) VALUES (NULL, :id_consultoria, :id_analisis, :tipo, :obj, :kpi, :principal, :fecha, :periodo)");
        $statement->bindParam(':id_consultoria', $id_consultoria, PDO::PARAM_STR);
        $statement->bindParam(':id_analisis', $id_analisis, PDO::PARAM_STR);
        $statement->bindParam(':tipo', $tipo, PDO::PARAM_STR);
        $statement->bindParam(':obj', $obj, PDO::PARAM_STR);
        $statement->bindParam(':kpi', $kpi, PDO::PARAM_STR);
        $statement->bindParam(':principal', $principal, PDO::PARAM_STR);
        $statement->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $statement->bindParam(':periodo', $periodo, PDO::PARAM_STR);
        $result = $statement->execute(); 

        } catch (Exception $e) {
            $e->getMessge();
            die("Oh noes! There's an error in the query!");
        }	// Buscar �ltimo Dato

    }
}
}

if($_POST['op']==2){
	$id=$_POST['id'];
								
		$statement=$pdo->prepare("SELECT * FROM consultoria as a, catalogacion as b WHERE a.kpi_principal=b.id AND a.id_consultoria='".$id."' GROUP BY id_analisis");
		$statement->execute();
		$results=$statement->fetchAll(PDO::FETCH_ASSOC);
		$json=json_encode($results);
		echo $json;
}




	

?> 