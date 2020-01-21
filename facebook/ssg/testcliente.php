<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("model/Database.php");
function getUsers()
    	{
    	    try {
    			 $dbh = Database::getInstance();
    			 $sql = "SELECT m.idcliente as idcliente,c.correo as correo,m.estado as estado,m.fechasistema as fechasistema, COUNT(*) as llamadasrepetidas FROM mensajeria m LEFT JOIN cliente c ON m.idcliente = c.id WHERE m.estado = 'NO_ANSWER' GROUP BY m.idcliente,m.fechasistema";
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $posts = $sth->fetchAll();
    			 if ($posts){ return $posts; }	
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}
    	}
    	$users = getUsers();
    	$arrayUser = Array();
    	foreach ($users  as $user){
    	    	 $arrayUser[$user['idcliente']]['correo'] = $user['correo'];
    	    	if (($arrayUser[$user['idcliente']]['correo']) == $user['correo']) {
                 	$arrayUser[$user['idcliente']]['count']++;
               }
               if ($arrayUser[$user['idcliente']]['count'] > 3)
               {
                    unset(	$arrayUser[$user['idcliente']]);
               }
    	    
    	}
 $num = md5(time());   	
//MAIL BODY
$body = '<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                <tr>
                    <td align="center" valign="top">
                        <table bgcolor="#f5f5f5" border="0" cellpadding="20" cellspacing="0" width="100%" id="emailHeader">
                            <tr>
                                <td align="center" valign="top">
                                    <img src="http://lcbingreso.com/pecs/curso-cata-de-piscos/wp-content/uploads/2018/08/logo-pec-para-landing.png" width="60%">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="justify" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailBody">
                            <tr>
                                <td align="left" valign="top">
								Gracias por contactarnos. Tus datos se encuentran registrados correctamente. Nos comunicaremos contigo vía telefónica para brindarte toda la información que necesites.<br><br>
    							Te dejamos los datos ingresados para que puedas corroborarlos, estos son: <br><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="justify" valign="top">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailFooter">
                            <tr>
                                <td align="left" valign="top">
                                     Saludos.<br><br><i>Le Cordon Bleu</i>.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>';

// MULTI-HEADERS Content-Type: multipart/mixed and Boundary is mandatory.
//$headers = "From: Texto del From en headers <mario@mimirwell.com>\r\n";

//$headers .= 'Cc: dante@cooltrendsperu.com' . "\r\n";
/*
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; "; 
$headers .= "boundary=".$num."\r\n";
$headers .= "--".$num."\n"; 
*/
// HTML HEADERS
/*
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "Content-Transfer-Encoding: 8bit\r\n";
$headers .= "".$body."\n";
$headers .= "--".$num."\n"; 
*/
$uid = md5(uniqid(time()));

$eol = PHP_EOL;


//$header .= "Reply-To: ".$replyto.$eol;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <mario@mimirwell.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

$asunto= "Mensaje de prueba de mail";
mail("mario@mimirwell.com", $asunto , $body, $headers);
foreach ($arrayUser as $key=>$values)
{
    echo $values['correo']."<br>";
  //mail("mario@mimirwell.com", $asunto , $body, $headers);  
    
}
//print_r($arrayUser);