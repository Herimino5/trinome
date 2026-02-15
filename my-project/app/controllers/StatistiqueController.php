<?php
namespace app\controllers;

use app\models\Statistique;
use Flight;

class StatistiqueController
{
    private $statModel;

    public function __construct($pdo)
    {
        $this->statModel = new Statistique($pdo);
    }

    public function index()
    {
        $exchangeCount = $this->statModel->getExchangeCount();
        $userCount = $this->statModel->getUserCount();

        Flight::render('admin/statistiques.php', [
            'exchangeCount' => $exchangeCount,
            'userCount' => $userCount
        ]);
    }
}
