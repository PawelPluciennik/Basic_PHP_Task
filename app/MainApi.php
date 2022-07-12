<?php
namespace App;

abstract class MainApi {
    public function __construct(private string $url){}
    
    protected function request(string $route){
        $tempurl = $this->url . $route;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $tempurl);  

        $response = curl_exec($ch);

        curl_close($ch);
        
        return json_decode($response,true);
    }
}
