<?php
class Database
{
    protected static $instance = null;

    public static function getInstance()
    {
        if (self::$instance === null) {
            $config = include __DIR__ . '/../config/database.php';
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8mb4', $config['host'], $config['dbname']);
            try {
                self::$instance = new PDO($dsn, $config['user'], $config['pass']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('DB Error: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
