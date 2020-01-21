<?php
include('model/Database.php');
$connection = Database::getInstance(); 
/* $username = 'aiwroi_aiwlcb';
$password = ']a_nc#S}LthH';
$connection = new PDO( 'mysql:host=localhost;dbname=aiwroi_moviltours', $username, $password ); // Create Object of PDO class by connecting to Mysql database */

function traerInformes($connection){
    $statement = $connection->prepare("SELECT * FROM `informesfb` GROUP BY `id_inf`");
    $statement->execute();
    $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $registros;
}

function traerInforme($connection , $id){
    $statement = $connection->prepare("SELECT * FROM `informesfb` WHERE `id_inf`= $id");
    $statement->execute();
    $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $registros;
}

function traerTiposYObjetivos($connection){
    $statement = $connection->prepare("SELECT * FROM `catalogacion`");
    $statement->execute();
    $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $registros;
}

function traerConsultorias($connection){
    $statement = $connection->prepare("SELECT id_consultoria, COUNT(DISTINCT(id_analisis)) as analisis, kpi_principal, fecha FROM consultoria as a GROUP BY id_consultoria");
    $statement->execute();
    $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $registros;
}

function traerConsultoria($connection , $id){
    $statement = $connection->prepare("SELECT * FROM `consultoria` WHERE `id_consultoria`= $id");
    $statement->execute();
    $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $registros;
}
?>