/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function validateForm(){
    $("#error").empty();
    if($("#pwd").val()!==$("#pwd2").val()){
        var errorepwd= "<p>Le due password devono essere uguali</p>";
        $("#signupalert").css("display", "block");
        $("#error").append(errorepwd);
        flag=false;
    }
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
    return flag;
    }