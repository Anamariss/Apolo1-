<!doctype html>
<html lang="es">
<head>
  <title>SUPERADMINISTRADOR</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/bootstrap.bundle.js"></script>
<link rel="stylesheet" href="Tform.css">
</head>
<body>
<?php

//se abre la seccion
require_once 'conexion.php';
session_start();

if(isset($_SESSION['superadministrador'])){
$search=$conn->prepare('SELECT * FROM superadministrador WHERE rol=?');
$search->bindParam(1, $_SESSION['superadministrador']);
$search->execute();
$data=$search->fetch(PDO::FETCH_ASSOC);

}
if (is_array($data)) {

?>
  <?php
   require_once 'conexion.php';
   
   
       if(isset($_POST['insertar'])) {
         $escuela = $_POST['escuela'];
         $nombre = $_POST['nombre'];
         $apellido = $_POST['apellido'];
         $documento = $_POST['documento'];
         $edad = $_POST['edad'];
         $email = $_POST['email'];
         $usuario = $_POST['usuario'];
         $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
   
           // Validar que los campos no estén vacíos
           if (!empty($escuela) && !empty($nombre) && !empty($apellido) && !empty($documento) && !empty($edad) && !empty($email) && !empty($usuario) && !empty($clave)) {
               // Preparar la consulta SQL
               $insert = $conn->prepare('INSERT INTO administrador (escuela, nombre, apellido, documento, edad, email, usuario, clave) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
               $insert->bindParam(1, $escuela);
               $insert->bindParam(2, $nombre);
               $insert->bindParam(3, $apellido);
               $insert->bindParam(4, $documento);
               $insert->bindParam(5, $edad);
               $insert->bindParam(6, $email);
               $insert->bindParam(7, $usuario);
               $insert->bindParam(8, $clave);
   
               // Ejecutar la consulta y verificar el resultado
                 if ($insert->execute()) {
                     echo "Registro exitoso";
                 } else {
                     echo "Error al registrar";
                 }
             } else {
                 echo "Por Favor llene todos los campos";
             }
       }
  
   ?>
   <header class="list">
 </header>
     <section id="form" class="box w-25 m-auto">
         <h2>Formulario de registro jhkjh</h2>
         <form action="" method="POST" enctype="application/x-www-form-urlencoded">
            
             <label for="escuela" class="form-label">Escuela</label>
            <select name="escuela" id="escuela" class="form-control">
              <option value="1">1</option>
              <option value="2">2</option>
            </select>

             <label for="nombre" class="form-label">Nombre</label>
             <input type="text" name="nombre" required>
           
             <label for="apellido" class="form-label">Apellido</label>
             <input type="text" name="apellido" required>
            
             <label for="documento" class="form-label">Documento</label>
             <input type="text" name="documento" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            
             <label for="edad" class="form-label">Edad</label>
             <input type="text" name="edad" required onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            
             <label for="email" class="form-label">Email</label>
             <input type="email" name="email" required>
            
             <label for="usuario" class="form-label">Usuario</label>
             <input type="text" name="usuario" required>
             
             <label for="clave" class="form-label">Clave</label>
             <input type="password" name="clave" required>
           <button type="submit" name="insertar">Enviar</button>
           <p>¡WELCOME!</p> 
         </form>
    </section>
    <?php 
}else{
    header('location: ./');
}
?>
</body>
</html>

