<?php

require_once 'vendor/autoload.php'; // sdk Graph
require_once 'instagram_api.php';
require_once 'model/SsgInstagramModel.php';

function require_env($name)
{
    $value = getenv($name);
    if ($value === false || $value === '') {
        throw new RuntimeException('Missing required environment variable: ' . $name);
    }
    return $value;
}

// -- Instancias
$SsgInstagramModel = new SsgInstagramModel();
$helper = new Helper_GraphAPI();

// -- Credenciales y IDs: configurar fuera del repositorio.
$params['access_token'] = require_env('FACEBOOK_ACCESS_TOKEN');
$params['facebook_page_id'] = require_env('FACEBOOK_PAGE_ID');
$params['instagram_id'] = require_env('INSTAGRAM_BUSINESS_ID');

// -- Tipos de Metric
// impressions,reach,follower_count,email_contacts,phone_call_clicks,text_message_clicks,
// get_directions_clicks,website_clicks,profile_views,audience_gender_age,audience_locale,
// audience_country,audience_city,online_followers

// -- Media
// media{like_count,media,timestamp,user,username,comments_count}

$token_large = $helper->get_long_access_token($params);
$page = $helper->get_infomation_pageDetail($params);

$instagram_values = array(
    "id_instagram_page" => $page['instagram_business_account']['id'],
    "id_facebook_page" => $page['id'],
    "name" => $page['instagram_business_account']['name'],
    "username" => $page['instagram_business_account']['username'],
    "biography" => $page['instagram_business_account']['biography'],
    "followers_count" => $page['instagram_business_account']['followers_count'],
    "follows_count" => $page['instagram_business_account']['follows_count'],
    "media_count" => $page['instagram_business_account']['media_count'],
    "profile_picture_url" => $page['instagram_business_account']['profile_picture_url'],
    "website" => $page['instagram_business_account']['website'],
    "token" => $token_large['access_token'],
    "token_lifetime" => $token_large['expires_in'],
    "timestamp" => time(),
);
$SsgInstagramModel->saveInstagramPage($instagram_values);

$media = $helper->get_infomation_media($params);
foreach ($media['data'] as $row) {
    $params_insights = array(
        "media_id" => $row['id'],
        "access_token" => $params['access_token'],
    );

    $insights = $helper->get_infomation_insights($params_insights);
    $params_media = array(
        "id_instagram_media" => $row['id'],
        "id_instagram_page" => $params['instagram_id'],
        "is_comment_enabled" => @$row['is_comment_enabled'],
        "caption" => @$row['caption'],
        "media_type" => @$row['media_type'],
        "media_url" => @$row['media_url'],
        "permalink" => @$row['permalink'],
        "shortcode" => $row['shortcode'],
        "username" => @$row['username'],
        "like_count" => @$row['like_count'],
        "comments_count" => @$row['comments_count'],
        "timestamp" => strtotime($row['timestamp']),
        "engagement" => @$insights['data'][0]['values'][0]['value'],
        "impressions" => @$insights['data'][1]['values'][0]['value'],
        "reach" => @$insights['data'][2]['values'][0]['value'],
        "saved" => @$insights['data'][3]['values'][0]['value']
    );

    if (isset($row['comments'])) {
        foreach ($row['comments']['data'] as $row_comm) {
            $params_comm = array(
                "id_instagram_comment" => $row_comm['id'],
                "id_instagram_media" => $row['id'],
                "text" => $row_comm['text'],
                "like_count" => $row_comm['like_count'],
                "timestamp" => strtotime($row_comm['timestamp']),
                "replies" => json_encode(@$row_comm['replies'])
            );
            $SsgInstagramModel->saveInstagramMediaComments($params_comm);
        }
    }

    $SsgInstagramModel->saveInstagramMedia($params_media);
}
