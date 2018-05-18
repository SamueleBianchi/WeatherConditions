<div class="container">
<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <h2>Previsioni Meteo</h2>
         
        <form name="previsioni" id="previsioni" method="POST" action="./Previsioni/previsioniMeteo.php">
          <div class="form-group">
            <label for="city">Scrivi il nome della città da ricercare</label>
            <input type="text" class="form-control" id="city" name="city" aria-describedby="city" placeholder="E.g. New York, Tokyo">
          </div>

            <button type="submit" name="submit" id="submit" class="btn btn-primary">Cerca</button>
            <div name="prev" id="prev" style="margin-top: 20px; position: relative;"></div>
          
      
      
        </form>
         
        
     </div> 

