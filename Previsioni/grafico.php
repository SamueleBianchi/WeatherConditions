<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $città = $_POST['c'];
    $select1 = $_POST['sel'];
    
    function curl($url) {
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        } 
        
       $urlContents = curl("http://api.openweathermap.org/data/2.5/forecast?q=$città,it&mode=json&lang=it&appid=b21f3872c8ea3e8d9ffb5acf70cb817f");
       $weatherArray = json_decode($urlContents, true);
           
       switch ($select1) {
        case 'Precipitazioni':
            getGraficoPrecipitazioni($weatherArray);
            break;
        case 'Umidità':
            getGraficoUmidità($weatherArray);
            break;
        case 'Minima':
            getGraficoMin($weatherArray);
            break;
        case 'Massima':
            getGraficoMax($weatherArray);
            break;
        default:
            # code...
            break;
    }

function getGraficoMin($weatherArray){
    $array = array();
    
    foreach ($weatherArray['list'] as $ora){
            array_push($array, array('ora' => date("H:i d-m", $ora['dt']), "tempMin" => number_format((float)$ora['main']['temp_min']-273.15, 3, '.', '')));      
        }
        
    $json = json_encode($array);
    echo $json;
}

function getGraficoMax($weatherArray){
    $array = array();
    
    foreach ($weatherArray['list'] as $ora){
            array_push($array, array('ora' => date("H:i d-m", $ora['dt']), "tempMax" => number_format((float)$ora['main']['temp_max']-273.15, 3, '.', '')));      
        }
        
    $json = json_encode($array);
    echo $json;
}

function getGraficoUmidità($weatherArray){
    $array = array();
    
    foreach ($weatherArray['list'] as $ora){
            array_push($array, array('ora' => date("H:i d-m", $ora['dt']), "umidità" => $ora['main']['humidity']));      
        }
        
    $json = json_encode($array);
    echo $json;
}

function getGraficoPrecipitazioni($weatherArray){
    $array = array();
    
    foreach ($weatherArray['list'] as $ora){
        if(isset($ora['rain']['3h']))
            array_push($array, array('ora' => date("H:i d-m", $ora['dt']), "precipitazioni" => number_format($ora['rain']['3h'], 3, '.', '')));      
        }
        
    $json = json_encode($array);
    echo $json;
}