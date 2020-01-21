<?php

define("MAX_CONSULTAS", 5);

//error_reporting(error_reporting() & ~E_NOTICE);
################ redirect, redirecciona a una url  -  function #########################################

function conect_bd() {

    if (!($con = mysql_connect("localhost", "aiwroi_pec", "n_4qOW.[X1%)") or die(mysql_error()))) {
        echo "Error al conectar al servidor";
        exit();
    }
    if (!mysql_select_db("aiwroi_pec", $con)) {
        echo "Error al seleccionar la base de datos";
        exit();
    }
    /* $this->cn = $con;
      return $this->cn; */
}

function disconect() {
    mysql_close();
}

function conect_bd_phplist2() {

    if (!($con = mysql_connect("localhost", "lcbingre_phpl581", "K07)S8x(p5") or die(mysql_error()))) {
        echo "Error al conectar al servidor";
        exit();
    }
    if (!mysql_select_db("lcbingre_phpl581", $con)) {
        echo "Error al seleccionar la base de datos";
        exit();
    }
    /* $this->cn = $con;
      return $this->cn; */
}

function select_table($table, $key, $campo, $criterio) {
    if ($key == 1) {
        $sql = "select * from " . $table . ";";
    } else if ($key == 2) {
        $sql = "select * from " . $table . " where " . $campo . " = '" . $criterio . "';";
        
    } else if ($key == 3) {
        $sql = "select * from " . $table . " where " . $campo . " like '" . $criterio . "%;";
    } else if ($key == 4) {
        $sql = "select * from " . $table . " where " . $campo . " like '%" . $criterio . "%;";
    }
    return $sql;
}

function redirect($url, $time = 0) {
    echo '<script>window.location.href="' . $url . '";</script>';
}

function dia_spanish($dia_english) {
    $array = array(
        "MONDAY" => "LUNES",
        "TUESDAY" => "MARTES",
        "WEDNESDAY" => "MIERCOLES",
        "THURSDAY" => "JUEVES",
        "FRIDAY" => "VIERNES",
        "SATURDAY" => "SABADO",
        "SUNDAY" => "DOMINGO",
    );
    return $array[strtoupper($dia_english)];
}

#Obtener las fechas que hay entre dos fechas dadas

function dates_between($startdate, $enddate, $format = null) {

    (is_int($startdate)) ? 1 : $startdate = strtotime($startdate);
    (is_int($enddate)) ? 1 : $enddate = strtotime($enddate);

    if ($startdate > $enddate) {
        return false; //The end date is before start date
    }

    while ($startdate < $enddate) {
        $arr[] = ($format) ? date($format, $startdate) : $startdate;
        $startdate += 86400;
    }
    $arr[] = ($format) ? date($format, $enddate) : $enddate;

    return $arr;
}

# Obtener tipo de dispositivo

function details_device() {
    $tablet_browser = 0;
    $mobile_browser = 0;
    $body_class = 'desktop';

    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $tablet_browser++;
        $body_class = "tablet";
    }

    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
        $body_class = "mobile";
    }

    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ( (isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $mobile_browser++;
        $body_class = "mobile";
    }

    $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
        'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
        'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
        'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
        'newt', 'noki', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
        'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
        'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
        'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
        'wapr', 'webc', 'winw', 'winw', 'xda ', 'xda-');

    if (in_array($mobile_ua, $mobile_agents)) {
        $mobile_browser++;
    }

    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
        $mobile_browser++;
        //Check for tablets on opera mini alternative headers
        $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
            $tablet_browser++;
        }
    }

    if ($tablet_browser > 0) {
        // Si es tablet has lo que necesites
        $type_device = 'tablet';
    } else if ($mobile_browser > 0) {
        // Si es dispositivo mobil has lo que necesites
        $type_device = 'mobil';
    } else {
        // Si es ordenador de escritorio has lo que necesites
        $type_device = 'desktop';
    }

    return $type_device;
}

# Obterner IP real del cliente

function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

#FUNCION PUNTUAR CON ESTRELLAS

function estrellas($n) {
    $nmax = 5;
    for ($ix = 0; $ix < $nmax; $ix++) {
        if ($ix < $n) {
            $html_star .= '<i class="fa fa-star"></i>';
        } else {
            $html_star .= '<i class="fa fa-star-o"></i>';
        }
    }
    return $html_star;
}

################ assign, muestra un mensaje  -  function #########################################

function assign($mensaje, $tipo = 0) {
    //$_SESSION['mensaje'] = $mensaje;
    if ($tipo == 1) { //alerta
        //$mensaje="<div class=\"error\">".$_SESSION['mensaje']."</div>";
        $mensaje = '<div class="alert"><button class="close" type="button" data-dismiss="alert">×</button><strong>Alerta!</strong> ' . $mensaje . '</div>';
    } elseif ($tipo == 2) { //alerta
        //$mensaje="<div class=\"error\">".$_SESSION['mensaje']."</div>";
        $mensaje = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert">×</button>' . $mensaje . '</div>';
    }
    return $mensaje;
}

################ propagar la ulr actual quitando las que no necesitas  -  function #########################################

function propagar_sin($_pagi_no_propagar) {
    //$_pagi_no_propagar=array('task');
    $_pagi_enlace = $_SERVER['PHP_SELF'];
    $_pagi_query_string = "?";

    foreach ($_pagi_no_propagar as $variab) {
        //echo $variab."<br />";
        if (isset($GLOBALS[$variab])) {
            //echo " Si la variable es global al script<br /><br />";
            unset($GLOBALS[$variab]);
        } elseif (isset($_REQUEST[$variab])) {
            //echo " Si no es global (o register globals está en OFF)<br /><br />";
            unset($_REQUEST[$variab]);
            unset($_GET[$variab]);
        }
    }

    $_pagi_propagar = array_keys($_GET);
    //echo "<br />".$_pagi_propagar."<br /><br />";

    foreach ($_pagi_propagar as $var) {
        if (isset($GLOBALS[$var])) {
            // Si la variable es global al script
            $var_string = $GLOBALS[$var];
        } elseif (isset($_REQUEST[$var])) {
            // Si no es global (o register globals está en OFF)
            $var_string = $_REQUEST[$var];
        }
        $_pagi_query_string .= $var . "=" . $var_string . "&";
    }
    // Añadimos el query string a la url.
    $_pagi_enlace .= $_pagi_query_string;
    return $_pagi_enlace;
}

##############################################  Retorna el mes #######################################################

function retorna_mes($mes) {
    $nommes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $fec_tem = $nommes[$mes - 1];
    return $fec_tem;
}

/* * *********************  Invertir el formato de fecha ********************************* */

function inc_invertir_fecha($fecha, $caso, $espacio = ".") {
    $hora = '';
    if (trim(substr($fecha, 10, 10)) != "") {
        $hora = substr($fecha, 10, 10);
        $hora_fecha = " &nbsp;|&nbsp;" . $hora;
    }
    if ($caso == 1) {   //tipo de 01-12-2005 a 2005-04-10
        $fecha_invertida = substr($fecha, 6, 4) . $espacio . substr($fecha, 3, 2) . $espacio . substr($fecha, 0, 2);
    } elseif ($caso == 2) {  //tipo de 2006-12-04 a 10-04--2005
        $fecha_invertida = substr($fecha, 8, 2) . $espacio . substr($fecha, 5, 2) . $espacio . substr($fecha, 0, 4);
    }

    if ($hora != '') {
        $fecha_invertida .= $hora;
    }

    if ($fecha_invertida == "--") {
        $fecha_invertida = "";
    }
    return $fecha_invertida;
}

function crearselect($nombre, $res, $agregados, $buscado, $optioninicial,$tipo) {
    
    if($tipo == 1){
        echo '<select name="' . $nombre . '" id="' . $nombre . '" ' . $agregados . ' class="form-control input-sm" disabled="true">';
    }else{
        echo '<select name="' . $nombre . '" id="' . $nombre . '" ' . $agregados . ' class="form-control input-sm">';
    }
    
    
    if ($optioninicial != ""){
        echo '<option value="'.$optioninicial.'"  selected="selected">' . $optioninicial . '</option>';
    }
    if (count($res) > 0) {
        while ($v = mysql_fetch_array($res)) {
            
         //   if($buscado == $v[0]){
                echo '<option value="' . $v[0] . '" >' . utf8_encode(utf8_decode($v[1])) . '</option>';
         /*   }else{
                echo '<option value="' . $v[0] . '">' . $v[0] . "-" . utf8_encode(utf8_decode($v[1])) . '</option>';
            }*/
        }
    } else {/* echo '<option value="0" selected="selected">Data no disponible</option>'; */
    }
    echo "</select>";
   // return $itemselected;
}

//***************************** Arma Insert SQL *******************************/
function arma_insert($tablename, $campos, $method = "POST") {
    $sql_insert = "insert into $tablename(";
    $query = '';
    $insertdata = '';
    foreach ($campos as $estructura) {
        $campo = $estructura;
        if (is_array($estructura))
            $campo = $estructura[0];
        if (!$query) {
            $query = "`$campo`";
        } else {
            $query .= ", `$campo`";
        }

        $valor_campo = $campo;
        $DATA_campo = ($method == 'POST') ? fn_filtro($_POST[$valor_campo]) : fn_filtro($_GET[$valor_campo]);
        if (is_array($estructura))
            $DATA_campo = fn_filtro($estructura[1]);
        if (!$insertdata) {
            $insertdata = "'" . $DATA_campo . "'";
        } else {
            $insertdata .= ",'" . $DATA_campo . "'";
        }
    }
    $sql_insert .= $query . ") values(" . $insertdata . ");";
    return $sql_insert;
}

//***************************** Arma Update SQL *******************************/
function armaupdate($tablename, $campos, $where, $method = "POST") {
    $sql_update = "update $tablename set ";
    $query = '';
    $insertdata = '';
    foreach ($campos as $estructura) {
        $campo = $estructura;
        if (is_array($estructura))
            $campo = $estructura[0];
        $valor_campo = ($method == 'POST') ? fn_filtro($_POST[$campo]) : fn_filtro($_GET[$campo]);
        if (is_array($estructura))
            $valor_campo = fn_filtro($estructura[1]);
        if ($valor_campo == "NULL") {
            $valdatacampo = $valor_campo;
        } else {
            $valdatacampo = "'" . $valor_campo . "'";
        }
        if (!$query) {
            $query = "`$campo`=" . $valdatacampo;
        } else {
            $query .= ", `$campo`=" . $valdatacampo;
        }
    }
    $sql_update .= $query . " where " . $where;
    return $sql_update;
}

/* * *****************************************                      ************************************** */

function fn_filtro($cadena) {
    /* if(get_magic_quotes_gpc())
      $cadena = htmlspecialchars(stripslashes((string)$cadena));
      else
      $cadena = htmlspecialchars((string)$cadena); */
    //$cadena = htmlspecialchars($cadena);
//	echo "<br />cadena : ".$cadena;
    //$cad = mysql_real_escape_string($cadena);
    if (get_magic_quotes_gpc() != 0) {
        $cadena = stripslashes($cadena);
    }

    $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");

    $cadena = str_replace($search, $replace, $cadena);

    return $cadena;
}

/* * ********************  Fecha Hora *************************** */

function fecha_hora($i, $format = 'Y-m-d') {
    //$ahora = @getdate();
    date_default_timezone_set('America/Lima');
    if ($i == 0) {
        //$str = formatNum2($ahora["hours"]+1,"hour") . ":" . formatNum2($ahora["minutes"],"minute") . ":" . $ahora["seconds"];
        $str = @date("H:i:s");
    } elseif ($i == 1) {
        //$str = $ahora["year"]."-".formatNum2($ahora["mon"],"month"). "-" .formatNum2($ahora["mday"],"day") ;
        $str = @date("Y-m-d");
    } elseif ($i == 2) {
        //$str = $ahora["year"]."-".formatNum2($ahora["mon"],"month"). "-" .formatNum2($ahora["mday"],"day") ;
        $str = @date("Y-m-d");
        $str1 = @date("H:i:s");
        //$str1 = formatNum2($ahora["hours"]+1,"hour") . ":" . formatNum2($ahora["minutes"],"minute") . ":" . $ahora["seconds"];
        $str = $str . " " . $str1;
    } elseif ($i == 3) {
        //$str = $ahora["year"]."-".formatNum2($ahora["mon"],"month"). "-" .formatNum2($ahora["mday"],"day") ;
        $str = @date("d/m/Y");
    } elseif ($i == 4) {
        //$str = $ahora["year"]."-".formatNum2($ahora["mon"],"month"). "-" .formatNum2($ahora["mday"],"day") ;
        $str = @date($format);
    }
    return $str;
}

/* * ***********************  Limitar Cadena     ******************************* */

function limitarcadena($cadena, $i, $f, $ps = "...") {
    if ($f > 0 && $f > $i) {
        if ($f < strlen($cadena))
            $str = $ps;
        else
            $str = "";
        $cad = substr($cadena, $i, $f) . $str;
    }else {
        $cad = $cadena;
    }
    return $cad;
}

/* * ***********************   Url Amigable *************************** */

function urlrewrite($texto) {
    $vocalti = array("á", "é", "í", "ó", "ú", "�?", "É", "�?", "Ó", "Ú", "ñ", "Ñ", "À", "È", "Ì", "Ò", "Ù", "à", "è", "ì", "ò", "ù", "ç", "Ç", "â", "ê", "î", "ô", "û", "Â", "Ê", "Î", "Ô", "Û", "ü", "ö", "Ö", "ï", "ä", "ë", "Ü", "�?", "Ä", "Ë", "'", " ");
    $vocales = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "", "-");
    $cadena = str_replace($vocalti, $vocales, $texto);
    //echo $cadena;
    $cadena = strtolower($cadena);
    $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
    $repl = array('', '-', '');
    $cadena = preg_replace($find, $repl, $cadena);
    //$texto=strtolower($cadena);
    return $cadena;
}

/* * **************************** FUNCION HACE X HORAS, DIAS ******************* */

function hace($fecha_unix) {
    //obtener la hora en formato unix
    $ahora = time();

    //obtener la diferencia de segundos
    $segundos = $ahora - $fecha_unix;

    //dias es la division de n segs entre 86400 segundos que representa un dia;
    $dias = floor($segundos / 86400);

    //mod_hora es el sobrante, en horas, de la division de días;	
    $mod_hora = $segundos % 86400;

    //hora es la division entre el sobrante de horas y 3600 segundos que representa una hora;
    $horas = floor($mod_hora / 3600);

    //mod_minuto es el sobrante, en minutos, de la division de horas;	
    $mod_minuto = $mod_hora % 3600;

    //minuto es la division entre el sobrante y 60 segundos que representa un minuto;
    $minutos = floor($mod_minuto / 60);


    if ($dias > 0) {
        if ($dias > 365) {
            $txt = "más de un año";
        } elseif ($dias > 30) {
            $meses = $dias / 30;
            if ($meses % 30 == 0) {
                if ($meses == 1) {
                    $txt = 'un mes';
                } elseif ($meses > 1) {
                    $txt = $meses . ' meses';
                }
            } else {
                $txt = $dias . ' días '; //.$horas.' horas';// '.$minutos.' minutos';
            }
        } else {
            if ($dias > 1)
                $plural = 's';
            if ($horas > 0) {
                $txt = "casi " . ($dias + 1) . " día" . $plural;
            } else {
                $txt = $dias . " día" . $plural;
            }
        }
    } elseif ($horas > 0) {
        if ($horas > 1)
            $plural = 's';
        $txt = $horas . " hora" . $plural;
    }elseif ($minutos > 0) {
        if ($minutos <= 1) {
            $txt = "un momento";
        } else {
            $txt = $minutos . " minutos";
        }
    } elseif ($segundos < 60) {
        $txt = "pocos segundos";
    }
    return $txt;
}

/*
 * @return int
 * @desc da formato a las fechas para mostrar al usuario o para los procesos del sistema
 */

function fecha_texto($fec, $hora = 0) {
    $fechan = explode(' ', $fec);
    $Hora = $fechan[1];
    $fechan = explode('-', $fechan[0]);
    $dia = $fechan[2];
    $mes = $fechan[1];
    $anno = $fechan[0];
    $nommes = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $fec_tem = $nommes[$mes - 1] . " " . $dia . ", " . $anno;
    if ($hora == 1) {
        $fec_tem = $fec_tem . " " . $Hora;
    }
    return $fec_tem;
}

//error_reporting( error_reporting() & ~E_NOTICE );
//include_once("class.upload.php");

function Check_existe_enBD($Check, $value, $codigo) {
    if ($Check == $value) {
        echo " checked='checked'";
    }
}

function explode_tags($tags, $tipo) {
    $tags = explode(",", $tags);
    if (!empty($tags)) {
        for ($i = 0; $i < count($tags); $i++) {
            if ($tipo == 2) {
                if (!$txt_) {
                    $txt_ .= $tags[$i];
                } else {
                    $txt_ .= ', ' . $tags[$i];
                }
            } elseif ($tipo == 1) {
                if (!$txt_) {
                    $txt_ .= '<a class="' . $style . '" href="' . $server . 'temas/' . $tags[$i] . '">' . $tags[$i] . '</a> ';
                } else {
                    $txt_ .= ', <a class="' . $style . '" href="' . $server . 'temas/' . $tags[$i] . '">' . $tags[$i] . '</a> ';
                }
            } else {
                $finstyle = rand(1, 3);
                $style = "tag" . $finstyle;
                $txt_ .= '<a class="' . $style . '" href="' . $server . 'temas/' . $tags[$i] . '">' . $tags[$i] . '</a>';
            }
        }
    }
    return $txt_;
}

function agregaralog() {
    
}

function server_name() {
    if ($_SERVER['SERVER_NAME'] == "localhost") {
        $servidor = "http://localhost/digital/";
    } else {
        $servidor = "http://eldigital.pe/";
    }
    return $servidor;
}

function url_publicacion_opinion($usuario, $publicacionrw) {
    $server = server_name();
    $url = $server . "opinion/" . $usuario . "/" . $publicacionrw;
    return $url;
}

function url_publicacion($fecha, $categoriarw, $publicacionrw, $foto = '') {
    $server = server_name();
    $fecha_date = @explode(" ", $fecha);
    $fecha = @ereg_replace("-", "/", $fecha_date[0]);
    $url = $server . "publicacion/" . $fecha . "/" . $categoriarw . "/" . $publicacionrw;
    if ($foto != '') {
        $url .= "/" . $foto;
    };
    return $url;
}

function url_comentarista($usuario) {
    $server = server_name();
    $url = $server . "columnista/" . $usuario;
    echo $url;
}

function urlPublicacion($tituloR) {
    $servidor = server_name();
    $str = $servidor . "publicaciones/" . $tituloR . ".html";
    echo $str;
}

function select_sql($tipo) {
    if ($tipo == 'orden') {
        echo '<select name="criterio_orden" id="criterio_orden">
	<option value="desc">Descendente</option>
	<option value="asc">Ascendente</option>
	</select>';
    } elseif ($tipo == 'nregistros') {
        echo '<select name="criterio_mostrar" id="criterio_mostrar">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="5">5</option>
	<option value="10">10</option>
	<option value="20" selected="selected">20</option>
	<option value="40">40</option>
	</select>';
    }
}

function atras_js() {
    echo '<script>history.go(-1)</script>';
}

function nft($val, $num = 2) {
    return @number_format($val, $num);
}

function codigo_AUTO($letrasini, $nomItem) {
    $nom1 = trim(strtoupper($nomItem));
    $nomCorto = substr($nom1, 0, 3);
    $cod = "0" . rand(100, 999);
    $codItem = $letrasini . "-" . $nomCorto . $cod;
    return $codItem;
}

function create_input($tipo, $campo, $value, $class, $table, $agregados) {
    switch ($tipo):
        case "text":
            echo '<input type="text" name="' . $campo . '" id="' . $campo . '" value="' . $value . '" class="' . $class . '" ' . $agregados . '/>';
            break;

        case "checkbox":
            echo '<input type="checkbox" name="' . $campo . '" id="' . $campo . '" value="' . $value . '" class="' . $class . '"  ' . $agregados . ' />';
            break;

        case "textarea":
            echo '<textarea name="' . $campo . '" id="' . $campo . '" class="' . $class . '" ' . $agregados . '>' . $value . '</textarea>';
            break;

        case "hidden":
            echo '<input type="hidden" name="' . $campo . '" id="' . $campo . '" class="' . $class . '" value="' . $value . '" ' . $agregados . '/>';
            break;


        case "password":
            echo '<input type="password" name="' . $campo . '" id="' . $campo . '" class="' . $class . '" value="' . $value . '" ' . $agregados . '/>';
            break;

        case "file":
            echo '<input type="file" name="' . $campo . '" id="' . $campo . '" class="' . $class . '"' . $agregados . '/>';
            break;

        default:

            break;
    endswitch;
}

function verificaexiste_intable($table, $campo, $valor) {
    $exec = new BD();
    $sqlQuery = "SELECT * from " . $table . " WHERE " . $campo . "='" . $valor . "'";
//	echo $sqlQuery;
    $existe = $exec->Execute($sqlQuery);
    $existe = count($existe);
    return $existe;
}

function pagina_actual() {
    return basename($_SERVER['REQUEST_URI']);
}

function reemplazar($texto) {
    //foreach($etiquetas as $k){
    $texto = ereg_replace("'", "&middot;", $texto);
    $texto = ereg_replace('"', "&quot;", $texto);
    $texto = ereg_replace('ñ', "&ntilde;", $texto);
    $texto = ereg_replace('Ñ', "&Ntilde;", $texto);
    $texto = ereg_replace("�?", "&Aacute;", $texto);
    $texto = ereg_replace("á", "&aacute;", $texto);
    $texto = ereg_replace("À", "&Agrave;", $texto);
    $texto = ereg_replace("È", "&Egrave;", $texto);
    $texto = ereg_replace("é", "&eacute;", $texto);
    $texto = ereg_replace("Ì", "&Igrave;", $texto);
    $texto = ereg_replace("&iacute;", "&iacute;", $texto);
    $texto = ereg_replace("Ò", "&Ograve;", $texto);
    $texto = ereg_replace("&oacute;", "&oacute;", $texto);
    $texto = ereg_replace("Ù", "&Ugrave;", $texto);
    $texto = ereg_replace("ú", "&uacute;", $texto);

    //	echo htmlspecialchars($texto);
    //}
    return $texto;
}

function inc_borrar_archivo($ruta) {
    if ($ruta != "") {
        if (file_exists($ruta)) {
            @unlink($ruta);
        }
    }
}

function script($script) {
    echo '<script type="text/javascript" language="javascript">';
    echo $script;
    echo '</script>';
}

function carga_imagen_usuario($dirimage, $file, $file_ant) {
    if ($_FILES[$file]["size"] > 0) {
        $foo = new Upload($_FILES[$file]);
        if ($foo->uploaded) {
            $prefijo = substr(md5(uniqid(rand())), 0, 10) . "_";

            // Tamaño Imagenes Destacados Home
            $foo->image_ratio_y = false;
            $foo->file_name_body_pre = $prefijo;
            $foo->image_resize = true;
            $foo->image_ratio_crop = true;
            $foo->image_y = 50;
            $foo->image_x = 50;
            $foo->Process($dirimage . 'comentaristas/');
            if ($foo->processed)
                $imagen_upload = $foo->file_dst_name;

            $imagen_upload = $foo->file_dst_name;
        }
    }else {
        $imagen_upload = $file_ant;
    }
    return $imagen_upload;
}

function carga_imagen($dirimage, $file, $file_ant, $original = 1, $destacados = 0, $columna1 = 0, $columna2 = 0, $thumb_32 = 0) {
    if ($_FILES[$file]["size"] > 0) {
        $foo = new Upload($_FILES[$file]);
        if ($foo->uploaded) {
            $prefijo = substr(md5(uniqid(rand())), 0, 10) . "_";

            if ($original == 1) {
                // Imagen sin cambios
                $foo->file_name_body_pre = $prefijo;
                $foo->image_ratio_y = true;
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_y = 313;
                $foo->image_x = 700;
                $foo->image_convert = 'jpg';
                $foo->jpeg_quality = 85;
                $foo->Process($dirimage);
                if ($foo->processed)
                    $imagen_upload = $foo->file_dst_name;
                //$foo-> Clean();
            }

            if ($destacados == 1) {
                // Tamaño Imagenes Destacados Home
                $foo->image_ratio_y = false;
                $foo->file_name_body_pre = $prefijo;
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_y = 230;
                $foo->image_x = 313;
                $foo->image_convert = 'jpg';
                $foo->jpeg_quality = 80;
                $foo->Process($dirimage . 'destacados/');
                if ($foo->processed)
                    $imagen_upload = $foo->file_dst_name;


                /* // Tamaño Imagenes Destacados Interna
                  $foo->image_ratio_y         = false;
                  $foo->file_name_body_pre   = $prefijo;
                  $foo->image_resize          = true;
                  $foo->image_ratio_crop      = true;
                  $foo->image_y               = 280; //343
                  $foo->image_x               = 362;
                  $foo->Process($dirimage.'destacado-interna/');
                  if ($foo->processed)  $imagen_upload=$foo->file_dst_name; */
            }

            /* if($columna1==1){
              // Tamaño Imagenes Columna 1 Home
              $foo->file_name_body_pre   = $prefijo;
              $foo->image_x               = 340;
              $foo->image_resize          = true;
              $foo->image_ratio_y         = true;
              $foo->Process($dirimage.'col1/');
              if ($foo->processed)  $imagen_upload=$foo->file_dst_name;
              }

              if($columna2==1){
              // Tamaño Imagenes Columna 2 Home
              $foo->file_name_body_pre   = $prefijo;
              $foo->image_x               = 340;
              $foo->image_resize          = true;
              $foo->image_ratio_y         = true;
              $foo->Process($dirimage.'col2/');
              if ($foo->processed)  $imagen_upload=$foo->file_dst_name;
              }
             */
            if ($thumb_32 == 1) {
                // Tamaño Imagenes Destacados Home
                $foo->image_ratio_y = false;
                $foo->file_name_body_pre = $prefijo;
                $foo->image_resize = true;
                $foo->image_ratio_crop = true;
                $foo->image_y = 35;
                $foo->image_x = 35;
                $foo->image_convert = 'jpg';
                $foo->jpeg_quality = 85;
                $foo->Process($dirimage . '35x35/');
                if ($foo->processed)
                    $imagen_upload = $foo->file_dst_name;
            }

            $imagen_upload = $foo->file_dst_name;
        }
    }else {
        $imagen_upload = $file_ant;
    }
    return $imagen_upload;
}

function tablesorter($table_primary, $sql, $data_table, $opciones, $idtable) {
    $bd = new BD();
    $data = $bd->Execute($sql);
    echo '<table cellspacing="1" class="tablesorter" id="' . $idtable . '">';
    echo '<thead><tr>';
    //echo "<th class=\"{sorter: false}\" width=\"2%\">"; 
    //echo '<input name="selectall" onclick=\'toggleSelect_ListView(this.checked,"selected_id")\' type="checkbox">';
    //echo "</th>";
    foreach ($data_table as $headers):
        echo "<th";
        echo ($headers[1] == 'true') ? '' : ' class="{sorter: false}"';
        echo ">" . $headers[2] . '</th>';
    endforeach;
    echo "<th class=\"{sorter: false}\">Opciones</th>";
    echo '</tr></thead>';
    if (count($data) > 0) {
        echo '<tbody>';
    }
    foreach ($data as $position) {
        echo '<tr id="tr' . $position[0] . '">';
        //echo '<td><input type="checkbox" NAME="selected_id" id="'.$position[0].'" value="'.$position[0].'" onClick="check_object(this);"></td>';
        foreach ($data_table as $headers):
            echo '<td>' . $position[$headers[0]] . '</td>';
        endforeach;
        echo '<td width="10%">';
        foreach ($opciones as $opt):
            $indexs_tables = $bd->Execute('SHOW INDEX FROM ' . $table_primary);
            $url_complemento = '';
            foreach ($indexs_tables as $indices) {
                $url_complemento .= $indices['Column_name'] . "=" . $position[$indices['Column_name']] . "&";
            }
            ($opt[2] == '') ? $url_t = $_SERVER['REQUEST_URI'] . '&task=edit-registro&' : $url_t = $opt[2];
            $url_t .= $url_complemento;

            if ($opt[0] == 'drop') {
                //echo '<a class="delete" href="?delete=2"';//href="javascript:;" onclick="javascript:dropRow('."'".$url_t."','".$opt[3]."','".$position[0]."')";		
                echo '<a href="javascript: fn_eliminar(' . $position[0] . ');'; //href="javascript:;" onclick="javascript:dropRow('."'".$url_t."','".$opt[3]."','".$position[0]."')";		
            } else {

                echo ' <a href="' . $url_t;
            }
            echo '">' . $opt[1] . '</a> &nbsp; | &nbsp;';

        endforeach;
        echo '</td>';
        echo '</tr>';
    }
    if (count($data) > 0) {
        echo '</tbody>';
    }
    echo '</table>';

    if (count($data) > 0) {
        echo '<div id="pager" class="paginacion">
      <form>
            <img src="images/start_disabled.gif" class="first"/>
            <img src="images/previous_disabled.gif" class="prev"/>
            <input type="text" class="pagedisplay" size="6"/>
            <img src="images/next_disabled.gif" class="next"/>
            <img src="images/end.gif" class="last"/>
            <select class="pagesize">
                <option selected="selected" value="10">10</option>    
                <option value="20">20</option>
                <option value="40">40</option>
                <option  value="80">80</option>
          </select>
      </form>
    </div>';
    }
}

function armapaginacion($sql, $div, $modo, $numregistro, $mantenervariable, $cabeceras, $opciones, $table_primary, $porPagina) {
    /* 	@header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada
      @header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos
      @header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE
      @header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE */

    include_once "class/class.bd.php";
    include_once "class/functions.php";
    include_once "class/PHPPaging.lib.php";

    $paging = new PHPPaging;
    $paging->agregarConsulta($sql);
    $paging->div($div);
    $paging->modo($modo);
    if ($numregistro)
        $paging->porPagina(fn_filtro((int) $numregistro));
    $paging->verPost(true);
    $paging->mantenerVar($mantenervariable);
    $paging->porPagina(fn_filtro((int) $porPagina));
    $paging->ejecutar();
    $paging->pagina_proceso = basename($_SERVER['PHP_SELF']);

    echo '<div class="pagination">' . $paging->fetchNavegacion() . '</div>';
    echo '<table cellspacing="1" class="lista" id="grilla" width="100%">';
    echo '<thead><tr>';
    foreach ($cabeceras as $headers):
        //echo $headers[3];
        echo '<th>' . $headers[3] . '</th>';
    endforeach;
    echo "<th width=\"1%\">Opciones</th>";
    echo '</tr></thead>';
    echo '<tbody>';
    while ($rs_per = $paging->fetchResultado()) {
        echo '<tr id="tr_' . $rs_per[0] . '" ';
        echo $i++ % 2 == 0 ? ' class="even"' : ' class="odd"';
        echo '>';
        foreach ($cabeceras as $head):
            echo '<td>' . $rs_per[$head[2]] . '</td>';
        endforeach;

        echo '<td>';

        /*         * */
        $bd = new BD;
        $indexs_tables = $bd->Execute('SHOW INDEX FROM ' . $table_primary);
        $url_complemento = '';
        foreach ($indexs_tables as $indices) {
            $url_complemento .= $indices['Column_name'] . "=" . $rs_per[$indices['Column_name']] . "&";
        }
        /*         * */

        foreach ($opciones as $opt):
            //echo $opt[2];
            switch ($opt[0]):
                case ($opt[0] == 'drop'):
                    if ($opt[2] == 0) {
                        echo '<a href=\'javascript: fn_eliminar("' . $rs_per[0] . '");\'"><img src="images/delete.png" /></a>';
                    } else {
                        $url_t = $_SESSION["base_url"] . '&task=drop&' . $url_complemento;
                        echo '<a href="' . $url_t . '" title="' . $opt[1] . '"><img src="images/delete.png" /></a>';
                    }
                    break;

                case ($opt[0] == 'edit'):
                    if ($opt[2] == 0) {
                        echo '<a href=\'javascript: fn_mostrar_frm_modificar("' . $rs_per[0] . '");\'"><img src="images/page_edit.png" /></a>';
                    } else {
                        $url_t = $_SESSION["base_url"] . '&task=edit&' . $url_complemento;
                        echo '<a href="' . $url_t . '"  title="' . $opt[1] . '"><img src="images/page_edit.png" /></a>';
                    }
                    break;

                default:
                    $url_t = $_SESSION["base_url"] . '&task=' . $opt[0] . '&' . $url_complemento;
                    //echo "<a href=\"\"><img src=\"images/page_edit.png\" /></a>";
                    echo '<a href="' . $url_t . '" title="' . $opt[1] . '">Precios de Venta</a>';
                    break;

            endswitch;

        endforeach;
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<div class="pagination">' . $paging->fetchNavegacion() . '</div>';
}

function propagarURL_varnopropag($_pagi_no_propagar) {
    //$_pagi_no_propagar=array('task');
    $_pagi_enlace = $_SERVER['PHP_SELF'];
    $_pagi_query_string = "?";

    foreach ($_pagi_no_propagar as $variab) {
        //echo $variab."<br />";
        if (isset($GLOBALS[$variab])) {
            //echo " Si la variable es global al script<br /><br />";
            unset($GLOBALS[$variab]);
        } elseif (isset($_REQUEST[$variab])) {
            //echo " Si no es global (o register globals está en OFF)<br /><br />";
            unset($_REQUEST[$variab]);
            unset($_GET[$variab]);
        }
    }

    $_pagi_propagar = array_keys($_GET);
    //echo "<br />".$_pagi_propagar."<br /><br />";

    foreach ($_pagi_propagar as $var) {
        if (isset($GLOBALS[$var])) {
            // Si la variable es global al script
            $var_string = $GLOBALS[$var];
        } elseif (isset($_REQUEST[$var])) {
            // Si no es global (o register globals está en OFF)
            $var_string = $_REQUEST[$var];
        }
        $_pagi_query_string .= $var . "=" . $var_string . "&";
    }
    // Añadimos el query string a la url.
    $_pagi_enlace .= $_pagi_query_string;
    return $_pagi_enlace;
}

function viewimagen($imagen, $ruta) {
    if (strlen($imagen) > 0) {
        echo "<div>";
        echo '<img src="../thumbnail/thumb.php?src=';
        echo $ruta . $imagen . '&x=90&y=70&f=0" class="bordeimgact" />';
        echo "</div>";
    }
}

function verestado($idestado) {
    $bd = BDconnect();
    $sqlQuery = "select * from estado where idestado='" . $idestado . "'";
    $res = $bd->executesql($sqlQuery, 0);
    $valor = $res["nombre"];
    return $valor;
}

function _orden_noticia($orden, $tabla = "publicacion", $where = '') {
    if ($orden > 0) {
        $r_orden = $orden;
    } else {
        $bd = new BD();
        $query = "select orden from " . $tabla;
        if ($where != '') {
            $query .= " where " . $where;
        }
        $query .= " order by orden desc";
        //echo $query;
        $afectada = $bd->Execute($query);
        $r_orden = ($afectada[0]['orden'] + 1);
    }
    return $r_orden;
}

function select_cantidad() {
    echo '<select name="cantidad[]" id="criterio_mostrar">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>	
	</select>';
}

function upload_files($ruta, $archivo, $archivo_encaso_vacio, $reemplazo = 1) {
    if (
    //($_FILES[$archivo]["type"] == "application/pdf") && 
            ($_FILES[$archivo]["size"] < 200000000) &&
            ($_FILES[$archivo]["size"] > 0)
    ) {

        $NOM_file = $_FILES[$archivo]["name"];
        $destino = $ruta . $NOM_file;

        if (file_exists($destino)) {
            if ($reemplazo == 0) {
                $prefijo = substr(md5(uniqid(rand())), 0, 6);
                $NOM_file = $prefijo . "_" . $NOM_file;
                $destino = $ruta . $NOM_file;
                //$file_uploader=$NOM_file;
            }
        }

        /* if(copy($_FILES[$archivo]['tmp_name'],$destino)) {
          $file_uploader=$_FILES[$archivo]["name"];

          }else */
        if (move_uploaded_file($_FILES[$archivo]["tmp_name"], $destino)) {
            $file_uploader = $NOM_file;
        } else {
            $file_uploader = $archivo_encaso_vacio;
        }

        return $file_uploader;
    }
}

function inc_convierte_minuscula($p_cadena) {
    $cadena = trim($p_cadena);
    $cadena = strtolower($cadena);
    return $cadena;
}

function inc_convierte_mayuscula($p_cadena) {
    $cadena = trim($p_cadena);
    $cadena = strtoupper($cadena);
    return $cadena;
}

function inc_renombra_imagen($p_mensaje) {
    $p_mensaje = str_replace(" ", "", $p_mensaje);
    $p_mensaje = str_replace("/", "_", $p_mensaje);
    return $p_mensaje;
}

function inc_saca_extension($archivo) {
    $punto = strrpos($archivo, ".") + 1;
    $extension = substr($archivo, $punto);
    return $extension;
}

function clean_injection($char) {
    $hack_array = array("'", '"', ";", "UNION", "union", "DROP", "drop", "table", "TABLE", "SET", "set", "UPDATE", "update", "SELECT", "select", "-", "--", "MEMB_INFO", "memb_info", "memb__pwd", "memb___id", "(", ")", ">", "<");
    $hack_replace = "";
    $char_w_replaced = $char;
    $char_replaced = str_replace($hack_array, $hack_replace, $char_w_replaced);
    $char_clean = htmlentities(trim($char_replaced));
    return $char_clean;
}

function sendmail($msgBody, $subject, $usersendemail, $usersendname, $concopia = 0) {
    $info = array("FromName" => "informes@terratechperu.com",
        "From" => "INFORMES WEB TERRATECHPERU"
    );
    $para = $usersendemail; // atención a la coma
    $titulo = $subject;
    $mensaje = $msgBody;

// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
    $cabeceras = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// Cabeceras adicionales
    $cabeceras .= 'To: ' . $usersendname . " <" . $usersendemail . ">" . "\r\n";
    $cabeceras .= 'From: ' . $info["FromName"] . " <" . $info["From"] . ">" . "\r\n";
    $cabeceras .= 'Cc:' . $info["From"] . "\r\n";
//$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";

    $exito = @mail($para, $titulo, $mensaje, $cabeceras);
//$exito=@mail($email, $subject, $mensaje, $headers)

    return $exito;
}

function sacar_videos($contenido) {
    //preg_match_all('/^[]$/s', $contenido, $m);
    $images = $m[1];
    return $images;
}

function URL_imagen_youtube($content) {
    $array_Video_Texto = explode("|", $content);
    $texto_video = $array_Video_Texto[1];
    if (preg_match('%youtube\\.com/(.+)%', $array_Video_Texto[0], $match)) {
        $match = $match[1];
        $replace = array("watch?v=", "v/", "vi/");
        $ID_youtube = str_replace($replace, "", $match);
        $imagenOrigen = "http://i3.ytimg.com/vi/" . $ID_youtube . "/default.jpg";
    }
    return $imagenOrigen;
}

function carga_imagen_youtube($ruta, $url) {
    $codificacion = explode("=", $url);
    $codificacion = explode("&", $codificacion[1]);
    $imagenOrigen = "http://i3.ytimg.com/vi/" . $codificacion[0] . "/default.jpg";
    $imagen = "youtube-" . $codificacion[0] . ".jpg";
    copy($imagenOrigen, $ruta . $imagen);
    return $imagen;
}

function mostrar_videos_publicacion($content, $n = "", $width, $height, $details = 1) {
    $array_Videos = explode(";", $content);

    for ($i = 0; $i < count($array_Videos); $i++) {
        $array_Video_Texto = explode("|", $array_Videos[$i]);
        $texto_video = $array_Video_Texto[1];
        if (preg_match('%youtube\\.com/(.+)%', $array_Video_Texto[0], $match)) {
            $match = $match[1];
            $replace = array("watch?v=", "v/", "vi/");
            $ID_youtube = str_replace($replace, "", $match);

            echo "<object width=" . $width . "' height='" . $height . "'><param name=\"movie\" value=\"http://www.youtube.com/v/" . $ID_youtube . "&hl=en_US&fs=1&rel=0&hd=1&color1=0x3a3a3a&color2=0x999999&autoplay=false&wmode=transparent\" wmode=\"transparent\"></param><param name=\"allowFullScreen\"  wmode=\"transparent\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\" wmode=\"transparent\"></param><embed src=\"http://www.youtube.com/v/" . $ID_youtube . "&hl=en_US&fs=1&color1=0x3a3a3a&color2=0x999999&rel=0&hd=1&autoplay=false&wmode=transparent\" wmode=\"transparent\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width='" . $width . "' height='" . $height . "'></embed></object>";
            if ($details == 0) {
                
            } else {
                echo "<div class='history'>" . $texto_video . "</div>";
            }
        } else {
            $videoobject = $array_Video_Texto[0];
            $pattern = "/height=\"[0-9]*\"/";
            $string = preg_replace($pattern, "height='" . $height . "'", $videoobject);
            $pattern = "/width=\"[0-9]*\"/";
            $string = preg_replace($pattern, "width='" . $width . "'", $string);
            echo "<p>" . $string;
            if ($details == 0) {
                
            } else {
                echo "<div class='history'>" . $texto_video . "</div>";
            }
            echo "</p>";
        }

        if ($n == 1) {
            break;
        }
    }
}

function video_youtube($locationvideo, $width, $height) {
    /* if(eregi('src=&quot;http://', $locationvideo)){
      echo htmlspecialchars_decode($locationvideo);
      }else{ */
    /* echo '<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="200" height="153">
      <param name="movie" value="../files/player-viral.swf" />
      <param name="allowfullscreen" value="true" />
      <param name="allowscriptaccess" value="always" />
      <param name="flashvars" value="file='.ver_video_url($locationvideo,$type).'&image='.ver_imagen_video($imagen,$type).'" />
      <embed
      type="application/x-shockwave-flash"
      id="player2"
      name="player"
      src="../files/player-viral.swf"
      width="574"
      height="307"
      allowscriptaccess="always"
      allowfullscreen="true"
      flashvars="file='.ver_video_url($locationvideo,$type).'&image='.ver_imagen_video($imagen,$type).'"
      />
      </object>'; */
    $codificacion = explode("=", $locationvideo);
    echo "<object width=" . $width . "' height='" . $height . "'><param name=\"movie\" value=\"http://www.youtube.com/v/" . z . "&hl=en_US&fs=1&rel=0&hd=1&color1=0x3a3a3a&color2=0x999999&autoplay=1\"></param><param name=\"allowFullScreen\" value=\"true\"></param><param name=\"allowscriptaccess\" value=\"always\"></param><embed src=\"http://www.youtube.com/v/" . $codificacion[1] . "&hl=en_US&fs=1&color1=0x000000&color2=0x999999&rel=0&hd=1&autoplay=1\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width='" . $width . "' height='" . $height . "'></embed></object>";
    //}
}

function return_exp_like($complemento_campo, $tags) {
    if (strlen(trim($tags)) > 0) {
        $texto = @ereg_replace(", ", "|", $tags);
        $texto .= " ";
        $sql_extras .= $complemento_campo . " REGEXP '" . $texto . "' ";
    }
    return $sql_extras;
}

function validaimagen($imagen) {
    return $imagen;
}

function fechaATexto($fecha, $formato = 'c') {

    // Validamos que la cadena satisfaga el formato deseado y almacenamos las partes
    if (ereg("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $partes)) {
        // $partes[0] contiene la cadena original
        // $partes[1] contiene el año
        // $partes[2] contiene el número de mes
        // $partes[3] contiene el número del día
        $txt_mes = mes($partes[2]);
        $mes = ' de ' . $txt_mes . ' de ';
        if ($formato == 'u') {
            $mes = strtoupper($mes);
        } elseif ($formato == 'l') {
            $mes = strtolower($mes);
        }
        return $partes[3] . $mes . $partes[1];
    } else {
        // Si hubo problemas en la validación, devolvemos false
        return false;
    }
}

/**
 * timestampATexto()
 *
 * Devuelve la cadena de texto asociada a la fecha ingresada
 *
 * @param   string timestamp (cadena con formato XXXX-XX-XX XX:XX:XX)
 * @param   string formato (puede tomar los valores 'l', 'u', 'c')
 * @return  string  fecha_en_formato_texto
 */
function timestampATexto($timestamp, $formato = 'c', $tipo = 0) {

    // Buscamos el espacio dentro de la cadena o salimos
    if (strpos($timestamp, " ") === false) {
        return false;
    }

    // Dividimos la cadena en el espacio separador
    $timestamp = explode(" ", $timestamp);

    // Como la primera parte es una fecha, simplemente llamamos a fechaATexto()
    if (fechaATexto($timestamp[0])) {
        $conjuncion = ' a las ';
        if ($formato == 'u') {
            $conjuncion = strtoupper($conjuncion);
        }
        return fechaATexto($timestamp[0], $formato) . $conjuncion . " " . $timestamp[1];
    }
}

function mes($num) {
    /**
     * Creamos un array con los meses disponibles.
     * Agregamos un valor cualquiera al comienzo del array para que los números coincidan
     * con el valor tradicional del mes. El valor "Error" resultará útil
     * */
    $meses = array('Error', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

    /**
     * Si el número ingresado está entre 1 y 12 asignar la parte entera.
     * De lo contrario asignar "0"
     * */
    $num_limpio = $num >= 1 && $num <= 12 ? intval($num) : 0;
    return $meses[$num_limpio];
}

?>