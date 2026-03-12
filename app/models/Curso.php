<?php
require_once __DIR__ . '/../Database.php';

class Curso
{
  public static function all(): array
  {
    $sql = "SELECT id, nombre, nivel FROM cursos ORDER BY id DESC";
    return Database::pdo()->query($sql)->fetchAll();
  }

  public static function find(int $id): ?array
  {
    $sql = "SELECT id, nombre, nivel FROM cursos WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    return $row ? $row : null;
  }

  public static function create(string $nombre, string $nivel): void
  {
    $nombre = trim($nombre);
    $nivel = trim($nivel);

    if ($nombre === '') {
      throw new Exception("El nombre del curso es obligatorio.");
    }
    if ($nivel === '') {
      throw new Exception("El nivel es obligatorio.");
    }

    $sql = "INSERT INTO cursos (nombre, nivel) VALUES (:n, :niv)";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':n' => $nombre,
      ':niv' => $nivel
    ]);
  }

  public static function update(int $id, string $nombre, string $nivel): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $nombre = trim($nombre);
    $nivel = trim($nivel);

    if ($nombre === '') {
      throw new Exception("El nombre del curso es obligatorio.");
    }
    if ($nivel === '') {
      throw new Exception("El nivel es obligatorio.");
    }

    $sql = "UPDATE cursos SET nombre = :n, nivel = :niv WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':n' => $nombre,
      ':niv' => $nivel
    ]);
  }

  public static function delete(int $id): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    // FK con ON DELETE CASCADE borra también sus matrículas
    $sql = "DELETE FROM cursos WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
  }
}