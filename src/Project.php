<?php
require_once __DIR__ . '/Database.php';

class Project
{
    public static function all()
    {
        $db = Database::getInstance();
        $stmt = $db->query('SELECT * FROM projects');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM projects WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('INSERT INTO projects (name, status) VALUES (:name, :status)');
        $stmt->execute([
            ':name' => $data['name'],
            ':status' => $data['status'] ?? 'devam ediyor',
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('UPDATE projects SET name = :name, status = :status WHERE id = :id');
        $stmt->execute([
            ':name' => $data['name'],
            ':status' => $data['status'],
            ':id' => $id,
        ]);
    }

    public static function delete($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('DELETE FROM projects WHERE id = ?');
        $stmt->execute([$id]);
    }
}
