<?php 
namespace app\controllers;
use app\models\Product;
use app\models\ProductUser;
use app\models\ProductExchange;
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
        session_start();
        $userId = $_SESSION['user']['id'] ?? null;
        $productModel = $this->productModel;
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;
        $total = $productModel->countWithOwner($userId);
        $products = $productModel->getWithOwner($perPage, $offset, $userId);
        $totalPages = ceil($total / $perPage);
        \Flight::render('product/list_with_owner.php', [
            'products' => $products,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function history($id) {
        $product = $this->productModel->getById($id);
        if (!$product) {
            Flight::render('error.php', ['message' => 'Produit introuvable']);
            return;
        }
        $exchangeModel = new ProductExchange(Flight::db());
        $rawHistory = $exchangeModel->getAcceptedHistoryByProduct($id);
        $history = [];
        foreach ($rawHistory as $row) {
            $isMyProduct = ((int) $row['myproduct_id'] === (int) $id);
            $history[] = [
                'exchanged_at' => $row['exchange_date'],
                'from_username' => $isMyProduct ? $row['proposer'] : $row['receiver'],
                'to_username' => $isMyProduct ? $row['receiver'] : $row['proposer']
            ];
        }
        Flight::render('product/history.php', [
            'product' => $product,
            'history' => $history
        ]);
    }

    // Liste des produits d'un utilisateur
    public function userProducts($user_id) {
        $userModel = new \app\models\User(Flight::db());
        $user = $userModel->getById($user_id);
        if (!$user) {
            Flight::render('error.php', ['message' => 'Utilisateur introuvable']);
            return;
        }
        $products = $this->productModel->getByUserId($user_id);
        Flight::render('product/user_products.php', ['products' => $products, 'user' => $user]);
    }

    // Afficher les produits filtrés par prix (±10%, ±20%)
    public function filteredByPrice($productId, $percentage) {
        session_start();
        
        // Récupérer le produit de référence
        $referenceProduct = $this->productModel->getById($productId);
        if (!$referenceProduct) {
            Flight::render('error.php', ['message' => 'Produit introuvable']);
            return;
        }
        
        $userId = $_SESSION['user']['id'] ?? null;
        
        // Récupérer les produits filtrés
        $filteredProducts = $this->productModel->getFilteredByPrice(
            $referenceProduct['price'], 
            $percentage, 
            $userId
        );
        
        Flight::render('product/filtered_by_price.php', [
            'referenceProduct' => $referenceProduct,
            'percentage' => $percentage,
            'filteredProducts' => $filteredProducts
        ]);
    }
}
?>
