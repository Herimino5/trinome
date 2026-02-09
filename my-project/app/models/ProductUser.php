<?php
namespace app\models;
class ProductUser
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function create($product_id, $user_id)
    {
        $sql = "INSERT INTO product_user (product_id, user_id) VALUES (:product_id, :user_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'product_id' => $product_id,
            'user_id' => $user_id
        ]);
    }

    public function getByUserId($user_id)
    {
        $sql = "SELECT pu.*, p.name AS product_name 
                FROM product_user pu 
                JOIN product p ON pu.product_id = p.id 
                WHERE pu.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM product_user WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>