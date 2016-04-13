<?php
/**
 * Created by PhpStorm.
 * User: etema
 * Date: 1/04/2016
 * Time: 12:53 AM
 */
class Weather{
    private $API;
    private $URL;
    public function __construct($apikey=null){
        $this->API=$apikey;

    }
    public function getWeather($cityname=null) {
        $crl=curl_init();
        $this->URL='http://api.openweathermap.org/data/2.5/weather?q=' . $cityname . '&APPID=' . $this->API . '&units=metric';
        curl_setopt($crl,CURLOPT_URL,$this->URL);
        curl_setopt($crl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($crl,CURLOPT_HEADER,false);
        $json=curl_exec($crl);
        if (curl_errno($crl))
            return -1;
        else

        curl_close($crl);
        return $json;
    }
    public function get_url(){
        return $this->URL;
    }

}
if(!empty($_GET["city"])){
    $Weather=new Weather('3951d4e30d95a08e98e8a1f7fb470d63');
    $data=$Weather->getWeather(($_GET["city"]));
    echo $Weather->get_url();
    echo ($_GET["city"]);
    if(!empty($data)) {

        $array = json_decode($data, true);
        //var_dump($array);
        echo "<div class='table'>
<div class='rowcell'>
<div class='cell'>Min:" . ($array["main"]["temp_min"]) . "</div>
<div class='rowspanned cell'><img src='http://openweathermap.org/img/w/" . ($array["weather"][0]["icon"]) . ".png'/></div>
</div>
<div class='rowcell'>
<div class='cell'>Max:" . ($array["main"]["temp_max"]) . "</div>
<div class='empty cell'></div>
</div></div>";
    }
    else
        echo "<p>Bad request! </p>";
}