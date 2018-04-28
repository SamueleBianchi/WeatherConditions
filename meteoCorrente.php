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
        
        $urlContents = curl("http://api.openweathermap.org/data/2.5/weather?q=".$city."&type=accurate&lang=it&appid=b21f3872c8ea3e8d9ffb5acf70cb817f");
        $weatherArray = json_decode($urlContents, true);
        
        
        $tempInFahrenheit = intval($weatherArray['main']['temp']* 9/5 - 459.67);
        
        $tempInCelsius = intval($weatherArray['main']['temp']-273.15);
        
        $speedInMPH = intval($weatherArray['wind']['speed']*2.24);
        
        $speedinMs = $weatherArray['wind']['speed'];
        
        $descrizione = $weatherArray['weather'][0]['description'];
        
        $clouds = $weatherArray['clouds']['all'];
        
        $temp_min = intval($weatherArray['main']['temp_min']-273.15);
        
        $temp_max = intval($weatherArray['main']['temp_max']-273.15);
        
        $nome = $weatherArray['name'];
        
        $latitudine = $weatherArray['coord']['lat'];
        
        $lon = $weatherArray['coord']['lon'];
        
        $pressione = $weatherArray['main']["pressure"];
        
        $umidità = $weatherArray['main']["humidity"];
        
        if(isset($weatherArray['wind']['deg'])){
            $deg=$weatherArray['wind']['deg'];
        }else{
            $deg= "non disponibile";
        }
        
        $paese = $weatherArray['sys']['country'];
        
        $alba = date("Y-m-d H:i:s",$weatherArray['sys']['sunrise']);
        
        $tramonto = date("Y-m-d H:i:s",$weatherArray['sys']['sunset']);
        
        $visibilità = $weatherArray['visibility'];
        
        $dataUTC= $weatherArray['dt'];
        
        
        $dateInLocal = date("Y-m-d H:i:s", $dataUTC);
        
        $weather ="<h4>Temperature a ".$nome."</h4><br> <strong>Temperatura in Celsius:&nbsp</strong> ".$tempInCelsius."&deg C <br><strong>Temperatura minima:&nbsp</strong> ".$temp_min."&deg C <br><strong>Temperatura massima:&nbsp</strong> ".$temp_max."&deg C <br><strong>Temperatura in Fahrenheit:&nbsp</strong> ".$tempInFahrenheit."&deg F <br><strong>Descrizione:&nbsp</strong> ".$descrizione."<br> <strong>Pressione :&nbsp</strong> ".$pressione." hPa <br> <strong>Umidità :&nbsp</strong> ".$umidità."%<br> <strong>Nuvole :&nbsp</strong> ".$clouds."%<br> <strong>Visibilità :&nbsp</strong> ".$visibilità." m<hr><h4>Vento</h4><strong>Velocità in MPH:&nbsp </strong>".$speedInMPH." MPH<br><strong>Velocità in m/s: &nbsp</strong> ".$speedinMs."<br><strong>Deg: &nbsp</strong>".$deg."<br><hr><h4>Generali</h4><strong>Nome:&nbsp </strong>".$nome."<br><strong>Latitudine :&nbsp</strong>".$latitudine."<br><strong>Longitudine :&nbsp</strong>".$lon."<br><strong>Paese :&nbsp</strong>".$paese."<br><strong>Data :&nbsp</strong>".$dateInLocal."<br><strong>Alba:&nbsp</strong>".$alba."</br><strong>Tramonto:&nbsp</strong>".$tramonto."<br>";
            
            if($weather) {
                
                echo '<div class="alert alert-info" role="alert">'.$weather.'</div>';
                
            } else {
                
                if ($city !="") {
                    
                    echo '<div class="alert alert-danger" role="alert">Sorry, that city could not be found.</div>';
                }
            }
        }