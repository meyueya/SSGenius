<?php
require_once('../../model/Database.php');

             
                        $conec = Database::getInstance();
                        
                         $stm = $conec->prepare("update `ssg_facebook_page_primera_carga` set engagement_status='1', impressions_status='1', post_status='1', reactions_status='1', user_status='1', video_status='1', views_status='1', clicks_status='1' where id_adaccount='192597304105183' or id_adaccount='220224931456764' or id_adaccount='256278787729451' or id_adaccount='252873771407598' ");
                         $stm->execute();
                         $job = $stm->fetchAll();
                         ?>


