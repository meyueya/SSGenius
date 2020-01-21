<?php 
function generarCadenaVALUES($arreglo)
{	
	$cadena=null;
	foreach ($arreglo as $key => $campo) {
		if ($key<count($arreglo)-1) {
				$cadena .= ":".$campo.", ";
			}else{
				$cadena .= ":".$campo;	
			}
	}
	return $cadena;
}

function generarCadenaCampos($arreglo)
{	
	$cadena=null;
	foreach ($arreglo as $key => $campos) {
		if ($key<count($arreglo)-1) {
				$cadena .= $campos.", ";
			}else{
				$cadena .=$campos;	
			}
	}
	return $cadena;
}

function generarCadenaWHERE($arreglo)
{	

	//email=:email AND password=:password
	$cadena=null;
	foreach ($arreglo as $key => $campo) {
		if (count($arreglo)==1) {
			$cadena.=$campo."=:".$campo;
		}else{
		if ($key<count($arreglo)-1) {
				$cadena.=$campo."=:".$campo." AND ";
			}else{
				$cadena.=$campo."=:".$campo;
			}
		}
	}
	return $cadena;
}

function generarCadenaSET($arreglo)
{	

	//email=:email AND password=:password
	$cadena=null;
	foreach ($arreglo as $key => $campo) {
		if (count($arreglo)==1) {
			$cadena.=$campo."=:".$campo;
		}else{
		if ($key<count($arreglo)-1) {
				$cadena.=$campo."=:".$campo.", ";
			}else{
				$cadena.=$campo."=:".$campo;
			}
		}
	}
	return $cadena;
}

 ?>