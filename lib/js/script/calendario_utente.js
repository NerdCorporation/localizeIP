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


var calendarConfig=({
    eventSources: [
        {
            url:'index.php?control=ajaxCall&task=getMyPlaceHolders',
            backgroundColor:"red",
            borderColor:"red",
            editable:false
            
        },
        {
            url: 'index.php?control=ajaxCall&task=getMyEvents',
            backgroundColor:"green",
            borderColor:"green",
            editable:false,
            eventDurationEditable:false
        }
    ],
   
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
    selectable: false
});
