<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "../db/dbconnect.php";
require dirname(__FILE__).'/../Filtro/filtro.php';  

$email= filtra($_POST["email"]);
$password=filtra($_POST["password"]);

$query="SELECT * FROM utenti WHERE email = '$email' AND pwd = '$password'";
$risultato = $connessione->query($query);
foreach ($connessione->query($query) as $row) {
        $foto =  $row['fotoProfilo'];
        $nome = $row['nome'];
        $id = $row['IDUtente'];
    }
$num = $risultato->rowCount();
if($num=='1'){
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['fotoProfilo'] = $foto;
    $_SESSION['nome'] = $nome;
    $_SESSION['IDUtente'] = $id;
    if(!empty($_POST["remember"])) {
				setcookie ("email",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60), "/");
				setcookie ("password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60), "/");
			} else {
				if(isset($_COOKIE["email"])) {
					setcookie ("email","");
				}
				if(isset($_COOKIE["password"])) {
					setcookie ("password","");
				}
			}
    header("Location: ../homepage.php");   
} else {
    echo '<html>
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
                        <div class="panel-title">Email o password errate</div>
                        
                    </div>     

                    <div style="padding-top:30px" class="panel-body">
                        <div class="alert alert-danger" role="alert">
                        Email o password errate<br>
                        </div>
                        <a href="../index.php">Ritorna alla pagina di login</a>
                        </div> 
                        
                    </div>  
            </div>
    </div>
    </body>
    </html>';
}