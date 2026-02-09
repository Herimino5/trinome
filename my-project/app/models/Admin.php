<?php
namespace app\models;

class Admin
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function create($adminname, $password)
    {
        $sql = "INSERT INTO admin (adminname, password) VALUES (:adminname, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'adminname' => $adminname,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function findByName($adminname)
    {
        $sql = "SELECT * FROM admin WHERE adminname = :adminname";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['adminname' => $adminname]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
