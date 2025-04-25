<?php
namespace App\Core;

class Controller
{
    // Método para carregar o modelo
    public function view($view, $data = [])
    {
        // Extrai os dados para que possam ser acessados diretamente na view
        extract($data);

        // Require a view
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }
}
