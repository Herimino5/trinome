<?php
namespace app\controllers;

use app\models\Categorie;
use Flight;

class CategorieController {
    private $categorieModel;

    public function __construct($pdo) {
        $this->categorieModel = new Categorie($pdo);
    }

    public function index() {
        $categories = $this->categorieModel->getAll();
        Flight::render('admin/categories/index.php', ['categories' => $categories]);
    }

    public function create() {
        Flight::render('admin/categories/form.php');
    }

    public function store() {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $image = $_POST['image'] ?? '';

        if ($this->categorieModel->create($name, $description, $image)) {
            Flight::redirect('/admin/categories');
            return;
        }

        Flight::render('error.php', ['message' => 'Erreur lors de la creation de la categorie']);
    }

    public function edit($id) {
        $category = $this->categorieModel->getById($id);
        if (!$category) {
            Flight::render('error.php', ['message' => 'Categorie introuvable']);
            return;
        }
        Flight::render('admin/categories/form.php', ['category' => $category]);
    }

    public function update($id) {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $image = $_POST['image'] ?? '';

        if ($this->categorieModel->update($id, $name, $description, $image)) {
            Flight::redirect('/admin/categories');
            return;
        }

        Flight::render('error.php', ['message' => 'Erreur lors de la mise a jour de la categorie']);
    }

    public function delete($id) {
        if ($this->categorieModel->delete($id)) {
            Flight::redirect('/admin/categories');
            return;
        }

        Flight::render('error.php', ['message' => 'Erreur lors de la suppression de la categorie']);
    }
}
