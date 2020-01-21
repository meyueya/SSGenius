<?php
header('Content-Type: application/json');
//if (ob_get_level() == 0) ob_start();
include('insert_fb_data_dayWork.php');
//$account_id = '216220169082098'; //PEC Le Cordon
//$account_id = '263704911080094'; //INSTITUTO LCB
//$account_id = '1071159706331825'; //PEC LCB
//$account_id = '1073271616120634'; //ilcb
//$account_id = '1414429155338210'; //master_cuisine
//$account_id = '1063559070425222'; //ulcb
//$account_id = '1487762988004826'; //movil_tours
//$since = "2018-09-01";
//$until = "2018-09-01";
$table = "aiw_facebook_data_ads";// tabla donde se guarda la data 
$type = $_POST['token'];
$account_id = $_POST['account_id'];
//echo $f;
if (($type =! "") && ($date =! "") && ($account_id =! "")){
    $lastDateSave = getMaxDateFromFacebookSavedData($_POST['token']);
    if ($lastDateSave == ''){
        $date = $_POST['date'];
         //$date = '2018-08-01'; //fecha de inicio
    }else {
        $date = date('Y-m-d',strtotime($lastDateSave ."+1 days"));
    }
    $since = $date;
    $until = $date;
    $ayer = date('Y-m-d',strtotime("-1 days"));//obtenemos el dia de ayer
    //echo $ayer;
    //echo $lastDateSave;
    $qty = "";
    if ($ayer > $lastDateSave ){
        //echo "guarda";
        $f = insert_fb_data($_POST['account_id'],$since,$until,$table);
        registerInsertData($date,$qty,$f,$_POST['token']);
        $result = array("flag"=>'1',"status"=>"Ok","mensaje"=>"'.$f.'");
        // ob_flush();
        //flush();
        //sleep(1);
        //header('Location: https://aiw-roi.com/sistema/ilcb/administrator2/Classes/facebook_api/facebook-php-business-sdk/guardadatapaginafacebook.php');
    } else {
        //echo "ya no guarda";
        $result = array("flag"=>'0',"status"=>"Completed","mensaje"=>"<span class='green' style='padding:5px; color:#FFF;'>Tarea finalizada!</span>");
    }
} else {
    $result = array("flag"=>'0',"status"=>"Error","mensaje"=>"No se pasaron datos para esta solicitud");
}

//echo "\n";
//$result = array("flag"=>'1',"status"=>"Ok");
//ob_end_flush();
echo json_encode($result);

/*if (registerInsertData($fechaInicio)){
    echo "se guardo";
}*/