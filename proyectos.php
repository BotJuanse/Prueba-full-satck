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
      error_reporting(0);
      include('menu.php');
      $mensaje=$_SESSION['A'];
      $mensaje2=$_SESSION['B'];
      $mensaje3=$_SESSION['C'];
      unset($_SESSION['A']);
      unset($_SESSION['B']);
      unset($_SESSION['C']);
      $contproyectos=mysqli_query($conexion,"SELECT count(*) as numproyectos FROM proyectos where estado_proyecto = 'activo'");
      while($row=mysqli_fetch_array($contproyectos)){
        $numproyectos=$row['numproyectos'];
      }
      ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h1 class="h2 my-4">Proyectos</h1>
        <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-4 row-stats">
         <div class="col-md-12">
          <div class="col-md-3">
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
            <!-- link -->
          </div>
          <!-- ./col -->
        </div>
        <!-- ./col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="card shadow-sm mb-2-sm">
            <div class="card-body p-3 text-center">
             <!-- Contenido principal -->
             <div class="container mt-4">
              <h2 class="mb-4">Gestión de Proyectos</h2>
              <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalProyecto">+ Nuevo Proyecto</button>
            </div>

            <!-- Modal para agregar/editar proyecto -->
            <div class="modal fade" id="modalProyecto" tabindex="-1" aria-labelledby="modalProyectoLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalProyectoLabel">Nuevo Proyecto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="crearproyecto.php" method="post">
                      <div class="mb-3">
                        <label for="nombreProyecto" class="form-label">Nombre del Proyecto</label>
                        <input type="text" class="form-control" id="nombreProyecto" name="nombreProyecto" placeholder="Ingrese el nombre del proyecto" required>
                      </div>
                      <div class="mb-3">
                        <label for="usuarioCreador" class="form-label">Usuario Creador</label>
                        <select class="form-select" id="usuarioCreador" name="usuarioCreador" required>
                          <option value="" disabled selected>Seleccione un usuario</option>
                          <?php
                          $nombreusuario=mysqli_query($conexion,"SELECT * FROM usuarios where estado = 'activo'");
                          while($row=mysqli_fetch_array($nombreusuario)){
                            $punombre=$row['nombre'];
                            $puid=$row['id_usuario'];
                            echo '<option value="'.$puid.'">'.$punombre.'</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- ./card-body -->
        </div>
        <!-- ./card -->
      </div>
      <!-- ./col -->
      <div class="col-12 col-sm-6 col-md-9">
        <div class="card shadow-sm">
          <div class="card-body p-3">
            <h2 class="my-0 h3">Proyectos creados</h2>
            <div class="table-responsive mt-4 mb-2">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre del Proyecto</th>
                    <th>Usuario Creador</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $consultaproyectos=mysqli_query($conexion,"SELECT * FROM proyectos inner join usuarios on id_usuario=usuario_creador where estado_proyecto = 'activo';");
                  $cont=1;
                  while($row=mysqli_fetch_array($consultaproyectos)){
                    $nombre_proyecto=$row['nombre_proyecto'];
                    $usuario_creador=$row['nombre'];
                    $id_proyecto=$row['id_proyecto'];
                    echo'<tr>
                    <td>'.$cont.'</td>
                    <td>'.$nombre_proyecto.'</td>
                    <td>'.$usuario_creador.'</td>
                    <td>
                    <button class="btn btn-sm btn-warning"onclick="abrirModalEditar(\''.$id_proyecto.'\', \''.$nombre_proyecto.'\', \''.$usuario_creador.'\')">Editar</button>
                    <button class="btn btn-sm btn-danger btnEliminar" data-id=" '.$id_proyecto.'" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button>
                    </td>
                    </tr>
                    <tr>
                    ';
                    $cont++;
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- ./card-body -->
          </div>
        </div>
        <!-- ./card -->
      </div>
      <!-- ./col -->
      <!-- Modal de Actualización de Proyecto -->
      <div class="modal fade" id="modalEditarProyecto" tabindex="-1" aria-labelledby="modalEditarProyectoLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditarProyectoLabel">Editar Proyecto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="editarproyecto.php" method="post" id="formEditarProyecto">
                <!-- Campo oculto para el ID -->
                <input type="hidden" name="idProyecto" id="idProyecto">

                <!-- Nombre del proyecto -->
                <div class="mb-3">
                  <label for="editarNombreProyecto" class="form-label">Nombre del Proyecto</label>
                  <input type="text" class="form-control" id="editarNombreProyecto" name="nombreProyecto" required>
                </div>

                <!-- Usuario creador -->
                <div class="mb-3">
                  <label for="editarUsuarioCreador" class="form-label">Usuario Creador</label>
                  <select class="form-select" id="editarUsuarioCreador" name="usuarioCreador" required>
                    <option value="" disabled selected>Seleccione un usuario</option>
                    <?php
                    $usuariosActivos = mysqli_query($conexion, "SELECT * FROM usuarios WHERE estado = 'activo'");
                    while ($row = mysqli_fetch_array($usuariosActivos)) {
                      echo '<option value="' . $row['id_usuario'] . '">' . $row['nombre'] . '</option>';
                    }
                    ?>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal de Confirmación de Eliminación -->
      <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>¿Estás seguro de que deseas eliminar este proyecto?</p>
            </div>
            <div class="modal-footer">
              <form id="formEliminarUsuario" action="eliminarproyecto.php" method="post">
                <input type="hidden" name="idProyecto" id="idUsuarioEliminar">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- ./row -->
  </main>
</div>
<!-- ./row -->
</div>
<!-- ./container-fluid -->
<!-- partial -->
<script>
  $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    <?php if ($mensaje === "Qaz"): ?>
        // Activar mensaje de éxito
      Toast.fire({
        icon: 'success',
        title: 'Proyecto creado.'
      });
    <?php elseif ($mensaje === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Proyecto no creado.'
      });
    <?php endif; ?>
    <?php if ($mensaje2 === "Qaz"): ?>
        // Activar mensaje de éxito
      Toast.fire({
        icon: 'success',
        title: 'Proyecto Atualizado.'
      });
    <?php elseif ($mensaje2 === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Proyecto no Actualizado.'
      });
    <?php endif; ?>
    <?php if ($mensaje3 === "Qaz"): ?>
        // Activar mensaje de éxito
      Toast.fire({
        icon: 'success',
        title: 'Proyecto eliminado.'
      });
    <?php elseif ($mensaje3 === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Proyecto no eliminado.'
      });
    <?php endif; ?>
  });
</script>
<script>
  // Función para abrir el modal de edición
function abrirModalEditar(id, nombre, responsable) {
  // Cargar datos en el formulario
  document.getElementById('idProyecto').value = id;
  document.getElementById('editarNombreProyecto').value = nombre;
  document.getElementById('editarUsuarioCreador').value = responsable;

  // Mostrar el modal
  var modal = new bootstrap.Modal(document.getElementById('modalEditarProyecto'));
  modal.show();
}
  document.addEventListener('DOMContentLoaded', function() {
  // Capturar los botones de eliminar
    const botonesEliminar = document.querySelectorAll('.btnEliminar');

  // Añadir evento al hacer clic en cada botón
    botonesEliminar.forEach(boton => {
      boton.addEventListener('click', function() {
        const idUsuario = this.getAttribute('data-id');
      // Pasar el ID al campo oculto del formulario
        document.getElementById('idUsuarioEliminar').value = idUsuario;
      });
    });
  });

</script>
</body>
</html>
