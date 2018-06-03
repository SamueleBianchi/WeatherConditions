<?php
session_start(); 
if(!isset($_SESSION['email'])){
header('Location: ../index.php');
}

function call($url){//setting della chiamata

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  //c'è la possibilità che da URL ci sia rindirizzati in un altro altro URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Maps</title>
        <!-- librerie Leaflet -->
        <link rel="stylesheet" href="mapCss.css">
        <link rel="stylesheet" href="icone/css/weather-icons.min.css">
        <link rel="stylesheet" href="icone/css/weather-icons-wind.css">
        <link rel="icon" href="../icon/favicon.jpg">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js" integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log==" crossorigin=""></script>
        <script src="mapJs.js"></script>
    </head>
    <body onLoad="initGeolocation()">
        
        
        <?php
        
        $dati = call("api.openweathermap.org/data/2.5/box/city?bbox=5.625732,36.187545,19.160888,46.96226,10&APPID=b21f3872c8ea3e8d9ffb5acf70cb817f");//effettuo la chiamata all'API
//        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction'])){
//        
//        }
        ?>

        <div class="custom-popup" id="mapid"></div>
        <div class="ricerca">
            
            <input name="list" id="input" list="cities" oninput='onInput()' placeholder="Search for cities..."/>
            <datalist id="cities"></datalist>
        </div>
  
        <div class="icona">
            <button class="home home1" onclick="location.href='../homepage.php'"></button>
            <button class="button button5" onmouseover="setTimeout(showPop,1000)" onclick="recall()"></button><!-- bottone per la geolocalizzazione-->
        </div>
        <div id="nascosto">Return to your position</div>

        <script>    
            
            var mappa = L.map('mapid').setView([42.06999969, 13.92000008], 6);//creo una variabile e setto la vista di partenza (l'italia) grazie alle coordinate

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets-satellite',
                accessToken: 'pk.eyJ1Ijoicm9zc2ltYXJpbyIsImEiOiJjajdpeWF3bnQxbzJuMnFtamoxbnZ5ZmF6In0.cWTzUrBQBpi5VeuiIy0Ezw'
            }).addTo(mappa);


            var callData = <?php echo json_encode($dati); ?>;
            var data = JSON.parse(callData);//effettuo la conversione del JSON 

            
            var lat, lon;

            var customPopup = "<div class='title'></div>";
// specify popup options 
            var customOptions =
                    {
                        'maxWidth': '800',
                        'width': '400',
                        'className': 'popupCustom'
                    };

            var customPopup, close;
            
            var flag = [];
            for (i = 0; i < data.list.length; i++) {
                rain = data.list[i].rain;//variabile che memorizza la quantità di pioggia
                snow = data.list[i].snow;//variabile che memorizza la quantità di neve
                close[i] = true;
                flag[i] = L.marker([data.list[i].coord.Lat, data.list[i].coord.Lon]).addTo(mappa);//creo un array di marker che sono posizionati tramite la latitudine e la longitudine prese dal JSON
                if(data.list[i].rain === null){//controllo se non piove (se non piove setto la varibile rain a 0
                    rain=0;
                }
                if(data.list[i].snow === null){//controllo se non nevica (se non nevica setto la varibile snow a 0
                    snow=0;
                }
                //creo il contenuto del popup e lo inserisco nella variabile customPopup
                customPopup = "<div class='title'>" + data.list[i].name + "</div> <divclass='image'>" + setImage(data.list[i].weather[0].main, data.list[i].weather[0].description) + "</div> <div class='content'><span class='list'>Temp</span><span class='view'>" + Math.round(data.list[i].main.temp) + "°</span><span class='list'>T.Max</span><span class='view'>" + Math.round(data.list[i].main.temp_max) + "°</span><span class='list'>T.Min</span><span class='view'>" + Math.round(data.list[i].main.temp_min) + "°</span><span class='list'>Humidity</span><span class='view'>" + data.list[i].main.humidity + "%</span><hr><div class='overall'>" + data.list[i].weather[0].description + "</div><hr><div class='more' id='" + i + "' onclick='showMore(this.id)'><a class='underline' href='#' style='color:white'>Show more details <i class='wi wi-wind towards-180-deg'></i></a></div><div id='h" + i + "' class='hidden'><span class='hList'>Clouds</span>" + data.list[i].clouds.today + "%<br><span class='hList'>Pressure</span>" + data.list[i].main.pressure + " hPa<br><span class='hList'>Wind-speed</span>" + data.list[i].wind.speed + " mps<br><span class='hList'>Wind-deg</span>" + data.list[i].wind.deg + " deg<br><span class='hList'>Latitude</span>" + data.list[i].coord.Lat + "<br><span class='hList'>Longitude</span>" + data.list[i].coord.Lon + "<br><span class='hList'>Rain</span>" + rain + " mm<br><span class='hList'>Snow</span>" + snow + " mm<hr><div style='margin-top:10px; height:1px; width:1px;'></div></div>";
                
                flag[i].bindPopup(customPopup, customOptions);
                setImage(i);
                
            }

            var options = '';
            for (var e = 0; e < data.list.length; e++)
                options += '<option value="' + data.list[e].name + '"/>';

            document.getElementById('cities').innerHTML = options;
            
        </script>

    </body>
</html>


