<?php
namespace app\models;
class ProductExchange {
    private $db;
    public function __construct($pdo) { $this->db = $pdo; }

    public function propose($myproduct_id, $desiredproduct_id) {
        $sql = "INSERT INTO product_exchange (myproduct_id, desiredproduct_id, exchange_date, id_status) VALUES (:my, :desired, NOW(), 1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['my' => $myproduct_id, 'desired' => $desiredproduct_id]);
    }

    public function getReceivedProposals($user_id) {
        $sql = "SELECT * FROM exchange_received_view WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function updateStatus($exchange_id, $status_id) {
        $sql = "UPDATE product_exchange SET id_status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['status' => $status_id, 'id' => $exchange_id]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM product_exchange WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
