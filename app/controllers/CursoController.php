<?php
require_once __DIR__ . '/../models/Curso.php';

class CursoController
{
  public function index(): void
  {
    $cursos = Curso::all();
    require __DIR__ . '/../views/cursos/index.php';
  }

  public function create(): void
  {
    $error = '';
    require __DIR__ . '/../views/cursos/create.php';
  }

  public function store(): void
  {
    try {
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $nivel  = isset($_POST['nivel']) ? (string)$_POST['nivel'] : '';

      Curso::create($nombre, $nivel);

      header("Location: index.php?controller=curso&action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();
      require __DIR__ . '/../views/cursos/create.php';
    }
  }

  public function edit(): void
  {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $curso = Curso::find($id);

    if ($curso === null) {
      echo "Curso no encontrado";
      return;
    }

    $error = '';
    require __DIR__ . '/../views/cursos/edit.php';
  }

  public function update(): void
  {
    try {
      $id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $nivel  = isset($_POST['nivel']) ? (string)$_POST['nivel'] : '';

      Curso::update($id, $nombre, $nivel);

      header("Location: index.php?controller=curso&action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();

      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $curso = Curso::find($id);
      if ($curso === null) {
        echo "Curso no encontrado";
        return;
      }

      require __DIR__ . '/../views/cursos/edit.php';
    }
  }

  public function delete(): void
  {
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      Curso::delete($id);

      header("Location: index.php?controller=curso&action=index");
      exit;
    } catch (Exception $e) {
      echo "No se pudo borrar: " . $e->getMessage();
    }
  }
}