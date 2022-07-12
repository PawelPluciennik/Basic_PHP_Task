<?php
namespace App;

abstract class MainApi {
    private string $url;

    public function setUrl(string $seturl){
        $this->url = $seturl;
    }
    
    abstract public function __construct(string $URL);
    
    public function request(string $route){
        $this->url .= $route;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);  

        $response = curl_exec($ch);

        curl_close($ch);
        
        return json_decode($response);
    }

}
