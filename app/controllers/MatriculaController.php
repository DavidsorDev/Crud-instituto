<?php
require_once __DIR__ . '/../models/Matricula.php';
require_once __DIR__ . '/../models/Alumno.php';
require_once __DIR__ . '/../models/Curso.php';

class MatriculaController
{
  public function index(): void
  {
    $matriculas = Matricula::allWithNames();
    require __DIR__ . '/../views/matriculas/index.php';
  }

  public function create(): void
  {
    $alumnos = Alumno::all();
    $cursos  = Curso::all();
    $error = '';
    require __DIR__ . '/../views/matriculas/create.php';
  }

  public function store(): void
  {
    try {
      $alumnoId = isset($_POST['alumno_id']) ? (int)$_POST['alumno_id'] : 0;
      $cursoId  = isset($_POST['curso_id']) ? (int)$_POST['curso_id'] : 0;
      $fecha    = isset($_POST['fecha']) ? (string)$_POST['fecha'] : '';

      Matricula::create($alumnoId, $cursoId, $fecha);

      header("Location: index.php?controller=matricula&action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();
      $alumnos = Alumno::all();
      $cursos  = Curso::all();
      require __DIR__ . '/../views/matriculas/create.php';
    }
  }

  public function edit(): void
  {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $matricula = Matricula::find($id);

    if ($matricula === null) {
      echo "Matrícula no encontrada";
      return;
    }

    $alumnos = Alumno::all();
    $cursos  = Curso::all();
    $error = '';
    require __DIR__ . '/../views/matriculas/edit.php';
  }

  public function update(): void
  {
    try {
      $id       = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $alumnoId = isset($_POST['alumno_id']) ? (int)$_POST['alumno_id'] : 0;
      $cursoId  = isset($_POST['curso_id']) ? (int)$_POST['curso_id'] : 0;
      $fecha    = isset($_POST['fecha']) ? (string)$_POST['fecha'] : '';

      Matricula::update($id, $alumnoId, $cursoId, $fecha);

      header("Location: index.php?controller=matricula&action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();

      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $matricula = Matricula::find($id);
      if ($matricula === null) {
        echo "Matrícula no encontrada";
        return;
      }

      $alumnos = Alumno::all();
      $cursos  = Curso::all();
      require __DIR__ . '/../views/matriculas/edit.php';
    }
  }

  public function delete(): void
  {
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      Matricula::delete($id);

      header("Location: index.php?controller=matricula&action=index");
      exit;
    } catch (Exception $e) {
      echo "No se pudo borrar: " . $e->getMessage();
    }
  }
}