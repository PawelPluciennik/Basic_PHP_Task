<?php
namespace App;

use App\Exceptions\RouteNotFoundException;

class Router {
    private array $routes;

    public function register(string $route, callable|array $action): Router{
        $this->routes[$route] = $action;
        return $this;
    }

    public function resolve(string $requestUri) {
        $parsedUrl =parse_url($requestUri);
        $route = $parsedUrl['path'];
        if(isset($parsedUrl['query']))        
        parse_str($parsedUrl['query'], $params);
        else $params = [];
       // $route = explode('?', $requestUri)[0];
        $action = $this->routes[$route] ?? null;

        if(!$action){
            throw new RouteNotFoundException();
        }

        if(is_callable($action)) return call_user_func($action,$params);
        if(is_array($action)){
            [$class, $method] = $action;

            if(class_exists($class)) {
                return call_user_func_array([$class, $method], $params);
            }
            return call_user_func($action);
        } 

        throw new RouteNotFoundException();
    }
}
?>