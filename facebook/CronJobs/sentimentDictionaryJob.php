<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); 
//error_reporting(E_ALL & ~E_NOTICE & E_DEPRECATED);
include("/home/ssgenius/public_html/app/model/Database.php");
date_default_timezone_set('America/Lima');
$fecha =date('Y-m-d H:i:s');
try {
    $dbh = Database::getInstance();
    $sql = "SELECT 
    *
    FROM `ssg_facebook_comments` comments
    WHERE comments.id='2471496689548555_2485702161461341'
    ";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $comentario = formatearFrase($comentarios[0]["message"]);
    $comentario_id = formatearFrase($comentarios[0]["id"]);

    $sql = "SELECT
    *
    FROM `ssg_sentiment_dictionary_prueba`
    ORDER BY LENGTH(frase) DESC";
    $statement = $dbh->prepare($sql);
    $statement->execute();
    $infoFrases = $statement->fetchAll(PDO::FETCH_ASSOC);
    $valorTotal=null;
    $coincidencias=[];
    $coincidencias_id=[];
    foreach ($infoFrases as $key => $value) {
        $pos = strpos($comentario, $value['frase']);
        if (!$pos === false || $pos===0) {
            if (desechar_repetidos($value['frase'], $coincidencias)) {
                $valorTotal += $value['valor'];
                array_push($coincidencias,$value['frase']);
                array_push($coincidencias_id,$value['id']);
                var_dump($value,$valorTotal);echo"<br>";
            }
        }
    }
    $coincidencias_id = json_encode($coincidencias_id);
    

    $sql = "INSERT INTO `ssg_comment_rating`
    (`comment_id`, `valor`, `coincidencias`)
    VALUES (:comentario_id,:valorTotal,:coincidencias_id)";
    $statement = $dbh->prepare($sql);
    $statement->bindParam(':comentario_id',$comentario_id);
    $statement->bindParam(':valorTotal',$valorTotal);
    $statement->bindParam(':coincidencias_id',$coincidencias_id);
    $statement->execute();

} catch(PDOException $e) {
 echo "Oops... {$e->getMessage()}";
}

function desechar_repetidos($string, $arreglo)
{
    foreach ($arreglo as $key => $value) {
        $pos = strpos($value,$string);
        if (!$pos === false || $pos===0) {//hay coincidencias
            return false;
        }
    }
    return true;
}

function formatearFrase($frase){
    $frase = strtolower($frase);//todo a minuscula

    $buscar = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ");
    $reemplazar = array("a","e","i","o","u","a","e","i","o","u","ñ");
    $frase = str_replace($buscar, $reemplazar, $frase);//eliminando tildes
    return $frase;
}
?>