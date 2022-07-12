<html>
    <body>
        <?php
        include_once '../App/weather.php';

        use App\WeatherFactory;

        // $ok = new WeatherApi("https://api.openweathermap.org/data/2.5/weather?id=3084130&lang=en&units=metric&APPID=799e76138e7dd2caa2be79534ac8bb8e");
        $factory = new WeatherFactory();
        dd($factory->create());
        
        ?> 
        <h2><?php echo $data->name; ?> Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast">
            <img src="https://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" /> 
            <br>
            Temperature: <?php echo $data->main->temp; ?>°C
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
            <div>Pressure: <?php echo $data->main->pressure; ?> hPa</div>
        </div>
    
        <br>
        <a href="form">Form</a> <br>
        <a href="database">Database</a> 
    </body>
</html>

