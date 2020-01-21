<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class FacebookModel{
     public function __construct(){}
     
     public function getFacebookPostPageJob($id_ssgfacebookpostpagejob)
            {   
               
                        $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,user_restart_day FROM `ssg_facebook_page_primera_carga` WHERE user_status='1' LIMIT 1");
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
     public function savePageUserDemographics($id_page,$page,$pageDate)
     {
             $conec = Database::getInstance();
                         $stm = $conec->prepare("SELECT id_ssgfacebookpostpagejob, id_adaccount,user_restart_day FROM `ssg_facebook_page_primera_carga` WHERE user_status='1' LIMIT 1 ");
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
            $statement = $conec->prepare("INSERT INTO `ssg_facebook_user_demographics`
            (`id_page`,
            `page_fans`,
            `page_fan_adds_unique`,

            `page_fans_gender_age_Female_65`,
            `page_fans_gender_age_Female_55_64`,
            `page_fans_gender_age_Female_45_54`,
            `page_fans_gender_age_Female_35_44`,
            `page_fans_gender_age_Female_25_34`,
            `page_fans_gender_age_Female_18_24`,
            `page_fans_gender_age_Female_13_17`,
            
            `page_fans_gender_age_Male_65`,
            `page_fans_gender_age_Male_55_64`,
            `page_fans_gender_age_Male_45_54`,
            `page_fans_gender_age_Male_35_44`,
            `page_fans_gender_age_Male_25_34`,
            `page_fans_gender_age_Male_18_24`,
            `page_fans_gender_age_Male_13_17`,
            
            `page_fans_gender_age_Undefine_65`,
            `page_fans_gender_age_Undefine_55_64`,
            `page_fans_gender_age_Undefine_45_54`,
            `page_fans_gender_age_Undefine_35_44`,
            `page_fans_gender_age_Undefine_25_34`,
            `page_fans_gender_age_Undefine_18_24`,
            `end_time`


            )VALUES(
            :id_page,
            :page_fans,
            :page_fan_adds_unique,
            
            :page_fans_gender_age_Female_65,
            :page_fans_gender_age_Female_55_64,
            :page_fans_gender_age_Female_45_54,
            :page_fans_gender_age_Female_35_44,
            :page_fans_gender_age_Female_25_34,
            :page_fans_gender_age_Female_18_24,
            :page_fans_gender_age_Female_13_17,
            
            :page_fans_gender_age_Male_65,
            :page_fans_gender_age_Male_55_64,
            :page_fans_gender_age_Male_45_54,
            :page_fans_gender_age_Male_35_44,
            :page_fans_gender_age_Male_25_34,
            :page_fans_gender_age_Male_18_24,
            :page_fans_gender_age_Male_13_17,
            
            :page_fans_gender_age_Undefine_65,
            :page_fans_gender_age_Undefine_55_64,
            :page_fans_gender_age_Undefine_45_54,
            :page_fans_gender_age_Undefine_35_44,
            :page_fans_gender_age_Undefine_25_34,
            :page_fans_gender_age_Undefine_18_24,
            :end_time
            
)");
            
            $statement->bindParam(':id_page', $id_page, PDO::PARAM_STR);
            $statement->bindParam(':page_fans', $page['page_fans']);
            $statement->bindParam(':page_fan_adds_unique', $page['page_fan_adds_unique']);

            $statement->bindParam(':page_fans_gender_age_Female_65',$page['page_fans_gender_age']["F.65+"]);    
            $statement->bindParam(':page_fans_gender_age_Female_55_64', $page['page_fans_gender_age']["F.55-64"]);
            $statement->bindParam(':page_fans_gender_age_Female_45_54', $page['page_fans_gender_age']["F.45-54"]);
            $statement->bindParam(':page_fans_gender_age_Female_35_44', $page['page_fans_gender_age']["F.35-44"]);
            $statement->bindParam(':page_fans_gender_age_Female_25_34', $page['page_fans_gender_age']["F.25-34"]);
            $statement->bindParam(':page_fans_gender_age_Female_18_24', $page['page_fans_gender_age']["F.18-24"]);
            $statement->bindParam(':page_fans_gender_age_Female_13_17', $page['page_fans_gender_age']["F.13-17"]);
            
            $statement->bindParam(':page_fans_gender_age_Male_65', $page['page_fans_gender_age']["M.65+"]);
            $statement->bindParam(':page_fans_gender_age_Male_55_64', $page['page_fans_gender_age']["M.55-64"]);
            $statement->bindParam(':page_fans_gender_age_Male_45_54', $page['page_fans_gender_age']["M.45-54"]);
            $statement->bindParam(':page_fans_gender_age_Male_35_44', $page['page_fans_gender_age']["M.35-44"]);
            $statement->bindParam(':page_fans_gender_age_Male_25_34', $page['page_fans_gender_age']["M.25-34"]);
            $statement->bindParam(':page_fans_gender_age_Male_18_24', $page['page_fans_gender_age']["M.18-24"]);
            $statement->bindParam(':page_fans_gender_age_Male_13_17', $page['page_fans_gender_age']["M.13-17"]);
            
            $statement->bindParam(':page_fans_gender_age_Undefine_65', $page['page_fans_gender_age']["U.65+"]);
            $statement->bindParam(':page_fans_gender_age_Undefine_55_64', $page['page_fans_gender_age']["U.55-64"]);
            $statement->bindParam(':page_fans_gender_age_Undefine_45_54', $page['page_fans_gender_age']["M.45-54"]);
            $statement->bindParam(':page_fans_gender_age_Undefine_35_44', $page['page_fans_gender_age']["U.35-44"]);
            $statement->bindParam(':page_fans_gender_age_Undefine_25_34', $page['page_fans_gender_age']["U.25-34"]);
            $statement->bindParam(':page_fans_gender_age_Undefine_18_24', $page['page_fans_gender_age']["U.18-24"]);
            $statement->bindParam(':end_time', $pageDate["page_fans"]);

            
                          $conec = Database::getInstance();
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set  user_restart_day= ADDDATE(user_restart_day, INTERVAL  1 DAY)    where id_ssgfacebookpostpagejob=$id_ssgfacebookpostpagejob  ");
                          $stm->execute();
                          $conec = Database::getInstance();
                          $yesterday = date( "Y-m-d", strtotime( "-1 day", strtotime( $now ) ) );
                          $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set user_status='2' where user_restart_day='$yesterday' ");
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
          //  sendMailer("jose@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__." id_page: ".$id_page." ! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
         
     }
