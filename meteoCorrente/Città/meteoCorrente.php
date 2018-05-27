<?php

require_once '../gestoreIcone.php';
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
            $pioggia = 0;
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
            $visibilità=$weatherArray['visibility'];
            $vis= $weatherArray['visibility'];
        }else{
            $visibilità="non disponibile";
            $vis = 0;
        }
        
        $dataUTC= $weatherArray['dt'];
        
        
        $dateInLocal = date("Y-m-d H:i:s", $dataUTC);
        
        $weather ="<h4>Temperature a ".$nome."</h4>".setImage($condizione,$descrizione)."<br> <strong>Temperatura in Celsius:&nbsp</strong> ".$tempInCelsius."&deg C <br><strong>Temperatura minima:&nbsp</strong> ".$temp_min."&deg C <br><strong>Temperatura massima:&nbsp</strong> ".$temp_max."&deg C <br><strong>Temperatura in Fahrenheit:&nbsp</strong> ".$tempInFahrenheit."&deg F <br><strong>Condizione:&nbsp</strong> ".$condizione."&nbsp<br><strong>Descrizione:&nbsp</strong> ".$descrizione."<br> <strong>Pressione :&nbsp</strong> ".$pressione." hPa <br> <strong>Umidità :&nbsp</strong> ".$umidità."%<br><strong>Precipitazioni :&nbsp</strong>".$pioggia."mm<br> <strong>Nuvolosità :&nbsp</strong> ".$clouds."%<br><strong>Neve:&nbsp</strong>".$neve."<br> <strong>Visibilità :&nbsp</strong> ".$visibilità." <hr><div><h4>Vento</h4><strong>Velocità in MPH:&nbsp </strong>".$speedInMPH." MPH<div style='position: absolute; left: 45%; top: 55%;'><img src='icon/windy.png'></div><br><strong>Velocità in m/s: &nbsp</strong> ".$speedinMs."<br><strong>Deg: &nbsp</strong>".$deg."<br></div><hr><h4>Generali</h4><strong>Nome:&nbsp </strong>".$nome."<br><strong>Latitudine :&nbsp</strong>".$latitudine."<br><strong>Longitudine :&nbsp</strong>".$lon."<br><strong>Paese :&nbsp</strong>".$paese."<br><strong>Data :&nbsp</strong>".$dateInLocal."<br><strong>Alba:&nbsp</strong>".$alba."</br><strong>Tramonto:&nbsp</strong>".$tramonto."<br>";
            
            if($weather) {
                
                echo '<div class="alert alert-info" role="alert">'.$weather.'</div><div id="alert" style="display : none;"></div><label for="nota">Aggiungi una nota:</label>'
  
                    .'<form id="archivio" action="./archivio/archivio.php" method="post">'
                        . '<textarea class="form-control" type="text" rows="5" name="nota" id="nota" placeholder="Aggiungi una nota" required>'
                        . '</textarea>'
                        . '<div style="display: none;">'
                        . '<input type="text" class="form-control" value="'.$nome.'" name="città" id="città">'
                        . '<input type="text" class="form-control" value="'.$tempInCelsius.'" name="temp" id="temp">'
                        . '<input type="text" class="form-control" value="'.$temp_max.'" name="tempMax" id="tempMax">'
                        . '<input type="text" class="form-control" value="'.$temp_min.'" name="tempMin" id="tempMin">'
                        . '<input type="text" class="form-control" value="'.$clouds.'" name="nuvole" id="nuvole">'
                        . '<input type="text" class="form-control" value="'.$pressione.'" name="pressione" id="pressione">'
                        . '<input type="text" class="form-control" value="'.$umidità.'" name="umidità" id="umidità">'
                        . '<input type="text" class="form-control" value="'.$pioggia.'" name="pioggia" id="pioggia">'
                        . '<input type="text" class="form-control" value="'.$neve.'" name="neve" id="neve">'
                        . '<input type="text" class="form-control" value="'.$speedInMPH.'" name="velocitàVento" id="velocitàVento">'
                        . '<input type="datetime-local" class="form-control" value="'.$deg.'" name="degVento" id="degVento">'
                        . '<input type="text" class="form-control" value="'.$dataUTC.'" name="tempo" id="tempo">'
                        . '<input type="text" class="form-control" value="'.$descrizione.'" name="descrizione" id="descrizione">'
                        . '</div><br>'
                        . '<button type="submit" class="btn btn-danger">Aggiungi</button>'
                    . '</form>';
                
            }
        }else{
            echo '<div class="alert alert-danger" role="alert"><strong>Errore :&nbsp</strong>impossbile trovare la città ricercata</div>';
        }
        }