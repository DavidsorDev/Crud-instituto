<?php
require_once __DIR__ . '/../Database.php';

class Matricula
{
  public static function allWithNames(): array
  {
    // JOIN para mostrar nombres en lugar de IDs
    $sql = "
      SELECT
        m.id,
        m.fecha,
        m.alumno_id,
        m.curso_id,
        a.nombre AS alumno_nombre,
        a.email  AS alumno_email,
        c.nombre AS curso_nombre,
        c.nivel  AS curso_nivel
      FROM matriculas m
      INNER JOIN alumnos a ON a.id = m.alumno_id
      INNER JOIN cursos  c ON c.id = m.curso_id
      ORDER BY m.id DESC
    ";

    return Database::pdo()->query($sql)->fetchAll();
  }

  public static function find(int $id): ?array
  {
    $sql = "SELECT id, alumno_id, curso_id, fecha FROM matriculas WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();
    return $row ? $row : null;
  }

  public static function create(int $alumnoId, int $cursoId, string $fecha): void
  {
    if ($alumnoId <= 0) {
      throw new Exception("Alumno inválido.");
    }
    if ($cursoId <= 0) {
      throw new Exception("Curso inválido.");
    }
    if (trim($fecha) === '') {
      throw new Exception("La fecha es obligatoria.");
    }

    // UNIQUE(alumno_id, curso_id) evita duplicados
    $sql = "INSERT INTO matriculas (alumno_id, curso_id, fecha) VALUES (:a, :c, :f)";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':a' => $alumnoId,
      ':c' => $cursoId,
      ':f' => $fecha
    ]);
  }

  public static function update(int $id, int $alumnoId, int $cursoId, string $fecha): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }
    if ($alumnoId <= 0) {
      throw new Exception("Alumno inválido.");
    }
    if ($cursoId <= 0) {
      throw new Exception("Curso inválido.");
    }
    if (trim($fecha) === '') {
      throw new Exception("La fecha es obligatoria.");
    }

    $sql = "UPDATE matriculas SET alumno_id = :a, curso_id = :c, fecha = :f WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([
      ':id' => $id,
      ':a' => $alumnoId,
      ':c' => $cursoId,
      ':f' => $fecha
    ]);
  }

  public static function delete(int $id): void
  {
    if ($id <= 0) {
      throw new Exception("ID inválido.");
    }

    $sql = "DELETE FROM matriculas WHERE id = :id";
    $stmt = Database::pdo()->prepare($sql);
    $stmt->execute([':id' => $id]);
  }
}