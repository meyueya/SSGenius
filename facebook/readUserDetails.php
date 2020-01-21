<?php
// include Database connection file
include('../auth.php');
//header("Content-type:application/json");
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $user_id = $_POST['id'];

    // Get User Details

    $query="SELECT a.estado, a.fechasistema, a.comentario, a.idvendedor, b.nombres_apellidos, b.apellidos, b.telefono, b.correo, b.fecha_registro, b.ultimoestado_lcb as e_descripcion, c.nombremodelo, b.comentario as primercomentario  FROM `mensajeria` as a, `cliente` as b, modelo as c WHERE a.idcliente = '$user_id' AND b.id=a.idcliente and c.inicialmodelo=modelo GROUP BY a.`fechasistema` DESC";
   
    if (!$result = mysql_query($query)) {
        exit(mysql_error());
    }
    $response = array();
    if(mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_assoc($result)) {
            $response[] = $row;
        }
    }

     /*if(mysql_num_rows($result) == null) {
        $query = "SELECT * FROM `cliente` WHERE id = '$user_id'";
        $result = mysql_query($query)
        while ($row = mysql_fetch_assoc($result)) {
            $response = $row;
        }
    }*/
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