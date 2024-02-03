<?php                   
//(servidor de base de datos,nombre de administrador, contraseña,nombre base de datos)
$conn = new mysqli('localhost','root','12345678','biorect');

if($conn ->connect_error){

    die("Error de conexion" .$conn ->connect_error);

}

?>