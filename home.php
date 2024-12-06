<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>Task Master</title>
  <link rel="icon" href="img/taskmaster.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
</head>
<body>
  <div class="container-fluid mb-4">
    <div class="row">
      <?php
      include('menu.php');
      include "conexion.php";
      $conexion=$_SESSION['conexion'];

      $contusuarios=mysqli_query($conexion,"SELECT count(*) as numusuarios FROM usuarios where estado = 'activo'");
      while($row=mysqli_fetch_array($contusuarios)){
        $numusuarios=$row['numusuarios'];
      }

      $contproyectos=mysqli_query($conexion,"SELECT count(*) as numproyectos FROM proyectos where estado_proyecto = 'activo'");
      while($row=mysqli_fetch_array($contproyectos)){
        $numproyectos=$row['numproyectos'];
      }

      $conttareas=mysqli_query($conexion,"SELECT count(*) as numtareas FROM tareas where estado_tarea_p = 'activo'");
      while($row=mysqli_fetch_array($conttareas)){
        $numtareas=$row['numtareas'];
      }
      ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h1 class="h2 my-4">Dashboard</h1>
        <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-4 row-stats">
          <div class="col">
            <a href="usuarios.php" class="h-primary-outline">
              <div class="card shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="col-md-10">
                      <h3 class="h5">Usuarios</h3>
                      <p class="m-0 text-muted">
                        <?php echo $numusuarios;?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <!-- link -->
          </div>
          <!-- ./col -->
          <div class="col">
            <a href="#" class="h-primary-outline">
              <div class="card shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="col-md-10">
                      <h3 class="h5">Proyectos</h3>
                      <p class="m-0 text-muted">
                        <?php echo $numproyectos;?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <!-- link -->
          </div>
          <!-- ./col -->
          <div class="col">
            <a href="#" class="h-primary-outline">
              <div class="card shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fas fa-tasks"></i>
                    </div>
                    <div class="col-md-10">
                      <h3 class="h5">Tareas</h3>
                      <p class="m-0 text-muted">
                        <?php echo $numtareas;?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <!-- link -->
          </div>
        </div>
        <!-- ./row -->
      </main>
    </div>
    <!-- ./row -->
  </div>
  <!-- ./container-fluid -->
  <!-- partial -->

</body>
</html>
