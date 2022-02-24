<?php

namespace App\Models;
use \PDO as PDO;

class ProductVariant
{
    protected int $id;
    protected int $product_id;
    protected string $power;
    protected string $package;
    protected float $purchase_price;
    protected float $sale_price;
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }
    
    public function setPower(string $power): void
    {
        $this->power = $power;
    }
    
    public function setPackage(string $package): void
    {
        $this->package = $package;
    }
    
    public function setPurchasePrice(float $purchase_price): void
    {
        $this->purchase_price = $purchase_price;
    }
    
    public function setSalePrice(float $sale_price): void
    {
        $this->sale_price = $sale_price;
    }

    public function addProductVariant(): int
    {
        $sql = "INSERT INTO product_variants
                (product_id, power, package, purchase_price, sale_price)
                VALUES (:product_id, :power, :package, :purchase_price, :sale_price)";
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(':product_id', $this->product_id, PDO::PARAM_INT);
        $stmt->bindValue(':power', $this->power, PDO::PARAM_STR);
        $stmt->bindValue(':package', $this->package, PDO::PARAM_STR);
        $stmt->bindValue(':purchase_price', strval($this->purchase_price), PDO::PARAM_STR);
        $stmt->bindValue(':sale_price', strval($this->sale_price), PDO::PARAM_STR);

        $stmt->execute();
        return $this->db->lastInsertId();
    }
}
