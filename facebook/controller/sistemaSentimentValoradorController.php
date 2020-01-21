<?php
    error_reporting(E_ALL); 
    ini_set('display_errors', 1);
    date_default_timezone_set('America/Lima');
    include_once('../../model/SistemaSentimentValoradorModel.php');
    if (isset($_POST) && $_POST!=null) {
        $sistemasSentiment = new SistemaSentimentValoradorModel;
        if (isset($_POST['insert_sentiment_coment_id']) && $_POST['insert_sentiment_coment_id']!='') {
            $sentimentDictionary = $sistemasSentiment->getInfoSentimentDictionary();
            $comment = $sistemasSentiment->getCommentsNoSentimentByCommentID($_POST['insert_sentiment_coment_id']);
            $infoAguardar = procesarComentario($comment,$sentimentDictionary);
            $sistemasSentiment->setCommentRating($infoAguardar);
            header('Location:' . getenv('HTTP_REFERER'));
        }
        if (isset($_POST['insert_sentiment_manually_coment_id']) && $_POST['insert_sentiment_manually_coment_id']!='') {
            $sentimentDictionary = $sistemasSentiment->getInfoSentimentDictionary();
            $commentToUpdate=[
                'comentario_id'=>$_POST['insert_sentiment_manually_coment_id'],
                'valorTotal'=>$_POST['valor'],
                'coincidencias_id'=>'[]',
            ];
            $sistemasSentiment->UpdateCommentRating($commentToUpdate);
            header('Location:' . getenv('HTTP_REFERER')); 
        }
        if (isset($_POST['insert_sentiment_post_id']) && $_POST['insert_sentiment_post_id']!='') {
            $sentimentDictionary = $sistemasSentiment->getInfoSentimentDictionary();
            $comments = $sistemasSentiment->getCommentsNoSentimentFromPost($_POST['insert_sentiment_post_id']);
            foreach ($comments as $key => $infoComment) {
                $infoAguardar = procesarComentario($infoComment,$sentimentDictionary);
                $sistemasSentiment->setCommentRating($infoAguardar);
            }
            header('Location:' . getenv('HTTP_REFERER'));
        }
        if (isset($_POST['insert_sentiment_id']) && $_POST['insert_sentiment_id']!='') {
            $sentimentDictionary = $sistemasSentiment->getInfoSentimentDictionary();
            $paramentroBusqueda =[
                'page_id'=>$_POST['insert_sentiment_id'],
                'desde'=>$_POST['desde'],
                'hasta'=>$_POST['hasta'],
            ];
            $comments = $sistemasSentiment->getCommentsNoSentimentByDate($paramentroBusqueda);
            foreach ($comments as $key => $infoComment) {
                $infoAguardar = procesarComentario($infoComment,$sentimentDictionary);
                $sistemasSentiment->setCommentRating($infoAguardar);
            }
            header('Location:' . getenv('HTTP_REFERER'));
        }
        if (isset($_POST['update_sentiment_id']) && $_POST['update_sentiment_id']!='') {
            $sentimentDictionary = $sistemasSentiment->getInfoSentimentDictionary();
            $paramentroBusqueda =[
                'page_id'=>$_POST['update_sentiment_id'],
            ];
            $comments = $sistemasSentiment->getCommentsSentiment($paramentroBusqueda);
            //var_dump($comments);
            foreach ($comments as $key => $infoComment) {
                if (!($infoComment['valor'] != null && $infoComment['coincidencias']=='[]')){//descartar los comentarios ya actualizados manualmente
                    $commentToUpdate = procesarComentario($infoComment,$sentimentDictionary);
                    $sistemasSentiment->UpdateCommentRating($commentToUpdate);
                }
            }
            header('Location:' . getenv('HTTP_REFERER'));
        }
    }
    function formatearFrase($frase){
        $frase = strtolower($frase);//todo a minuscula

        $buscar = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","Ñ");
        $reemplazar = array("a","e","i","o","u","a","e","i","o","u","ñ");
        $frase = str_replace($buscar, $reemplazar, $frase);//eliminando tildes
        return $frase;
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

    function procesarComentario($infoComment,$infoDictionary){
            $valorTotal=null;
            $coincidencias=[];
            $coincidencias_id=[];
            $comment = formatearFrase($infoComment['message']);
            $comment_id = $infoComment["id"];
            foreach ($infoDictionary as $key => $infoFrase) {
                $pos = strpos($comment, $infoFrase['frase']);
                if (!$pos === false || $pos===0) {
                    if (desechar_repetidos($infoFrase['frase'], $coincidencias)) {
                        $valorTotal += $infoFrase['valor'];
                        array_push($coincidencias,$infoFrase['frase']);
                        array_push($coincidencias_id,$infoFrase['id']);
                    }
                }
            }
        return [
            'comentario_id' => $comment_id,
            'valorTotal' => $valorTotal,
            'coincidencias_id' => json_encode($coincidencias_id),
        ];
    }
?>