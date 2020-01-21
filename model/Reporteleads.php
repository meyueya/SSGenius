<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once("Database.php");
class Reporteleads{

    function getInformesFB($id_page){
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
        $dbh = Database::getInstance();
        $statement = $dbh->prepare("SELECT id, id_usuario_ssg, fuente, var_de_id_01, var_de_id_20,id_usuario_fuente, page_id, nombre_usuario,fecha_1er_contacto, nombres, apellidos, telefono_1, email_1, dni, direccion, distrito, ciudad, provincia, departamento_o_estado FROM `ssg_consultas_control_usuarios`   WHERE page_id ='" . $id_page . "' AND fecha_1er_contacto BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
        $statement->execute();
        $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
    }
    }

}