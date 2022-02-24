<?php

namespace App\Models;
use \PDO as PDO;

class Database
{
    private ?PDO  $conn = null;
    private string $host;
    private string $name;
    private string $user;
    private string $password;
    
    public function __construct() {
        $this->host = DB_HOST;
        $this->name = DB_NAME;
        $this->user = DB_USER;
        $this->password = DB_PASS;
    }

    public function getConnection()
    {
        if ($this->conn === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->name};charset=utf8";

            $this->conn = new PDO($dsn, $this->user, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_STRINGIFY_FETCHES => false
            ]);
        }

        return $this->conn;
    }
}
