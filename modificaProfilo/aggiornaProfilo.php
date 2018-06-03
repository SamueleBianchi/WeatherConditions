<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../db/dbconnect.php';
require dirname(__FILE__).'/../Filtro/filtro.php';

session_start();

$nuovoNome = filtra($_POST['nome']);
$nuovoCognome = filtra($_POST['cognome']);
$nuovaEmail = filtra($_POST['email']);
$nuovaPassword = filtra($_POST['pwd']);
$nuovoEnte = filtra($_POST['ente']);
$nuovaCittà = filtra($_POST['città']);
$nuovoSesso = filtra($_POST['sesso']);


$userfile_tmp = $_FILES['userfile']['tmp_name'];

//recupero il nome originale del file caricato
$userfile_name = $_FILES['userfile']['name'];

$path_parts = pathinfo($_FILES["userfile"]["name"]);
$ext = $path_parts['extension'];
$filemat=$nuovaEmail.'.'.$ext;

if (unlink("../foto/".$_SESSION['fotoProfilo'])) {
 if (move_uploaded_file($userfile_tmp,"../foto/".$filemat)){
$query = "UPDATE utenti SET nome = '".$nuovoNome."', cognome = '".$nuovoCognome."',email = '".$nuovaEmail."',pwd = MD5('".$nuovaPassword."'),ente = '".$nuovoEnte."',citta = '".$nuovaCittà."', fotoProfilo = '".$filemat."' WHERE IDUtente = ".$_SESSION['IDUtente'];
$connessione->exec($query);
$_SESSION['fotoProfilo'] = $filemat;
$_SESSION['nome'] = $nuovoNome;
$_SESSION['email'] = $nuovaEmail;
header('Location: ../homepage.php');

 }
}else{
  echo 'il file NON è stato cancellato';
}

