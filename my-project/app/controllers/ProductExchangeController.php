<?php
namespace app\controllers;
use app\models\ProductExchange;
use app\models\ProductUser;
use Flight;
class ProductExchangeController {
    private $exchangeModel;
    private $productUserModel;
    public function __construct($pdo) {
        $this->exchangeModel = new ProductExchange($pdo);
        $this->productUserModel = new ProductUser($pdo);
    }

    // Proposer un échange
    public function propose() {
        session_start();
        $myproduct_id = $_POST['myproduct_id'] ?? null;
        $desiredproduct_id = $_POST['desiredproduct_id'] ?? null;
        if ($myproduct_id && $desiredproduct_id) {
            $this->exchangeModel->propose($myproduct_id, $desiredproduct_id);
            Flight::redirect('/products');
        } else {
            Flight::redirect('/products');
        }
    }

    // Voir les propositions reçues
    public function received() {
        session_start();
        $user_id = $_SESSION['user']['id'] ?? null;
        if (!$user_id) { Flight::redirect('/'); return; }
        $proposals = $this->exchangeModel->getReceivedProposals($user_id);
        Flight::render('exchange/received.php', ['proposals' => $proposals]);
    }

    // Accepter ou refuser
    public function updateStatus($id, $action) {
        // 2 = accepté, 3 = refusé
        $status_id = ($action === 'accept') ? 2 : 3;
        $this->exchangeModel->updateStatus($id, $status_id);
        if ($status_id === 2) {
            // Échanger les owners dans product_user
            $exchange = $this->exchangeModel->getById($id);
            if ($exchange) {
                $this->productUserModel->swapOwners($exchange['myproduct_id'], $exchange['desiredproduct_id']);
            }
        }
        Flight::redirect('/exchange/received');
    }
}
