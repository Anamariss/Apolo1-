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

  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="assets/js/bootstrap.bundle.js"></script>
  <script src="assets/js/nuevo.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body>

   <div class="box w-50 m-auto bg-primary ">
    <!--Datatables Styles-->
<link rel="stylesheet" type="text/css" href="../assets/datatables/css/dataTables.bootstrap5.min.css">
<!--Datatables Buttons-->
<link rel="stylesheet" type="text/css" href="../assets/datatables/css/buttons.bootstrap5.css">
<!--Datatables Buttons-->
<script type="text/javascript" src="../assets/datatables/js/dataTables.responsive.min.js"></script>
<!--Datatables Scripts-->
<script type="text/javascript" src="../assets/datatables/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/jquery.datatables.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/dataTables.bootstrap5.min.js"></script>
<!--Botones para exportar-->
<script type="text/javascript" src="../assets/datatables/js/pdfmake.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/jszip.min.js"></script>
<script type="text/javascript" src="../assets/datatables/js/vfs_fonts.js"></script>
<script type="text/javascript" src="../assets/datatables/js/buttons.html5.js"></script>
<script type="text/javascript" src="../assets/datatables/js/buttons.print.js"></script>
<!--Datatables responsive script-->
<script type="text/javascript" src="../assets/datatables/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" type="text/css" href="../assets/css/tablas.css">
<script type="text/javascript">
  $(document).ready(function () {
    $('#tableresponsive').DataTable({
      dom: 'Bflrtip',
      buttons: [
        {
          extend: 'copyHtml5',
          footer: 'true',
          titleAtrr: 'copiar',
          className: 'btn btn-outline-info btn-md',
          text: '<i class="bi bi-clipboard"></i>'
        },
        {
          extend: 'excelHtml5',
          footer: 'true',
          titleAtrr: 'excel',
          className: 'btn btn-outline-success btn-md',
          text: '<i class="bi bi-file-earmark-excel"></i>'
        },
        {
          extend: 'pdfHtml5',
          footer: 'true',
          titleAtrr: 'pdf',
          className: 'btn btn-outline-danger btn-md',
          text: '<i class="bi bi-file-earmark-pdf"></i>'
        },
        {
          extend: 'print',
          footer: 'true',
          titleAtrr: 'print',
          className: 'btn btn-outline-primary btn-md',
          text: '<i class="bi bi-printer"></i>'
        },
      ],
      responsive: true,
      language: {
        url: '../assets/datatables/es-ES.json',
      },
    });
  });
</script>
<?php
if (is_array($data)) {
  ?>
  <?php
  require_once 'conexion.php';

  if (isset($_POST['editar'])) {
    $sede = $_GET['sede'];
    $update = $conn->prepare("UPDATE adulto_mayor SET tipo = :tipo, documento = :documento, nombre = :nombre, apellido = :apellido, fecha_n = :fecha_n WHERE idadulto_mayor = :idadulto_mayor");
    $update->bindParam(':tipo', $_POST['tipo']);
    $update->bindParam(':documento', $_POST['documento']);
    $update->bindParam(':nombre', $_POST['nombre']);
    $update->bindParam(':apellido', $_POST['apellido']);
    $update->bindParam(':fecha_n', $_POST['fecha_n']);
    $update->bindParam(':idadulto_mayor', $_POST['idup']);

    if ($update->execute()) {
      echo "<script>
        Swal.fire({
            title: 'Exitoso',
            text: 'Datos actualizados',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'homeadm?page=adulto&sede=$sede';
            }
        });
        </script>";
    } else {
      echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'Datos no actualizados',
            icon: 'error',
            confirmButtonText: 'Cerrar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'homeadm?page=adulto&sede=$sede';
            }
        });
        </script>";
    }
  }
  ?>
  <?php
  require_once 'conexion.php';
  $sede = $_GET['sede'];
  if (isset($_GET['delete'])) {
    $options = [
      PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    ];

    $dsn = "mysql:host=localhost;dbname=eutopeniaproyecto;charset=utf8mb4";
    $username = "root";
    $password = "";

    $conn = new PDO($dsn, $username, $password, $options);
    $addnotaseguimiento = $conn->prepare('ALTER TABLE nota_seguimiento DROP FOREIGN KEY IF EXISTS fk_nota_seguimiento_adulto_mayor1');
    $addnotaseguimiento->execute();
    $addnotaseguimiento = $conn->prepare('ALTER TABLE nota_seguimiento ADD CONSTRAINT fk_nota_seguimiento_adulto_mayor1 FOREIGN KEY (adulto_mayor_idadulto_mayor) REFERENCES adulto_mayor (idadulto_mayor) ON DELETE CASCADE');
    $addnotaseguimiento->execute();

    $deletenota = $conn->prepare('DELETE FROM nota_seguimiento WHERE adulto_mayor_idadulto_mayor = ?');
    $deletenota->bindParam(1, $_GET['delete']);
    $deletenota->execute();

    $deleteSede = $conn->prepare('DELETE FROM adulto_mayor WHERE idadulto_mayor = ?');
    $deleteSede->bindParam(1, $_GET['delete']);
    $deleteSede->execute();

    if ($deleteSede) {
      echo "<script>
    Swal.fire({
        title: 'Exitoso',
        text: 'Los datos han sido eliminados correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'homeadm?page=adulto&sede=$sede;
        }
    });
    </script>";
    } else {
      echo "<script>
    Swal.fire({
        title: 'Error',
        text: 'Los datos no se han podido eliminar',
        icon: 'error',
        confirmButtonText: 'Cerrar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'homeadm?page=adulto&sede=$sede;
        }
    });
    </script>";
    }
  }
  ?>
  <?php
  require_once 'conexion.php';

  if (isset($_POST['insertar'])) {
    $tipo = $_POST['tipo'];
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_n = $_POST['fecha_n'];
    $genero = $_POST['genero'];
    $sede = $_GET['sede'];

    if (!empty($tipo) && !empty($documento) && !empty($nombre) && !empty($apellido) && !empty($fecha_n) && !empty($genero)) {
      $insert = $conn->prepare('INSERT INTO adulto_mayor (tipo, documento, nombre, apellido, fecha_n, genero, sede_idsede) VALUES (?, ?, ?, ?, ?, ?, ?)');
      $insert->bindParam(1, $tipo);
      $insert->bindParam(2, $documento);
      $insert->bindParam(3, $nombre);
      $insert->bindParam(4, $apellido);
      $insert->bindParam(5, $fecha_n);
      $insert->bindParam(6, $genero);
      $insert->bindParam(7, $sede);

      if ($insert->execute()) {
        echo "<script>
          Swal.fire({
              title: 'Exitoso',
              text: 'El nuevo Adulto Mayor ha sido registrado',
              icon: 'success',
              confirmButtonText: 'Aceptar'
           }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'homeadm?page=adulto&sede=$sede';
            }
        });
        </script>";
      } else {
        echo "<script>
          Swal.fire({
            title: 'Error',
            text: 'El nuevo Adulto Mayor no se pudo registrar',
            icon: 'Error',
            confirmButtonText: 'Cerrar'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'homeadm?page=adulto&sede=$sede';
            }
        });
        </script>";
      }
    } else {
      echo "<script>
      $(document).ready(function () {
        Swal.fire({
          title: 'Incompleto',
          text: 'Por favor llene todos lo campos del formulario.',
          icon: 'info',
          confirmButtonText: 'Ok',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'homeadm?page=adulto&sede=$sede';
          }
        });
      });
    </script>";
    }
  }
  ?>
  <div class="container pt-1">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Datos Adulto Mayor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" enctype="application/x-www-form-urlencoded">
              <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de documento</label>
                <select id="tipo" name="tipo" class="form-control">
                  <option value="CC">Cedula de ciudadanía</option>
                  <option value="Pasaporte">Pasaporte</option>
                  <option value="Otro">Otro</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="documento">Número de Documento:</label>
                <input type="text" name="documento" class="form-control" onkeypress="return event.charCode >= 48
              && event.charCode <= 57" placeholder="Ingrese el número de documento" required />
              </div>
              <div class="mb-3">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese su nombre" required />
              </div>
              <div class="mb-3">
                <label for="apellido">Apellidos:</label>
                <input type="text" name="apellido" class="form-control" placeholder="Ingrese sus apellidos" required />
              </div>
              <div class="mb-3">
                <label for="fecha_n" class="form-label">Fecha de Nacimiento</label>
                <input class="control" type="date" id="start" name="fecha_n" value="" min="1900-05-03" max="3000-12-31"
                  aria-label="fecha">
              </div>
              <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <select id="genero" name="genero" class="form-control">
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                  <option value="Otro">Otro</option>
                </select>
              </div>
              <div class="mb-1 float-end">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i
                    class="bi bi-x-circle-fill me-1"></i>Cerrar</button>
                <button type="submit" class="btn btn-primary" name="insertar"><i
                    class="bi bi-send-fill me-1"></i>Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-1">
      <div class="float-end mt-3">
        <button type="button" class="btn btn-primary d-grid gap-2 d-md-flex justify-content-md-end float-end"
          data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-circle-fill me-1"></i>
          Nuevo
        </button>
      </div>
      <h1 class="text-center">Adultos Mayores</h1>
      <table class="table table-striped table-bordered table-hover mt-1" id="tableresponsive" style="width: 100%;">
        <thead>
          <tr>
            <th scope="col">Tipo de documento</th>
            <th scope="col">Documento</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Fecha de nacimiento</th>
            <th scope="col">Género</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = $conn->prepare('SELECT * FROM adulto_mayor LEFT JOIN nota_seguimiento ON adulto_mayor.idadulto_mayor = nota_seguimiento.idnota_seguimiento WHERE sede_idsede=?');
          $result->bindParam(1, $_GET['sede']);
          $result->execute();

          while ($view = $result->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <tr>
              <td>
                <?php echo $view["tipo"] ?>
              </td>
              <td>
                <?php echo $view["documento"] ?>
              </td>
              <td>
                <?php echo $view["nombre"] ?>
              </td>
              <td>
                <?php echo $view["apellido"] ?>
              </td>
              <td>
                <?php echo date('d-m-Y', strtotime($view['fecha_n'])); ?>
              </td>
              <td>
                <?php echo $view["genero"] ?>
              </td>
              <td>
                <button type="button" data-bs-toggle="modal" data-bs-target="#update<?php echo $view["idadulto_mayor"] ?>"
                  title="Actualizar" class="btn btn-primary editarbtn" title="Actualizar"><i
                    class="fas fa-edit"></i></button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#delete<?php echo $view["idadulto_mayor"] ?>"
                  title="Eliminar" class="btn btn-danger" title="Eliminar Datos"><i class="fas fa-trash"></i></button>
                <a href="homeadm?page=seguimiento&seguimiento=<?php echo $view['idadulto_mayor']; ?>"
                  class="btn btn-primary"><i class="bi bi-eye-fill"></i></a>
              </td>
            </tr>
            <!-- Modal eliminar datos -->
            <div class="modal fade" id="delete<?php echo $view["idadulto_mayor"] ?>">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Alerta de datos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    Realmente desea eliminar el adulto mayor con el nombre:
                    <p>
                      <?php echo $view['nombre'] . " " . $view['apellido']; ?>
                    </p>
                  </div>
                  <div class="modal-footer">
                  <a href="homeadm?page=adulto&delete=<?php echo $view['idadulto_mayor']; ?>&sede=<?php echo $sede; ?>" title="Aceptar" class="btn btn-success">Aceptar</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
            <!--Actualizar datos-->
            <div class="modal fade" id="update<?php echo $view["idadulto_mayor"] ?>">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Actualizar datos</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <form action="" method="POST" enctype="application/x-www-form-urlencoded">
                      <div class="mb-3">
                        <label for="tipo">Tipo de Documento</label>
                        <select class="form-select" name="tipo" required>
                          <option value="">Seleccione una opción</option>
                          <option value="cc" <?php if ($view["tipo"] == "cc")
                            echo 'selected="selected"'; ?>>C.C</option>
                          <option value="pasaporte" <?php if ($view["tipo"] == "pasaporte")
                            echo 'selected="selected"'; ?>>
                            Pasaporte</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="documento">Número de Documento</label>
                        <input type="hidden" name="idup" value="<?php echo $view["idadulto_mayor"] ?>">
                        <input type="text" name="documento" class="form-control" value="<?php echo $view["documento"] ?>"
                          onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
                      </div>
                      <div class="mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $view["nombre"] ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="apellido">Apellidos</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $view["apellido"] ?>" />
                      </div>
                      <div class="mb-3">
                        <label for="fecha_n" class="form-label">Fecha de Nacimiento</label>
                        <input class="form-control" type="date" name="fecha_n" aria-label="fecha"
                          value="<?php echo $view['fecha_n']; ?>">
                      </div>
                      <div class="mb-3">
                        <label for="genero" class="form-label">Género</label>
                        <select id="genero" name="genero" class="form-control">
                          <option value="Masculino" <?php if ($view["genero"] == "Masculino")
                            echo 'selected="selected"'; ?>>
                            Masculino</option>
                          <option value="Femenino" <?php if ($view["genero"] == "Femenino")
                            echo 'selected="selected"'; ?>>
                            Femenino</option>
                          <option value="Otro" <?php if ($view["genero"] == "Otro")
                            echo 'selected="selected"'; ?>>Otro
                          </option>
                        </select>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" name="editar">Actualizar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
}
?>
  </div>
</body>
</html>