<div class="container">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
        <h2>Condizioni meteo attuali date latitudine e longitudine</h2>
        <strong>NOTA: </strong>I risultati mostrati fanno riferimento alla stazione meteo più vicina
        
        <form id="form_latLong" method="POST" action="./meteoCorrente/Coordinate/meteoLatLong.php">
          <div class="form-group">
            <br><label for="lat">Inserisci la latitudine</label>
            <input type="text" class="form-control" id="lat" name="lat" aria-describedby="lat" placeholder="Ad esempio 12" style="width: 30%;">
            <label for="lon">Inserisci la longitudine</label>
            <input type="text" class="form-control" id="lon" name="lon" aria-describedby="lon" placeholder="Ad esempio 42" style="width: 30%;">
          </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary">Cerca</button>
            <div name="weather" id="weather" style="margin-top: 20px; position: relative;"></div>
          
      
      
        </form>
         
        
     </div> 

