<?php

namespace App\Models;
use \PDO as PDO;
class User
{
    protected int $id;
    protected string $name;
    protected string $email;
    protected string $mobile;
    protected string $password;
    protected int $user_role;
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getByEmail(): array | false
    {
        $sql = "SELECT * FROM users
                WHERE email = :email";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
