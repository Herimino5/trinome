<?php
namespace app\models;

class Product
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function create($name, $description, $price, $category_id)
    {
        $sql = "INSERT INTO product (name, description, price, category_id) 
                VALUES (:name, :description, :price, :category_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id
        ]);
    }

    public function getAll()
    {
        $sql = "SELECT p.*, c.name AS category_name 
                FROM product p 
                JOIN category c ON p.category_id = c.id";
        return $this->db->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM product WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM product WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public function update($id, $name, $description, $price, $category_id)
    {
        $sql = "UPDATE product 
                SET name = :name, description = :description, price = :price, category_id = :category_id 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id
        ]);
    }
}
