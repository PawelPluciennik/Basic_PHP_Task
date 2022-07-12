<?php 
namespace App;

class WeatherFile implements WeatherInterface {
  
  public function getWeather(string $route = 'main', string $value = ''): array{
    $json = file_get_contents('../weather_14.json');
    $json_data = json_decode($json,true);

    $WF = new WeatherFile();
    
    $data = $WF->findCityById(3084130, $json_data);
    
    if(empty($value))return $data[$route];
    return $data[$route][$value];
  } 

  public function findCityById(int $id, array $json_data): array{
    foreach($json_data['cities'] as $city){
      if($city['city']['id'] == $id) return $city;
    }
    return [];
  }
}