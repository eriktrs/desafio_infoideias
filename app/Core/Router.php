<?php
namespace App\Core;

class Router
{
    // Método para redirecionar a URL para o controlador e método apropriados
    public function dispatch($url)
    {
        // Remove a barra inicial e divide a URL em partes
        $url = trim($url, '/');
        $parts = explode('/', $url);

        // Define o controlador e o método padrão
        $controllerName = ucfirst($parts[0] ?? 'Imovel') . 'Controller';
        $method = $parts[1] ?? 'index';
        $params = array_slice($parts, 2);

        $controllerClass = "App\\Controllers\\$controllerName";

        // Verifica se o controlador existe e se o método existe dentro dele
        if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
            call_user_func_array([new $controllerClass, $method], $params);
        } else {
            echo "Página não encontrada.";
        }
    }
}
