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
    public function getWithOwner($limit = 10, $offset = 0, $excludeUserId = null) {
        $sql = "SELECT * FROM product_with_owner";
        if ($excludeUserId !== null) {
            $sql .= " WHERE user_id <> :exclude_user_id";
        }
        $sql .= " LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        if ($excludeUserId !== null) {
            $stmt->bindValue(':exclude_user_id', $excludeUserId, \PDO::PARAM_INT);
        }
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function countWithOwner($excludeUserId = null) {
        if ($excludeUserId === null) {
            return $this->db->query('SELECT COUNT(*) FROM product_with_owner')->fetchColumn();
        }
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM product_with_owner WHERE user_id <> :exclude_user_id');
        $stmt->execute(['exclude_user_id' => $excludeUserId]);
        return $stmt->fetchColumn();
    }

    public function getByUserId($userId) {
        $sql = "SELECT p.id AS product_id, p.name AS product_name, p.description, p.price, p.product_image,
                       c.name AS category_name
                FROM product p
                JOIN category c ON p.category_id = c.id
                JOIN product_user pu ON p.id = pu.product_id
                WHERE pu.user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Récupérer les produits filtrés par prix (±10%, ±20%)
    public function getFilteredByPrice($referencePrice, $percentage, $excludeUserId = null) {
        $minPrice = $referencePrice * (1 - $percentage / 100);
        $maxPrice = $referencePrice * (1 + $percentage / 100);
        
        $sql = "SELECT DISTINCT p.*, c.name AS category_name, pu.user_id
                FROM product p
                JOIN category c ON p.category_id = c.id
                JOIN product_user pu ON p.id = pu.product_id
                WHERE p.price >= :minPrice AND p.price <= :maxPrice";
        
        if ($excludeUserId !== null) {
            $sql .= " AND pu.user_id <> :excludeUserId";
        }
        
        $sql .= " ORDER BY p.price ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':minPrice', $minPrice);
        $stmt->bindValue(':maxPrice', $maxPrice);
        
        if ($excludeUserId !== null) {
            $stmt->bindValue(':excludeUserId', $excludeUserId);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Rechercher des produits par mot-clé et/ou catégorie (pour l'utilisateur connecté)
    public function searchByUserProducts($userId, $keyword = '', $categoryId = null) {
        $sql = "SELECT p.*, c.name AS category_name
                FROM product p
                JOIN category c ON p.category_id = c.id
                JOIN product_user pu ON p.id = pu.product_id
                WHERE pu.user_id = :user_id";
        
        $params = ['user_id' => $userId];
        
        if (!empty($keyword)) {
            $sql .= " AND p.name LIKE :keyword";
            $params['keyword'] = '%' . $keyword . '%';
        }
        
        if ($categoryId !== null && $categoryId !== '' && $categoryId > 0) {
            $sql .= " AND p.category_id = :category_id";
            $params['category_id'] = $categoryId;
        }
        
        $sql .= " ORDER BY p.id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Rechercher tous les produits par mot-clé et/ou catégorie (tous les propriétaires)
    public function searchAllProducts($keyword = '', $categoryId = null) {
        $sql = "SELECT p.*, c.name AS category_name, u.username AS owner_username
                FROM product p
                JOIN category c ON p.category_id = c.id
                JOIN product_user pu ON p.id = pu.product_id
                JOIN user u ON pu.user_id = u.id
                WHERE 1=1";
        
        $params = [];
        
        if (!empty($keyword)) {
            $sql .= " AND p.name LIKE :keyword";
            $params['keyword'] = '%' . $keyword . '%';
        }
        
        if ($categoryId !== null && $categoryId !== '' && $categoryId > 0) {
            $sql .= " AND p.category_id = :category_id";
            $params['category_id'] = $categoryId;
        }
        
        $sql .= " ORDER BY p.id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
