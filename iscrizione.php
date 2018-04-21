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
$IDUtente="";

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

$path_parts = pathinfo($_FILES["userfile"]["name"]);
$ext = $path_parts['extension'];
$filemat=$email.'.'.$ext;

if ((move_uploaded_file($userfile_tmp,"./foto/".$filemat))&&$pwd==$pwd2){

            $query=$connessione->prepare("INSERT INTO Utenti (IDUtente, nome, cognome, email, pwd, sesso, ente, citta, fotoProfilo) VALUES (:IDUtente, :nome, :cognome, :email, :pwd, :sesso, :ente, :citta, :fotoProfilo)");
            $query->bindParam(':IDUtente', $IDUtente, PDO::PARAM_INT, 10);
            $query->bindParam(':nome', $nome, PDO::PARAM_STR, 30);
            $query->bindParam(':cognome', $cognome, PDO::PARAM_STR, 40);
            $query->bindParam(':email', $email, PDO::PARAM_STR, 64);
            $query->bindParam(':pwd', $pwd, PDO::PARAM_STR, 30);
            $query->bindParam(':sesso', $sesso, PDO::PARAM_STR, 30);
            $query->bindParam(':ente', $ente, PDO::PARAM_STR, 64);
            $query->bindParam(':citta', $città, PDO::PARAM_STR, 64);
            $query->bindParam(':fotoProfilo', $filemat, PDO::PARAM_STR, 30);
            try{
                $query->execute();
                $out="Iscrizione avvenuta con successo";
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

