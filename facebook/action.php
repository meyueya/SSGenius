<?php
/* $username = 'aiwroi_moviltour';
$password = '~m6^}h~x@7.X';
$connection = new PDO( 'mysql:host=localhost;dbname=aiwroi_moviltours', $username, $password ); // success Object of PDO class by connecting to Mysql database
$id_inf=$_POST["id_inf"];
$id_page=$_POST["id_page"];
$idcom=$_POST["idcom"];
$com=$_POST["com"];
$periodo=$_POST["periodo"];
$fecha=$_POST["fecha"];

if(isset($_POST["id_inf"])) //Check value of $_POST["action"] variable value is set to not
{
 //For Load All Data

  $output = array();
  $statement = $connection->prepare("SELECT * FROM ssg_informes_fb WHERE id_inf = '$id_inf'");
  $statement->execute();
  $result = $statement->fetchAll();
      foreach($result as $row)
      { 
        $param=$row['id_com'];
        if($param == $idcom)
        { 
          $action="Update";
          break; 
        }else{ 
          $action="Create";
        }
      }
    
   //creear 
   if($action == "Create")
   {
    $statement = $connection->prepare("INSERT INTO ssg_informes_fb (id_inf, id_page, id_com, comentario, periodo, fecha) VALUES (:id_inf, :id_page, :id_com,:comentario,:periodo,:fecha)");
    $result = $statement->execute(
     array(
      ':id_inf' => $id_inf,
      ':id_page' => $id_page,
      ':id_com' => $idcom,
      ':comentario' => $com,
      ':periodo' => $periodo,
      ':fecha' => $fecha
     )
    ); 
   $json=json_encode(
    array(
    'clase' => 'success',
    'ac' => 'Creado'
    ));
   echo $json;
   }

 //UPDATE

 if($action == "Update")
 {
  $statement = $connection->prepare("UPDATE ssg_informes_fb SET comentario = :comentario WHERE id_inf = :id_inf and id_com = :id_com");
  $result = $statement->execute(
   array(
    ':id_inf' => $id_inf,
    ':id_com' => $idcom,
    ':comentario' => $com
   )
  );
  
  $json=json_encode(
    array(
    'clase' => 'warning',
    'ac' => 'Actualizado'
    ));
   echo $json;
 }



} */
?>