<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "../db/dbconnect.php";

session_start();
$IDUtente = $_SESSION['IDUtente'];

$nota = $_POST['nota'];
$città = $_POST['città'];
$temp = $_POST['temp'];
$tempMax = $_POST['tempMax'];
$tempMin = $_POST['tempMin'];
$pressione = $_POST['pressione'];
$umidità = $_POST['umidità'];
$pioggia = $_POST['pioggia'];
$neve = $_POST['neve'];
$nuvole = $_POST['nuvole'];
$velocitàVento = $_POST['velocitàVento'];
$degVento = $_POST['degVento'];
$tempo = $_POST['tempo'];
$descrizione = $_POST['descrizione'];
$idArchivio = "";

if($degVento === "Non disponibile"){
    $deg = 0;
}else{
    $deg = $degVento;
}
$sql = "SELECT * FROM archivio, utenti WHERE utenti.IDUtente = $IDUtente AND archivio.tempo = '$tempo' AND archivio.citta = '$città'";
$risultato = $connessione->query($sql);
$num = $risultato->rowCount();
if($num=='1'){
    echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-remove"></span> Il record è già presente nell archivio personale!</div>';
} else {
    $stringaSql = "INSERT INTO archivio (citta, temp, tempMax, tempMin, pressione, umidita, velocitaVento, degVento, nuvole, pioggia, neve, tempo, descrizione, nota, CodUtente)";
$stringaSql .= " VALUES ('$città', $temp, $tempMax, $tempMin, $pressione, $umidità, $velocitàVento, $deg, $nuvole, $pioggia, $neve, $tempo, '$descrizione', '$nota', $IDUtente);";       
try{
$query=$connessione->exec($stringaSql);
echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span> Record aggiunto all archivio personale</div>';
}catch(PDOException $ex){
    echo $ex->getMessage();
}
}



