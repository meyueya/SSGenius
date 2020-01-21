<?php
if(isset($_POST['id'])){
    include('../model/Database.php');
$connection = Database::getInstance(); 
    $statement = $connection->prepare("DELETE FROM `informesfb` WHERE `id_inf`='". $_POST['id']."'"); 
    try { 
        $statement->execute();
       echo 'borrado';
      } catch (Exception $e) { 
        echo "error al borrar \n";
        echo $e->errorMessage(); 
      } 
}
?>