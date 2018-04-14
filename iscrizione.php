<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require "./db/dbconnect.php";

$nome=$_POST['nome'];
$cognome=$_POST['cognome'];
$pwd=$_POST['pwd'];
$pwd2=$_POST['pwd2'];
$email=$_POST['email'];
$sesso=$_POST['sesso'];
$ente=$_POST['ente'];
$città=$_POST['città'];

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

$path_parts = pathinfo($_FILES["userfile"]["name"]);
$ext = $path_parts['extension'];
$filemat=$email.'.'.$ext;

if ((move_uploaded_file($userfile_tmp,"./foto/".$filemat))&&$pwd==$pwd2){
$connessione->exec("INSERT INTO Utenti (IDUtente, nome, cognome, email, pwd, sesso, ente, citta, fotoProfilo) VALUES ('', '$nome','$cognome','$email','$pwd','$sesso','$ente','$città','$filemat')");

}
