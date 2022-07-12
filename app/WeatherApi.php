<?php
namespace App;

use App\MainApi;
use stdClass;

class WeatherApi extends MainApi implements WeatherInterface {
    
    public function __construct(string $URL) {
        $this->url = $URL;
    }

    public function getWeather(string $route = 'main', string $value = ''): array | stdClass {
        $request = '/weather?id=3084130&lang=en&units=metric&APPID=799e76138e7dd2caa2be79534ac8bb8e';
        MainApi::setUrl($this->url);
        $data = MainApi::request($request);
        
        if(empty($value)) return $data->$route;

        return $data->$route->value;
    }
}