<?php

  require_once 'conexion.php';
  session_start();

  if (isset($_POST['validar'])) {
    $result = $conn->prepare('SELECT * FROM administrador WHERE usuario = ? UNION SELECT * FROM estudiante WHERE usuario = ? UNION SELECT * FROM superadministrador WHERE usuario = ?');
    $result->bindParam(1, $_POST['usuario']);
    $result->bindParam(2, $_POST['usuario']);
    $result->bindParam(3, $_POST['usuario']);
  
  
    $result->execute();

   /* if ($data= $result->fetch(PDO::FETCH_ASSOC));

    if(!empty($data_1) or $data_1 !== false){
      //es administrador
    }else{
      //buscar en estudiante
      echo "buscar en estudiante";
      die;
      $result = $conn->prepare('SELECT * FROM estudiante WHERE usuario=?');
      $result->bindParam(1, $_POST['usuario']);
      $result->execute();

      $data = $result->fetch(PDO::FETCH_ASSOC);
    
    }

    //var_dump($_POST['usuario']);die;


    $result->execute();

    $data = $result->fetch(PDO::FETCH_ASSOC);
    var_dump($data);die;
    */

   
    if ($data = $result->fetch(PDO::FETCH_ASSOC)) {
      switch ($data['rol']) {
        case 'Administrador':
          //Verficamos si la contraseña es correcta
          if (password_verify($_POST['clave'], $data['clave'])) {
            $_SESSION['administrador'] = $data['rol'];
            header('location: hadmin.php');
          } else {
            echo "Contraseña incorrecta";
          }
          break;
        case 'Estudiante':
          //Verficamos si la contraseña es correcta
          if (password_verify($_POST['clave'], $data['clave'])) {
            $_SESSION['estudiante'] = $data['rol'];
            header('location: Est.php');
          } else {
            echo "Contraseña incorrecta";
          }
          break;
          case 'superadministrador':
            //Verficamos si la contraseña es correcta
            if (password_verify($_POST['clave'], $data['clave'])) {
              $_SESSION['superadministrador'] = $data['rol'];
              header('location: formadmin.php.php');
            } else {
              echo "Contraseña incorrecta";
            }
            break;
        default:  
          break;
      }
      
    } else{
      echo "Datos incorrectos";
    }
  }
?>

<!DOCTYPE html>
<html lang="es-CO" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apolo</title>

  <meta name="theme-color" content="#ff2e01">
  <meta name="MobileOptimized" content="width">
  <meta name="HandhledFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar" content="black-traslucent">

  <!--Tags SEO-->
  <meta name="author" content="Miproyecto">
  <meta name="description" content="Aplicativo para enseñanza de Bootstrap">
  <meta name="keyworks" content="SENA, sena, Sena, Web App, web app, WEB APP">

  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="assets/js/bootstrap.bundle.js"></script>
  <script src="assets/js/nuevo.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <div class="container-fluid">

      <!--imagen-->
      <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="./">
            <img src="media/logoo.png" alt="logo" width="60" height="60">
          </a>
          <!--imagen-->
          </a>
        </div>
      </nav>
      <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!--parte derecha-->
      <div class="container-fluid bg-light sticky-top">
        <div class="container">
          <nav class="navbar navbar-sxpand-lg bg-light navbar-light py-2 py-lg-0">
          </nav>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-6 mb-lg-0">
          <li class="nav-item px-2">
            <a class="nav-link active text-dark fst-italic hola" aria-current="page" href="../index.html">Inicio</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link  text-dark fst-italic" href="../procesos.html">Procesos</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link text-dark fst-italic" href="#">Ingresar</a>
          </li>
          <li class="nav-item px-2">
            <a class="nav-link active text-dark fst-italic" aria-current="page" href="../Eventos.html">Eventos</a>
          <li class="nav-item px-2">
            <a class="nav-link  text-dark fst-italic" href="../Nosotros.html">Contactanos</a>
          </li>

          <!--final derecha-->

          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="px-5">

    <div class="mt-4 p-3 bg-primary text-white rounded">
      <h1 class="text-center fst-italic">ingresar</h1>
    </div>
  
  </section>
  <br>
  <section>
  
    <form class="box p-5 px-1 w-50 m-auto" action="" method="POST" enctype="application/x-www-form-urlencoded">
      <div class="mb-3 text-center">
        <label for="usuario" class="form-label fst-italic">Usuario</label>
        <input type="text" class="form-control" name="usuario" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        <div id="emailHelp" class="form-text fst-italic">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3 text-center">
        <label for="clave" class="form-label fst-italic">Contraseña</label>
        <input type="password" class="form-control" name="clave" id="exampleInputPassword1" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
        <label class="form-check-label fst-italic" for="exampleCheck1">Recordarme</label>
      </div>
      <div class="clearfix">
        <span class="float-start">
          <a class="btn btn-primary pt-2" href="">volver</a>
  
        </span>
        <span class="float-end">
          <button type="submit" class="btn btn-primary pt-2" name="validar">Iniciar sesion</button>
  
        
          <br>
        </span>
      </div>
    </form>
  
  </section>
  <br>

    <!--fin de eventos-->
    <footer class="bg-primary text-center text-white">
      <!-- Grid container -->
      <div class="container p-4 pb-0">
        <!-- Section: Social media -->
        <section class="mb-4">
          <!-- Facebook -->
          <a class="btn text-white btn-floating m-1" aria-label="Read more about Seminole tax hike"
            style="background-color: #3b5998;" href="https://www.facebook.com/AngelJorgeMontoyaLuna?mibextid=ZbWKwL"
            role="button"><i class="bi bi-facebook"></i>
          <!-- Instagram -->
          <a class="btn text-white btn-floating m-1" aria-label="Read more about Seminole tax hike"
            style="background-color: #b31d1d;" href="https://www.youtube.com/@escuelademusicaamalfi-anti2320" role="button"><i class="bi bi-youtube"></i>
          <!-- whatsapp -->
          <a class="btn text-white btn-floating m-1" aria-label="Read more about Seminole tax hike"
            style="background-color: #0df553;" href="" role="button"><i class="bi bi-whatsapp"></i></a>
        </section>
        <!-- Section: Social media -->
        <!-- Grid container -->
        <!-- Copyright -->
        <div class="text-center p-3 bg-primary" style="background-color: rgba(0, 0, 0, 0.2);">
          © 2023 Copyright:
          <a class="text-white" href="app/iniciosesion.php">Apolo</a>
        </div>
        <!-- Copyright -->
      </div>
    </footer>
 
</body>

</html>