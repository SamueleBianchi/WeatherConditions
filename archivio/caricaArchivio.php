<?php
require "../db/dbconnect.php";

session_start();
$IDUtente = $_SESSION['IDUtente'];

$query=$connessione->query("SELECT * FROM archivio INNER JOIN utenti ON utenti.IDUtente = archivio.IdArchivio AND utenti.IDUtente = $IDUtente");
$righe = $query->fetch();
if(!$righe){
    echo '<div class="alert alert-danger" role="alert">Il tuo archivio è vuoto! Puoi aggiungere record al tuo archivio nell apposita area in basso a destra nella ricarca meteo corrente</div>';
}