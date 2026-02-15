<?php

use app\controllers\AdminController;
use app\controllers\UserController;
use app\controllers\ProductController;
use app\controllers\ProductExchangeController;
use app\models\Categorie;
use app\models\Product;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;

/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {
	// =============================================
	// Route de login utilisateur (page d'accueil)
	// =============================================
	$userController = new UserController($app);
	
	$router->get('/', [ $userController, 'loginPage' ]);
	$router->post('/user/login', [ $userController, 'loginController' ]);
	$router->get('/user/logout', [ $userController, 'logout' ]);
	
	// Routes d'inscription
	$router->get('/user/register', [ $userController, 'registerPage' ]);
	$router->post('/user/register', [ $userController, 'registerController' ]);

	// =============================================
	// Routes Admin
	// =============================================
	$adminController = new AdminController($app);
	
	$router->get('/admin', function() use ($app) {
		$app->render('admin/index', [ 'message' => 'Connexion administrateur' ]);
	});
	$router->post('/admin/login', [ $adminController, 'loginController' ]);
	$router->get('/admin/dashbord', function() use ($app) {
		$app->render('admin/dashbord', [ 'message' => 'Welcome to the admin dashboard!' ]);
	});

	// =============================================
	// Routes Product (CRUD)
	// =============================================
	$productController = new ProductController($app->db());

	// Liste des produits
	$router->get('/products', [ $productController, 'index' ]);

	// Liste des produits avec leur propriétaire
	$router->get('/products-with-owner', [ $productController, 'listWithOwner' ]);

	// Liste des produits d'un utilisateur
	$router->get('/user/@id/products', [ $productController, 'userProducts' ]);

	// Formulaire de création (affichage)
	$router->get('/products/create', function() use ($app) {
		$categorieModel = new app\models\Categorie($app->db());
		$categories = $categorieModel->getAll();
		$app->render('product/form.php', [ 'categories' => $categories ]);
	});

	// Créer un produit (traitement)
	$router->post('/products/create', [ $productController, 'create' ]);

	// Formulaire de modification (affichage)
	$router->get('/products/edit/@id', function($id) use ($app) {
		$productModel = new Product($app->db());
		$categorieModel = new Categorie($app->db());
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

	// Gestion des échanges
	$exchangeController = new \app\controllers\ProductExchangeController($app->db());
	$router->post('/exchange/propose', [ $exchangeController, 'propose' ]);
	$router->get('/exchange/received', [ $exchangeController, 'received' ]);
	$router->get('/exchange/accept/@id', function($id) use ($exchangeController) {
		$exchangeController->updateStatus($id, 'accept');
	});
	$router->get('/exchange/refuse/@id', function($id) use ($exchangeController) {
		$exchangeController->updateStatus($id, 'refuse');
	});


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