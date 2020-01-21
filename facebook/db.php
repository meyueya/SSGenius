<?php 
    session_start();
    

    function obtenerDireccionIP()
    {
        if (!empty($_SERVER ['HTTP_CLIENT_IP'] ))
          $ip=$_SERVER ['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER ['HTTP_X_FORWARDED_FOR'] ))
          $ip=$_SERVER ['HTTP_X_FORWARDED_FOR'];
        else
          $ip=$_SERVER ['REMOTE_ADDR'];
     
        return $ip;
    }



    function restringirConjuntoIps($ips)
    {
        $ipCliente = obtenerDireccionIP();
     
        if (in_array($ipCliente,$ips))
        {
            return true;
        }
        else
        {
            header('Location: http://aiw-roi.com/sistema/AIW/denied.php');
            exit;
        }
    }


    function restringirIp($ip)
    {
        $ipCliente = obtenerDireccionIP();
     
        if($ipCliente == $ip)
        {
            return true;
        }
        else
        {
            header('Location: http://aiw-roi.com/sistema/AIW/denied.php');
            exit;
        }
    }
    $datosPEC=array(
    'usuario'=>'aiwroi_pec',
    'clave'=>'n_4qOW.[X1%)',
    'db'=>'aiwroi_pec',
    'nombreCarrera'=>'PEC'
    );
    $datosILCB=array(
    'usuario'=>'aiwroi_ilcb',
    'clave'=>'HW;SXrhefqR%',
    'db'=>'aiwroi_ilcb',
    'nombreCarrera'=>'ILCB'
    );
    $datosMASTER=array(
    'usuario'=>'aiwroi_aiwlcb',
    'clave'=>']a_nc#S}LthH',
    'db'=>'aiwroi_master_cuisine',
    'nombreCarrera'=>'MASTER'
    );
    $datosULCB=array(
    'usuario'=>'aiwroi_ulcb',
    'clave'=>'0a#k}3m!$x4P',
    'db'=>'aiwroi_ulcb',
    'nombreCarrera'=>'ULCB'
    );
    
	if(!isset($_GET['grupo']) && $_SESSION['db']==null ){
	$db = mysql_connect("localhost", "aiwroi_ilcb","HW;SXrhefqR%") or die(mysql_error());
	mysql_select_db("aiwroi_ilcb", $db) or die(mysql_error());
	}else{
    	switch ($_GET['grupo']) {
        case "PEC":
            $_SESSION['user']=$datosPEC['usuario'];
            $_SESSION['pass']=$datosPEC['clave'];
            $_SESSION['db']=$datosPEC['db'];
            break;
        case "ILCB":
            $_SESSION['user']=$datosILCB['usuario'];
            $_SESSION['pass']=$datosILCB['clave'];
            $_SESSION['db']=$datosILCB['db'];
            break;
        case "MASTER":
            $_SESSION['user']=$datosMASTER['usuario'];
            $_SESSION['pass']=$datosMASTER['clave'];
            $_SESSION['db']=$datosMASTER['db'];
            break;
        case "ULCB":
            $_SESSION['user']=$datosULCB['usuario'];
            $_SESSION['pass']=$datosULCB['clave'];
            $_SESSION['db']=$datosULCB['db'];
            break;
        }
        $db = mysql_connect("localhost", $_SESSION['user'],  $_SESSION['pass']) or die(mysql_error());
    	mysql_select_db( $_SESSION['db'], $db) or die(mysql_error());
        
	}
	
?>