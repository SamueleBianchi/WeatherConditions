/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   $('li').click(function(){   
    switch($(this).attr("id")){
        case "meteoCorrente":
            $('#pagina').empty();
            $('#pagina').load("formMeteoCorrente.php");
            break;
    }
    });
   
});
$(document).on('submit', 'form#meteo_Corrente', function(evt){
         $.ajax({
           type: "POST",
           url: "meteoCorrente.php",
           data:{ city: $("#city").val()}, // serializes the form's elements.
           success: function(data)
           {
               $("#weather").html(data); // show response from the php script.
           }
         });

    evt.preventDefault(); 
    });

