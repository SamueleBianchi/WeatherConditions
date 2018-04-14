<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require "dbconnect.php";

$crea_tb = $connessione->exec("CREATE TABLE IF NOT EXISTS Utenti (
    IDUtente int(10) NOT NULL AUTO_INCREMENT,
    nome varchar(30) NOT NULL,
    cognome varchar(40) NOT NULL,
    email varchar(64) NOT NULL,
    pwd varchar(30) NOT NULL,
    sesso varchar(30) NOT NULL,
    ente varchar(64) NOT NULL,
    citta varchar(64) NOT NULL,
    fotoProfilo varchar(30) NOT NULL,
    PRIMARY KEY (idUtente)
  )");
    