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
$sql_query = "UPDATE ssg_conversations_time_quantity_calculations as c
INNER JOIN  (SELECT conversation_id, min(created_time) created_time FROM ssg_facebook_conversations_messages where page_id='192597304105183'  group by to_name ORDER BY created_time ASC) as f 
ON (c.conversation_id= f.conversation_id and f.conversation_id= c.conversation_id )
set c.fecha_respondido =f.created_time
WHERE c.page_id=192597304105183 and f.conversation_id= c.conversation_id
";
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
$developer_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$developer_records[] = $rows;
print_r($rows);
}
  ?>
</body>
</html>
 