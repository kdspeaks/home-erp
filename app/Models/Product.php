<?php

namespace App\Models;
use \PDO as PDO;
class Product
{
    protected int $id;
    protected string $name;
    protected int $brand_id;
    protected int $tax_rate_id;
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
    
    public function setBrandId(int $brand_id): void
    {
        $this->brand_id = $brand_id;
    }
    
    public function setTaxRateId(int $tax_rate_id): void
    {
        $this->tax_rate_id = $tax_rate_id;
    }

    public function getAllProducts(): array | false
    {
        $sql = "SELECT products.id, products.name, products.brand_id,   products.tax_rate_id, brands.id as brandId, brands.name as brandName, tax_rates.id as taxId, tax_rates.name as taxName  FROM products
                LEFT JOIN brands
                ON products.brand_id = brands.id
                LEFT JOIN tax_rates
                ON products.tax_rate_id = tax_rates.id
                ORDER BY products.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduct(): int
    {
        $sql = "INSERT INTO products
                (name, brand_id, tax_rate_id)
                VALUES (:name, :brand_id, :tax_rate_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':brand_id', $this->brand_id, PDO::PARAM_INT);
        $stmt->bindValue(':tax_rate_id', $this->tax_rate_id, PDO::PARAM_INT);

        $stmt->execute();

        //Get the product id so that we can insert the variant info
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function deleteById(): bool
    {
        $sql = "DELETE FROM products
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
