<?php

use app\controllers\AdminController;
use app\controllers\ProductController;
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
		$app->render('admin/index', [ 'message' => 'Welcome to your FlightPHP app! You are gonna do great things!' ]);
	});
	$router->post('/admin/login',[ AdminController::class, 'loginController' ]);
	$router->get('/admin/dashbord', function() use ($app) {
		$app->render('admin/dashbord', [ 'message' => 'Welcome to the admin dashboard!' ]);
	});
	$router->get('/user/login', function() use ($app) {
		$app->render('user/login', [ 'message' => 'Welcome to the user login page!' ]);
	});

	// =============================================
	// Routes Product (CRUD)
	// =============================================
	$productController = new ProductController($app->db());

	// Liste des produits
	$router->get('/products', [ $productController, 'index' ]);

	// Formulaire de création (affichage)
	$router->get('/products/create', function() use ($app) {
		$categorieModel = new \app\models\Categorie($app->db());
		$categories = $categorieModel->getAll();
		$app->render('product/form.php', [ 'categories' => $categories ]);
	});

	// Créer un produit (traitement)
	$router->post('/products/create', [ $productController, 'create' ]);

	// Formulaire de modification (affichage)
	$router->get('/products/edit/@id', function($id) use ($app) {
		$productModel = new \app\models\Product($app->db());
		$categorieModel = new \app\models\Categorie($app->db());
		$product = $productModel->getById($id);
		$categories = $categorieModel->getAll();
		$app->render('product/form.php', [ 'product' => $product, 'categories' => $categories ]);
	});

	// Modifier un produit (traitement)
	$router->post('/products/update/@id', [ $productController, 'update' ]);

	// Supprimer un produit
	$router->get('/products/delete/@id', [ $productController, 'delete' ]);

	// Afficher un produit (détails) — doit être après les routes plus spécifiques
	$router->get('/products/@id', [ $productController, 'show' ]);





















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