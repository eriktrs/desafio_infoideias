<?php
namespace App\Controllers;

class HomeController
{
    public function index()
    {
        // Carrega o arquivo de visualização da página inicial
        require_once __DIR__ . '/../Views/home.php';
    }
}
