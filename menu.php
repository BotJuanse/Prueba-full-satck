<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>Task Master</title>
  <link rel="icon" href="img/taskmaster.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body>
  <?php
  session_start();
  include "conexion.php";
  $usu=$_SESSION["usunombre"];
  $usuid=$_SESSION["usuid"];
  if (!isset($_SESSION["usunombre"])) {
    header("Location: index.php");
  }
  $rolusu=mysqli_query($conexion,"SELECT rol FROM usuarios where id_usuario = '".$usuid."'");
  while($row=mysqli_fetch_array($rolusu)){
    $rol=$row['rol'];
  }
  ?>
  <div class="container-fluid mb-4">
    <div class="row">
      <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
        <div class="position-sticky sidebar-sticky">
          <div class="logo-wrap text-center">
            <a class="brand-link">
              <img src="img/taskmaster.png" class="brand-image img-circle elevation-3" style="opacity: .8">
            </a><p class="task-master">Task Master</p>
          </div>
          <ul class="nav flex-column mt-4">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home.php">
                <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
              </a>
            </li>
            <?php
            if ($rol=='Administrador') {
              echo'<li class="nav-item">
              <a class="nav-link " aria-current="page" href="usuarios.php">
              <i class="fas fa-users"></i> Usuarios
              </a>
              </li>
              <li class="nav-item">
              <a class="nav-link " aria-current="page" href="proyectos.php">
                <i class="fas fa-project-diagram"></i> Proyectos
              </a>
            </li>
              ';
            }
            ?>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="tareas.php">
                <i class="fas fa-tasks"></i> Tareas
              </a>
            </li>
            <li class="nav-item cerrar-sesion">
              <a class="nav-link " aria-current="page" href="index.php">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <nav class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-md-3 bg-white shadow-sm">
        <div class="row">
          <button class="btn btn-link" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
          </button>
          <div class="col-md-4 ps-md-0 ps-4">
            <!-- ./form -->
          </div>
          <!-- ./col -->
          <div class="col-md-8">

            <div class="dropdown text-end dropdown-usrn">
              <a href="#" class="link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="img/user1.png" width="32" height="32" class="rounded-circle" />
                <?php echo $usu;?>
              </a>
              <ul class="dropdown-menu text-small">
                <li><a class="dropdown-item" href="index.php">Cerrar sesión</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li><span class="text-infomation">Creado por sebastian peñaloza</span></li>
              </ul>
            </div>
            <!-- ./dropdown -->
          </div>
          <!-- ./col -->
        </div>
        <!-- ./row -->
      </nav>
    </div>
    <!-- ./row -->
  </div>
  <!-- ./container-fluid -->
  <!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js'></script>
  <script  src="./script.js"></script>
  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>

</body>
</html>
