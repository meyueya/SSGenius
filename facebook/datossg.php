<?php
header('Content-Type: application/json');
//$pdo=new PDO("mysql:dbname=ssgenius_app;host=localhost","ssgenius_55g","$?sqnuk,=;RT");
require_once("../model/Database.php");
$pdo= Database::getInstance();

if (isset($_POST) && $_POST!=NULL) {
    $id_consultoria = (isset($_POST['a'])) ? $_POST['a'] : '' ;
    $page_id = (isset($_POST['page_id'])) ? $_POST['page_id'] : '' ;
    switch($_POST['ACT']){
            // Buscar �ltimo Dato 
            
            
        
            case 0:
                $statement=$pdo->prepare("SELECT * FROM `ssg_catalogacion` WHERE `page_id`=$page_id");
                $statement->execute();
                $results=$statement->fetchAll(PDO::FETCH_ASSOC);
                $json=json_encode($results);
                echo $json;
            break;
            
            
            
            case 1:
                $statement=$pdo->prepare("SELECT * FROM `ssg_analisis_consultoria` WHERE id_consultoria=$id_consultoria AND `page_id`=$page_id ORDER BY `ssg_analisis_consultoria`.`tipo_analisis` ASC");
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
}
 
?>