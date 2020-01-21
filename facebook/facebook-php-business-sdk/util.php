<?php
define("DBHOST","localhost");
define("DBNAME","ssgenius_app");
define("DBUSERNAME","ssgenius_55g");
define("DBPASSWORD","$?sqnuk,=;RT");
define('DNS','mysql:dbname='.DBNAME.';host='.DBHOST);
function pdoConect(){
 $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8", DBUSERNAME, DBPASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
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
 /*
* @return bool
* @desc funcion guarda los insights de anuncios
*/
/*******************************************************************/ 
function insertInsightsInTableReportFacebook($cursor,$table){
        $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         foreach ($cursor as $data) {
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO ".$table."(date_start,date_stop,ad_name,ad_id,adset_name,adset_id,campaign_name,campaign_id,impressions,clicks,spend,objective,gender,age)
                VALUES(:date_start,:date_stop,:ad_name,:ad_id,:adset_name,:adset_id,:campaign_name,:campaign_id,:impressions,:clicks,:spend,:objective,:gender,:age)");
           $statement->execute(array(
                "date_start" => $data['date_start'],
                "date_stop" => $data['date_stop'],
                "ad_name" => addslashes($data['ad_name']),
                "ad_id" => $data['ad_id'],
                "adset_name" => addslashes($data['adset_name']),
                "adset_id" => $data['adset_id'],
                "campaign_name" => addslashes($data['campaign_name']),
                "campaign_id" => $data['campaign_id'],
                "impressions" => $data['impressions'],
                "clicks" => $data['clicks'],
                "spend" => $data['spend'],
                "objective" => $data['objective'],
                "gender" => $data['gender'],
                "age" => $data['age']
            ));
                 $conn->commit();
                 $save = true;
        } catch (PDOException $e) {
             $conn->rollback();
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("jose@mimirwell.com","Hubo un error en guardado de keywords",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    }
    return $save;
}

 /*
* @return bool
* @desc funcion guarda los insights de anuncios con id de cuenta
*/
/*******************************************************************/ 
/*function saveInsightsForFacebookAccount($cursor,$table){
        $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $spend = 0;
         foreach ($cursor as $data) {
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO ".$table."(date_start,date_stop,ad_name,ad_id,adset_name,adset_id,campaign_name,campaign_id,account_name,account_id,impressions,clicks,spend,objective,gender,age)
                VALUES(:date_start,:date_stop,:ad_name,:ad_id,:adset_name,:adset_id,:campaign_name,:campaign_id,:account_name,:account_id,:impressions,:clicks,:spend,:objective,:gender,:age)");
           $statement->execute(array(
                "date_start" => $data['date_start'],
                "date_stop" => $data['date_stop'],
                "ad_name" => addslashes($data['ad_name']),
                "ad_id" => $data['ad_id'],
                "adset_name" => addslashes($data['adset_name']),
                "adset_id" => $data['adset_id'],
                "campaign_name" => addslashes($data['campaign_name']),
                "campaign_id" => $data['campaign_id'],
                "account_name" => addslashes($data['account_name']),
                "account_id" => $data['account_id'],
                "impressions" => $data['impressions'],
                "clicks" => $data['clicks'],
                "spend" => $data['spend'],
                "objective" => $data['objective'],
                "gender" => $data['gender'],
                "age" => $data['age']
            ));
            //$number_of_rows = $result->fetchColumn(); 
             
            //$spend = $spend + $data['spend'];
                $qty = $statement->rowCount();
                 $conn->commit();
                 $save = true;
        } catch (PDOException $e) {
             $conn->rollback();
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
           // sendMailer("mario@mimirwell.com","Hubo un error en guardado de keywords",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    }
    return $qty;
}
*/
 /*
* @return bool
* @desc funcion guarda los insights de anuncios con id de cuenta
*/
function saveInsightsForFacebookAccount($data,$table){
     $conn = pdoConect();
     $conn->beginTransaction();
    $query = "INSERT INTO ".$table." (date_start,date_stop,ad_name,ad_id,adset_name,adset_id,campaign_name,campaign_id,account_name,account_id,reach,impressions,clicks,spend,objective,gender,age) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
    //print_r($item);
    //echo $item['criteriaType'];
    //echo "<br>";
       $stmt->bindValue($i++, $item['date_start']);
       $stmt->bindValue($i++, $item['date_stop']);
       $stmt->bindValue($i++, $item['ad_name']);
       $stmt->bindValue($i++, $item['ad_id']);
       $stmt->bindValue($i++, $item['adset_name']);
       $stmt->bindValue($i++, $item['adset_id']);
       $stmt->bindValue($i++, $item['campaign_name']);
       $stmt->bindValue($i++, $item['campaign_id']);
       $stmt->bindValue($i++, $item['account_name']);
       $stmt->bindValue($i++, $item['account_id']);
       $stmt->bindValue($i++, $item['reach']);
       $stmt->bindValue($i++, $item['impressions']);
       $stmt->bindValue($i++, $item['clicks']);
       $stmt->bindValue($i++, $item['spend']);
       $stmt->bindValue($i++, $item['objective']);
       $stmt->bindValue($i++, $item['gender']);
       $stmt->bindValue($i++, $item['age']);
    }
    try {
        $stmt->execute(); //execute
        $qty = $stmt->rowCount();
     } catch (PDOException $e){
         $conn->rollback();
            echo $e->getMessage();
          sendMailer("jose@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
          //sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
        return $qty;
}

function saveInsightsForFacebookAccount2($data,$table){
     $conn = pdoConect();
     $conn->beginTransaction();
    $query = "INSERT INTO ".$table." (date_start,date_stop,ad_name,ad_id,adset_name,adset_id,campaign_name,campaign_id,account_name,account_id,reach,impressions,clicks,spend,objective,gender,age,likepage,link_click,post_engagement,post_reaction,comment,post,cost_likepage) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
    //print_r($item);
    //echo $item['criteriaType'];
    //echo "<br>";
       $stmt->bindValue($i++, $item['date_start']);
       $stmt->bindValue($i++, $item['date_stop']);
       $stmt->bindValue($i++, $item['ad_name']);
       $stmt->bindValue($i++, $item['ad_id']);
       $stmt->bindValue($i++, $item['adset_name']);
       $stmt->bindValue($i++, $item['adset_id']);
       $stmt->bindValue($i++, $item['campaign_name']);
       $stmt->bindValue($i++, $item['campaign_id']);
       $stmt->bindValue($i++, $item['account_name']);
       $stmt->bindValue($i++, $item['account_id']);
       $stmt->bindValue($i++, $item['reach']);
       $stmt->bindValue($i++, $item['impressions']);
       $stmt->bindValue($i++, $item['clicks']);
       $stmt->bindValue($i++, $item['spend']);
       $stmt->bindValue($i++, $item['objective']);
       $stmt->bindValue($i++, $item['gender']);
       $stmt->bindValue($i++, $item['age']);
       $stmt->bindValue($i++, $item['likepage']);
       $stmt->bindValue($i++, $item['link_click']);
       $stmt->bindValue($i++, $item['post_engagement']);
       $stmt->bindValue($i++, $item['post_reaction']);
       $stmt->bindValue($i++, $item['comment']);
       $stmt->bindValue($i++, $item['post']);
       $stmt->bindValue($i++, $item['cost_likepage']);
    }
    try {
        $stmt->execute(); //execute
        $qty = $stmt->rowCount();
     } catch (PDOException $e){
         $conn->rollback();
           echo $e->getMessage();
           sendMailer("jose@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
          //sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
        return $qty;
}

/*
* @return int
* @desc funcion para guardar data de los conjuntos de anuncios de una cuenta
*/            
function insertAdSetsFacebook($adset_id,$account_id,$campaign_id,$name,$effective_status,$created_time,$start_time,$end_time=null,$age_max,$age_min,$interest,$education_statuses,$exclusions_education_statuses,$behaviors,$geo_locations,$industries){
        $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO adset_facebook (adset_id,account_id,campaign_id,name,effective_status,created_time,start_time,end_time,age_max,age_min,interest,education_statuses,exclusions_education_statuses,behaviors,geo_locations,industries)
                VALUES(:adset_id,:account_id,:campaign_id,:name,:effective_status,:created_time,:start_time,:end_time,:age_max,:age_min,:interest,:education_statuses,:exclusions_education_statuses,:behaviors,:geo_locations,:industries)");
            $stmt = $statement->execute(array(
                "adset_id" => $adset_id,
                "account_id" => $account_id,
                "campaign_id" => $campaign_id,
                "name" => $name,
                "effective_status" => $effective_status,
                "created_time" => $created_time,
                "start_time" => $start_time,
                "end_time" => $end_time,
                "age_max" => $age_max,
                "age_min" => $age_min,
                "interest" => $interest,
                "education_statuses" => $education_statuses,
                "exclusions_education_statuses" => $exclusions_education_statuses,
                "behaviors" => $behaviors,
                "geo_locations" => $geo_locations,
                "industries" => $industries
            ));
                    $save = true;
                    $conn->commit();  
        } catch (PDOException $e) {
            return $e->getMessage();
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("jose@mimirwell.com","Hubo un error en guardado de ads insights",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
             $save = false;
             $conn->rollback();
        }

    return $save;
}


/*
* @return int
* @desc funcion cuenta los registros en una tabla de insights de anuncio de facebook entre un rango de fechas
*/
/*******************************************************************/
 function getCountFromtable($table,$since,$until,$account_id){
          try {
                $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM ".$table." WHERE date_start BETWEEN '".$since."' AND '".$until."' AND account_id = '".$account_id."'"); 
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
* @desc funcion que elimina los registros entre dos rangos de fecha de una tabla de ads insights de facebook
*/
/*******************************************************************/

        function DeleteFromtableBetweenDates($table,$since,$until,$account_id){
          try {
                $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("DELETE FROM ".$table." WHERE date_start BETWEEN '".$since."' AND '".$until."' AND account_id = '".$account_id."'"); 
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
* @desc funcion para guardar las asociaciones entre ids de anuncios y creatividades de facebook de una cuenta publicitaria
*/            
function insertAdsCreativesFacebook($cursor,$table,$account_id){
         foreach ($cursor as $data) {
        $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO ".$table."(account_id,ad_id,creative_id,effective_object_story_id,object_story_id,thumbnail_url,link_url,object_type)
                VALUES(:account_id,:ad_id,:creative_id,:effective_object_story_id,:object_story_id,:thumbnail_url,:link_url,:object_type)");
            $stmt = $statement->execute(array(
                "account_id" => $account_id,
                "ad_id" => $data['id'],
                "creative_id" => $data['creative']['id'],
                "effective_object_story_id" => $data['effective_object_story_id'],
                "object_story_id" => $data['object_story_id'],
                "thumbnail_url" => $data['thumbnail_url'],
                "link_url" => $data['link_url'],
                "object_type" => $data['object_type']
            ));
                    $save = true;
                    $conn->commit();  
        } catch (PDOException $e) {
            error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("jose@mimirwell.com","Hubo un error en guardado de ads insights",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
             $save = false;
             $conn->rollback();
        }
    }
    return $save;
}
/*
* @return int
* @desc funcion que elimina todos los registros de una tabla
*/
/*******************************************************************/
        function DeleteTotalDataOfTableForAccount($table,$account_id){
          try {
                $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("DELETE FROM ".$table." WHERE account_id = ".$account_id.""); 
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
* @desc funcion que elimina todos los registros de una tabla
*/
/*******************************************************************/
        function DeleteTotalDataOfTable($table){
          try {
                $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("DELETE FROM ".$table.""); 
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
* @return @
* @desc funcion que guarda el reporte de las keywords de google
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
    //print_r($item);
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
           // echo $e->getMessage();
          sendMailer("jose@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
          sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}

    function getMaxDateFromFacebookSavedData($type)
        {
            $conn = pdoConect();
            try {         	 
			 $sql = "select max(date) as date from report_save_data WHERE type = '".$type."'";
			 $sth = $conn->prepare($sql);
			 $sth->execute();
			 $maxdate = $sth->fetchObject();			
			 $date = $maxdate->date; 
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );
			 } 
			 return $date;
    }	
    
function registerInsertData($date,$qty=null,$status=null,$type)
    {
        $conn = pdoConect();
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO report_save_data(date,qty,status,type)
                VALUES(:date,:qty,:status,:type)");
            $stmt = $statement->execute(array(
                "date" => $date,
                "qty" => $qty,
                "status" => $status,
                "type" => $type
            ));
                    $save = true;
                    $conn->commit();  
        } catch (PDOException $e) {
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            //sendMailer("mario@mimirwell.com","Hubo un error en guardado de ads insights",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
             $save = false;
             $conn->rollback();
        }
    return $save;
}

/*
* @return int
* @desc funcion usada al capturar una excepcion pdo
*/
/*******************************************************************/            
function handle_sql_errors($query, $error_message)
{
    echo '<pre>';
    echo $query;
    echo '</pre>';
    echo $error_message;
    die;
}            