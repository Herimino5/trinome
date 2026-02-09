<?php

use app\controllers\AdminController;
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