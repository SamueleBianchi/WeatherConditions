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
        case "archivio":
        $('#pagina').empty();
         $.ajax({
           type: "POST",
           url: "./archivio/caricaArchivio.php",
           success: function(data)
           {
               $("#pagina").html(data); // show response from the php script.
           }
         });
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
    
    function carica(){   
    $.ajax({
           type: "POST",
           url: "./Previsioni/grafico.php",
           dataType : 'json',
           data: {sel:$('select#sel').val(), c:$('#c').val()},
           success: function(data)
           {
               caricaGrafico($('select#sel').val(),data);
           }
          });
    }
    
    $(document).on('submit', 'form#archivio', function(evt){
         $.ajax({
           type: "POST",
           url: "./archivio/archivio.php",
           data: {nota: $("#nota").val(), città: $("#città").val(), temp: $("#temp").val(),tempMax: $("#tempMax").val(),tempMin: $("#tempMin").val(),
           pressione: $("#pressione").val(),umidità: $("#umidità").val(),pioggia: $("#pioggia").val(),neve: $("#neve").val(),nuvole: $("#nuvole").val(),
           velocitàVento: $("#velocitàVento").val(), degVento: $("#degVento").val(),tempo: $("#tempo").val(),descrizione: $("#descrizione").val()},
           success: function(data)
           {
               $("#alert").empty();
               $("#alert").append(data);
               $("#alert").css("display", "block");
           }
         });

    evt.preventDefault(); 
    });
    
function caricaGrafico(scelta,data){
    var labels = [], dato = [];
    var descrizioneX = "Data e Ora";
    var descrizioneY;
    var descrizioneLabel;
    var colore;
    var titolo;
    
       switch(scelta){
        case "Massima":
           descrizioneY = "Temperatura massima in °C";
           descrizioneLabel = "Temperature massime a "+$('#c').val();
           titolo = "Grafico temperature massime";
           colore = "#e62e00";
           for (var i = 0; i < data.length ; i++){
            labels.push(data[i].ora);
            dato.push(data[i].tempMax);
            }
            grafico(labels,dato,titolo,descrizioneLabel,colore,descrizioneX,descrizioneY);
            break;
        case "Minima":
           descrizioneY = "Temperatura minime in °C";
           descrizioneLabel = "Temperature minime a "+$('#c').val();
           titolo = "Grafico temperature minime";
           colore = "#3e95cd";
            for (var i = 0; i < data.length ; i++){
            labels.push(data[i].ora);
            dato.push(data[i].tempMin);
            }
            grafico(labels,dato,titolo,descrizioneLabel,colore,descrizioneX,descrizioneY);
            break;
        case "Umidità":
           descrizioneY = "Umidita (%)";
           descrizioneLabel = "Umidità a "+$('#c').val();
           titolo = "Diagramma umidità (%)";
           for (var i = 0; i < data.length ; i++){
            labels.push(data[i].ora);
            dato.push(data[i].umidità);
            }
        graficoUmidità(labels,dato,titolo,descrizioneLabel,descrizioneX,descrizioneY);
        break;
        case "Precipitazioni":
           descrizioneY = "Precipitazioni (mm)";
           descrizioneLabel = "Precipitazioni a "+$('#c').val();
           titolo = "Grafico Precipitazioni";
           colore = "#3e95cd";
           for (var i = 0; i < data.length ; i++){
            labels.push(data[i].ora);
            dato.push(data[i].precipitazioni);
            }
            grafico(labels,dato,titolo,descrizioneLabel,colore,descrizioneX,descrizioneY);
            break;
    }}

     function grafico(labels, dato, titolo, descrizioneLabel, colore, descrizioneX, descrizioneY){
              $("#grafico").html('<canvas id="line-chart" width="800" height="450"></canvas>');
              new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                  labels: labels,
                  datasets: [{ 
                      data: dato,
                      label: descrizioneLabel,
                      borderColor: colore,
                      fill: true
                    }
                  ]
                },
                options: {
                  title: {
                    display: true,
                    text: titolo
                  },
                  scales: {
            yAxes: [{
                scaleLabel: {
                display: true,
                labelString: descrizioneY
          }
        }],
    xAxes: [{
                scaleLabel: {
                display: true,
                labelString: descrizioneX
          }
        }]

      }
                }
              });
              
}

function graficoUmidità(labels, dato, titolo, descrizioneLabel, descrizioneX, descrizioneY){
    var array = [];
    for (var i=0; i<dato.length; i++){
        array[i]= "#3e95cd";
    }
    $("#grafico").html('<canvas id="bar-chart" width="800" height="450"></canvas>');
    new Chart(document.getElementById("bar-chart"), {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: descrizioneLabel,
          backgroundColor: array,
          data: dato
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: titolo
      },
                  scales: {
            yAxes: [{
                scaleLabel: {
                display: true,
                labelString: descrizioneY
          }
        }],
    xAxes: [{
                scaleLabel: {
                display: true,
                labelString: descrizioneX
          }
        }]

      }
    }
});
}

