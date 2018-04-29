<div class="container">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
        <h2>Condizioni meteo attuali</h2>
         
        <form id="meteo_Corrente" method="POST" action="meteoCorrente.php">
          <div class="form-group">
            <label for="city">Scrivi il nome della città da ricercare</label>
            <input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="E.g. New York, Tokyo">
          </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary">Cerca</button>
            <div name="weather" id="weather" style="margin-top: 20px;"></div>
          
      
      
        </form>
         
        
     </div> 