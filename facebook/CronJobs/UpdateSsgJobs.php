<?php
/*error_reporting(E_ALL);
    ini_set('display_errors', 1);*/
require_once('/home/ssgenius/public_html/app/model/FacebookModel.php');
require_once('/home/ssgenius/public_html/app/model/FacebookAiwModel.php');
$FacebookModel = new FacebookModel();
//page post
$data = "#!/usr/bin/bash".PHP_EOL;
$jobs = $FacebookModel->getActiveFacebookPostPageJobs();
foreach($jobs as $job){
    $data .= "php  /home/ssgenius/public_html/app/facebook/CronJobs/ssgFacebookPostPageJob.php t=".$job['id_ssgfacebookpostpagejob'].PHP_EOL;
    $data .= "wait".PHP_EOL;
}
$file ="/home/ssgenius/public_html/app/facebook/CronJobs/ssgCronTabFacebookPostPage.sh";
$postPage = file_put_contents($file,$data.PHP_EOL);
chmod($file, 0775);

//page fans
$data = "#!/usr/bin/bash".PHP_EOL;
$jobs = $FacebookModel->getActiveFacebookPostPageJobs();
foreach($jobs as $job){
    $data .= "php  /home/ssgenius/public_html/app/facebook/CronJobs/FacebookPageFansJob.php t=".$job['id_ssgfacebookpostpagejob'].PHP_EOL;
    $data .= "wait".PHP_EOL;
}
$file ="/home/ssgenius/public_html/app/facebook/CronJobs/ssgCronTabFacebookPageFans.sh";
$postPage = file_put_contents($file,$data.PHP_EOL);
chmod($file, 0775);

//page post comments
$data = "#!/usr/bin/bash".PHP_EOL;
$jobs = $FacebookModel->getActiveFacebookPostPageJobs();
foreach($jobs as $job){
    $data .= "php  /home/ssgenius/public_html/app/facebook/CronJobs/SsgFacebookPageCommentsJob.php t=".$job['id_ssgfacebookpostpagejob'].PHP_EOL;
    $data .= "wait".PHP_EOL;
}
$file ="/home/ssgenius/public_html/app/facebook/CronJobs/ssgCronTabFacebookPageComments.sh";
$postPage = file_put_contents($file,$data.PHP_EOL);
chmod($file, 0775);

//page inbox conversations
$data = "#!/usr/bin/bash".PHP_EOL;
$jobs = $FacebookModel->getActiveFacebookPostPageJobs();
foreach($jobs as $job){
    $data .= "php  /home/ssgenius/public_html/app/facebook/CronJobs/SsgFacebookPageConversationsJob.php t=".$job['id_ssgfacebookpostpagejob'].PHP_EOL;
    $data .= "wait".PHP_EOL;
}
$file ="/home/ssgenius/public_html/app/facebook/CronJobs/ssgCronTabFacebookPageConversations.sh";
$postPage = file_put_contents($file,$data.PHP_EOL);
chmod($file, 0775);

//Cuenta Publicitaria
$data = "#!/usr/bin/bash".PHP_EOL;
$jobsAdAccounts = $FacebookModel->getActiveFacebookAdAccountJobs();
foreach($jobsAdAccounts as $jobsAdAccount){
    $data .= "php  /home/ssgenius/public_html/app/facebook/CronJobs/SsgFacebookAdPostJob.php adaccount=".$jobsAdAccount['id_adaccount'].PHP_EOL;
    $data .= "wait".PHP_EOL;
}
$file ="/home/ssgenius/public_html/app/facebook/CronJobs/ssgCronTabFacebookAdAccount.sh";
$adAccount = file_put_contents($file,$data.PHP_EOL);
chmod($file, 0775);

//Activar AIW
$FacebookAiwModel = new FacebookAiwModel();
$data = "#!/usr/bin/bash".PHP_EOL;
$jobsAdAccounts = $FacebookAiwModel->getActiveFacebookAiwAdAccountJobs();
 //var_dump($jobsAdAccounts);die;
foreach($jobsAdAccounts as $jobsAdAccount){
    $data .= "php /home/ssgenius/public_html/app/facebook/CronJobs/AiwFacebookAdPostJob.php adaccount=".$jobsAdAccount['id_adaccount'].PHP_EOL;
    $data .= "wait".PHP_EOL;
}
$file ="/home/ssgenius/public_html/app/facebook/CronJobs/aiwCronTabFacebookAdAccount.sh";
$adAccount = file_put_contents($file,$data.PHP_EOL);
chmod($file, 0775);
