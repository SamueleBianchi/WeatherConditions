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

        $urlContents = curl("http://api.openweathermap.org/data/2.5/weather?q=".$_POST['city']."&type=accurate&appid=b21f3872c8ea3e8d9ffb5acf70cb817f");
        echo $urlContents;
        $weatherArray = json_decode($urlContents, true);
        
        $weather = "The weather in ".$_POST['city']." is currently ".$weatherArray['weather'][0]['description'].".";
        
        $tempInFahrenheit = intval($weatherArray['main']['temp']* 9/5 - 459.67);
        
        $speedInMPH = intval($weatherArray['wind']['speed']*2.24);
        
        $weather .=" The temperature is ".$tempInFahrenheit."&deg; F with a wind speed of ".$speedInMPH." MPH.";
            
            if($weather) {
                
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
                
            } else {
                
                if ($_POST['city'] !="") {
                    
                    echo '<div class="alert alert-danger" role="alert">Sorry, that city could not be found.</div>';
                }
            }
