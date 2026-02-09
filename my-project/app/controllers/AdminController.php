<?php

namespace app\controllers;

use flight\Engine;
use app\models\Admin;
use Flight;
class AdminController {

	protected Engine $app;

	public function __construct($app) {
		$this->app = $app;
	}

    public function loginController(){
        $adminname = $_POST['adminname'] ?? '';
        $password  = $_POST['password'] ?? '';

        $adminModel = new Admin(Flight::db());
        $verifiedAdmin = $adminModel->verif($adminname, $password);
        if ($verifiedAdmin) {
            session_start(); // Start the session if not already started
            // Set session variables or perform any other login logic
            $_SESSION['admin'] = $verifiedAdmin;
            $this->app->redirect('/admin/dashbord');
        } else {
            // Handle login failure
            $this->app->render('admin/index', [ 'error' => 'Invalid admin credentials.' ]);
        }
    }
	
}