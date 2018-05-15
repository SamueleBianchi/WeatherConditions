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
            $('#pagina').load("./meteoCorrente/Città/formMeteoCorrente.php");
            break;
        case "home":
            $('#pagina').empty();
            $('#pagina').load("homeHeader.php");
            break;
        case "latlong":
            $('#pagina').empty();
            $('#pagina').load("./meteoCorrente/Coordinate/formLatLong.php");
            break;
        case "previsioni":
        $('#pagina').empty();
        $('#pagina').load("./Previsioni/formPrevisioniMeteo.php");
       }
    });
   
});
$(document).on('submit', 'form#meteo_Corrente', function(evt){
         $.ajax({
           type: "POST",
           url: "./meteoCorrente/Città/meteoCorrente.php",
           data:{ city: $("#city").val()}, // serializes the form's elements.
           success: function(data)
           {
               $("#weather").html(data); // show response from the php script.
           }
         });

    evt.preventDefault(); 
    });
    
    $(document).on('submit', 'form#form_latLong', function(evt){
         $.ajax({
           type: "POST",
           url: "./meteoCorrente/Coordinate/meteoLatLong.php",
           data:{ lat: $("#lat").val(),lon: $("#lon").val()}, // serializes the form's elements.
           success: function(data)
           {
               $("#weather").html(data); // show response from the php script.
           }
         });

    evt.preventDefault(); 
    });
    
//$("#home").click(function() {
//  $('#pagina').empty();
//  $('#pagina').load("<h2>Ciao <?php echo $_SESSION['email'];?>, bentornato</h2><p>Per usufruire dei vari servizi, utilizza l'apposito menù laterale. Se desideri visualizzare l'intera pagina e oscurare il menù laterale ti basterà cliccare nella X in alto. Viceversa, se desideri riutilizzare il menù dovrai cliccare nuovamente nell'apposito pulsante</p><p>Per uscire dal proprio profilo utente dovrai cliccare nel pulsante in alto a destra 'Logout' che ti reindirizzerà alla pagina di accesso</p><p>Ogni sezione è provvista di varie funzionalità che ti permetteranno di consultare i vari dati di interesse </p>");
//});
