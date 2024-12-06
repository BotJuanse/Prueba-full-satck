<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Master</title>
  <link rel="icon" href="img/taskmaster.ico" type="image/x-icon">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css'>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
  <div class="card shadow-sm p-4 rounded" style="max-width: 400px; width: 100%;">
    <div class="text-center mb-4">
      <img src="img/taskmaster.png" class="brand-image img-circle elevation-3 mb-3" style="width: 80px; opacity: 0.8;">
      <h3 class="task-master">Task Master</h3>
    </div>
    <form action="registrar.php" method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Nombre Completo</label>
        <input type="text" class="form-control" id="name" name="registroNombre" placeholder="Ingrese su nombre completo" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" name="registroEmail" placeholder="Ingrese su correo" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="registroPassword" placeholder="Ingrese su contraseña" required>
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">Registrarse</button>
      </div>
    </form>
    <div class="text-center mt-4">
      <a href="index.php" class="text-decoration-none">¿Ya tienes una cuenta? Inicia sesión</a>
    </div>
    <div class="text-center mt-2">
      <span class="text-infomation">Creado por Sebastian Peñaloza</span>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js'></script>
</body>
</html>
