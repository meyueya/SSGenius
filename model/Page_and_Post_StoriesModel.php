<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");
class FacebookModell{
     public function __construct(){}
     
     public function getFacebookPostPageJob($id_ssgfacebookpostpagejob)
            {   
                $id_ssgfacebookpostpagejob = '1';
               // var_dump($id_ssgfacebookpostpagejob);
                //die;
                
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
        			  die( 'Fallo en query: ' .__LINE__." ". $e->getMessage() );}   
            } 
     public function savePagePostStories($id_page,$page)
     {
        //     echo "<pre>";
        // var_dump($page['page_fans']);
        //     echo"</pre>";
        //         die;

        $conn = Database::getInstance();
        
        try
        {
            $conn->beginTransaction();
            $statement = $conn->prepare("INSERT INTO `ssg_facebook_page_and_post_stories` (
            `id_page`,
            `page_fans`,
            `page_content_activity`,
            `page_content_activity_by_action_type_unique_page_post`,
            `page_content_activity_by_action_type_unique_fan`,
            `page_content_activity_by_action_type_unique_other`,
            `page_content_activity_by_age_gender_unique_Male_65`,
            `page_content_activity_by_age_gender_unique_Male_55_64`,
            `page_content_activity_by_age_gender_unique_Male_45_54`,
            `page_content_activity_by_age_gender_unique_Male_35_44`,
            `page_content_activity_by_age_gender_unique_Male_25_34`,
            `page_content_activity_by_age_gender_unique_Male_18_24`,
            `page_content_activity_by_age_gender_unique_Female_55_64`,
            `page_content_activity_by_age_gender_unique_Female_45_54`,
            `page_content_activity_by_age_gender_unique_Female_35_44`,
            `page_content_activity_by_age_gender_unique_Female_25_34`,
            `page_content_activity_by_age_gender_unique_Female_18_24`,
            `page_content_activity_by_age_gender_unique_Undefine_25_34`,
            `mentions`)
            VALUES(
            :id_page,
            :page_fans,
            :page_content_activity,
            :page_content_activity_by_action_type_unique_page_post,
            :page_content_activity_by_action_type_unique_fan,
            :page_content_activity_by_action_type_unique_other,
            :page_content_activity_by_age_gender_unique_M_65,
            :page_content_activity_by_age_gender_unique_M_55_64,
            :page_content_activity_by_age_gender_unique_M_45_54,
            :page_content_activity_by_age_gender_unique_M_35_44,
            :page_content_activity_by_age_gender_unique_M_25_34,
            :page_content_activity_by_age_gender_unique_M_18_24,
            :page_content_activity_by_age_gender_unique_F_55_64,
            :page_content_activity_by_age_gender_unique_F_45_54,
            :page_content_activity_by_age_gender_unique_F_35_44,
            :page_content_activity_by_age_gender_unique_F_25_34,
            :page_content_activity_by_age_gender_unique_F_18_24,
            :page_content_activity_by_age_gender_unique_U_25_34,
            :mentions)");
          $statement->bindParam(':id_page', $id_page, PDO::PARAM_STR);
          $statement->bindParam(':page_fans', $page['page_fans']);
          $statement->bindParam(':page_content_activity', $page['page_content_activity']);
          $statement->bindParam(':page_content_activity_by_action_type_unique_page_post', $page['page_content_activity_by_action_type_unique']["page post"]);
          $statement->bindParam(':page_content_activity_by_action_type_unique_fan', $page['page_content_activity_by_action_type_unique']["fan"]);
          $statement->bindParam(':page_content_activity_by_action_type_unique_other', $page['page_content_activity_by_action_type_unique']["other"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_M_65', $page['page_content_activity_by_age_gender_unique']["M.65+"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_M_55_64', $page['page_content_activity_by_age_gender_unique']["M.55-64"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_M_45_54', $page['page_content_activity_by_age_gender_unique']["M.45-54"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_M_35_44', $page['page_content_activity_by_age_gender_unique']["M.25-34"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_M_25_34', $page['page_content_activity_by_age_gender_unique']["M.35-44"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_M_18_24', $page['page_content_activity_by_age_gender_unique']["M.18-24"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_F_55_64', $page['page_content_activity_by_age_gender_unique']["F.55-64"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_F_45_54', $page['page_content_activity_by_age_gender_unique']["F.45-54"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_F_35_44', $page['page_content_activity_by_age_gender_unique']["F.35-44"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_F_25_34', $page['page_content_activity_by_age_gender_unique']["F.25-34"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_F_18_24', $page['page_content_activity_by_age_gender_unique']["F.18-24"]);
          $statement->bindParam(':page_content_activity_by_age_gender_unique_U_25_34', $page['page_content_activity_by_age_gender_unique']["U.25-34"]);
          $statement->bindParam(':mentions', $page['mentions']);
    echo "<pre>";
var_dump($page['page_fans']);
    echo"</pre>";
    //die;
           $statement->execute();
                  $conn->commit();
                  $save = true;
    // echo "<pre>";
    // var_dump($statement);
    // echo"</pre>";
    //   die;
        } catch (PDOException $e) {
             $conn->rollback();
            //error_log("Hubo un error en ".__FUNCTION__."! en ".__FILE__." \n ".$e->getMessage(), 0);
            sendMailer("jose@mimirwell.com","Hubo un error en guardado de page fans",__FUNCTION__." id_page: ".$id_page." ! en ".__FILE__." \n ".$e->getMessage());
              $save = false;
        }
    return $save;
}
         
     }
