<?php
session_start();

class ConnectionDB
{
    private static $instance = null;
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=php_login_database', 'root', 'asdfg2');
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ConnectionDB();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
