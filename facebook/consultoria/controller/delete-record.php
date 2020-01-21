<?php
if(isset($_POST['id'])){
    include('../model/Database.php');
    $connection = Database::getInstance(); 
    $statement = $connection->prepare("DELETE FROM `catalogacion` WHERE `id`='". $_POST['id']."'");
    try { 
        $statement->execute();
       echo 'borrado';
      } catch (Exception $e) { 
        echo "error al borrar \n";
        echo $e->errorMessage(); 
      } 
}
?>