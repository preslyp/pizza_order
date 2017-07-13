<?php
require __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Pizza\Controller;
$request = Request::createFromGlobals();
$uri = $request->getPathInfo();


$loader = new Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new Twig_Environment($loader, array(
    'cache' => false,
    'debug' => true,
    'strict_variables' => true
));
$twig->addExtension(new Twig_Extension_Debug());

switch ($uri) {
    case '/':
        $controller = new Controller\HomeController($request, $twig);
        $controller->index();
        break;
    case '/addproduct':
        $controller = new Controller\HomeController($request, $twig);
        $controller->addProduct();
        break;
    case '/all':
        $controller = new Controller\AllPizzaController($request, $twig);
        $controller->index();
        break;
    default:
        $controller = new Controller\ErrorController($request, $twig);
        $controller->index();
}



