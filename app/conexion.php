<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "apolo"; // Nombre de la base de datos 

try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // Establece el modo de error PDO en excepción
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Conexión exitosa";
} catch(PDOException $e) {
  echo "Error de conexión: " . $e->getMessage();
}
?>
