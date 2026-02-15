<?php 
namespace app\controllers;
use app\models\Product;
use app\models\ProductUser;
use Flight;
class ProductController {
    private $productModel;
    private $productUserModel;

    public function __construct($pdo) {
        $this->productModel = new Product($pdo);
        $this->productUserModel = new ProductUser($pdo);
    }

    // Créer un produit
    public function create() {
        session_start();
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $category_id = $_POST['category_id'] ?? 0;
        $product_image = $_POST['product_image'] ?? '';

        $user_id = $_SESSION['user']['id'] ?? null;
        if (!$user_id) {
            Flight::redirect('/');
            return;
        }

        // Créer le produit et récupérer son id
        $product_id = $this->productModel->create($name, $description, $price, $category_id);
        if ($product_id) {
            // Associer le produit à l'utilisateur
            $this->productUserModel->create($product_id, $user_id);
            Flight::redirect('/products');
        } else {
            Flight::render('error.php', ['message' => 'Erreur lors de la création du produit']);
        }
    }

    // Liste des produits (uniquement ceux de l'utilisateur connecté)
    public function index() {
        session_start();
        if (!isset($_SESSION['user']['id'])) {
            Flight::redirect('/');
            return;
        }
        $user_id = $_SESSION['user']['id'];
        $pdo = Flight::db();
        $sql = "SELECT p.*, c.name AS category_name
                FROM product p
                JOIN category c ON p.category_id = c.id
                JOIN product_user pu ON p.id = pu.product_id
                WHERE pu.user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        Flight::render('product/index.php', ['products' => $products]);
    }

    // Afficher un produit
    public function show($id) {
        session_start();
        $product = $this->productModel->getById($id);
        $myProducts = [];
        if (isset($_SESSION['user']['id'])) {
            $user_id = $_SESSION['user']['id'];
            $pdo = Flight::db();
            $sql = "SELECT p.id, p.name FROM product p JOIN product_user pu ON p.id = pu.product_id WHERE pu.user_id = :uid AND p.id != :pid";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['uid' => $user_id, 'pid' => $id]);
            $myProducts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        Flight::render('product/show.php', ['product' => $product, 'myProducts' => $myProducts]);
    }

    // Supprimer un produit
    public function delete($id) {
        if ($this->productModel->delete($id)) {
            Flight::redirect('/products');
        } else {
            Flight::render('error.php', ['message' => 'Erreur lors de la suppression']);
        }
    }

    // Modifier un produit
    public function update($id) {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $category_id = $_POST['category_id'] ?? 0;
        $product_image = $_POST['product_image'] ?? '';

        if ($this->productModel->update($id, $name, $description, $price, $category_id, $product_image)) {
            Flight::redirect('/products');
        } else {
            Flight::render('error.php', ['message' => 'Erreur lors de la mise à jour']);
        }
    }

    // Liste des produits avec leur propriétaire (vue + pagination)
    public function listWithOwner() {
        $productModel = $this->productModel;
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;
        $total = $productModel->countWithOwner();
        $products = $productModel->getWithOwner($perPage, $offset);
        $totalPages = ceil($total / $perPage);
        \Flight::render('product/list_with_owner.php', [
            'products' => $products,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    // Liste des produits d'un utilisateur
    public function userProducts($user_id) {
        $pdo = Flight::db();
        $sql = "SELECT p.id AS product_id, p.name AS product_name, p.description, p.price, p.product_image,
                       c.name AS category_name
                FROM product p
                JOIN category c ON p.category_id = c.id
                JOIN product_user pu ON p.id = pu.product_id
                WHERE pu.user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $products = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        // Récupérer info utilisateur
        $userStmt = $pdo->prepare("SELECT * FROM user WHERE id = :id");
        $userStmt->execute(['id' => $user_id]);
        $user = $userStmt->fetch(\PDO::FETCH_ASSOC);
        Flight::render('product/user_products.php', ['products' => $products, 'user' => $user]);
    }
}
?>
