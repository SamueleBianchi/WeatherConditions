<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if(isset($_SESSION['email'])){
     header('Location: homepage.php');
     exit();
}?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body background="./image/gocce.jpg" style="background-attachment:fixed; background-size: 100% 100%;">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <script src="miojavascript.js"></script>
    <div class="container" >    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                <div id="accesso" class="panel-heading">
                        <div id="accesso_title" class="panel-title">Accedi</div>
                    </div>     
                
                    <div style="padding-top:30px" class="panel-body" >
                        
                            
                        <form id="loginform" class="form-horizontal" role="form" method="POST" action="accesso.php" onsubmit="return validateAccess()">
                            
                           <div id="log" style="display:none;" class="alert alert-danger">
                                    <span id="errore_accesso"></span>
                                </div>
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="email" class="form-control" name="email" value="" placeholder="email" required="true">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required="true">
                                    </div>
                                                                   
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> Ricordami
                                        </label>
                                      </div>
                                    </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                       <button id="btn-login" type="submit" class="btn btn-success"><i class="icon-hand-right"></i>Login</button> 

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div id="no_account">
                                            Non hai un account? 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').slideDown('slow')">
                                            Registrati qui
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     

                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div id="registrazione" class="panel-heading">
                            <div class="panel-title" style="color: white;">Registrazione</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a style="color: white;" id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').slideDown('slow')">Accedi</a></div>
                        </div>  
                        <div class="panel-body">
                            <form id="signupform" class="form-horizontal" role="form" action="iscrizione.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                                
                                <div id="signupalert" style="display:none;" class="alert alert-danger">
                                    <span id="error"></span>
                                </div>
                                
                              
                                <div class="form-group" style="margin-top: 20px;">
                                    <label for="nome" class="col-md-3 control-label">Nome</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Il tuo nome" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cognome" class="col-md-3 control-label">Cognome</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="cognome" placeholder="Il tuo cognome" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="La tua email" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="pwd" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="pwd2" class="col-md-3 control-label">Conferma password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="Conferma la password" required>
                                    </div>
                                </div>
                                    
                                
                                 <div class="form-group">
                                    <label for="sesso" class="col-md-3 control-label">Sesso</label>
                                    <div class="col-md-9">
                                    <select class="form-control" name="sesso" required>
                                        <option>Maschio</option>
                                        <option>Femmina</option>
                                      </select>
                                    </div>
                                </div>
                                
                               
                                 <div class="form-group">
                                    <label for="ente" class="col-md-3 control-label">Ente di ricerca</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="ente" placeholder="Inserisci l'ente di ricerca di appartenenza" required>
                                    </div>
                                 </div>
                                
                                <div class="form-group">
                                    <label for="città" class="col-md-3 control-label">Città</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="città" placeholder="ad esempio Roma, Milano, Perugia" required>
                                    </div>
                                </div>
                                
                                    <div id="foto_profilo" class="col-md-9">
                                        <strong>Inserisci la foto profilo: </strong><input name="userfile" type="file" accept="image/*"></br>
                                    </div>
                                    
                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9" style="margin-top:20px;">
                                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Iscriviti</button> 
                                    </div>
                                </div>
      
                            </form>
                         </div>
                    </div>
                
         </div> 
    </div>
    </body>
</html>
