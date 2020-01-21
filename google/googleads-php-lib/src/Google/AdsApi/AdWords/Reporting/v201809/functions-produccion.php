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
* @desc funcion que guarda el reporte de las keywords de google
*/
/*******************************************************************/
function saveKeywordsGoogleReport($table,$data){
    // echo('<pre>');
    //  var_dump($data);
    // echo('</pre>');
    // die;
     $conn = pdoConect();
     $conn->beginTransaction();
    $query ="INSERT INTO ".$table." (
        `Id_keywords_google`, 
        `CampaignId`, 
        `AdGroupId`, 
        `CampaignName`, 
        `AdGroupName`, 
        `Date`, 
        `Criteria`,"
             . " 
             `Impressions`, 
             `Clicks`, 
             `Cost`,
             `Conversions`,
             `ClickAssistedConversions`, 
             `QualityScore`, 
             `CreativeQualityScore`, 
             `PostClickQualityScore`, 
             `Ctr`, `AverageCpc`, 
             `CostPerConversion`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one

       $stmt->bindValue($i++, $item['keywordID']);
    // echo('<pre>');
    //  var_dump($item['keywordID']);
    // echo('</pre>');
    // die;
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
           // echo $e->getMessage();
          sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
          sendMailer("info@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
            echo('<pre>');
     var_dump($stmt);
    echo('</pre>');
    //die;
        $conn->commit();
}
/*
* @return @
* @desc funcion que guarda el reporte de los anuncios de google
*/
/*******************************************************************/
function saveAdsGoogleReport($table,$data){
 $conn = pdoConect();
 $conn->beginTransaction();
$query = "INSERT INTO ".$table." ( 
`Id_keywords_google`, 
`AdGroupId`, 
`CampaignId`,
`ExternalCustomerId`, 
`CriterionId`, 
`Date`, 
`CriterionType`, 
`Headline`, 
`HeadlinePart1`,
`HeadlinePart2`, 
`Description`, 
`Description1`, 
`Description2`, 
`CreativeFinalUrls`, 
`DisplayUrl`, 
`Status`, 
`CampaignName`, 
`AdGroupName`, 
`AdGroupStatus`,
`CampaignStatus`, 
`AdType`, 
`Clicks`, 
`Impressions`, 
`AverageCpc`, 
`Conversions`, 
`Cost`, 
`ImageAdUrl`) VALUES "; //Prequery
$qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$query .=  implode(",",$qPart);
$stmt = $conn->prepare($query); 
$i = 1;
foreach($data as $item) { //bind the values one by one
    //echo $item['criteriaType'];
    //echo "<br>";
       $stmt->bindValue($i++, $item['adID']);
       $stmt->bindValue($i++, $item['adGroupID']);
       $stmt->bindValue($i++, $item['campaignID']);
       $stmt->bindValue($i++, $item['customerID']);
       $stmt->bindValue($i++, $item['keywordID']);
       $stmt->bindValue($i++, $item['day']);
       $stmt->bindValue($i++, $item['criteriaType']);
       $stmt->bindValue($i++, $item['ad']);
       $stmt->bindValue($i++, $item['headline1']);
       $stmt->bindValue($i++, $item['headline2']);
       $stmt->bindValue($i++, $item['description']);
       $stmt->bindValue($i++, $item['descriptionLine1']);
       $stmt->bindValue($i++, $item['descriptionLine2']);
       $stmt->bindValue($i++, $item['finalURL']);
       $stmt->bindValue($i++, $item['displayURL']);
       $stmt->bindValue($i++, $item['adState']);
       $stmt->bindValue($i++, $item['campaign']);
       $stmt->bindValue($i++, $item['adGroup']);
       $stmt->bindValue($i++, $item['adGroupState']);
       $stmt->bindValue($i++, $item['campaignState']);
       $stmt->bindValue($i++, $item['adType']);
       $stmt->bindValue($i++, $item['clicks']);
       $stmt->bindValue($i++, $item['impressions']);
       $stmt->bindValue($i++, $item['avgCPC']);
       $stmt->bindValue($i++, $item['conversions']);
       $stmt->bindValue($i++, $item['cost']);
       $stmt->bindValue($i++, $item['imageAdURL']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
         $conn->rollback();
           // echo $e->getMessage();
          sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
          sendMailer("info@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
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
