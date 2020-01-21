<?php
$directorio_escaneado = scandir('archivos_subidos');
$archivos = array();
foreach ($directorio_escaneado as $item) {
    if ($item != '.' and $item != '..') {
        $comp = explode("_", $item);
        if($comp[0]==$_POST['id']){
        $archivos[] = $item;
        }
    }
}
echo json_encode($archivos);
?>