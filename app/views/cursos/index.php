<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Cursos</title>
</head>
<body>

<h1>Cursos</h1>

<p>
  <a href="index.php?controller=curso&action=create">Nuevo curso</a> |
  <a href="index.php?controller=alumno&action=index">Alumnos</a> |
  <a href="index.php?controller=matricula&action=index">Matrículas</a>
</p>

<?php if (count($cursos) === 0): ?>
  <p>No hay cursos.</p>
<?php else: ?>
  <table border="1" cellpadding="6">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Nivel</th>
      <th>Acciones</th>
    </tr>
    <?php foreach ($cursos as $c): ?>
      <tr>
        <td><?php echo (int)$c['id']; ?></td>
        <td><?php echo $c['nombre']; ?></td>
        <td><?php echo $c['nivel']; ?></td>
        <td>
          <a href="index.php?controller=curso&action=edit&id=<?php echo (int)$c['id']; ?>">Editar</a>
          <form method="post" action="index.php?controller=curso&action=delete" style="display:inline">
            <input type="hidden" name="id" value="<?php echo (int)$c['id']; ?>">
            <button type="submit">Borrar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>

</body>
</html>