<?php
require_once __DIR__ . '/../Database.php';

class Alumno
{
  public static function all(): array
  {
    $sql = "SELECT id, nombre, email FROM alumnos ORDER BY id DESC";
    return Database::pdo()->query($sql)->fetchAll();
  }

  public static function find(int $id): ?array
  {
    $sql = "SELECT id, nombre, email FROM alumnos WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    return $row ? $row : null;
  }

  public static function create(string $nombre, string $email): void
  {
    $nombre = trim($nombre);
    $email = trim($email);

    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    }
    if ($email === '') {
      throw new Exception("El email es obligatorio.");
    }

    $sql = "INSERT INTO alumnos (nombre, email) VALUES (:n, :e)";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':n' => $nombre,
      ':e' => $email
    ]);
  }

  public static function update(int $id, string $nombre, string $email): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $nombre = trim($nombre);
    $email = trim($email);

    if ($nombre === '') {
      throw new Exception("El nombre es obligatorio.");
    }
    if ($email === '') {
      throw new Exception("El email es obligatorio.");
    }

    $sql = "UPDATE alumnos SET nombre = :n, email = :e WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':n' => $nombre,
      ':e' => $email
    ]);
  }

  public static function delete(int $id): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    // FK con ON DELETE CASCADE borra también sus matrículas
    $sql = "DELETE FROM alumnos WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
  }
}