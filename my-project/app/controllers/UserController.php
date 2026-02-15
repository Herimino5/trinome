<?php

namespace app\controllers;

use flight\Engine;
use app\models\User;
use Flight;

class UserController {

	protected Engine $app;

	public function __construct($app) {
		$this->app = $app;
	}

	/**
	 * Affiche la page de login utilisateur
	 */
	public function loginPage() {
		$this->app->render('user/login', [ 'message' => 'Bienvenue! Connectez-vous à votre compte.' ]);
	}

	/**
	 * Traite la connexion utilisateur
	 */
	public function loginController() {
		$email = $_POST['email'] ?? '';
		$password = $_POST['password'] ?? '';

		$userModel = new User(Flight::db());
		$verifiedUser = $userModel->verif($email, $password);
		
		if ($verifiedUser) {
			session_start(); // Start the session if not already started
			// Set session variables
			$_SESSION['user'] = $verifiedUser;
			$this->app->redirect('products');
		} else {
			// Handle login failure
			$this->app->render('user/login', [ 'error' => 'Identifiants invalides. Veuillez réessayer.' ]);
		}
	}

	/**
	 * Déconnexion utilisateur
	 */
	public function logout() {
		session_start();
		unset($_SESSION['user']);
		session_destroy();
		$this->app->redirect('/');
	}

	/**
	 * Affiche la page d'inscription
	 */
	public function registerPage() {
		$this->app->render('user/register', []);
	}

	/**
	 * Traite l'inscription d'un nouvel utilisateur
	 */
	public function registerController() {
		$username = $_POST['username'] ?? '';
		$email = $_POST['email'] ?? '';
		$phone = $_POST['phone'] ?? '';
		$password = $_POST['password'] ?? '';
		$password_confirm = $_POST['password_confirm'] ?? '';

		// Validation
		$errors = [];

		if (empty($username) || empty($email) || empty($phone) || empty($password)) {
			$errors[] = "Tous les champs sont obligatoires.";
		}

		if ($password !== $password_confirm) {
			$errors[] = "Les mots de passe ne correspondent pas.";
		}

		if (strlen($password) < 6) {
			$errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "L'adresse email n'est pas valide.";
		}

		if (!preg_match('/^[0-9]{10}$/', $phone)) {
			$errors[] = "Le numéro de téléphone doit contenir exactement 10 chiffres.";
		}

		if (!empty($errors)) {
			$this->app->render('user/register', [ 'error' => implode(' ', $errors) ]);
			return;
		}

		// Créer l'utilisateur
		$userModel = new User(Flight::db());
		
		try {
			$result = $userModel->create($username, $email, $phone, $password);
			
			if ($result) {
				$this->app->render('user/login', [ 
					'message' => 'Inscription réussie ! Vous pouvez maintenant vous connecter avec votre email.' 
				]);
			} else {
				$this->app->render('user/register', [ 
					'error' => 'Une erreur est survenue lors de l\'inscription.' 
				]);
			}
		} catch (\PDOException $e) {
			// Gérer les erreurs de contrainte unique (email ou username déjà utilisé)
			if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
				$this->app->render('user/register', [ 
					'error' => 'Cet email, nom d\'utilisateur ou numéro de téléphone est déjà utilisé.' 
				]);
			} else {
				$this->app->render('user/register', [ 
					'error' => 'Une erreur est survenue lors de l\'inscription.' 
				]);
			}
		}
	}
}
