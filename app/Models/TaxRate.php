<?php

namespace App\Models;
use \PDO as PDO;

class TaxRate
{
    protected int $id;
    protected string $name;
    protected float $rate;
    protected int $tax_type;
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    
    public function setRate(float $rate): void
    {
        $this->rate = $rate;
    }
    
    public function setTaxType(int $tax_type): void
    {
        $this->tax_type = $tax_type;
    }

    public function addTaxRate(): int
    {
        $sql = "INSERT INTO tax_rates
                (name, rate, tax_type)
                VALUES (:name, :rate, :tax_type)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':rate', strval($this->rate), PDO::PARAM_STR);
        $stmt->bindValue(':tax_type', $this->tax_type, PDO::PARAM_INT);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function getTaxRates(): array | false
    {
        $sql = "SELECT * FROM tax_rates
                ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteById(): bool
    {
        $sql = "DELETE FROM tax_rates
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
