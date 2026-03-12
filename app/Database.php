<?php

class Database
{
  public static function pdo(): PDO
  {
    static $pdo = null;

    // Reutilizamos conexión (simple para clase)
    if ($pdo !== null) {
      return $pdo;
    }

    $c = require __DIR__ . '/../config/config.php';
    $dsn = "mysql:host={$c['host']};dbname={$c['db']};charset={$c['charset']}";

    $pdo = new PDO($dsn, $c['user'], $c['pass']);

    // Errores SQL como excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // fetch() devuelve arrays asociativos
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
  }
}