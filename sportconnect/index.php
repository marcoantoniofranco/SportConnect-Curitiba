<?php
require_once 'controllers/HomeController.php';
require_once 'controllers/ProfileController.php';
require_once 'controllers/AuthController.php';

$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
$url = rtrim($url, '/');
$url = explode('/', $url);

$controllerName = isset($url[0]) ? $url[0] : 'home';
$methodName = isset($url[1]) ? $url[1] : 'index';

$controllerName = ucfirst($controllerName) . 'Controller';

if (class_exists($controllerName)) {
    $controller = new $controllerName();
    if (method_exists($controller, $methodName)) {
        $controller->$methodName();
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Página não encontrada";
    }
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Página não encontrada";
}
?>