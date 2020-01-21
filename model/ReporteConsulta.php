<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once("Database.php");

class ReporteConsulta {

    function getInformesFB($id_page) {
        $dbh = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statement01 = $dbh->prepare("SELECT  max(page_fans)          as page_fans, 
            sum(page_engaged_users)                                   as page_engaged_users, 
            sum(page_consumptions)                                    as page_consumptions, 
            sum(page_consumptions_unique)                             as page_consumptions_unique, 
            sum(page_consumptions_by_consumption_type_link_clicks)    as page_consumptions_by_consumption_type_link_clicks, 
            SUM(page_consumptions_by_consumption_type_other_clicks)   as page_consumptions_by_consumption_type_other_clicks, 
            sum(page_consumptions_by_consumption_type_photo_view)     as page_consumptions_by_consumption_type_photo_view, 
            sum(page_consumptions_by_consumption_type_video_play)     as page_consumptions_by_consumption_type_video_play, 
            sum(page_places_checkin_total)                            as page_places_checkin_total, 
            sum(page_places_checkin_total_unique)                     as page_places_checkin_total_unique, 
            sum(page_places_checkin_mobile)                           as page_places_checkin_mobile, 
            sum(page_places_checkin_mobile_unique)                    as page_places_checkin_mobile_unique, 
            sum(page_negative_feedback)                               as page_negative_feedback, 
            sum(page_places_checkins_by_age_gender)                   as page_places_checkins_by_age_gender, 
            sum(page_positive_feedback_by_type_link)                  as page_positive_feedback_by_type_link, 
            sum(page_positive_feedback_by_type_like)                  as page_positive_feedback_by_type_like, 
            sum(page_positive_feedback_by_type_other)                 as page_positive_feedback_by_type_other, 
            sum(page_positive_feedback_by_type_unique_link)           as page_positive_feedback_by_type_unique_link, 
            sum(page_positive_feedback_by_type_unique_like)           as page_positive_feedback_by_type_unique_like, 
            sum(page_positive_feedback_by_type_unique_other)          as page_positive_feedback_by_type_unique_other, 
            sum(shares) as shares, sum(likes) as likes, sum(comments) as comments FROM `ssg_facebook_page_engagement` 
                 WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
            $statement01->execute();
            $registros = $statement01->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        }
    }

}

class ReporteConsultaimp {

    function getInformesimp($id_page) {
        $dbhi = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statement02 = $dbhi->prepare("SELECT  max(page_fans)         as page_fans,
            sum(page_impressions)                                     as page_impressions,
            sum(page_impressions_unique)                              as page_impressions_unique,
            sum(page_impressions_paid)                                as page_impressions_paid,
            sum(page_impressions_paid_unique)                         as page_impressions_paid_unique,
            sum(page_impressions_organic)                             as page_impressions_organic,
            sum(page_impressions_organic_unique)                      as page_impressions_organic_unique,
            sum(page_impressions_viral)                               as page_impressions_viral,
            sum(page_impressions_viral_unique)                        as page_impressions_viral_unique,
            sum(page_impressions_nonviral)                            as page_impressions_nonviral,
            sum(page_impressions_nonviral_unique)                     as page_impressions_nonviral_unique,
            sum(page_impressions_by_story_type)                       as page_impressions_by_story_type,
            sum(page_impressions_by_story_type_unique)                as page_impressions_by_story_type_unique,
            sum(page_impressions_by_age_gender_unique_Female_65)      as page_impressions_by_age_gender_unique_Female_65,
            sum(page_impressions_by_age_gender_unique_Female_55_64)   as page_impressions_by_age_gender_unique_Female_55_64,
            sum(page_impressions_by_age_gender_unique_Female_45_54)   as page_impressions_by_age_gender_unique_Female_45_54,
            sum(page_impressions_by_age_gender_unique_Female_35_44)   as page_impressions_by_age_gender_unique_Female_35_44,
            sum(page_impressions_by_age_gender_unique_Female_25_34)   as page_impressions_by_age_gender_unique_Female_25_34,
            sum(page_impressions_by_age_gender_unique_Female_18_24)   as page_impressions_by_age_gender_unique_Female_18_24,
            sum(page_impressions_by_age_gender_unique_Female_13_17)   as page_impressions_by_age_gender_unique_Female_13_17,
            sum(page_impressions_by_age_gender_unique_Male_65)        as page_impressions_by_age_gender_unique_Male_65,
            sum(page_impressions_by_age_gender_unique_Male_55_64)     as page_impressions_by_age_gender_unique_Male_55_64,
            sum(page_impressions_by_age_gender_unique_Male_45_54)     as page_impressions_by_age_gender_unique_Male_45_54,
            sum(page_impressions_by_age_gender_unique_Male_35_44)     as page_impressions_by_age_gender_unique_Male_35_44,
            sum(page_impressions_by_age_gender_unique_Male_25_34)     as page_impressions_by_age_gender_unique_Male_25_34,
            sum(page_impressions_by_age_gender_unique_Male_18_24)     as page_impressions_by_age_gender_unique_Male_18_24,
            sum(page_impressions_by_age_gender_unique_Male_13_17)     as page_impressions_by_age_gender_unique_Male_13_17,
            sum(page_impressions_by_age_gender_unique_Undefine_65)    as page_impressions_by_age_gender_unique_Undefine_65,
            sum(page_impressions_by_age_gender_unique_Undefine_55_64) as page_impressions_by_age_gender_unique_Undefine_55_64,
            sum(page_impressions_by_age_gender_unique_Undefine_35_44) as page_impressions_by_age_gender_unique_Undefine_35_44,
            sum(page_impressions_by_age_gender_unique_Undefine_25_34) as page_impressions_by_age_gender_unique_Undefine_25_34,
            sum(page_impressions_by_age_gender_unique_Undefine_18_24) as page_impressions_by_age_gender_unique_Undefine_18_24
            FROM `ssg_facebook_page_impressions` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
            $statement02->execute();
            $registros02 = $statement02->fetchAll(PDO::FETCH_ASSOC);
            return $registros02;
        }
    }

}

class ReporteConsult {

    function getInformes($id_page) {
        $dbhb = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statement1 = $dbhb->prepare("SELECT  max(page_fans)  as page_fans,
            sum(page_posts_impressions)                       as page_posts_impressions,
            sum(page_posts_impressions_unique)                as page_posts_impressions_unique,
            sum(page_posts_impressions_paid)                  as page_posts_impressions_paid,
            sum(page_posts_impressions_paid_unique)           as page_posts_impressions_paid_unique,
            sum(page_posts_impressions_organic)               as page_posts_impressions_organic,
            sum(page_posts_impressions_organic_unique)        as page_posts_impressions_organic_unique,
            sum(page_posts_impressions_viral)                 as page_posts_impressions_viral,
            sum(page_posts_impressions_viral_unique)          as page_posts_impressions_viral_unique,
            sum(page_posts_impressions_nonviral)              as page_posts_impressions_nonviral,
            sum(page_posts_impressions_nonviral_unique)       as page_posts_impressions_nonviral_unique,
            sum(page_posts_served_impressions_organic_unique) as page_posts_served_impressions_organic_unique
            FROM `ssg_facebook_page_posts` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
            $statement1->execute();
            $registro = $statement1->fetchAll(PDO::FETCH_ASSOC);
            return $registro;
        }
    }

}

class ReporteConsultarea {

    function getInformesrea($id_page) {
        $dbhrea = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statementrea = $dbhrea->prepare("SELECT max(page_fans) as page_fans,
            sum(page_actions_post_reactions_like_total)         as page_actions_post_reactions_like_total,
            sum(page_actions_post_reactions_love_total)         as page_actions_post_reactions_love_total,
            sum(page_actions_post_reactions_wow_total)          as page_actions_post_reactions_wow_total,
            sum(page_actions_post_reactions_haha_total)         as page_actions_post_reactions_haha_total,
            sum(page_actions_post_reactions_sorry_total)        as page_actions_post_reactions_sorry_total,
            sum(page_actions_post_reactions_anger_total)        as page_actions_post_reactions_anger_total,
            sum(page_actions_post_reactions_total_like)         as page_actions_post_reactions_total_like,
            sum(page_actions_post_reactions_total_love)         as page_actions_post_reactions_total_love
            FROM `ssg_facebook_page_reactions` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
            $statementrea->execute();
            $registrorea = $statementrea->fetchAll(PDO::FETCH_ASSOC);
            return $registrorea;
        }
    }

}

class ReporteConsultuser {

    function getInformesuser($id_page) {
        $dbhuser = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statementuser = $dbhuser->prepare("SELECT max(page_fans) as page_fans,
            sum(page_fan_adds_unique)                as page_fan_adds_unique,
            sum(page_fans_gender_age_Female_65)      as page_fans_gender_age_Female_65,
            sum(page_fans_gender_age_Female_55_64)   as page_fans_gender_age_Female_55_64,
            sum(page_fans_gender_age_Female_45_54)   as page_fans_gender_age_Female_45_54,
            sum(page_fans_gender_age_Female_35_44)   as page_fans_gender_age_Female_35_44,
            sum(page_fans_gender_age_Female_25_34)   as page_fans_gender_age_Female_25_34,
            sum(page_fans_gender_age_Female_18_24)   as page_fans_gender_age_Female_18_24,
            sum(page_fans_gender_age_Female_13_17)   as page_fans_gender_age_Female_13_17,
            sum(page_fans_gender_age_Male_65)        as page_fans_gender_age_Male_65,
            sum(page_fans_gender_age_Male_55_64)     as page_fans_gender_age_Male_55_64,
            sum(page_fans_gender_age_Male_45_54)     as page_fans_gender_age_Male_45_54,
            sum(page_fans_gender_age_Male_35_44)     as page_fans_gender_age_Male_35_44,
            sum(page_fans_gender_age_Male_25_34)     as page_fans_gender_age_Male_25_34,
            sum(page_fans_gender_age_Male_18_24)     as page_fans_gender_age_Male_18_24,
            sum(page_fans_gender_age_Male_13_17)     as page_fans_gender_age_Male_13_17,
            sum(page_fans_gender_age_Undefine_65)    as page_fans_gender_age_Undefine_65,
            sum(page_fans_gender_age_Undefine_55_64) as page_fans_gender_age_Undefine_55_64,
            sum(page_fans_gender_age_Undefine_45_54) as page_fans_gender_age_Undefine_45_54,
            sum(page_fans_gender_age_Undefine_35_44) as page_fans_gender_age_Undefine_35_44,
            sum(page_fans_gender_age_Undefine_25_34) as page_fans_gender_age_Undefine_25_34,
            sum(page_fans_gender_age_Undefine_18_24) as page_fans_gender_age_Undefine_18_24
            FROM `ssg_facebook_user_demographics` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
            $statementuser->execute();
            $registrouser = $statementuser->fetchAll(PDO::FETCH_ASSOC);
            return $registrouser;
        }
    }

}

class ReporteConsultvid {

    function getInformesvid($id_page) {
        $dbhvid = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statementvid = $dbhvid->prepare("SELECT max(page_fans) as page_fans,
            sum(page_video_views)                            as page_video_views,
            sum(page_video_views_autoplayed)                 as page_video_views_autoplayed,
            sum(page_video_repeat_views)                     as page_video_repeat_views,
            sum(page_video_views_organic)                    as page_video_views_organic,
            sum(page_video_views_unique)                     as page_video_views_unique,
            sum(page_video_views_click_to_play)              as page_video_views_click_to_play,
            sum(page_video_views_10s_organic)                as page_video_views_10s_organic,
            sum(page_video_views_10s_click_to_play)          as page_video_views_10s_click_to_play,
            sum(page_video_views_10s_repeat)                 as page_video_views_10s_repeat,
            sum(page_video_views_10s)                        as page_video_views_10s,
            sum(page_video_views_10s_paid)                   as page_video_views_10s_paid,
            sum(page_video_views_10s_autoplayed)             as page_video_views_10s_autoplayed,
            sum(page_video_views_10s_unique)                 as page_video_views_10s_unique,
            sum(page_video_complete_views_30s_organic)       as page_video_complete_views_30s_organic,
            sum(page_video_complete_views_30s_click_to_play) as page_video_complete_views_30s_click_to_play,
            sum(page_video_complete_views_30s_repeat_views)  as page_video_complete_views_30s_repeat_views,
            sum(page_video_complete_views_30s)               as page_video_complete_views_30s,
            sum(page_video_complete_views_30s_paid)          as page_video_complete_views_30s_paid,
            sum(page_video_complete_views_30s_autoplayed)    as page_video_complete_views_30s_autoplayed,
            sum(page_video_complete_views_30s_unique)        as page_video_complete_views_30s_unique,
            sum(page_video_views_by_paid_non_paid_paid)      as page_video_views_by_paid_non_paid_paid,
            sum(page_video_views_by_paid_non_paid_unpaid)    as page_video_views_by_paid_non_paid_unpaid,
            sum(page_video_views_by_paid_non_paid_total)     as page_video_views_by_paid_non_paid_total,
            sum(page_video_view_time)                        as page_video_view_time
            FROM `ssg_facebook_page_video_views` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
            $statementvid->execute();
            $registrovid = $statementvid->fetchAll(PDO::FETCH_ASSOC);
            return $registrovid;
        }
    }

}

class ReporteConsultview {

    function getInformesview($id_page) {
        $dbhview = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statementview = $dbhview->prepare("SELECT max(page_fans) as page_fans,
            sum(page_views_total)                                              as page_views_total,
            sum(page_views_logged_in_total)                                    as page_views_logged_in_total,
            sum(page_views_logged_in_unique)                                   as page_views_logged_in_unique,
            sum(page_views_external_referrals_movilair)                        as page_views_external_referrals_movilair,
            sum(page_views_external_referrals_google)                          as page_views_external_referrals_google,
            sum(page_views_by_profile_tab_total_photos)                        as page_views_by_profile_tab_total_photos,
            sum(page_views_by_profile_tab_total_posts)                         as page_views_by_profile_tab_total_posts,
            sum(page_views_by_profile_tab_total_videos)                        as page_views_by_profile_tab_total_videos,
            sum(page_views_by_profile_tab_total_home)                          as page_views_by_profile_tab_total_home,
            sum(page_views_by_profile_tab_total_notes)                         as page_views_by_profile_tab_total_notes,
            sum(page_views_by_profile_tab_logged_in_unique_photos)             as page_views_by_profile_tab_logged_in_unique_photos,
            sum(page_views_by_profile_tab_logged_in_unique_videos)             as page_views_by_profile_tab_logged_in_unique_videos,
            sum(page_views_by_profile_tab_logged_in_unique_home)               as page_views_by_profile_tab_logged_in_unique_home,
            sum(page_views_by_profile_tab_logged_in_unique_posts)              as page_views_by_profile_tab_logged_in_unique_posts,
            sum(page_views_by_internal_referer_logged_in_unique_search)        as page_views_by_internal_referer_logged_in_unique_search,
            sum(page_views_by_internal_referer_logged_in_unique_page_internal) as page_views_by_internal_referer_logged_in_unique_page_internal,
            sum(page_views_by_internal_referer_logged_in_unique_newsfeed)      as page_views_by_internal_referer_logged_in_unique_newsfeed,
            sum(page_views_by_internal_referer_logged_in_unique_other)         as page_views_by_internal_referer_logged_in_unique_other,
            sum(page_views_by_site_logged_in_unique_www)                       as page_views_by_site_logged_in_unique_www,
            sum(page_views_by_site_logged_in_unique_mobile)                    as page_views_by_site_logged_in_unique_mobile,
            sum(page_views_by_site_logged_in_unique_other)                     as page_views_by_site_logged_in_unique_other,
            sum(page_views_logout) as page_views_logout
            FROM `ssg_facebook_page_views` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
            $statementview->execute();
            $registroview = $statementview->fetchAll(PDO::FETCH_ASSOC);
            return $registroview;
        }
    }

}

class ReporteConsultcta {

    function getInformescta($id_page) {
        $dbhcta = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statementcta = $dbhcta->prepare("SELECT max(page_fans)      as page_fans,
            sum(page_total_actions)                                  as page_total_actions,
            sum(page_cta_clicks_by_site_logged_in_unique_mobile)     as page_cta_clicks_by_site_logged_in_unique_mobile,
            sum(page_cta_clicks_by_site_logged_in_unique_other)      as page_cta_clicks_by_site_logged_in_unique_other,
            sum(page_call_phone_clicks_by_site_logged_in_unique)     as page_call_phone_clicks_by_site_logged_in_unique,
            sum(page_get_directions_clicks_logged_in_unique)         as page_get_directions_clicks_logged_in_unique,
            sum(page_get_directions_clicks_by_site_logged_in_unique) as page_get_directions_clicks_by_site_logged_in_unique,
            sum(page_website_clicks_by_site_logged_in_unique)        as page_website_clicks_by_site_logged_in_unique
            FROM `ssg_facebook_page_cta_clicks` WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'  ");
            $statementcta->execute();
            $registrocta = $statementcta->fetchAll(PDO::FETCH_ASSOC);
            return $registrocta;
        }
    }

}

//ALCANCE ORGANICO

class ReporteConsultalc {

    function getInformesalc($id_page) {
        $dbhalc = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statementalc = $dbhalc->prepare(" select SUM(`page_impressions_organic_unique`) as page_impressions_organic_unique FROM `ssg_page_fans_facebook`
                 WHERE id_page ='" . $id_page . "' AND end_time BETWEEN '" . $desde . "' and '" . $hasta . "'");
            $statementalc->execute();
            $registroalc = $statementalc->fetchAll(PDO::FETCH_ASSOC);
            return $registroalc;
        }
    }

}

class Reportetabla {

    function getInformestabla($id_page) {
        $dbhtabla = Database::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $desde = date("Y-m-d", strtotime($_POST['date1']));
            $hasta = date("Y-m-d", strtotime($_POST['date2']));
            $statementtabla = $dbhtabla->prepare("SELECT created_time ,conversation_id,from_name,from_id, to_name, message  FROM ssg_conversations_messages_facebook 
        WHERE from_id!='" . $id_page . "'  and  page_id ='" . $id_page . "' AND created_time_fecha BETWEEN '" . $desde . "' and '" . $hasta . "' group by created_time_fecha, from_name");
            $statementtabla->execute();
            $registrotabla = $statementtabla->fetchAll(PDO::FETCH_ASSOC);
            return $registrotabla;
        }
    }

}
