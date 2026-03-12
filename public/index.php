<?php
// Controlador por defecto
$controllerName = isset($_GET['controller']) ? (string)$_GET['controller'] : 'alumno';
// Acción por defecto
$action = isset($_GET['action']) ? (string)$_GET['action'] : 'index';

// alumno -> AlumnoController, curso -> CursoController, matricula -> MatriculaController
$className = ucfirst($controllerName) . 'Controller';

// Archivo del controlador correspondiente
$file = __DIR__ . '/../app/controllers/' . $className . '.php';

if (!file_exists($file)) {
  echo "Controlador no encontrado";
  exit;
}

require_once $file;

// Creamos el controlador
$controller = new $className();

// Ejecutamos la acción
if (!method_exists($controller, $action)) {
  echo "Acción no encontrada";
  exit;
}

$controller->$action();