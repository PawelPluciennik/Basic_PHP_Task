<?php 


class WeatgerFile{
    public function getWeather(){
        
    }
}
//get JSON
 $json = file_get_contents('http://api.openweathermap.org/data/2.5/find?q=Calabar,NG&type=accurate&mode=jso‌​n');

 //decode JSON to array
 $data = json_decode($json,true);