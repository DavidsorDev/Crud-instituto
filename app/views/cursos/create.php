<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nuevo curso</title>
</head>
<body>

<h1>Nuevo curso</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=curso&action=store">
  <p>
    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
  </p>

  <p>
    Nivel:<br>
    <input type="text" name="nivel" placeholder="básico / intermedio / avanzado" value="<?php echo isset($_POST['nivel']) ? $_POST['nivel'] : ''; ?>">
  </p>

  <button type="submit">Guardar</button>
</form>

<p><a href="index.php?controller=curso&action=index">Volver</a></p>

</body>
</html>