<!DOCTYPE html>
<html lang="es-CO" class="h-100">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apolo</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <script src="../assets/js/bootstrap.bundle.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="h-100">
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <main class="d-flex">


    <div class="clearfix">

      <span class="float-start">
        <div class="container-fluid">
          <div class="row flex-nowrap">
            <div class="d-flex flex-column justify-content-between col-auto bg-dark min-vh-100">
              <div class="mt-4">
                <a href="" class="text-white d-none d-sm-inline text-decoration-none d-flex aling-items-center ms-3"
                  role="button">
                  <a href="crear.html" class="fs-5 d-none d-sm-inline text-center text-sm-start">Bienvenido</a>
                </a>
                <hr class="text-white d-none d-sm-block" />
                <ul class="nav nav-pills flex-column mt-4 mt-sm-0" id="menu">
                  <li class="nav-item my-1">
                    <a href="" class="nav-link text-white" aria-current="page">
                      <i class="bi bi-house"></i>
                      <span class="ms-2 d-none d-sm-inline text-center text-sm-start">Inicio</span>
                    </a>
                  </li>

                  <li class="nav-item my-1">
                    <a href="#sc" class="nav-link text-white" aria-current="page">
                      <i class="bi bi-calendar-event"></i>
                      <span class="ms-2 d-none d-sm-inline">Eventos</span>
                    </a>
                  </li>

                  <li class="nav-item my-1 disabled">
                    <a href="#sidemenu" data-bs-toggle="collapse" class="nav-link text-white">
                      <i class="bi bi-file-earmark-person"></i>
                      <span class="ms-2 d-none d-sm-inline">Mi proceso</span>
                    </a>
                  <li class="nav-item my-1">
                    <a href="" class="nav-link text-white" aria-current="page">
                      <i class="bi bi-microsoft-teams"></i>
                      <span class="ms-2 d-none d-sm-inline">Prestamos</span>
                    </a>
                  </li>
                  </li>
                  <li class="nav-item my-1">
                    <a href="" class="nav-link text-white" aria-current="page">
                      <i class="bi bi-box"></i>
                      <span class="ms-2 d-none d-sm-inline text-center text-sm-start">Partituras</span>
                    </a>
                  </li>
                </ul>
              </div>
              <div>
              </div>
            </div>
          </div>
        </div>
      </span>
    </div>

    <article class="container my-5 py-5">

      <div>
        <h1 class="display-5 fw-bold text-uppercase text-dark" style="letter-spacing: 1px;">Bienvenido</h1>
        <h1 class="display-5 fw-bold text-uppercase text-dark" style="letter-spacing: 1px;"> Estudiante</h1>
      </div>
    </article>

  </main>
  <!--fin de eventos-->
  <footer class="bg-dark text-center text-white fixed-bottom">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->

      <!-- Copyright -->

      © 2023 Copyright:
      <a class="text-white" href="app/iniciosesion.php">Apolo</a>

      <!-- Copyright -->
    </div>
  </footer>
</body>

</html>