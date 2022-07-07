<?php
//test
    require_once __DIR__ . '/../vendor/autoload.php';
    define('ROUTE_PATH',__DIR__.'/../views/');

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    use App\Router;
    
    $router = new Router();
    
    $router->register(
        '/',
        function() {
            include_once(str_replace("/","\\",ROUTE_PATH.'home.php'));
        }
    );

    $router->register(
        '/form',
        function() {
            include_once ROUTE_PATH.'form.php';
        }
    );

    echo $router->resolve($_SERVER['REQUEST_URI']);