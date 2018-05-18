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
       $urlContents = curl("http://api.openweathermap.org/data/2.5/forecast?q=$city,it&mode=json&appid=b21f3872c8ea3e8d9ffb5acf70cb817f");
       
       if(strpos($urlContents,"city not found")===false){
           echo '<div class="table-responsive">
    <table class="table table-striped table-bordered"" id="table" name="table">
      <thead>
        <tr>
          <th>Data</th>
          <th>Ora</th>
          <th>Temperatura<th>
        </tr>
      </thead>
       <tbody>';
        $weatherArray = json_decode($urlContents, true);
        foreach ($weatherArray['list'] as $ora){
             echo '<tr>'
            . '<td>'.date("H:i:s", $ora['dt']).'</td>'
            . '<td>'.date("d-m-Y", $ora['dt']).'</td>'
            . '<td>'.$ora['main']['temp'].'</td>'
                     . '</tr>';
        }
      echo'</tbody>
    </table>
    </div>
    </div>';
       }
       
 
