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
      $contusuarios=mysqli_query($conexion,"SELECT count(*) as numusuarios FROM usuarios where estado = 'activo'");
      while($row=mysqli_fetch_array($contusuarios)){
        $numusuarios=$row['numusuarios'];
      }
      $contusuarios2=mysqli_query($conexion,"SELECT count(*) as numusuarios2 FROM usuarios where estado <> 'activo'");
      while($row=mysqli_fetch_array($contusuarios2)){
        $numusuarios2=$row['numusuarios2'];
      }
      ?>
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h1 class="h2 my-4">Usuarios</h1>
        <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-4 row-stats">
          <!-- ./col -->
          <div class="col">
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
            <!-- link -->
          </div>
          <div class="col">
            <a href="usuarios-pendientes.php" class="h-primary-outline">
              <div class="card shadow-sm">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <i class="fas fa-users"></i>
                    </div>
                    <div class="col-md-10">
                      <h3 class="h5">Usuarios pendientes o inactivos</h3>
                      <p class="m-0 text-muted">
                        <?php echo $numusuarios2;?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <!-- link -->
          </div>
          <div class="col">

          </div>
          <div class="col">

          </div>

          <!-- ./col -->
          <!-- ./col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="card shadow-sm mb-2-sm">
              <div class="card-body p-3 text-center">
               <!-- Contenido principal -->
               <div class="container mt-4">
                <h2 class="mb-4">Gestión de Usuarios</h2>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTarea">+ Nuevo Usuario</button>
              </div>

              <!-- Modal para agregar/editar tarea -->
              <div class="modal fade" id="modalTarea" tabindex="-1" aria-labelledby="modalTareaLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modalTareaLabel">Nuevo Usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="crearusuario.php" method="post">
                        <div class="mb-3">
                          <label for="nombreUsuario" class="form-label">Nombre</label>
                          <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" placeholder="Ingrese el nombre del usuario" required>
                        </div>
                        <div class="mb-3">
                          <label for="correoUsuario" class="form-label">Correo Electrónico</label>
                          <input type="email" class="form-control" id="correoUsuario" name="correoUsuario" placeholder="Ingrese el correo electrónico" required>
                        </div>
                        <div class="mb-3">
                          <label for="contrasenaUsuario" class="form-label">Contraseña</label>
                          <input type="password" class="form-control" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese la contraseña" required>
                        </div>
                        <div class="mb-3">
                          <label for="rolUsuario" class="form-label">Rol</label>
                          <select class="form-select" id="rolUsuario" name="rolUsuario" required>
                            <option value="" disabled selected>Seleccione un rol</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Usuario">Usuario</option>
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
              <h2 class="my-0 h3">Usuarios creados</h2>
              <div class="table-responsive mt-4 mb-2">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Correo</th>
                      <th>Rol</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $consultausuarios=mysqli_query($conexion,"SELECT * FROM usuarios where estado = 'activo'");
                    $cont=1;
                    while($row=mysqli_fetch_array($consultausuarios)){
                      $ccorreo=$row['correo'];
                      $cnombre=$row['nombre'];
                      $crol=$row['rol'];
                      $cpassword=base64_decode($row['password']);
                      $cid=$row['id_usuario'];
                      echo'<tr>
                      <td>'.$cont.'</td>
                      <td>'.$cnombre.'</td>
                      <td>'.$ccorreo.'</td>
                      <td>'.$crol.'</td>
                      <td>
                      <button class="btn btn-sm btn-warning"onclick="abrirModalEditar(\''.$cid.'\', \''.$cnombre.'\', \''.$ccorreo.'\',\''.$cpassword.'\', \''.$crol.'\')">Editar</button>
                      <button class="btn btn-sm btn-danger btnEliminar" data-id=" '.$cid.'" data-bs-toggle="modal" data-bs-target="#modalEliminar">Inactivar</button>
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
        <!-- Modal de Actualizacion de Usuario -->
        <div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="editarusuario.php" method="post" id="formEditarUsuario">
                  <input type="hidden" name="idUsuario" id="idUsuario"> <!-- Campo oculto para el ID -->
                  <div class="mb-3">
                    <label for="editarNombreUsuario" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="editarNombreUsuario" name="nombreUsuario" >
                  </div>
                  <div class="mb-3">
                    <label for="editarCorreoUsuario" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="editarCorreoUsuario" name="correoUsuario" >
                  </div>
                  <div class="mb-3">
                    <label for="contrasenaUsuario" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="editarcontrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese la contraseña" >
                  </div>
                  <div class="mb-3">
                    <label for="editarRolUsuario" class="form-label">Rol</label>
                    <select class="form-select" id="editarRolUsuario" name="rolUsuario" >
                      <option value="Administrador">Administrador</option>
                      <option value="Usuario">Usuario</option>
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
                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
              </div>
              <div class="modal-footer">
                <form id="formEliminarUsuario" action="eliminarusuario.php" method="post">
                  <input type="hidden" name="idUsuario" id="idUsuarioEliminar">
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
        title: 'Usuario creado.'
      });
    <?php elseif ($mensaje === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Usuario no creado.'
      });
    <?php endif; ?>
    <?php if ($mensaje2 === "Qaz"): ?>
        // Activar mensaje de éxito
      Toast.fire({
        icon: 'success',
        title: 'Usuario Atualizado.'
      });
    <?php elseif ($mensaje2 === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Usuario no Actualizado.'
      });
    <?php endif; ?>
    <?php if ($mensaje3 === "Qaz"): ?>
        // Activar mensaje de éxito
      Toast.fire({
        icon: 'success',
        title: 'Usuario eliminado.'
      });
    <?php elseif ($mensaje3 === "Wer"): ?>
        // Activar mensaje de error
      Toast.fire({
        icon: 'error',
        title: 'Usuario no eliminado.'
      });
    <?php endif; ?>
  });
</script>
<script>
  // Función para abrir el modal y cargar los datos
  function abrirModalEditar(id, nombre, correo, password, rol) {
    // Cargar datos en el formulario
    document.getElementById('idUsuario').value = id;
    document.getElementById('editarNombreUsuario').value = nombre;
    document.getElementById('editarCorreoUsuario').value = correo;
    document.getElementById('editarRolUsuario').value = rol;
    document.getElementById('editarcontrasenaUsuario').value = password;

    // Mostrar el modal
    var modal = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
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
