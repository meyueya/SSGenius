<?php
namespace Google\AdsApi\AdWords\Reporting\v201809;
header('Content-Type: application/json');
 error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/../../../../../../vendor/autoload.php';
require 'functions.php';
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\Query\v201809\ReportQueryBuilder;
use Google\AdsApi\AdWords\Reporting\v201809\DownloadFormat;
use Google\AdsApi\AdWords\Reporting\v201809\ReportDefinitionDateRangeType;
use Google\AdsApi\AdWords\Reporting\v201809\ReportDownloader;
use Google\AdsApi\AdWords\ReportSettingsBuilder;
use Google\AdsApi\AdWords\v201809\cm\ReportDefinitionReportType;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use \PDO;
class XmlReportWithAwql
{
    const CONFIGURATION_FILENAME = '../../../../../../adsapi_php.ini';
    const NAME_TABLE = 'reporte_ad_google';
    public static function runExample(AdWordsSession $session, $reportFormat)
    {
       //$dateRange = sprintf('%d,%d',date('Ymd', strtotime('-7 day')), date('Ymd', strtotime('-1 day')));
       /* $fecha = date('Y-m-d', strtotime('-1 days'));
        $fecha = '2018-05-16';
        $fecha2 = '2018-07-30';*/        
      $reportQuery = 'SELECT Id,AdGroupId,CampaignId,ExternalCustomerId,CriterionId,Date,CriterionType,Headline,HeadlinePart1,HeadlinePart2,Description,Description1,Description2,CreativeFinalUrls,DisplayUrl,Status,CampaignName,AdGroupName,AdGroupStatus,CampaignStatus,AdType,Clicks,Impressions,AverageCpc,Conversions,Cost,ImageAdUrl FROM AD_PERFORMANCE_REPORT DURING 20180813,20180813';          
        
        // Download report as a string.
        $reportDownloader = new ReportDownloader($session);
        $reportSettingsOverride = (new ReportSettingsBuilder())
              ->skipReportHeader(true)
              ->skipColumnHeader(true)
              ->skipReportSummary(true)
              ->includeZeroImpressions(false)
              //->useRawEnumValues(false)
            ->build();
        $reportDownloadResult = $reportDownloader->downloadReportWithAwql(sprintf('%s', $reportQuery),$reportFormat,$reportSettingsOverride);
        $test = $reportDownloadResult->getAsString();
        //print($test);
        $xml=simplexml_load_string($test, 'SimpleXMLElement', LIBXML_COMPACT | LIBXML_PARSEHUGE); //or die("Error: Cannot create object");
        print_r($xml); 
exit();
        $conn = pdoConect();
        $conn->beginTransaction();
$query = "INSERT INTO ".self::NAME_TABLE." ( `Id`, `AdGroupId`, `CampaignId`,`ExternalCustomerId`, `CriterionId`, `Date`, `CriterionType`, `Headline`, `HeadlinePart1`, `HeadlinePart2`, `Description`, `Description1`, `Description2`, `CreativeFinalUrls`, `DisplayUrl`, `Status`, `CampaignName`
          , `AdGroupName`, `AdGroupStatus`, `CampaignStatus`, `AdType`, `Clicks`, `Impressions`, `AverageCpc`, `Conversions`, `Cost`, `ImageAdUrl`) VALUES "; //Prequery
$qPart = array_fill(0, count($xml->table->row), "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$query .=  implode(",",$qPart);
$stmt = $conn->prepare($query); 
$i = 1;
foreach($xml->table->row as $item) { //bind the values one by one
    //echo $item['criteriaType'];
    //echo "<br>";
       $stmt->bindValue($i++, $item['adID']);
       $stmt->bindValue($i++, $item['adGroupID']);
       $stmt->bindValue($i++, $item['campaignID']);
       $stmt->bindValue($i++, $item['customerID']);
       $stmt->bindValue($i++, $item['keywordID']);
       $stmt->bindValue($i++, $item['day']);
       $stmt->bindValue($i++, $item['criteriaType']);
       $stmt->bindValue($i++, $item['ad']);
       $stmt->bindValue($i++, $item['headline1']);
       $stmt->bindValue($i++, $item['headline2']);
       $stmt->bindValue($i++, $item['description']);
       $stmt->bindValue($i++, $item['descriptionLine1']);
       $stmt->bindValue($i++, $item['descriptionLine2']);
       $stmt->bindValue($i++, $item['finalURL']);
       $stmt->bindValue($i++, $item['displayURL']);
       $stmt->bindValue($i++, $item['adState']);
       $stmt->bindValue($i++, $item['campaign']);
       $stmt->bindValue($i++, $item['adGroup']);
       $stmt->bindValue($i++, $item['adGroupState']);
       $stmt->bindValue($i++, $item['campaignState']);
       $stmt->bindValue($i++, $item['adType']);
       $stmt->bindValue($i++, $item['clicks']);
       $stmt->bindValue($i++, $item['impressions']);
       $stmt->bindValue($i++, $item['avgCPC']);
       $stmt->bindValue($i++, $item['conversions']);
       $stmt->bindValue($i++, $item['cost']);
       $stmt->bindValue($i++, $item['imageAdURL']);
    }
    try {
       // $stmt->execute(); //execute
     } catch (PDOException $e){
         $conn->rollback();
            echo $e->getMessage();
        }
        $conn->commit();
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
XmlReportWithAwql::main();