<?php
//Creamos el archivo si no existe
if (!file_exists("miTemperatura&Ph.txt")) {
    file_put_contents("miTemperatura&Ph.txt", "0.00@0.0.00");
}
// Para resivir datos con el metodo get
if (isset($_GET['Temp']) && isset($_GET['Ph'])) {
    $parametro1 = $_GET['Temp'];
    $parametro2 = $_GET['Ph'];
    $contenido  = $parametro1 . "@" . $parametro2;
    //guardar datos al archivo
    $guardarArchivo = file_put_contents("miTemperatura&Ph.txt", $contenido);
}

$cadena = file_get_contents("miTemperatura&Ph.txt");
//Funcion ara separar cadenas de texto
$arregloresultado = explode("@", $cadena);

//variables con el dato ya almacenado
$temperatura = $arregloresultado[0];

$ph = $arregloresultado[1];

$data = array("temperatura" => $temperatura, "ph" => $ph);

header("Content-Type: application/json");
echo json_encode($data);
