<?php
    include('../model/Database.php');
    if (isset($_POST['nombre']) && isset($_POST['grupo'])) {
        $connection = Database::getInstance(); 
        $sql_insert="INSERT INTO `catalogacion`(`nombre`, `grupo`) VALUES (:nombre,:grupo)";
        try{
            $sth = $connection->prepare($sql_insert);
            $sth->bindParam(':nombre', $_POST['nombre']);
            $sth->bindParam(':grupo', $_POST['grupo']);
            $sth->execute();
        }catch  (Exception $e) {
            echo"no";
        }
        header('Location:../tipos-objetivos.php');
    } else {
        header('Location:../tipos-objetivos.php');
    }


?>