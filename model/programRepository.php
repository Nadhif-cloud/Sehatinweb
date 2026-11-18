<?php

class ProgramRepository
{
    private PDO $database;

    public function __construct()
    {
        $dsn = getenv('DB_DSN') ?: 'mysql:host=127.0.0.1;dbname=sehatin;charset=utf8mb4';
        $username = getenv('DB_USERNAME') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';

        $this->database = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        $this->database->exec(
            'CREATE TABLE IF NOT EXISTS programs (
                id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                nama VARCHAR(255) NOT NULL,
                deskripsi TEXT NOT NULL,
                created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }

    public function all(): array
    {
        return $this->database->query('SELECT id, nama, deskripsi FROM programs ORDER BY id')->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->database->prepare('SELECT id, nama, deskripsi FROM programs WHERE id = :id');
        $statement->execute(['id' => $id]);
        $program = $statement->fetch();

        return $program === false ? null : $program;
    }

    public function create(string $nama, string $deskripsi): void
    {
        $statement = $this->database->prepare(
            'INSERT INTO programs (nama, deskripsi, created_at, updated_at) VALUES (:nama, :deskripsi, NOW(), NOW())'
        );
        $statement->execute(['nama' => $nama, 'deskripsi' => $deskripsi]);
    }

    public function update(int $id, string $nama, string $deskripsi): bool
    {
        $statement = $this->database->prepare(
            'UPDATE programs SET nama = :nama, deskripsi = :deskripsi, updated_at = NOW() WHERE id = :id'
        );
        $statement->execute(['id' => $id, 'nama' => $nama, 'deskripsi' => $deskripsi]);

        return $statement->rowCount() > 0 || $this->find($id) !== null;
    }

    public function delete(int $id): bool
    {
        $statement = $this->database->prepare('DELETE FROM programs WHERE id = :id');
        $statement->execute(['id' => $id]);

        return $statement->rowCount() > 0;
    }
}
