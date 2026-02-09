<?php 
namespace app\controllers;
use app\models\Product;
use app\models\ProductUser;

class ProductController {
    private $productModel;
    private $productUserModel;

    public function __construct($pdo) {
        $this->productModel = new Product($pdo);
        $this->productUserModel = new ProductUser($pdo);
    }

    // Créer un produit
    public function create() {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $category_id = $_POST['category_id'] ?? 0;
        $product_image = $_POST['product_image'] ?? '';

        if ($this->productModel->create($name, $description, $price, $category_id, $product_image)) {
            Flight::redirect('/products');
        } else {
            Flight::render('error.php', ['message' => 'Erreur lors de la création du produit']);
        }
    }

    // Liste des produits
    public function index() {
        $products = $this->productModel->getAll();
        Flight::render('product/index.php', ['products' => $products]);
    }

    // Afficher un produit
    public function show($id) {
        $product = $this->productModel->getById($id);
        Flight::render('product/show.php', ['product' => $product]);
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
}
?>
