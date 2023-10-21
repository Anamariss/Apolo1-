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
      $numero = $_POST['numero'];
      $seccion = $_POST['seccion'];

        // Validar que los campos no estén vacíos
        if (!empty($nombre) && !empty($numero) && !empty($seccion)) {
            // Preparar la consulta SQL
            $insert = $conn->prepare('INSERT INTO instrumento (nombre, numero, seccion) VALUES (?, ?, ?)');
            $insert->bindParam(1, $nombre);
            $insert->bindParam(2, $numero);
            $insert->bindParam(3, $seccion);

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
           
            <label for="numero" class="form-label">Numero</label>
            <input type="number" name="numero" required>
           <div class="mb-3">
           <label for="seccion" class="form-label">Seccion</label>
            <select name="seccion" id="seccion" class="form-control">
              <option value="Banda">Banda</option>
              <option value="Coro">Coro</option>
              <option value="Estudiantina">Estudiantina</option>
            </select>
           </div>
            <br>
          <button name="insertar" type="submit" style="margin: 10px;">Enviar</button>
          <p>¡WELCOME!</p> 
        </form>
    </section>
</body>
</html>

