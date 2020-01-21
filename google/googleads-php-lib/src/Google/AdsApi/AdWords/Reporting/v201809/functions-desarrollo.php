<?php
  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'ssgenius_55g');
  define('DB_SERVER_PASSWORD', '$?sqnuk,=;RT');
  define('DB_SERVER_DATABASE', 'ssgenius_app');
  define('DNS','mysql:dbname='.DB_SERVER_DATABASE.';host='.DB_SERVER);
function pdoConect(){
 $conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_SERVER_DATABASE.";charset=utf8", DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
}

/*
* @return @
* @desc funcion que guarda las keywords de google
*/
/*******************************************************************/
function saveKeywordsGoogleReport($table,$data){
     $conn = pdoConect();
     $conn->beginTransaction();
    $query = "INSERT INTO ".$table." (`Id`, `CampaignId`, `AdGroupId`, `CampaignName`, `AdGroupName`, `Date`, `Criteria`,"
             . " `Impressions`, `Clicks`, `Cost`,`Conversions`, `ClickAssistedConversions`, `QualityScore`, `CreativeQualityScore`, `PostClickQualityScore`, `Ctr`, `AverageCpc`, `CostPerConversion`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
    print_r($item);
    //echo $item['criteriaType'];
    //echo "<br>";
       $stmt->bindValue($i++, $item['keywordID']);
       $stmt->bindValue($i++, $item['campaignID']);
       $stmt->bindValue($i++, $item['adGroupID']);
       $stmt->bindValue($i++, $item['campaign']);
       $stmt->bindValue($i++, $item['adGroup']);
       $stmt->bindValue($i++, $item['day']);
       $stmt->bindValue($i++, $item['keyword']);
       $stmt->bindValue($i++, $item['impressions']);
       $stmt->bindValue($i++, $item['clicks']);
       $stmt->bindValue($i++, $item['cost']);
       $stmt->bindValue($i++, $item['conversions']);
       $stmt->bindValue($i++, $item['clickAssistedConv']);
       $stmt->bindValue($i++, $item['qualityScore']);
       $stmt->bindValue($i++, $item['adRelevance']);
       $stmt->bindValue($i++, $item['landingPageExperience']);
       $stmt->bindValue($i++, $item['ctr']);
       $stmt->bindValue($i++, $item['avgCPC']);
       $stmt->bindValue($i++, $item['costConv']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
         $conn->rollback();
            echo $e->getMessage();
        }
        $conn->commit();
    
}
/*
* @return int
* @desc funcion cuenta los registros en una tabla entre un rango de fechas
*/
/*******************************************************************/
 function getCountFromTable($table,$since,$until){
          try {
                $conn = pdoConect();
                $stmt = $conn->prepare("SELECT * FROM ".$table." WHERE Date BETWEEN '".$since."' AND '".$until."'"); 
                $stmt->execute();
                $qtyBd = $stmt->Rowcount();
                return $qtyBd;
                }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
            }


/*
* @return int
* @desc funcion que elimina los registros entre dos rangos de fecha de una tabla
*/
/*******************************************************************/

        function DeleteFromtableBetweenDates($table,$since,$until){
          try {
                $conn = pdoConect();
                $stmt = $conn->prepare("DELETE FROM ".$table." WHERE Date = '".$since."' AND '".$until."'"); 
                $stmt->execute();
                $qtyBd = $stmt->Rowcount();
                return $qtyBd;
                }
                catch(PDOException $e) {
                     return null;
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;
            }
            
/*
* @return int
* @desc funcion que envia correos electronicos en formato html
*/
/*******************************************************************/
function sendMailer($mail_destino,$asunto,$mensaje)
{   
    $datos_remitente = "Sistema Web";
	$headers = "MIME-Version: 1.0\n"; 
	$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
	$headers .= "From: $datos_remitente\n"; 
	//$headers .= "Reply-To: $responder_a\r\n"; 
	$resultado=mail($mail_destino,$asunto,$mensaje,$headers);
	return $resultado;
}

            
function conect_bd() {

    if (!($con = mysql_connect("localhost", "aiwroi_aiwlcb", "]a_nc#S}LthH") or die(mysql_error()))) {
        echo "Error al conectar al servidor";
        exit();
    }
    if (!mysql_select_db("aiwroi_ilcb", $con)) {
        echo "Error al seleccionar la base de datos";
        exit();
    }
    /* $this->cn = $con;
      return $this->cn; */
}

function disconect() {
    mysql_close();
}