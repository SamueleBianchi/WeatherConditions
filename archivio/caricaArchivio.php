<?php
require "../db/dbconnect.php";

session_start();
$IDUtente = $_SESSION['IDUtente'];

$query = "SELECT * FROM archivio INNER JOIN utenti ON utenti.IDUtente = archivio.CodUtente WHERE utenti.IDUtente = $IDUtente";
$risultato = $connessione->query($query);
$num = $risultato->rowCount();
if($num === 0){
    echo '<div class="alert alert-danger" role="alert">Il tuo archivio è vuoto! Puoi aggiungere record al tuo archivio nell apposita area in basso a destra nella ricarca meteo corrente</div>';
}else{
     echo '<h3>Il mio archivio</h3><table id="mytable" class="table table-striped table-bordered table-hover" >
      <thead>
        <tr>
          <th>Data</th>
          <th>Città</th>
          <th>Temperatura</th>
          <th>Minima</th>
          <th>Massima</th>
          <th>Umidità</th>
          <th>Pressione (hPa)</th>
          <th>Pioggia (mm)</th>
          <th>Neve (mm)</th>
          <th>Nuvolosità</th>
          <th>Velocità vento (m/s)</th>
          <th>Direzione vento</th>
          <th>Descrizione</th>
          <th>Nota</th>
        </tr>
      </thead>
       <tbody>';
     while($riga = $risultato->fetch(PDO::FETCH_ASSOC)){
         echo '<tr>'
            . '<td>'.date("Y-m-d H:i:s", $riga['tempo']).'</td>'
            . '<td>'.$riga['citta'].'</td>'
            . '<td>'.$riga['temp'].'°</td>'
            . '<td>'.$riga['tempMax'].'°</td>'
            . '<td>'.$riga['tempMin'].'°</td>'
            . '<td>'.$riga['umidita'].'%</td>'
            . '<td>'.$riga['pressione'].'</td>'
            . '<td>'.$riga['pioggia'].'</td>'
            . '<td>'.$riga['neve'].'</td>'
            . '<td>'.$riga['nuvole'].'%</td>'
            . '<td>'.$riga['velocitaVento'].'</td>'
            . '<td>'.$riga['degVento'].'</td>'
        . '<td>'.$riga['descrizione'].'</td>'
                 . '<td>'.$riga['nota'].'</td>'
            . '</tr>';
     }
}