/* 
 * File creato da Carlo Centofanti
 */

//wait till DOM has been created, then call mainFunction()
//var events;
$(mainFunction);

function mainFunction(){
    $.ajaxSetup({ cache: false });
    createCalendar();
}

function createCalendar(){
    $('#calendar').fullCalendar(calendarConfig);
   

}


//build an error div and place it before the calendar
function showErrorMessage(error){
    var errorDiv=$('<div>',{
        id:"errormsg",
        title: "ATTENZIONE!",
        text: error
    });
    //errorDiv.addClass("errormsg");
    $("#calendar").prepend(errorDiv);  
    $("#errormsg").errorStyle();
    $(".errormsg").bPopup();
}

function showSuccessMessage(message){
    var successDiv=$('<div>',{
        id:"successmsg",
        title: "OK!",
        text: message
    });
    $("#calendar").prepend(successDiv);  
    $("#successmsg").successStyle();
    $(".infomsg").bPopup();
}


//returns tomorrow's timestamp
function tomorrowTimestamp(){
    var today = new Date();
    var d = today.getDate();
    var m = today.getMonth();
    var y = today.getFullYear();

    var tomorrow= new Date(y, m, d+1);
    return tomorrow.getTime();
}

function todayTimestamp(){
    var today = new Date();
    var d = today.getDate();
    var m = today.getMonth();
    var y = today.getFullYear();

    var yesterday= new Date(y, m, d);
    return yesterday.getTime();
}

//register some jquery functions
//adds an error style. call like: $(...).errorStyle();
(function($) {
    $.fn.errorStyle = function() {
        var oldErrore = this.html();
        var StyledError = "<div class=\"ui-state-error ui-corner-all errormsg\" style=\"padding: 0 .7em;\">";
            StyledError += "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\">";
            StyledError += "</span><strong>ATTENZIONE: </strong>";
            StyledError += oldErrore ;
            StyledError += "</p></div>";
            this.replaceWith(StyledError );
    };
})(jQuery);

//adds a success style
(function($) {
    $.fn.successStyle = function() {
        var oldSuccess = this.html();
        var StyledSuccess = "<div class=\"ui-state-highlight ui-corner-all infomsg\" style=\"padding: 0 .7em;\">";
            StyledSuccess += "<p><span class=\"ui-icon ui-icon-check\" style=\"float: left; margin-right: .3em;\">";
            StyledSuccess += "</span><strong>OK: </strong>";
            StyledSuccess += oldSuccess ;
            StyledSuccess += "</p></div>";
            this.replaceWith(StyledSuccess );
    };
})(jQuery);

var calendarConfig=({
    events:{
        url:'index.php?control=ajaxCall&task=getMyEvents',
        editable:true
    },
   
    //some configuration first
    defaultView: 'agendaWeek',
    handleWindowResize: true,
    allDaySlot: false, // do not visualize the all day cell
    slotDuration: '00:30:00', //visualize 30 minutes per cell
    hiddenDays: [0,6] , //do not show sat and sun
        
    //use custom theme
    theme: true, 
    themeButtonIcons: true,
        
    //time shown on the vertical index
    minTime: '08:00:00',
    maxTime: '21:30:00',
    
    slotEventOverlap: true, //http://fullcalendar.io/docs/agenda/slotEventOverlap/
    header: {
            center:'title',
            left: 'agendaWeek,agendaDay',
            right:'today prev,next'
        },
    
    //selection settings
    selectable: true,
    unselectAuto: true,
    unselectCancel:'html-id',// an id wich do not auto cancel (use if unselectAuto is true)
    selectHelper: false, //draw a "placeholder" event while the user is dragging
    selectOverlap:true,//se messa a false impedisce di selezionare sopra gli eventi
    selectConstraint:{
        start: '08:00:00', 
        end: '20:00:00'     
    },
    eventClick:function( event, jsEvent, view ) { 
        if(confirm("Sei sicuro di eliminare l'evento?")){
            deleteEvent(event);
        }
    },
    select: function( start, end, jsEvent, view ){
        var event= {
            start: start,
            end: end
        };
        
        var currentTimestamp = new Date().getTime();
        $(".errormsg").remove();
        $(".infomsg").remove();
        
        //validate the event
        if(event.start > todayTimestamp()){
            if(event.start > tomorrowTimestamp()){
                
                
                pickCFandSave(event);
                
            }else{//sta tentando di prenotarsi per oggi
                showErrorMessage("Non puoi prenotarti per oggi stesso! Per favore scegli un altra data");
                
            }   
         
        }else{//sta tentando di prenotarsi per un giorno passato
            showErrorMessage("Non puoi prenotarti per un giorno passato! Per favore scegli un altra data");
           
        }
        
    },
    eventDrop:function( event, delta, revertFunc, jsEvent, ui, view ) {
        deleteEvent(event);
        saveEvent(event);
    },
    eventResize: function( event, delta, revertFunc, jsEvent, ui, view ){ 
        deleteEvent(event);
        
        saveEvent(event);
    },
    
//    loading:function( isLoading, view ){
//        if(isLoading){
//            $("#loading").show().effect("fade");            
//        }else{
//            $("#loading").effect("drop").hide();
//            
//        }
//    }
});

function saveEvent(event){
    
    //vanno tolti e messi tutti ai valori di event come datainizio e datafine
    dataInizio=event.start.format();
    dataFine=event.end.format();
    eventID=new Date().getTime()-parseInt(Math.random()*100); 
    titolo=event.title;
    cf=event.CodiceFiscalePrenotazione;
    
    
    
    $.ajax({
        type: "POST",
        url:"index.php?control=ajaxCall&task=saveEvent",
        dataType:"html",
        data:{
            "dataInizio": dataInizio,
            "eventID": eventID,
            "cf": cf,
            "titolo": titolo,
            "dataFine": dataFine
        },
        success:function (fail){
            if(!fail){
                $("#calendar").fullCalendar( 'unselect' );
                showSuccessMessage("Visita aggiunta correttamente");
            }else{
                showErrorMessage(fail);
            }
            $('#calendar').fullCalendar( 'refetchEvents' );
        }
        
        
    });   
}

function deleteEvent(event){ 
    $.ajax({
        type: "POST",
        url:"index.php?control=ajaxCall&task=deleteEvent",
        dataType:"json",
        data:{
            "idEvento": event.id
            
        },
        success:function (fail){
          
            if(!fail){
                //showSuccessMessage("Visita rimossa correttamente");
            }else{
                //showErrorMessage("Non è stato possibile rimuovere l'evento. ERROR: "+fail);
            }
            $('#calendar').fullCalendar( 'refetchEvents' );
        }
        
        
    });   
} 

function pickCFandSave(event){
    var form=$("#popup-form").show();
    form.submit(function (e){
        e.preventDefault();
        
        event.CodiceFiscalePrenotazione=$("#cf").val();
        event.title=$("#titolo").val();
        
        
        $("#popup-form").dialog( "close" );
        saveEvent(event);
        window.location.reload();
        
    });
    form.dialog({
        resizable:false,
        autoOpen: true,

        showType:true,
        modal: true,
        draggable: true,
        closeText: "Annulla"
        
        
    });
    
}