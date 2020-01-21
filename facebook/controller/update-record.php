<?php
    include('../model/Database.php');
    if (isset($_POST['nombre']) && isset($_POST['grupo'])) {
        $connection = Database::getInstance(); 
        $sql_insert="UPDATE `catalogacion` SET `nombre`=:nombre, `grupo`=:grupo WHERE id=:id";
        //$sql_insert="UPDATE `catalogacion` SET `nombre`=:nombre, `grupo`=:grupo WHERE id=:id";
        try{
            $sth = $connection->prepare($sql_insert);
            $sth->bindParam(':id', $_POST['id']);
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
