<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function curl($url) {
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        } 
        
        
        if(isset($_POST['city'])){
            
        $city= $_POST['city'];       
        
        $urlContents = curl("api.openweathermap.org/data/2.5/weather?q=".$city.",it&lang=it&appid=b21f3872c8ea3e8d9ffb5acf70cb817f");
        
        if(strpos($urlContents,"city not found")===false){
        $weatherArray = json_decode($urlContents, true);
        
        
        $tempInFahrenheit = intval($weatherArray['main']['temp']* 9/5 - 459.67);
        
        $tempInCelsius = intval($weatherArray['main']['temp']-273.15);
        
        $speedInMPH = intval($weatherArray['wind']['speed']*2.24);
        
        $speedinMs = $weatherArray['wind']['speed'];
        
        $descrizione = $weatherArray['weather'][0]['description'];
        
        $condizione = $weatherArray['weather'][0]['main'];
        
        $clouds = $weatherArray['clouds']['all'];
        
        $temp_min = intval($weatherArray['main']['temp_min']-273.15);
        
        $temp_max = intval($weatherArray['main']['temp_max']-273.15);
        
        $nome = $weatherArray['name'];
        
        $latitudine = $weatherArray['coord']['lat'];
        
        $lon = $weatherArray['coord']['lon'];
        
       
        if(isset($weatherArray['rain']['3h'])){
            $pioggia = $weatherArray['rain']['3h'];
        }else{
            $pioggia = "0";
        }
        
        if(isset($weatherArray['main']["pressure"])){
            $pressione = $weatherArray['main']["pressure"];
        }else{
            $pressione = "0";
        }
        
        if(isset($weatherArray['main']["humidity"])){
            $umidità = $weatherArray['main']["humidity"];
        }else{
            $umidità = "0";
        }


        if(isset($weatherArray['wind']['deg'])){
            $deg=$weatherArray['wind']['deg'];
        }else{
            $deg= "Non disponibile";
        }
            
        if(isset($weatherArray['snow'])){
            $neve=$weatherArray['snow'];
        }else{
            $neve= "0";
        }
        
        $paese = $weatherArray['sys']['country'];
        
        $alba = date("Y-m-d H:i:s",$weatherArray['sys']['sunrise']);
        
        $tramonto = date("Y-m-d H:i:s",$weatherArray['sys']['sunset']);
        
        if(isset($weatherArray['visibility'])){
            $visibilità=$weatherArray['visibility']." m";
        }else{
            $visibilità="non disponibile";
        }
        
        $dataUTC= $weatherArray['dt'];
        
        
        $dateInLocal = date("Y-m-d H:i:s", $dataUTC);
        
        $weather ="<h4>Temperature a ".$nome."</h4>".setImage($condizione,$descrizione)."<br> <strong>Temperatura in Celsius:&nbsp</strong> ".$tempInCelsius."&deg C <br><strong>Temperatura minima:&nbsp</strong> ".$temp_min."&deg C <br><strong>Temperatura massima:&nbsp</strong> ".$temp_max."&deg C <br><strong>Temperatura in Fahrenheit:&nbsp</strong> ".$tempInFahrenheit."&deg F <br><strong>Condizione:&nbsp</strong> ".$condizione."&nbsp<br><strong>Descrizione:&nbsp</strong> ".$descrizione."<br> <strong>Pressione :&nbsp</strong> ".$pressione." hPa <br> <strong>Umidità :&nbsp</strong> ".$umidità."%<br><strong>Precipitazioni :&nbsp</strong>".$pioggia."mm<br> <strong>Nuvolosità :&nbsp</strong> ".$clouds."%<br><strong>Neve:&nbsp</strong>".$neve."<br> <strong>Visibilità :&nbsp</strong> ".$visibilità." <hr><h4>Vento</h4><strong>Velocità in MPH:&nbsp </strong>".$speedInMPH." MPH<br><strong>Velocità in m/s: &nbsp</strong> ".$speedinMs."<br><strong>Deg: &nbsp</strong>".$deg."<br><hr><h4>Generali</h4><strong>Nome:&nbsp </strong>".$nome."<br><strong>Latitudine :&nbsp</strong>".$latitudine."<br><strong>Longitudine :&nbsp</strong>".$lon."<br><strong>Paese :&nbsp</strong>".$paese."<br><strong>Data :&nbsp</strong>".$dateInLocal."<br><strong>Alba:&nbsp</strong>".$alba."</br><strong>Tramonto:&nbsp</strong>".$tramonto."<br>";
            
            if($weather) {
                
                echo '<div class="alert alert-info" role="alert">'.$weather.'</div>';
                
            }
        }else{
            echo '<div class="alert alert-danger" role="alert"><strong>Errore :&nbsp</strong>impossbile trovare la città ricercata</div>';
        }
        }
        
        function setImage($s,$ss) {
    if ($s === "Clear")
        return "<center><img src='./icon/clear.png'></img></center>";
    if ($s ==="Clouds")
        return "<center><img src='./icon/cloud.png'></img></center>";
    if ($s === "Rain")
        return "<center><img src='./icon/rain.png'></img></center>";
    if ($s === "Drizzle")
        return "<center><img src='./icon/drizzle.png'></img></center>";
    if ($s === "Thunderstorm")
        return "<center><img src='./icon/thunderstorm.png'></img></center>";
    if ($s === "Snow")
        return "<center><img src='./icon/snow.png'></img></center>";
    if ($s === "Mist")
        return "<center><img src='./icon/mist.png'></img></center>";
    if ($s === "Atmosphere") {
        if ($ss === "fog" || $ss === "haze" || $ss === "mist" || $ss === "smoke")
            return "<center><img src='./icon/haze.png'></img></center>";
        if ($ss === "sand" || $ss === "dust" || $ss === "sand, dust whirls")
            return "<center><img src='./icon/sand.png'></img></center>";
        if ($ss === "tornado" || $ss === "squalls")
            return "<center><img src='./icon/tornado.png'></img></center>";
    }

    if ($s === "Extreme") {
        if ($ss === "hot")
            return "<center><img src='./icon/hot.png'></img></center>";
        if ($ss === "cold")
            return "<center><img src='./icon/cold.png'></img></center>";
        if ($ss === "windy")
            return "<center><img src='./icon/windy.png'></img></center>";
        if ($ss === "tornado" || $ss === "tropical storms" || $ss === "hurricane")
            return "<center><img src='./icon/tornado.png'></img></center>";
        if ($ss === "hail")
            return "<center><img src='./icon/hail.png'></img></center>";
    }
}