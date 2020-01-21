<?php
if(isset($_POST['id'])){
    include('../model/Database.php');
$connection = Database::getInstance(); 
    $statement = $connection->prepare("DELETE FROM `consultoria` WHERE `id_consultoria`='". $_POST['id']."'"); 
    try { 
        $statement->execute();
       echo 'borrado';
      } catch (Exception $e) { 
        echo "error al borrar \n";
        echo $e->errorMessage(); 
      } 
}
?>