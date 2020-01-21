<?php
/* session_start();
$username = 'aiwroi_moviltour';
$password = '~m6^}h~x@7.X';
$fecha=$_POST['fecha'];
$fecha_comparacion=$_POST['fecha_comparacion'];
$periodo=$_POST['pdo'];
$id_page=$_POST['id_page'];


try {
		$connection = new PDO( 'mysql:host=localhost;dbname=aiwroi_moviltours', $username, $password );
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement  = $connection->prepare("SELECT MAX(`id_inf`) FROM ssg_informes_fb");
		$statement->execute();
		$result     = $statement->fetchAll(); 
		$idinf      = $result[0][0]+1;
		$statement  = $connection->prepare("INSERT INTO ssg_informes_fb (id_inf, id_page, fecha, fecha_comparacion, periodo) VALUES (:id_inf, :id_page, :fecha, :fecha_comparacion, :periodo)");
		$result     = $statement->execute(
		array(
        ':id_inf'   => $idinf,
        ':id_page'  => $id_page,
		':fecha'    => $fecha,
		':fecha_comparacion'    => $fecha_comparacion,
		':periodo'  => $periodo
		));

		$_SESSION['id_inf'] = $idinf;
		$_SESSION['id_page'] = $id_page;
		$_SESSION['fecha'] = $fecha;
		$_SESSION['fecha_comparacion'] = $fecha_comparacion;
		$_SESSION['periodo'] = $periodo;
		header('Location: informefb.php');
		exit;
    } 

catch (PDOexception $e) {
        echo "problème de connection" . $e->getMessage();
        return false;
    }
 */
?>