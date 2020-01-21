<?php
/**
 * Copyright 2017 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */ 
namespace Google\AdsApi\AdWords\Reporting\v201806;
header('Content-Type: application/json');
 error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/../../../../../../vendor/autoload.php';
require 'functions.php';
use Google\AdsApi\AdWords\AdWordsSession;
use Google\AdsApi\AdWords\AdWordsSessionBuilder;
use Google\AdsApi\AdWords\Query\v201806\ReportQueryBuilder;
use Google\AdsApi\AdWords\Reporting\v201806\DownloadFormat;
use Google\AdsApi\AdWords\Reporting\v201806\ReportDefinitionDateRangeType;
use Google\AdsApi\AdWords\Reporting\v201806\ReportDownloader;
use Google\AdsApi\AdWords\ReportSettingsBuilder;
use Google\AdsApi\AdWords\v201806\cm\ReportDefinitionReportType;
use Google\AdsApi\Common\OAuth2TokenBuilder;
/**
 * Downloads CRITERIA_PERFORMANCE_REPORT for the specified client customer ID.
 */
class DownloadCriteriaReportWithAwql
{
    const CONFIGURATION_FILENAME = '../../../../../../adsapi_php.ini';
    public static function runExample(AdWordsSession $session, $reportFormat)
    {
        // Create report query to get the data for last 7 days.
       /* $query = (new ReportQueryBuilder())
            ->select([
                'CampaignId',
                'AdGroupId',
                'Id',
                'Criteria',
                'CriteriaType',
                'Impressions',
                'Clicks',
                'Cost'
            ])
            ->from(ReportDefinitionReportType::CRITERIA_PERFORMANCE_REPORT)
            ->where('Status')->in(['ENABLED', 'PAUSED'])
            ->duringDateRange(ReportDefinitionDateRangeType::LAST_7_DAYS)
            ->build();*/
            //CampaignName,AdGroupName,
            //$dateRange = sprintf('%d,%d',date('Ymd', strtotime('-7 day')), date('Ymd', strtotime('-1 day')));
       /* $fecha = date('Y-m-d', strtotime('-1 days'));*/
        $fecha = '20180801';
        $fecha2 = '20180815';
        
         //$fecha = date('Y-m-d', strtotime('-1 days'));

        //$fecha = '2018-01-01';

        $dia = date('d', strtotime($fecha));

        $mes = date('m', strtotime($fecha));

        $ano = date('Y', strtotime($fecha));

        $fecha_text = $ano . $mes . $dia;

        $reportQuery = 'SELECT Date,Clicks,Impressions,Cost,CampaignName,AdGroupName,DisplayName '
                . '  FROM CRITERIA_PERFORMANCE_REPORT '
                . 'WHERE Status IN [ENABLED, PAUSED] DURING ' . $fecha . ',' . $fecha2 . '';
                
        
            //$reportQuery = 'SELECT CampaignId,AdGroupId,CampaignName,AdGroupName,Date,AdGroupStatus,AdGroupType,CampaignStatus,Impressions,Clicks,Cost,Conversions,ClickAssistedConversions,Ctr,AverageCpc,CostPerConversion FROM ADGROUP_PERFORMANCE_REPORT DURING 20180101,20180731';
           // $reportQuery = 'SELECT Id,CampaignId,AdGroupId,CampaignName,AdGroupName,Date,Criteria,Impressions,Clicks,Cost,Conversions,ClickAssistedConversions,QualityScore,CreativeQualityScore,PostClickQualityScore,Ctr,AverageCpc,CostPerConversion FROM KEYWORDS_PERFORMANCE_REPORT WHERE Status IN [ENABLED,PAUSED] DURING 20180810,20180812';
            //$reportQuery = 'SELECT CampaignId,CampaignName,Date,StartDate,EndDate,Amount,TotalAmount,BudgetId,CampaignStatus,ServingStatus,Clicks,Impressions,Ctr,AverageCpc,Cost,Engagements FROM CAMPAIGN_PERFORMANCE_REPORT WHERE CampaignStatus IN [ENABLED,PAUSED,REMOVED] DURING 20160901,20180731';
            //,CriterionId,CriterionType,IsNegative  WHERE Id = 258400637964 ,AdNetworkType2
            //$reportQuery = 'SELECT Id,AdGroupId,CampaignId,ExternalCustomerId,CriterionId,Date,CriterionType,IsNegative,Headline,HeadlinePart1,HeadlinePart2,Description,Description1,Description2,CreativeFinalUrls,DisplayUrl,Status,CampaignName,AdGroupName,BusinessName,AdGroupStatus,CampaignStatus,AdType,Clicks,Impressions,AverageCpc,Cost,CreativeDestinationUrl,Automated,DevicePreference,ImageAdUrl,LabelIds,Path1,Path2,PromoText,ResponsiveSearchAdDescriptions,ResponsiveSearchAdPath1,ResponsiveSearchAdPath2,ShortHeadline,AdNetworkType1,AdNetworkType2,BounceRate,VideoViews FROM AD_PERFORMANCE_REPORT DURING 20180101,20180731';
            //$reportQuery = 'SELECT Date,Id,AdGroupId,CampaignId,ExternalCustomerId,Headline,HeadlinePart1,HeadlinePart2,Description,Description1,Description2,CreativeFinalUrls,DisplayUrl,Status,CampaignName,AdGroupName,BusinessName,AdGroupStatus,CampaignStatus,AdType,Clicks,Impressions,AverageCpc,Cost,CreativeDestinationUrl,Automated,DevicePreference,ImageAdUrl,LabelIds,Path1,Path2,PromoText,ResponsiveSearchAdDescriptions,ResponsiveSearchAdPath1,ResponsiveSearchAdPath2,ShortHeadline,AdNetworkType1,BounceRate,VideoViews FROM AD_PERFORMANCE_REPORT WHERE Id = 258400637964 DURING 20180731,20180731';
           //$reportQuery = 'SELECT AccountCurrencyCode,AccountDescriptiveName,AccountTimeZone,BidModifier,CampaignId, CampaignName,CampaignStatus,CustomerDescriptiveName,ExternalCustomerId,Id FROM CAMPAIGN_AD_SCHEDULE_TARGET_REPORT';
           //$reportQuery = 'SELECT Criteria,CampaignName,AdGroupName,CampaignStatus,CpcBid,FinalUrls,Clicks,Impressions,Ctr,AverageCpc,Cost FROM KEYWORDS_PERFORMANCE_REPORT WHERE CampaignStatus IN [ENABLED,PAUSED] DURING 20180730,20180730';
            
                
        // Download report as a string.
        $reportDownloader = new ReportDownloader($session);
        $reportSettingsOverride = (new ReportSettingsBuilder())
              ->skipReportHeader(true)
              ->skipColumnHeader(true)
              ->skipReportSummary(true)
              ->includeZeroImpressions(true)
              //->useRawEnumValues(false)
            ->build();
        $reportDownloadResult = $reportDownloader->downloadReportWithAwql(sprintf('%s', $reportQuery),$reportFormat,$reportSettingsOverride);
        $test = $reportDownloadResult->getAsString();
        
        //print($test);
        
        //echo "<br><br>";
         $arr_test = preg_split('/\r\n|[\r\n]/', $test);
        //print_r($arr_test);
        $n_lines = count($arr_test);
        $contador = 0;
        for ($i = 0; $i < $n_lines - 1; $i++) {
            $arr_single_record = explode(",", $arr_test[$i]);
            $fecha = $arr_single_record[0];
            $clics = $arr_single_record[1];
            $impresiones = $arr_single_record[2];
            $cost = round($arr_single_record[3] / 1000000, 2);
            $nombre_campana = $arr_single_record[4];
            
                      $sql_insert = "INSERT INTO `reportegoogle`( `Dia`, `Clics`, `Impresiones`, `CTR`, `CPCprom`, `Costo`,"
                    . " `Posicionprom`, `Conversiones`, `Costoconv`,`Porcentajedeconv`, `Convporpublicacion`, `Convtotalesest`, `Campana`) VALUES "
                    . "('" . $fecha . "'," . $clics . "," . $impresiones . ",'0.00','0.00','" . $cost . "',"
                    . "'0.00','0.00','0.00','0.00','0.00','0.00','" . $nombre_campana . "');";
                    
                   conect_bd();
            //mysql_query($sql_insert);
            disconect();

            echo $sql_insert;
                    
        /*    
            $CampaignId = $arr_single_record[0];
            $CampaignName = $arr_single_record[1];
            $Date = $arr_single_record[2];
            $StartDate = $arr_single_record[3];
            $EndDate = $arr_single_record[4];
            $Amount = $arr_single_record[5];
            $TotalAmount = $arr_single_record[6];
            $BudgetId = $arr_single_record[7];
            $CampaignStatus = $arr_single_record[8];
            $ServingStatus = $arr_single_record[9];
            $Clicks = $arr_single_record[10];
            $Impressions = $arr_single_record[11];
            $Ctr = $arr_single_record[12];
            $AverageCpc = $arr_single_record[13];
            $Cost = $arr_single_record[14];
            $Engagements = $arr_single_record[15];
            
            $sql_insert = "INSERT INTO `reporte_campaigns_google`( `CampaignId`, `CampaignName`, `Date`,`StartDate`, `EndDate`, `Amount`, `TotalAmount`, `BudgetId`,"
                    . " `CampaignStatus`, `ServingStatus`, `Clicks`, `Impressions`, `Ctr`, `AverageCpc`, `Cost`, `Engagements`) VALUES "
                    . "('" . $CampaignId . "','" . $CampaignName . "','" . $Date . "','" . $StartDate . "','".$EndDate."','".$Amount."','" . $TotalAmount . "',"
                    . "'".$BudgetId."','".$CampaignStatus."','".$ServingStatus."','".$Clicks."','".$Impressions."','".$Ctr."','".$AverageCpc."','".$Cost."','".$Engagements."')";
                    
                     conect_bd();
            
                $contador++;
                if ($contador != 1){
                   mysql_query($sql_insert);
                    echo $sql_insert;
                }
             disconect();
            echo "<br>";*/
            
          /*
            $CampaignId = $arr_single_record[0];
            $AdGroupId = $arr_single_record[1];
            $CampaignName = $arr_single_record[2];
            $AdGroupName = $arr_single_record[3];
            $Date = $arr_single_record[4];
            $AdGroupStatus = $arr_single_record[5];
            $AdGroupType = $arr_single_record[6];
            $CampaignStatus = $arr_single_record[7];
            $Impressions = $arr_single_record[8];
            $Clicks = $arr_single_record[9];
            $Cost = $arr_single_record[10];
            $Conversions = $arr_single_record[11];
            $ClickAssistedConversions = $arr_single_record[12];
            $Ctr = $arr_single_record[13];
            $AverageCpc = $arr_single_record[14];
            $CostPerConversion = $arr_single_record[15];
            
            $sql_insert = "INSERT INTO `reporte_adgroup_google`( `CampaignId`, `AdGroupId`, `CampaignName`, `AdGroupName`, `Date`, `AdGroupStatus`, `AdGroupType`, `CampaignStatus`, `Impressions`,"
                    . " `Clicks`, `Cost`, `Conversions`,`ClickAssistedConversions`, `Ctr`, `AverageCpc`, `CostPerConversion`) VALUES "
                    . "('" . $CampaignId . "'," . $AdGroupId . ",'" . $CampaignName . "','".$AdGroupName."','".$Date."','".$AdGroupStatus."','".$AdGroupType."','" . $CampaignStatus . "',"
                    . "'".$Impressions."','".$Clicks."','".$Cost."','".$Conversions."','".$ClickAssistedConversions."','".$Ctr."','" . $AverageCpc . "','" . $CostPerConversion . "');";
                    
                     conect_bd();
            
           
                $contador++;
                if ($contador != 1){
                    //mysql_query($sql_insert);
                    echo $sql_insert;
                }
             disconect();
            echo "<br>";
            */
            
            //Id,CampaignId,AdGroupId,CampaignName,AdGroupName,Date,Criteria,Impressions,Clicks,Cost,Conversions,ClickAssistedConversions,QualityScore,CreativeQualityScore,PostClickQualityScore,Ctr,AverageCpc,CostPerConversion
         
          /*  $Id = $arr_single_record[0];
            $CampaignId = $arr_single_record[1];
            $AdGroupId = $arr_single_record[2];
            $CampaignName = $arr_single_record[3];
            $AdGroupName = $arr_single_record[4];
            $Date = $arr_single_record[5];
            $Criteria = $arr_single_record[6];
            $Impressions = $arr_single_record[7];
            $Clicks = $arr_single_record[8];
            $Cost = $arr_single_record[9];
            $Conversions = $arr_single_record[10];
            $ClickAssistedConversions = $arr_single_record[11];
            $QualityScore = $arr_single_record[12];
            $CreativeQualityScore = $arr_single_record[13];
            $PostClickQualityScore = $arr_single_record[14];
            $Ctr = $arr_single_record[15];
            $AverageCpc = $arr_single_record[15];
            $CostPerConversion = $arr_single_record[17];*/

            /*$sql_insert = "INSERT INTO `reporte_keywords_google`( `Id`, `CampaignId`, `AdGroupId`, `CampaignName`, `AdGroupName`, `Date`, `Criteria`,"
                    . " `Impressions`, `Clicks`, `Cost`,`Conversions`, `ClickAssistedConversions`, `QualityScore`, `CreativeQualityScore`, `PostClickQualityScore`, `Ctr`, `AverageCpc`, `CostPerConversion`) VALUES "
                    . "('" . $Id . "'," . $CampaignId . "," . $AdGroupId . ",'".$CampaignName."','".$AdGroupName."','" . $Date . "',"
                    . "'".$Criteria."','".$Impressions."','".$Clicks."','".$Cost."','".$Conversions."','".$ClickAssistedConversions."','" . $QualityScore . "','" . $CreativeQualityScore . "','" . $PostClickQualityScore . "','" . $Ctr . "','" . $AverageCpc . "','" . $CostPerConversion . "');";
*/
                  //  conect_bd();
                 //mysql_query($sql_insert);
                 //  echo $sql_insert;
                 //$contador++;
                //if ($contador != 1){ }
                // disconect();  
           // echo "<br>";
        }
    }
    public static function main()
    {
        // Generate a refreshable OAuth2 credential for authentication.
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile(self::CONFIGURATION_FILENAME)->build();
        // See: AdWordsSessionBuilder for setting a client customer ID that is
        // different from that specified in your adsapi_php.ini file.
        // Construct an API session configured from a properties file and the
        // OAuth2 credentials above.
        $session = (new AdWordsSessionBuilder())
            ->fromFile(self::CONFIGURATION_FILENAME)
            ->withOAuth2Credential($oAuth2Credential)
            ->build();
        self::runExample($session, DownloadFormat::CSV);
    }
}
DownloadCriteriaReportWithAwql::main();