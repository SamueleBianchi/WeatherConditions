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
    pwd varchar(32) NOT NULL,
    sesso varchar(30) NOT NULL,
    ente varchar(64) NOT NULL,
    citta varchar(64) NOT NULL,
    fotoProfilo varchar(30) NOT NULL,
    PRIMARY KEY (idUtente)
  )");

 $query = $connessione->exec("CREATE TABLE IF NOT EXISTS archivio(
         idArchivio INT(10) NOT NULL AUTO_INCREMENT,
         città VARCHAR(50) NOT NULL,
         temp FLOAT NOT NULL,
         tempMax FLOAT NOT NULL,
         tempMin FLOAT NOT NULL,
         pressione FLOAT NOT NULL,
         umidità FLOAT NOT NULL,
         visibilità FLOAT,
         velocitàVento FLOAT NOT NULL,
         degVento FLOAT NOT NULL,
         nuvole FLOAT NOT NULL,
         pioggia FLOAT,
         neve FLOAT,
         tempo VARCHAR(50),
         descrizione VARCHAR(50) NOT NULL,
         nota VARCHAR(50) NOT NULL,
         CodUtente INT(10) NOT NULL,
         PRIMARY KEY (IdArchivio),
         FOREIGN KEY (CodUtente) REFERENCES utenti(IDUtente) 
         )");
    