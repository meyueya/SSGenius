<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("Database.php");

                         $conec = Database::getInstance();
                          
                          $stm = $conec->prepare(" UPDATE `ssg_facebook_page_primera_carga` 

SET engagement_status='1', impressions_status='1', post_status='1', reactions_status='1', user_status='1', video_status='1',views_status='1', clicks_status='1'

where id_adaccount='192597304105183' or id_adaccount='252873771407598' or  id_adaccount='256278787729451' or id_adaccount='220224931456764' ORDER BY `engagement_restart_day`");
                          $stm->execute();

                  $conec->commit();
                  $save = true;
?>