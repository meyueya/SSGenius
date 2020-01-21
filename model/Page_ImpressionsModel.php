<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class FacebookModel{
     public function __construct(){}
     
     public function getFacebookPostPageJob($id_ssgfacebookpostpagejob)
            {   
               
                        $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,impressions_restart_day FROM `ssg_facebook_page_primera_carga` WHERE impressions_status='1' LIMIT 1");
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
     public function savePageImpressions($id_page,$page,$pageDate)
     {
            

                         $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,impressions_restart_day FROM `ssg_facebook_page_primera_carga` WHERE impressions_status='1' LIMIT 1 ");
                         $stm->execute();
                         $job = $stm->fetchAll();
                         $lastdate = $job['0']['1'];//id_account
                         $lastdate1 =$job['0']['0'];//id_ssg
                         $lastdate2 =$job['0']['2'];//fecha
        
                         $diaconsulta = date(strtotime("$lastdate2")); // la primera vez que comience a jalar datos
                         $now = date ('Y-m-d');
                         $today = date(strtotime("$now"));
                         $diaconsultabreak = date(strtotime("$lastdate2"));
                         //var_dump($job);
                           $totaldia = (($today - $diaconsultabreak  -86400 )/86400);
                          // die;
                        
                $id_ssgfacebookpostpagejob = $lastdate1;
        $conec = Database::getInstance();
       
        try
        {
            $conec->beginTransaction();
            $statement = $conec->prepare("INSERT INTO `ssg_facebook_page_impressions`
            (`id_page`,
            `page_fans`,
            `page_impressions`,
            `page_impressions_unique`,
            `page_impressions_paid`,
            `page_impressions_paid_unique`,
            `page_impressions_organic`,
            `page_impressions_organic_unique`,
            `page_impressions_viral`,
            `page_impressions_viral_unique`,
            `page_impressions_nonviral`,
            `page_impressions_nonviral_unique`,
            `page_impressions_by_story_type`,
            `page_impressions_by_story_type_unique`,
            `page_impressions_by_age_gender_unique_Female_65`,
            `page_impressions_by_age_gender_unique_Female_55_64`,
            `page_impressions_by_age_gender_unique_Female_45_54`,
            `page_impressions_by_age_gender_unique_Female_35_44`,
            `page_impressions_by_age_gender_unique_Female_25_34`,
            `page_impressions_by_age_gender_unique_Female_18_24`,
            `page_impressions_by_age_gender_unique_Female_13_17`,
            `page_impressions_by_age_gender_unique_Male_65`,
            `page_impressions_by_age_gender_unique_Male_55_64`,
            `page_impressions_by_age_gender_unique_Male_45_54`,
            `page_impressions_by_age_gender_unique_Male_35_44`,
            `page_impressions_by_age_gender_unique_Male_25_34`,
            `page_impressions_by_age_gender_unique_Male_18_24`,
            `page_impressions_by_age_gender_unique_Male_13_17`,
            `page_impressions_by_age_gender_unique_Undefine_65`,
            `page_impressions_by_age_gender_unique_Undefine_55_64`,
            `page_impressions_by_age_gender_unique_Undefine_35_44`,
            `page_impressions_by_age_gender_unique_Undefine_25_34`,
            `page_impressions_by_age_gender_unique_Undefine_18_24`,
            `end_time`


            )VALUES(
            :id_page,
            :page_fans,
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
            :page_impressions_by_story_type,
            :page_impressions_by_story_type_unique,
            :page_impressions_by_age_gender_unique_Female_65,
            :page_impressions_by_age_gender_unique_Female_55_64,
            :page_impressions_by_age_gender_unique_Female_45_54,
            :page_impressions_by_age_gender_unique_Female_35_44,
            :page_impressions_by_age_gender_unique_Female_25_34,
            :page_impressions_by_age_gender_unique_Female_18_24,
            :page_impressions_by_age_gender_unique_Female_13_17,
            :page_impressions_by_age_gender_unique_Male_65,
            :page_impressions_by_age_gender_unique_Male_55_64,
            :page_impressions_by_age_gender_unique_Male_45_54,
            :page_impressions_by_age_gender_unique_Male_35_44,
            :page_impressions_by_age_gender_unique_Male_25_34,
            :page_impressions_by_age_gender_unique_Male_18_24,
            :page_impressions_by_age_gender_unique_Male_13_17,
            :page_impressions_by_age_gender_unique_Undefine_65,
            :page_impressions_by_age_gender_unique_Undefine_55_64,
            :page_impressions_by_age_gender_unique_Undefine_35_44,
            :page_impressions_by_age_gender_unique_Undefine_25_34,
            :page_impressions_by_age_gender_unique_Undefine_18_24,
            :end_time
)");
            
            $statement->bindParam(':id_page', $id_page, PDO::PARAM_STR);
            $statement->bindParam(':page_fans', $page['page_fans']);
            $statement->bindParam(':page_impressions', $page['page_impressions']);
            $statement->bindParam(':page_impressions_unique', $page['page_impressions_unique']);
            $statement->bindParam(':page_impressions_paid', $page['page_impressions_paid']);
            $statement->bindParam(':page_impressions_paid_unique', $page['page_impressions_paid_unique']);
            $statement->bindParam(':page_impressions_organic', $page['page_impressions_organic']);
            $statement->bindParam(':page_impressions_organic_unique', $page['page_impressions_organic_unique']);
            $statement->bindParam(':page_impressions_viral', $page['page_impressions_viral']);
            $statement->bindParam(':page_impressions_viral_unique', $page['page_impressions_viral_unique']);
            $statement->bindParam(':page_impressions_nonviral', $page['page_impressions_nonviral']);
            $statement->bindParam(':page_impressions_nonviral_unique', $page['page_impressions_nonviral_unique']);
            $statement->bindParam(':page_impressions_by_story_type', $page['page_impressions_by_story_type']);
            $statement->bindParam(':page_impressions_by_story_type_unique',  $page['page_impressions_by_story_type_unique']);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Female_65',$page['page_impressions_by_age_gender_unique']["F.65+"]);    
            $statement->bindParam(':page_impressions_by_age_gender_unique_Female_55_64', $page['page_impressions_by_age_gender_unique']["F.55-64"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Female_45_54', $page['page_impressions_by_age_gender_unique']["F.45-54"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Female_35_44', $page['page_impressions_by_age_gender_unique']["F.35-44"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Female_25_34', $page['page_impressions_by_age_gender_unique']["F.25-34"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Female_18_24', $page['page_impressions_by_age_gender_unique']["F.18-24"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Female_13_17', $page['page_impressions_by_age_gender_unique']["F.13-17"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Male_65', $page['page_impressions_by_age_gender_unique']["M.65+"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Male_55_64', $page['page_impressions_by_age_gender_unique']["M.55-64"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Male_45_54', $page['page_impressions_by_age_gender_unique']["M.45-54"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Male_35_44', $page['page_impressions_by_age_gender_unique']["M.35-44"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Male_25_34', $page['page_impressions_by_age_gender_unique']["M.25-34"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Male_18_24', $page['page_impressions_by_age_gender_unique']["M.18-24"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Male_13_17', $page['page_impressions_by_age_gender_unique']["M.13-17"]);
            
            $statement->bindParam(':page_impressions_by_age_gender_unique_Undefine_65', $page['page_impressions_by_age_gender_unique']["U.65+"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Undefine_55_64', $page['page_impressions_by_age_gender_unique']["U.55-64"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Undefine_35_44', $page['page_impressions_by_age_gender_unique']["U.35-44"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Undefine_25_34', $page['page_impressions_by_age_gender_unique']["U.25-34"]);
            $statement->bindParam(':page_impressions_by_age_gender_unique_Undefine_18_24', $page['page_impressions_by_age_gender_unique']["U.18-24"]);
            $statement->bindParam(':end_time', $pageDate["page_fans"]);
            
            
                          $conec = Database::getInstance();
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set  impressions_restart_day= ADDDATE(impressions_restart_day, INTERVAL  1 DAY)    where id_ssgfacebookpostpagejob=$id_ssgfacebookpostpagejob  ");
                          $stm->execute();
                          $conec = Database::getInstance();
                          $conec = Database::getInstance();
                          $yesterday = date( "Y-m-d", strtotime( "-1 day", strtotime( $now ) ) );
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set impressions_status='2' where impressions_restart_day='$yesterday' ");
                          $stm->execute();
            
        //     echo "<pre>";
        // var_dump($page);
        //     echo"</pre>";
            // die;
           $statement->execute();
                  $conec->commit();
                  $save = true;
    // echo "<pre>";
    // var_dump($statement);
    // echo"</pre>";
    //   die;
        } catch (PDOException $e) {
             $conec->rollback();
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("jose@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__." id_page: ".$id_page." ! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
         
     }
