<?php
function curl($url) {
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            $data = curl_exec($ch);
            curl_close($ch);

            return $data;
        } 
        
       $city=$_POST['city'];
       $urlContents = curl("http://api.openweathermap.org/data/2.5/forecast?q=$city,it&mode=json&lang=it&appid=b21f3872c8ea3e8d9ffb5acf70cb817f");
       
       if(strpos($urlContents,"city not found")===false){
           
           $weatherArray = json_decode($urlContents, true);
           echo '<div class="alert alert-success">Previsioni meteo per: '.$weatherArray['city']['name'].'<br>Latitudine: '.$weatherArray['city']['coord']['lat'].'<br>Longitudine: '.$weatherArray['city']['coord']['lon'].'</div>';
           
           echo '<div class="table-responsive text-center">
    <table class="table table-striped table-bordered table-hover" id="table" name="table">
      <thead>
        <tr>
          <th>Data</th>
          <th>Ora</th>
          <th>Temperatura (C°)</th>
          <th>Minima (C°)</th>
          <th>Massima (C°)</th>
          <th>Umidità (%)</th>
          <th>Pressione (hPa)</th>
          <th>Pioggia (mm)</th>
          <th>Neve (mm)</th>
          <th>Nuvolosità (%)</th>
          <th>Velocità vento (m/s)</th>
          <th>Direzione vento (°)</th>
          <th>Descrizione</th>
        </tr>
      </thead>
       <tbody>';
        
        foreach ($weatherArray['list'] as $ora){
            if(isset($ora['rain']['3h'])){
                $neve = number_format((float)$ora['rain']['3h'], 3, '.', '');;
            }else{
                $neve = "_";
            }
            if(isset($ora['snow']['3h'])){
                $pioggia = number_format((float)$ora['snow']['3h'], 3, '.', '');;
            }else{
                $pioggia = "_";
            }
             echo '<tr>'
            . '<td>'.date("d-m-Y", $ora['dt']).'</td>'
            . '<td>'.date("H:i:s", $ora['dt']).'</td>'
            . '<td>'.number_format((float)($ora['main']['temp']-273.15),2,'.','').'°</td>'
            . '<td>'.number_format((float)($ora['main']['temp_min']-273.15),2,'.','').'°</td>'
            . '<td>'.number_format((float)($ora['main']['temp_max']-273.15),2,'.','').'°</td>'
            . '<td>'.$ora['main']['humidity'].'%</td>'
            . '<td>'.$ora['main']['pressure'].'</td>'
            . '<td>'.$neve.'</td>'
            . '<td>'.$pioggia.'</td>'
            . '<td>'.$ora['clouds']['all'].'%</td>'
            . '<td>'.$ora['wind']['speed'].'</td>'
            . '<td>'.number_format((float)$ora['wind']['deg'], 3, '.', '').'</td>'
        . '<td>'.$ora['weather'][0]['description'].'</td>'
            . '</tr>';
        }
      echo'</tbody>
    </table>
    </div>
    </div>';
       }
       else{
           echo '<div class="alert alert-danger"><strong>Errore: </strong>impossibile trovare la città ricercata.</div>';
       }
       
 