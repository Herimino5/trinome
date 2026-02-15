<?php

use app\controllers\AdminController;
use app\controllers\UserController;
use app\controllers\ProductExchangeController;
use app\controllers\ProductController;
use app\controllers\CategorieController;
use app\controllers\StatistiqueController;
use app\models\Categorie;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {
	$router->get('/', function() use ($app) {
		$app->render('index', []);
	});
	
	$router->get('/admin', function() use ($app) {
		$app->render('admin/index', []);
	});
	$router->post('/admin/login',[ AdminController::class, 'loginController' ]);
	$router->get('/admin/dashbord', function() use ($app) {
		$app->render('admin/dashbord', [ 'message' => 'Welcome to the admin dashboard!' ]);
	});
	
	// =============================================
	// Routes User (Login, Register, Logout)
	// =============================================
	$userController = new UserController($app);
	$router->get('/user/login', [ $userController, 'loginPage' ]);
	$router->post('/user/login', [ $userController, 'loginController' ]);
	$router->get('/user/register', [ $userController, 'registerPage' ]);
	$router->post('/user/register', [ $userController, 'registerController' ]);
	$router->get('/user/logout', [ $userController, 'logout' ]);

	// =============================================
	// Routes Admin Categories (CRUD)
	// =============================================
	$categorieController = new CategorieController($app->db());
	$router->get('/admin/categories', [ $categorieController, 'index' ]);
	$router->get('/admin/categories/create', [ $categorieController, 'create' ]);
	$router->post('/admin/categories/create', [ $categorieController, 'store' ]);
	$router->get('/admin/categories/edit/@id', [ $categorieController, 'edit' ]);
	$router->post('/admin/categories/update/@id', [ $categorieController, 'update' ]);
	$router->get('/admin/categories/delete/@id', [ $categorieController, 'delete' ]);

	// =============================================
	// Route Admin Statistiques
	// =============================================
	$statistiqueController = new StatistiqueController($app->db());
	$router->get('/admin/statistiques', [ $statistiqueController, 'index' ]);

	// =============================================
	// Routes Product (CRUD)
	// =============================================
	$productController = new ProductController($app->db());
	$exchangeController = new ProductExchangeController($app->db());
	$router->get('/exchange/accepted', [ $exchangeController, 'accepted' ]);
	$router->get('/products-with-owner', [ $productController, 'listWithOwner' ]);

	// Routes spécifiques AVANT les générales
	$router->get('/products/history/@id', [ $productController, 'history' ]);
	$router->get('/products/create', function() use ($app) {
		$categorieModel = new \app\models\Categorie($app->db());
		$categories = $categorieModel->getAll();
		$app->render('product/form.php', [ 'categories' => $categories ]);
	});
	$router->get('/products/edit/@id', function($id) use ($app) {
		$productModel = new \app\models\Product($app->db());
		$categorieModel = new \app\models\Categorie($app->db());
		$product = $productModel->getById($id);
		$categories = $categorieModel->getAll();
		$app->render('product/form.php', [ 'product' => $product, 'categories' => $categories ]);
	});
	$router->post('/products/update/@id', [ $productController, 'update' ]);
	$router->get('/products/delete/@id', [ $productController, 'delete' ]);

	// Liste des produits
	$router->get('/products', [ $productController, 'index' ]);

	// Créer un produit (traitement)
	$router->post('/products/create', [ $productController, 'create' ]);

	// Filtrer les produits par prix (±10%, ±20%)
	$router->get('/products/@id/filter/@percentage', [ $productController, 'filteredByPrice' ]);

	// Afficher un produit (détails) — doit être après les routes plus spécifiques
	$router->get('/products/@id', [ $productController, 'show' ]);

	// =============================================
	// Routes User Products
	// =============================================
	$router->get('/user/products', [ $productController, 'userProducts' ]);

	// =============================================
	// Routes Product Exchange
	// =============================================
	$router->post('/exchange/propose', [ $exchangeController, 'propose' ]);
	$router->get('/exchange/received', [ $exchangeController, 'received' ]);
	$router->post('/exchange/accept/@id', [ $exchangeController, 'accept' ]);
	$router->post('/exchange/reject/@id', [ $exchangeController, 'reject' ]);





















	// $router->get('/', function() use ($app) {
	// 	$app->render('welcome', [ 'message' => 'niova ve You are gonna do great things!' ]);
	// });

	// $router->get('/hello-world/@name', function($name) {
	// 	echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	// });

	// $router->get('/test-route',function() use ($app) {
	// 	echo '<h1>route iray afa</h1>';
	// });

	// $router->group('/api', function() use ($router) {
	// 	$router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
	// 	$router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
	// 	$router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
	// });
	
}, [ SecurityHeadersMiddleware::class ]);