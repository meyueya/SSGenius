<?php
//error_reporting(0);


function diaSpanish($numDia){
    /*0 (para domingo) hasta 6 (para sábado) */
    switch ($numDia) {
        case '0':
            $numDia='Domingo';
            break;
        case '1':
            $numDia='Lunes';
            break;
        case '2':
            $numDia='Martes';
            break;
        case '3':
            $numDia='Miércoles';
            break;
        case '4':
            $numDia='Jueves';
            break;
        case '5':
            $numDia='Viernes';
            break;
        case '6':
            $numDia='Sábado';
            break;
    }
    return $numDia;
}

function mesSpanish($numMes){
    switch ($numMes) {
        case '01':
            $mes='Enero';
            break;
        case '02':
            $mes='Febrero';
            break;
        case '03':
            $mes='Marzo';
            break;
        case '04':
            $mes='Abril';
            break;
        case '05':
            $mes='Mayo';
            break;
        case '06':
            $mes='Junio';
            break;
        case '07':
            $mes='Julio';
            break;
        case '08':
            $mes='Agosto';
            break;
        case '09':
            $mes='Septiembre';
            break;
        case '10':
            $mes='Octubre';
            break;
        case '11':
            $mes='Noviembre';
            break;
        case '12':
            $mes='Diciembre';
            break;
    }
    return $mes;
}

function tipoPostSpanish($type){

    switch ($type) {
        case 'event':
            $type='Evento';
            break;
        case 'link':
            $type='Link';
            break;
        case 'photo':
            $type='Foto';
            break;
        case 'status':
            $type='Estado';
            break;
        case 'video':
            $type='Video';
            break;
    }
    return $type;
}

function formatZonaHoraria($fechaNum){
    $date = new DateTime($fechaNum);
    $fechaNum=$date->getTimestamp();
    $fechaNum= $fechaNum+0*(3600);
    return $fechaNum;
}

function formarColumnas($arreglo,$campoArreglo,$cantAMostrar,$valoresTop=NULL,$valoresDown=NULL,$invertir_colores=null){
    $cont=0;
    foreach($arreglo as $array){
     $cont++;
     if($cont<$cantAMostrar){
         if($campoArreglo == 'id_celdaCheck'){
             echo celdaConCheck($array["id"],$cont,$array);
            }else{
                if($campoArreglo == 'id'){
                    echo '<td>'. substr($array["$campoArreglo"],25).'</td>';
                }else{
                    if (isset($array["$campoArreglo"])){$rellenarCelda=$array["$campoArreglo"];}else{$rellenarCelda=null;}
                 echo '<td class="'.pintarCelda($valoresTop,$valoresDown,$rellenarCelda,$invertir_colores).'" >'.$rellenarCelda.'</td>';
                }
         }
     }

    }
}

function formarPublicaciones($arreglo,$campoArreglo,$cantAMostrar){
    $cont=0;
    foreach($arreglo as $array){
     $cont++;
     if($cont<$cantAMostrar){
                    if (isset($array["picture"])){
                        $picture=$array["picture"];
                    }else{
                        $picture=null;
                    }
                    if (isset($array["message"])){
                        $message=$array["message"];
                    }else{
                        $message="";
                    }
                    $max_length = 32;
                if (strlen($message) > $max_length)
                {
                    $offset = ($max_length - 3) - strlen($message);
                    $message = substr($message, 0, strrpos($message, ' ', $offset)) . '...';
                }
                 echo '<td><img width="50" height="30" src="'.$picture.'"><br><span class="text-small">'.$message.'</span></td>';
     }
    }
}

function celdaConCheck($identificador,$cont,$arregloCompleto){
    $arregloCompleto['message'] = htmlentities(htmlentities($arregloCompleto['message'], ENT_QUOTES), ENT_QUOTES);//htmlentities se invoca dos veces para poder conservar el texto de envio al pdf
    return 
    '<td>
       <input class="checkForm2" type="checkbox" name="'.$identificador.'" value='."'".json_encode($arregloCompleto,true)."'".'>
       <a href="#" class="scroll" >P'
         .$cont.
       '</a>
    </td>';
}

function formarColumnasFiltrado($arreglo,$campoArreglo){
    foreach($arreglo as $array){
        if($campoArreglo == 'id'){
            echo '<td>'. substr($array["$campoArreglo"],25).'</td>';
        }else {
            if (isset($array["$campoArreglo"])){$rellenarCelda=$array["$campoArreglo"];}else{$rellenarCelda=null;}
            echo '<td>'. $rellenarCelda.'</td>';
        }
    }
}

function pintarCeldasTop($valoresTop , $valorTabla){
     if($valoresTop!=NULL){
        foreach ($valoresTop as $values) {
            if($values!=0 && $values == $valorTabla){
                return true;
            }   
        }
    } 
}

function pintarCeldasDown($valoresTop , $valorTabla){
     if($valoresTop!=NULL){
        foreach ($valoresTop as $values) {
            if($values!=0 && $values == $valorTabla){
                return true;
            }   
        }
    } 
}
function pintarCelda($valoresTop,$valoresDown,$rellenarCelda,$invertir_colores=null){
    $colorCelda=null;
    if(pintarCeldasTop($valoresTop , $rellenarCelda)==true && pintarCeldasDown($valoresDown , $rellenarCelda)==true){
        if ($invertir_colores==null) {
            $colorCelda= "table-success";
        } else {
            $colorCelda= "table-danger";
        }
    }
    if(pintarCeldasTop($valoresTop , $rellenarCelda)==true && pintarCeldasDown($valoresDown , $rellenarCelda)==false){
        if ($invertir_colores==null) {
            $colorCelda= "table-success";
        } else {
            $colorCelda= "table-danger";
        }
    }
    if(pintarCeldasTop($valoresTop , $rellenarCelda)==false && pintarCeldasDown($valoresDown , $rellenarCelda)==true){
        if ($invertir_colores==null) {
            $colorCelda= "table-danger";
        } else {
            $colorCelda= "table-success";
        }

    }
    return $colorCelda;
}

function valoresTop($arregloCompleto,$campoArray){
    $arrayNum=array();
    foreach ($arregloCompleto as $key => $value) {
        array_push($arrayNum,$arregloCompleto[$key][$campoArray]);
    }
    rsort($arrayNum);
    $divisionArray=array_chunk($arrayNum, 6);
    $arrayMayores=$divisionArray[0];
    return $arrayMayores;
}

function valoresDown($arregloCompleto,$campoArray){
    $arrayNum=array();
    foreach ($arregloCompleto as $key => $value) {
        if($arregloCompleto[$key][$campoArray]!=0){
            array_push($arrayNum,$arregloCompleto[$key][$campoArray]);
        }
    }
    $arrayNum=array_unique($arrayNum);
    sort($arrayNum);
    $divisionArray=array_chunk($arrayNum, 6);
    if(count($divisionArray)!=0){
        $arrayMenores=$divisionArray[0];
        return $arrayMenores;
    }
}

function formatPeriod($letra){ 
    switch ($letra) {
        case 'a':
            $valor='Día';
            break;
        case 'b':
            $valor='Semana';
            break;
        case 'c':
            $valor='Mes';
            break;
                    
        default:
            $valor=$letra;
            break;
    }
    return $valor;
}

function getAverage($infoSentiment){
    $valorSentimentTotal=0;$cantCoincidencias=0;
    foreach ($infoSentiment as $infoSentimentComment) {
        $valorSentimentTotal+=$infoSentimentComment['valor'];
        $cantCoincidencias+=count(json_decode($infoSentimentComment['coincidencias']));
    }
    $average = ($cantCoincidencias)?$valorSentimentTotal/$cantCoincidencias:0;
    return $average;
  }
?>