<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar alumno</title>
</head>
<body>

<h1>Editar alumno</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=alumno&action=update">
  <input type="hidden" name="id" value="<?php echo (int)$alumno['id']; ?>">

  <p>
    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : $alumno['nombre']; ?>">
  </p>

  <p>
    Email:<br>
    <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $alumno['email']; ?>">
  </p>

  <button type="submit">Actualizar</button>
</form>

<p><a href="index.php?controller=alumno&action=index">Volver</a></p>

</body>
</html>