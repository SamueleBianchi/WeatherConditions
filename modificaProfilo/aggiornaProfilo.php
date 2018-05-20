<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../db/dbconnect.php';
session_start();

$nuovoNome = $_POST['nome'];
$nuovoCognome = $_POST['cognome'];
$nuovaEmail = $_POST['email'];
$nuovaPassword = $_POST['pwd'];
$nuovoEnte = $_POST['ente'];
$nuovaCittà = $_POST['città'];
$nuovoSesso = $_POST['sesso'];


$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

$path_parts = pathinfo($_FILES["userfile"]["name"]);
$ext = $path_parts['extension'];
$filemat=$nuovaEmail.'.'.$ext;

if (unlink("../foto/".$_SESSION['fotoProfilo'])) {
 if (move_uploaded_file($userfile_tmp,"../foto/".$filemat)){
$query = "UPDATE utenti SET nome = '".$nuovoNome."', cognome = '".$nuovoCognome."',email = '".$nuovaEmail."',pwd = '".$nuovaPassword."',ente = '".$nuovoEnte."',citta = '".$nuovaCittà."', fotoProfilo = '".$filemat."' WHERE IDUtente = ".$_SESSION['IDUtente'];
$connessione->exec($query);
$_SESSION['nome'] = $nuovoNome;
$_SESSION['email'] = $nuovaEmail;
header('Location: ../homepage.php');

 }
}else{
  echo 'il file NON è stato cancellato';
}

