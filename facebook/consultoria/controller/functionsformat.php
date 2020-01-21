<?php
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
?>