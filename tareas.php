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
      $conttareas=mysqli_query($conexion,"SELECT count(*) as numtareas FROM tareas where estado_tarea_p = 'activo'");
      while($row=mysqli_fetch_array($conttareas)){
        $numtareas=$row['numtareas'];
      }
      ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h1 class="h2 my-4">Tareas</h1>
        <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-4 row-stats">
          <!-- ./col -->
          <div class="col-md-12">
            <div class="col-md-3">
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
                <h2 class="mb-4">Gestión de Tareas</h2>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTarea">+ Nueva Tarea</button>
              </div>

              <!-- Modal para agregar/editar tarea -->
              <div class="modal fade" id="modalTarea" tabindex="-1" aria-labelledby="modalTareaLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalTareaLabel">Nueva Tarea</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="creartarea.php" method="post">
                        <div class="mb-3">
                          <label for="tituloTarea" class="form-label">Título</label>
                          <input type="text" class="form-control" id="tituloTarea" name="tituloTarea" placeholder="Ingrese el título" required>
                        </div>
                        <div class="mb-3">
                          <label for="proyectoAsociado" class="form-label">Proyecto Asociado</label>
                          <select class="form-select" id="proyectoAsociado" name="proyectoAsociado" required>
                            <option selected>Seleccione un proyecto</option>
                            <?php
                            $nombreproyecto=mysqli_query($conexion,"SELECT * FROM proyectos where estado_proyecto = 'activo'");
                            while($row=mysqli_fetch_array($nombreproyecto)){
                              $tunombre=$row['nombre_proyecto'];
                              $tuid=$row['id_proyecto'];
                              echo '<option value="'.$tuid.'">'.$tunombre.'</option>';
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="fechaFinalizacion" class="form-label">Fecha de Finalización</label>
                          <input type="date" class="form-control" id="fechaFinalizacion" name="fechaFinalizacion" required>
                        </div>
                        <div class="mb-3">
                          <label for="estadoTarea" class="form-label">Estado</label>
                          <select class="form-select" id="estadoTarea" name="estadoTarea" required>
                            <option selected>Seleccione un estado</option>
                            <option value="En Proceso">En Proceso</option>
                            <option value="Pausado">Pausado</option>
                            <option value="Completado">Completado</option>
                            <option value="Cancelado">Cancelado</option>
                          </select>
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
                        <div class="mb-3">
                          <label for="usuarioResponsable" class="form-label">Usuario Responsable</label>
                          <select class="form-select" id="usuarioResponsable" name="usuarioResponsable" required>
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
              <h2 class="my-0 h3">Tareas creadas</h2>
              <div class="table-responsive mt-4 mb-2">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Título</th>
                      <th>Proyecto Asociado</th>
                      <th>Fecha de Finalización</th>
                      <th>Estado</th>
                      <th>Usuario Responsable</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if ($rol=='Administrador') {
                      $consultatarea=mysqli_query($conexion,"SELECT * FROM tareas
                        inner join proyectos on proyecto=id_proyecto
                        inner join usuarios on id_usuario=usuario_responsable_tarea 
                        where estado_tarea_p = 'activo' order by id_tarea;");
                      $cont=1;
                      while($row=mysqli_fetch_array($consultatarea)){
                        $id_tarea=$row['id_tarea'];
                        $titulo=$row['titulo'];
                        $nombre_proyecto=$row['nombre_proyecto'];
                        $fecha_finalizacion=$row['fecha_finalizacion'];
                        $estado_tarea=$row['estado_tarea'];
                        $usuario_creador=$row['nombre'];

                        $atproyecto=$row['proyecto'];
                        $atusuario_creador=$row['usuario_creador_tarea'];
                        $atusuario_responsable=$row['usuario_responsable_tarea'];
                        echo'<tr>
                        <td>'.$cont.'</td>
                        <td>'.$titulo.'</td>
                        <td>'.$nombre_proyecto.'</td>
                        <td>'.$fecha_finalizacion.'</td>
                        <td>'.$estado_tarea.'</td>
                        <td>'.$usuario_creador.'</td>
                        <td>
                        <button class="btn btn-sm btn-warning"onclick="abrirModalEditar(\''.$id_tarea.'\', \''.$titulo.'\', \''.$atproyecto.'\', \''.$fecha_finalizacion.'\', \''.$estado_tarea.'\', \''.$atusuario_creador.'\', \''.$atusuario_responsable.'\')">Editar</button>
                        <button class="btn btn-sm btn-danger btnEliminar" data-id=" '.$id_tarea.'" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button>
                        </td>
                        </tr>
                        <tr>
                        ';
                        $cont++;
                      }
                    }else{
                      $consultatarea=mysqli_query($conexion,"SELECT * FROM tareas
                        inner join proyectos on proyecto=id_proyecto
                        inner join usuarios on id_usuario=usuario_responsable_tarea 
                        where estado_tarea_p = 'activo' and usuario_responsable_tarea = '".$usuid."' order by id_tarea;");
                      $cont=1;
                      while($row=mysqli_fetch_array($consultatarea)){
                        $id_tarea=$row['id_tarea'];
                        $titulo=$row['titulo'];
                        $nombre_proyecto=$row['nombre_proyecto'];
                        $fecha_finalizacion=$row['fecha_finalizacion'];
                        $estado_tarea=$row['estado_tarea'];
                        $usuario_creador=$row['nombre'];

                        $atproyecto=$row['proyecto'];
                        $atusuario_creador=$row['usuario_creador_tarea'];
                        $atusuario_responsable=$row['usuario_responsable_tarea'];
                        echo'<tr>
                        <td>'.$cont.'</td>
                        <td>'.$titulo.'</td>
                        <td>'.$nombre_proyecto.'</td>
                        <td>'.$fecha_finalizacion.'</td>
                        <td>'.$estado_tarea.'</td>
                        <td>'.$usuario_creador.'</td>
                        <td>
                        <button class="btn btn-sm btn-warning"onclick="abrirModalEditar(\''.$id_tarea.'\', \''.$titulo.'\', \''.$atproyecto.'\', \''.$fecha_finalizacion.'\', \''.$estado_tarea.'\', \''.$atusuario_creador.'\', \''.$atusuario_responsable.'\')">Editar</button>
                        </td>
                        </tr>
                        <tr>
                        ';
                        $cont++;
                      }
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
        <!-- Modal de Actualización de tarea -->
        <div class="modal fade" id="modalActualizarTarea" tabindex="-1" aria-labelledby="modalActualizarTareaLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalActualizarTareaLabel">Actualizar Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="editartarea.php" method="post">
                  <!-- Campo oculto para el ID de la tarea -->
                  <input type="hidden" name="idTarea" id="idTarea">

                  <div class="mb-3">
                    <label for="editarTituloTarea" class="form-label">Título</label>
                    <input type="text" class="form-control" id="editarTituloTarea" name="tituloTarea" placeholder="Ingrese el título" required>
                  </div>
                  <div class="mb-3">
                    <label for="editarProyectoAsociado" class="form-label">Proyecto Asociado</label>
                    <select class="form-select" id="editarProyectoAsociado" name="proyectoAsociado" required>
                      <option selected>Seleccione un proyecto</option>
                      <?php
                      $nombreproyecto = mysqli_query($conexion, "SELECT * FROM proyectos WHERE estado_proyecto = 'activo'");
                      while ($row = mysqli_fetch_array($nombreproyecto)) {
                        $tunombre = $row['nombre_proyecto'];
                        $tuid = $row['id_proyecto'];
                        echo '<option value="'.$tuid.'">'.$tunombre.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="editarFechaFinalizacion" class="form-label">Fecha de Finalización</label>
                    <input type="date" class="form-control" id="editarFechaFinalizacion" name="fechaFinalizacion" required>
                  </div>
                  <div class="mb-3">
                    <label for="editarEstadoTarea" class="form-label">Estado</label>
                    <select class="form-select" id="editarEstadoTarea" name="estadoTarea" required>
                      <option selected>Seleccione un estado</option>
                      <option value="En Proceso">En Proceso</option>
                      <option value="Pausado">Pausado</option>
                      <option value="Completado">Completado</option>
                      <option value="Cancelado">Cancelado</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="editarUsuarioCreador" class="form-label">Usuario Creador</label>
                    <select class="form-select" id="editarUsuarioCreador" name="usuarioCreador" required>
                      <option value="" disabled selected>Seleccione un usuario</option>
                      <?php
                      $nombreusuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE estado = 'activo'");
                      while ($row = mysqli_fetch_array($nombreusuario)) {
                        $punombre = $row['nombre'];
                        $puid = $row['id_usuario'];
                        echo '<option value="'.$puid.'">'.$punombre.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="editarUsuarioResponsable" class="form-label">Usuario Responsable</label>
                    <select class="form-select" id="editarUsuarioResponsable" name="usuarioResponsable" required>
                      <option value="" disabled selected>Seleccione un usuario</option>
                      <?php
                      $nombreusuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE estado = 'activo'");
                      while ($row = mysqli_fetch_array($nombreusuario)) {
                        $punombre = $row['nombre'];
                        $puid = $row['id_usuario'];
                        echo '<option value="'.$puid.'">'.$punombre.'</option>';
                      }
                      ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Actualizar</button>
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
                <form id="formEliminarUsuario" action="eliminartarea.php" method="post">
                  <input type="hidden" name="idtarea" id="idtareaEliminar">
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
        title: 'Tarea creada.'
      });
    <?php elseif ($mensaje === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Tarea no creada.'
      });
    <?php endif; ?>
    <?php if ($mensaje2 === "Qaz"): ?>
        // Activar mensaje de éxito
      Toast.fire({
        icon: 'success',
        title: 'Tarea Atualizada.'
      });
    <?php elseif ($mensaje2 === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Tarea no Actualizada.'
      });
    <?php endif; ?>
    <?php if ($mensaje3 === "Qaz"): ?>
        // Activar mensaje de éxito
      Toast.fire({
        icon: 'success',
        title: 'Tarea eliminada.'
      });
    <?php elseif ($mensaje3 === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Tarea no eliminada.'
      });
    <?php endif; ?>
  });
</script>
<script>
  // Función para abrir el modal de edición
  function abrirModalEditar(id, titulo, proyectoId, fecha, estado, usuarioCreadorId, usuarioResponsableId) {
  // Cargar los datos en los campos del formulario
    document.getElementById('idTarea').value = id;
    document.getElementById('editarTituloTarea').value = titulo;
    document.getElementById('editarProyectoAsociado').value = proyectoId;
    document.getElementById('editarFechaFinalizacion').value = fecha;
    document.getElementById('editarEstadoTarea').value = estado;
    document.getElementById('editarUsuarioCreador').value = usuarioCreadorId;
    document.getElementById('editarUsuarioResponsable').value = usuarioResponsableId;

  // Mostrar el modal
    var modal = new bootstrap.Modal(document.getElementById('modalActualizarTarea'));
    modal.show();
  }
  document.addEventListener('DOMContentLoaded', function() {
  // Capturar los botones de eliminar
    const botonesEliminar = document.querySelectorAll('.btnEliminar');

  // Añadir evento al hacer clic en cada botón
    botonesEliminar.forEach(boton => {
      boton.addEventListener('click', function() {
        const idtarea = this.getAttribute('data-id');
      // Pasar el ID al campo oculto del formulario
        document.getElementById('idtareaEliminar').value = idtarea;
      });
    });
  });

</script>
</body>
</html>
