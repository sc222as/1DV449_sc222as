function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(55.000, 11.000),
        zoom: 6,


    };

    
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                                                                                                                //H�r anv�nds Ajax f�r att h�mta Json datan
    $.ajax({

        dataType: 'json',
        url: "DataRetrieve.php",
        error: function () { alert("Ett fel har intr�ffat, var v�nlig f�rs�k igen lite senare"); },             //Felhantering
        success: function (data) {
            var text = '';
            var marker;
            var markers = new Array();                                                                          //F�rbereder h�r placerar vi alla mark�rer i en array
            var len = data.length;

        for (var i = 0; i < len; i++) {                                                                         //H�r placerar vi ut alla mark�rer som fanns i arrayen. 
            var title = data[i].Name + " Time: " + data[i].Time;
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(data[i].Lat, data[i].Long),
                map: map,
                title: title

            });
            
            markers.push(marker)
            
        }


    }


});

}
google.maps.event.addDomListener(window, 'load', initialize);