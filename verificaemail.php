<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require "./db/dbconnect.php";

$email=$_POST["email"];
$query = "SELECT email FROM utenti WHERE email = ".$connessione->quote($_POST['email']);
$risultato = $connessione->query($query);
$num = $risultato->rowCount();
echo ($num);