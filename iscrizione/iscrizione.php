<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require dirname(__FILE__).'/../Filtro/filtro.php';  
require "../db/dbconnect.php";

//sanifioc i vari dati immessi dall'utente
$nome= filtra($_POST['nome']);
$cognome=filtra($_POST['cognome']);
$pwd=filtra($_POST['pwd']);
$pwd2=filtra($_POST['pwd2']);
$email=filtra($_POST['email']);
$sesso=filtra($_POST['sesso']);
$ente=filtra($_POST['ente']);
$città=filtra($_POST['città']);
$IDUtente="";

//Recupero il percorso temporaneo del file
$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

$path_parts = pathinfo($_FILES["userfile"]["name"]);
$ext = $path_parts['extension'];
$filemat=$email.'.'.$ext;

if ((move_uploaded_file($userfile_tmp,"../foto/".$filemat))&&$pwd==$pwd2){
   
    $pwdCript= md5($pwd);

            $query=$connessione->prepare("INSERT INTO utenti (IDUtente, nome, cognome, email, pwd, sesso, ente, citta, fotoProfilo) VALUES (:IDUtente, :nome, :cognome, :email, :pwd, :sesso, :ente, :citta, :fotoProfilo)");
            $query->bindParam(':IDUtente', $IDUtente, PDO::PARAM_INT, 10);
            $query->bindParam(':nome', $nome, PDO::PARAM_STR, 30);
            $query->bindParam(':cognome', $cognome, PDO::PARAM_STR, 40);
            $query->bindParam(':email', $email, PDO::PARAM_STR, 64);
            $query->bindParam(':pwd', $pwdCript, PDO::PARAM_STR, 30);
            $query->bindParam(':sesso', $sesso, PDO::PARAM_STR, 30);
            $query->bindParam(':ente', $ente, PDO::PARAM_STR, 64);
            $query->bindParam(':citta', $città, PDO::PARAM_STR, 64);
            $query->bindParam(':fotoProfilo', $filemat, PDO::PARAM_STR, 30);
            try{
                $query->execute();
                $html='<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body background="../image/gocce.jpg" style="background-attachment:fixed; background-size: 100% 100%;">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <div class="container">    
        <div id="signupsuccess" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Iscrizione avvenuta con successo</div>
                        
                    </div>     

                    <div style="padding-top:30px" class="panel-body">
                        <div class="alert alert-success" role="alert">
                        Iscrizione avvenuta con successo<br>
                        </div>
                        <a href="../index.php">Ritorna alla pagina di login</a>
                        </div> 
                        
                    </div>  
            </div>
    </div>
    </body>
    </html>';

echo($html);
            } catch (Exception $ex) {
                echo $ex->getMessage();
            }
        }

