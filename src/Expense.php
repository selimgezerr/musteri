<?php
require_once __DIR__ . '/Database.php';

class Expense
{
    public static function all()
    {
        $db = Database::getInstance();
        $stmt = $db->query('SELECT * FROM expenses');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('SELECT * FROM expenses WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('INSERT INTO expenses (description, amount, tx_date) VALUES (:description, :amount, :tx_date)');
        $stmt->execute([
            ':description' => $data['description'],
            ':amount' => $data['amount'],
            ':tx_date' => $data['tx_date'] ?? date('Y-m-d'),
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('UPDATE expenses SET description = :description, amount = :amount, tx_date = :tx_date WHERE id = :id');
        $stmt->execute([
            ':description' => $data['description'],
            ':amount' => $data['amount'],
            ':tx_date' => $data['tx_date'],
            ':id' => $id,
        ]);
    }

    public static function delete($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare('DELETE FROM expenses WHERE id = ?');
        $stmt->execute([$id]);
    }
}
