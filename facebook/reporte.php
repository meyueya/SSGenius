<?php
require_once("../model/Database.php");

class Reporte{

    function getInformes(){
        $dbh = Database::getInstance();

      $statement = $dbh->prepare("SELECT fechap, promediop, fecha_respondido, sum(total_no_respondido) as total_no_respondido,
          sum(total_respondido) as total_respondido,respuestas_mayor_a_48_horas
          FROM `ssg_temp_inbox_time_calcs` WHERE page_id='192597304105183'  group by fechap ORDER BY `fechap` DESC");
       $statement->execute();
     
}}
class Reporte01{
    function getInformes1(){
        $dbh = Database::getInstance();
        $statement01 = $dbh->prepare("SELECT * FROM `ssg_facebook_reporte_inbox` where page_id='192597304105183'");
	$statement01->execute();
       
        
}}
       
