<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
$_SERVER['PHP_SELF'];
session_start(); 
if(!isset($_SESSION['email'])){
header('Location: index.php');
}?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <title>Weather Conditions</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="./stili/style5.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="Javascript/jscript.js"></script>
        <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
    </head>
    <body>

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Weather Conditions</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Menu:</p>
                    <li class="home" id="home"><a href="#">Home</a>
                    <li>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Meteo Corrente</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li id="meteoCorrente"><a href="#"><span class="glyphicon glyphicon-globe"></span>   Per città</a></li>
                            <li id="latlong"><a href="#"><span class="glyphicon glyphicon-map-marker"></span>   Per coordinate</a></li>
                        
                        </ul>
                    </li>
                    <li id="previsioni">
                        <a href="#"><span class="glyphicon glyphicon-stats"></span> Previsioni Meteo</a>
                    </li>
                    <li>
                        <a href="./myMaps/maps.php"><i class="material-icons" style="font-size:20px;">map</i>  My Maps</a>
<!--                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Pages</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="#">Page 1</a></li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>-->
                    </li>
                    
                </ul>

                <ul class="list-unstyled CTAs">
                    <li><a href="https://github.com/SamueleBianchi/WeatherConditions" class="download">Download source</a></li>
                    <li><a href="http://www.irpi.cnr.it/" class="article">IRPI-CNR</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content" >

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <img align="left" src="./foto/<?php echo $_SESSION['fotoProfilo'];?>" style="width:45px;height:45px; border-radius: 50%; "></img>
                                <li id="profilo"><a href="#"><?php echo $_SESSION['nome'];?></a></li>
                                <li id="logout"><a href="logout.php" style="float:right;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div id="pagina">
                <h2>Ciao <?php echo $_SESSION['nome'];?>, bentornato</h2>
                <p>Per usufruire dei vari servizi, utilizza l'apposito menù laterale. Se desideri visualizzare l'intera pagina e oscurare il menù laterale ti basterà cliccare nella X in alto. Viceversa, se desideri riutilizzare il menù dovrai cliccare nuovamente nell'apposito pulsante</p>
                <p>Per uscire dal proprio profilo utente dovrai cliccare nel pulsante in alto a destra "Logout" che ti reindirizzerà alla pagina di accesso</p>
                <p>Ogni sezione è provvista di varie funzionalità che ti permetteranno di consultare i vari dati di interesse </p>
                </div>
                </div>
        </div>





        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
