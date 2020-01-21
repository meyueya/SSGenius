<?php
include_once 'conec.php';

        
       
$sql_query = "INSERT INTO ssg_conversations_time_quantity_calculations (page_id,conversation_id,create_time,From_id)SELECT page_id,conversation_id, min(created_time) created_time, from_id FROM ssg_facebook_conversations_messages where  page_id='192597304105183'  and conversation_calculation_state='0' group by page_id, from_id ORDER BY `created_time` ASC" ;               
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
$developer_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$developer_records[] = $rows;
print_r($rows);
     }
$sql_query = "UPDATE ssg_facebook_conversations_messages
set conversation_calculation_state='1' WHERE conversation_calculation_state='0'" ;               
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
$developer_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$developer_records[] = $rows;
print_r($rows);
     }
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
$sql_query = "UPDATE ssg_facebook_conversations_messages 
INNER JOIN ssg_conversations_time_quantity_calculations 
ON (ssg_facebook_conversations_messages.conversation_id= ssg_conversations_time_quantity_calculations.conversation_id) 
SET conversation_calculation_state = '2' where ssg_conversations_time_quantity_calculations.fecha_respondido=ssg_facebook_conversations_messages.created_time";
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
$developer_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$developer_records[] = $rows;
print_r($rows);
}
$sql_query = "UPDATE  `ssg_conversations_time_quantity_calculations`
SET time_different=TIMESTAMPDIFF(MINUTE,create_time , fecha_respondido)
";
$resultset = mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
$developer_records = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$developer_records[] = $rows;
print_r($rows);
}
       ?>

 