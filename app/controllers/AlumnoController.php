<?php
require_once __DIR__ . '/../models/Alumno.php';

class AlumnoController
{
  public function index(): void
  {
    $alumnos = Alumno::all();
    require __DIR__ . '/../views/alumnos/index.php';
  }

  public function create(): void
  {
    $error = '';
    require __DIR__ . '/../views/alumnos/create.php';
  }

  public function store(): void
  {
    try {
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $email  = isset($_POST['email']) ? (string)$_POST['email'] : '';

      Alumno::create($nombre, $email);

      header("Location: index.php?controller=alumno&action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();
      require __DIR__ . '/../views/alumnos/create.php';
    }
  }

  public function edit(): void
  {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $alumno = Alumno::find($id);

    if ($alumno === null) {
      echo "Alumno no encontrado";
      return;
    }

    $error = '';
    require __DIR__ . '/../views/alumnos/edit.php';
  }

  public function update(): void
  {
    try {
      $id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $nombre = isset($_POST['nombre']) ? (string)$_POST['nombre'] : '';
      $email  = isset($_POST['email']) ? (string)$_POST['email'] : '';

      Alumno::update($id, $nombre, $email);

      header("Location: index.php?controller=alumno&action=index");
      exit;
    } catch (Exception $e) {
      $error = $e->getMessage();

      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      $alumno = Alumno::find($id);
      if ($alumno === null) {
        echo "Alumno no encontrado";
        return;
      }

      require __DIR__ . '/../views/alumnos/edit.php';
    }
  }

  public function delete(): void
  {
    try {
      $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      Alumno::delete($id);

      header("Location: index.php?controller=alumno&action=index");
      exit;
    } catch (Exception $e) {
      echo "No se pudo borrar: " . $e->getMessage();
    }
  }
}