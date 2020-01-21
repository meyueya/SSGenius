<?php
require_once('/home/aiwroi/public_html/ssgenius.com/app/model/FacebookModel.php');
$FacebookModel = new FacebookModel();
$data = "#!/usr/bin/bash".PHP_EOL;
$jobsAdAccounts = $FacebookModel->getActiveFacebookAdAccountJobs();
var_dump($jobsAdAccounts);die;
foreach($jobsAdAccounts as $jobsAdAccount){
     exit();
    $data .= "php  /home/aiwroi/public_html/ssgenius.com/app/facebook/CronJobs/SsgFacebookAdPostJob.php adaccount=".$jobsAdAccount['id_adaccount'].PHP_EOL;
    $data .= "wait".PHP_EOL;
}
$file ="/home/aiwroi/public_html/ssgenius.com/app/facebook/CronJobs/ssgCronTabFacebookAdAccount.sh";
$adAccount = file_put_contents($file,$data.PHP_EOL);