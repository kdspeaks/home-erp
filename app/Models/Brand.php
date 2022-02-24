<?php

namespace App\Models;

use \PDO as PDO;

class Brand
{
    protected int $id;
    protected string $name;
    protected array $brands;
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
    public function setBrands(array $brands): void
    {
        $this->brands = $brands;
    }

    public function insertBrands(): int
    {
        $countQuery = "SELECT COUNT(id) FROM brands";
        $countStmt = $this->db->prepare($countQuery);
        $countStmt->execute();
        $old = $countStmt->fetch(PDO::FETCH_ASSOC)["COUNT(id)"];
        
        $numberOfBrands = count($this->brands);
        $placeholder = [];
        for($i=1; $i < $numberOfBrands + 1; $i++) {
            $placeholder[] = '(:name' . $i . ')';
        }
        $sql = "INSERT INTO brands
                (name) VALUES " . implode(', ', $placeholder);
        
        $stmt = $this->db->prepare($sql);

        for ($i = 1; $i < $numberOfBrands + 1; $i++) {
            $stmt->bindValue(':name' . $i, $this->brands[$i - 1], PDO::PARAM_STR);
        }

        $stmt->execute();
        $countStmt->execute();
        $new = $countStmt->fetch(PDO::FETCH_ASSOC)["COUNT(id)"];
        return $new - $old;
    }

    public function getBrands(): array | false
    {
        $sql = "SELECT * FROM brands
                ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteById(): bool
    {
        $sql = "DELETE FROM brands
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
