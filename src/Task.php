<?php
require_once __DIR__ . '/Database.php';

class Task
{
    public static function all()
    {
        $db = Database::getInstance();
        $stmt = $db->query('SELECT t.*, p.name AS project_name FROM tasks t LEFT JOIN projects p ON t.project_id = p.id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('INSERT INTO tasks (project_id, title, description, status, due_date) VALUES (:project_id, :title, :description, :status, :due_date)');
        $stmt->execute([
            ':project_id' => $data['project_id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':status' => $data['status'] ?? 'to-do',
            ':due_date' => $data['due_date'] ?? null,
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('UPDATE tasks SET project_id = :project_id, title = :title, description = :description, status = :status, due_date = :due_date WHERE id = :id');
        $stmt->execute([
            ':project_id' => $data['project_id'],
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':status' => $data['status'],
            ':due_date' => $data['due_date'],
            ':id' => $id,
        ]);
    }

    public static function delete($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('DELETE FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
    }
}
