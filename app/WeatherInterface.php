<?php
namespace App;

interface WeatherInterface
{
    public function getWeather(string $route = 'main', string $value = '');
}