<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nuevo alumno</title>
</head>
<body>

<h1>Nuevo alumno</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=alumno&action=store">
  <p>
    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
  </p>

  <p>
    Email:<br>
    <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
  </p>

  <button type="submit">Guardar</button>
</form>

<p><a href="index.php?controller=alumno&action=index">Volver</a></p>

</body>
</html>