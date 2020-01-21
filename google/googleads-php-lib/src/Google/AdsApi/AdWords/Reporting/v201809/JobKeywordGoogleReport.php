<?php
namespace Google\AdsApi\AdWords\Reporting\v201809;
header('Content-Type: application/json');
 error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/../../../../../../vendor/autoload.php';
require 'functions-produccion.php';
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\Query\v201809\ReportQueryBuilder;
use Google\AdsApi\AdWords\Reporting\v201809\DownloadFormat;
use Google\AdsApi\AdWords\Reporting\v201809\ReportDefinitionDateRangeType;
use Google\AdsApi\AdWords\Reporting\v201809\ReportDownloader;
use Google\AdsApi\AdWords\ReportSettingsBuilder;
use Google\AdsApi\AdWords\v201809\cm\ReportDefinitionReportType;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\AdWords\v201809\cm\ApiException;
use \PDO;
class JobKeywordGoogleReport
{
    const CONFIGURATION_FILENAME = '/home/ssgenius/public_html/app/google/googleads-php-lib/adsapi_php.ini';
    const NAME_TABLE = 'aiw_google_data_ads';    
    public static function runExample(AdWordsSession $session, $reportFormat)
    {
       //$dateRange = sprintf('%d,%d',date('Ymd', strtotime('-7 day')), date('Ymd', strtotime('-1 day')));
      $fecha = date('Y-m-d', strtotime('-90 days'));
      $yesterday = date('Ymd', strtotime('-90 days'));
      $reportQuery = 'SELECT Id,
      CampaignId,
      AdGroupId,
      CampaignName,
      AdGroupName,
      Date,
      Criteria,
      Impressions,
      Clicks,
      Cost,
      Conversions,
      ClickAssistedConversions,
      QualityScore,
      CreativeQualityScore,
      PostClickQualityScore,
      Ctr,
      AverageCpc,
      CostPerConversion 
      FROM KEYWORDS_PERFORMANCE_REPORT WHERE Status IN [ENABLED,PAUSED] DURING '.$yesterday.','.$yesterday.'';
       try {
        $reportDownloader = new ReportDownloader($session);
        $reportSettingsOverride = (new ReportSettingsBuilder())
              ->skipReportHeader(true)
              ->skipColumnHeader(true)
              ->skipReportSummary(true)
              ->includeZeroImpressions(true)
              //->useRawEnumValues(false)
            ->build();
       
        $reportDownloadResult = $reportDownloader->downloadReportWithAwql(sprintf('%s', $reportQuery),$reportFormat,$reportSettingsOverride);
        $data = $reportDownloadResult->getAsString();
        $xmlData=simplexml_load_string($data, 'SimpleXMLElement', LIBXML_COMPACT | LIBXML_PARSEHUGE); //or die("Error: Cannot create object");
    echo('<pre>');
     var_dump($xmlData);
    echo('</pre>');
   die;
        //print_r($xmlData);
        $countFromTable = getCountFromTable(self::NAME_TABLE,$fecha,$fecha);
        $qtyFromGoogle = count($xmlData->table->row);
        if ($countFromTable != $qtyFromGoogle){
            DeleteFromtableBetweenDates(self::NAME_TABLE,$fecha,$fecha);
            saveKeywordsGoogleReport(self::NAME_TABLE,$xmlData->table->row);
            } 
       } catch (ApiException $apiException) {
            //print_r($apiException->getErrors());
            $messageError = "";
            foreach ($apiException->getErrors() as $error) {
                $messageError .= $error->getErrorString();
            }
            sendMailer("ssgdeveloperalerts@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$messageError." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
            sendMailer("info@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$messageError." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
        }
    }
    
    public static function main()
    { 
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile(self::CONFIGURATION_FILENAME)->build();
        $session = (new AdWordsSessionBuilder())
            ->fromFile(self::CONFIGURATION_FILENAME)
            ->withOAuth2Credential($oAuth2Credential)
            ->build();
        self::runExample($session, DownloadFormat::XML);
    }
}

JobKeywordGoogleReport::main();
