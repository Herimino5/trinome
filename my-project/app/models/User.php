<?php
namespace app\models;

class User
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function create($username, $email, $phone, $password)
    {
        $sql = "INSERT INTO user (username, email, phone, password) 
                VALUES (:username, :email, :phone, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function findByUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        return $this->db->query("SELECT id, username, email, phone FROM user")
                        ->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Vérifie les identifiants d'un utilisateur par email
     */
    public function verif($email, $password)
    {
        $user = $this->findByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            // Ne pas retourner le mot de passe
            unset($user['password']);
            return $user;
        }
        
        return false;
    }
}
