<?php
namespace App;

class WeatherFactory{
    private $wf;
    
    public function __construct()
    {
        if($_ENV['API']==1){
            $WF = new WeatherFile();
            echo 'File';
        }
        else{
            $WF = new WeatherApi("https://api.openweathermap.org/data/2.5");
            echo 'Api';
        }
        $this->wf = $WF;
    }

    public function create(){
        return $this->wf->getWeather();
    }
}
