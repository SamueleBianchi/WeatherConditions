<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require "../db/dbconnect.php";

$email=$_POST["email"];
$password=$_POST["password"];
$query = "SELECT * FROM utenti WHERE email = '$email' AND pwd = '$password'";
try{
$risultato = $connessione->query($query);
}catch(PDOException $ex){
    print $ex->getMessage();
}
$num = $risultato->rowCount();
echo ($num);
