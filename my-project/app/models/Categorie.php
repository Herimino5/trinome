<?php
namespace app\models;

class Category
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function create($name, $description, $image)
    {
        $sql = "INSERT INTO category (name, description, image_) 
                VALUES (:name, :description, :image)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $name,
            'description' => $description,
            'image' => $image
        ]);
    }

    public function getAll()
    {
        return $this->db->query("SELECT * FROM category")
                        ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM category WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
