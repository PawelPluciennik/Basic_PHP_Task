<?php
namespace App;

class WeatherFactory{
    private $strategies = [
        0 => WeatherFile::class,
        1 => WeatherApi::class
    ];
    public function __construct() {}

    public function create($api) : WeatherInterface{
        $url = "https://api.openweathermap.org/data/2.5";
        return new $this->strategies[$api]($url);
    }
}
