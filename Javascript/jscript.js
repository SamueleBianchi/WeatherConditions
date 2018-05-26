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
            break;
        case "profilo":
        $('#pagina').empty();
        $('#pagina').load('./modificaProfilo/caricaProfilo.php');
        break;
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
    
    $(document).on('submit', 'form#previsioni', function(evt){
         $.ajax({
           type: "POST",
           url: "./Previsioni/previsioniMeteo.php",
           data: {city: $("#city").val()}, // serializes the form's elements.
           success: function(data)
           {
               $("#prev").html(data); // show response from the php script.
               var table = '#mytable';
        $('#maxRows').on('change',function(){
		  	$('.pagination').html('');
		  	var trnum = 0 ;	
		  	var maxRows = parseInt($(this).val());
		  	var totalRows = $(table+' tbody tr').length;
			 $(table+' tr:gt(0)').each(function(){	
			 	trnum++;				
			 	if (trnum > maxRows ){		
			 		$(this).hide();		
			 	}if (trnum <= maxRows ){$(this).show();}
			 });										
			 if (totalRows > maxRows){						
			 	var pagenum = Math.ceil(totalRows/maxRows);	
			 	for (var i = 1; i <= pagenum ;){
			 	$('.pagination').append('<li data-page="'+i+'">\
								      <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
								    </li>').show();
			 	}											
			} 												
			$('.pagination li:first-child').addClass('active');
			$('.pagination li').on('click',function(){	
				var pageNum = $(this).attr('data-page');
				var trIndex = 0 ;						
				$('.pagination li').removeClass('active');
				$(this).addClass('active');				 
				$(table+' tr:gt(0)').each(function(){	
				 	trIndex++;	
				 	if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
				 		$(this).hide();		
				 	}else {$(this).show();} 				
				}); 										
            });	
        });
           }
         });

    evt.preventDefault(); 
    });
    
    $(document).on('submit', 'form#aggiornaProfilo', function(evt){
         $.ajax({
           type: "POST",
           url: "./modificaProfilo/aggiornaProfilo.php",
           data: {nome: $("#nome").val(),cognome: $("#cognome").val(),email: $("#email").val(),pwd: $("#pwd").val(),ente: $("#ente").val(),città: $("#città").val(),sesso: $("#sesso").val(),userfile_name :$('#userfile').valueOf()}, // serializes the form's elements.
           success: function(data)
           {
               $("#success").empty(); // show response from the php script.
               $("#success").html(data); // show response from the php script.
               $("#success").css("display", "block");
           }
         });

    evt.preventDefault(); 
    });
    


