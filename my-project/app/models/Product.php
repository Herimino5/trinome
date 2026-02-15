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
        $result = $stmt->execute([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $category_id
        ]);
        if ($result) {
            return $this->db->lastInsertId();
        }
        return false;
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

    // Récupérer les produits avec propriétaire (vue SQL)
    public function getWithOwner($limit = 10, $offset = 0) {
        $sql = "SELECT * FROM product_with_owner LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function countWithOwner() {
        return $this->db->query('SELECT COUNT(*) FROM product_with_owner')->fetchColumn();
    }
}
