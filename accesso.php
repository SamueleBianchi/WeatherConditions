<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "./db/dbconnect.php";

$email=$_POST["email"];
$password=$_POST["password"];

//$query = $connessione->prepare("SELECT * FROM utenti WHERE email = :email and pwd = :pwd");
//$query->bindParam(':email', $email, PDO::PARAM_STR, 64);
//$query->bindParam(':pwd', $password, PDO::PARAM_STR, 30);
//$query->execute();
//$risultato= $query->fetchAll();
$query="SELECT * FROM utenti WHERE email = '$email' AND pwd = '$password'";
$risultato = $connessione->query($query);
$num = $risultato->rowCount();
if($num=='1'){
    session_start();
    $_SESSION['email'] = $email;
    header("Location: homepage.php");   
} else {
    echo '<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body background="./image/gocce.jpg" style="background-attachment:fixed; background-size: 100% 100%;">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <div class="container">    
        <div id="signupsuccess" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Email o password errate</div>
                        
                    </div>     

                    <div style="padding-top:30px" class="panel-body">
                        <div class="alert alert-danger" role="alert">
                        Email o password errate<br>
                        </div>
                        <a href="index.php">Ritorna alla pagina di login</a>
                        </div> 
                        
                    </div>  
            </div>
    </div>
    </body>
    </html>';
}