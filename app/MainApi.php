<?php 
namespace app;

use stdClass;

abstract class MainApi {
    private string $url;

    public function __construct(string $URL) {
        $this->url = $URL;
    }

    public function getRoute(string $route): array | stdClass{
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);  

        $response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($response);
        
        return $data->$route;
    }
}