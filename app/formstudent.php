<!doctype html>
<html lang="es">
<head>
  <title>Notas de paz</title>
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
  require_once 'conexion.php';
  
  
      if(isset($_POST['insertar'])) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $documento = $_POST['documento'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
  
          // Validar que los campos no estén vacíos
          if (!empty($nombre) && !empty($apellido) && !empty($documento) && !empty($edad) && !empty($email) && !empty($usuario) && !empty($clave)) {
              // Preparar la consulta SQL
              $insert = $conn->prepare('INSERT INTO estudiante (nombre, apellido, documento, edad, email, usuario, clave) VALUES (?, ?, ?, ?, ?, ?, ?)');
              $insert->bindParam(1, $nombre);
              $insert->bindParam(2, $apellido);
              $insert->bindParam(3, $documento);
              $insert->bindParam(4, $edad);
              $insert->bindParam(5, $email);
              $insert->bindParam(6, $usuario);
              $insert->bindParam(7, $clave);
  
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
        <h2>Formulario de registro</h2>
        <form action="" method="POST" enctype="application/x-www-form-urlencoded">
           
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
</body>
</html>

