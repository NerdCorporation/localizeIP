$.getJSON("http://ip-api.com/json/?callback=?", function(data) {
    var table_body = "";
    $.each(data, function(k, v) {
        table_body += "<tr><td>" + k + "</td><td><b>" + v + "</b></td></tr>";
    });
    //$("#GeoResults").html(table_body);
    
    $.ajax({
        type: "POST",
        url:"index.php?control=ajaxCall&task=take",
        dataType:"html",
        data:{
            "allData": table_body
        }      
        
    });  
});


