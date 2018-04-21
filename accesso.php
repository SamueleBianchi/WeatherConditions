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
$query="SELECT email FROM utenti WHERE email = '$email' AND pwd = '$password'";
$risultato = $connessione->query($query);
$num = $risultato->rowCount();
if($num=='1'){
    session_start();
    $_SESSION['email'] = $email;
    header("Location: homepage.php");
    
}