<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../db/dbconnect.php';
session_start(); 

$query="SELECT * FROM utenti WHERE IDUtente = ".$_SESSION['IDUtente']."";
$risultato = $connessione->query($query);
foreach ($connessione->query($query) as $row) {
        $foto =  $row['fotoProfilo'];
        $nome = $row['nome'];
        $id = $row['IDUtente'];
        $cognome = $row['cognome'];
        $ente = $row['ente'];
        $città = $row['citta'];
        $pwd = $row['pwd'];
    }

echo '<form id="aggiornaProfilo" name="aggiornaProfilo" enctype="multipart/form-data" action="./modificaProfilo/aggiornaProfilo.php" method="POST">';
echo '<div id="success" style="display:none;" class="alert alert-success"></div>'
. '<div class="container"><h1>Modifica il tuo profilo</h1>'
    . '<div class="form-group">
      <label for="usr">Nome:</label>
      <input style="width: 30%; type="text" class="form-control" name="nome" id="nome" value="'.$nome.'" required="true">
    </div>
    <div class="form-group">
      <label for="usr">Cognome:</label>
      <input style="width: 30%; type="text" class="form-control" name="cognome" id="cognome" value="'.$cognome.'" required="true">
    </div>
     <div class="form-group">
      <label for="pwd">Email:</label>
      <input style="width: 30%;" type="email" class="form-control"  name="email" id="email" value="'.$_SESSION['email'].'" required="true">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input style="width: 30%;" type="password" class="form-control" name="pwd" id="pwd" required="true">
    </div>
    <div class="form-group">
    <label for="sesso">Sesso</label>
    <div class="form-group">
        <select class="form-control" id="sesso" name="sesso" required style="width: 30% !important; min-width: 30%; max-width: 30%;">
            <option>Maschio</option>
            <option>Femmina</option>
        </select>
    </div>
    <div class="form-group">
      <label for="pwd">Ente:</label>
      <input style="width: 30%;" type="text" class="form-control"  name="ente" id="ente" value="'.$ente.'" required="true">
    </div>
    <div class="form-group">
      <label for="pwd">Città:</label>
      <input style="width: 30%;" type="text" class="form-control" name="città" id="città" value="'.$città.'" required="true">
    </div>
    </div>
    <div id="foto_profilo" class="form-group">
    <strong>Inserisci la foto profilo: </strong><input id="userfile" name="userfile" type="file" accept="image/*" required="true"></br>
    </div>
                                    
                                <div class="form-group">
                                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Modifica</button> 
                                    </div>
                                </div>'
        . '</form>';