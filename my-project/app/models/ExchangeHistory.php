<?php
namespace app\models;

class ExchangeHistory
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function create($exchangeId, $productId, $fromUserId, $toUserId, $exchangedAt)
    {
        $sql = "INSERT INTO product_exchange_history (exchange_id, product_id, from_user_id, to_user_id, exchanged_at)
                VALUES (:exchange_id, :product_id, :from_user_id, :to_user_id, :exchanged_at)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'exchange_id' => $exchangeId,
            'product_id' => $productId,
            'from_user_id' => $fromUserId,
            'to_user_id' => $toUserId,
            'exchanged_at' => $exchangedAt
        ]);
    }

    public function getByProduct($productId)
    {
        $sql = "SELECT h.*, uf.username AS from_username, ut.username AS to_username
                FROM product_exchange_history h
                JOIN user uf ON h.from_user_id = uf.id
                JOIN user ut ON h.to_user_id = ut.id
                WHERE h.product_id = :product_id
                ORDER BY h.exchanged_at DESC, h.id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
