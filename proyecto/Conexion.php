<?php
// conexion.php
$host = 'localhost'; // Cambia si es necesario
$usuario = 'root'; // Cambia si es necesario
$contraseña = ''; // Cambia si es necesario
$base_de_datos = 'troquel';

$conn = new mysqli($host, $usuario, $contraseña, $base_de_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
