<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class FacebookModelprueba{
     public function __construct(){}
     public function checkPage($id_facebook_page,$id_facebook) {// with data loaded
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT fp.id_facebook_page FROM ssg_facebook_page fp, ssg_facebook_user_page fup WHERE fp.id_facebook_page = fup.id_facebook_page AND fp.id_facebook_page = :id_facebook_page AND fup.state = 'active' AND fup.id_user = :id_facebook /*AND fp.data_state = 'true'*/");
            $stmt->bindParam(':id_facebook_page', $id_facebook_page);
            $stmt->bindParam(':id_facebook', $id_facebook);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
     public function checkIfPageSavedp($id_facebook_page) {
            $dbh = Database::getInstance();
            $stmt = $dbh->prepare("SELECT id_facebook_page FROM ssg_facebook_page WHERE id_facebook_page = :id_facebook_page");
            $stmt->bindParam(':id_facebook_page', $id_facebook_page);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
     public function checkIfDataInPagep($id_facebook_page) {
            $dbh = Database::getInstance();
            $stmt = $dbh->prepare("SELECT id_facebook_page FROM ssg_facebook_page WHERE id_facebook_page = :id_facebook_page AND data_state = 'true'");
            $stmt->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
   public function listPagesp($id_user)
    {
 	    try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT p.id_facebook_page, p.name FROM ssg_facebook_page as p, ssg_facebook_user_page as up WHERE p.id_facebook_page = up.id_facebook_page AND up.id_user = :id_user /*AND p.data_state = 'true'*/ AND up.state = 'active' GROUP BY p.id_facebook_page ORDER BY p.created_time ASC";
			 $sth = $dbh->prepare($sql);
			 $sth->bindParam(':id_user', $id_user, PDO::PARAM_STR);
			 $sth->execute();
			 $pages = $sth->fetchAll();
			 return $pages;
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }            
    //guardar 
	public function saveFacebookPagep($id_facebook_page,  $name, $token, $category, $picture="", $link="", $description="", $created_time, $data_state)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO ssg_facebook_page (id_facebook_page, name, token, category, picture, link, description, created_time, data_state) VALUES (:id_facebook_page, :name, :token, :category, :picture, :link, :description ,:created_time, :data_state)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
			$sth->bindParam(':name', $name, PDO::PARAM_STR);
			$sth->bindParam(':token', $token, PDO::PARAM_STR);
			$sth->bindParam(':category', $category, PDO::PARAM_STR);
			$sth->bindParam(':picture', $picture, PDO::PARAM_STR);
			$sth->bindParam(':link', $link, PDO::PARAM_STR);
			$sth->bindParam(':description', $description, PDO::PARAM_STR);
			$sth->bindParam(':created_time', $created_time, PDO::PARAM_STR);
			$sth->bindParam(':data_state', $data_state, PDO::PARAM_STR);
			$sth->execute();
			$count = $sth->rowCount();
			return $count;						
			}catch (PDOException $e){ 
			    die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); 
			}
	}
	
	public function checkIfFacebookPostPageJobExistsp($id_facebook_page) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT id_facebook_page FROM ssg_facebook_post_page_job WHERE id_facebook_page = :id_facebook_page");
            $stmt->bindParam(':id_facebook_page', $id_facebook_page);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
     	public function checkIfFacebookPageUserExistsp($id_facebook_page) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT * FROM `ssg_facebook_user_page` WHERE `id_facebook_page` = :id_facebook_page AND state = 'active'");
            $stmt->bindParam(':id_facebook_page', $id_facebook_page);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
     
     
	public function InsertFacebookPostPageJobp($access_token,  $page_token, $id_facebook_page, $id_facebook_admin_creator, $created_time, $updated_time, $state)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO ssg_facebook_post_page_job (access_token, page_token, id_facebook_page, id_facebook_admin_creator, created_time, updated_time, state) VALUES (:access_token, :page_token, :id_facebook_page, :id_facebook_admin_creator, :created_time, :updated_time, :state)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':access_token', $access_token, PDO::PARAM_STR);
			$sth->bindParam(':page_token', $page_token, PDO::PARAM_STR);
			$sth->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
			$sth->bindParam(':id_facebook_admin_creator', $id_facebook_admin_creator, PDO::PARAM_STR);
			$sth->bindParam(':created_time', $created_time, PDO::PARAM_STR);
			$sth->bindParam(':updated_time', $updated_time, PDO::PARAM_STR);
			$sth->bindParam(':state', $state, PDO::PARAM_STR);
			$sth->execute();
			$id = $dbh->lastInsertId();
			return $id;						
			}catch (PDOException $e){ 
			    die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); 
			}
	}
    
       public function UpdateFacebookPostPageJobp($id_facebook_page,$access_token, $page_token, $state){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE ssg_facebook_post_page_job SET access_token = :access_token, page_token = :page_token, state = :state WHERE id_facebook_page = :id_facebook_page";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':access_token', $access_token, PDO::PARAM_STR);
                 $sth->bindParam(':page_token', $page_token, PDO::PARAM_STR);
                 $sth->bindParam(':state', $state, PDO::PARAM_STR);
                 $sth->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
                 $campos = $sth->execute();
	                return $campos; 
            }  catch (PDOException $e){ die('Fail query'); }
        }
        
         public function getFacebookPostPagep($id_facebook_page)
            {
         	    try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT * FROM `ssg_post_page_facebook` WHERE `page_id` = :id_facebook_page";
        			 $sth = $dbh->prepare($sql);
        			 $sth->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
        			 $sth->execute();
        			 $field = $sth->fetchAll();
        			 return $field;
        			 }catch (PDOException $e) {
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            }  
            
         public function getIdFacebookPostPageJobp($id_facebook_page)
            {
         	    try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT id_ssgfacebookpostpagejob FROM `ssg_facebook_post_page_job` WHERE `id_facebook_page` = :id_facebook_page";
        			 $sth = $dbh->prepare($sql);
        			 $sth->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
        			 $sth->execute();
        			 $field = $sth->fetchObject();
        			 return $field->id_ssgfacebookpostpagejob;
        			 }catch (PDOException $e) {
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            }  
            
     public function getFacebookPostPageJobp($id_ssgfacebookpostpagejob)
            {  $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount, messages_restar_day, messages_status FROM `ssg_facebook_page_primera_carga` WHERE messages_status='1'  ");
                         $stm->execute();
                         $job = $stm->fetchAll();
                         $lastdate = $job['0']['1'];//id_account
                         $lastdate1 =$job['0']['0'];//id_ssg
                         $lastdate2 =$job['0']['2'];//fecha
                       
        
                         $diaconsulta = date(strtotime("$lastdate2")); // la primera vez que comience a jalar datos
                         $now = date ('Y-m-d');
                         $today = date(strtotime("$now"));
                         $diaconsultabreak = date(strtotime("$lastdate2"));
                           $totaldia = (($today - $diaconsultabreak  -86400 )/86400);
                          //echo'Dias: ';
                         //var_dump($lastdate2);
                        // die;
                       
                        $id_ssgfacebookpostpagejob = $lastdate1;
                         try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT * FROM `ssg_facebook_post_page_job` WHERE `id_ssgfacebookpostpagejob` = :id_ssgfacebookpostpagejob";
        			 $sth = $dbh->prepare($sql);
        			 $sth->bindParam(':id_ssgfacebookpostpagejob', $id_ssgfacebookpostpagejob, PDO::PARAM_STR);
        			 $sth->execute();
        			 $field = $sth->fetchObject();
        		         // echo "<pre>";
        			 //var_dump($field);
        			 // echo "</pre>";
        			 //die;
        			 
        			 return $field;
        			 }catch (PDOException $e) {
        			     return false;
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );  
                                  
                       
                                 }    
            } 
            
           public function getActiveFacebookPostPageJobsp()
            {
         	    try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT id_ssgfacebookpostpagejob FROM `ssg_facebook_post_page_job` WHERE `state` = 'active'";
        			 $sth = $dbh->prepare($sql);
        			 $sth->execute();
        			 $jobs = $sth->fetchAll();
        			 return $jobs;
        			 }catch (PDOException $e) {
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            }       
    
      public  function UpdateTrueDataStateFacebookPagep($id_facebook_page){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_page SET data_state = 'true' WHERE id_facebook_page = :id_facebook_page";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
                 $campos = $sth->execute();
	                return $campos; 
            }  catch (PDOException $e){ die('Fail query');}
        }
        
         public  function UpdateStateFacebookPostPageInJobp($id_ssgfacebookpostpagejob,$updated_time,$last_message){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_post_page_job SET updated_time = :updated_time, last_message = :last_message WHERE id_ssgfacebookpostpagejob = :id_ssgfacebookpostpagejob";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_ssgfacebookpostpagejob', $id_ssgfacebookpostpagejob, PDO::PARAM_STR);
                 $sth->bindParam(':updated_time', $updated_time, PDO::PARAM_STR);
                 $sth->bindParam(':last_message', $last_message, PDO::PARAM_STR);
                 $sth->execute();
	             $count = $sth->rowCount();
			       return $count;
            }  catch (PDOException $e){ die('Fail query'); }
        }
        
         public  function UpdateStateFacebookPageFansInJobp($id_ssgfacebookpostpagejob,$updated_time,$pageFans_last_message){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_post_page_job SET updated_time = :updated_time, pageFans_last_message = :pageFans_last_message WHERE id_ssgfacebookpostpagejob = :id_ssgfacebookpostpagejob";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_ssgfacebookpostpagejob', $id_ssgfacebookpostpagejob, PDO::PARAM_STR);
                 $sth->bindParam(':updated_time', $updated_time, PDO::PARAM_STR);
                 $sth->bindParam(':pageFans_last_message', $pageFans_last_message, PDO::PARAM_STR);
                 $sth->execute();
	             $count = $sth->rowCount();
			       return $count;
            }  catch (PDOException $e){ die('Fail query'); }
        }        
        
         public  function UpdateStateFacebookPageDemographicInJobp($id_ssgfacebookpostpagejob,$updated_time,$demog_last_message){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_post_page_job SET updated_time = :updated_time, demog_last_message = :demog_last_message WHERE id_ssgfacebookpostpagejob = :id_ssgfacebookpostpagejob";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_ssgfacebookpostpagejob', $id_ssgfacebookpostpagejob, PDO::PARAM_STR);
                 $sth->bindParam(':updated_time', $updated_time, PDO::PARAM_STR);
                 $sth->bindParam(':demog_last_message', $demog_last_message, PDO::PARAM_STR);
                 $sth->execute();
	             $count = $sth->rowCount();
			       return $count;
            }  catch (PDOException $e){ die('Fail query'); }
        }  
        
       public  function UpdateStateFacebookUserPagep($id_facebook_page,$id_user,$state){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_user_page SET state = :state WHERE id_facebook_page = :id_facebook_page AND id_user = :id_user";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':state', $state, PDO::PARAM_STR);
                 $sth->bindParam(':id_facebook_page', $id_facebook_page, PDO::PARAM_STR);
                 $sth->bindParam(':id_user', $id_user, PDO::PARAM_STR);
                 $sth->execute();
	             $count = $sth->rowCount();
			       return $count;
            }  catch (PDOException $e){ die('Fail query'); }
        }
        
        
    public function savePostsOfFacebookPagep($data,$page_id){
    $conn = Database::getInstance();
    $conn->beginTransaction();
    $query = "INSERT INTO ssg_post_page_facebook (`id`, `page_id`, `created_time`, `updated_time`, `message`, `picture`, `permalink_url`,`subattachments`, `admin_creator`,"
             . " `shares`, `promotion_status`, `reach_paid`, `reach_organic`, `reach`,`comments`, `reactions`, `post_video_views_unique`, `link_clicks`, `type`,`page_fans`,`indice_interaccion`,`indice_interalcance`,`inversion`,`indice_interaccion_inversion`,`indice_interalcance_inversion`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
    //print_r($item);
    //echo $item['criteriaType'];
    //echo "<br>";
       $stmt->bindValue($i++, $item['id']);
       $stmt->bindValue($i++, $page_id);
       $stmt->bindValue($i++, $item['created_time']);
       $stmt->bindValue($i++, $item['updated_time']);
       $message = isset($item['message']) ? $item['message'] : "";
       $stmt->bindValue($i++, $message);
       if (isset($item['attachments']['data']['0']['subattachments']['data']['0']['media_type']['image']['src'])){ $picture = $item['attachments']['data']['0']['subattachments']['data']['0']['media_type']['image']['src']; } else { $picture = isset($item['full_picture']) ? $item['full_picture'] : "";}
       $stmt->bindValue($i++, $picture);
       $permalink_url = isset($item['permalink_url']) ? $item['permalink_url'] : "";
       $stmt->bindValue($i++, $permalink_url);
       if (isset($item['attachments']['data']['0']['subattachments']['data'])){ $subattachments = json_encode($item['attachments']['data']['0']['subattachments']['data'], true); } else { $subattachments = "";}
       $stmt->bindValue($i++, $subattachments);
       $admin_creator = isset($item['admin_creator']['name']) ? $item['admin_creator']['name'] : "";
       $stmt->bindValue($i++, $admin_creator);
       $shares = isset($item['shares']['count']) ? $item['shares']['count'] : "0";
       $stmt->bindValue($i++, $shares);
       $stmt->bindValue($i++, $item['promotion_status']);
       $stmt->bindValue($i++, $item['reach_paid']['data']['0']['values']['0']['value']);
       $stmt->bindValue($i++, $item['reach_organic']['data']['0']['values']['0']['value']);
       $reach = isset($item['reach']['data']['0']['values']['0']['value']) ? $item['reach']['data']['0']['values']['0']['value'] : "0";
       $stmt->bindValue($i++, $reach);
       $stmt->bindValue($i++, $item['comments']['summary']['total_count']);
       $stmt->bindValue($i++, $item['reactions']['summary']['total_count']);
       $stmt->bindValue($i++, $item['post_video_views_unique']['data']['0']['values']['0']['value']);
       if (isset($item['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks'])){ $linkClicks = $item['post_clicks_by_type_unique']['data']['0']['values']['0']['value']['link clicks']; }
       else { $linkClicks = "0"; }
       $stmt->bindValue($i++, $linkClicks);
       $stmt->bindValue($i++, $item['media_type']);
       $stmt->bindValue($i++, $item['page_fans']);
       $stmt->bindValue($i++, $item['indice_interaccion']);
       $stmt->bindValue($i++, $item['indice_interalcance']);
       $stmt->bindValue($i++, $item['inversion']);
       $stmt->bindValue($i++, $item['indice_interaccion_inversion']);
       $stmt->bindValue($i++, $item['indice_interalcance_inversion']);
// echo "<pre>";
// var_dump($stmt);
// echo"</pre>";

    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
         $conn->rollback();
           //echo $e->getMessage();
          sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}


public function savePageFansp(

$id_page,
$page_fans,
$page_fan_adds_unique,
$page_fan_adds_by_paid_unique,
$page_fan_adds_by_non_paid_unique,
$page_fan_removes_unique,
$page_engaged_users,
$page_impressions,
$page_impressions_unique,
$page_impressions_paid,
$page_impressions_paid_unique,
$page_impressions_organic,
$page_impressions_organic_unique,
$page_impressions_viral,
$page_impressions_viral_unique,
$page_impressions_nonviral,
$page_impressions_nonviral_unique,
$page_content_activity,
$mentions,
$page_fans_online_per_day,
$page_post_engagements,
$page_posts_impressions,
$page_posts_impressions_unique,
$page_posts_impressions_paid,
$page_posts_impressions_paid_unique,
$page_posts_impressions_organic,
$page_posts_impressions_organic_unique,
$page_posts_impressions_viral,
$page_posts_impressions_viral_unique,
$page_posts_impressions_nonviral,
$page_posts_impressions_nonviral_unique,
$clics,
$shares,
$likes,
$comments,
$end_time)
{

// $TodaVerga = 
// $end_time = date("Y-m-d", strtotime($page['end_time']));
echo "<pre>";
var_dump(
// die;
$id_page,
$page_fans,
$page_fan_adds_unique,
$page_fan_adds_by_paid_unique,
$page_fan_adds_by_non_paid_unique,
$page_fan_removes_unique,
$page_engaged_users,
$page_impressions,
$page_impressions_unique,
$page_impressions_paid,
$page_impressions_paid_unique,
$page_impressions_organic,
$page_impressions_organic_unique,
$page_impressions_viral,
$page_impressions_viral_unique,
$page_impressions_nonviral,
$page_impressions_nonviral_unique,
$page_content_activity,
$mentions,
$page_fans_online_per_day,
$page_post_engagements,
$page_posts_impressions,
$page_posts_impressions_unique,
$page_posts_impressions_paid,
$page_posts_impressions_paid_unique,
$page_posts_impressions_organic,
$page_posts_impressions_organic_unique,
$page_posts_impressions_viral,
$page_posts_impressions_viral_unique,
$page_posts_impressions_nonviral,
$page_posts_impressions_nonviral_unique,
$clics,
$shares,
$likes,
$comments,
$end_time
);
echo"</pre>";
// die;
$id_page.
$page_fans. 
$page_fan_adds_unique. 
$page_fan_adds_by_paid_unique. 
$page_fan_adds_by_non_paid_unique. 
$page_fan_removes_unique.
$page_engaged_users.
$page_impressions.
$page_impressions_unique.
$page_impressions_paid.
$page_impressions_paid_unique.
$page_impressions_organic.
$page_impressions_organic_unique.
$page_impressions_viral.
$page_impressions_viral_unique.
$page_impressions_nonviral.
$page_impressions_nonviral_unique.
$page_content_activity.
$mentions.
$page_fans_online_per_day.
$page_post_engagements.
$page_posts_impressions.
$page_posts_impressions_unique.
$page_posts_impressions_paid.
$page_posts_impressions_paid_unique.
$page_posts_impressions_organic.
$page_posts_impressions_organic_unique.
$page_posts_impressions_viral.
$page_posts_impressions_viral_unique.
$page_posts_impressions_nonviral.
$page_posts_impressions_nonviral_unique.
$clics.
$shares.
$likes.
$comments.
$end_time;  
    
        $conn = Database::getInstance();
        $end_time = explode("T",$end_time);
        $end_time = $end_time['0'];
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO ssg_page_fans_facebook (
            id_page,
            page_fans,
            page_fan_adds_unique,
            page_fan_adds_by_paid_unique,
            page_fan_adds_by_non_paid_unique,
            page_fan_removes_unique,
            page_engaged_users,
            page_impressions,
            page_impressions_unique,
            page_impressions_paid,
            page_impressions_paid_unique,
            page_impressions_organic,
            page_impressions_organic_unique,
            page_impressions_viral,
            page_impressions_viral_unique,
            page_impressions_nonviral,
            page_impressions_nonviral_unique,
            page_content_activity,mentions,
            page_fans_online_per_day,
            page_post_engagements,
            page_posts_impressions,
            page_posts_impressions_unique,
            page_posts_impressions_paid,
            page_posts_impressions_paid_unique,
            page_posts_impressions_organic,
            page_posts_impressions_organic_unique,
            page_posts_impressions_viral,
            page_posts_impressions_viral_unique,
            page_posts_impressions_nonviral,
            page_posts_impressions_nonviral_unique,
            clics,
            shares,
            likes,
            comments,
            end_time)
            VALUES(
            :id_page,
            :page_fans,
            :page_fan_adds_unique,
            :page_fan_adds_by_paid_unique,
            :page_fan_adds_by_non_paid_unique,
            :page_fan_removes_unique,
            :page_engaged_users,
            :page_impressions,
            :page_impressions_unique,
            :page_impressions_paid,
            :page_impressions_paid_unique,
            :page_impressions_organic,
            :page_impressions_organic_unique,
            :page_impressions_viral,
            :page_impressions_viral_unique,
            :page_impressions_nonviral,
            :page_impressions_nonviral_unique,
            :page_content_activity,
            :mentions,
            :page_fans_online_per_day,
            :page_post_engagements,
            :page_posts_impressions,
            :page_posts_impressions_unique,
            :page_posts_impressions_paid,
            :page_posts_impressions_paid_unique,
            :page_posts_impressions_organic,
            :page_posts_impressions_organic_unique,
            :page_posts_impressions_viral,
            :page_posts_impressions_viral_unique,
            :page_posts_impressions_nonviral,
            :page_posts_impressions_nonviral_unique,
            :clics,
            :shares,
            :likes,
            :comments,
            :end_time)");
           $statement->execute(array(
                "id_page" => $id_page,
                "page_fans" => $page_fans,
                "page_fan_adds_unique" => $page_fan_adds_unique,
                "page_fan_adds_by_paid_unique" => $page_fan_adds_by_paid_unique,
                "page_fan_adds_by_non_paid_unique" => $page_fan_adds_by_non_paid_unique,
                "page_fan_removes_unique" => $page_fan_removes_unique,
                "page_engaged_users" => $page_engaged_users,
                "page_impressions" => $page_impressions,
                "page_impressions_unique" => $page_impressions_unique,
                "page_impressions_paid" => $page_impressions_paid,
                "page_impressions_paid_unique" => $page_impressions_paid_unique,
                "page_impressions_organic" => $page_impressions_organic,
                "page_impressions_organic_unique" => $page_impressions_organic_unique,
                "page_impressions_viral" => $page_impressions_viral,
                "page_impressions_viral_unique" => $page_impressions_viral_unique,
                "page_impressions_nonviral" => $page_impressions_nonviral,
                "page_impressions_nonviral_unique" => $page_impressions_nonviral_unique,
                "page_content_activity" => $page_content_activity,
                "mentions" => $mentions,
                "page_fans_online_per_day" => $page_fans_online_per_day,
                "page_post_engagements" => $page_post_engagements,
                "page_posts_impressions" => $page_posts_impressions,
                "page_posts_impressions_unique" => $page_posts_impressions_unique,
                "page_posts_impressions_paid" => $page_posts_impressions_paid,
                "page_posts_impressions_paid_unique" => $page_posts_impressions_paid_unique,
                "page_posts_impressions_organic" => $page_posts_impressions_organic,
                "page_posts_impressions_organic_unique" => $page_posts_impressions_organic_unique,
                "page_posts_impressions_viral" => $page_posts_impressions_viral,
                "page_posts_impressions_viral_unique" => $page_posts_impressions_viral_unique,
                "page_posts_impressions_nonviral" => $page_posts_impressions_nonviral,
                "page_posts_impressions_nonviral_unique" => $page_posts_impressions_nonviral_unique,
                "clics" => $clics,
                "shares" => $shares,
                "likes" => $likes,
                "comments" => $comments,
                "end_time" => $end_time
            ));
                 $conn->commit();
                 $save = true;
        } catch (PDOException $e) {
             $conn->rollback();
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__." id page: ".$id_page." ! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}

public function countDataPageFansFacebookp($id_page) {
            $con = Database::getInstance();
            $stmt = $con->prepare(" SELECT * FROM `ssg_page_fans_facebook` WHERE `id_page` = :id_page");
            $stmt->bindParam(':id_page', $id_page);
            $stmt->execute();
            return $stmt->rowCount();
            }
            
    public function checkIfFacebookPageFansRegisterdayExistsp($id_page,$end_time) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT * FROM `ssg_page_fans_facebook` WHERE `end_time` = :end_time AND id_page = :id_page");
            $stmt->bindParam(':end_time', $end_time);
            $stmt->bindParam(':id_page', $id_page);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
        public function getFacebookPageFansOnlineRegisterDayp($id_page,$end_time){
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT page_fans_online_per_day FROM `ssg_page_fans_facebook` WHERE `end_time` = :end_time AND id_page = :id_page");
            $stmt->bindParam(':end_time', $end_time);
            $stmt->bindParam(':id_page', $id_page);
            $stmt->execute();
            $page_fans_online_per_day = $stmt->fetchObject();
    		return $page_fans_online_per_day->page_fans_online_per_day;
            }        
            
       public  function UpdateFacebookPageFansOnlinep($id_page,$page_fans_online_per_day,$end_time){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE ssg_page_fans_facebook SET page_fans_online_per_day = :page_fans_online_per_day WHERE `end_time` = :end_time AND id_page = :id_page";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':page_fans_online_per_day', $page_fans_online_per_day, PDO::PARAM_STR);
                 $sth->bindParam(':end_time', $end_time);
                 $sth->bindParam(':id_page', $id_page);
                 $campos = $sth->execute();
	             return $campos; 
            }  catch (PDOException $e){ die('Fail query');}
        }
        
    public function deleteRegistersPageFansFacebookp($id_page){
          try {
                $conn = Database::getInstance();
                $stmt = $conn->prepare("DELETE FROM ssg_page_fans_facebook WHERE id_page = '".$id_page."'"); 
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
            
  public function deleteRegistersPageDemographicFacebookp($id_page){
          try {
                $conn = Database::getInstance();
                $stmt = $conn->prepare("DELETE FROM ssg_page_fans_gender_age WHERE id_page = '".$id_page."'"); 
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
            
        
public function deletePostsp($id_page){
      try {
            $conn = Database::getInstance();
            $stmt = $conn->prepare("DELETE FROM ssg_post_page_facebook WHERE page_id = '".$id_page."'"); 
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
        
      public function getIdAdFacebookp($postId)
        {
     	    try {
    			 $dbh = Database::getInstance();
    			 $sql = "SELECT ad_id FROM `ad_creative_facebook` WHERE `object_story_id` = '".$postId."'";
    			 $sth = $dbh->prepare($sql);
    			 $sth->execute();
    			 $spend = $sth->fetchAll();
    			 return $spend;
    			 }catch (PDOException $e) {
    			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
        }
    
  public function getTotalSpendFacebookAdp($ad_id=null)
    {
 	    try {
			 $dbh = Database::getInstance();
			 $sql = "SELECT SUM(spend) as inversion FROM `aiw_facebook_data_ads` WHERE `ad_id` = '".$ad_id."'";
			 $sth = $dbh->prepare($sql);
			 $sth->execute();
			 $spend = $sth->fetchObject();
			 return $spend->inversion; 
			 }catch (PDOException $e) {
			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
    }
    
    /* Facebook page demographic */
    
	public function savePageFansDemographicp($id_page, $end_time, $sexo_edad, $fans, $resta)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO ssg_page_fans_gender_age (id_page, end_time, sexo_edad, fans, resta) VALUES (:id_page,  :end_time, :sexo_edad, :fans, :resta)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_page', $id_page, PDO::PARAM_INT);
			$sth->bindParam(':end_time', $end_time, PDO::PARAM_STR);
			$sth->bindParam(':sexo_edad', $sexo_edad, PDO::PARAM_STR);
			$sth->bindParam(':fans', $fans, PDO::PARAM_STR);
			$sth->bindParam(':resta', $resta, PDO::PARAM_STR);
			$sth->execute();
			$id = $dbh->lastInsertId();
			return $id;						
			}catch (PDOException $e){ 
			    die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); 
			}
	}
	
	public function countDataPageFansDemographicFacebookp($id_page) {
            $con = Database::getInstance();
            $stmt = $con->prepare(" SELECT * FROM `ssg_page_fans_gender_age` WHERE `id_page` = :id_page");
            $stmt->bindParam(':id_page', $id_page);
            $stmt->execute();
            return $stmt->rowCount();
            }
            
    public function checkIfFacebookPageFansDemographicRegisterdayExistsp($id_page,$end_time) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT * FROM `ssg_page_fans_gender_age` WHERE `end_time` = :end_time AND id_page = :id_page");
            $stmt->bindParam(':end_time', $end_time);
            $stmt->bindParam(':id_page', $id_page);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }	
    
    /* Facebook Ad Account */
	public function InsertFacebookAdAccountp($id_adaccount,  $id_facebook, $adaccount_name, $adaccount_status , $id_business, $business, $access_token, $created_time, $state)
		{
			try{
			$dbh = Database::getInstance();
			$sql = "INSERT INTO ssg_facebook_adaccount (id_adaccount,  id_facebook, adaccount_name, adaccount_status , id_business, business, access_token, created_time, state) VALUES (:id_adaccount,  :id_facebook, :adaccount_name, :adaccount_status , :id_business, :business, :access_token, :created_time, :state)";
			$sth = $dbh->prepare($sql);
			$sth->bindParam(':id_adaccount', $id_adaccount, PDO::PARAM_INT);
			$sth->bindParam(':id_facebook', $id_facebook, PDO::PARAM_STR);
			$sth->bindParam(':adaccount_name', $adaccount_name, PDO::PARAM_STR);
			$sth->bindParam(':adaccount_status', $adaccount_status, PDO::PARAM_STR);
			$sth->bindParam(':id_business', $id_business, PDO::PARAM_STR);
			$sth->bindParam(':business', $business, PDO::PARAM_STR);
			$sth->bindParam(':access_token', $access_token, PDO::PARAM_STR);
			$sth->bindParam(':created_time', $created_time, PDO::PARAM_STR);
			$sth->bindParam(':state', $state, PDO::PARAM_STR);
			$sth->execute();
			$id = $dbh->lastInsertId();
			return $id;						
			}catch (PDOException $e){ 
			    die( 'Fallo en query: ' .__METHOD__." - ". $e->getMessage() ); 
			}
	}
	//aca es donde inserta los datos de inversion por publicacion en el grafico de index
	public function SaveFacebookAdAccountDatap($data){
    $conn = Database::getInstance();
    $conn->beginTransaction();
    $query = "INSERT INTO ssg_facebook_adaccount_data (`id_adaccount`, `campaign_id`, `id_ad`, `creative_id`, `object_story_id`, `ad_reach`, `ad_spend`, `updated_time`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
       $stmt->bindValue($i++, $item['id_adaccount']);
       $stmt->bindValue($i++, $item['campaign_id']);
       $stmt->bindValue($i++, $item['id_ad']);
       $stmt->bindValue($i++, $item['creative_id']);
       $stmt->bindValue($i++, $item['object_story_id']);
       $stmt->bindValue($i++, $item['ad_reach']);
       $stmt->bindValue($i++, $item['ad_spend']);
       $stmt->bindValue($i++, $item['updated_time']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
         $conn->rollback();
          echo $e->getMessage();
         // sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}
//y aca lo selecciona
     	public function getAdAccountDatap($id_adaccount) {
            $con = Database::getInstance();
            $stmt = $con->prepare("SELECT * FROM `ssg_facebook_adaccount_data` WHERE `id_adaccount` = :id_adaccount");
            $stmt->bindParam(':id_adaccount', $id_adaccount);
            try {
            $stmt->execute();
            $data = $stmt->fetchAll();
                    return $data;
            } catch (PDOException $e){
          echo $e->getMessage();
                 // sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
                //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
                }
            }
            
    public function deleteAdsForAdAccountp($id_adaccount){
      try {
            $conn = Database::getInstance();
            $stmt = $conn->prepare("DELETE FROM ssg_facebook_adaccount_data WHERE id_adaccount = '".$id_adaccount."'"); 
            $stmt->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                //echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }
        
        public function checkIfFacebookAdAccountIsActivep($id_adaccount) {
            $con = Database::getInstance();
            $stmt = $con->prepare(" SELECT * FROM `ssg_facebook_adaccount` WHERE `id_adaccount` = :id_adaccount AND `state` = 'active'");
            $stmt->bindParam(':id_adaccount', $id_adaccount);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }
            
        public function checkIfExistsFacebookAdAccountp($id_adaccount) {
            $con = Database::getInstance();
            $stmt = $con->prepare(" SELECT * FROM `ssg_facebook_adaccount` WHERE `id_adaccount` = :id_adaccount");
            $stmt->bindParam(':id_adaccount', $id_adaccount);
            $stmt->execute();
                if($stmt->rowCount() > 0){
                    return true;
                } else {
                    return false;
                }
            }            
        
         public  function UpdateFacebookAdAccountp($id_adaccount,$access_token,$updated_time,$state){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_adaccount SET access_token = :access_token, state = :state, updated_time = :updated_time WHERE id_adaccount = :id_adaccount";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_adaccount', $id_adaccount, PDO::PARAM_STR);
                 $sth->bindParam(':access_token', $access_token, PDO::PARAM_STR);
                 $sth->bindParam(':updated_time', $updated_time, PDO::PARAM_STR);
                 $sth->bindParam(':state', $state, PDO::PARAM_STR);
                 $campos = $sth->execute();
	             return $campos; 
            }  catch (PDOException $e){ die('Fail query');}
        }  
        
       public function getTokenForFacebookAdAccountp($id_adaccount)
            {
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
            
    public  function UpdateMessageFacebookAdAccountp($id_adaccount,$last_message){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_adaccount SET last_message = :last_message WHERE id_adaccount = :id_adaccount";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_adaccount', $id_adaccount, PDO::PARAM_STR);
                 $sth->bindParam(':last_message', $last_message, PDO::PARAM_STR);
                 $campos = $sth->execute();
	             return $campos; 
            }  catch (PDOException $e){ die('Fail query');}
        }
        
           public function getActiveFacebookAdAccountJobsp()
            {
         	    try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT id_adaccount FROM `ssg_facebook_adaccount` WHERE `state` = 'active'";
        			 $sth = $dbh->prepare($sql);
        			 $sth->execute();
        			 $jobs = $sth->fetchAll();
        			 return $jobs;
        			 }catch (PDOException $e) {
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            }            
        //aca los selecciona 
         public function getInversionp($object_story_id)
            {
         	    try {
        			 $dbh = Database::getInstance();
        			 $sql = "SELECT SUM(ad_spend) AS ad_spend FROM `ssg_facebook_adaccount_data` WHERE `object_story_id` = :object_story_id";
        			 $sth = $dbh->prepare($sql);
        			 $sth->bindParam(':object_story_id', $object_story_id, PDO::PARAM_STR);
        			 $sth->execute();
        			 $jobs = $sth->fetchObject();
        			 return $jobs->ad_spend;
        			 }catch (PDOException $e) {
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            }  
            
   //conversations and messages
function saveMessagesPostsOfFacebookPagep($data,$page_id,$post_id){
    $conn = Database::getInstance();
    $conn->beginTransaction();
$query = "INSERT INTO ssg_facebook_comments (`id`, `page_id`, `post_id`, `parent_id`, `from_id`, `from_name`, `created_time`, `message`, `comment_count`, `like_count`, `user_likes`, `is_hidden`, `attachment_title`,`attachment_type`, `attachment_url`, `attachment_media_image_src`, `can_comment`, `can_remove`,`can_hide`,`can_like`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
       $id = isset($item['id']) ? $item['id'] : "";
       $stmt->bindValue($i++, $id);
       $stmt->bindValue($i++, $page_id);
       $stmt->bindValue($i++, $post_id);
       $parent_id = isset($item['parent']['id']) ? $item['parent']['id'] : "";
       $stmt->bindValue($i++, $parent_id);
       $stmt->bindValue($i++, $item['from']['id']);
       $stmt->bindValue($i++, $item['from']['name']);
       $stmt->bindValue($i++, $item['created_time']);
       $message = isset($item['message']) ? $item['message'] : "";
       $stmt->bindValue($i++, $message);
       $stmt->bindValue($i++, $item['comment_count']);
       $stmt->bindValue($i++, $item['like_count']);
       $stmt->bindValue($i++, $item['user_likes']);
       $stmt->bindValue($i++, $item['is_hidden']);
       $attachment_title = isset($item['attachment']['title']) ? $item['attachment']['title'] : "";
       $stmt->bindValue($i++, $attachment_title);
       $attachment_type = isset($item['attachment']['type']) ? $item['attachment']['type'] : "";
       $stmt->bindValue($i++, $attachment_type);
       $attachment_url = isset($item['attachment']['url']) ? $item['attachment']['url'] : "";
       $stmt->bindValue($i++, $attachment_url);
       $attachment_media_image_src = isset($item['attachment']['media']['image']['src']) ? $item['attachment']['media']['image']['src'] : "";
       $stmt->bindValue($i++, $attachment_media_image_src);
       $stmt->bindValue($i++, $item['can_comment']);
       $stmt->bindValue($i++, $item['can_remove']);
       $stmt->bindValue($i++, $item['can_hide']);
       $stmt->bindValue($i++, $item['can_like']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
        $conn->rollback();
           echo $e->getMessage();
          sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}

function saveConversationsOfFacebookPagepp($data,$page_id){
    $conn = Database::getInstance();
    $conn->beginTransaction();
$query = "INSERT INTO ssg_facebook_conversations (`id`, `page_id`, `snippet`, `link`, `updated_time`, `from_id`, `from_name`, `from_email`, `message_count`, `unread_count`, `can_reply`, `is_subscribed`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data as $item) { //bind the values one by one
       $id = isset($item['id']) ? $item['id'] : "";
       $stmt->bindValue($i++, $id);
       $stmt->bindValue($i++, $page_id);
       $snippet = isset($item['snippet']) ? $item['snippet'] : "";
       $stmt->bindValue($i++, $snippet);
       $stmt->bindValue($i++, $item['link']);
       $stmt->bindValue($i++, $item['updated_time']);
       $stmt->bindValue($i++, $item['participants']['data']['0']['id']);
       $stmt->bindValue($i++, $item['participants']['data']['0']['name']);
       $stmt->bindValue($i++, $item['participants']['data']['0']['email']);
       $message_count = isset($item['message_count']) ? $item['message_count'] : "";
       $stmt->bindValue($i++, $message_count);
       $stmt->bindValue($i++, $item['unread_count']);
       $stmt->bindValue($i++, $item['can_reply']);
       $stmt->bindValue($i++, $item['is_subscribed']);
    }
    try {
        $stmt->execute(); //execute
     } catch (PDOException $e){
        $conn->rollback();
           echo $e->getMessage();
          //sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
        $conn->commit();
}


function saveMessagesConversationsOfFacebookPage($data,$page_id,$conversation_id){
     
    
    $conn = Database::getInstance();
    
    //$conn->beginTransaction();
$query = "INSERT INTO ssg_conversations_messages_facebook (`id`, `page_id`, `conversation_id`, `message`, `created_time`, `from_id`,`from_email`, `from_name`, `to_id`, `to_email`, `to_name`, `tags`,`share`) VALUES "; //Prequery
    $qPart = array_fill(0, count($data['data']), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query .=  implode(",",$qPart);
    $stmt = $conn->prepare($query); 
    $i = 1;
    foreach($data['data'] as $item) { //bind the values one by one
       $id = isset($item['id']) ? $item['id'] : "";
       $message = isset($item['message']) ? $item['message'] : "";
       $created_time = isset($item['created_time']) ? $item['created_time'] : "";
       $from_id = isset($item['from']['id']) ? $item['from']['id'] : "";
       $from_email = isset($item['from']['email']) ? $item['from']['email'] : "";
       $from_name = isset($item['from']['name']) ? $item['from']['name'] : "";     
       $to_id = isset($item['to']['data']['0']['id']) ? $item['to']['data']['0']['id'] : "";
       $to_email = isset($item['to']['data']['0']['email']) ? $item['to']['data']['0']['email'] : "";
       $to_name = isset($item['to']['data']['0']['name']) ? $item['to']['data']['0']['name'] : "";
       $tags = isset($item['tags']['data']) ? json_encode($item['tags']['data'],true) : "";
       $share = isset($item['shares']['data']) ? json_encode($item['shares']['data'],true) : "NULL";
       $stmt->bindValue($i++, $id);
       $stmt->bindValue($i++, $page_id);
       $stmt->bindValue($i++, $conversation_id);
       $stmt->bindValue($i++, $message);
       $stmt->bindValue($i++, $created_time);
       $stmt->bindValue($i++, $from_id);
       $stmt->bindValue($i++, $from_email);       
       $stmt->bindValue($i++, $from_name);       
       $stmt->bindValue($i++, $to_id);
       $stmt->bindValue($i++, $to_email);
       $stmt->bindValue($i++, $to_name);
       $stmt->bindValue($i++, $tags);
       $stmt->bindValue($i++, $share);
    }
     try {   
        $stmt->execute(); //execute
        
     } catch (PDOException $e){
        $conn->rollback();
           //echo $e->getMessage();
           //var_dump($message);
        
         // sendMailer("pedro@mimirwell.com","Job fállido guardar data  ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        //  sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$e->getMessage()." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
         //$save = false;
        }
    return $save;
}
       //$conn->commit();


function deleteMessagesPostsPagep($id_page){
      try {
            $conn = Database::getInstance();
            $stmt = $conn->prepare("DELETE FROM ssg_facebook_comments WHERE page_id = '".$id_page."'"); 
            $stmt->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                //echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }

function deleteConversationsPagep($id_page){
      try {
            $conn = Database::getInstance();
            $stmt = $conn->prepare("DELETE FROM ssg_facebook_conversations WHERE page_id = '".$id_page."'"); 
            $stmt->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                //echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }
        
function primeracarga($id_page){
     $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount, messages_restar_day FROM `ssg_facebook_page_primera_carga` WHERE messages_status='1' LIMIT 1 ");
                         $stm->execute();
                         $job = $stm->fetchAll();
                         //var_dump($job);
                         $lastdate = $job['0']['1'];//id_account
                         $lastdate1 =$job['0']['0'];//id_ssg
                         $lastdate2 =$job['0']['2'];//fecha
        
                         $diaconsulta = date(strtotime("$lastdate2")); // la primera vez que comience a jalar datos
                         $now = date ('Y-m-d');
                         $today = date(strtotime("$now"));
                         $diaconsultabreak = date(strtotime("$lastdate2"));
                        // var_dump($job);
                           $totaldia = (($today - $diaconsultabreak  -86400 )/86400);
                           //var_dump($totaldia);
                           //die;
                        
                $id_ssgfacebookpostpagejob = $lastdate1;
      try {
            $conn = Database::getInstance();
                          $stm = $conn->prepare("update `ssg_facebook_page_primera_carga` set  messages_restar_day= ADDDATE(messages_restar_day, INTERVAL  1 DAY)    where id_ssgfacebookpostpagejob=$id_ssgfacebookpostpagejob  ");
                          $stm->execute();
                          $conn = Database::getInstance();
                          $yesterday = date( "Y-m-d", strtotime( "-1 day", strtotime( $now ) ) );
                          $stm = $conn->prepare("update `ssg_facebook_page_primera_carga` set messages_status='2' where messages_restar_day='$yesterday' ");
                          $stm->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                //echo "Error: " . $e->getMessage();
            }
            $conn = null;
        }  
        //job messages
         public  function UpdateStateFacebookPostPageCommentsInJobp($id_ssgfacebookpostpagejob,$updated_time,$comments_last_message){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_post_page_job SET updated_time = :updated_time, comments_last_message = :comments_last_message WHERE id_ssgfacebookpostpagejob = :id_ssgfacebookpostpagejob";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_ssgfacebookpostpagejob', $id_ssgfacebookpostpagejob, PDO::PARAM_STR);
                 $sth->bindParam(':updated_time', $updated_time, PDO::PARAM_STR);
                 $sth->bindParam(':comments_last_message', $comments_last_message, PDO::PARAM_STR);
                 $sth->execute();
	             $count = $sth->rowCount();
			       return $count;
            }  catch (PDOException $e){ die('Fail query'); }
        }
        
         public  function UpdateStateFacebookPostPageConversationsInJobp($id_ssgfacebookpostpagejob,$updated_time,$conversations_last_message){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_post_page_job SET updated_time = :updated_time, conversations_last_message = :conversations_last_message WHERE id_ssgfacebookpostpagejob = :id_ssgfacebookpostpagejob";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_ssgfacebookpostpagejob', $id_ssgfacebookpostpagejob, PDO::PARAM_STR);
                 $sth->bindParam(':updated_time', $updated_time, PDO::PARAM_STR);
                 $sth->bindParam(':conversations_last_message', $conversations_last_message, PDO::PARAM_STR);
                 $sth->execute();
	             $count = $sth->rowCount();
			       return $count;
            }  catch (PDOException $e){ die('Fail query'); }
        } 
        
         public  function UpdateStateFacebookPostPageDemogInJobp($id_ssgfacebookpostpagejob,$updated_time,$demog_last_message){
            try{
                 $dbh = Database::getInstance();
                 $sql = "UPDATE  ssg_facebook_post_page_job SET updated_time = :updated_time, demog_last_message = :demog_last_message WHERE id_ssgfacebookpostpagejob = :id_ssgfacebookpostpagejob";
                 $sth = $dbh->prepare($sql);
                 $sth->bindParam(':id_ssgfacebookpostpagejob', $id_ssgfacebookpostpagejob, PDO::PARAM_STR);
                 $sth->bindParam(':updated_time', $updated_time, PDO::PARAM_STR);
                 $sth->bindParam(':demog_last_message', $demog_last_message, PDO::PARAM_STR);
                 $sth->execute();
	             $count = $sth->rowCount();
			       return $count;
            }  catch (PDOException $e){ die('Fail query'); }
        }    
        
    //guardar fans online por hora
    public function insertInsightsFansOnlineForHourFacebookp($cursor,$id_page,$since){
        foreach ($cursor as $key => $value) {
            $link = Database::getInstance();
            try
            {
                $link->beginTransaction();
                $statement = $link->prepare("INSERT INTO ssg_page_fans_online_facebook (id_page,end_time,hora,fans)
                    VALUES(:id_page,:end_time,:hora,:fans)");
                $statement->execute(array(
                    "id_page" => $id_page,
                    "end_time" => $since,
                    "hora" => $key,
                    "fans" => $value
                ));
                $save = true;
                $link->commit();
            } catch (PDOException $e) {
                // echo $e->getMessage();
                error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
                //sendMailer("ssgdeveloperalerts@mimirwell.com","Hubo un error en guardado en ",__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage());
                $save = false;
                $link->rollback();
            }
        }
        return $save;
    } 
    
    public function deleteFansOnlineForPagep($id_page){
      try {
            $conn = Database::getInstance();
            $stmt = $conn->prepare("DELETE FROM ssg_page_fans_online_facebook WHERE id_page = '".$id_page."'"); 
            $stmt->execute();
            $qtyBd = $stmt->Rowcount();
            return $qtyBd;
            }
            catch(PDOException $e) {
                 return null;
                //echo "Error: " . $e->getMessage();
            }
            $conn = null;
        } 
    
}