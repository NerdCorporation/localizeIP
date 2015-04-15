<!-- calendario di google calendar caricato direttamente da li
<div>
    <iframe src="https://www.google.com/calendar/embed?title=Visite&amp;height=600&amp;wkst=2&amp;hl=it&amp;bgcolor=%23ffffff&amp;src=carlo.clinicard%40gmail.com&amp;color=%232952A3&amp;ctz=Europe%2FRome" style=" border-width:0 " width="800" height="600" frameborder="0" scrolling="no"></iframe>
</div>
  -->
  
  
<div id="popup-form" class="popup" >
    
    <form id="Visit-Form" method="POST" action="">
        
    <div class="row" >
        <div class="row-element">
            <p class="label"><label>Titolo: </label></p>
            <p><input class="input-field" id="titolo" type="text" name="CF" placeholder="Titolo: "/></p>
        </div>
    </div>
    <div class="row" >
              <div class="row-element">
                  <p class="label"><label>Codice Fiscale</label></p>
                  <p><input class="input-field" id="cf" type="text" name="CF" placeholder="Codice Fiscale"/></p>
              </div>
          </div>

      <div class="row-buttons">
          <p> <button class="controlButton" id="saveElementButton" type="submit"/>Salva</button>
          </p>
      </div>

  </form>
      
</div>
  
  
<!-- The calendar will be placed here -->
<div id='calendar' draggable="false"></div>


