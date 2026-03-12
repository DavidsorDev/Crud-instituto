<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nueva matrícula</title>
</head>
<body>

<h1>Nueva matrícula</h1>

<?php if ($error !== ''): ?>
  <p style="color:red"><?php echo $error; ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=matricula&action=store">
  <p>
    Alumno:<br>
    <select name="alumno_id">
      <option value="">-- Elige alumno --</option>
      <?php foreach ($alumnos as $a): ?>
        <?php
          $selected = (isset($_POST['alumno_id']) && (string)$_POST['alumno_id'] === (string)$a['id']) ? 'selected' : '';
        ?>
        <option value="<?php echo (int)$a['id']; ?>" <?php echo $selected; ?>>
          <?php echo $a['nombre']; ?> (<?php echo $a['email']; ?>)
        </option>
      <?php endforeach; ?>
    </select>
  </p>

  <p>
    Curso:<br>
    <select name="curso_id">
      <option value="">-- Elige curso --</option>
      <?php foreach ($cursos as $c): ?>
        <?php
          $selected = (isset($_POST['curso_id']) && (string)$_POST['curso_id'] === (string)$c['id']) ? 'selected' : '';
        ?>
        <option value="<?php echo (int)$c['id']; ?>" <?php echo $selected; ?>>
          <?php echo $c['nombre']; ?> (<?php echo $c['nivel']; ?>)
        </option>
      <?php endforeach; ?>
    </select>
  </p>

  <p>
    Fecha:<br>
    <input type="date" name="fecha" value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : ''; ?>">
  </p>

  <button type="submit">Guardar</button>
</form>

<p><a href="index.php?controller=matricula&action=index">Volver</a></p>

</body>
</html>