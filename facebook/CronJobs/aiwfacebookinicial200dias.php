<?php
//este archivo jala información de facebook de los datos de publicidad
//este archivo debería de ser invocado por un cron job cada 15 minutos
//si no encuentra nada que hacer, debería cerrarse
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!defined('STDOUT'))
define('STDOUT', fopen('php://stdout', 'w'));
define('SDK_DIR', '../facebook-php-business-sdk/'); // Path to the SDK directory
//define('SDK_DIR', '/home/ssgenius/public_html/app/facebook/facebook-php-business-sdk/'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
require_once('../facebook-php-business-sdk/util.php');
require_once('../../model/UserModel.php');
require_once('../../model/FacebookAiwModel.php');
require_once('../../helper/SsgHelper.php');
// var_dump($loader);
// die;
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

// esta conexión a la base de datos extrae la fecha desde donde tiene que empezar a jalar los datos
// esta información está en la tabla "aiw_facebook_primera_carga"
// usa la variable "id_account" para saber de que cuenta tiene que jalar estos datos
// esta conexión me dice cual es la 1era línea de la tabla y de esta línea extrae la fecha en la columna "restart_day"
$conec = Database::getInstance();
$stm = $conec->prepare("SELECT (SELECT `restart_day` FROM `aiw_facebook_primera_carga` ORDER BY `id_adaccount` LIMIT 1) as 'first'");
$stm->execute();
$job = $stm->fetchAll();
$lastdate = $job['0']['0'];
    
//la 1era variable "dates" establece que día es hoy
//la 2da variable "yesterday" nos permite saber que día fue ayer
$dates= date ('Y-m-d');
$yesterday = date( "Y-m-d", strtotime( "-1 day", strtotime( $dates ) ) );

//Este loop es el que va a extraer los datos de todas las cuentas que están pendientes en "aiw_facebook_primera_carga"
//este if nos informa cuando debe detener el loop
//la variable "lastdate" es la última fecha que muestra la tabla "aiw_facebook_primera_carga"
//si el día de ayer es mayor a lastdate, entonces el loop tiene que dar una nueva vuelta
//la variable lastdate fue definida en el query anterio                      
if($lastdate < $yesterday ){
    
    //esta conexión a la base de datos nos dice cual es el id_account que vamos a usar
    //creo que hay que corregir esto, porque primero (al inicio) debería de elegirse cual es el id_adaccount para ejecutar
    //el loop y luego que sepamos cual id_adaccount es el correcto, recién extraer la fecha de inicio de proceso
    $con = Database::getInstance();
    $stmt = $con->prepare("SELECT (SELECT `id_adaccount` FROM `aiw_facebook_primera_carga` ORDER BY `id_adaccount` DESC LIMIT 1) as 'last'");
    $stmt->execute();
    $jobs = $stmt->fetchAll();
    $newid = $jobs['0']['0'];
    
    //estas son las credenciales del APP de facebook y la tabla donde vamos a guardar los datos extraidos
    $app_id = '292708578241182';
    $app_secret = '462aeec937ca833dd9798c944d5c79e2';
    $table = "aiw_facebook_data_ads";//tabla de guardado de insights ads 
    
    //si existe un valor diferente a NULL en newid, entonces procesa lo siguiente
    //asigna el valor de newid a account_id
    //no tengo idea porque asigna el account_id a ad_account_id
    //luego ejecuta la función que extrae las credenciales de la cuenta publicitaria
    //si no hay token, se corta el proceso
    if (isset($newid)){
          $account_id = $newid;
          $ad_account_id = 'act_'.$account_id;
          $access_token = $FacebookAiwModel->getTokenForFacebookAiwAdAccount($account_id);

    }   else { 
           exit();
        }

    // Configurations - End
 
    //estos if validan si el access token o la cuenta están activas y con permisos    
    if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {  
        throw new \Exception('You must set your access token, app id and app secret before executing');
        }
    
    if (is_null($ad_account_id)) { 
        throw new \Exception('You must set your account id before executing');
        }

    $con = Database::getInstance();
    $stmt = $con->prepare("SELECT (SELECT `date_stop` FROM `aiw_facebook_data_ads` WHERE `account_id` = :id_adaccount ORDER BY `id` DESC LIMIT 1) as 'last'");
    $stmt->bindParam(':id_adaccount', $account_id);
    $stmt->execute();
    $jobs = $stmt->fetchAll();
    $newdate = $jobs['0']['0'];  
            
    $diaconsulta = date(strtotime("$newdate")); // la primera vez que comience a jalar datos
    $now = date ('Y-m-d');
    $today = date(strtotime("$now"));
    $diaconsultabreak = date(strtotime("$lastdate"));
    $missingdaybreak = (($today -$diaconsultabreak)/86400);

    $missingdays = (($today -$diaconsulta)/86400);// esto me dice cuantos dias hay , desde la ultima vez que se cargaron datos de esa cuenta

    //Estos If definen cuantos dias, vamos a correr el Loop para extraer datos de facebook
    //Si miisingdays es diferente a cero, entonces el loop empieza, si es igual a cero, se corta
    //termina en la linea 473 aprox
    if ($missingdays != 0) 
        {
        //este if verifica si missingdays es mayor a 200 días. Si es mayor, limita los loops a 200
        //de lo contrario, el total de loops (totaldays) será igual a la cantidad de días
        //OJO; este sistema solo procesa los 200 días pasados de la pauta, no más
        if ($missingdays > $missingdaybreak) {
            $totaldays = $missingdaybreak ;
            } else {
                if ($missingdays >= 201) {
                    $totaldays = 201 ;
                    }  
                if (  $missingdays < 201 &&  $missingdays > 0 ) {
                    $totaldays = $missingdays;
                    }
            }  
        
        //la variable today es el control para saber qué día es hoy que se realiza el proceso
        //la variable totalloops es la cantidad de veces que el loop dará vueltas, y se sabe por el total de
        //días que hay entre hoy y la fecha inicial que estaba en la base de datos
        $today = date('Y-m-d');
        $totalloops = $totaldays;
    
        //acá empieza el loop que va a extraer los datos de Facebook y los va a insertar en la BD local
        for ($i = 1; $i != $totalloops; $i++) {
            sleep(3);
        $dia = date('Y-m-d',strtotime(" - $totaldays days")); // la primera vez que comience a jalar datos
        $insertdate = date('Y-m-d',strtotime("  $dia ")); //insertdate es la variable que vamos a usar para controlar en que dia nos quedamos insertando datos en la BD en caso haya un time out y no existan datos en muchos dias en FB
        $n_dia = 1; 
         
        
        if ($n_dia >= 1) {
            $since = $dia;//desde 2018-04-17
            $until = $dia;//hasta 2018-05-15
            $limit = 5000;//limite por cursor 5 mil es el mÃ¡ximo de facebook por peticiÃ³n al momento
            $fields = array(
                'date_start', // La fecha de inicio de sus datos. Esto estÃ¡ controlado por el intervalo de fechas que ha seleccionado para su vista de informes.
                'date_stop', // La fecha de finalizaciÃ³n de sus datos. Esto estÃ¡ controlado por el intervalo de fechas que ha seleccionado para su vista de informes.
                'ad_id', //La ID Ãºnica del anuncio que estÃ¡ viendo en los informes.
                'account_id', //El nÃºmero de identificaciÃ³n de su cuenta de anuncio, que agrupa su actividad publicitaria. Su cuenta de anuncios incluye sus campaÃ±as, anuncios y facturaciÃ³n.
                'campaign_id', //El nÃºmero de identificaciÃ³n Ãºnico de la campaÃ±a publicitaria que estÃ¡ viendo en los informes. Su campaÃ±a contiene conjuntos de anuncios y anuncios.
                'adset_id', //La ID Ãºnica del conjunto de anuncios que estÃ¡ viendo en los informes. Un conjunto de anuncios es un grupo de anuncios que comparten el mismo presupuesto, programaciÃ³n, optimizaciÃ³n de publicaciÃ³n y segmentaciÃ³n
                'account_name', //El nombre de su cuenta de anuncios, que agrupa su actividad publicitaria. Su cuenta de anuncios incluye sus campaÃ±as, anuncios y facturaciÃ³n.
                'campaign_name', //El nombre de la campaÃ±a publicitaria que estÃ¡ viendo en los informes. Su campaÃ±a contiene conjuntos de anuncios y anuncios.
                'adset_name', //El nombre del conjunto de anuncios que estÃ¡ viendo en los informes. Un conjunto de anuncios es un grupo de anuncios que comparten el mismo presupuesto, programaciÃ³n, optimizaciÃ³n de publicaciÃ³n y segmentaciÃ³n.
                'ad_name', //El nombre del anuncio que estÃ¡ viendo en los informes.
                //'actions', //El nÃºmero total de acciones realizadas por personas que se atribuyen a sus anuncios. Las acciones pueden incluir participaciÃ³n, clics o conversiones
                'reach', // El nÃºmero de personas que vieron sus anuncios al menos una vez. El alcance es diferente de las impresiones, que pueden incluir mÃºltiples vistas de sus anuncios por las mismas personas. Esta mÃ©trica es estimada.
                'impressions', // La cantidad de veces que sus anuncios estuvieron en pantalla.
                'clicks', // El nÃºmero de clics en sus anuncios.
                'spend', // La cantidad total estimada de dinero que ha gastado en su campaÃ±a, conjunto de anuncios o anuncio durante su programaciÃ³n. Esta mÃ©trica es estimada.
                //'video_10_sec_watched_actions', // La cantidad de veces que su video se reproduce durante al menos 10 segundos, o casi su duraciÃ³n total si es mÃ¡s corto que 10 segundos. Para cada impresiÃ³n de un video, contaremos las vistas de video por separado y excluiremos el tiempo dedicado a reproducir el video.
                //'video_30_sec_watched_actions', // La cantidad de veces que su video se reproduce durante al menos 30 segundos, o para casi su duraciÃ³n total si es mÃ¡s corto que 30 segundos. Para cada impresiÃ³n de un video, contaremos las vistas de video por separado y excluiremos el tiempo dedicado a reproducir el video.
                //'video_avg_percent_watched_actions', // La cantidad de veces que su video se reproduce durante al menos 30 segundos, o para casi su duraciÃ³n total si es mÃ¡s corto que 30 segundos. Para cada impresiÃ³n de un video, contaremos las vistas de video por separado y excluiremos el tiempo dedicado a reproducir el video.
                //'video_avg_time_watched_actions', // El tiempo promedio en que se reprodujo un video, incluido el tiempo que se pasa reproduciendo el video para obtener una Ãºnica impresiÃ³n
                //'video_p100_watched_actions', // La cantidad de veces que se reprodujo su video al 100% de su duraciÃ³n, incluidas las reproducciones que se saltaron hasta este punto
                //'video_p25_watched_actions', // La cantidad de veces que se reprodujo su video al 25% de su duraciÃ³n, incluidas las reproducciones que se saltaron hasta este punto.
               //'video_p50_watched_actions', // La cantidad de veces que se reprodujo su video al 50% de su duraciÃ³n, incluidas las reproducciones que se saltaron hasta este punto.
                //'video_p75_watched_actions', // La cantidad de veces que se reprodujo su video al 75% de su duraciÃ³n, incluidas las reproducciones que se saltaron hasta este punto.
                //'video_p95_watched_actions', // La cantidad de veces que se reprodujo su video al 90% de su duraciÃ³n, incluidas las reproducciones que se saltaron hasta este punto.
                //'video_play_actions', // La cantidad de veces que su video comienza a reproducirse. Esto se cuenta para cada impresiÃ³n de un video y excluye las repeticiones. Esta mÃ©trica estÃ¡ en desarrollo.
                'website_ctr', // El porcentaje de veces que las personas vieron su anuncio y realizaron un clic en el enlace.
                'website_purchase_roas', // El rendimiento total de la inversiÃ³n publicitaria (ROAS) de las compras realizadas en el sitio web. Esto se basa en el valor de todas las conversiones registradas por el pÃ­xel de Facebook en su sitio web y atribuidas a sus anuncios.
                //'cost_per_action_type', // El coste medio de una acciÃ³n relevante.
                'objective', // El objetivo que refleja el objetivo que desea lograr con su publicidad. Puede ser diferente del objetivo seleccionado de la campaÃ±a en algunos casos
                'action_values', // El valor total de todas las conversiones atribuidas a sus anuncios.
                'buying_type', // El mÃ©todo mediante el cual usted paga y dirige los anuncios en sus campaÃ±as: a travÃ©s de ofertas de subasta dinÃ¡micas, ofertas de precio fijo o alcance y compras de frecuencia. Este campo actualmente solo es visible a nivel de campaÃ±a.
                'frequency', // La cantidad promedio de veces que cada persona vio su anuncio. Esta mÃ©trica es estimada.
                'inline_link_clicks', // La cantidad de clics en los enlaces para seleccionar destinos o experiencias, dentro o fuera de las propiedades propiedad de Facebook. Los clics en enlaces en lÃ­nea utilizan una ventana de atribuciÃ³n fija de 1 dÃ­a de clic.
                'inline_post_engagement', // El nÃºmero total de acciones que realizan las personas en relaciÃ³n con sus anuncios. Los compromisos de publicaciones en lÃ­nea utilizan una ventana de atribuciÃ³n fija de un dÃ­a de clic.
                //'unique_actions', // El nÃºmero de personas que realizaron una acciÃ³n que se atribuyÃ³ a sus anuncios. Esta mÃ©trica es estimada.
                'unique_clicks', // El nÃºmero de personas que realizaron una acciÃ³n que se atribuyÃ³ a sus anuncios. Esta mÃ©trica es estimada.
                'unique_ctr', // El porcentaje de personas que vieron su anuncio y realizaron un clic Ãºnico (todos). Esta mÃ©trica es estimada.
                'unique_inline_link_click_ctr', // El porcentaje de veces que las personas vieron su anuncio y realizaron un clic en el enlace. La tasa de clics en lÃ­nea utiliza una ventana de atribuciÃ³n de clics de 1 dÃ­a. Esta mÃ©trica es estimada.
                'unique_inline_link_clicks', // Haga clic en el nÃºmero de personas que realizaron un enlace en lÃ­nea. Esta mÃ©trica es estimada.
                'unique_link_clicks_ctr', // Haga clic en el nÃºmero de personas que realizaron un enlace en lÃ­nea. Esta mÃ©trica es estimada.
                'unique_outbound_clicks', // Haga clic en el porcentaje de personas que vieron su anuncio y realizaron un enlace. Esta mÃ©trica es estimada.
                'unique_outbound_clicks_ctr', // El porcentaje de personas que vieron su anuncio y realizaron un clic de salida. Esta mÃ©trica es estimada.
                'outbound_clicks', // La cantidad de clics en los enlaces que quitan a las personas de las propiedades de Facebook.
                'relevance_score', // Una calificaciÃ³n de 1 a 10 que estima quÃ© tan bien estÃ¡ respondiendo su pÃºblico objetivo a su anuncio. Esta puntuaciÃ³n se muestra despuÃ©s de que su anuncio reciba mÃ¡s de 500 impresiones. Solo es visible cuando se busca en los informes de anuncios y no aparece para conjuntos de anuncios y campaÃ±as. Este campo actualmente solo es visible en el nivel del anuncio.
                'account_currency', //Moneda utilizada por su cuenta de anuncio.
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
// var_dump($api);
// die;
        }
        

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
  
    //   var_dump($arrayData);
    //   die;
                                                                        
        // $qtyBd = getCountFromtable($table,$since,$until,$account_id);//seteo la data manera antigua
        // $qtyBd = getCountFromtable($table,$since,$until,$account_id);//seteo la data manera antigua
        $dataCountBeforeAdAccount = count($FacebookAiwModel->getAdAccountData($account_id));
        $countAdAccountData = count($arrayData);
         if  ($countAdAccountData > 0){//Comparo la data
       // if (($qtyBd != count($arrayData)) && (count($arrayData) > 0)){// comparo la data manera antigua
       
       //Guardo la Data
          $deleteData = DeleteFromtableBetweenDates($table,$since,$until,$account_id);
          $saveData = saveInsightsForFacebookAccount($arrayData,$table);

          $insertdate = date('Y-m-d',strtotime(" $insertdate +1 days"));
          $arraydate = array('id_adaccount' => $account_id , 'restart_day' => $insertdate);
          $fecha = $FacebookAiwModel->TimeOutDate($arraydate);
          $totaldays = $totaldays -1;

         }else {
             
            $insertdate = date('Y-m-d',strtotime(" $insertdate +1 days"));
            $arraydate = array('id_adaccount' => $account_id , 'restart_day' => $insertdate);
            $fecha = $FacebookAiwModel->TimeOutDate($arraydate);
            $totaldays = $totaldays -1;
         }
         
     
        }catch (FacebookAds\Http\Exception\ServerException $e) {
           sendMailer("ssgdeveloperalerts@mimirwell.com","Job fÃ¡llido en ".__FILE__,"\n\nProbablemente la peticiÃ³n superÃ³ en mucho el limite encima de 20 mil registros o el rango de fechas es muy amplio \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
           sendMailer("info@mimirwell.com","Job fÃ¡llido en ".__FILE__,"\n\nProbablemente la peticiÃ³n superÃ³ en mucho el limite encima de 20 mil registros o el rango de fechas es muy amplio \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
    } 
     }
     $array = array('id_adaccount' => $account_id , 'aiw_status' => "1");
     $deleteData = $FacebookAiwModel->deleteAdAccountFromfetch201days($array);
    
 } else{
     $array = array('id_adaccount' => $account_id , 'aiw_status' => "1");
     $deleteData = $FacebookAiwModel->deleteAdAccountFromfetch201days($array);
 }  
 
    }else{
    $array = array('id_adaccount' => $account_id , 'aiw_status' => "1");
     $deleteData = $FacebookAiwModel->deleteAdAccountFromfetch201days($array);
    }
    


