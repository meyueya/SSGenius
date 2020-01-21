<?php 
session_start();
require_once('conexion.php');
require_once('modelFunctions.php');

    class OperacionesTabla
    {   
        private $registro;
    
        function crearRegistro($tabla,$arrayCampos,$infoAInsertar)
        {
        	/*esta función recibirá un string con el nombre de la tabla donde se quiere insertar el registro, un 
        	arreglo con los campos a insertar (arreglo simple) y otro arreglo con la información que será insertada, 
        	este ùltimo debe ser un arreglo asociativo y sus claves deben coincidir con los campos a insertar*/
        	$cadenaCampos=generarCadenaCampos($arrayCampos);
        	$cadenaVALUES=generarCadenaVALUES($arrayCampos);
        	$conectar= new Conexion();
        	$conectar= $conectar->getConexion();
        	$statement= $conectar->prepare("INSERT INTO $tabla ($cadenaCampos) VALUES ($cadenaVALUES)");
        	foreach ($arrayCampos as $campo) {
        		$statement->bindparam(':'.$campo,$infoAInsertar[$campo]);
        	}
        	$statement->execute();
        }
        
        function getAllTabla($tabla, $stringOrdenarLista=null)
        {
        	/*esta función recibirá un string con el nombre de la tabla a obtener y otro posible string 
        	en caso de querer ordenar la lista obtenida*/
        	$conectar= new Conexion();
        	$conectar=$conectar->getConexion();	
        	$statement=$conectar->prepare("SELECT * FROM $tabla $stringOrdenarLista");
        	$statement->execute();
        	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        	return $arreglo;
        }
        
        function getUnRegistro($tabla,$arrayCampos,$infoABuscar)
        {
        	/*recibe el nombre de la tabla(string) , un arreglo simple con los campos para la busqueda
        	y yn arreglo asociativo con la informacion a buscar, este último debe ser un arreglo asociativo
        	y sus campos deben coincidir con los elementos (no las claves) del arreglo con los campos*/
        	$cadenaWHERE=generarCadenaWHERE($arrayCampos);
        	$conectar= new Conexion();
        	$conectar= $conectar->getConexion();
        	$statement= $conectar->prepare("SELECT * FROM $tabla WHERE $cadenaWHERE");
        	foreach ($arrayCampos as $campo) {
        		$statement->bindparam(':'.$campo,$infoABuscar[$campo]);
        	}	
        	$statement->execute();
        	$arreglo=$statement->fetch(PDO::FETCH_ASSOC);
        	return $this->registro=$arreglo;
        }
        
        function getSomeRegistros($tabla,$arrayCampos,$infoABuscar,$camposATraer='*',$cadenaExtra=NULL)
        {
        	/*recibe el nombre de la tabla(string) , un arreglo simple con los campos para la busqueda
        	y un arreglo con la informacion a buscar, este último debe ser un arreglo asociativo
            y sus campos deben coincidir con los elementos del arreglo con los campos ,luego sigue un string con los campo a traer,
            la cadena extra es para agregar limites entre otros */
        	$cadenaWHERE=generarCadenaWHERE($arrayCampos);
        	$conectar= new Conexion();
        	$conectar= $conectar->getConexion();
        	$statement= $conectar->prepare("SELECT $camposATraer FROM $tabla WHERE $cadenaWHERE $cadenaExtra");
        	foreach ($arrayCampos as $campo) {
                $statement->bindparam(':'.$campo,$infoABuscar[$campo]);
        	}	
        	$statement->execute();
        	$arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
        	return $arreglo;
        }
        
        function getSomeRegistrosJoin()
        {
            $conectar= new Conexion();
            $conectar= $conectar->getConexion($camposATraer);
            $statement= $conectar->prepare("SELECT id , permalink_url FROM `post_page_facebook` WHERE id NOT IN(SELECT DISTINCT(P.id) FROM post_page_facebook P INNER JOIN catalogacion_post_facebook C ON P.id=C.id_post WHERE fecha == '') LIMIT 10");
            $statement->execute();
            $arreglo=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $arreglo;
        }

        function deleteUnaTabla($tabla)
        {
        	/*borrará todos los registro de una tabla*/
        	$conectar= new Conexion();
        	$conectar= $conectar->getConexion();
        	$statement=$conectar->prepare("DELETE FROM $tabla");
        	$statement->execute();
        }
        
        function deleteUnRegistro($tabla,$arrayCampos,$infoABuscar)
        {
        	/*Borrará un registro recibiendo el nombre de la tabla, los campos a evaluar que seran un arreglo simple 
        	y tambien recibirá un arreglo asociativo cuyas claves deben coincidir con los campos a evaluar*/
        	$cadenaWHERE=generarCadenaWHERE($arrayCampos);
        	$conectar= new Conexion();
        	$conectar=$conectar->getConexion();
        	$statement=$conectar->prepare("DELETE FROM $tabla WHERE $cadenaWHERE");
        	foreach ($arrayCampos as $campo) {
        		$statement->bindparam(':'.$campo,$infoABuscar[$campo]);
        	}	
        	$statement->execute();
        }
        
        function updateRegistro($tabla,$camposABuscar,$infoDeCamposABuscar,$camposDelRegistro,$infoAInsertar)
        {
        	/*
        	actualizará un registro recibiendo un string con el nombre de la tabla, un arreglo con los campos que 
        	se usarán para buscar el registro y un arreglo con la informacion para tal busqueda, además recibirá 
        	un arreglo con los campos que serán modificados y un arreglo con la informacion que se va a insertar 
        	en el registro, este último debe ser un arreglo asociativo cuyas claves coincidan con el arreglo de los 
        	campos a modificar*/
        	
        	$cadenaSET=generarCadenaSET($camposDelRegistro);
        	$cadenaWHERE=generarCadenaWHERE($camposABuscar);
        	$conectar= new Conexion();
        	$conectar= $conectar->getConexion();
        	$statement= $conectar->prepare("UPDATE $tabla SET $cadenaSET WHERE $cadenaWHERE");
        	foreach ($camposABuscar as $clave => $campoWHERE) {
        		$statement->bindparam(':'.$campoWHERE,$infoDeCamposABuscar[$clave]);
        	}//esto es lo que va en la sentencia despues del WHERE es decir para encotrar
        	foreach ($camposDelRegistro as $campo) {
        		$statement->bindparam(':'.$campo,$infoAInsertar[$campo]);
        	}	//esto es lo que va en la sentencia despues del SET es decir para modificar
        
        	$statement->execute();
        }
        
    }
 ?>