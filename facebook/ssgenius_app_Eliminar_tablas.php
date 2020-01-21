<?php
include_once 'conec.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
       
    </head>
    <body>
        
        <?php
                 
 /*eliminar la tabla base de datos*/
        
              $sql = "DROP TABLE `ssg_conversations_time_quantity_calculations`";
                if (mysqli_query($conn, $sql)){
                echo "La tabla fue eliminada con éxito\n";
                } else {
                echo 'Error al eliminar la base de datos: ' . mysql_error() . "\n";
                }
                
                ?>
  </body>
</html>
 