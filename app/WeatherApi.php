<?php
namespace App;

use app\MainApi;

class WeatherApi extends MainApi {
    //private $googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;
    public static function getWeather(){
        $googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?id=3084130&lang=en&units=metric&APPID=799e76138e7dd2caa2be79534ac8bb8e";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);  

        $response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($response);
        dd($data);
        return $data;
    }
    
}