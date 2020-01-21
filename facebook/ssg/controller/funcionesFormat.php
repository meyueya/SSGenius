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
                 echo '<td><img width="50" src="'.$picture.'"><br><span class="text-small">'.$message.'</span></td>';
     }
    }
}

function celdaConCheck($identificador,$cont,$arregloCompleto){
    return 
    '<td>
       <input class="checkForm2" type="checkbox" name="'.$identificador.'" value='."'".json_encode($arregloCompleto,true)."'".'>
       <a href="#opcion'.$cont.'" class="scroll" >P'
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
/* function pintarCelda($valoresTop,$valoresDown,$rellenarCelda,$invertir_colores=null){
    if(pintarCeldasTop($valoresTop , $rellenarCelda)==true && pintarCeldasDown($valoresDown , $rellenarCelda)==true){
        return "table-success";
    }
    if(pintarCeldasTop($valoresTop , $rellenarCelda)==true && pintarCeldasDown($valoresDown , $rellenarCelda)==false){
        return "table-success";
    }
    if(pintarCeldasTop($valoresTop , $rellenarCelda)==false && pintarCeldasDown($valoresDown , $rellenarCelda)==true){
        return "table-danger";
    }
} */

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

?>