<?php

require '../ChiamataAPI/impostaChiamata.php';
        
       $city=$_POST['city'];
       $città = str_replace(" ", "+",$city);//sostituisco lo spazio con il carattere + per poter ricercare anche le città che hanno piu di una parola
       $urlContents = curl("http://api.openweathermap.org/data/2.5/forecast?q=$città,it&mode=json&lang=it&appid=b21f3872c8ea3e8d9ffb5acf70cb817f");
       
       if(strpos($urlContents,"city not found")===false){
           
           $arrayTempmax = array();
           $arrayOra = array();
           $weatherArray = json_decode($urlContents, true);
           echo '<div class="container">

           <div class="alert alert-success">Previsioni meteo per: '.$weatherArray['city']['name'].'<br>Latitudine: '.$weatherArray['city']['coord']['lat'].'<br>Longitudine: '.$weatherArray['city']['coord']['lon'].'</div>
           <div class="form-group"> 
            <select class="form-control" name="state" id="maxRows" style="width:50%;">
				<option value="5000">Mostra tutte le righe</option>
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="70">70</option>
				<option value="100">100</option>
            </select> 		
        </div>';
           echo '<table id="mytable" class="table table-striped table-bordered table-hover" >
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
            array_push($arrayTempmax, (float)($ora['main']['temp']-273.15));
            array_push($arrayOra, date("H:i:s", $ora['dt']));
            if(isset($ora['rain']['3h'])){
                $neve = number_format((float)$ora['rain']['3h'], 3, '.', '');
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
      echo'</tbody></table><div class="pagination-container" >
            <nav>
				<ul class="pagination"></ul>
            </nav>
        </div>
        <div class="container">
        <h3>Scegli il grafico da visualizzare:</h3>
        <form action="./Previsioni/grafico.php" method="POST">
        <input id="c" type="text" name="c" value="'.$weatherArray['city']['name'].'" style="display:none;">
        <select class="form-control" name="sel" id="sel" style="width:50%" onchange="carica()">
                                <option>Seleziona</option>
				<option value="Precipitazioni">Precipitazioni</option>
				<option value="Massima">Temperatura massima</option>
				<option value="Minima">Temperatura minima</option>
                                <option value="MaxMin">Temperatura massima e minima</option>
				<option value="Umidità">Umidità</option>
                                <option value="Nuvolosità">Nuvolosità</option>
                                <option value="Pressione">Pressione</option>
                                <option value="VelVento">Velocità vento</option>
                                <option value="umidprec">Umidità e precipitazioni</option>
            </select> 
            <div id="grafico"></div>
            </div>
            <div id="grafico2"></div>
            </div>
            </form>
    </div>';
//    print_r($arrayTempmax);
//    print_r($arrayOra);
       }
       else{
           echo '<div class="alert alert-danger"><strong>Errore: </strong>impossibile trovare la città ricercata.</div>';
       }
       
 