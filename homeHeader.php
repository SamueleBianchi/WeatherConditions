<?php session_start(); 
if(!isset($_SESSION['email'])){
header('Location: index.php');}?>
<h2>Ciao <?php echo $_SESSION['email'];?>, bentornato</h2>
<p>Per usufruire dei vari servizi, utilizza l'apposito menù laterale. Se desideri visualizzare l'intera pagina e oscurare il menù laterale ti basterà cliccare nella X in alto. Viceversa, se desideri riutilizzare il menù dovrai cliccare nuovamente nell'apposito pulsante</p>
<p>Per uscire dal proprio profilo utente dovrai cliccare nel pulsante in alto a destra "Logout" che ti reindirizzerà alla pagina di accesso</p>
<p>Ogni sezione è provvista di varie funzionalità che ti permetteranno di consultare i vari dati di interesse </p>
