<?php
include_once 'conec.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
       
    </head>
    <body>
        
<?php

                     // sql Crea la tabla usando Lenguaje PHP
$sql = "CREATE TABLE ssg_conversations_time_quantity_calculations (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
page_id VARCHAR(50) NOT NULL,
conversation_id VARCHAR(50) NOT NULL,
create_time VARCHAR(50),
From_id VARCHAR(50),
time_different VARCHAR(30),
fecha_respondido DATETIME NOT NULL
)";

// Se verifica si la tabla ha sido creado
if ($conn->query($sql) === TRUE) {
    echo "la tabla ha sido creado";
} else {
    echo "Hubo un error al crear la tabla: " . $conn->error;
}
// Cerramos la conexión
$conn->close();
?>
</body>
</html>
 