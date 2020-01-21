<?php
// include Database connection file
include('../auth.php');
//header("Content-type:application/json");
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $user_id = $_POST['id'];
    $desdehasta = explode(" - ", $_POST['fecha']);
    $desde=date("Y-m-d",strtotime($desdehasta[0]));
    $hasta=date("Y-m-d",strtotime($desdehasta[1]));
    $prod=$_POST['prod'];

    // Get User Details
    
  $query="select a.`campaign_name`,a.`ad_name`, b.`thumbnail_url`, b.`effective_object_story_id` from aiw_facebook_data_ads as a, ad_creative_facebook as b WHERE date_start BETWEEN '".$desde."' AND '".$hasta."' AND  a.ad_name LIKE '%".$prod."%' AND b.`ad_id`=a.`ad_id` group by a.`ad_name`";

   
    if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }
    $response = array();
    if(mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
            $response[] = $row;
        }
    }

    else
    {

    $query1 = "select nombres_apellidos, apellidos, e_descripcion, nombremodelo, correo, telefono, fecha_registro, comentario as primercomentario from cliente, modelo g, estado_cliente s where g.inicialmodelo=modelo and estado=s.id_estado and cliente.id = '$user_id'";

        $result2 = mysql_query($query1);
        while ($row = mysql_fetch_assoc($result2)) {
            $response[] = $row;
        }
       // $response['status'] = 200;
        //$response['message'] = "Data not found!";
    }
    // display JSON data
    header('Content-Type: application/json');
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}