<html>
    <body>
        <?php
        include_once '../App/weather.php';

        use App\WeatherFactory;

        // $ok = new WeatherApi("https://api.openweathermap.org/data/2.5/weather?id=3084130&lang=en&units=metric&APPID=799e76138e7dd2caa2be79534ac8bb8e");
        $factory = new WeatherFactory();
        $weather = $factory->create($_ENV['API']); 
        $datas = $weather->getWeather();
        ?> 
        <h2>Weather Status</h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($datas['weather'][0]['description']); ?></div>
        </div>
        <div class="weather-forecast">
            Temperature: <?php echo ($_ENV['API']==0) ? $datas['main']['temp']-273.15 : $datas['main']['temp']; ?>°C
        </div>
        <div class="time">
            <div>Humidity: <?php echo $datas['main']['humidity'] ?> %</div>
            <div>Wind: <?php echo $datas['wind']['speed'] ?> km/h</div>
            <div>Pressure: <?php echo $datas['main']['pressure'] ?> hPa</div>
        </div>
    
        <br>
        <a href="form">Form</a> <br>
        <a href="database">Database</a> 
    </body>
</html>

