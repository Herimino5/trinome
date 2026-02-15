<?php
namespace app\models;

class Statistique
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getExchangeCount()
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM product_exchange where status=2")->fetchColumn();
    }

    public function getUserCount()
    {
        return (int) $this->db->query("SELECT COUNT(*) FROM user")->fetchColumn();
    }
}
