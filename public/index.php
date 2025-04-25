<?php

// Habilita exibição de erros (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Carrega variáveis de ambiente (.env)
require_once __DIR__ . '/../app/Core/EnvLoader.php';
\App\Core\EnvLoader::load(__DIR__ . '/../.env');

// Autoload de classes (se usar Composer ou autoloader próprio)
require_once __DIR__ . '/../app/Core/Autoload.php';

// Pega a URL requisitada
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace('/desafio_infoideias', '', $requestUri); // Ajuste para sua pasta

// Divide a URL: 
$segments = explode('/', trim($requestUri, '/'));

// Define controlador e método (default se vazio)
$controllerName = !empty($segments[0]) ? ucfirst($segments[0]) . 'Controller' : 'HomeController';
$methodName = isset($segments[1]) ? $segments[1] : 'index';
$params = array_slice($segments, 2); // Parâmetros extras

// Caminho da classe
$controllerClass = "App\\Controllers\\$controllerName";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();

    if (method_exists($controller, $methodName)) {
        call_user_func_array([$controller, $methodName], $params);
    } else {
        http_response_code(404);
        echo "Método '$methodName' não encontrado.";
    }
} else {
    http_response_code(404);
    if (empty($controllerName)) {
        echo "Controlador não foi encontrado.";
    } else {
        echo "Controlador '$controllerName' não encontrado.";
    }
}
