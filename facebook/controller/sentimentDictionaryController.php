<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    date_default_timezone_set('America/Lima');
    include_once('../../model/SentimentDictionaryModel.php');
    if (isset($_POST) && $_POST!=null) {
        $sentimentDictionary = new SentimentDictionaryModel;
        if (isset($_POST['id_value_catalogacion_delete']) && $_POST['id_value_catalogacion_delete']!='') {
            $sentimentDictionary->deleteFraseSentimentDictionary($_POST['id_value_catalogacion_delete']);
        }
        if (isset($_POST['frase_create']) && $_POST['frase_create']!='') {
            $nuevo_registro = array(
                'frase'=> formatearFrase($_POST['frase_create']),
                'valor'=> $_POST['valor'],
            );
            $sentimentDictionary->setFraseSentimentDictionary($nuevo_registro);
            header('Location:' . getenv('HTTP_REFERER'));
        }
        if (isset($_POST['id_update']) && $_POST['id_update']!='') {
            $update_registro = array(
                'id'=> $_POST['id_update'],
                'frase'=> formatearFrase($_POST['frase']),
                'valor'=> $_POST['valor'],
            );
            $sentimentDictionary->updateFraseSentimentDictionary($update_registro);
            header('Location:' . getenv('HTTP_REFERER'));
        }
        if (isset($_FILES["excel"])){
            require_once '../../PHPExcel/Classes/PHPExcel.php';
            $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            if(in_array($_FILES["excel"]["type"],$allowedFileType)){
                $nombre=microtime().$_FILES['excel']['name'];
                $guardado=$_FILES['excel']['tmp_name'];
                guardar_archivo('../files_uploade/sentiment_dicionary',$guardado,$nombre);
                $archivo = '../files_uploade/sentiment_dicionary/'.$nombre;
                $inputFileType = PHPExcel_IOFactory::identify($archivo);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($archivo);
                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                for ($row = 2; $row < $highestRow; $row++){
                    $frase = $sheet->getCell("A".$row)->getValue();
                    $valor = $sheet->getCell("B".$row)->getValue();
                    if ($frase && in_array($valor,['-5','-4','-3','-2','-1','0','1','2','3','4','5'])) {
                        $nuevo_registro = array(
                            'frase'=> formatearFrase($frase),
                            'valor'=> $valor,
                        );
                        $sentimentDictionary->setFraseSentimentDictionary($nuevo_registro);
                    }
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
    function guardar_archivo($carpeta,$guardado,$nombre){
        if(!file_exists($carpeta)){
            mkdir($carpeta,0777,true);
            if(file_exists($carpeta)){
                if(move_uploaded_file($guardado, $carpeta.'/'.$nombre)){
                }else{
                    echo "Archivo no se pudo guardar";
                }
            }
        }else{
            if(move_uploaded_file($guardado, $carpeta.'/'.$nombre)){
            }else{
                echo "Archivo no se pudo guardar";
            }
        }
    }
?>