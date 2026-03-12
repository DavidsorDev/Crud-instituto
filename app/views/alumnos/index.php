<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Alumnos</title>
</head>
<body>

<h1>Alumnos</h1>

<p>
  <a href="index.php?controller=alumno&action=create">Nuevo alumno</a> |
  <a href="index.php?controller=curso&action=index">Cursos</a> |
  <a href="index.php?controller=matricula&action=index">Matrículas</a>
</p>

<?php if (count($alumnos) === 0): ?>
  <p>No hay alumnos.</p>
<?php else: ?>
  <table border="1" cellpadding="6">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Email</th>
      <th>Acciones</th>
    </tr>
    <?php foreach ($alumnos as $a): ?>
      <tr>
        <td><?php echo (int)$a['id']; ?></td>
        <td><?php echo $a['nombre']; ?></td>
        <td><?php echo $a['email']; ?></td>
        <td>
          <a href="index.php?controller=alumno&action=edit&id=<?php echo (int)$a['id']; ?>">Editar</a>
          <form method="post" action="index.php?controller=alumno&action=delete" style="display:inline">
            <input type="hidden" name="id" value="<?php echo (int)$a['id']; ?>">
            <button type="submit">Borrar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

</body>
</html>