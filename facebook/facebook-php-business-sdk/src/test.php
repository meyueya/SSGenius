<?php
require_once __DIR__ . '/../vendor/autoload.php';
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\AdsInsights;

$app_id = "1930491627191257";
$app_secret = "934f83f24436ea82749ca6b5fafc6281";
$access_token = "EAAbbxZAuuO9kBAPk6lL33uodC1Nl6iLyEfIqThnZAW02rFTQIlnhOLxxnvHZC1Vwq0HZCCZBoXzAIn5YkZAR9shj2QWSYXDZArLJQ5UAJkhyXwDP0XpsoCTAaEM2UQT0773PXZBOg3a5mfrWQ0ii0QZCo1dZC2ZA4zH3ivw88T4KgmGUwZDZD";
$account_id = "act_1071159706331825";

Api::init($app_id, $app_secret, $access_token);

$account = new AdAccount($account_id);
$n_dia = "1";
// New Objects will be appended to the cursor
 $dia = date('Y-m-d', strtotime('-' . $n_dia . ' days'));
$params = array(
            'time_range' => array('since' => $dia, 'until' => $dia),
            'filtering' => array(),
            'level' => 'ad',
            'breakdowns' => array('gender', 'age'),
        );

        $fields = array(
            'ad_name',
            'adset_name',
            'campaign_name',
            'campaign_id',
            'adset_id',
            'ad_id',
            'impressions',
            'clicks',
            'spend',
            'objective',
            'date_start',
            'date_stop',
        );


        $cursor = (new AdAccount($account_id))->getInsights($fields, $params);

        $cursor->setUseImplicitFetch(true);
        print_r($cursor);
