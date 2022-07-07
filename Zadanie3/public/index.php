<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    //define('ROUTE_PATH',__DIR__.'/../views/');
    define('VIEW_PATH', __DIR__ . '/../views/');

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    use App\Router;
    use App\App;
    use App\Config;
    
    $router = new Router();
    
    $router->register(
        '/',
        function() {
            include_once(str_replace("/","\\",VIEW_PATH.'index.php'));
        }
    );

    $router->register(
        '/form',
        function() {
            include_once VIEW_PATH.'form.php';
        }
    );

    (new App($router,
        ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
        new Config($_ENV)
    ))->run();

    echo $router->resolve($_SERVER['REQUEST_URI']);