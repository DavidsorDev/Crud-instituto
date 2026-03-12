<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar curso</title>
</head>
<body>

<h1>Editar curso</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=curso&action=update">
  <input type="hidden" name="id" value="<?php echo (int)$curso['id']; ?>">

  <p>
    Nombre:<br>
    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : $curso['nombre']; ?>">
  </p>

  <p>
    Nivel:<br>
    <input type="text" name="nivel" value="<?php echo isset($_POST['nivel']) ? $_POST['nivel'] : $curso['nivel']; ?>">
  </p>

  <button type="submit">Actualizar</button>
</form>

<p><a href="index.php?controller=curso&action=index">Volver</a></p>

</body>
</html>

----------------------------------------
7.7) app\views\matriculas\index.php
----------------------------------------
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Matrículas</title>
</head>
<body>

<h1>Matrículas (N:N)</h1>

<p>
  <a href="index.php?controller=matricula&action=create">Nueva matrícula</a> |
  <a href="index.php?controller=alumno&action=index">Alumnos</a> |
  <a href="index.php?controller=curso&action=index">Cursos</a>
</p>

<?php if (count($matriculas) === 0): ?>
  <p>No hay matrículas.</p>
<?php else: ?>
  <table border="1" cellpadding="6">
    <tr>
      <th>ID</th>
      <th>Alumno</th>
      <th>Curso</th>
      <th>Fecha</th>
      <th>Acciones</th>
    </tr>

    <?php foreach ($matriculas as $m): ?>
      <tr>
        <td><?php echo (int)$m['id']; ?></td>
        <td><?php echo $m['alumno_nombre']; ?> (<?php echo $m['alumno_email']; ?>)</td>
        <td><?php echo $m['curso_nombre']; ?> (<?php echo $m['curso_nivel']; ?>)</td>
        <td><?php echo $m['fecha']; ?></td>
        <td>
          <a href="index.php?controller=matricula&action=edit&id=<?php echo (int)$m['id']; ?>">Editar</a>
          <form method="post" action="index.php?controller=matricula&action=delete" style="display:inline">
            <input type="hidden" name="id" value="<?php echo (int)$m['id']; ?>">
            <button type="submit">Borrar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

</body>
</html>