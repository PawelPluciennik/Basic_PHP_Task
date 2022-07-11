<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    include '../dd.php';

    define('APP_PATH',__DIR__.'/../app/');
    define('VIEW_PATH', __DIR__ . '/../views/');

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    use App\Router;
    use App\App;
    use App\Config;
    use App\FormHandler;
    
    $router = new Router();
    
    $router->register(
        '/',
        function() {
            include_once VIEW_PATH.'index.php';
        }
    );

    $router->register(
        '/form',
        function() {
            include_once VIEW_PATH.'form.php';
        }
    );

    $router->register(
        '/form/result',
        [FormHandler::class, 'index']
    );

    $router->register(
        '/database',
        [FormHandler::class, 'readdb']
    );

    $router->register(
        '/database/edit',
        [FormHandler::class, 'getFamily']
    );

    $router->register(
        '/database/updated',
        [FormHandler::class, 'updateFamily']
    );

    $router->register(
        '/database/deleteFamily',
        [FormHandler::class, 'deleteFamily']
    );

    $router->register(
        '/database/deleteChild',
        [FormHandler::class, 'deleteChild']
    );

    (new App($router,
        ['uri' => $_SERVER['REQUEST_URI'], 'method' => $_SERVER['REQUEST_METHOD']],
        new Config($_ENV)
    ))->run();

    //echo $router->resolve($_SERVER['REQUEST_URI']);