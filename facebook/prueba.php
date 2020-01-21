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
$page_id='192597304105183';
               
                                    
  // sql Crea la tabla usando Lenguaje PHP
   $sql = "CREATE TABLE ssg_temp_inbox_time_calcs (
   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   page_id VARCHAR(15)NOT NULL,
   fechap DATE NOT NULL,
   promediop VARCHAR(50) NOT NULL,
   fecha_respondido VARCHAR(15)NOT NULL,
   total_no_respondido VARCHAR(15)NOT NULL,
   total_respondido VARCHAR(15),
   mayor_48_horas VARCHAR(15),
   respuestas_mayor_a_48_horas VARCHAR(15)
   
   )";
    $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
    $developer_records = array();
    while( $rows = mysqli_fetch_assoc($resultset) ) {
    $developer_records[] = $rows;
    print_r($rows);
     }     
    
      //Insertar los datos en el query 
     
     $sql_query = "INSERT INTO ssg_temp_inbox_time_calcs (page_id,fechap,promediop,fecha_respondido,total_no_respondido,total_respondido, mayor_48_horas,respuestas_mayor_a_48_horas)
             SELECT page_id,create_time as fecha, ROUND(AVG(time_different),2) as 'promedio',fecha_respondido,
             (CASE fecha_respondido WHEN '0000-00-00' THEN COUNT(fecha_respondido) END) AS total_no_respondido,
             (CASE WHEN fecha_respondido  >'0000-00-00 00:00:00' THEN COUNT(fecha_respondido) END) AS total_respondido, mayor_a_48_horas,respuestas_mayor_a_48_horas  
             FROM `ssg_conversations_time_quantity_calculations` WHERE page_id=$page_id GROUP by  fecha_respondido, fecha  
             ORDER BY `fecha` DESC
              ";               
     $resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
     $developer_records = array();
      
     while( $rows = (mysqli_fetch_assoc($resultset)!=  null()) ) {
         
     $developer_records[] = ($rows);
     print_r($rows);
         
     }
  /*   //elimina la base de datos
 $sql = "DROP TABLE `ssg_temp_inbox_time_calcs`";
               mysqli_query($conn, $sql);*/
    
?>
</body>
</html>