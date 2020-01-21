<?php
//header('Content-Type: application/json');
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
error_reporting(E_ALL);
ini_set('display_errors', 1);//
if (!defined('STDOUT'))
define('STDOUT', fopen('php://stdout', 'w'));
define('SDK_DIR', '../facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
// define('SDK_DIR', __DIR__ . '/'); // Path to the SDK directory
// $loader = include SDK_DIR.'/vendor/autoload.php';
//include ('./../util.php');
require_once('/home/ssgenius/public_html/app/facebook/facebook-php-business-sdk/util.php');
require_once('/home/ssgenius/public_html/app/model/UserModel.php');
require_once('/home/ssgenius/public_html/app/model/FacebookModel.php');
require_once('/home/ssgenius/public_html/app/model/FacebookAiwModel.php');
require_once('/home/ssgenius/public_html/app/helper/SsgHelper.php');

$UserModel = new UserModel();
$FacebookAiwModel = new FacebookAiwModel();
$SsgHelper = new SsgHelper();

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Object\TargetingSearch;
use FacebookAds\Object\Search\TargetingSpecs;
use FacebookAds\Object\Search\TargetingSearchTypes;
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\AdSetFields;

$_GET = ['655873111499297'] ;
    echo('<pre>');
     print_r($_GET);
  //die;
    echo('</pre>');

    $app_id = '292708578241182';
    $app_secret = '462aeec937ca833dd9798c944d5c79e2';
    //$access_token = 'EAAEKN4bUKp4BAMkDVU0QysRMazDcJOsZBZCvkbiwiUzjr3gVLTn1a9mmZB2hfcrZA21pbQ2ofEI0MMFa9ne1WcIbiFT6ZC5cRYFXhHbbjVZBPsBHDSmfE9uloDSB290ArTztDjl2TY7HygfdmiBvM95YpH19FCUFLGIaZCkMXRvqwZDZD';
    $table = "aiw_facebook_data_ads";//tabla de guardado de insights ads 
        
      if (isset($_GET['0'])){
          $account_id =  $_GET['0'];
          $ad_account_id = 'act_'.$account_id;
           //$access_token = $FacebookModel->getTokenForFacebookAdAccount($account_id);
          $access_token = $FacebookAiwModel->getTokenForFacebookAiwAdAccount($account_id);
          
    echo('<pre>');
     print_r($account_id);
    //die;
    echo('</pre>');
    
    echo('<pre>');
   print_r($ad_account_id);
    //die;
    echo('</pre>');
       
   echo('<pre>');
     print_r($access_token);
    //die;
    echo('</pre>');
       
       
    }else { 
        exit();
    }

        // Configurations - End
        if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  throw new \Exception('You must set your access token, app id and app secret before executing');}
        if (is_null($ad_account_id)) { throw new \Exception('You must set your account id before executing');}

         $dia = date('Y-m-d',strtotime("- 1 days")); // la primera vez que comience a jalar datos
         //$dia = date('Y-m-d');//obtenemos el dia de ayer
         $n_dia = 1; 
    // echo('<pre>');
    //  print_r($dia);
    // echo('</pre>');
    //  die;
    if ($n_dia >= 1) {
        $since = $dia;//desde 2018-04-17
        $until = $dia;//hasta 2018-05-15
        $limit = 5000;//limite por cursor 5 mil es el máximo de facebook por petición al momento
        $fields = array(
            'date_start', // La fecha de inicio de sus datos. Esto está controlado por el intervalo de fechas que ha seleccionado para su vista de informes.
            'date_stop', // La fecha de finalización de sus datos. Esto está controlado por el intervalo de fechas que ha seleccionado para su vista de informes.
            'ad_id', //La ID única del anuncio que está viendo en los informes.
            'account_id', //El número de identificación de su cuenta de anuncio, que agrupa su actividad publicitaria. Su cuenta de anuncios incluye sus campañas, anuncios y facturación.
            'campaign_id', //El número de identificación único de la campaña publicitaria que está viendo en los informes. Su campaña contiene conjuntos de anuncios y anuncios.
            'adset_id', //La ID única del conjunto de anuncios que está viendo en los informes. Un conjunto de anuncios es un grupo de anuncios que comparten el mismo presupuesto, programación, optimización de publicación y segmentación
            'account_name', //El nombre de su cuenta de anuncios, que agrupa su actividad publicitaria. Su cuenta de anuncios incluye sus campañas, anuncios y facturación.
            'campaign_name', //El nombre de la campaña publicitaria que está viendo en los informes. Su campaña contiene conjuntos de anuncios y anuncios.
            // 'adset_name', //El nombre del conjunto de anuncios que está viendo en los informes. Un conjunto de anuncios es un grupo de anuncios que comparten el mismo presupuesto, programación, optimización de publicación y segmentación.
            // 'ad_name', //El nombre del anuncio que está viendo en los informes.
            // 'reach', // El número de personas que vieron sus anuncios al menos una vez. El alcance es diferente de las impresiones, que pueden incluir múltiples vistas de sus anuncios por las mismas personas. Esta métrica es estimada.
            // 'impressions', // La cantidad de veces que sus anuncios estuvieron en pantalla.
            // 'clicks', // El número de clics en sus anuncios.
            // 'spend', // La cantidad total estimada de dinero que ha gastado en su campaña, conjunto de anuncios o anuncio durante su programación. Esta métrica es estimada.
            // 'website_ctr', // El porcentaje de veces que las personas vieron su anuncio y realizaron un clic en el enlace.
            // 'website_purchase_roas', // El rendimiento total de la inversión publicitaria (ROAS) de las compras realizadas en el sitio web. Esto se basa en el valor de todas las conversiones registradas por el píxel de Facebook en su sitio web y atribuidas a sus anuncios.
            // 'objective', // El objetivo que refleja el objetivo que desea lograr con su publicidad. Puede ser diferente del objetivo seleccionado de la campaña en algunos casos
            // 'action_values', // El valor total de todas las conversiones atribuidas a sus anuncios.
            // 'buying_type', // El método mediante el cual usted paga y dirige los anuncios en sus campañas: a través de ofertas de subasta dinámicas, ofertas de precio fijo o alcance y compras de frecuencia. Este campo actualmente solo es visible a nivel de campaña.
            // 'frequency', // La cantidad promedio de veces que cada persona vio su anuncio. Esta métrica es estimada.
            // 'inline_link_clicks', // La cantidad de clics en los enlaces para seleccionar destinos o experiencias, dentro o fuera de las propiedades propiedad de Facebook. Los clics en enlaces en línea utilizan una ventana de atribución fija de 1 día de clic.
            // 'inline_post_engagement', // El número total de acciones que realizan las personas en relación con sus anuncios. Los compromisos de publicaciones en línea utilizan una ventana de atribución fija de un día de clic.
            // 'unique_clicks', // El número de personas que realizaron una acción que se atribuyó a sus anuncios. Esta métrica es estimada.
            // 'unique_ctr', // El porcentaje de personas que vieron su anuncio y realizaron un clic único (todos). Esta métrica es estimada.
            // 'unique_inline_link_click_ctr', // El porcentaje de veces que las personas vieron su anuncio y realizaron un clic en el enlace. La tasa de clics en línea utiliza una ventana de atribución de clics de 1 día. Esta métrica es estimada.
            // 'unique_inline_link_clicks', // Haga clic en el número de personas que realizaron un enlace en línea. Esta métrica es estimada.
            // 'unique_link_clicks_ctr', // Haga clic en el número de personas que realizaron un enlace en línea. Esta métrica es estimada.
            // 'unique_outbound_clicks', // Haga clic en el porcentaje de personas que vieron su anuncio y realizaron un enlace. Esta métrica es estimada.
            // 'unique_outbound_clicks_ctr', // El porcentaje de personas que vieron su anuncio y realizaron un clic de salida. Esta métrica es estimada.
            // 'outbound_clicks', // La cantidad de clics en los enlaces que quitan a las personas de las propiedades de Facebook.
            // 'relevance_score', // Una calificación de 1 a 10 que estima qué tan bien está respondiendo su público objetivo a su anuncio. Esta puntuación se muestra después de que su anuncio reciba más de 500 impresiones. Solo es visible cuando se busca en los informes de anuncios y no aparece para conjuntos de anuncios y campañas. Este campo actualmente solo es visible en el nivel del anuncio.
            // 'account_currency', //Moneda utilizada por su cuenta de anuncio.
            // 'page_impressions',
            // 'page_impressions_unique',
            // 'page_impressions_paid',
            // 'page_impressions_paid_unique',
            // 'page_impressions_organic',
            // 'page_impressions_organic_unique',
            // 'page_impressions_viral',
            // 'page_impressions_viral_unique',
            // 'page_impressions_nonviral',
            // 'page_impressions_nonviral_unique',
            // 'page_impressions_by_story_type',  //array
            // 'page_impressions_by_story_type_unique', //array
            // 'page_impressions_by_city_unique',
            // 'page_impressions_by_country_unique',
            // 'page_impressions_by_locale_unique',
            // 'page_impressions_by_age_gender_unique',
            // 'page_impressions_frequency_distribution',
            // 'page_impressions_viral_frequency_distribution',
            //'unique_actions', // El número de personas que realizaron una acción que se atribuyó a sus anuncios. Esta métrica es estimada.
            //'cost_per_action_type', // El coste medio de una acción relevante.
            //'actions', //El número total de acciones realizadas por personas que se atribuyen a sus anuncios. Las acciones pueden incluir participación, clics o conversiones
            //'video_play_actions', // La cantidad de veces que su video comienza a reproducirse. Esto se cuenta para cada impresión de un video y excluye las repeticiones. Esta métrica está en desarrollo.
            //'video_10_sec_watched_actions', // La cantidad de veces que su video se reproduce durante al menos 10 segundos, o casi su duración total si es más corto que 10 segundos. Para cada impresión de un video, contaremos las vistas de video por separado y excluiremos el tiempo dedicado a reproducir el video.
            //'video_30_sec_watched_actions', // La cantidad de veces que su video se reproduce durante al menos 30 segundos, o para casi su duración total si es más corto que 30 segundos. Para cada impresión de un video, contaremos las vistas de video por separado y excluiremos el tiempo dedicado a reproducir el video.
            //'video_avg_percent_watched_actions', // La cantidad de veces que su video se reproduce durante al menos 30 segundos, o para casi su duración total si es más corto que 30 segundos. Para cada impresión de un video, contaremos las vistas de video por separado y excluiremos el tiempo dedicado a reproducir el video.
            //'video_avg_time_watched_actions', // El tiempo promedio en que se reprodujo un video, incluido el tiempo que se pasa reproduciendo el video para obtener una única impresión
            //'video_p100_watched_actions', // La cantidad de veces que se reprodujo su video al 100% de su duración, incluidas las reproducciones que se saltaron hasta este punto
            //'video_p25_watched_actions', // La cantidad de veces que se reprodujo su video al 25% de su duración, incluidas las reproducciones que se saltaron hasta este punto.
            //'video_p50_watched_actions', // La cantidad de veces que se reprodujo su video al 50% de su duración, incluidas las reproducciones que se saltaron hasta este punto.
            //'video_p75_watched_actions', // La cantidad de veces que se reprodujo su video al 75% de su duración, incluidas las reproducciones que se saltaron hasta este punto.
            //'video_p95_watched_actions', // La cantidad de veces que se reprodujo su video al 90% de su duración, incluidas las reproducciones que se saltaron hasta este punto.
        );
        $params = array(
            'time_range' => array('since' => $since, 'until' => $until),
            'level' => 'ad',// nivel anuncio
            'time_increment' => 1,
            'type' => 'adinterest',
            'limit' => $limit,
            'breakdowns' => array('age', 'gender'),//puede haber otros como country
            'sort' => 'date_start',
        );
        try {
        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());
        $cursor = (new AdAccount($ad_account_id))->getInsights($fields, $params);
        $cursor->setUseImplicitFetch(true);
        $arrayData = array();
        $newCursor = array();
        while ($cursor->createAfterRequest() != null) {
        $newCursor = json_decode($cursor->getResponse()->getBody(),true);
        $arrayData = array_merge($arrayData,$newCursor['data']);
        $cursor->fetchAfter();
        }
        echo('<pre>');
        var_dump($arrayData);
       echo('</pre>');
       die;

foreach ($arrayData as $keysValue => $newArrayData){
                // $actions = 0;
                $actions_post_reaction = 0;
                $actions_post_engagement = 0;
                $actions_page_engagement = 0;
                $actions_post = 0;
                $actions_video_view = 0;
                $actions_likepage = 0;
                $actions_link_click = 0;
                $actions_post_engagement = 0;
                $actions_post_reaction = 0;
                $actions_comment = 0;
                $cost_per_action_type_video_view = 0;
                $cost_per_action_type_post_engagement = 0;
                $cost_per_action_type_page_engagement = 0;
                // $cost_likepage = 0;
                // $cost_link_click = 0;
                // $cost_post_engagement = 0;
                // $cost_post_reaction = 0;
                // $cost_comment = 0;
                // $cost_post = 0;
                $unique_actions_video_view = 0;
                $unique_actions_post_engagement = 0;
                $unique_actions_page_engagement = 0;
                $video_10_sec_watched_video_view = 0;
                $video_30_sec_watched_video_view = 0;
                $video_avg_percent_sec_watched_video_view = 0;
                $video_avg_time_watched_video_view = 0;
                $video_p25_watched_video_view = 0;
                $video_p50_watched_video_view = 0;
                $video_p75_watched_video_view = 0;
                $video_p95_watched_video_view = 0;
                $video_p100_watched_video_view = 0;
                $video_play_actions = 0;


                
                if (isset($newArrayData['actions'])) {
                foreach($newArrayData['actions'] as $actions){
                    switch ($actions['action_type']){
                        case 'video_view':
                             $actions_video_view = $actions['value'];
                        break;
                        case 'page_engagement':
                             $actions_page_engagement = $actions['value'];
                        break;
                        case 'like':
                             $actions_likepage = $actions['value'];
                        break;
                        case 'link_click':
                             $actions_link_click = $actions['value'];
                        break;
                        case 'post_engagement':
                             $actions_post_engagement = $actions['value'];
                        break;
                        case 'post_reaction':
                             $actions_post_reaction = $actions['value'];
                        break;
                        case 'comment':
                             $actions_comment = $actions['value'];
                        break;
                         case 'post':
                             $actions_post = $actions['value'];
                        break;
                    }
                }
            } 
            
                if (isset($newArrayData['unique_actions'])) {
                foreach($newArrayData['unique_actions'] as $unique_actions){
                    switch ($unique_actions['action_type']){
                        case 'video_view':
                             $unique_actions_video_view = $unique_actions['value'];
                        break;
                        case 'post_engagement':
                            $unique_actions_post_engagement = $unique_actions['value'];
                        break;
                        case 'page_engagement':
                            $unique_actions_page_engagement = $unique_actions['value'];
                        break;
                    }
                }
            }

            if (isset($newArrayData['cost_per_action_type'])) {
                foreach($newArrayData['cost_per_action_type'] as $cost_per_action_type){
                    switch ($cost_per_action_type['action_type']){
                        case 'video_view':
                             $cost_likepage = $cost_per_action_type['value'];
                        break;
                        case 'post_engagement':
                             $cost_post_engagement = $cost_per_action_type['value'];
                        break;
                        case 'page_engagement':
                             $cost_page_engagementn = $cost_per_action_type['value'];
                        break;

                    }
                }
            }
            
                if (isset($newArrayData['video_10_sec_watched_actions'])) {
                foreach($newArrayData['video_10_sec_watched_actions'] as $video_10_sec_watched_actions){
                    switch ($video_10_sec_watched_actions['action_type']){
                        case 'like':
                             $video_10_sec_watched_video_view = $video_10_sec_watched_actions['value'];
                        break;
                    }
                }
            }
            if (isset($newArrayData['video_30_sec_watched_actions'])) {
                foreach($newArrayData['video_30_sec_watched_actions'] as $video_30_sec_watched_actions){
                    switch ($video_30_sec_watched_actions['action_type']){
                        case 'like':
                             $video_30_sec_watched_video_view = $video_30_sec_watched_actions['value'];
                        break;

                    }
                }
            }
            if (isset($newArrayData['video_avg_percent_sec_watched_actions'])) {
                foreach($newArrayData['video_avg_percent_sec_watched_actions'] as $video_avg_percent_sec_watched_actions){
                    switch ($video_avg_percent_sec_watched_actions['action_type']){
                        case 'like':
                             $video_avg_percent_sec_watched_video_view = $video_avg_percent_sec_watched_actions['value'];
                        break;

                    }
                }
            }
            if (isset($newArrayData['video_avg_time_watched_actions'])) {
                foreach($newArrayData['video_avg_time_watched_actions'] as $video_avg_time_watched_actions){
                    switch ($video_avg_time_watched_actions['action_type']){
                        case 'like':
                             $video_avg_time_watched_video_view = $video_avg_time_watched_actions['value'];
                        break;

                    }
                }
            }
            if (isset($newArrayData['video_p25_watched_actions'])) {
                foreach($newArrayData['video_p25_watched_actions'] as $video_p25_watched_actions){
                    switch ($video_p25_watched_actions['action_type']){
                        case 'like':
                             $video_p25_watched_video_view = $video_p25_watched_actions['value'];
                        break;

                    }
                }
            }
            if (isset($newArrayData['video_p50_watched_actions'])) {
                foreach($newArrayData['video_p50_watched_actions'] as $video_p50_watched_actions){
                    switch ($video_p50_watched_actions['action_type']){
                        case 'like':
                             $video_p50_watched_video_view = $video_p50_watched_actions['value'];
                        break;

                    }
                }
            }
            if (isset($newArrayData['video_p75_watched_actions'])) {
                foreach($newArrayData['video_p75_watched_actions'] as $video_p75_watched_actions){
                    switch ($video_p75_watched_actions['action_type']){
                        case 'like':
                             $video_p75_watched_video_view = $video_p75_watched_actions['value'];
                        break;

                    }
                }
            }
            if (isset($newArrayData['video_p95_watched_actions'])) {
                foreach($newArrayData['video_p95_watched_actions'] as $video_p95_watched_actions){
                    switch ($video_p95_watched_actions['action_type']){
                        case 'like':
                             $video_p95_watched_video_view = $video_p95_watched_actions['value'];
                        break;

                    }
                }
            }
            if (isset($newArrayData['video_p100_watched_actions'])) {
                foreach($newArrayData['video_p100_watched_actions'] as $video_p100_watched_actions){
                    switch ($video_p100_watched_actions['action_type']){
                        case 'like':
                             $video_p100_watched_video_view = $video_p100_watched_actions['value'];
                        break;

                    }
                }
            }
            if (isset($newArrayData['video_play_actions'])) {
                foreach($newArrayData['video_play_actions'] as $video_play_actions){
                    switch ($video_play_actions['action_type']){
                        case 'like':
                             $video_play_actions = $video_play_actions['value'];
                        break;

                    }
                }
            }

             $arrayData[$keysValue]['actions_video_view'] = $actions_video_view;
             $arrayData[$keysValue]['actions_post_engagement'] = $actions_post_engagement;
             $arrayData[$keysValue]['actions_page_engagement'] = $actions_page_engagement;
            //  $arrayData[$keysValue]['actions_likepage'] = $actions_likepage;
            //  $arrayData[$keysValue]['actions_link_click'] = $actions_link_click;
            //  $arrayData[$keysValue]['actions_post'] = $actions_post;
            //  $arrayData[$keysValue]['actions_post_reaction'] = $actions_post_reaction;
            //  $arrayData[$keysValue]['actions_comment'] = $actions_comment;
             $arrayData[$keysValue]['cost_per_action_type_video_view'] = $cost_per_action_type_video_view;
             $arrayData[$keysValue]['cost_per_action_type_post_engagement'] = $cost_per_action_type_post_engagement;
             $arrayData[$keysValue]['cost_per_action_type_page_engagement'] = $cost_per_action_type_page_engagement;
             $arrayData[$keysValue]['video_10_sec_watched_video_view'] = $video_10_sec_watched_video_view;
             $arrayData[$keysValue]['video_30_sec_watched_video_view'] = $video_30_sec_watched_video_view;
             $arrayData[$keysValue]['video_avg_time_watched_video_view'] = $video_avg_time_watched_video_view;
             $arrayData[$keysValue]['video_p25_watched_video_view'] = $video_p25_watched_video_view;
             $arrayData[$keysValue]['video_p50_watched_video_view'] = $video_p50_watched_video_view;
             $arrayData[$keysValue]['video_p75_watched_video_view'] = $video_p75_watched_video_view;
             $arrayData[$keysValue]['video_p95_watched_video_view'] = $video_p95_watched_video_view;
             $arrayData[$keysValue]['video_p100_watched_video_view'] = $video_p100_watched_video_view;
             $arrayData[$keysValue]['unique_actions_video_view'] = $unique_actions_video_view;
             $arrayData[$keysValue]['unique_actions_post_engagement'] = $unique_actions_post_engagement;
             $arrayData[$keysValue]['unique_actions_page_engagement'] = $unique_actions_page_engagement;
             $arrayData[$keysValue]['unique_actions_post_engagement'] = $unique_actions_post_engagement;
             $arrayData[$keysValue]['unique_actions_page_engagement'] = $unique_actions_page_engagement;
             $arrayData[$keysValue]['unique_actions_page_engagement'] = $unique_actions_page_engagement;


        }  
        $dataCountBeforeAdAccount = count($FacebookAiwModel->getAdAccountData($account_id));
        
        $countAdAccountData = count($arrayData);
         if  ($countAdAccountData > 0){
                                                                        
       // if (($qtyBd != count($arrayData)) && (count($arrayData) > 0)){//manera antigua
          $deleteData = DeleteFromtableBetweenDates($table,$since,$until,$account_id);
          $saveData = saveInsightsForFacebookAccount($arrayData,$table);
        }
     
        }catch (FacebookAds\Http\Exception\ServerException $e) {
           //echo "Mensaje de error en servidor facebook: ".$e->getMessage();
           sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido en ".__FILE__,"\n\nProbablemente la petición superó en mucho el limite encima de 20 mil registros o el rango de fechas es muy amplio \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
           //sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\nProbablemente la petición superó en mucho el limite encima de 20 mil registros o el rango de fechas es muy amplio \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
    }   
//}



