<?php
function generarCadenaValores($arreglo)
{	
    $cadena=null;
    $cont=0;
	foreach ($arreglo as $campo) {
        $cont++;
        if(isset($campo[1])){
            if ($cont<count($arreglo)) {
                    $cadena .=$campo[1]."-";
                }else{
                    $cadena .=$campo[1];	
                }
        }
	}
	return $cadena;
}

function formatValoresCatalogos($array){
$a=array_keys($array);
$porciones=array();
foreach($a as $a){
    array_push($porciones, explode("---", $a));
}
$cadena=generarCadenaValores($porciones);
return $cadena; 
}

?>