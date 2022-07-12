<?php
namespace App;

use App\MainApi;

class WeatherApi extends MainApi implements WeatherInterface {
    
    public function __construct($url) {
        parent::__construct($url);
    }

    public function getWeather(): array {
        $request = '/weather?id=3084130&lang=en&units=metric&APPID=799e76138e7dd2caa2be79534ac8bb8e';
        $data = $this->request($request);

        return $data;
    }
}