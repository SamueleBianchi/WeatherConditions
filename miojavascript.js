/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function validateForm(){
    $("#error").empty();
    $.post("verificaemail.php",
        {
          email: $('#email').val()
        },
        function(data){
            flag=false;
            if(data==="1"){
       var erroreemail= "<p>L'email inserita è già utilizzata da un altro account.</p>";
        $("#signupalert").css("display", "block");
       $("#error").append("</br>"+erroreemail);
        flag=false;
        }
    else{
        flag=true;}
    });
    if(validatePwd()===true && flag===true){
        return true;
    }else{
        return false;
    }
    }
    
    function validatePwd(){
        if($("#pwd").val()!==$("#pwd2").val()){
        var errorepwd= "<p>Le due password devono essere uguali</p>";
        $("#signupalert").css("display", "block");
        $("#error").append(errorepwd);
        flag=false;
    }else{
        return true;
    }
    }
    
    function validateAccess(){
        $("#errore_accesso").empty();
        $.ajax({
        type: 'POST',
        url: 'verifica_accesso.php',
        data: {email: $('#login-username'),password: $('#login-password')},
        success: function(data){
            flag=false;
            switch(data){
                case "1":
                    alert("edwASD"+$('#login-password').val());
                    flag=true;
                    $("#errore_accesso").empty();
                    $("#log").css("display", "none");
                    break;
                case "0":
                    alert($('#login-password').val());
                    var errore= "<p>Email o password errati</p>";
                    $("#log").css("display", "block");
                    $("#errore_accesso").append("</br>"+errore);
                    flag=false;
                    break;
            }
            }
        
        });
            return false;
        }      
        

