<?php
namespace Google\AdsApi\AdWords\Reporting\v201806;
header('Content-Type: application/json');
 error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/../../../../../../vendor/autoload.php';
require 'functions-produccion.php';
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\Query\v201806\ReportQueryBuilder;
use Google\AdsApi\AdWords\Reporting\v201806\DownloadFormat;
use Google\AdsApi\AdWords\Reporting\v201806\ReportDefinitionDateRangeType;
use Google\AdsApi\AdWords\Reporting\v201806\ReportDownloader;
use Google\AdsApi\AdWords\ReportSettingsBuilder;
use Google\AdsApi\AdWords\v201806\cm\ReportDefinitionReportType;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\AdWords\v201806\cm\ApiException;
use \PDO;
class JobAdGoogleReport
{
    const CONFIGURATION_FILENAME = '/home/aiwroi/public_html/sistema/ilcb/administrator2/Classes/google_api/googleads-php-lib/adsapi_php.ini';
    const NAME_TABLE = 'reporte_ad_google';
    public static function runExample(AdWordsSession $session, $reportFormat)
    {
       //$dateRange = sprintf('%d,%d',date('Ymd', strtotime('-7 day')), date('Ymd', strtotime('-1 day')));
      $fecha = date('Y-m-d', strtotime('-1 days'));
      $yesterday = date('Ymd', strtotime('-1 days'));     
      $reportQuery = 'SELECT Id,AdGroupId,CampaignId,ExternalCustomerId,CriterionId,Date,CriterionType,Headline,HeadlinePart1,HeadlinePart2,Description,Description1,Description2,CreativeFinalUrls,DisplayUrl,Status,CampaignName,AdGroupName,AdGroupStatus,CampaignStatus,AdType,Clicks,Impressions,AverageCpc,Conversions,Cost,ImageAdUrl
      FROM AD_PERFORMANCE_REPORT DURING '.$yesterday.','.$yesterday.'';       
        try {
        $reportDownloader = new ReportDownloader($session);
        $reportSettingsOverride = (new ReportSettingsBuilder())
              ->skipReportHeader(true)
              ->skipColumnHeader(true)
              ->skipReportSummary(true)
              ->includeZeroImpressions(false)
              //->useRawEnumValues(false)
            ->build();
        $reportDownloadResult = $reportDownloader->downloadReportWithAwql(sprintf('%s', $reportQuery),$reportFormat,$reportSettingsOverride);
        $data = $reportDownloadResult->getAsString();
        //print($data);
        $xmlData=simplexml_load_string($data, 'SimpleXMLElement', LIBXML_COMPACT | LIBXML_PARSEHUGE); //or die("Error: Cannot create object");
        //print_r($xmlData); 
        //exit();
        //echo count($xmlData->table->row);
        $countFromTable = getCountFromTable(self::NAME_TABLE,$fecha,$fecha);
        $qtyFromGoogle = count($xmlData->table->row);
        if (($countFromTable != $qtyFromGoogle) && ($qtyFromGoogle > 0)){
            DeleteFromtableBetweenDates(self::NAME_TABLE,$fecha,$fecha);
            saveAdsGoogleReport(self::NAME_TABLE,$xmlData->table->row);
            }
        } catch (ApiException $apiException) {
            //print_r($apiException->getErrors());
            $messageError = "";
            foreach ($apiException->getErrors() as $error) {
                $messageError .= $error->getErrorString();
            }
          sendMailer("mario@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$messageError." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
          sendMailer("luismiguel@mimirwell.com","Job fállido en ".__FILE__,"\n\n ".$messageError." \n\n Archivo:".__FILE__."\n Metodo: ".__FUNCTION__."\n Linea".__LINE__);
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
JobAdGoogleReport::main();