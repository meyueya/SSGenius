<?php
require_once("Database.php");

Class FacebookAiwModel{
    
    public function getAdAccountData($id_adaccount) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT * FROM `ssg_facebook_adaccount_data` WHERE `id_adaccount` = :id_adaccount");
            $stmt->bindParam(':id_adaccount', $id_adaccount);
            try {
            $stmt->execute();
            $data = $stmt->fetchAll();
                    return $data;
            } catch (PDOException $e){
          echo $e->getMessage();
           
         function getCountFromtable($table,$since,$until){
          try {
                $conn = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME."", DBUSERNAME, DBPASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM ".$table." WHERE date_start BETWEEN '".$since."' AND '".$until."'"); 
                $stmt->execute();
                $qtyBd = $stmt->Rowcount();
                return $qtyBd;
                }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
            }
                }
            }
    
    

    public function getPostsFacebookAiw($page_id) {
        $dbh = Database::getInstance();
        $statement= $dbh->prepare("SELECT * FROM `reporte_facebook_aiw` WHERE `ad_id`='".$page_id."' ORDER BY id ASC");
        $statement->execute();
        $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $arreglo;
      }

       public function updateFacebookAiw($array){
          $dbh = Database::getInstance();
          $sth = $dbh->prepare("
          UPDATE `ssg_facebook_adaccount` 
          SET `adaccount_status`=:status
          WHERE `id_adaccount` =:id_adaccount
          ");
          
          $sth->bindParam(':status', $array['status']);
          $sth->bindParam(':id_adaccount', $array['id_adaccount']);
       //var_dump( $sth);die;
          $sth->execute();
        }
        
    public function updateFacebookAiwStatus($array)
        {
            
    if($array['aiw_status'] == '2'){
                    
        //var_dump($array);
        try{
		  $dbhi = Database::getInstance();
          $sthi = $dbhi->prepare("INSERT INTO `aiw_facebook_primera_carga` (`id_adaccount`, `aiw_status`) VALUES (:id_adaccount, :status)");
          $sthi->bindParam(':id_adaccount', $array['id_adaccount']);
          $sthi->bindParam(':status', $array['aiw_status']);
          $sthi->execute();
        			}catch (PDOException $e){ 
			    die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); 
			}
    }elseif($array['aiw_status'] == '0'){
        try {
            
        $conn = Database::getInstance();
        $stmt = $conn->prepare("DELETE FROM `aiw_facebook_primera_carga` WHERE `id_adaccount` =:id_adaccount");
        $stmt->bindParam(':id_adaccount', $array['id_adaccount']);
        $stmt->execute();
        //$qtyBd = $stmt->Rowcount();
        //var_dump($qtyBd);
     			}catch (PDOException $e){ 
			    die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); 
			}
                    
                }
        
          $dbh = Database::getInstance();
          $sth = $dbh->prepare("
          
          UPDATE `ssg_facebook_adaccount` 
          SET `aiw_status`=:status
          WHERE `id_adaccount` =:id_adaccount
          
          ");
          
          $sth->bindParam(':status', $array['aiw_status']);
          $sth->bindParam(':id_adaccount', $array['id_adaccount']);
          $sth->execute();

        }
         
        
    public function getActiveFacebookAiwAdAccountJobs()
            {
         	    try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT id_adaccount FROM `ssg_facebook_adaccount` WHERE `aiw_status` = '1'";
        			 $sth = $dbh->prepare($sql);
        			 $sth->execute();
        			 $jobs = $sth->fetchAll();
        			 return $jobs;
        			 }catch (PDOException $e) {
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            } 
            
    public function getActiveFacebookAiwAdAccount()
            {
         	    try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT id_adaccount FROM `ssg_facebook_adaccount` WHERE `aiw_status` = '2'";
        			 $sth = $dbh->prepare($sql);
        			 $sth->execute();
        			 $jobs = $sth->fetchAll();
        			 return $jobs;
        			 }catch (PDOException $e) {
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            } 
            
    public function getTokenForFacebookAiwAdAccount($id_adaccount)
            {
               // var_dump($id_adaccount);
         	    try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT access_token FROM `ssg_facebook_adaccount` WHERE `id_adaccount` = :id_adaccount";
        			 $sth = $dbh->prepare($sql);
        			 $sth->bindParam(':id_adaccount', $id_adaccount, PDO::PARAM_STR);
        			 $sth->execute();
        			 $field = $sth->fetchObject();
        			 return $field->access_token;
        			 }catch (PDOException $e) {
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            } 
            
            
     public function deleteAdAccountFromfetch201days($array)
            {
            // echo('<pre>');
            //   var_dump($array);
            // echo('</pre>');
             //die;
         	 try {
                    
                $conn = Database::getInstance();
                $stmt = $conn->prepare("DELETE FROM `aiw_facebook_primera_carga` WHERE `id_adaccount` =:id_adaccount");
                $stmt->bindParam(':id_adaccount', $array['id_adaccount']);
                $stmt->execute();
                //$qtyBd = $stmt->Rowcount();
                //var_dump($qtyBd);
             			}catch (PDOException $e){ 
        			    die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); 
		        	}
		  //$array['aiw_status'] = 1;     
          $dbh = Database::getInstance();
          $sth = $dbh->prepare("
          
          UPDATE `ssg_facebook_adaccount` 
          SET `aiw_status`=:status
          WHERE `id_adaccount` =:id_adaccount
          
          ");
          $sth->bindParam(':status', $array['aiw_status']);
          $sth->bindParam(':id_adaccount', $array['id_adaccount']);
            //     echo('<pre>');
            //   var_dump($array);
            // echo('</pre>');
          $sth->execute();
            } 
            
    public function TimeOutDate($arraydate){
                echo('<pre>');
                var_dump($arraydate);
                echo('</pre>');
                // die;
          $dbh = Database::getInstance();
          $sth = $dbh->prepare("
          UPDATE `aiw_facebook_primera_carga` 
          SET `restart_day`=:restart_day
          WHERE `id_adaccount` =:id_adaccount
          ");
          
          $sth->bindParam(':restart_day', $arraydate['restart_day']);
          $sth->bindParam(':id_adaccount', $arraydate['id_adaccount']);
      //var_dump( $sth);die;
          $sth->execute();
        }
        
            
            
            
}